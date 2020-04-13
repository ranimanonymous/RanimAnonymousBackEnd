<?php


namespace App\Http\Controllers\Auth\Helper;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class message extends Model
{

    // messeges :  -1 ---> -30
    public static function getErrorObject($key){
        $arr = [

            //----------------------------------------------------------------------------------------------------------
            // success messeges : 200
            'Login_success' => [
                'msg' => 'logging in successfuly',
                'code' => 200
            ],
            'Register_success' => [
                'msg' => 'you have been registered successfuly',
                'code' => 200
            ],
            'VerifyAccount_success' => [
                'msg' => 'your account has been verified successfuly!',
                'code' => 200
            ],
            'ChangePassword_success' => [
                'msg' => 'password has been changed successfuly!',
                'code' => 200
            ],
            'editUser_success' => [
                'msg' => 'user has been edited successfuly!',
                'code' => 200
            ],
            'logout_success' => [
                'msg' => 'user has been logged out successfuly!',
                'code' => 200
            ],
            'getUserProfile_success' => [
                'msg' => 'getting your profile successfuly!',
                'code' => 200
            ],
            'resetPassword_success' => [
                'msg' => 'your password has been set successfuly!',
                'code' => 200
            ],
            'verificationCode_success' => [
                'msg' => 'the verification code has been sent to you successfuly!',
                'code' => 200
            ],
            //----------------------------------------------------------------------------------------------------------


            //----------------------------------------------------------------------------------------------------------
            // General Messeges : -1 -> -3
            'missingVal' => [
                'msg' => '',
                'code' => -1
            ],
            'GeneralError' => [
                'msg' => 'something went wrong!',
                'code' => -2
            ],
            'Session_Offline' => [
                'msg' => 'this action cant be done offline!',
                'code' => -3
            ],
            //----------------------------------------------------------------------------------------------------------


            //----------------------------------------------------------------------------------------------------------
            // login messeges : -4 -> -9
            'wrongPassword' => [ ////////////////////////////////////////////
                'msg' => 'wrong Password!',
                'code' => -4
            ],
            'Login_verifyNeeded' => [
                'msg' => 'you need to verify your account before logging in!',
                'code' => -5
            ],
            'userNameNotExist' => [ ////////////////////////////////////////////
                'msg' => 'userName is not exist!',
                'code' => -6
            ],
            'Login_Blocked' => [
                'msg' => 'you cant logged in by blocked account',
                'code' => -7
            ],
            'Login_SessionError' => [
                'msg' => 'this session cant be opened cause of some error',
                'code' => -8
            ],
            'Login_VerificationCode' => [
                'msg' => 'verification code cant be added',
                'code' => -9
            ],
            //----------------------------------------------------------------------------------------------------------


            //----------------------------------------------------------------------------------------------------------
            // register messeges : -10
            'Register_repeatedElement' => [
                'msg' => '',
                'code' => -10
            ],
            //----------------------------------------------------------------------------------------------------------


            //----------------------------------------------------------------------------------------------------------
            // VerifyAccount messeges : -11 -> -13
            'VerifyAccount_verifiedbefore' => [
                'msg' => 'your account is verified before!',
                'code' => -11
            ],
            'VerifyAccount_Blocked' => [
                'msg' => 'you cant verify your account if you are blocked!',
                'code' => -13
            ],
            //----------------------------------------------------------------------------------------------------------


            //----------------------------------------------------------------------------------------------------------
            // VerifyResetingPassword messeges : -14 -> -16
            'VerifyResetingPassword_Blocked' => [
                'msg' => 'you cant reset your password if your account are blocked',
                'code' => -14
            ],
            'VerifyResetingPassword_unverified' => [
                'msg' => 'you cant reset your password if your account are unverified',
                'code' => -16
            ],
            //----------------------------------------------------------------------------------------------------------


            //----------------------------------------------------------------------------------------------------------
            // ChangePassword messeges : -15 -> -17
            'ChangePassword_unverifiedAccount' => [
                'msg' => 'you need to verify your account to change your password!',
                'code' => -15
            ],
            'ChangePassword_blockedAccount' => [
                'msg' => 'you cant change your password if your account is blocked!',
                'code' => -16
            ],
            'ChangePassword_loggedoutAccount' => [
                'msg' => 'you cant change your password if your are offline!',
                'code' => -17
            ],
            //----------------------------------------------------------------------------------------------------------


            //----------------------------------------------------------------------------------------------------------
            // sendVerificationCodeRegistering messeges : -18 -> -19
            'sendVerificationCodeRegistering_unverified' => [
                'msg' => 'you cant resend verification code if your account is verified',
                'code' => -18
            ],
            'sendVerificationCodeRegistering_Blocked' => [
                'msg' => 'you cant resend verification code if your account is blocked',
                'code' => -19
            ],
            //----------------------------------------------------------------------------------------------------------


            //----------------------------------------------------------------------------------------------------------
            // sendVerificationCodeResetingPasssword messeges : -20 -> -21
            'sendVerificationCodeResetingPasssword_unverified' => [
                'msg' => 'your cant resend verification code if your account isnt verified yet!',
                'code' => -20
            ],
            'sendVerificationCodeResetingPasssword_Blocked' => [
                'msg' => 'your cant resend verification code if your account isnt blocked!',
                'code' => -21
            ],
            //----------------------------------------------------------------------------------------------------------


            //----------------------------------------------------------------------------------------------------------
            // logout messeges : -22
            'logout_loggedoutbefore' => [
                'msg' => 'you are logged out before!',
                'code' => -22
            ],
            //----------------------------------------------------------------------------------------------------------


            //----------------------------------------------------------------------------------------------------------
            // resetpassword messeges : -23 -> -24
            'reset_verifyNeeded' => [
                'msg' => 'you need to verify your account before reseting password!',
                'code' => -23
            ],
            'reset_Blocked' => [
                'msg' => 'you cant reset your password if your account is blocked',
                'code' => -24
            ],
            //----------------------------------------------------------------------------------------------------------


            //----------------------------------------------------------------------------------------------------------
            // editUser messeges : -25
            'editUser_repeatedVal' => [
                'msg' => '',
                'code' => -25
            ],
            //----------------------------------------------------------------------------------------------------------



        ];
        return $arr[$key];
    }
}

?>
