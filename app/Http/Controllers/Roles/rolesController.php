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

class rolesController extends Controller
{
    //------------------------------------------------
    // Permission
    //------------------------------------------------
    //------------------------------------------------
    public function getAllPermission(Request $request){

        $permission = Permission::getAllPermission();

        if($permission != null){


            return json_encode(Permission::packResponse($permission, null, 200, 'success!'));
        }else{
            return json_encode(Permission::packResponse(null, null, 400, 'there are no permission!'));
        }
    }

    public function addMainPermission(Request $request){

        if(!Permission::checkIfNameExist($request->name)){

            $request['parent_id'] = 0;
            self::addPermission($request, 1);

            return json_encode(Permission::packResponse(null, null, 200, 'success!'));
        }else{
            return json_encode(Permission::packResponse(null, null, 400, 'Permission name is exist!'));
        }
    }

    public function addSubPermission(Request $request){

        if(!Permission::checkIfNameExist($request->name)){

            self::addPermission($request, 0);

            return json_encode(Permission::packResponse(null, null, 200, 'success!'));
        }else{
            return json_encode(Permission::packResponse(null, null, 400, 'Permission name is exist!'));
        }
    }

    public function editPermission(Request $request){

        if(Permission::permissionExist($request->id)) {

            Permission::edit($request);


            return json_encode(Permission::packResponse(null, null, 200, 'success!'));
        }else{
            return json_encode(Permission::packResponse(null, null, 400, 'Permission not exist!'));
        }
    }

    public function deletePermission(Request $request){

        if(Permission::permissionExist($request->id)) {

            Permission::remove($request->id);

            return json_encode(Permission::packResponse(null, null, 200, 'success!'));
        }else{
            return json_encode(Permission::packResponse(null, null, 400, 'Permission not exist!'));
        }
    }


    //------------------------------------------------
    // Permission
    //------------------------------------------------
    //------------------------------------------------
    public function GetAllRole(Request $request){

        $role = Role::getAllRole();

        if($role != null){

            return json_encode(Role::packResponse($role, null, 200, 'success!'));
        }else{
            return json_encode(Role::packResponse(null, null, 400, 'there are no role!'));
        }
    }

    public function addRole(Request $request){

        if(!Role::checkIfNameExist($request->name)){

            self::_addRole($request, 1);

            return json_encode(Role::packResponse(null, null, 200, 'success!'));
        }else{
            return json_encode(Role::packResponse(null, null, 400, 'Role name is exist!'));
        }
    }

    public function editRole(Request $request){

        if(Role::RoleExist($request->id)) {

            Role::edit($request);

            return json_encode(Role::packResponse(null, null, 200, 'success!'));
        }else{
            return json_encode(Role::packResponse(null, null, 400, 'Role not exist!'));
        }
    }

    public function deleteRole(Request $request){

        if(Role::RoleExist($request->id)) {

            Role::remove($request->id);

            return json_encode(Role::packResponse(null, null, 200, 'success!'));
        }else{
            return json_encode(Role::packResponse(null, null, 400, 'Role not exist!'));
        }
    }

    //------------------------------------------------
    // Permission & Role
    //------------------------------------------------
    //------------------------------------------------
    public function attachPermissionToRole(Request $request){

        $permission = Permission::where('id', $request->permission_id)->first();

        if($permission != null){
            $role = Role::where('id', $request->role_id)->first();

            if($role != null){

                $role->attachPermission($permission);

                return json_encode(Role::packResponse(null, null, 200, 'success!'));
            }else{
                return json_encode(Role::packResponse(null, null, 400, 'role not exist!'));
            }
        }else{
            return json_encode(Role::packResponse(null, null, 400, 'permission not exist!'));
        }
    }

    public function deAttachPermissionToRole(Request $request){

        $permission = Permission::where('id', $request->permission_id)->first();

        if($permission != null){
            $role = Role::where('id', $request->role_id)->first();

            if($role != null){

                $role->detachPermission($permission);

                return json_encode(Role::packResponse(null, null, 200, 'success!'));
            }else{
                return json_encode(Role::packResponse(null, null, 400, 'role not exist!'));
            }
        }else{
            return json_encode(Role::packResponse(null, null, 400, 'permission not exist!'));
        }
    }


