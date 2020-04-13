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
use App\Http\Controllers\Auth\Helper\paramvalidation;
use App\Http\Controllers\Auth\ParameterValidation\logoutParamValidation;

use App\Http\Controllers\Auth\Model\User;
use App\Http\Controllers\Auth\Model\Session;
use App\Http\Controllers\Auth\Model\verificationcode;


class logoutController extends Controller
{

    // validate parameter
    // get user_id by session
    // check if user exist, blocked, active
    // logging out user from last active session - no checking on session
    public function logout(Request $request)
    {

        // start timer
        $startTime = microtime(true);
        $action = 'logout';
        //-----------------------

        // validate the parameter
        $valid = logoutParamValidation::Validate($request);

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
        if ($user) {

            if (!$loggedIn) {
                return User::Greturn(
                    null,
                    null,
                    $request,
                    $action,
                    $startTime,
                    message::getErrorObject('logout_loggedoutbefore'),
                    $user->id
                );
            }

            $request['user_id'] = $user->id;

            // main functionality
            Session::updateLastActivity(null, $user->id);

            return User::Greturn(
                null,
                null,
                $request,
                $action,
                $startTime,
                message::getErrorObject('logout_success'),
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
                $user->id
            );
        }

    }
}
?>