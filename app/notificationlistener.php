<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

use App\User;

class notificationlistener extends Model
{
    public static $tableName = 'notificationlisteners';
    public static $tbid = 'id';
    public static $tbuser_id = 'user_id';
    public static $tbsite_id = 'site_id';
    public static $tbm_size = 'm_size';
    public static $tbsize1 = 'size1';
    public static $tbsize2 = 'size2';
    public static $tbm_cost = 'm_cost';
    public static $tbcost1 = 'cost1';
    public static $tbcost2 = 'cost2';
    public static $tbroomNum1 = 'roomNum1';
    public static $tbroomNum2 = 'roomNum2';
    public static $tbdeleted = 'deleted';
    public static $tbcreated_at = 'created_at';
    public static $tbupdated_at = 'updated_at';


    public function setallAttribute($request)
    {

        if (!is_array($request)) {
            $this->user_id = $request->user_id;
            $this->site_id = $request->site_id;
            $this->m_size = $request->m_size;
            $this->deleted = $request->deleted;
            if($request->size1 != null){
                $this->size1 = $request->size1;
            }else{
                $this->size1 = 0;
            }
            if($request->size2 != null){
                $this->size2 = $request->size2;
            }else{
                $this->size2 = 4294967295;
            }

            $this->m_cost = $request->m_cost;

            if($request->cost1 != null){
                $this->cost1 = $request->cost1;
            }else{
                $this->cost1 = 0;
            }
            if($request->cost2 != null){
                $this->cost2 = $request->cost2;
            }else{
                $this->cost2 = 4294967295;
            }

            if($request->roomNum1 != null){
                $this->roomNum1 = $request->roomNum1;
            }else{
                $this->roomNum1 = 0;
            }
            if($request->roomNum2 != null){
                $this->roomNum2 = $request->roomNum2;
            }else{
                $this->roomNum2 = 4294967295;
            }
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        } else {
            $this->user_id = $request['user_id'];
            $this->site_id = $request['site_id'];
            $this->m_size = $request['m_size'];
            $this->deleted = $request['deleted'];
            if($request['size1'] != null){
                $this->size1 = $request['size1'];
            }else{
                $this->size1 = 0;
            }
            if($request['size2'] != null){
                $this->size2 = $request['size2'];
            }else{
                $this->size2 = 4294967295;
            }
            $this->m_cost = $request['m_cost'];
            if($request['cost1'] != null){
                $this->cost1 = $request['cost1'];
            }else{
                $this->cost1 = 0;
            }
            if($request['cost2'] != null){
                $this->cost2 = $request['cost2'];
            }else{
                $this->cost2 = 4294967295;
            }

            if($request['roomNum2'] != null){
                $this->roomNum1 = $request['roomNum1'];
            }else{
                $this->roomNum1 = 0;
            }
            if($request['roomNum2'] != null){
                $this->roomNum2 = $request['roomNum2'];
            }else{
                $this->roomNum2 = 4294967295;
            }


            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }
    }

    public static function getallAttribute($data)
    {
        $result = [];
        $result[self::$tbuser_id] = $data->user_id;
        $result[self::$tbsite_id] = $data->site_id;
        $result[self::$tbm_size] = $data->m_size;
        $result[self::$tbsize1] = $data->size1;
        $result[self::$tbsize2] = $data->size2;
        $result[self::$tbm_cost] = $data->m_cost;
        $result[self::$tbcost1] = $data->cost1;
        $result[self::$tbcost2] = $data->cost2;
        $result[self::$tbroomNum1] = $data->roomNum1;
        $result[self::$tbroomNum2] = $data->roomNum2;
        $result[self::$tbdeleted] = $data->deleted;
        $result[self::$tbcreated_at] = $data->created_at;
        $result[self::$tbupdated_at] = $data->updated_at;

        return $result;
    }

    public static function packResponse($data, $code, $errorMsg){

        $Result['data'] = $data;

        $Result['code'] = $code;

        if ($errorMsg == null) {
            $Result['Msg'] = '';
        } else {
            $Result['Msg'] = $errorMsg;
        }

        return $Result;
    }

    public function add($action, $parameter){
        $helper = new helper();
        $helper->add($action, $parameter);
        return $action;
    }

    public static function getNotificationListenerList($user_id){
        $Data = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbuser_id, '=', $user_id)
            ->where(self::$tableName . '.' . self::$tbdeleted, '=', 0)
            ->get();
        return $Data;
    }

    public static function editNotificationListenerList($newObject){
        DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '=', $newObject->id)
            ->update([
                'site_id' => $newObject->site_id,
                'roomNum1' => $newObject->roomNum1,
                'roomNum2' => $newObject->roomNum2,
                'm_cost' => $newObject->m_cost,
                'cost1' => $newObject->cost1,
                'cost2' => $newObject->cost2,
                'm_size' => $newObject->m_size,
                'size1' => $newObject->size1,
                'size2' => $newObject->size2,
                'updated_at' => Carbon::now(),
            ]);
    }

    public static function deleteNotificationListenerList($newObject){
        DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '=', $newObject->id)
            ->update([
                'deleted' => 1,
                'updated_at' => Carbon::now(),
            ]);
    }

}

?>