    //------------------------------------------------
    // User & Permission
    //------------------------------------------------
    //------------------------------------------------

    public function attachPermissionToUser(Request $request){

        $user = User::where('id', $request->user_id)->first();

        if($user != null){
            $permission = Permission::where('id', $request->permission_id)->first();

            if($permission != null){

                $user->attachPermission($permission);

                return json_encode(Role::packResponse(null, null, 200, 'success!'));
            }else{
                return json_encode(Role::packResponse(null, null, 400, 'permission not exist!'));
            }
        }else{
            return json_encode(Role::packResponse(null, null, 400, 'user not exist!'));
        }
    }

    public function deAttachPermissionToUser(Request $request){

        $user = User::where('id', $request->user_id)->first();

        if($user != null){
            $permission = Permission::where('id', $request->permission_id)->first();

            if($permission != null){

                $user->detachPermission($permission);

                return json_encode(Role::packResponse(null, null, 200, 'success!'));
            }else{
                return json_encode(Role::packResponse(null, null, 400, 'permission not exist!'));
            }
        }else{
            return json_encode(Role::packResponse(null, null, 400, 'user not exist!'));
        }
    }


    //------------------------------------------------
    // User & Role
    //------------------------------------------------
    //------------------------------------------------
    public function attachUserToRole(Request $request){

        $user = User::where('id', $request->user_id)->first();

        if($user != null){
            $role = Role::where('id', $request->role_id)->first();

            if($role != null){

                $user->attachRole($role);

                return json_encode(Role::packResponse(null, null, 200, 'success!'));
            }else{
                return json_encode(Role::packResponse(null, null, 400, 'role not exist!'));
            }
        }else{
            return json_encode(Role::packResponse(null, null, 400, 'user not exist!'));
        }
    }

    public function deAttachUserToRole(Request $request){

        $user = User::where('id', $request->user_id)->first();

        if($user != null){
            $role = Role::where('id', $request->role_id)->first();

            if($role != null){

                $user->detachRole($role);

                return json_encode(Role::packResponse(null, null, 200, 'success!'));
            }else{
                return json_encode(Role::packResponse(null, null, 400, 'role not exist!'));
            }
        }else{
            return json_encode(Role::packResponse(null, null, 400, 'user not exist!'));
        }
    }



    //------------------------------------------------
    // checking user permission and role
    //------------------------------------------------
    //------------------------------------------------

    public function hasRole(Request $request){

        $user = User::where('id', $request->user_id)->first();

        if($user != null){

            if($user->hasRole($request->roleName)){

                return json_encode(Boolean::packResponse(true, null, 200, 'success!'));
            }else{
                return json_encode(Boolean::packResponse(false, null, 400, 'user not have this role!'));
            }
        }else{
            return json_encode(Role::packResponse(null, null, 400, 'user not exist!'));
        }
    }

    public function hasPermission(Request $request){

        $user = User::where('id', $request->user_id)->first();

        if($user != null){

            if($user->can($request->permissionName)){

                return json_encode(Boolean::packResponse(true, null, 200, 'success!'));
            }else{
                return json_encode(Boolean::packResponse(false, null, 400, 'user not have this role!'));
            }
        }else{
            return json_encode(Role::packResponse(null, null, 400, 'user not exist!'));
        }
    }


    //------------------------------------------------
    // helper method
    //------------------------------------------------
    //------------------------------------------------


    public function addPermission($object, $objType){

        try{

            $permission = new Permission();
            $permission->setallAttribute($object, $objType);
            $permission = $permission->save();

            return $permission;

        } catch (Exception $e) {
            return json_encode(User::packResponse(null, null, 400, $e->getMessage()));
        }

    }


    public function _addRole($object, $objType){

        try{

            $role = new Role();
            $role->setallAttribute($object, $objType);
            $role = $role->save();

            return $role;

        } catch (Exception $e) {
            return json_encode(User::packResponse(null, null, 400, $e->getMessage()));
        }

    }

}
