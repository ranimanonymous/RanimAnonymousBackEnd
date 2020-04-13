<?php

namespace App\Http\Controllers\Auth\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

use App\Http\Controllers\Auth\Helper\config;
use App\Http\Controllers\Auth\Helper\SendMailable;
use App\Http\Controllers\Auth\Helper\message;

use App\Http\Controllers\Auth\Model\User;
use App\Http\Controllers\Auth\Model\Session;


class verificationcode extends Model
{

    // in this Model you will find :
    // functions that will be initiated always in the start of each Model
    //      setallAttribute
    //      getallAttribute
    // check functions
    //      totalduration
    // Actions functions
    //      compairVerificationCode
    //      setVerificationCodeAsUsed
    //      addErrorMsgStatement
    //      sendVerificationCode
    //      addVerificationCode

    // attributes of the Table
    public static $tableName = 'verificationcodes';
    public static $tbuser_id = 'user_id';
    public static $tbverificationcode = 'verificationcode';
    public static $tbused = 'used';
    public static $tbverifingtype = 'verifingtype';


    //------------------------------------------------------------------------------------------------------------------
    // functions that will be initiated always in the start of each Model
    //------------------------------------------------------------------------------------------------------------------

    // $type : 0 -> object, 1 -> array
    // verifingtype : 1 -> verify registered user,   2 -> verifiy reseting password
    // attribute that will be ised when inserting new object to this Model
    public function setallAttribute($request){
        if(!is_array($request)){
            $this->user_id = $request->user_id;
            $this->verificationcode = $request->verificationcode;
            $this->verifingtype = $request->verifingtype;
            $this->used = config::$unused; // 0
        }else {
            $this->user_id = $request['user_id'];
            $this->verificationcode = $request['verificationcode'];
            $this->verifingtype = $request['verifingtype'];
            $this->used = config::$unused; // 0
        }
    }

    // attribute that will be returned to frontend
    public static function getallAttribute($data){

        $result = [];

        $result[self::$tbuser_id] = $data->user_id;
        $result[self::$tbverificationcode] = $data->verificationcode;
        $result[self::$tbused] = $data->used;
        $result[self::$tbverifingtype] = $data->verifingtype;

        return $result;
    }

    //------------------------------------------------------------------------------------------------------------------



    //------------------------------------------------------------------------------------------------------------------
    // check functions
    //------------------------------------------------------------------------------------------------------------------

    // check if the session in accepted duration
    public static function totalduration($startTiwe, $finishTime, $acceptedTime){

        $startTiwe = Carbon::parse($startTiwe);
        $finishTime = Carbon::parse($finishTime);

        $totalDuration = (int) ($finishTime->diffInSeconds($startTiwe) / config::$minute); // 60

        if($totalDuration <= $acceptedTime){
            return true;
        }
        return false;
    }

    //------------------------------------------------------------------------------------------------------------------




    //------------------------------------------------------------------------------------------------------------------
    // Actions functions
    //------------------------------------------------------------------------------------------------------------------


    // $verificationType  :  1 -> verify registered account,   2 -> verifiy resting password

    // if user not exist : 'there are no availble VerificationCode for this user!'
    // if verification code used : 'verification code has been used priviously'
    // if verification code match :
    //      but not in accepted duration : 'verification code is not available now'
    //      in accepted duration : return [true, 'success']
    public static function compairVerificationCode($userObj, $verificationcode, $verificationType){

        // get all verification code to the user
        $AllData = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbverifingtype, '=', $verificationType)
            ->where(self::$tableName . '.' . self::$tbuser_id, '=', $userObj->id)
            ->get();

//        $msg = [];
        $msg['MsgNum'] = [];
        $msg['msg'] = '';

        if(sizeof($AllData) > 0) {
            foreach ($AllData as $verificationCode) {

                if ($verificationCode != null) {
                    if ($verificationCode->used == config::$unused) {
                        if ($verificationCode->verificationcode == $verificationcode) {
                            if (self::totalduration(Carbon::now(), $verificationCode->created_at, config::$safeDurationTime)) {

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
        }else{
            $msg = self::addErrorMsgStatement($msg, 3, 'there are no availble VerificationCode for this user!');
        }

        return [false, $msg['msg']];
    }

    // used in function (compairVerificationCode) to create error messege
    public static function addErrorMsgStatement($errorMsg, $MsgNum, $msg){
        try {
            if (!in_array($MsgNum, $errorMsg['MsgNum'])) {

                array_push($errorMsg['MsgNum'], $MsgNum);
                if (strlen($errorMsg['msg']) > 0) {
                    $errorMsg['msg'] .= ' or ' . $msg;
                    return $errorMsg;
                } else {
                    $errorMsg['msg'] = $msg;
                    return $errorMsg;
                }
            }else{
                return $errorMsg;
            }
        } catch (Exception $e) {
            dd($errorMsg);
        }
    }

    // $verifingType :   1 -> verify registerd user,   2 -> verify reseting password
    public static function setVerificationCodeAsUsed($verificationcode, $verifingType){
        DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbverifingtype, '=', $verifingType)
            ->where(self::$tableName . '.' . self::$tbverificationcode, '=', $verificationcode)
            ->where(self::$tableName . '.' . self::$tbused, '=', config::$unused) // 0
            ->update([
                'used' => config::$used,
                'updated_at' => Carbon::now()
            ]);
    }


    // check if user exist, not block, active
    // then add verification code
    public static function sendVerificationCode($request){

//        $user = new User();

        $user = User::getUserObject($request['username']);
        if($user != null){

            // if user is not blocked
            if(!User::checkBlockedUser($user)) {

                // if user is not verified
                if(
                    (
                        !User::checkActiveUser($user)
                        && $request['verificationType'] == config::$verification_type_of_verifingAccount
                    ) ||
                    (
                        User::checkActiveUser($user)
                        && $request['verificationType'] == config::$verification_type_of_resetingPassword
                    )
                ) {


                    $res = self::addVerificationCode($user, $request['verificationType']);

                    return message::getErrorObject('verificationCode_success');
                }else{
                    if($request['verificationType'] == config::$verification_type_of_resetingPassword) {
                        return message::getErrorObject('sendVerificationCodeResetingPasssword_unverified');
                    }else if($request['verificationType'] == config::$verification_type_of_verifingAccount) {
                        return message::getErrorObject('sendVerificationCodeRegistering_unverified');
                    }
                }
            }else{
                if($request['verificationType'] == config::$verification_type_of_resetingPassword) {
                    return message::getErrorObject('sendVerificationCodeResetingPasssword_Blocked');
                }else if($request['verificationType'] == config::$verification_type_of_verifingAccount) {
                    return message::getErrorObject('sendVerificationCodeRegistering_Blocked');
                }
            }
        }else{
            return message::getErrorObject('userNameNotExist');
        }
    }

    // $verificationType  :  1 -> verify registered account,   2 -> verifiy resting password
    // add verification code
    // send email verification code
    public static function addVerificationCode($user, $verificationType){

        try {

            $data = [];
            $data['user_id'] = $user->id;
            $data['verificationcode'] = mt_rand(100000, 999999);
            $data['verifingtype'] = $verificationType;
            $verificationcode = new verificationcode();
            $verificationcode->setallAttribute($data);
            $verificationcode->save();

            SendMailable::sendEmail($user->email, $user->firstName . ' ' . $user->lastName, $data['verificationcode']);


            return true;
        } catch (Exception $e) {
            // log
            return null;
            //-----------------------
//            return json_encode(User::packResponse(null, null, 400, $e->getMessage()));
        }
    }

    //------------------------------------------------------------------------------------------------------------------

}
