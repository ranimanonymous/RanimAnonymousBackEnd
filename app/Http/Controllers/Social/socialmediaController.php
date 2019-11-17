<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json;


use App\costmeasure;
use App\sizemeasure;
use App\User;
use App\helper;
use App\like;

class socialmediaController extends Controller
{

    public function like(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'like';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $like = new like();
        $like = $like->add($like, $request);

        if(!$like){
            // log
            $MSG = 'you have add likes to this realEstate before!';
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
            return json_encode(like::packResponse(null, null, $code, $MSG));
        }

        // log
        $MSG = 'you have been like successfuly!';
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
        return json_encode(like::packResponse(null, null, $code, $MSG));
    }

    public function dislike(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'dislike';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $like = new like();
        $like = $like->remove($request);

        if(!$like){
            // log
            $MSG = 'there are no likes to remove it!';
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
            return json_encode(like::packResponse(null, null, $code, $MSG));
        }

        // log
        $MSG = 'you have been disliked successfuly!';
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
        return json_encode(like::packResponse(null, null, $code, $MSG));
    }

    public function likesCountOfRealEsatate(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'likesCountOfRealEsatate';
        //-----------------------


        $like = new like();
        $count = $like->getlikesCountOfRealEsatate($request);
        if($count < 0){
            // log
            $MSG = 'something went wrong!';
            $code = 400;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                0,
                $action,
                microtime(true) - $startTime,
                $request
            ));
            //-----------------------
            return json_encode(like::packResponse(null, null, $code, $MSG));
        }

        // log
        $MSG = 'success!';
        $code = 200;
        helper::insertIntoLog(helper::BuildLogObject(
            $code,
            $MSG,
            0,
            $action,
            microtime(true) - $startTime,
            $request
        ));
        //-----------------------
        return json_encode(like::packResponse($count, null, $code, $MSG));
    }

    public function likesUserListsOfRealEstate(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'likesUserListsOfRealEstate';
        //-----------------------

        $like = new like();
        $userList = $like->getlikesUserListsOfRealEstate($request);

        if(sizeof($userList) < 0){
            // log
            $MSG = 'something went wrong!';
            $code = 400;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                0,
                $action,
                microtime(true) - $startTime,
                $request
            ));
            //-----------------------
            return json_encode(like::packResponse(null, null, $code, $MSG));
        }

        // log
        $MSG = 'success!';
        $code = 200;
        helper::insertIntoLog(helper::BuildLogObject(
            $code,
            $MSG,
            0,
            $action,
            microtime(true) - $startTime,
            $request
        ));
        //-----------------------
        return json_encode(like::packResponse($userList, null, $code, $MSG));
    }

}

?>
