<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\User;

class verificationcode extends Model
{

    public static $tableName = 'verificationcodes';
    public static $tbuser_id = 'user_id';
    public static $tbverificationcode = 'verificationcode';
    public static $tbused = 'used';
    public static $tbverifingtype = 'verifingtype';

    // $type : 0 -> object, 1 -> array
    // verifingtype : 1 -> verify registered user,   2 -> verifiy reseting password
    public function setallAttribute($request, $type){

        if ($type == 1) {
            $this->user_id = $request->user_id;
            $this->verificationcode = $request->verificationcode;
            $this->verifingtype = $request->verifingtype;
            $this->used = 0;
        }else if ($type == 2){
            $this->user_id = $request['user_id'];
            $this->verificationcode = $request['verificationcode'];
            $this->verifingtype = $request['verifingtype'];
            $this->used = 0;
        }
    }

    public static function getallAttribute($data){

        $result = [];

        $result[self::$tbuser_id] = $data->user_id;
        $result[self::$tbverificationcode] = $data->verificationcode;
        $result[self::$tbused] = $data->used;
        $result[self::$tbverifingtype] = $data->verifingtype;

        return $result;
    }

    // $verificationType  :  1 -> verify registered account,   2 -> verifiy resting password
    public static function compairVerificationCode($userObj, $verificationcode, $verificationType){

        $AllData = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbverifingtype, '=', $verificationType)
            ->where(self::$tableName . '.' . self::$tbuser_id, '=', $userObj->id)
            ->get();

//        dd($AllData);
        $msg = [];
        $msg['MsgNum'] = [];
        $msg['msg'] = '';
//        dd($AllData);
        foreach ($AllData as $verificationCode) {

            if ($verificationCode != null) {
                if ($verificationCode->used == 0) {
                    if ($verificationCode->verificationcode == $verificationcode) {
                        if (self::totalduration(Carbon::now(), $verificationCode->created_at, 5)) {
                            return [true, 'success'];
                        } else {
                            $msg = self::addErrorMsgStatement($msg, 0, 'verification code is not available now');
                        }
                    } else {
                        $msg = self::addErrorMsgStatement($msg, 1, 'wrong verification code');
                    }
                } else {
                    $msg = self::addErrorMsgStatement($msg, 2, 'verification code has been used priviously');
                }
            } else {
                $msg = self::addErrorMsgStatement($msg, 3, 'no verification code for this user');
            }
        }

        return [false, $msg['msg']];
    }

    public static function totalduration($startTiwe, $finishTime, $acceptedTime){

        $startTiwe = Carbon::parse($startTiwe);
        $finishTime = Carbon::parse($finishTime);

        $totalDuration = (int) ($finishTime->diffInSeconds($startTiwe) / 60);

        if($totalDuration <= $acceptedTime){
            return true;
        }
        return false;
    }

    // $verifingType :   1 -> verify registerd user,   2 -> verify reseting password
    public static function verifyAccount($verificationcode, $user, $verifingType, $newpassword){

        if($verifingType == 1){
            User::activateUser($user);
        }else if ($verifingType == 2){
            User::changePassword($user, $newpassword);
        }

        DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbverifingtype, '=', $verifingType)
            ->where(self::$tableName . '.' . self::$tbverificationcode, '=', $verificationcode)
            ->where(self::$tableName . '.' . self::$tbused, '=', 0)
            ->update([
                'used' => 1,
                'updated_at' => Carbon::now()
            ]);
    }

    public static function addErrorMsgStatement($errorMsg, $MsgNum, $msg){

        if(!in_array($MsgNum, $errorMsg['MsgNum'])) {
            array_push($errorMsg['MsgNum'], $MsgNum);
            if (strlen($errorMsg['msg']) > 0) {
                $errorMsg['msg'] .= ' or ' . $msg;
                return $errorMsg;
            } else {
                $errorMsg['msg'] = $msg;
                return $errorMsg;
            }
        }

    }

}
