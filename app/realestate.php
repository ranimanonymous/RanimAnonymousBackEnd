<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Carbon\Carbon;

use App\realestate_site;

class realestate extends Model
{

    public static $tableName = 'realestates';
    public static $tbid = 'id';
    public static $tbuser_id = 'user_id';
    public static $tbsize = 'size';
    public static $tbroomNum = 'roomNum';
    public static $tbcost = 'cost';
    public static $tbdescription = 'description';
    public static $tbavailable = 'available';
    public static $tbdeleted = 'deleted';
    public static $tbhide = 'hide';
    public static $tbcreated_at = 'created_at';
    public static $tbupdated_at = 'updated_at';


    public function setallAttribute($request){

        if(!is_array($request)){
            $this->user_id = $request->user_id;
            $this->size = $request->size;
            $this->roomNum = $request->roomNum;
            $this->cost = $request->cost;
            $this->description = $request->description;
            $this->available = 1;
            $this->deleted = 0;
            $this->hide = 0;
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }else {
            $this->user_id = $request['user_id'];
            $this->size = $request['size'];
            $this->roomNum = $request['roomNum'];
            $this->cost = $request['cost'];
            $this->description = $request['description'];
            $this->available = 1;
            $this->deleted = 0;
            $this->hide = 0;
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }
    }

    public static function getallAttribute($data){

        $result = [];
        $result[self::$tbid] = $data->id;
        $result[self::$tbuser_id] = $data->user_id;
        $result[self::$tbsize] = $data->size;
        $result[self::$tbroomNum] = $data->roomNum;
        $result[self::$tbcost] = $data->cost;
        $result[self::$tbdescription] = $data->description;
        $result[self::$tbavailable] = $data->available;
        $result[self::$tbcreated_at] = $data->created_at;
        $result[self::$tbupdated_at] = $data->updated_at;

        return $result;
    }

    public static function validate($data){
        if(
            $data->size <= 0 ||
            $data->roomNum <= 0 ||
            $data->cost <= 0
        ){
            return false;
        }
        return true;
    }

    public static function  packResponse($data, $code, $errorMsg){

        if($data != null) {
            $Result['data'] = $data;
        }else{
            $Result['data'] = null;
        }

        $Result['code'] = $code;

        if($errorMsg == null){
            $Result['Msg'] = '';
        }else{
            $Result['Msg'] = $errorMsg;
        }

        return $Result;
    }

    public static function getRealEstatesLists($request){
        $page = 4;

        $data = DB::table(self::$tableName);
        $data->join(realestate_site::$tableName, realestate_site::$tableName . '.' . realestate_site::$tbrealEstate_id, '=', self::$tableName . '.' . self::$tbid);
        $data->where(self::$tableName . '.' . self::$tbdeleted, '=', 0);
        $data->where(self::$tableName . '.' . self::$tbavailable, '=', 1);

        $sites = realestate_site::getSiteDerivation($request['site_id']);

        if($request['site_id'] != null){
            $data->whereIn(realestate_site::$tableName    . '.' . realestate_site::$tbsite_id, $sites);
        }

        $data->select(
            self::$tableName    . '.*'
//            realestate_site::$tbsite_id
            );

        $data->orderBy(self::$tableName . '.' . self::$tbcreated_at, 'desc');

        $data = $data->offset($page * (int)$request['offset'])->limit($page)->get();

        dd($data);
        return $data;
    }

    public static function deleteRealEstate($id){
        DB::table(self::$tableName)
            ->where(self::$tableName    . '.' . self::$tbid, '=', $id)
            ->update([
                'deleted' => 1,
                'updated_at' => Carbon::now(),
            ]);
    }

    public static function hideRealEstate($id){
        DB::table(self::$tableName)
            ->where(self::$tableName    . '.' . self::$tbid, '=', $id)
            ->update([
                'hide' => 1,
                'updated_at' => Carbon::now(),
            ]);
    }

    public static function unhideRealEstate($id){
        DB::table(self::$tableName)
            ->where(self::$tableName    . '.' . self::$tbid, '=', $id)
            ->update([
                'hide' => 0,
                'updated_at' => Carbon::now(),
            ]);
    }


}

?>
