<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class sizemeasure extends Model
{
    public static $tableName = 'sizemeasures';
    public static $tbid = 'id';
    public static $tbsizeName = 'sizeName';
    public static $tbcreated_at = 'created_at';
    public static $tbupdated_at = 'updated_at';


    public function setallAttribute($request){

        if(!is_array($request)){
            $this->sizeName = $request->sizeName;
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }else {
            $this->realEstate_id = $request['realEstate_id'];
            $this->GSM = $request['GSM'];
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }
    }

    public static function getallAttribute($data){

        $result = [];
        $result[self::$tbid] = $data->id;
        $result[self::$tbsizeName] = $data->sizeName;
        $result[self::$tbcreated_at] = $data->created_at;
        $result[self::$tbupdated_at] = $data->updated_at;

        return $result;
    }

    public static function  packResponse($data, $code, $errorMsg){


        $Result['data'] = $data;

        $Result['code'] = $code;

        if($errorMsg == null){
            $Result['Msg'] = '';
        }else{
            $Result['Msg'] = $errorMsg;
        }
        return $Result;
    }

    public static function edit($newObject){

        DB::table(self::$tableName)
            ->where(self::$tableName    . '.' . self::$tbid, '=', $newObject->measureId)
            ->update([
                'sizeName' => $newObject->sizeName,
                'updated_at' => Carbon::now(),
            ]);
    }

    public static function getSizeMeasuresList($size_id){
        $Data = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '=', $size_id)
            ->get();
        return $Data;
    }

}
