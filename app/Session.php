<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class Session extends Model
{
    public static $tableName = 'sessions';
    public static $tbid = 'id';
    public static $tbuser_id = 'user_id';
    public static $tbip_address = 'ip_address';
    public static $tbuser_agent = 'user_agent';
    public static $tbpayload = 'payload';
    public static $tblast_activity = 'last_activity';

    // $type : 0 -> object, 1 -> array
    public function setallAttribute($request){

        if(!is_array($request)){
            $this->user_id = $request->user_id;
            $this->ip_address = $request->ip_address;
            $this->user_agent = $request->user_agent;
            $this->payload = $request->payload;
            $this->last_activity = $request->last_activity;
        }else {
            $this->user_id = $request['user_id'];
            $this->ip_address = $request['ip_address'];
            $this->user_agent = $request['user_agent'];
            $this->payload = $request['payload'];
            $this->last_activity = $request['last_activity'];
        }
    }

    public static function getallAttribute($data){

        $result = [];

        $result[self::$tbid] = $data->id;
        $result[self::$tbuser_id] = $data->user_id;
        $result[self::$tbip_address] = $data->ip_address;
        $result[self::$tbuser_agent] = $data->user_agent;
        $result[self::$tbpayload] = $data->payload;
        $result[self::$tblast_activity] = $data->last_activity;

        return $result;
    }

    public static function generateSession($userObj){

        $session = [];
        $session['user_id'] = $userObj->id;
        $session['ip_address'] = '';
        $session['user_agent'] = '';
        $session['payload'] = md5($userObj->id . $userObj->username . microtime(true));
        $session['last_activity'] = 1;

        return $session;
    }

    public static function updateLastActivity($Session_id, $user_id){
        if($Session_id == null){
            $AllData = DB::table(self::$tableName)
                ->where(self::$tableName . '.' . self::$tbuser_id, '=', $user_id)
                ->update(['last_activity' => 0]);
        }else{
            $AllData = DB::table(self::$tableName)
                ->where(self::$tableName . '.' . self::$tbuser_id, '=', $user_id)
                ->where(self::$tableName . '.' . self::$tbid, '!=', $Session_id)
                ->update([
                    'last_activity' => 0,
                    'updated_at' => Carbon::now()
                ]);
        }

    }
}
