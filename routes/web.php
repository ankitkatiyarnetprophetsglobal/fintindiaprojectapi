<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PasswordresetController;
/******************nagendra ********************************/

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Api\ChanagePasswordController;
use App\Http\Controllers\HomeController;


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

Route::get('/', function () {    return view('servicewelcome'); });
Route::get('/test/', [App\Http\Controllers\HomeController::class, 'checkemail']);
Route::view('socbookingterms','socbookingterms');

URL::forceScheme('https');
