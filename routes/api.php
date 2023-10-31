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

//rando
Route::post('register', 'App\Http\Controllers\Auth\RegisterController@register');

Route::put('user_update', 'App\Http\Controllers\Auth\RegisterController@user_update');

Route::get('/users/{user_id}', 'App\Http\Controllers\Api\V1\UsersController@getUserByUserId');


//Checklists API

//Checklists Security Aeon

Route::post('/SAstore', 'App\Http\Controllers\Api\V1\ChecklistController@SAstore');

Route::get('/SAstore', 'App\Http\Controllers\Api\V1\ChecklistController@index');

Route::get('/SAstore/{id}', 'App\Http\Controllers\Api\V1\ChecklistController@getRemarkSAById');

Route::delete('/SAstore/{id}', 'App\Http\Controllers\Api\V1\ChecklistController@deleteRemarkSAById');

Route::put('/SAstore/{id}', 'App\Http\Controllers\Api\V1\ChecklistController@updateRemarkSAById');



//Checklists Security Aeon Big

Route::post('/SABstore', 'App\Http\Controllers\Api\V1\ChecklistController@SABstore');

Route::get('/SABstore', 'App\Http\Controllers\Api\V1\ChecklistController@GETSAB');

Route::get('/SABstore/{id}', 'App\Http\Controllers\Api\V1\ChecklistController@getRemarkSABById');

Route::delete('/SABstore/{id}', 'App\Http\Controllers\Api\V1\ChecklistController@deleteRemarkSABById');

Route::put('/SABstore/{id}', 'App\Http\Controllers\Api\V1\ChecklistController@updateRemarkSABById');




// WELLNESS CHECKLISTS

// Beauty

Route::post('/Beauty', 'App\Http\Controllers\Api\V1\WellnessController@beautystore');

Route::get('/Beauty', 'App\Http\Controllers\Api\V1\WellnessController@BeautyAll');

Route::get('/Beauty/{id}', 'App\Http\Controllers\Api\V1\WellnessController@getBeautyById');

Route::delete('/Beauty/{id}', 'App\Http\Controllers\Api\V1\WellnessController@deleteBeautyById');

Route::put('/Beauty/{id}', 'App\Http\Controllers\Api\V1\WellnessController@updateBeautyAById');


// Nutritionalist


Route::post('/Nutritionalist', 'App\Http\Controllers\Api\V1\WellnessController@NUTRITIONISTstore');

Route::get('/Nutritionalist', 'App\Http\Controllers\Api\V1\WellnessController@NUTRITIONISTAll');

Route::get('/Nutritionalist/{id}', 'App\Http\Controllers\Api\V1\WellnessController@getNUTRITIONISTById');

Route::delete('/Nutritionalist/{id}', 'App\Http\Controllers\Api\V1\WellnessController@deleteNUTRITIONISTById');

Route::put('/Nutritionalist/{id}', 'App\Http\Controllers\Api\V1\WellnessController@updateNUTRITIONISTyId');

// Operations


Route::post('/Pharmacist', 'App\Http\Controllers\Api\V1\WellnessController@Pharmaciststore');

Route::get('/Pharmacist', 'App\Http\Controllers\Api\V1\WellnessController@OperationsAll');

Route::get('/Pharmacist/{id}', 'App\Http\Controllers\Api\V1\WellnessController@getOperationsById');

Route::delete('/Pharmacist/{id}', 'App\Http\Controllers\Api\V1\WellnessController@deleteOperationsById');

Route::put('/Pharmacist/{id}', 'App\Http\Controllers\Api\V1\WellnessController@updateOperationsbyId');



//Pharmacist


Route::post('/Operations', 'App\Http\Controllers\Api\V1\WellnessController@Operationsstore');

Route::get('/Operations', 'App\Http\Controllers\Api\V1\WellnessController@PharmacistAll');

Route::get('/Operations/{id}', 'App\Http\Controllers\Api\V1\WellnessController@getPharmacistById');

Route::delete('/Operations/{id}', 'App\Http\Controllers\Api\V1\WellnessController@deletePharmacistById');

