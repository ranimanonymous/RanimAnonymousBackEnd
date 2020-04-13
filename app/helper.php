<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

use App\log;
use App\action;

class helper extends Model
{

    public static function BuildLogObject($code, $errorMsg, $user_id, $UserAction, $delayTime, $object){

        $arr = [];
        $arr['user_id'] = $user_id;
        $arr['action_id'] = action::getActionIdByActioName($UserAction);
        $arr['requestBody'] = json_encode($object->all());
        $arr['requestHeader'] = json_encode($object->header()['content-type']);
        $arr['device_id'] = null;
        $arr['ip'] = null;
        $arr['code'] = $code;
        $arr['Msg'] = $errorMsg;
        $arr['delay_time'] = $delayTime;

        return $arr;

    }
    public static function insertIntoLog($object){
        $log = new log();
        $log->setallAttribute($object);
        $log->save();
    }

    public function add($action, $parameter){
        $action->setallAttribute($parameter);
        $action->save();
    }

    public static function checkDateValidity($date){

        $date = Carbon::parse($date);
        if($date < Carbon::now()->subYears(80)){
            // old date
            return [false, 'old date'];
        }
        if($date > Carbon::now()->subYears(6)){
            // new date
            return [false, 'new date'];
        }
        // valid date
        return [true, 'success'];

    }


}
