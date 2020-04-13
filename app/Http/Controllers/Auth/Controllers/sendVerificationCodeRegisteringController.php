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
use App\Http\Controllers\Auth\ParameterValidation\sendVerificationCodeRegisteringParamValidation;

use App\Http\Controllers\Auth\Model\User;
use App\Http\Controllers\Auth\Model\Session;
use App\Http\Controllers\Auth\Model\verificationcode;


class sendVerificationCodeRegisteringController extends Controller
{
    // validate parameter
    // get user_id by session
    // check if user exist, blocked, active
    // resend verification code with type 1
    public function sendVerificationCodeRegistering(Request $request)
    {
        // start timer
        $startTime = microtime(true);
        $action = 'sendVerificationCodeRegistering';
        //-----------------------

        // validate the parameter
        $valid = sendVerificationCodeRegisteringParamValidation::Validate($request);

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

        // $verifingType :   1 -> verify registerd user,   2 -> verify reseting password
        $request['verificationType'] = config::$verification_type_of_verifingAccount; // 1
        $returnObect = verificationcode::sendVerificationCode($request);

        return User::Greturn(
            null,
            null,
            $request,
            $action,
            $startTime,
            $returnObect
        );
    }
}
?>