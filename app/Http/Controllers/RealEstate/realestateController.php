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
use App\indexedrealestate;
use App\IR;

use Storage;

class realestateController extends Controller
{

    public function createRealEstate(Request $request){

//        Storage::disk('local')->put('file.txt', 'Contents');
//        Storage::putFile('images', $request->file('img'));
//        dd('heyy');
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
//        $ImageLists = image::getImageLists($request);
//        foreach($ImageLists as $img){
//            $image = new image();
//            $request['name'] = $imageName;
//            $image->setallAttribute($request);
//            $image->save();
//        }




//        $imageName = md5(uniqid(rand(), true));
//        $image = new image();
//        $request['name'] = $imageName;
//        $image->setallAttribute($request);
//        $image->save();




        // code 5ra

        $image = $request->file('img');
//        $path = '/images/'.time() .$image->getClientOriginalName() ;
//        \Storage::disk('public')->put($path , file_get_contents($image));


        // $path = str_replace('app\Services', '\public\uploads', dirname(_FILE_));
        $path = str_replace('app/Http/Controllers/RealEstate', '/public_html/images', dirname(__FILE__));
        if (!empty($image) && $image->isValid()) {
            if ($image->isValid()) {

                $imageName = md5(uniqid(rand(), true)) . '.jpg';

                $image->move($path, $imageName);
                $path = '/images/' . $imageName;


                $image = new image();
                $request['name'] = $imageName;
                $image->setallAttribute($request);
                $image->save();
            }
        }


        // nhayet al 5ra 
        
//        Storage::putFileAs('images', $request->file('img'), $imageName . '.jpg');
//        Storage::disk('local')->put('images', file_get_contents('img'));
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
        // index the realestate
        // inserting into indexedrealestates table

        $wordList = IR::indexingText($realestate->description);

        foreach ($wordList as $elem){

            $indexedrealestate = new indexedrealestate();
            $indexedrealestate->setallAttribute([
                'realEstate_id' => $realestate['id'],
                'token' => $elem
            ]);
            $indexedrealestate->save();

        }
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

    public function getRealEstatesLists(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'getRealEstatesLists';
        //-----------------------

        // get user_id by session
        if(isset($request['sessionkey'])) {
            $user = User::getUserBySession($request['sessionkey']);
            $request['user_id'] = $user->id;
        }
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

    public function search(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'search';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $data = realestate::search($request['query']);

        // log
        $MSG = 'Success!';
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
        return json_encode(Boolean::packResponse($data, $code, $MSG));
    }

    public function getRealEstateById(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'getRealEstateById';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $data = realestate::getRealEstateById($request['realEstate_id']);

        // log
        $MSG = 'Success!';
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
        return json_encode(Boolean::packResponse($data, $code, $MSG));
    }

    public function mail(){

        return view('email.name', ['name' => 'James']);
    }


}
