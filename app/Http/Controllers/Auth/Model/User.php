<?php

namespace App\Http\Controllers\Auth\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

use DB;
use Carbon\Carbon;

use App\Http\Controllers\Auth\Helper\config;
use App\Http\Controllers\Auth\Helper\message;

use App\Http\Controllers\Auth\Model\Session;
use App\Http\Controllers\Auth\Model\verificationcode;

use App\helper;

class User extends Authenticatable
{
    use LaratrustUserTrait;

    // in this Model you will find :
    // functions that will be initiated always in the start of each Model
    //      setallAttribute
    //      getallAttribute
    //      packResponse
    //      Greturn
    // insert & Edit functions
    //      addUser
    //      edit
    // Get functions
    //      getUserObject
    //      getUserProfile
    //      getUserByUserName
    //      getUserBySession
    //      getUserIdBySession
    // check functions
    //      checkActiveUser
    //      checkBlockedUser
    //      compairPasswordd
    //      CheckIfUserExist
    // Actions functions
    //      verify
    //      activateUser
    //      changePassword

    // attributes of the Table
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

    //------------------------------------------------------------------------------------------------------------------
    // functions that will be initiated always in the start of each Model
    //------------------------------------------------------------------------------------------------------------------

    // attribute that will be ised when inserting new object to this Model
    public function setallAttribute($request){

        if(!is_array($request)){
            $this->username = $request->username;
            $this->firstName = $request->firstName;
            $this->lastName = $request->lastName;
            $this->email = $request->email;
            $this->bornDate = $request->bornDate;
            $this->phone = $request->phone;
//            $this->image = $request->image;
            $this->password = $request->password;
        }else {
            $this->username = $request['username'];
            $this->firstName = $request['firstName'];
            $this->lastName = $request['lastName'];
            $this->email = $request['email'];
            $this->bornDate = $request['bornDate'];
            $this->phone = $request['phone'];
//            $this->image = $request['image'];
            $this->password = $request['password'];
        }

        if(config::$verify_without_email){
            $this->verified = config::$verified; // 1
        }else{
            $this->verified = config::$unverified; // 0
        }
        $this->blocked = 0;
        $this->created_at = Carbon::now();
        $this->updated_at = Carbon::now();

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
//        $result[self::$tbimage] = $data->image;
//        $result[self::$tbpassword] = $data->password;
        $result[self::$tbverified] = $data->verified;
//        $result[self::$tbblocked] = $data->blocked;
//        $result[self::$tbcreated_at] = $data->created_at;
//        $result[self::$tbupdated_at] = $data->updated_at;

        return $result;
    }

    // // packaging the response
    public static function packResponse($data, $sessionKey, $code, $errorMsg){

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

    // insert into log
    // packaging the response
    public static function Greturn($data, $sessionKey, $request, $action, $startTime, $msg, $userId = 0){

        // insert into log
        helper::insertIntoLog(helper::BuildLogObject(
            $msg['code'],
            $msg['msg'],
            $userId,
            $action,
            microtime(true) - $startTime,
            $request
        ));

        // packaging the response
        return json_encode(self::packResponse(
            $data,
            $sessionKey,
            $msg['code'],
            $msg['msg']
        ));
    }
    //------------------------------------------------------------------------------------------------------------------



    //------------------------------------------------------------------------------------------------------------------
    // insert & Edit functions
    //------------------------------------------------------------------------------------------------------------------

    // called by Auth\Controllers\registerController
    // return user object
    public static function addUser($object){

        try{
            $user = new User();
            $user->setallAttribute($object);
            $user->save();

            return $user;

        } catch (Exception $e) {
            return null;
        }
    }

    // called by Auth\Controllers\editUserController
    // return $response as a string, if there is an error, $response will have error messege, if it success it will return ''
    public static function edit($newObject){
        $object = $newObject->all();
        $userName = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '!=', $object['user_id'])
            ->where(self::$tableName . '.' . self::$tbusername, '=', $object['username'])
            ->get();

        $email = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '!=', $object['user_id'])
            ->Where(self::$tableName . '.' . self::$tbemail, '=', $object['email'])
            ->get();

