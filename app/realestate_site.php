<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\site;


class realestate_site extends Model
{
    public static $tableName = 'realestate_sites';
    public static $tbrealEstate_id = 'realEstate_id';
    public static $tbsite_id = 'site_id';
    public static $tbcreated_at = 'created_at';
    public static $tbupdated_at = 'updated_at';


    public function setallAttribute($request){

        if(!is_array($request)){
            $this->realEstate_id = $request->realEstate_id;
            $this->site_id = $request->site_id;
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }else {
            $this->realEstate_id = $request['realEstate_id'];
            $this->site_id = $request['site_id'];
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }
    }

    public static function getallAttribute($data){

        $result = [];
        $result[self::$tbrealEstate_id] = $data->realEstate_id;
        $result[self::$tbsite_id] = $data->site_id;
        $result[self::$tbcreated_at] = $data->created_at;
        $result[self::$tbupdated_at] = $data->updated_at;

        return $result;
    }

    public static function  packResponse($data, $sessionKey, $code, $errorMsg){

        if($data != null) {
            if(is_array($data)){
                $arr = [];
                foreach ($data as $item){
                    array_push($arr, self::getallAttribute($item));
                }
                $data = $arr;
            }else{
                $data = self::getallAttribute($data);
            }
            $Result = [];

            $Result['data'] = $data;
        }else{
            $Result['data'] = null;
        }
        if($sessionKey != null) {
            $Result['data']['sessionkey'] = $sessionKey;
        }

        $Result['code'] = $code;

        if($errorMsg == null){
            $Result['Msg'] = '';
        }else{
            $Result['Msg'] = $errorMsg;
        }

        return $Result;
    }

    public static function getSiteDerivation($site_id){

        $fathers = [];
        $site = site::where('id', $site_id)->first();
        array_push($fathers, $site->id);


        while($site->level > 2){
            $site = site::where('id', $site->inside)->first();
            if(!in_array($site->id, $fathers)) {
                array_push($fathers, $site->id);
            }
        }

        $new = $fathers;
        while (sizeof($new) > 0){

            $sites = site::where('inside', $new[0])->get();
            array_splice($new, 0, 1);
            foreach ($sites as $son){
                if(!in_array($son->id, $fathers)) {
                    array_push($fathers, $son->id);
                }
                if(!in_array($son->id, $new)) {
                    array_push($new, $son->id);
                }
            }

        }

        return $fathers;
    }


}
