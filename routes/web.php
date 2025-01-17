<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UploadImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('allproperties',[PropertyController::class,'allproperties']);



Route::get('/', function () {
    return view('welcome');
});

Route::get('/upload', function () {
    return view('upload');
});


Route::post('/upload-image', [UploadImageController::class, 'uploadAndInsert']);


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
