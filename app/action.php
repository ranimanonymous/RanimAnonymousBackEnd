<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class action extends Model
{
    public static $tableName = 'actions';
    public static $tbid = 'id';
    public static $tbActionName = 'ActionName';
    public static $tbcreated_at = 'created_at';
    public static $tbupdated_at = 'updated_at';


    public function setallAttribute($request){

        if(!is_array($request)){
            $this->ActionName = $request->ActionName;
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }else {
            $this->ActionName = $request['ActionName'];
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }
    }

    public static function getallAttribute($data){

        $result = [];
        $result[self::$tbid] = $data->id;
        $result[self::$tbActionName] = $data->ActionName;
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

    public static function getActionIdByActioName($actionName){
        $data = DB::table(self::$tableName)
            ->where(self::$tableName    . '.' . self::$tbActionName, '=', $actionName)
            ->get()->first();
        if($data == null){
            $parameter['ActionName'] = $actionName;

            $action = new action();
            $action->add($action, $parameter);

            return $action->id;
        }else{
            return $data->id;
        }
    }

    public function add($action, $parameter){
        $action->setallAttribute($parameter);
        $action->save();
    }


}
