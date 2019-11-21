<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//-------------------------------------------
//  authController
//-------------------------------------------
//-------------------------------------------
Route::post('/login', 'Auth\authController@login')->name('login');
Route::post('/logout', 'Auth\authController@logout')->name('logout')->middleware('checkRole');
Route::post('/register', 'Auth\authController@register')->name('register');
Route::post('/editUser', 'Auth\authController@editUser')->name('editUser');
Route::post('/verifyaccount', 'Auth\authController@verifyAccount')->name('verifyaccount');
Route::post('/verifyRestingPassword', 'Auth\authController@verifyRestingPassword')->name('verifyRestingPassword');
Route::post('/sendVerificationCodeRegistering', 'Auth\authController@sendVerificationCodeRegistering')->name('sendVerificationCodeRegistering');
Route::post('/sendVerificationCodeResetingPasssword', 'Auth\authController@sendVerificationCodeResetingPasssword')->name('sendVerificationCodeResetingPasssword');
Route::post('/resetPassword', 'Auth\authController@resetPassword')->name('resetPassword');
Route::post('/changePassword', 'Auth\authController@changePassword')->name('changePassword');
//-------------------------------------------
//-------------------------------------------
//-------------------------------------------


//-------------------------------------------
//  rolesController
//-------------------------------------------
//-------------------------------------------
Route::post('/getAllPermission', 'Roles\rolesController@getAllPermission')->name('getAllPermission');//->middleware('checkRole:hhh');
Route::post('/addMainPermission', 'Roles\rolesController@addMainPermission')->name('addMainPermission');
Route::post('/addSubPermission', 'Roles\rolesController@addSubPermission')->name('addSubPermission');
Route::post('/editPermission', 'Roles\rolesController@editPermission')->name('editPermission');
Route::post('/deletePermission', 'Roles\rolesController@deletePermission')->name('deletePermission');
//-------------------------------------------
//-------------------------------------------
//-------------------------------------------


//-------------------------------------------
//  rolesController
//-------------------------------------------
//-------------------------------------------
Route::post('/GetAllRole', 'Roles\rolesController@GetAllRole')->name('GetAllRole');
Route::post('/addRole', 'Roles\rolesController@addRole')->name('addRole');
Route::post('/editRole', 'Roles\rolesController@editRole')->name('editRole');
Route::post('/deleteRole', 'Roles\rolesController@deleteRole')->name('deleteRole');
Route::post('/editRole', 'Roles\rolesController@editRole')->name('editRole');

//-------------------------------------------
//-------------------------------------------
//-------------------------------------------



//-------------------------------------------
//  Permission & Role
//-------------------------------------------
//-------------------------------------------
Route::post('/attachPermissionToRole', 'Roles\rolesController@attachPermissionToRole')->name('attachPermissionToRole');
Route::post('/deAttachPermissionToRole', 'Roles\rolesController@deAttachPermissionToRole')->name('deAttachPermissionToRole');


//-------------------------------------------
//  User & Role
//-------------------------------------------
//-------------------------------------------
Route::post('/attachRoleToUser', 'Roles\rolesController@attachRoleToUser')->name('attachRoleToUser');
Route::post('/deAttachRoleToUser', 'Roles\rolesController@deAttachRoleToUser')->name('deAttachRoleToUser');

//-------------------------------------------
//-------------------------------------------
//-------------------------------------------



//-------------------------------------------
//  User & Permission
//-------------------------------------------
//-------------------------------------------
Route::post('/attachPermissionToUser', 'Roles\rolesController@attachPermissionToUser')->name('attachPermissionToUser');
Route::post('/deAttachPermissionToUser', 'Roles\rolesController@deAttachPermissionToUser')->name('deAttachPermissionToUser');

//-------------------------------------------
//-------------------------------------------
//-------------------------------------------



//------------------------------------------------
// checking user permission and role
//------------------------------------------------
//------------------------------------------------
Route::post('/hasRole', 'Roles\rolesController@hasRole')->name('hasRole');
Route::post('/hasPermission', 'Roles\rolesController@hasPermission')->name('hasPermission');

