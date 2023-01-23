<?php

use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/properties/all',[PropertyController::class,'all_properties']);

Route::post('/properties/nearby',[PropertyController::class,'nearby_properties']);

Route::post('/properties/category',[PropertyController::class,'all_categories']);

Route::post('/properties/images',[PropertyController::class,'imgs_property']);

Route::post('/properties/details',[PropertyController::class,'details_property']);

Route::post('/properties/userdetails',[UsersController::class, 'user_details']);

Route::get('/properties/locations',[PropertyController::class,'all_locations']);

Route::get('/properties/propertynames',[PropertyController::class,'prop_names']);

Route::post('/properties/search',[propertyController::class, 'search_properties']);

Route::post('/properties/amenities',[PropertyController::class, 'amenities']);

Route::post('/properties/login',[UsersController::class,'user_login']);

Route::post('/properties/register',[UsersController::class,'user_register']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
