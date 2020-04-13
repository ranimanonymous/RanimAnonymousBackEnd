<?php

namespace App\Http\Controllers\Auth\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json;


use App\helper;

use App\Http\Controllers\Auth\Helper\config;
use App\Http\Controllers\Auth\Helper\message;
use App\Http\Controllers\Auth\Helper\SendMailable;
use App\Http\Controllers\Auth\ParameterValidation\loginParamValidation;

use App\Http\Controllers\Auth\Model\User;
use App\Http\Controllers\Auth\Model\Session;
use App\Http\Controllers\Auth\Model\verificationcode;

class loginController extends Controller
{
    // validate the parameter
    // get user object , note : $request['username'] may be name or email or number
    // check if user exist, blocked, active
    // validating password
    // apllying generateSession functionality
    public function login(Request $request)
    {
        // start timer
        $startTime = microtime(true);
        $action = 'login';
        //-----------------------

        // validate the parameter
        $valid = loginParamValidation::Validate($request);

        if ($valid) {
            $errorObject = message::getErrorObject('missingVal');
            $errorObject['msg'] = $valid;
            return User::Greturn(
                null,
                null,
                $request,
                $action,
                $startTime,
                $errorObject
            );
        }

        //-----------------------


        $user = new User();

        // $request['username'] may be name or email or number
        $user = User::getUserObject($request['username']);

        if ($user != null) {

            if (!User::checkBlockedUser($user)) {

                if (User::checkActiveUser($user)) {

                    if (User::compairPasswordd($user, $request['password'])) {

                        // functionality
                        $session = Session::generateSession($user);


                        if ($session == null) {
                            return User::Greturn(
                                null,
                                null,
                                $request,
                                $action,
                                $startTime,
                                message::getErrorObject('Login_SessionError')
                            );
                        }
                        return User::Greturn(
                            $user,
                            $session->payload,
                            $request,
                            $action,
                            $startTime,
                            message::getErrorObject('Login_success'),
                            $user->id
                        );
                    } else {
                        return User::Greturn(
                            null,
                            null,
                            $request,
                            $action,
                            $startTime,
                            message::getErrorObject('wrongPassword')
                        );
                    }
                } else {
                    return User::Greturn(
                        null,
                        null,
                        $request,
                        $action,
                        $startTime,
                        message::getErrorObject('Login_verifyNeeded')
                    );
                }
            } else {
                return User::Greturn(
                    null,
                    null,
                    $request,
                    $action,
                    $startTime,
                    message::getErrorObject('Login_Blocked')
                );
            }
        } else {
            return User::Greturn(
                null,
                null,
                $request,
                $action,
                $startTime,
                message::getErrorObject('userNameNotExist')
            );
        }
    }

}

?>