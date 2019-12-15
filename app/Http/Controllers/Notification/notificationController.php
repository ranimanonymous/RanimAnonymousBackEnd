<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json;


use App\notificationlistener;
use App\notification;
use App\User;
use App\helper;

class notificationController extends Controller
{
    public function addNotificationListener(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'addNotificationListener';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $notificationlistener = new notificationlistener();
        $notificationlistener->add($notificationlistener, $request);

        // log
        $MSG = 'event listener has been added successfuly!';
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
        return json_encode(notificationlistener::packResponse($notificationlistener, $code, $MSG));
    }

    public function getNumberOfNotification(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'getNumberOfNotification';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $count = notification::getCountOfNotification($request['user_id']);

        // log
        $MSG = 'success!';
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
        return json_encode(notification::packResponse($count, $code, $MSG));
    }

    public function getNotificationList(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'getNotificationList';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $notificationList = notification::getNotificationList($request['user_id']);

        // log
        $MSG = 'success!';
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
        return json_encode(notificationlistener::packResponse($notificationList, $code, $MSG));
    }

    public function getNotificationListenerList(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'getNotificationListenerList';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $notificationList = notificationlistener::getNotificationListenerList($request['user_id']);

        // log
        $MSG = 'success!';
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
        return json_encode(notificationlistener::packResponse($notificationList, $code, $MSG));
    }

    public function editNotificationListener(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'editNotificationListener';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $notificationList = notificationlistener::editNotificationListenerList($request);

        // log
        $MSG = 'Notification Listener has been edited successfuly!';
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
        return json_encode(notificationlistener::packResponse($notificationList, $code, $MSG));
    }

    public function deleteNotificationListener(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'deleteNotificationListener';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $notificationList = notificationlistener::deleteNotificationListenerList($request);

        // log
        $MSG = 'Notification Listener has been deleted successfuly!';
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
        return json_encode(notificationlistener::packResponse($notificationList, $code, $MSG));
    }

}



?>
