<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json;


use App\User;
use App\Session;
use App\verificationcode;

class authController extends Controller
{

    public function login(Request $request){

        $user = new User();
        if(is_numeric($request['username'])){
            $user = User::where('phone', $request['username'])->first();
        }else if (strpos($request['username'], '@') !== false && strpos($request['username'], '.com') !== false){
            $user = User::where('email', $request['username'])->first();
        }else{
            $user = User::where('username', $request['username'])->first();
        }

        if ($user != null) {

            if(User::checkActiveUser($user)) {

                if (User::compairPasswordd($user, $request['password'])) {

                    $session = self::generateSession($user);

                    return json_encode(User::packResponse($user, $session->payload, 200, null));

                } else {
                    return json_encode(User::packResponse(null, null, 400, 'wrong Password!'));
                }
            } else {
                return json_encode(User::packResponse(null, null, 400, 'you need to verify your account before logging in!'));
            }
        }else{
            return json_encode(User::packResponse(null, null, 400, 'userName is not exist!'));
        }
    }

    public function register(Request $request){

        $validity = User::CheckAdding($request);

        if($validity[0]) {

            $user = self::addUser($request);

            self::addVerificationCode($user, 1);

            return json_encode(User::packResponse($user, null, 200, null));
        }else{
            return json_encode(User::packResponse(null, null, 400, $validity[1]));
        }
    }

    public function editUser(Request $request){

        $user = User::where('id', $request['id'])->first();

        if ($user != null) {

            User::edit($request);

            return json_encode(User::packResponse(null, null, 200, 'success!'));
        }else{
            return json_encode(User::packResponse(null, null, 400, 'userName is not exist!'));
        }
    }

    public function logout(Request $request){

        $user = User::getUserByUserName($request['username']);

        if($user){

            Session::updateLastActivity(null, $user->id);

            return json_encode(User::packResponse(null, null, 200, 'success!'));
        }else{
            return json_encode(User::packResponse(null, null, 400, 'userName is not exist!'));
        }

    }


    public function verifyAccount(Request $request){

        // $verifingType :   1 -> verify registerd user,   2 -> verify reseting password
        $request['verificationType'] = 1;
        $request['newpassword'] = null;
        self::verify($request);

    }

    public function verifyRestingPassword(Request $request){

        // $verifingType :   1 -> verify registerd user,   2 -> verify reseting password
        $request['verificationType'] = 2;
        self::verify($request);

    }

    public function sendVerificationCodeRegistering(Request $request){

        // $verifingType :   1 -> verify registerd user,   2 -> verify reseting password
        $request['verificationType'] = 1;
        self::sendVerificationCode($request);

    }

    public function sendVerificationCodeResetingPasssword(Request $request){

        // $verifingType :   1 -> verify registerd user,   2 -> verify reseting password
        $request['verificationType'] = 2;
        self::sendVerificationCode($request);

    }

    public function resetPassword(Request $request){

        $user = User::getUserByUserName($request['username']);
        if($user != null){

            self::addVerificationCode($user, 2);

            return json_encode(User::packResponse(null, null, 200, 'success!'));
        }else{
            return json_encode(User::packResponse(null, null, 400, 'userName is not exist!'));
        }

    }

    public function changePassword(Request $request){

        $user = User::getUserByUserName($request['username']);


        if(User::checkActiveUser($user)) {
            if ($user != null) {
                if (User::compairPasswordd($user, $request['password'])) {

                    User::changePassword($user, $request['newpassword']);


                    return json_encode(User::packResponse(null, null, 200, 'success!'));
                } else {
                    return json_encode(User::packResponse(null, null, 400, 'wrong Password!'));
                }
            } else {
                return json_encode(User::packResponse(null, null, 400, 'userName is not exist!'));
            }
        }else{
            return json_encode(User::packResponse(null, null, 400, 'you need to verify your account before logging in!'));
        }
    }

    //------------------------------------------------
    // helper method
    //------------------------------------------------
    //------------------------------------------------

    public function verify($request){

        //        dd($request->all());
        $user = new User();
        $user = User::getUserByUserName($request['username']);

        if($user != null){

            $validityOfVerificationCode = verificationcode::compairVerificationCode($user, $request['verificationcode'], $request['verificationType']);
            if($validityOfVerificationCode[0]){

                verificationcode::verifyAccount($request['verificationcode'], $user, $request['verificationType'], $request['newpassword']);

                return json_encode(User::packResponse(null, null, 200, 'success!'));
            }else{
                return json_encode(User::packResponse(null, null, 400, $validityOfVerificationCode[1]));
            }

        }else{
            return json_encode(User::packResponse(null, null, 400, 'userName is not exist!'));
        }
    }

    public function sendVerificationCode($request){

        $user = User::getUserByUserName($request['username']);
        if($user != null){

            self::addVerificationCode($user, $request['verificationType']);

            return json_encode(User::packResponse(null, null, 200, 'success!'));
        }else{
            return json_encode(User::packResponse(null, null, 400, 'userName is not exist!'));
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
            return json_encode(User::packResponse(null, null, 400, $e->getMessage()));
        }
    }

    public function addUser($object){

        try{

            $user = new User();
            $user->setallAttribute($object);
            $user->save();

            return $user;

        } catch (Exception $e) {
            return json_encode(User::packResponse(null, null, 400, $e->getMessage()));
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
            return json_encode(User::packResponse(null, null, 400, $e->getMessage()));
        }
    }
}
