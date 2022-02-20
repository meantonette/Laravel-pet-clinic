<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\animalController;
use App\Http\Controllers\rescuerController;
use App\Http\Controllers\personnelController;
use App\Http\Controllers\diseaseInjuryController;
use App\Http\Controllers\adopterController;
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

Route::resource('/animals', animalController::class)->middleware('isLoggedIn');
Route::resource('/rescuer', rescuerController::class)->middleware('isLoggedIn');
Route::resource('/diseaseinjury', diseaseInjuryController::class)->middleware('isLoggedIn');
Route::resource('/personnel', personnelController::class)->middleware('isLoggedIn');
