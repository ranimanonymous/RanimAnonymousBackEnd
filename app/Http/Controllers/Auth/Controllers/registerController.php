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
use App\Http\Controllers\Auth\ParameterValidation\registerParamValidation;

use App\Http\Controllers\Auth\Model\User;
use App\Http\Controllers\Auth\Model\Session;
use App\Http\Controllers\Auth\Model\verificationcode;


class registerController extends Controller
{

    // validate parameter
    // get user_id by session
    // check if user exist, blocked, active
    public function register(Request $request)
    {
        // start timer
        $startTime = microtime(true);
        $action = 'register';
        //-----------------------

        // validate the parameter
        $valid = registerParamValidation::Validate($request);

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

        $validity = User::CheckIfUserExist($request);

        if ($validity[0]) {
            // so user dosen't exist

            $datevalidity = helper::checkDateValidity($request['bornDate']);

            if ($datevalidity[0]) {

                // main functinoality
                $user = User::addUser($request);

                if ($user != null) {
                    $res = verificationcode::addVerificationCode($user, config::$verification_type_of_verifingAccount);
                    if ($res == null) {
                        return User::Greturn(
                            null,
                            null,
                            $request,
                            $action,
                            $startTime,
                            message::getErrorObject('Login_VerificationCode')
                        );
                    }

                    return User::Greturn(
                        $user,
                        null,
                        $request,
                        $action,
                        $startTime,
                        message::getErrorObject('Register_success'),
                        $user->id
                    );
                } else {
                    return User::Greturn(
                        $user,
                        null,
                        $request,
                        $action,
                        $startTime,
                        message::getErrorObject('GeneralError')
                    );
                }
            } else {
                $errorObject = message::getErrorObject('GeneralError');
                $errorObject['msg'] = $datevalidity[1];
                return User::Greturn(
                    null,
                    null,
                    $request,
                    $action,
                    $startTime,
                    $errorObject
                );
            }
        } else {
            $errorObject = message::getErrorObject('Register_repeatedElement');
            $errorObject['msg'] = $validity[1];
            return User::Greturn(
                null,
                null,
                $request,
                $action,
                $startTime,
                $errorObject
            );
        }
    }

}
?>