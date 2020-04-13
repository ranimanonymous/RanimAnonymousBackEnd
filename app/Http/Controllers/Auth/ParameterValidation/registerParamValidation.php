<?php


namespace App\Http\Controllers\Auth\ParameterValidation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;

use App\Http\Controllers\Auth\Helper\paramvalidation;

class registerParamValidation extends Model
{
    public static function Validate($request){

        $msg['empty_msg'] = '';
        $msg['empty'] = false;

        $msg['missing_msg'] = '';
        $msg['missing'] = false;


        $msg = paramvalidation::checkAttributes($request, $msg, 'username');
        $msg = paramvalidation::checkAttributes($request, $msg, 'firstName');
        $msg = paramvalidation::checkAttributes($request, $msg, 'lastName');
        $msg = paramvalidation::checkAttributes($request, $msg, 'email');
        $msg = paramvalidation::checkAttributes($request, $msg, 'bornDate');
        $msg = paramvalidation::checkAttributes($request, $msg, 'phone');
//                $msg = paramvalidation::checkAttributes($request, $msg, 'image');
        $msg = paramvalidation::checkAttributes($request, $msg, 'password');


        if ($msg['missing']) {
            $msg['missing_msg'] .= ' is missing';
            return $msg['missing_msg'];
        } else if ($msg['empty']) {
            $msg['empty_msg'] .= ' has empty value';
            return $msg['empty_msg'];
        }else{
            return false;
        }

    }

}


?>
