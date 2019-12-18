<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;



class indexedrealestate extends Model
{
    public static $tableName = 'indexedrealestates';
    public static $tbid = 'id';
    public static $tbtoken = 'token';
    public static $tbrealEstate_id = 'realEstate_id';
    public static $tbcreated_at = 'created_at';
    public static $tbupdated_at = 'updated_at';


    public function setallAttribute($request){

        if(!is_array($request)){
            $this->token = $request->token;
            $this->realEstate_id = $request->realEstate_id;
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }else {
            $this->token = $request['token'];
            $this->realEstate_id = $request['realEstate_id'];
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }
    }

    public static function getallAttribute($data){

        $result = [];
        $result[self::$tbtoken] = $data->token;
        $result[self::$tbrealEstate_id] = $data->realEstate_id;
        $result[self::$tbcreated_at] = $data->created_at;
        $result[self::$tbupdated_at] = $data->updated_at;

        return $result;
    }

    public static function  packResponse($data, $sessionKey, $code, $errorMsg){

        if($data != null) {
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
