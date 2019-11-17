<?php

namespace App;

use Laratrust\Models\LaratrustRole;

use DB;
use Carbon\Carbon;
use Model;

class Role extends LaratrustRole
{

    public static $tableName = 'roles';
    public static $tbid = 'id';
    public static $tbname = 'name';
    public static $tbdisplay_name = 'display_name';
    public static $tbdescription = 'description';
    public static $tbcreated_at = 'created_at';
    public static $tbupdated_at = 'updated_at';


    public function setallAttribute($request){

        if(!is_array($request)){
            $this->name = $request->name;
            $this->display_name = $request->display_name;
            $this->description = $request->description;
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }else {
            $this->name = $request['name'];
            $this->display_name = $request['display_name'];
            $this->description = $request['description'];
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }
    }

    public static function getallAttribute($data){

        $result = [];
        $result[self::$tbid] = $data->id;
        $result[self::$tbname] = $data->name;
        $result[self::$tbdisplay_name] = $data->display_name;
        $result[self::$tbdescription] = $data->description;
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

    public static function checkIfNameExist($name){

        $Data = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbname, '=', $name)
            ->first();

        if($Data != null){
            return true;
        }
        return false;

    }

//    public static function find($id){
//        $Data = DB::table(self::$tableName)
//            ->where(self::$tableName . '.' . self::$tbid, '=', $id)
//            ->first();
//        return $Data;
//    }

    public static function edit($newObject){
        DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '=', $newObject->id)
            ->update([
                'name' => $newObject->name,
                'display_name' => $newObject->display_name,
                'description' => $newObject->description,
            ]);
    }

    public static function RoleExist($id){

        $Data = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '=', $id)
            ->count();
        if($Data > 0){
            return true;
        }
        return false;
    }

    public static function remove($id)
    {
        DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '=', $id)
            ->delete();
    }

    public static function getAllRole(){
        $Data = DB::table(self::$tableName)
            ->get()->toArray();

        return $Data;
    }
}
