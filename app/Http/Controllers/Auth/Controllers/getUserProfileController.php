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
use App\Http\Controllers\Auth\ParameterValidation\getUserProfileParamValidation;

use App\Http\Controllers\Auth\Model\User;
use App\Http\Controllers\Auth\Model\Session;
use App\Http\Controllers\Auth\Model\verificationcode;


class getUserProfileController extends Controller
{

    // validate parameter
    // get user_id by session
    // check if user exist, blocked, active
    public function getUserProfile(Request $request)
    {
        // start timer
        $startTime = microtime(true);
        $action = 'getUserProfile';
        //-----------------------

        // validate the parameter
        $valid = getUserProfileParamValidation::Validate($request);

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
        if ($user != null) {
            if (!$loggedIn) {
                return User::Greturn(
                    null,
                    null,
                    $request,
                    $action,
                    $startTime,
                    message::getErrorObject('Session_Offline'),
                    $user->id
                );
            }
            $request['user_id'] = $user->id;
            //-----------------------

            // main functionality
            User::getUserProfile($request['user_id']);

            return User::Greturn(
                null,
                null,
                $request,
                $action,
                $startTime,
                message::getErrorObject('getUserProfile_success'),
                $user->id
            );
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