<?php


namespace App\Http\Controllers\Auth\Helper;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class config extends Model
{

    public static $verify_without_email = false;

    public static $verification_type_of_verifingAccount = 1;
    public static $verification_type_of_resetingPassword = 2;

    public static $verified = 1;
    public static $unverified = 0;

    public static $blocked = 1;
    public static $unblocked = 0;

    public static $safeDurationTime = '1440'; // to accept verification code // 1440 is a day


    public static $used = 1;
    public static $unused = 0;

    public static $minute = 60;

    public static $email_title = 'DownTown';

}

?>
