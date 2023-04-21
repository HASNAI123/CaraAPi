<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::apiResource('users', 'App\Http\Controllers\Api\V1\UsersController');
});

Route::post('register', 'App\Http\Controllers\Auth\RegisterController@register');

Route::put('user_update', 'App\Http\Controllers\Auth\RegisterController@user_update');

Route::get('/users', [\App\Http\Controllers\Api\V1\UsersController::class, 'index']);
Route::get('sops', 'App\Http\Controllers\GeneratesopController@index');

Route::get('/generatesops', [\App\Http\Controllers\Api\V1\GeneratesopController::class, 'index']);
Route::get('/generatesops/{id}', [\App\Http\Controllers\Api\V1\GeneratesopController::class, 'show']);
Route::post('/generatesops', [\App\Http\Controllers\Api\V1\GeneratesopController::class, 'store']);
Route::put('/generatesops/{id}', [\App\Http\Controllers\Api\V1\GeneratesopController::class, 'update']);
Route::delete('/generatesops/{id}', [App\Http\Controllers\Api\GeneratesopController::class, 'destroy']);
Route::post('/generatesops/upload', [App\Http\Controllers\Api\v1\GeneratesopController::class, 'upload']);


//Get users by role
Route::get('users/role/{role}', [\App\Http\Controllers\Api\V1\UsersController::class, 'getUsersByRole']);



Route::get('archivefolders', '\App\Http\Controllers\Api\V1\folder_archiveController@index');
Route::post('archivefolders', '\App\Http\Controllers\Api\V1\folder_archiveController@store');
Route::get('archivefolders/{id}', '\App\Http\Controllers\Api\V1\folder_archiveController@show');
Route::put('api/archivefolders/{id}', '\App\Http\Controllers\Api\V1\folder_archiveController@update');
Route::delete('api/archivefolders/{id}', '\App\Http\Controllers\Api\V1\folder_archiveController@destroy');
Route::get('api/archivefolders/{id}/check', '\App\Http\Controllers\Api\V1\folder_archiveController@check');
Route::get('api/archivefolders/{id}/showfolder', '\App\Http\Controllers\Api\V1\folder_archiveController@showfolder');


Route::prefix('v1')->group(function () {
    Route::get('folders', '\App\Http\Controllers\Api\V1\folder_libraryController@index');
    Route::get('folders/{id}', '\App\Http\Controllers\Api\V1\folder_libraryController@show');
    Route::post('folders', '\App\Http\Controllers\Api\V1\folder_libraryController@store');
    Route::put('folders/{id}', '\App\Http\Controllers\Api\V1\folder_libraryController@update');
    Route::delete('folders/{id}', '\App\Http\Controllers\Api\V1\folder_libraryController@destroy');
    Route::delete('folders/mass-delete', '\App\Http\Controllers\Api\V1\folder_libraryController@massDestroy');
    Route::put('folders/{id}/restore', '\App\Http\Controllers\Api\V1\folder_libraryController@restore');
    Route::delete('folders/{id}/perma-del', '\App\Http\Controllers\Api\V1\folder_libraryController@perma_del');
});

//Count Number of Users
Route::get('total_users', '\App\Http\Controllers\Api\V1\HomeController@total_users');

//Count Number of Users
Route::get('total_generatesops', '\App\Http\Controllers\Api\V1\HomeController@total_generatesops');





Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
Route::get('onlineUsers', 'App\Http\Controllers\Auth\LoginController@getOnlineUsersCount');


Route::post('/api/v1/roles/{role_id}/permissions', [\App\Http\Controllers\Api\v1\PermissionController::class, 'addPermissionsToRole']);


Route::middleware('auth:api')->group(function () {
    Route::post('logout', 'App\Http\Controllers\Api\V1\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\Api\V1\AuthController@refresh');
});


