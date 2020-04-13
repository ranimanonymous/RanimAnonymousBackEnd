<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Carbon\Carbon;

use App\realestate_site;
use App\User;
use App\site;
use App\IR;
use App\indexedrealestate;
use App\image;
use App\phones;
use App\notificationlistener;

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

        $page = 8;
        DB::enableQueryLog();
//        DB::enableQueryLog();
        $data = DB::table(self::$tableName);
        $data->join(realestate_site::$tableName, realestate_site::$tableName . '.' . realestate_site::$tbrealEstate_id, '=', self::$tableName . '.' . self::$tbid);
        $data->join(site::$tableName, realestate_site::$tableName . '.' . realestate_site::$tbsite_id, '=', site::$tableName . '.' . site::$tbid);
        $data->join(User::$tableName, User::$tableName . '.' . User::$tbid, '=', self::$tableName . '.' . self::$tbuser_id);
        $data->join(image::$tableName, image::$tableName . '.' . image::$tbrealEstate_id, '=', self::$tableName . '.' . self::$tbid);
        $data->join(phones::$tableName, phones::$tableName . '.' . phones::$tbrealEstate_id, '=', self::$tableName . '.' . self::$tbid);


        if(isset($request['lisenter_id'])){
            $listener = notificationlistener::where('id', $request['lisenter_id'])->first();

            $request['site_id'] = $listener->site_id;
            $request['room1'] = $listener->roomNum1;
            $request['room2'] = $listener->roomNum2;
            $request['size1'] = $listener->size1;
            $request['size2'] = $listener->size2;
            $request['cost1'] = $listener->cost1;
            $request['cost2'] = $listener->cost2;
            $request['date'] = $listener->created_at;

        }


        $data->where(function($query) use ($request) {
            $query->where(self::$tableName . '.' . self::$tbdeleted, '=', 0);
            $query->where(self::$tableName . '.' . self::$tbavailable, '=', 1);
            $sites = realestate_site::getSiteDerivation($request['site_id']);

            if($request['site_id'] != null){
                $query->whereIn(realestate_site::$tableName    . '.' . realestate_site::$tbsite_id, $sites);
            }
        });

//var_dump($request['room1']);exit();



        $data->where(function($query) use ($request) {
            if($request['room1'] != null){
                $query->where(self::$tableName . '.' . self::$tbroomNum, '>=', $request['room1']);
            }
            if($request['room2'] != null){
                $query->where(self::$tableName . '.' . self::$tbroomNum, '<=', $request['room2']);
            }
            if($request['size1'] != null){
                $query->where(self::$tableName . '.' . self::$tbsize, '>=', $request['size1']);
            }
            if($request['size2'] != null){
                $query->where(self::$tableName . '.' . self::$tbsize, '<=', $request['size2']);
            }
            if($request['cost1'] != null){
                $query->where(self::$tableName . '.' . self::$tbcost, '>=', $request['cost1']);
            }
            if($request['cost2'] != null){
                $query->where(self::$tableName . '.' . self::$tbcost, '<=', $request['cost2']);
            }
            if(isset($request['lisenter_id'])){
                $query->where(self::$tableName . '.' . self::$tbupdated_at, '>=', $request['date']);
            }
        });



        $data->select(
            self::$tableName . '.' . self::$tbid,
            User::$tableName . '.' . User::$tbusername,
            self::$tableName . '.' . self::$tbcost,
            self::$tableName . '.' . self::$tbdescription,
            self::$tableName . '.' . self::$tbroomNum,
            self::$tableName . '.' . self::$tbsize,
            self::$tableName . '.' . self::$tbcreated_at,
            phones::$tableName . '.' . phones::$tbGSM,
            site::$tableName . '.' . site::$tbnameEn . ' as siteName',
            image::$tableName . '.' . image::$tbname . ' as ImageName'
            );

        $data->orderBy(self::$tableName . '.' . self::$tbid, 'desc');
        $data = $data->take($page)->skip($page * (int)$request['offset'])->get();

        $returnedData = [];
        $helper = [];

//        dd($data);
        $counter = 0;
        for ($i = 0; $i < sizeof($data) ; $i++){
            $entered = false;
            foreach ($helper as $elem){
                if($data[$i]->id == $elem['id']){
                    array_push($returnedData[$elem['index']]->GSM, $data[$i]->GSM);
                    $entered = true;
                }
            }

            if(!in_array($data[$i], $returnedData) && !$entered) {
                $temp = $data[$i]->GSM;
                $data[$i]->GSM = [];
                array_push($data[$i]->GSM, $temp);
                array_push($returnedData, $data[$i]);
                array_push($helper, ['id' => $data[$i]->id, 'index' => $counter]);
                $counter++;
            }
        }
