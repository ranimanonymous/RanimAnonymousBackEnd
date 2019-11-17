<?php

namespace App\Http\Controllers\RealEstate;

use App\Boolean;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json;


use App\realestate;
use App\phones;
use App\image;
use App\measure_coste;
use App\measure_size;
use App\realestate_site;
use App\User;
use App\helper;
use App\notification;

class realestateController extends Controller
{
    public function createRealEstate(Request $request){

        // start timer
        $startTime = microtime(true);
        $action = 'createRealEstate';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        if(!realestate::validate($request)){
            // log
            $MSG = 'Zero is wrong value!';
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
            return json_encode(Boolean::packResponse(null, $code, $MSG));
        }

        // insert a realEstate
        $realestate = new realestate();
        $realestate->setallAttribute($request);
        $realestate->save();
        $request['realEstate_id'] = $realestate['id'];
        //-----------------------

        // insert gsm phones relate to realestate
        $GsmLists = phones::getGsmLists($request);
        foreach($GsmLists as $Gsm){
            $phones = new phones();
            $request['GSM'] = $Gsm;
            $phones->setallAttribute($request);
            $phones->save();
        }
        //-----------------------

        // insert images relate to realestate
        $ImageLists = image::getImageLists($request);
        foreach($ImageLists as $img){
            $image = new image();
            $request['name'] = $img;
            $image->setallAttribute($request);
            $image->save();
        }
        //-----------------------

        // insert realestate_site relate to realestate
        $realestate_site = new realestate_site();
        $realestate_site->setallAttribute($request);
        $realestate_site->save();

        //-----------------------

        // insert measure_coste relate to realestate
        $measure_coste = new measure_coste();
        $measure_coste->setallAttribute($request);
        $measure_coste->save();

        //-----------------------

        // insert measure_size relate to realestate
        $measure_size = new measure_size();
        $measure_size->setallAttribute($request);
        $measure_size->save();

        //-----------------------

        $notification = new notification();
        $notification->addNotificationForWhomConcern($realestate, $realestate_site, $measure_coste, $measure_size);

        // log
        $MSG = 'RealEstate has been Added successfuly';
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
        return json_encode(Boolean::packResponse(null, $code, $MSG));
    }

    public function DeleteRealEstate(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'DeleteRealEstate';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------
        realestate::deleteRealEstate($request['realEstate_id']);

        // log
        $MSG = 'RealEstate has been deleted successfuly';
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
        return json_encode(Boolean::packResponse(null, $code, $MSG));
    }

    public function HideRealEstate(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'HideRealEstate';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        realestate::hideRealEstate($request['realEstate_id']);

        // log
        $MSG = 'RealEstate has been hidden successfuly';
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
        return json_encode(Boolean::packResponse(null, $code, $MSG));
    }

    public function unHideRealEstate(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'unHideRealEstate';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------


        realestate::unhideRealEstate($request['realEstate_id']);

        // log
        $MSG = 'RealEstate has been unhidden successfuly';
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
        return json_encode(Boolean::packResponse(null, $code, $MSG));
    }

    public function seenRealEstate(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'seenRealEstate';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        notification::seenRealEstate($request['notification_id']);

        // log
        $MSG = 'RealEstate has been seen successfuly';
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
        return json_encode(Boolean::packResponse(null, $code, $MSG));
    }

    public function getRealEstatesLists(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'getRealEstatesLists';
        //-----------------------

        $realestate = realestate::getRealEstatesLists($request);

        // log
        $MSG = 'success!';
        $code = 200;
        helper::insertIntoLog(helper::BuildLogObject(
            $code,
            $MSG,
            0,
            'createRealEstate',
            microtime(true) - $startTime,
            $request
        ));
        //-----------------------
        return json_encode(realestate::packResponse($realestate, $code, $MSG));
    }

    public function hardDelete(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'hardDelete';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $realestate = realestate::where('id', $request['realEstate_id'])->first();
        $realestate->delete();

        // log
        $MSG = 'RealEstate has been hard deleted!';
        $code = 200;
        helper::insertIntoLog(helper::BuildLogObject(
            200,
            $MSG,
            $request['user_id'],
            $action,
            microtime(true) - $startTime,
            $request
        ));
        //-----------------------
        return json_encode(Boolean::packResponse(null, $code, $MSG));
    }
}