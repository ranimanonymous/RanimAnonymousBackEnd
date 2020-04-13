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
use App\Http\Controllers\Auth\ParameterValidation\verifyRestingPasswordParamValidation;

use App\Http\Controllers\Auth\Model\User;
use App\Http\Controllers\Auth\Model\Session;
use App\Http\Controllers\Auth\Model\verificationcode;


class verifyRestingPasswordController extends Controller
{
    // validate parameter
    // get user_id by session
    // check if user exist, blocked, active
    public function verifyRestingPassword(Request $request)
    {
        // start timer
        $startTime = microtime(true);
        $action = 'verifyRestingPassword';
        //-----------------------

        // validate the parameter
        $valid = verifyRestingPasswordParamValidation::Validate($request);

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
        // $request['newpassword'] will be inside the request
        $returnObect = User::verify($request);


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