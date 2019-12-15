<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Carbon\Carbon;
use Laratrust\Traits\LaratrustUserTrait;


class User extends Authenticatable
{
    use LaratrustUserTrait;

    public static $tableName = 'users';
    public static $tbid = 'id';
    public static $tbusername = 'username';
    public static $tbfirstName = 'firstName';
    public static $tblastName = 'lastName';
    public static $tbemail = 'email';
    public static $tbbornDate = 'bornDate';
    public static $tbphone = 'phone';
    public static $tbimage = 'image';
    public static $tbpassword = 'password';
    public static $tbverified = 'verified';
    public static $tbblocked = 'blocked';
    public static $tbcreated_at = 'created_at';
    public static $tbupdated_at = 'updated_at';


    public function setallAttribute($request){

        if(!is_array($request)){
            $this->username = $request->username;
            $this->firstName = $request->firstName;
            $this->lastName = $request->lastName;
            $this->email = $request->email;
            $this->bornDate = $request->bornDate;
            $this->phone = $request->phone;
            $this->image = $request->image;
            $this->password = $request->password;
            $this->verified = 0;
            $this->blocked = 0;
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }else {
            $this->username = $request['username'];
            $this->firstName = $request['firstName'];
            $this->lastName = $request['lastName'];
            $this->email = $request['email'];
            $this->bornDate = $request['bornDate'];
            $this->phone = $request['phone'];
            $this->image = $request['image'];
            $this->password = $request['password'];
            $this->verified = 0;
            $this->blocked = 0;
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }
    }

    // attribute that will be returned to frontend
    public static function getallAttribute($data){

        $result = [];

        $result[self::$tbid] = $data->id;
        $result[self::$tbusername] = $data->username;
        $result[self::$tbfirstName] = $data->firstName;
        $result[self::$tblastName] = $data->lastName;
        $result[self::$tbemail] = $data->email;
        $result[self::$tbbornDate] = $data->bornDate;
        $result[self::$tbphone] = $data->phone;
        $result[self::$tbimage] = $data->image;
//        $result[self::$tbpassword] = $data->password;
        $result[self::$tbverified] = $data->verified;
//        $result[self::$tbblocked] = $data->blocked;
//        $result[self::$tbcreated_at] = $data->created_at;
//        $result[self::$tbupdated_at] = $data->updated_at;

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

    public static function edit($newObject){
        DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '=', $newObject->id)
            ->update([
                'username' => $newObject->username,
                'firstName' => $newObject->firstName,
                'lastName' => $newObject->lastName,
                'email' => $newObject->email,
                'bornDate' => $newObject->bornDate,
                'phone' => $newObject->phone,
                'image' => $newObject->image,
                'updated_at' => Carbon::now(),
            ]);
    }

    public static function getUserByUserName($userName){

        $Data = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbusername, '=', $userName)
            ->first();

        return $Data;
    }

    public static function getUserBySession($userSession){

        $id = Session::getUserIdBySession($userSession);

        $Data = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '=', $id)
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

    public static function CheckIfUserExist($object){
        // check username
        if(!self::getUserByUserName($object->username)){
            // check email
            if(!User::where('email', $object->email)->first()){
                // check phone
                if(!User::where('phone', $object->phone)->first()){
                    return [true, 'success'];
                }else{
                    return [false, 'phone exist'];
                }
            }else{
                return [false, 'email exist'];
            }
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

    public static function getUserProfile($user_id){
        $Data = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '=', $user_id)
            ->where(self::$tableName . '.' . self::$tbblocked, '=', 0)
            ->select(
                self::$tableName . '.' . self::$tbusername,
                self::$tableName . '.' . self::$tbfirstName,
                self::$tableName . '.' . self::$tblastName,
                self::$tableName . '.' . self::$tbemail,
                self::$tableName . '.' . self::$tbbornDate,
                self::$tableName . '.' . self::$tbverified,
                self::$tableName . '.' . self::$tbimage
            )
            ->get();

        return $Data[0];

    }
}