//        dd(DB::getQueryLog());
//        dd($returnedData);
        return $returnedData;
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

    public static function search($Query){

        $wordList = IR::indexingText($Query);

        $query = DB::table(indexedrealestate::$tableName);

        $query->join(self::$tableName, self::$tableName . '.' . self::$tbid, '=', indexedrealestate::$tableName . '.' . indexedrealestate::$tbrealEstate_id);

        $query->join(realestate_site::$tableName, realestate_site::$tableName . '.' . realestate_site::$tbrealEstate_id, '=', self::$tableName . '.' . self::$tbid);
        $query->join(site::$tableName, realestate_site::$tableName . '.' . realestate_site::$tbsite_id, '=', site::$tableName . '.' . site::$tbid);
        $query->join(User::$tableName, User::$tableName . '.' . User::$tbid, '=', self::$tableName . '.' . self::$tbuser_id);

        $query->where(function($query) {
            $query->where(self::$tableName . '.' . self::$tbdeleted, '=', 0);
            $query->where(self::$tableName . '.' . self::$tbavailable, '=', 1);
        });

        $query->where(function($query) use ($wordList) {
            foreach ($wordList as $_word) {
                $query->orWhere(indexedrealestate::$tableName . '.' . indexedrealestate::$tbtoken, 'like', '%' . $_word . '%');
            }
        });

        $query->select(
            User::$tableName . '.' . User::$tbusername,
            self::$tableName . '.' . self::$tbcost,
            self::$tableName . '.' . self::$tbdescription,
            self::$tableName . '.' . self::$tbroomNum,
            self::$tableName . '.' . self::$tbsize,
            site::$tableName . '.' . site::$tbnameEn . ' as siteName'
        );

        $query->orderBy(self::$tableName . '.' . self::$tbcreated_at, 'desc');

        $data = $query->distinct()->get();

        $siteList = site::getSitesList($Query);

        $arr1 = [];
        foreach ($data as $elem){
            array_push($arr1, $elem->siteName);
        }

        $arr2 = [];
        foreach ($siteList as $elem){
            array_push($arr2, $elem->nameEn);
        }

        $weight = IR::weightingWords($arr1, $arr2);


        $data = IR::getSortedData($weight, $data, 4);

        return $data;

    }

    public static function getRealEstateById($realEstate_id){

        DB::enableQueryLog();
        $data = DB::table(self::$tableName);
        $data->join(realestate_site::$tableName, realestate_site::$tableName . '.' . realestate_site::$tbrealEstate_id, '=', self::$tableName . '.' . self::$tbid);
        $data->join(site::$tableName, realestate_site::$tableName . '.' . realestate_site::$tbsite_id, '=', site::$tableName . '.' . site::$tbid);
        $data->join(User::$tableName, User::$tableName . '.' . User::$tbid, '=', self::$tableName . '.' . self::$tbuser_id);
        $data->join(image::$tableName, image::$tableName . '.' . image::$tbrealEstate_id, '=', self::$tableName . '.' . self::$tbid);
        $data->join(phones::$tableName, phones::$tableName . '.' . phones::$tbrealEstate_id, '=', self::$tableName . '.' . self::$tbid);

        $data->where(self::$tableName . '.' . self::$tbdeleted, '=', 0);
        $data->where(self::$tableName . '.' . self::$tbavailable, '=', 1);
        $data->where(self::$tableName . '.' . self::$tbid, '=', $realEstate_id);


        $data->select(
            self::$tableName . '.' . self::$tbid,
            User::$tableName . '.' . User::$tbusername,
            self::$tableName . '.' . self::$tbcost,
            self::$tableName . '.' . self::$tbdescription,
            self::$tableName . '.' . self::$tbroomNum,
            self::$tableName . '.' . self::$tbsize,
            self::$tableName . '.' . self::$tbcreated_at,
            phones::$tableName . '.' . phones::$tbGSM,
            site::$tableName . '.' . site::$tbnameEn . ' as siteName',
            image::$tableName . '.' . image::$tbname . ' as ImageName'
        );

        $data = $data->get();

        if($data != null) {

            $temp = $data[0]->GSM;
            $data[0]->GSM = [];
            array_push($data[0]->GSM, $temp);

            if (sizeof($data) > 0) {
                for ($i = 1; $i < sizeof($data); $i++) {
                    array_push($data[0]->GSM, $data[$i]->GSM);
                }
            }
            return $data[0];
        }else{
            return null;
        }
    }

}

?>
