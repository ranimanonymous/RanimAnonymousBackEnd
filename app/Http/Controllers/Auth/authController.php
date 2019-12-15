<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json;


use App\User;
use App\Session;
use App\verificationcode;
use App\helper;

class authController extends Controller
{
    // applied
    public function login(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'login';
        //-----------------------

        $user = new User();

        // $request['username'] may be name or email or number
        $user = self::getUserObject($request['username']);

        if ($user != null) {

            if(User::checkActiveUser($user)) {

                if (User::compairPasswordd($user, $request['password'])) {

                    $session = self::generateSession($user);

                    // log
                    $MSG = 'welcome';
                    $code = 200;
                    helper::insertIntoLog(helper::BuildLogObject(
                        $code,
                        $MSG,
                        0,
                        $action,
                        microtime(true) - $startTime,
                        $request
                    ));
                    //-----------------------
                    return json_encode(User::packResponse($user, $session->payload, $code, $MSG));

                } else {

                    // log
                    $MSG = 'wrong Password!';
                    $code = 400;
                    helper::insertIntoLog(helper::BuildLogObject(
                        $code,
                        $MSG,
                        0,
                        $action,
                        microtime(true) - $startTime,
                        $request
                    ));
                    //-----------------------
                    return json_encode(User::packResponse(null, null, $code, $MSG));
                }
            } else {

                // log
                $MSG = 'you need to verify your account before logging in!';
                $code = 400;
                helper::insertIntoLog(helper::BuildLogObject(
                    $code,
                    $MSG,
                    0,
                    $action,
                    microtime(true) - $startTime,
                    $request
                ));
                //-----------------------
                return json_encode(User::packResponse(null, null, $code, $MSG));
            }
        }else{

            // log
            $MSG = 'userName is not exist!';
            $code = 400;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                0,
                $action,
                microtime(true) - $startTime,
                $request
            ));
            //-----------------------
            return json_encode(User::packResponse(null, null, $code, $MSG));
        }
    }

    // applied
    public function register(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'register';
        //-----------------------


        $validity = User::CheckIfUserExist($request);

        if($validity[0]) {


            $user = self::addUser($request);

            self::addVerificationCode($user, 1);

            // log
            $MSG = 'you have been registered successfuly';
            $code = 200;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                0,
                $action,
                microtime(true) - $startTime,
                $request
            ));
            //-----------------------
            return json_encode(User::packResponse($user, null, $code, $MSG));
        }else{

            // log
            $MSG = $validity[1];
            $code = 400;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                0,
                $action,
                microtime(true) - $startTime,
                $request
            ));
            //-----------------------
            return json_encode(User::packResponse(null, null, $code, $MSG));
        }
    }

    public function editUser(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'editUser';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        if ($user != null) {

            User::edit($request);

            // log
            $MSG = 'user has been edited successfuly!';
            $code = 200;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                $request['user_id'],
                $action,
                microtime(true) - $startTime,
                $request
            ));
            //-----------------------
            return json_encode(User::packResponse(null, null, $code, $MSG));
        }else{

            // log
            $MSG = 'userName is not exist!';
            $code = 400;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                $request['user_id'],
                $action,
                microtime(true) - $startTime,
                $request
            ));
            //-----------------------
            return json_encode(User::packResponse(null, null, $code, $MSG));
        }
    }

    // applied
    // logging out user from last active session - no checking on session
    public function logout(Request $request){

        // start timer
        $startTime = microtime(true);
        $action = 'logout';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        if($user){

            Session::updateLastActivity(null, $user->id);

            // log
            $MSG = 'success!';
            $code = 200;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                $request['user_id'],
                $action,
                microtime(true) - $startTime,
                $request
            ));
            //-----------------------
            return json_encode(User::packResponse(null, null, $code, $MSG));
        }else{

            // log
            $MSG = 'userName is not exist!';
            $code = 400;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                $request['user_id'],
                $action,
                microtime(true) - $startTime,
                $request
            ));
            //-----------------------
            return json_encode(User::packResponse(null, null, $code, $MSG));
        }

    }

    public function getUserProfile(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'getUserProfile';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        if ($user != null) {

            User::getUserProfile($request['user_id']);

            // log
            $MSG = 'success!';
            $code = 200;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                $request['user_id'],
                $action,
                microtime(true) - $startTime,
                $request
            ));
            //-----------------------
            return json_encode(User::packResponse(null, null, $code, $MSG));
        }else{

            // log
            $MSG = 'userName is not exist!';
            $code = 400;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                $request['user_id'],
                $action,
                microtime(true) - $startTime,
                $request
            ));
            //-----------------------
            return json_encode(User::packResponse(null, null, $code, $MSG));
        }
    }


    public function verifyAccount(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'verifyAccount';
        //-----------------------

        // $verifingType :   1 -> verify registerd user,   2 -> verify reseting password
        $request['verificationType'] = 1;
        $request['newpassword'] = null;
        $returnObect = self::verify($request);

        // log
        helper::insertIntoLog(helper::BuildLogObject(
            $returnObect['code'],
            $returnObect['Msg'],
            0,
            $action,
            microtime(true) - $startTime,
            $request
        ));
        //-----------------------
        return json_encode($returnObect);

    }

    public function verifyRestingPassword(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'verifyRestingPassword';
        //-----------------------

        // $verifingType :   1 -> verify registerd user,   2 -> verify reseting password
        $request['verificationType'] = 2;
        // $request['newpassword'] will be inside the request
        $returnObect = self::verify($request);

        // log
        helper::insertIntoLog(helper::BuildLogObject(
            $returnObect['code'],
            $returnObect['Msg'],
            0,
            $action,
            microtime(true) - $startTime,
            $request
        ));
        //-----------------------
        return json_encode($returnObect);

    }

    public function sendVerificationCodeRegistering(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'sendVerificationCodeRegistering';
        //-----------------------

        // $verifingType :   1 -> verify registerd user,   2 -> verify reseting password
        $request['verificationType'] = 1;
        $returnObect = self::sendVerificationCode($request);

        // log
        helper::insertIntoLog(helper::BuildLogObject(
            $returnObect['code'],
            $returnObect['Msg'],
            0,
            $action,
            microtime(true) - $startTime,
            $request
        ));
        //-----------------------
        return json_encode($returnObect);
    }

    public function sendVerificationCodeResetingPasssword(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'sendVerificationCodeResetingPasssword';
        //-----------------------

        // $verifingType :   1 -> verify registerd user,   2 -> verify reseting password
        $request['verificationType'] = 2;
        $returnObect = self::sendVerificationCode($request);

        // log
        helper::insertIntoLog(helper::BuildLogObject(
            $returnObect['code'],
            $returnObect['Msg'],
            0,
            $action,
            microtime(true) - $startTime,
            $request
        ));
        //-----------------------
        return json_encode($returnObect);
    }

    public function resetPassword(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'resetPassword';
        //-----------------------

        $user = User::getUserByUserName($request['username']);

        if($user != null){

            self::addVerificationCode($user, 2);

            // log
            $MSG = 'your password has been reset successfuly!';
            $code = 200;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                0,
                $action,
                microtime(true) - $startTime,
                $request
            ));
            //-----------------------
            return json_encode(User::packResponse(null, null, $code, $MSG));
        }else{

            // log
            $MSG = 'userName is not exist!';
            $code = 400;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                0,
                $action,
                microtime(true) - $startTime,
                $request
            ));
            //-----------------------
            return json_encode(User::packResponse(null, null, $code, $MSG));
        }

    }

    public function changePassword(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'changePassword';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------


        if(User::checkActiveUser($user)) {
            if ($user != null) {
                if (User::compairPasswordd($user, $request['password'])) {

                    User::changePassword($user, $request['newpassword']);


                    // log
                    $MSG = 'password has been changed successfuly!';
                    $code = 200;
                    helper::insertIntoLog(helper::BuildLogObject(
                        $code,
                        $MSG,
                        $request['user_id'],
                        $action,
                        microtime(true) - $startTime,
                        $request
                    ));
                    //-----------------------
                    return json_encode(User::packResponse(null, null, $code, $MSG));
                } else {

                    // log
                    $MSG = 'wrong Password!';
                    $code = 400;
                    helper::insertIntoLog(helper::BuildLogObject(
                        $code,
                        $MSG,
                        $request['user_id'],
                        $action,
                        microtime(true) - $startTime,
                        $request
                    ));
                    //-----------------------
                    return json_encode(User::packResponse(null, null, $code, $MSG));
                }
            } else {

                // log
                $MSG = 'userName is not exist!';
                $code = 400;
                helper::insertIntoLog(helper::BuildLogObject(
                    $code,
                    $MSG,
                    $request['user_id'],
                    $action,
                    microtime(true) - $startTime,
                    $request
                ));
                //-----------------------
                return json_encode(User::packResponse(null, null, $code, $MSG));
            }
        }else{

            // log
            $MSG = 'you need to verify your account before logging in!';
            $code = 400;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                $request['user_id'],
                $action,
                microtime(true) - $startTime,
                $request
            ));
            //-----------------------
            return json_encode(User::packResponse(null, null, $code, $MSG));
        }
    }

    //------------------------------------------------
    // helper method
    //------------------------------------------------
    //------------------------------------------------

    public function verify($request){

        //        dd($request->all());
        $user = new User();

        $user = self::getUserObject($request['username']);

        if($user != null){

            $validityOfVerificationCode = verificationcode::compairVerificationCode($user, $request['verificationcode'], $request['verificationType']);

            if($validityOfVerificationCode[0]){

                verificationcode::verifyAccount($request['verificationcode'], $user, $request['verificationType'], $request['newpassword']);

                return User::packResponse(null, null, 200, 'your account has been verified successfuly!');
            }else{
                return User::packResponse(null, null, 400, $validityOfVerificationCode[1]);
            }

        }else{
            return User::packResponse(null, null, 400, 'userName is not exist!');
        }
    }

    public function sendVerificationCode($request){

        $user = new User();

        $user = self::getUserObject($request['username']);

        if($user != null){

            self::addVerificationCode($user, $request['verificationType']);

            return User::packResponse(null, null, 200, 'the verification code has been sent to you successfuly!');
        }else{
            return User::packResponse(null, null, 400, 'userName is not exist!');
        }
    }

    public function generateSession($user){
        try{
            $session_arr = Session::generateSession($user);
            $session = new Session();
            $session->setallAttribute($session_arr);
            $session->save();
            Session::updateLastActivity($session->id, $user->id);

            return $session;

        } catch (Exception $e) {
            // log
            $MSG = 'requested function';
            $code = 400;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                0,
                'generateSession',
                -1,
                -1
            ));
            //-----------------------
