<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

use App\User;

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

//        $data = DB::table(self::$tableName)
//            ->where(self::$tableName    . '.' . self::$tbnameEn, 'like', '%' . $word . '%')
//            ->select(
//                self::$tableName    . '.' . self::$tbid,
//                self::$tableName    . '.' . self::$tbnameEn
//            )
//            ->get();
        $query = DB::table(self::$tableName);

        $wordList = [];
        array_push($wordList, $word);
        array_push($wordList, self::soundWord($word));
        $wordList = self::ngram($wordList, $word);


        foreach ($wordList as $_word) {
            $query->orWhere(self::$tableName . '.' . self::$tbnameEn, 'like', '%' . $_word . '%');
        }
        
        $query->select(
                self::$tableName    . '.' . self::$tbid,
                self::$tableName    . '.' . self::$tbnameEn
            );
        $data = $query->get();
        dd($data);

        return $data;
    }

    public static function ngram($arr, $word, $n = 3){

        $len = strlen($word);
        for($i = 0; $i < $len; $i++) {
            if($i > ($n - 2)) {
                $ng = '';
                for($j = $n-1; $j >= 0; $j--) {
                    $ng .= $word[$i-$j];
                }
                array_push($arr, $ng);
            }
        }
        return $arr;
    }

    public static function soundWord($word){

        $word = preg_replace('/B|b|F|f|P|p|V|v/i', '1', $word);
        $word = preg_replace('/C|c|G|g|J|j|K|k|Q|q|S|s|X|x|Z|z/i', '2', $word);
        $word = preg_replace('/D|d|T|t/i', '3', $word);
        $word = preg_replace('/M|m|N|n/i', '5', $word);

        return $word;

    }


    public static function soundAll(){
        $data = DB::table(self::$tableName)
            ->select(
                self::$tableName . '.' . self::$tbid,
                self::$tableName . '.' . self::$tbnameEn
            )
            ->get();

        foreach ($data as $item){

            $word = self::soundWord($item->nameEn);

            DB::table(self::$tableName)
                ->where(self::$tableName . '.' . self::$tbid, '=', $item->id)
                ->update([
                    'soundEn' => $word,
                    'updated_at' => Carbon::now(),
                ]);

        }

    }

}

?>
