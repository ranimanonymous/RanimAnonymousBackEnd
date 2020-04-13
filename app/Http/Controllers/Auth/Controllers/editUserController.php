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
use App\Http\Controllers\Auth\ParameterValidation\editUserParamValidation;

use App\Http\Controllers\Auth\Model\User;
use App\Http\Controllers\Auth\Model\Session;
use App\Http\Controllers\Auth\Model\verificationcode;


class editUserController extends Controller
{


    // validate parameter
    // get user_id by session
    // check if user exist, blocked, active
    public function editUser(Request $request)
    {
        // start timer
        $startTime = microtime(true);
        $action = 'editUser';
        //-----------------------

        // validate the parameter
        $valid = editUserParamValidation::Validate($request);

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

        // get user_id by session
        $loggedIn = Session::isLoggedIn($request['sessionkey']);
        $user = User::getUserBySession($request['sessionkey']);

        //-----------------------

        if ($user != null) {

            if (!$loggedIn) {
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
            if (!User::checkBlockedUser($user)) {

                // if user is verified
                if (User::checkActiveUser($user)) {

                    // main functionality
                    $res = User::edit($request);

                    if ($res == '') {
                        $errorObject = message::getErrorObject('editUser_success');
                        return User::Greturn(
                            null,
                            null,
                            $request,
                            $action,
                            $startTime,
                            $errorObject,
                            $user->id
                        );
                    } else {
                        $errorObject = message::getErrorObject('editUser_repeatedVal');
                        $errorObject['msg'] = $res;
                        return User::Greturn(
                            null,
                            null,
                            $request,
                            $action,
                            $startTime,
                            $errorObject,
                            $user->id
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
        } else {

            return User::Greturn(
                null,
                null,
                $request,
                $action,
                $startTime,
                message::getErrorObject('userNameNotExist'),
                $user->id
            );
        }
    }
}
?>