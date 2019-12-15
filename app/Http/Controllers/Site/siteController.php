<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json;


use App\costmeasure;
use App\sizemeasure;
use App\User;
use App\helper;
use App\like;
use App\site;

class siteController extends Controller
{

    public function lookupSites(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'lookupSites';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $sitesList = site::getSitesList($request['word']);

        // log
        $MSG = 'Sites Founed successfuly!';
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
        return json_encode(site::packResponse($sitesList, $code, $MSG));
    }

    public function soundAll(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'soundAll';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        site::soundAll();

        // log
        $MSG = 'Sites sounded successfuly!';
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
        return json_encode(site::packResponse(null, $code, $MSG));
    }

}

?>
