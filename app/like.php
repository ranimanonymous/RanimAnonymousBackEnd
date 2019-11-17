<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

use App\User;

class like extends Model
{
    public static $tableName = 'likes';
    public static $tbuser_id = 'user_id';
    public static $tbrealEstate_id = 'realEstate_id';
    public static $tbtype = 'type';
    public static $tbdeleted = 'deleted';
    public static $tbcreated_at = 'created_at';
    public static $tbupdated_at = 'updated_at';


    public function setallAttribute($request){

        if(!is_array($request)){
            $this->user_id = $request->user_id;
            $this->realEstate_id = $request->realEstate_id;
            $this->type = $request->type;
            $this->deleted = $request->deleted;
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }else {
            $this->user_id = $request['user_id'];
            $this->realEstate_id = $request['realEstate_id'];
            $this->deleted = $request['deleted'];
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }
    }

    public static function getallAttribute($data){

        $result = [];
        $result[self::$tbtype] = $data->type;
//        $result[self::$tbdeleted] = $data->deleted;
        $result[self::$tbcreated_at] = $data->created_at;
        $result[self::$tbupdated_at] = $data->updated_at;

        return $result;
    }

    public static function  packResponse($data, $sessionKey, $code, $errorMsg){

        if($data != null) {
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

    public function add($action, $parameter){
        $helper = new helper();
        if(!$this->isexist($parameter)) {
            $parameter['deleted'] = 0;
            $helper->add($action, $parameter);
            return $action;
        }else{
            $object = like::where('user_id', $parameter['user_id'])
                ->where('realEstate_id', $parameter['realEstate_id'])
                ->update([
                    'deleted' => 0,
                    'updated_at' => Carbon::now(),
                ]);
            return $object;
        }
    }

    public function remove($parameter){
        if($this->isexist($parameter)) {
            $object = like::where('user_id', $parameter['user_id'])
                ->where('realEstate_id', $parameter['realEstate_id'])
                ->update([
                    'deleted' => 1,
                    'updated_at' => Carbon::now(),
                ]);
            return true;
        }
        return false;
    }

    public function isexist($parameter){
        $data = DB::table(self::$tableName)
            ->where(self::$tableName    . '.' . self::$tbuser_id, '=', $parameter['user_id'])
            ->where(self::$tableName    . '.' . self::$tbrealEstate_id, '=', $parameter['realEstate_id'])
            ->get()->first();
        if($data != null){
            return true;
        }else{
            return false;
        }
    }

    public function getlikesCountOfRealEsatate($parameter){
        $data = DB::table(self::$tableName)
            ->where(self::$tableName    . '.' . self::$tbdeleted, '=', 0)
            ->where(self::$tableName    . '.' . self::$tbrealEstate_id, '=', $parameter['realEstate_id'])
            ->get()->count();

        return $data;
    }

    public function getlikesUserListsOfRealEstate($parameter){
        $data = DB::table(self::$tableName)
            ->join(User::$tableName, self::$tableName    . '.' . self::$tbuser_id, '=', User::$tableName . '.' . User::$tbid)
            ->where(self::$tableName    . '.' . self::$tbdeleted, '=', 0)
            ->where(self::$tableName    . '.' . self::$tbrealEstate_id, '=', $parameter['realEstate_id'])
            ->select(
                User::$tableName . '.' . User::$tbusername,
                self::$tableName    . '.' . self::$tbtype,
                self::$tableName    . '.' . self::$tbcreated_at
            )
            ->get();

        return $data;
    }

}
