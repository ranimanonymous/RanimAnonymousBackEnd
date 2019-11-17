<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class log extends Model
{
    public static $tableName = 'logs';
    public static $tbid = 'id';
    public static $tbuser_id = 'user_id';
    public static $tbaction_id = 'action_id';
    public static $tbrequestBody = 'requestBody';
    public static $tbrequestHeader = 'requestHeader';
    public static $tbdevice_id = 'device_id';
    public static $tbip = 'ip';
    public static $tbcode = 'code';
    public static $tbMsg = 'Msg';
    public static $tbdelay_time = 'delay_time';
    public static $tbcreated_at = 'created_at';
    public static $tbupdated_at = 'updated_at';


    public function setallAttribute($request){
        if (is_array($request)) {
            $this->user_id = $request['user_id'];
            $this->action_id = $request['action_id'];
            $this->requestBody = $request['requestBody'];
            $this->requestHeader = $request['requestHeader'];
            $this->device_id = $request['device_id'];
            $this->ip = $request['ip'];
            $this->code = $request['code'];
            $this->Msg = $request['Msg'];
            $this->delay_time = $request['delay_time'];
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        } else {
            $this->user_id = $request->user_id;
            $this->action_id = $request->action_id;
            $this->requestBody = $request->requestBody;
            $this->requestHeader = $request->requestHeader;
            $this->device_id = $request->device_id;
            $this->ip = $request->ip;
            $this->code = $request->code;
            $this->Msg = $request->Msg;
            $this->delay_time = $request->delay_time;
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }
    }

    public static function getallAttribute($data){

        $result = [];
        $result[self::$tbid] = $data->id;
        $result[self::$tbuser_id] = $data->user_id;
        $result[self::$tbaction_id] = $data->action_id;
        $result[self::$tbrequestBody] = $data->requestBody;
        $result[self::$tbrequestHeader] = $data->requestHeader;
        $result[self::$tbdevice_id] = $data->device_id;
        $result[self::$tbip] = $data->ip;
        $result[self::$tbcode] = $data->code;
        $result[self::$tbMsg] = $data->Msg;
        $result[self::$tbdelay_time] = $data->delay_time;
        $result[self::$tbcreated_at] = $data->created_at;
        $result[self::$tbupdated_at] = $data->updated_at;

        return $result;
    }

    public static function  packResponse($data, $sessionKey, $code, $errorMsg){

        if($data != null) {
            if(is_array($data)){
                $arr = [];
                foreach ($data as $item){
                    array_push($arr, self::getallAttribute($item));
                }
                $data = $arr;
            }else{
                $data = self::getallAttribute($data);
            }
            $Result = [];

            $Result['data'] = $data;
        }else{
            $Result['data'] = null;
        }
        if($sessionKey != null) {
            $Result['data']['sessionkey'] = $sessionKey;
        }

        $Result['code'] = $code;

        if($errorMsg == null){
            $Result['Msg'] = '';
        }else{
            $Result['Msg'] = $errorMsg;
        }

        return $Result;
    }
}
