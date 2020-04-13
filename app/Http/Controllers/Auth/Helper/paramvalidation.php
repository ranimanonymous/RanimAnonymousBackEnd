<?php


namespace App\Http\Controllers\Auth\Helper;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;

class paramvalidation extends Model
{


    public static function checkAttributes($request, $msg, $attributeName){
        if (array_key_exists($attributeName, $request->all())) {
            if (Str::contains($request[$attributeName], '{{') || Str::contains($request[$attributeName], '}}')) {
                $msg['missing'] = true;
                $msg['missing_msg'] .= $attributeName . ', ';
            }
            // is empty
            if ($request[$attributeName] == null) {
                $msg['empty'] = true;
                $msg['empty_msg'] .= $attributeName . ', ';
            }
        }else{
            $msg['missing'] = true;
            $msg['missing_msg'] .= $attributeName . ', ';
        }
        return $msg;
    }

}


?>
