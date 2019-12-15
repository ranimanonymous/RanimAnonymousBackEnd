<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

use App\User;
use App\realestate;
use App\realestate_site;
use App\site;
use App\notificationlistener;

class notification extends Model
{
    public static $tableName = 'notifications';
    public static $tbid = 'id';
    public static $tbuser_id = 'user_id';
    public static $tbrealEstate_id = 'realEstate_id';
    public static $tbseen = 'seen';
    public static $tbseen_at = 'seen_at';
    public static $tbcreated_at = 'created_at';
    public static $tbupdated_at = 'updated_at';


    public function setallAttribute($request)
    {
        if (!is_array($request)) {
            $this->user_id = $request->user_id;
            $this->realEstate_id = $request->realEstate_id;
            $this->seen = 0;
            $this->seen_at = null;
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        } else {
            $this->user_id = $request['user_id'];
            $this->realEstate_id = $request['realEstate_id'];
            $this->seen = 0;
            $this->seen_at = null;
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }
    }

    public static function getallAttribute($data)
    {
        $result = [];
        $result[self::$tbuser_id] = $data->user_id;
        $result[self::$tbrealEstate_id] = $data->realEstate_id;
        $result[self::$tbseen] = $data->seen;
        $result[self::$tbseen_at] = $data->seen_at;
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

    public function addNotificationForWhomConcern($realestate, $realestate_site, $measure_coste, $measure_size){

        $sites = realestate_site::getSiteDerivation($realestate_site->site_id);

        $Query = DB::table(notificationlistener::$tableName);

        // get the realestate that other user add it, dont give me notification on my realestate
        $Query->where(notificationlistener::$tableName    . '.' . notificationlistener::$tbuser_id, '!=', $realestate->user_id);


        $Query->where(notificationlistener::$tableName    . '.' . notificationlistener::$tbcost1, '<=', $realestate->cost);
        $Query->where(notificationlistener::$tableName    . '.' . notificationlistener::$tbcost2, '>=', $realestate->cost);

        $Query->where(notificationlistener::$tableName    . '.' . notificationlistener::$tbsize1, '<=', $realestate->size);
        $Query->where(notificationlistener::$tableName    . '.' . notificationlistener::$tbsize2, '>=', $realestate->size);

        $Query->where(notificationlistener::$tableName    . '.' . notificationlistener::$tbroomNum1, '<=', $realestate->roomNum);
        $Query->where(notificationlistener::$tableName    . '.' . notificationlistener::$tbroomNum2, '>=', $realestate->roomNum);

        //  listener    realestate
        //  siteA       siteA or other derivation on higher level
        $Query->whereIn(notificationlistener::$tableName    . '.' . notificationlistener::$tbsite_id, $sites);

        $Query->select(
            notificationlistener::$tableName    . '.' . notificationlistener::$tbuser_id
        )->distinct();

        $Query->orderBy(notificationlistener::$tableName    . '.' . notificationlistener::$tbcreated_at, 'desc');

        $data = $Query->get();

        $arr = $this->prepareArr($data, $realestate->id);

        foreach ($arr as $item){
            $notification = new notification();
            $this->add($notification, $item);
        }

        return $data;
    }

    public function prepareArr($userCollection, $realestate_id){

        $arr = [];
        foreach ($userCollection as $item){
            array_push($arr, ['user_id' => $item->user_id, 'realEstate_id' => $realestate_id]);
        }
        return $arr;
    }

    public static function seenRealEstate($id){
        DB::table(self::$tableName)
            ->where(self::$tableName    . '.' . self::$tbid, '=', $id)
            ->update([
                'seen' => 1,
                'seen_at' => Carbon::now(),
            ]);
    }

    public static function getCountOfNotification($user_id){
        $Data = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbuser_id, '=', $user_id)
            ->get()->count();
        return $Data;
    }

    public static function getNotificationList($user_id){
        $Data = DB::table(self::$tableName)
            ->join(realestate::$tableName, realestate::$tableName . '.' . realestate::$tbid, '=', self::$tableName . '.' . self::$tbrealEstate_id)
            ->join(realestate_site::$tableName, realestate_site::$tableName . '.' . realestate_site::$tbrealEstate_id, '=', realestate::$tableName . '.' . realestate::$tbid)
            ->join(site::$tableName, site::$tableName . '.' . site::$tbid, '=', realestate_site::$tableName . '.' . realestate_site::$tbsite_id)
            ->join(User::$tableName, User::$tableName . '.' . User::$tbid , '=', realestate::$tableName . '.' . realestate::$tbuser_id)
            ->where(self::$tableName . '.' . self::$tbuser_id, '=', $user_id)
            ->where(realestate::$tableName . '.' . realestate::$tbavailable, '=', 1)
            ->where(realestate::$tableName . '.' . realestate::$tbhide, '=', 0)
            ->where(realestate::$tableName . '.' . realestate::$tbdeleted, '=', 0)
            ->select(
                self::$tableName . '.' . self::$tbseen,
                User::$tableName . '.' . User::$tbusername,
                site::$tableName . '.' . site::$tbnameEn,
                realestate::$tableName . '.' . realestate::$tbcreated_at
                )
            ->get();

        return $Data;
    }


}

?>
