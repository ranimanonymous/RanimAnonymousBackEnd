<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

use App\User;

class site extends Model
{
    public static $tableName = 'notificationlisteners';
    public static $tbid = 'id';
    public static $tblevel = 'level';
    public static $tbinside = 'inside';
    public static $tbnameAr = 'nameAr';
    public static $tbnameEn = 'nameEn';
    public static $tbcreated_at = 'created_at';
    public static $tbupdated_at = 'updated_at';


    public function setallAttribute($request)
    {

        if (!is_array($request)) {
            $this->level = $request->level;
            $this->inside = $request->inside;
            $this->nameAr = $request->nameAr;
            $this->nameEn = $request->nameEn;
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        } else {
            $this->level = $request['level'];
            $this->inside = $request['inside'];
            $this->nameAr = $request['nameAr'];
            $this->nameEn = $request['nameEn'];
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
        }
    }

    public static function getallAttribute($data)
    {
        $result = [];
        $result[self::$tblevel] = $data->level;
        $result[self::$tbinside] = $data->inside;
        $result[self::$tbnameAr] = $data->nameAr;
        $result[self::$tbnameEn] = $data->nameEn;
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



}

?>
