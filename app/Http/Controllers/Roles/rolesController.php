<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json;


use App\User;
use App\Session;
use App\verificationcode;
use App\Permission;
use App\Boolean;
use App\helper;

class rolesController extends Controller
{
    //------------------------------------------------
    // Permission
    //------------------------------------------------
    //------------------------------------------------
    public function getAllPermission(Request $request){

        // start timer
        $startTime = microtime(true);
        $action = 'getAllPermission';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $permission = Permission::getAllPermission();

        if($permission != null){


            // log
            $MSG = 'success!';
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
            return json_encode(Permission::packResponse($permission, null, $code, $MSG));
        }else{
            // log
            $MSG = 'there are no permission!';
            $code = 300;
            helper::insertIntoLog(helper::BuildLogObject(
                $code,
                $MSG,
                $request['user_id'],
                $action,
                microtime(true) - $startTime,
                $request
            ));
            //-----------------------
            return json_encode(Permission::packResponse(null, null, 400, $MSG));
        }
    }

    public function addMainPermission(Request $request){

        // start timer
        $startTime = microtime(true);
        $action = 'addMainPermission';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        if(!Permission::checkIfNameExist($request->name)){

            $request['parent_id'] = 0;
            self::addPermission($request, 1);


            // log
            $MSG = 'success!';
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
            return json_encode(Permission::packResponse(null, null, $code, $MSG));
        }else{

            // log
            $MSG = 'Permission name is exist!';
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
            return json_encode(Permission::packResponse(null, null, $code, $MSG));
        }
    }

    public function addSubPermission(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'addSubPermission';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        if(!Permission::checkIfNameExist($request->name)){

            self::addPermission($request, 0);


            // log
            $MSG = 'success!';
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
            return json_encode(Permission::packResponse(null, null, 200, 'success!'));
        }else{

            // log
            $MSG = 'Permission name is exist!';
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
            return json_encode(Permission::packResponse(null, null, $code, $MSG));
        }
    }

    public function editPermission(Request $request){

        // start timer
        $startTime = microtime(true);
        $action = 'editPermission';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        if(Permission::permissionExist($request->id)) {

            Permission::edit($request);


            // log
            $MSG = 'success!';
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

            return json_encode(Permission::packResponse(null, null, $code, $MSG));
        }else{

            // log
            $MSG = 'Permission not exist!';
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

            return json_encode(Permission::packResponse(null, null, $code, $MSG));
        }
    }

    public function deletePermission(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'deletePermission';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        if(Permission::permissionExist($request->id)) {

            Permission::remove($request->id);

            // log
            $MSG = 'success!';
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
            return json_encode(Permission::packResponse(null, null, $code, $MSG));
        }else{

            // log
            $MSG = 'Permission not exist!';
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
            return json_encode(Permission::packResponse(null, null, $code, $MSG));
        }
    }


    //------------------------------------------------
    // Permission
    //------------------------------------------------
    //------------------------------------------------
    public function GetAllRole(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'GetAllRole';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $role = Role::getAllRole();

        if($role != null){

            // log
            $MSG = 'success!';
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
            return json_encode(Role::packResponse($role, null, $MSG, $code));
        }else{

            // log
            $MSG = 'there are no role!';
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
            return json_encode(Role::packResponse(null, null, $code, $MSG));
        }
    }

    public function addRole(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'addRole';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        if(!Role::checkIfNameExist($request->name)){

            self::_addRole($request, 1);

            // log
            $MSG = 'success!';
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
            return json_encode(Role::packResponse(null, null, $code, $MSG));
        }else{

            // log
            $MSG = 'Role name is exist!';
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
            return json_encode(Role::packResponse(null, null, $code, $MSG));
        }
    }

    public function editRole(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'editRole';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        if(Role::RoleExist($request->id)) {

            Role::edit($request);

            // log
            $MSG = 'success!';
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
            return json_encode(Role::packResponse(null, null, $MSG, $MSG));
        }else{

            // log
            $MSG = 'Role not exist!';
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
            return json_encode(Role::packResponse(null, null, $code, $MSG));
        }
    }

    public function deleteRole(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'deleteRole';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        if(Role::RoleExist($request->id)) {

            Role::remove($request->id);

            // log
            $MSG = 'success!';
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
            return json_encode(Role::packResponse(null, null, $code, $MSG));
        }else{

            // log
            $MSG = 'Role not exist!';
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
            return json_encode(Role::packResponse(null, null, $code, $MSG));
        }
    }

    //------------------------------------------------
    // Permission & Role
    //------------------------------------------------
    //------------------------------------------------
    public function attachPermissionToRole(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'attachPermissionToRole';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $permission = Permission::where('id', $request->permission_id)->first();

        if($permission != null){
            $role = Role::where('id', $request->role_id)->first();

            if($role != null){

                $role->attachPermission($permission);

                // log
                $MSG = 'success!';
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
                return json_encode(Role::packResponse(null, null, $code, $MSG));
            }else{

                // log
                $MSG = 'role not exist!';
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
                return json_encode(Role::packResponse(null, null, $code, $MSG));
            }
        }else{

            // log
            $MSG = 'permission not exist!';
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
            return json_encode(Role::packResponse(null, null, $code, $MSG));
        }
    }