Route::put('/Operations/{id}', 'App\Http\Controllers\Api\V1\WellnessController@updatePharmacistbyId');


//Loss Prevention


Route::post('/LossPrevention', 'App\Http\Controllers\Api\V1\WellnessController@LossPreventionstore');

Route::get('/LossPrevention', 'App\Http\Controllers\Api\V1\WellnessController@LossPreventionAll');

Route::get('/LossPrevention/{id}', 'App\Http\Controllers\Api\V1\WellnessController@getLossPreventionById');

Route::delete('/LossPrevention/{id}', 'App\Http\Controllers\Api\V1\WellnessController@deleteLossPreventionById');

Route::put('/LossPrevention/{id}', 'App\Http\Controllers\Api\V1\WellnessController@updateLossPreventionbyId');



//SAFETY CHECKLISTS

// AEON MALL AUDIT

Route::post('/AeonMallAudit', 'App\Http\Controllers\Api\V1\SafetyController@AeonMallAuditstore');

Route::get('/AeonMallAudit', 'App\Http\Controllers\Api\V1\SafetyController@AeonMallAuditAll');

Route::get('/AeonMallAudit/{id}', 'App\Http\Controllers\Api\V1\SafetyController@AeonMallAuditById');

Route::delete('/AeonMallAudit/{id}', 'App\Http\Controllers\Api\V1\SafetyController@ddeleteAeonMallAuditById');

Route::put('/AeonMallAudit/{id}', 'App\Http\Controllers\Api\V1\SafetyController@updateAeonMallAuditAById');



// AEON Store AUDIT

Route::post('/AeonStoreAudit', 'App\Http\Controllers\Api\V1\SafetyController@AeonStoreAuditstore');

Route::get('/AeonStoreAudit', 'App\Http\Controllers\Api\V1\SafetyController@AeonStoreAuditAll');

Route::get('/AeonStoreAudit/{id}', 'App\Http\Controllers\Api\V1\SafetyController@AeonStoreAuditById');

Route::delete('/AeonStoreAudit/{id}', 'App\Http\Controllers\Api\V1\SafetyController@deleteAeonStoreAuditById');

Route::put('/AeonStoreAudit/{id}', 'App\Http\Controllers\Api\V1\SafetyController@updateAeonStoreAuditAById');


// AEON Big AUDIT

Route::post('/AeonBigAudit', 'App\Http\Controllers\Api\V1\SafetyController@AeonBigAuditstore');

Route::get('/AeonBigAudit', 'App\Http\Controllers\Api\V1\SafetyController@AeonBigAuditAll');

Route::get('/AeonBigAudit/{id}', 'App\Http\Controllers\Api\V1\SafetyController@AeonBigAuditById');

Route::delete('/AeonBigAudit/{id}', 'App\Http\Controllers\Api\V1\SafetyController@deleteAeonBigAuditById');

Route::put('/AeonBigAudit/{id}', 'App\Http\Controllers\Api\V1\SafetyController@updateAeonBigAuditAById');



// AEON FPC AUDIT

Route::post('/AeonFPCAudit', 'App\Http\Controllers\Api\V1\SafetyController@AeonFPCAuditstore');

Route::get('/AeonFPCAudit', 'App\Http\Controllers\Api\V1\SafetyController@AeonFPCAuditAll');

Route::get('/AeonFPCAudit/{id}', 'App\Http\Controllers\Api\V1\SafetyController@AeonFPCAuditById');

Route::delete('/AeonFPCAudit/{id}', 'App\Http\Controllers\Api\V1\SafetyController@deleteAeonFPCAuditById');

Route::put('/AeonFPCAudit/{id}', 'App\Http\Controllers\Api\V1\SafetyController@updateAeonFPCAuditAById');


Route::get('/users', [\App\Http\Controllers\Api\V1\UsersController::class, 'index']);
Route::get('sops', 'App\Http\Controllers\GeneratesopController@index');


