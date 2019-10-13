<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class Boolean extends Model
{
    public static function  packResponse($data, $sessionKey, $code, $errorMsg){

        $Result['data'] = $data;

        $Result['code'] = $code;

        if($errorMsg == null){
            $Result['Msg'] = '';
        }else{
            $Result['Msg'] = $errorMsg;
        }

        return $Result;
    }


}
