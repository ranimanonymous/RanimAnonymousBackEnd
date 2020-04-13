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
use App\Http\Controllers\Auth\ParameterValidation\resetPasswordParamValidation;

use App\Http\Controllers\Auth\Model\User;
use App\Http\Controllers\Auth\Model\Session;
use App\Http\Controllers\Auth\Model\verificationcode;


class resetPasswordController extends Controller
{
    // validate parameter
    // get user_id by session
    // check if user exist, blocked, active
    // add verification code with type 2
    public function resetPassword(Request $request)
    {
        // start timer
        $startTime = microtime(true);
        $action = 'resetPassword';
        //-----------------------

        // validate the parameter
        $valid = resetPasswordParamValidation::Validate($request);

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

        $user = User::getUserByUserName($request['username']);

        if ($user != null) {

            if (!User::checkBlockedUser($user)) {

                if (User::checkActiveUser($user)) {

                    // main functionality
                    $res = verificationcode::addVerificationCode($user, config::$verification_type_of_resetingPassword);

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
                        null,
                        null,
                        $request,
                        $action,
                        $startTime,
                        message::getErrorObject('resetPassword_success'),
                        $user->id
                    );
                } else {
                    return User::Greturn(
                        null,
                        null,
                        $request,
                        $action,
                        $startTime,
                        message::getErrorObject('reset_verifyNeeded')
                    );
                }
            } else {
                return User::Greturn(
                    null,
                    null,
                    $request,
                    $action,
                    $startTime,
                    message::getErrorObject('reset_Blocked')
                );
            }
        } else {

            return User::Greturn(
                null,
                null,
                $request,
                $action,
                $startTime,
                message::getErrorObject('userNameNotExist'),
                null
            );
        }

    }
}
?>