<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Carbon\Carbon;


class User extends Authenticatable
{

    public static $tableName = 'users';
    public static $tbid = 'id';
    public static $tbusername = 'username';
    public static $tbpassword = 'password';
    public static $tbverified = 'verified';
    public static $tbcreated_at = 'created_at';
    public static $tbupdated_at = 'updated_at';


    public function setallAttribute($request, $type){

        if ($type == 0) {
            $this->username = $request->username;
            $this->password = $request->password;
            $this->verified = 0;
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }else if ($type == 1){
            $this->username = $request['username'];
            $this->password = $request['password'];
            $this->verified = 0;
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }
    }

    public static function getallAttribute($data){

        $result = [];

        $result[self::$tbid] = $data->id;
        $result[self::$tbusername] = $data->username;
//        $result[self::$tbpassword] = $data->password;
        $result[self::$tbverified] = $data->verified;
//        $result[self::$tbcreated_at] = $data->created_at;
//        $result[self::$tbupdated_at] = $data->updated_at;

        return $result;
    }

    public static function  packResponse($data, $sessionKey, $code, $errorMsg){

        if($data != null) {
            $data = self::getallAttribute($data);

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
            $Result['errorMsg'] = '';
        }else{
            $Result['errorMsg'] = $errorMsg;
        }

        return $Result;
    }

    public static function getUserByUserName($userName){

        $Data = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbusername, '=', $userName)
            ->first();

        return $Data;
    }

    public static function compairPasswordd($user, $password){

        $Data = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbusername, '=', $user->username)
            ->first();

        if($Data != null){
            if($user->password == $password){
                return true;
            }
        }

        return false;
    }

    public static function CheckAdding($object){
        // check username
        if(self::getUserByUserName($object->username) == null){
            return [true, 'success'];
        }else {
            return [false, 'username exist'];
        }
    }

    public static function activateUser($user){

        DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '=', $user->id)
            ->update([
                'verified' => 1,
                'updated_at' => Carbon::now()
            ]);

    }

    public static function changePassword($user, $newpassword){

        DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '=', $user->id)
            ->update([
                'Password' => $newpassword,
                'updated_at' => Carbon::now()
            ]);

    }

    public static function checkActiveUser($user){

        $Data = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '=', $user->id)
            ->first();

        if($Data != null) {
            if ($Data->verified == 1) {
                return true;
            }
        }
        return false;
    }
}