        $phone = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '!=', $object['user_id'])
            ->Where(self::$tableName . '.' . self::$tbphone, '=', $object['phone'])
            ->get();

        $response = '';
        if(sizeof($userName) > 0 || sizeof($email) > 0 || sizeof($phone) > 0){
            if(sizeof($userName) > 0){
                $response .= 'repeated username, ';
            }
            if(sizeof($email) > 0){
                $response .= 'repeated email, ';
            }
            if(sizeof($phone) > 0){
                $response .= 'repeated phone, ';
            }
        }else {
            $res = DB::table(self::$tableName)
                ->where(self::$tableName . '.' . self::$tbid, '=', $object['user_id'])
                ->update([
                    'username' => $object['username'],
                    'firstName' => $object['firstName'],
                    'lastName' => $object['lastName'],
                    'email' => $object['email'],
                    'bornDate' => $object['bornDate'],
                    'phone' => $object['phone'],
                    'image' => $object['image'],
                    'updated_at' => Carbon::now(),
                ]);
        }
        return $response;
    }

    //------------------------------------------------------------------------------------------------------------------




    //------------------------------------------------------------------------------------------------------------------
    // Get functions
    //------------------------------------------------------------------------------------------------------------------

    // called by Auth\Controllers\loginController
    // get user object by username
    // note that username can be : number, email, username
    public static function getUserObject($input){

        // get user object if its number phone
        if(is_numeric($input)){
            $user = self::where('phone', $input)->first();

        }// get user object if its email
        else if (strpos($input, '@') !== false && strpos($input, '.com') !== false){
            $user = self::where('email', $input)->first();

        }// get user object if its username
        else{
            $user = self::where('username', $input)->first();
        }

        return $user;
    }

    // called by Auth\Controllers\getUserProfileController
    // get user profile date by user id
    // **user should be :
    // 1 - not blocked
    // 2 - verified
    public static function getUserProfile($user_id){
        $Data = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '=', $user_id)
            ->where(self::$tableName . '.' . self::$tbblocked, '=', config::$unblocked) // 0
            ->where(self::$tableName . '.' . self::$tbverified, '=', config::$verified) // 1
            ->select(
                self::$tableName . '.' . self::$tbusername,
                self::$tableName . '.' . self::$tbfirstName,
                self::$tableName . '.' . self::$tblastName,
                self::$tableName . '.' . self::$tbemail,
                self::$tableName . '.' . self::$tbbornDate
//                self::$tableName . '.' . self::$tbverified
//                self::$tableName . '.' . self::$tbimage
            )
            ->get();

        if(sizeof($Data) >= 0){
            return $Data[0];
        }
        return null;
    }

    // called by Auth\Controllers\resetPasswordController
    public static function getUserByUserName($userName){

        $Data = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbusername, '=', $userName)
            ->first();

        return $Data;
    }

    // called by Auth\Controllers\changePasswordController
    // called by Auth\Controllers\editUserController
    // called by Auth\Controllers\getUserProfileController
    // called by Auth\Controllers\logoutController
    // return the user object if the session exist, or return null
    public static function getUserBySession($userSession){

        $id = self::getUserIdBySession($userSession);
        if($id != null) {
            $Data = DB::table(self::$tableName)
                ->where(self::$tableName . '.' . self::$tbid, '=', $id)
                ->first();

            if($Data != null) {
                return $Data;
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    // return user ID by his session
    public static function getUserIdBySession($userSession){
        $Data = DB::table(Session::$tableName)
            ->where(Session::$tableName . '.' . Session::$tbpayload, '=', $userSession)
            ->select(Session::$tableName . '.' . Session::$tbuser_id)
            ->first();
        if($Data != null) {
            return $Data->user_id;
        }else{
            return null;
        }
    }

    //------------------------------------------------------------------------------------------------------------------




    //------------------------------------------------------------------------------------------------------------------
    // check functions
    //------------------------------------------------------------------------------------------------------------------

    // check if the user is Active by user object
    // return true if user is Active, false if its not Active
    public static function checkActiveUser($user){

        $Data = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '=', $user->id)
            ->first();

        if($Data != null) {
            if ($Data->verified == config::$verified) { // 1
                return true;
            }
        }
        return false;
    }

    // check if the user is blocked by user object
    // return true if user blocked, false if its not blocked
    public static function checkBlockedUser($user){
        $Data = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '=', $user->id)
            ->first();

        if($Data != null) {
            if ($Data->blocked == config::$blocked) { // 1
                return true;
            }
        }
        return false;
    }

    // check if password is match ( correct )
    // return true if password is correct, false if its not correct
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

    // check if user exist
    // return [true, 'success'] if the user ( that we want to add it is new )
    // return [false, 'phone exist'] if we chose repeated number phone
    // return [false, 'email exist'] if we chose repeated email
    // return [false, 'username exist'] if we chose repeated username
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

    //------------------------------------------------------------------------------------------------------------------




    //------------------------------------------------------------------------------------------------------------------
    // Actions functions
    //------------------------------------------------------------------------------------------------------------------

    // this verify function used for verify two things :
    //      registering new account
    //      reseting password
    // return error objects :
    //      if user not exist : 'userNameNotExist'
    //      if user blocked :
    //              if reseting password : 'VerifyResetingPassword_Blocked'
    //              if registering new account : 'VerifyAccount_verifiedbefore'
    //      if user not active and reset password : 'VerifyResetingPassword_unverified'
    //      if user active and registering new account : 'VerifyAccount_verifiedbefore'
    //      if verification code not match : 'GeneralError' with specific error messege
    //      if every thing correct return : 'VerifyAccount_success'
    //
    // get user object if exist
    // compair verification code
    // if registering new account : activate user
    // if reseting password : change password
    // set verification code as used, to make it not applicable to use it again
    // return success messege 'VerifyAccount_success'
    public static function verify($request){

        $user = new User();

        // get user object if exist
        $user = self::getUserObject($request['username']);

        // if user exist
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

                    // this function will return
                    // [0] true or false if verification code is match or not
                    // [1] error messege if verification code not match
                    $validityOfVerificationCode = verificationcode::compairVerificationCode($user, $request['verificationcode'], $request['verificationType']);

                    if ($validityOfVerificationCode[0]) {

                        if($request['verificationType'] == config::$verification_type_of_verifingAccount){ // 1
                            self::activateUser($user);
                        }else if ($request['verificationType'] == config::$verification_type_of_resetingPassword){ // 2
                            self::changePassword($user, $request['newpassword']);
                        }
                        // set verification code as used, to make it not applicable to use it again
                        verificationcode::setVerificationCodeAsUsed($request['verificationcode'], $request['verificationType']);

                        return message::getErrorObject('VerifyAccount_success');
                    } else {

                        $errorObject = message::getErrorObject('GeneralError');
                        $errorObject['msg'] = $validityOfVerificationCode[1];
                        return $errorObject;
                    }
                }else{
                    if($request['verificationType'] == config::$verification_type_of_resetingPassword) {
                        return message::getErrorObject('VerifyResetingPassword_unverified');
                    }else if($request['verificationType'] == config::$verification_type_of_verifingAccount) {
                        return message::getErrorObject('VerifyAccount_verifiedbefore');
                    }
                }
            }else{
                if($request['verificationType'] == config::$verification_type_of_resetingPassword) {
                    return message::getErrorObject('VerifyResetingPassword_Blocked');
                }else if($request['verificationType'] == config::$verification_type_of_verifingAccount) {
                    return message::getErrorObject('VerifyAccount_Blocked');
                }
            }
        }else{
            return message::getErrorObject('userNameNotExist');
        }
    }

    // activate user
    // make the verified attribute from 0 -> 1
    // called by the preivous function ( verify )
    public static function activateUser($user){

        DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '=', $user->id)
            ->update([
                'verified' => config::$verified,
                'updated_at' => Carbon::now()
            ]);

    }

    // change Password by User Object
    public static function changePassword($user, $newpassword){

        DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '=', $user->id)
            ->update([
                'Password' => $newpassword,
                'updated_at' => Carbon::now()
            ]);

    }


    //------------------------------------------------------------------------------------------------------------------


}