Route::get('/generatesops', [\App\Http\Controllers\Api\V1\GeneratesopController::class, 'index']);
Route::get('/generatesops/{id}', [\App\Http\Controllers\Api\V1\GeneratesopController::class, 'show']);
Route::post('/generatesops', [\App\Http\Controllers\Api\V1\GeneratesopController::class, 'store']);
Route::put('/generatesops/{id}', [\App\Http\Controllers\Api\V1\GeneratesopController::class, 'update']);
Route::delete('/generatesops/{id}', [App\Http\Controllers\Api\V1\GeneratesopController::class, 'destroy']);
Route::post('/generatesops/upload', [App\Http\Controllers\Api\v1\GeneratesopController::class, 'upload']);

//Sop upload api
Route::prefix('v1')->group(function () {
    Route::post('sops', '\App\Http\Controllers\Api\V1\Sop_upload@store')->name('sops.store');
});



//Get users by role
Route::get('users/role/{role}', [\App\Http\Controllers\Api\V1\UsersController::class, 'getUsersByRole']);





Route::prefix('v1')->group(function () {
    Route::get('folders', '\App\Http\Controllers\Api\V1\folder_libraryController@index');
    Route::get('folders/{id}', '\App\Http\Controllers\Api\V1\folder_libraryController@show');
    Route::post('createfolder', '\App\Http\Controllers\Api\V1\folder_libraryController@store');
Route::put('folders/{id}', '\App\Http\Controllers\Api\V1\folder_libraryController@update');
    Route::delete('folders/{id}', '\App\Http\Controllers\Api\V1\folder_libraryController@deleteFolder');
    Route::delete('folders/mass-delete', '\App\Http\Controllers\Api\V1\folder_libraryController@massDestroy');
    Route::put('folders/{id}/restore', '\App\Http\Controllers\Api\V1\folder_libraryController@restore');
    Route::delete('folders/{id}/perma-del', '\App\Http\Controllers\Api\V1\folder_libraryController@perma_del');
});

Route::delete('/archivefolders/{id}', '\App\Http\Controllers\Api\V1\folder_archiveController@deleteFolder');
Route::get('archivefolders', '\App\Http\Controllers\Api\V1\folder_archiveController@index');
Route::post('createarchivefolder', '\App\Http\Controllers\Api\V1\folder_archiveController@store');
Route::get('archivefolders/{id}', '\App\Http\Controllers\Api\V1\folder_archiveController@show');
Route::put('archivefolders/{id}', '\App\Http\Controllers\Api\V1\folder_archiveController@update');
Route::get('api/archivefolders/{id}/check', '\App\Http\Controllers\Api\V1\folder_archiveController@check');
Route::get('api/archivefolders/{id}/showfolder', '\App\Http\Controllers\Api\V1\folder_archiveController@showfolder');

//Count Number of Users  12
Route::get('total_users', '\App\Http\Controllers\Api\V1\HomeController@total_users');

//Count Number of Users
Route::get('total_generatesops', '\App\Http\Controllers\Api\V1\HomeController@total_generatesops');

Route::get('/logs', '\App\Http\Controllers\Api\V1\LogController@index');

//Login APi routes

Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
Route::get('onlineUsers', 'App\Http\Controllers\Auth\LoginController@getOnlineUsersCount');

Route::post('feedback', '\App\Http\Controllers\Api\V1\FeedbackController@store');


Route::post('/api/v1/roles/{role_id}/permissions', [\App\Http\Controllers\Api\v1\PermissionController::class, 'addPermissionsToRole']);

//Uploaded Sop
Route::get('sops', '\App\Http\Controllers\Api\V1\SopController@getSop');
Route::delete('sops/{id}', 'App\Http\Controllers\Api\V1\SopController@deleteSop');

//Generated Sops
Route::get('Generated_sops', '\App\Http\Controllers\Api\V1\SopController@getAllGeneratedSops');


Route::middleware('auth:api')->group(function () {
    Route::post('logout', 'App\Http\Controllers\Api\V1\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\Api\V1\AuthController@refresh');
});


