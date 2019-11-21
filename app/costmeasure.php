<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class costmeasure extends Model
{
    public static $tableName = 'costmeasures';
    public static $tbid = 'id';
    public static $tbmeasureName = 'measureName';
    public static $tbcreated_at = 'created_at';
    public static $tbupdated_at = 'updated_at';


    public function setallAttribute($request){

        if(!is_array($request)){
            $this->measureName = $request->measureName;
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }else {
            $this->measureName = $request['measureName'];
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }
    }

    public static function getallAttribute($data){

        $result = [];
        $result[self::$tbid] = $data->id;
        $result[self::$tbmeasureName] = $data->measureName;
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
                'measureName' => $newObject->measureName,
                'updated_at' => Carbon::now(),
            ]);
    }

    public static function getCostMeasuresList($site_id){
        $Data = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '=', $site_id)
            ->get();
        return $Data;
    }

}
