<?php

namespace App\Http\Controllers\Auth\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

use App\Http\Controllers\Auth\Helper\config;
use App\Http\Controllers\Auth\Model\User;
use App\Http\Controllers\Auth\Model\verificationcode;

class Session extends Model
{

    // in this Model you will find :
    // functions that will be initiated always in the start of each Model
    //      setallAttribute
    //      getallAttribute
    // check functions
    //      isLoggedIn
    // Actions functions
    //      generateSession
    //      createSessionArr
    //      updateLastActivity

    // attributes of the Table
    public static $tableName = 'sessions';
    public static $tbid = 'id';
    public static $tbuser_id = 'user_id';
    public static $tbip_address = 'ip_address';
    public static $tbuser_agent = 'user_agent';
    public static $tbpayload = 'payload';
    public static $tblast_activity = 'last_activity';

    //------------------------------------------------------------------------------------------------------------------
    // functions that will be initiated always in the start of each Model
    //------------------------------------------------------------------------------------------------------------------

    // $type : 0 -> object, 1 -> array
    // attribute that will be ised when inserting new object to this Model
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

    // attribute that will be returned to frontend
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


    //------------------------------------------------------------------------------------------------------------------


    //------------------------------------------------------------------------------------------------------------------
    // check functions
    //------------------------------------------------------------------------------------------------------------------

    // check if the user logged in or not, online or offline
    // return 1 if the user online
    // return 0 if the user offline
    public static function isLoggedIn($session){
        $Data = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbpayload, '=', $session)
            ->select(self::$tableName . '.' . self::$tblast_activity)
            ->first();
        if($Data != null) {
            if ($Data->last_activity) return true;
        }
        return false;
    }

    //------------------------------------------------------------------------------------------------------------------



    //------------------------------------------------------------------------------------------------------------------
    // Actions functions
    //------------------------------------------------------------------------------------------------------------------

    // called from  ( login ) in : \Auth\Controllers\loginController
    // called from  ( logout ) in : \Auth\Controllers\logoutController

    // initializing session object
    // insert the session
    // make user session online
    // return session object
    public static function generateSession($user){
        try{

            // initializing session object
            $session_arr = self::createSessionArr($user);

            // insert the session
            $session = new Session();
            $session->setallAttribute($session_arr);
            $session->save();

            // make user session online
            self::updateLastActivity($session->id, $user->id);

            // return session object
            return $session;

        } catch (Exception $e) {
            // log
            return null;
        }
    }

    // initializing session object
    public static function createSessionArr($userObj){

        $session = [];
        $session['user_id'] = $userObj->id;
        $session['ip_address'] = '';
        $session['user_agent'] = '';
        $session['payload'] = md5($userObj->id . $userObj->username . microtime(true));
        $session['last_activity'] = config::$used;

        return $session;
    }

    // called when logging in and logging out
    // if its called by login the session will have value
    // if its called by logout the session will be null
    // if session is null : make the session 0 ( unused )
    // else if session exist : so the user is logging in : so make all session except this session offline as 0 ( unused )
    public static function updateLastActivity($Session_id, $user_id){

        // if session is null : make the session 0 ( unused )
        if($Session_id == null){
            $AllData = DB::table(self::$tableName)
                ->where(self::$tableName . '.' . self::$tbuser_id, '=', $user_id)
                ->update(['last_activity' => config::$unused]);
        } // else if session exist : so the user is logging in : so make all session except this session offline as 0 ( unused )
        else{
            $AllData = DB::table(self::$tableName)
                ->where(self::$tableName . '.' . self::$tbuser_id, '=', $user_id)
                ->where(self::$tableName . '.' . self::$tbid, '!=', $Session_id)
                ->update([
                    'last_activity' => config::$unused,
                    'updated_at' => Carbon::now()
                ]);
        }
    }
    //------------------------------------------------------------------------------------------------------------------
}
