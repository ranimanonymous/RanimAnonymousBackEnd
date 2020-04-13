<?php

namespace App\Http\Controllers\Auth\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json;


use App\helper;

use App\Http\Controllers\Auth\Helper\message;
use App\Http\Controllers\Auth\Helper\config;
use App\Http\Controllers\Auth\Helper\SendMailable;
use App\Http\Controllers\Auth\ParameterValidation\changePasswordParamValidation;

use App\Http\Controllers\Auth\Model\User;
use App\Http\Controllers\Auth\Model\Session;
use App\Http\Controllers\Auth\Model\verificationcode;


class changePasswordController extends Controller
{

    // validate parameter
    // get user by session
    // check if user exist, blocked, active
    // validating password
    // change Password
    public function changePassword(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'changePassword';
        //-----------------------

        // get user_id by session
        $loggedIn = Session::isLoggedIn($request['sessionkey']);
        $user = User::getUserBySession($request['sessionkey']);
        //-----------------------

        // validate the parameter
        $valid = changePasswordParamValidation::Validate($request);

        if($valid){
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

        // if user not exist
        if ($user != null) {

            if(!$loggedIn) {
                return User::Greturn(
                    null,
                    null,
                    $request,
                    $action,
                    $startTime,
                    message::getErrorObject('ChangePassword_loggedoutAccount'),
                    $user->id
                );
            }

            $request['user_id'] = $user->id;

            // if user is not blocked
            if(!User::checkBlockedUser($user)) {

                // if user is verified
                if (User::checkActiveUser($user)) {

                    if (User::compairPasswordd($user, $request['password'])) {

                        // main functionality
                        User::changePassword($user, $request['newpassword']);

                        return User::Greturn(
                            null,
                            null,
                            $request,
                            $action,
                            $startTime,
                            message::getErrorObject('ChangePassword_success')
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
                        message::getErrorObject('ChangePassword_unverifiedAccount')
                    );
                }
            } else {

                return User::Greturn(
                    null,
                    null,
                    $request,
                    $action,
                    $startTime,
                    message::getErrorObject('ChangePassword_blockedAccount')
                );
            }
        }else{

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