//            return json_encode(User::packResponse(null, null, 400, $e->getMessage()));
        }
    }

    public function addUser($object){

        try{

            $user = new User();
            $user->setallAttribute($object);//dd($user);
            $user->save();

            return $user;

        } catch (Exception $e) {
            // log
            $MSG = 'requested function';
            $code = 400;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                0,
                'addUser',
                -1,
                -1
            ));
            //-----------------------
//            return json_encode(User::packResponse(null, null, 400, $e->getMessage()));
        }
    }

    // $verificationType  :  1 -> verify registered account,   2 -> verifiy resting password
    public function addVerificationCode($user, $verificationType){

        try {

            $data = [];
            $data['user_id'] = $user->id;
            $data['verificationcode'] = mt_rand(100000, 999999);
            $data['verifingtype'] = $verificationType;
            $verificationcode = new verificationcode();
            $verificationcode->setallAttribute($data);
            $verificationcode->save();
        } catch (Exception $e) {
            // log
            $MSG = 'requested function';
            $code = 400;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                0,
                'addVerificationCode',
                -1,
                -1
            ));
            //-----------------------
//            return json_encode(User::packResponse(null, null, 400, $e->getMessage()));
        }
    }

    public function getUserObject($input){
        if(is_numeric($input)){
            $user = User::where('phone', $input)->first();
        }else if (strpos($input, '@') !== false && strpos($input, '.com') !== false){
            $user = User::where('email', $input)->first();
        }else{
            $user = User::where('username', $input)->first();
        }
        return $user;
    }
}
