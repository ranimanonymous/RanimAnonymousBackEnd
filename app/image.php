<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class image extends Model
{
    public static $tableName = 'images';
    public static $tbid = 'id';
    public static $tbrealEstate_id = 'realEstate_id';
    public static $tbname = 'name';
    public static $tbcreated_at = 'created_at';
    public static $tbupdated_at = 'updated_at';


    public function setallAttribute($request){

        if(!is_array($request)){
            $this->realEstate_id = $request->realEstate_id;
            $this->name = $request->name;
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }else {
            $this->realEstate_id = $request['realEstate_id'];
            $this->name = $request['name'];
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }
    }

    public static function getallAttribute($data){

        $result = [];
        $result[self::$tbid] = $data->id;
        $result[self::$tbrealEstate_id] = $data->realEstate_id;
        $result[self::$tbname] = $data->name;
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

    public static function getImageLists($GSMstring){
        return explode("&",$GSMstring['images']);

    }


}
