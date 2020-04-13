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
use App\Http\Controllers\Auth\ParameterValidation\sendVerificationCodeResetingPassswordParamValidation;

use App\Http\Controllers\Auth\Model\User;
use App\Http\Controllers\Auth\Model\Session;
use App\Http\Controllers\Auth\Model\verificationcode;


class sendVerificationCodeResetingPassswordController extends Controller
{

    // validate parameter
    // get user_id by session
    // check if user exist, blocked, active
    // resend verification code with type 2
    public function sendVerificationCodeResetingPasssword(Request $request)
    {
        // start timer
        $startTime = microtime(true);
        $action = 'sendVerificationCodeResetingPasssword';
        //-----------------------

        // validate the parameter
        $valid = sendVerificationCodeResetingPassswordParamValidation::Validate($request);

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
        $request['verificationType'] = config::$verification_type_of_resetingPassword;
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