<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AmenitiesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/ 

Route::group(['prefix'=>'V1'], function()  { 
    /**auth routes */
    Route::middleware(['auth:sanctum'])->group(function(){

Route::post('/properties/uploadproperty',[HomeController::class,'UploadProperty']);

Route::get('/properties/all',[HomeController::class,'all_properties']);

Route::post('/properties/nearby',[HomeController::class,'nearby_properties']);

Route::post('/properties/category',[HomeController::class,'all_categories']);

Route::post('/properties/images',[HomeController::class,'imgs_property']);

Route::post('/properties/details',[HomeController::class,'details_property']);

Route::post('/properties/userdetails',[UsersController::class, 'user_details']);

Route::get('/properties/locations',[HomeController::class,'all_locations']);

Route::get('/properties/propertynames',[HomeController::class,'prop_names']);

Route::post('/properties/search',[HomeController::class, 'search_properties']);

Route::post('/properties/amenities',[AmenitiesController::class, 'amenities']);

Route::apiResource('amenities', AmenitiesController::class);

// Route::post('/properties/amenities',[AmenitiesController::class, 'amenities']);


});


Route::post('login',[UsersController::class,'user_login']);

Route::post('register',[UsersController::class,'user_register']);

});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
