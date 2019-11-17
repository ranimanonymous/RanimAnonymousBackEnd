<?php

namespace App\Http\Controllers\measures;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json;


use App\costmeasure;
use App\sizemeasure;
use App\User;
use App\helper;

class measuresController extends Controller
{

    //------------------------------------------------
    // CostMeasure
    //------------------------------------------------
    //------------------------------------------------
    public function addNewCostMeasure(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'addNewCostMeasure';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $costmeasure = self::addcostmeasure($request);

        // log
        $MSG = 'cost Measurue ave been added successfuly!';
        $code = 200;
        helper::insertIntoLog(helper::BuildLogObject(
            $code,
            $MSG,
            $request['user_id'],
            $action,
            microtime(true) - $startTime,
            $request
        ));
        //-----------------------
        return json_encode(costmeasure::packResponse($costmeasure, $code, $MSG));

    }

    public function editCostMeasure(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'editCostMeasure';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $costmeasure = costmeasure::where('id', $request['measureId'])->first();

        if ($costmeasure != null) {

            costmeasure::edit($request);

            // log
            $MSG = 'CostMeasurue has been edited successfuly!';
            $code = 200;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                $request['user_id'],
                $action,
                microtime(true) - $startTime,
                $request
            ));
            //-----------------------
            return json_encode(costmeasure::packResponse(null, $code, $MSG));
        }else{

            // log
            $MSG = 'userName is not exist!';
            $code = 400;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                $request['user_id'],
                $action,
                microtime(true) - $startTime,
                $request
            ));
            //-----------------------
            return json_encode(costmeasure::packResponse(null, $code, $MSG));
        }

    }

    public function deleteCostMeasure(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'deleteCostMeasure';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $costmeasure = costmeasure::where('id', $request['measureId'])->first();
        $costmeasure->delete();

        // log
        $MSG = 'measure have deleted successfluy!';
        $code = 200;
        helper::insertIntoLog(helper::BuildLogObject(
            $code,
            $MSG,
            $request['user_id'],
            $action,
            microtime(true) - $startTime,
            $request
        ));
        //-----------------------
        return json_encode(costmeasure::packResponse($costmeasure, $code, $MSG));

    }
    //-------------------------------------------
    //-------------------------------------------
    //-------------------------------------------



    //------------------------------------------------
    // SizeMeasure
    //------------------------------------------------
    //------------------------------------------------
    public function addNewSizeMeasure(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'addNewSizeMeasure';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $sizemeasure = self::addsizemeasure($request);

        // log
        $MSG = 'size Measurue have been added successfuly!';
        $code = 200;
        helper::insertIntoLog(helper::BuildLogObject(
            $code,
            $MSG,
            $request['user_id'],
            $action,
            microtime(true) - $startTime,
            $request
        ));
        //-----------------------
        return json_encode(sizemeasure::packResponse($sizemeasure, $code, $MSG));

    }

    public function editSizeMeasure(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'editSizeMeasure';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $sizemeasure = sizemeasure::where('id', $request['measureId'])->first();

        if ($sizemeasure != null) {

            sizemeasure::edit($request);

            // log
            $MSG = 'size Measurue has been edited successfuly!';
            $code = 200;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                $request['user_id'],
                $action,
                microtime(true) - $startTime,
                $request
            ));
            //-----------------------
            return json_encode(sizemeasure::packResponse(null, $code, $MSG));
        }else{

            // log
            $MSG = 'size Measurue is not exist!';
            $code = 400;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                $request['user_id'],
                $action,
                microtime(true) - $startTime,
                $request
            ));
            //-----------------------
            return json_encode(sizemeasure::packResponse(null, $code, $MSG));
        }

    }

    public function deleteSizeMeasure(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'getAllPermission';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $sizemeasure = sizemeasure::where('id', $request['measureId'])->first();
        $sizemeasure->delete();

        // log
        $MSG = 'size Measurue have deleted successfluy!';
        $code = 200;
        helper::insertIntoLog(helper::BuildLogObject(
            $code,
            $MSG,
            $request['user_id'],
            $action,
            microtime(true) - $startTime,
            $request
        ));
        //-----------------------
        return json_encode(sizemeasure::packResponse($sizemeasure, $code, $MSG));

    }
    //-------------------------------------------
    //-------------------------------------------
    //-------------------------------------------




    public function addcostmeasure($object){
        $costmeasure = new costmeasure();
        $costmeasure->setallAttribute($object);
        $costmeasure->save();
        return $costmeasure;
    }

    public function addsizemeasure($object){
        $sizemeasure = new sizemeasure();
        $sizemeasure->setallAttribute($object);
        return $sizemeasure->save();
    }


}


