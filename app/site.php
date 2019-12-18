<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

use App\User;
use App\IR;

class site extends Model
{
    public static $tableName = 'sites';
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

    public static function getSitesList($word){

        $query = DB::table(self::$tableName);

        $wordList = IR::indexingText($word);

        $query->where(function($query) use ($wordList) {
            foreach ($wordList as $_word) {
                $query->orWhere(self::$tableName . '.' . self::$tbnameEn, 'like', '%' . $_word . '%');
            }
        });

        $query->where(function($query) {
            $query->Where(self::$tableName . '.' . self::$tblevel, '>', 2);
        });
        
        $query->select(
                self::$tableName    . '.' . self::$tbid,
                self::$tableName    . '.' . self::$tbnameEn,
                self::$tableName .'.' .  self::$tblevel
            );
        $data = $query->get();

        $ReturnedSites = self::getReturnedSites($data);

        $weight = IR::weightingWords($ReturnedSites, $wordList);

        $data = IR::getSortedData($weight, $data, 4);


        return $data;
    }

    public static function getReturnedSites($arr){
        $returnedArr = [];
        foreach ($arr as $elem){
            array_push($returnedArr, $elem->nameEn);
        }
        return $returnedArr;
    }



}

?>