//-------------------------------------------
//-------------------------------------------
//-------------------------------------------



//------------------------------------------------
// RealEstate
//------------------------------------------------
//------------------------------------------------
Route::post('/createRealEstate', 'RealEstate\realestateController@createRealEstate')->name('createRealEstate');//->middleware('checkRole');
Route::post('/DeleteRealEstate', 'RealEstate\realestateController@DeleteRealEstate')->name('DeleteRealEstate');//->middleware('checkRole');
Route::post('/HideRealEstate', 'RealEstate\realestateController@HideRealEstate')->name('HideRealEstate');//->middleware('checkRole');
Route::post('/unHideRealEstate', 'RealEstate\realestateController@unHideRealEstate')->name('unHideRealEstate');//->middleware('checkRole');
Route::post('/getRealEstatesLists', 'RealEstate\realestateController@getRealEstatesLists')->name('getRealEstatesLists');
Route::post('/hardDelete', 'RealEstate\realestateController@hardDelete')->name('hardDelete');
Route::post('/seenRealEstate', 'RealEstate\realestateController@seenRealEstate')->name('seenRealEstate');
//-------------------------------------------
//-------------------------------------------
//-------------------------------------------


//------------------------------------------------
// CostMeasure
//------------------------------------------------
//------------------------------------------------
Route::post('/addNewCostMeasure', 'measures\measuresController@addNewCostMeasure')->name('addNewCostMeasure');
Route::post('/editCostMeasure', 'measures\measuresController@editCostMeasure')->name('editCostMeasure');
Route::post('/deleteCostMeasure', 'measures\measuresController@deleteCostMeasure')->name('deleteCostMeasure');
Route::post('/getCostMeasuresList', 'measures\measuresController@getCostMeasuresList')->name('getCostMeasuresList');
//-------------------------------------------
//-------------------------------------------
//-------------------------------------------


//------------------------------------------------
// SizeMeasure
//------------------------------------------------
//------------------------------------------------
Route::post('/addNewSizeMeasure', 'measures\measuresController@addNewSizeMeasure')->name('addNewSizeMeasure');
Route::post('/editSizeMeasure', 'measures\measuresController@editSizeMeasure')->name('editSizeMeasure');
Route::post('/deleteSizeMeasure', 'measures\measuresController@deleteSizeMeasure')->name('deleteSizeMeasure');
Route::post('/getSizeMeasuresList', 'measures\measuresController@getSizeMeasuresList')->name('getSizeMeasuresList');
//-------------------------------------------
//-------------------------------------------
//-------------------------------------------


//------------------------------------------------
// socialmedia
//------------------------------------------------
//------------------------------------------------
Route::post('/like', 'Social\socialmediaController@like')->name('like');
Route::post('/dislike', 'Social\socialmediaController@dislike')->name('dislike');
Route::post('/likesCountOfRealEsatate', 'Social\socialmediaController@likesCountOfRealEsatate')->name('likesCountOfRealEsatate');
Route::post('/likesUserListsOfRealEstate', 'Social\socialmediaController@likesUserListsOfRealEstate')->name('likesUserListsOfRealEstate');
//-------------------------------------------
//-------------------------------------------
//-------------------------------------------



//------------------------------------------------
// socialmedia
//------------------------------------------------
//------------------------------------------------
Route::post('/addNotificationListener', 'Notification\notificationController@addNotificationListener')->name('addNotificationListener');
Route::post('/getNumberOfNotification', 'Notification\notificationController@getNumberOfNotification')->name('getNumberOfNotification');
Route::post('/getNotificationList', 'Notification\notificationController@getNotificationList')->name('getNotificationList');
Route::post('/getNotificationListenerList', 'Notification\notificationController@getNotificationListenerList')->name('getNotificationListenerList');
//-------------------------------------------
//-------------------------------------------
//-------------------------------------------