    public function deAttachPermissionToRole(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'deAttachPermissionToRole';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $permission = Permission::where('id', $request->permission_id)->first();

        if($permission != null){
            $role = Role::where('id', $request->role_id)->first();

            if($role != null){

                $role->detachPermission($permission);

                // log
                $MSG = 'success!';
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
                return json_encode(Role::packResponse(null, null, $code, $MSG));
            }else{

                // log
                $MSG = 'role not exist!';
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
                return json_encode(Role::packResponse(null, null, $code, $MSG));
            }
        }else{

            // log
            $MSG = 'permission not exist!';
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
            return json_encode(Role::packResponse(null, null, $code, $MSG));
        }
    }


    //------------------------------------------------
    // User & Permission
    //------------------------------------------------
    //------------------------------------------------

    public function attachPermissionToUser(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'attachPermissionToUser';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $user = User::where('id', $request->user_id)->first();

        if($user != null){
            $permission = Permission::where('id', $request->permission_id)->first();

            if($permission != null){

                $user->attachPermission($permission);

                // log
                $MSG = 'success!';
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
                return json_encode(Role::packResponse(null, null, $code, $MSG));
            }else{

                // log
                $MSG = 'permission not exist!';
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
                return json_encode(Role::packResponse(null, null, $code, $MSG));
            }
        }else{

            // log
            $MSG = 'user not exist!';
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
            return json_encode(Role::packResponse(null, null, $code, $MSG));
        }
    }

    public function deAttachPermissionToUser(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'deAttachPermissionToUser';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $user = User::where('id', $request->user_id)->first();

        if($user != null){
            $permission = Permission::where('id', $request->permission_id)->first();

            if($permission != null){

                $user->detachPermission($permission);

                // log
                $MSG = 'success!';
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
                return json_encode(Role::packResponse(null, null, $code, $MSG));
            }else{

                // log
                $MSG = 'permission not exist!';
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
                return json_encode(Role::packResponse(null, null, $code, $MSG));
            }
        }else{

            // log
            $MSG = 'user not exist!';
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
            return json_encode(Role::packResponse(null, null, $code, $MSG));
        }
    }


    //------------------------------------------------
    // User & Role
    //------------------------------------------------
    //------------------------------------------------
    public function attachUserToRole(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'attachUserToRole';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $user = User::where('id', $request->user_id)->first();

        if($user != null){
            $role = Role::where('id', $request->role_id)->first();

            if($role != null){

                $user->attachRole($role);

                // log
                $MSG = 'success!';
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
                return json_encode(Role::packResponse(null, null, $code, $MSG));
            }else{

                // log
                $MSG = 'role not exist!';
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
                return json_encode(Role::packResponse(null, null, $code, $MSG));
            }
        }else{

            // log
            $MSG = 'user not exist!';
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
            return json_encode(Role::packResponse(null, null, $code, $MSG));
        }
    }

    public function deAttachUserToRole(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'deAttachUserToRole';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------


        $user = User::where('id', $request->user_id)->first();

        if($user != null){
            $role = Role::where('id', $request->role_id)->first();

            if($role != null){

                $user->detachRole($role);


                // log
                $MSG = 'success!';
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
                return json_encode(Role::packResponse(null, null, $code, $MSG));
            }else{

                // log
                $MSG = 'role not exist!';
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
                return json_encode(Role::packResponse(null, null, $code, $MSG));
            }
        }else{

            // log
            $MSG = 'user not exist!';
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
            return json_encode(Role::packResponse(null, null, $code, $MSG));
        }
    }



    //------------------------------------------------
    // checking user permission and role
    //------------------------------------------------
    //------------------------------------------------

    public function hasRole(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'hasRole';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $user = User::where('id', $request->user_id)->first();

        if($user != null){

            if($user->hasRole($request->roleName)){

                // log
                $MSG = 'success!';
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
                return json_encode(Boolean::packResponse(true, null, $code, $MSG));
            }else{

                // log
                $MSG = 'user not have this role!';
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
                return json_encode(Boolean::packResponse(false, null, $code, $MSG));
            }
        }else{

            // log
            $MSG = 'user not exist!';
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
            return json_encode(Role::packResponse(null, null, $code, $MSG));
        }
    }

    public function hasPermission(Request $request){
        // start timer
        $startTime = microtime(true);
        $action = 'hasPermission';
        //-----------------------

        // get user_id by session
        $user = User::getUserBySession($request['sessionkey']);
        $request['user_id'] = $user->id;
        //-----------------------

        $user = User::where('id', $request->user_id)->first();

        if($user != null){

            if($user->can($request->permissionName)){

                // log
                $MSG = 'success!';
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
                return json_encode(Boolean::packResponse(true, null, $code, $MSG));
            }else{

                // log
                $MSG = 'user not have this role!';
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
                return json_encode(Boolean::packResponse(false, null, $code, $MSG));
            }
        }else{

            // log
            $MSG = 'user not exist!';
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
            return json_encode(Role::packResponse(null, null, $code, $MSG));
        }
    }


    //------------------------------------------------
    // helper method
    //------------------------------------------------
    //------------------------------------------------


    public function addPermission($object, $objType){

        try{

            $permission = new Permission();
            $permission->setallAttribute($object);
            $permission = $permission->save();

            return $permission;

        } catch (Exception $e) {
            return json_encode(User::packResponse(null, null, 400, $e->getMessage()));
        }

    }


    public function _addRole($object, $objType){

        try{

            $role = new Role();
            $role->setallAttribute($object);
            $role = $role->save();

            return $role;

        } catch (Exception $e) {
            return json_encode(User::packResponse(null, null, 400, $e->getMessage()));
        }

    }

}
