<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('user/userinfo', [App\Http\Controllers\Api\UserInfo::class,'store']);
Route::get('user/userinfo', [App\Http\Controllers\Api\UserInfo::class,'index']);

Route::post('user/create', [App\Http\Controllers\Api\UserController::class,'store']);
Route::post('user/createnew', [App\Http\Controllers\Api\UserController::class,'storenew']); 
Route::post('user/login', [App\Http\Controllers\Api\UserController::class,'login']);

//Route::group(['middleware' => 'auth'], function () {
 
    Route::post('user/logout', [App\Http\Controllers\Api\UserController::class, 'logout']);
    Route::post('user/profile', [App\Http\Controllers\Api\UserController::class, 'userProfile']);
    Route::post('user/update', [App\Http\Controllers\Api\UserController::class, 'update']);
    Route::post('user/update_new', [App\Http\Controllers\Api\UserController::class, 'update_new']);
    
//Check User Exist
    Route::post('user/check', [App\Http\Controllers\Api\UserController::class, 'check']);

//Current Logged in User
    Route::post('user/current', [App\Http\Controllers\Api\UserController::class,'getAuthUser']);

//Sleep Module
 	Route::post('sleep/addsleep', [App\Http\Controllers\Api\SleepController::class,'store']);
	Route::get('sleep', [App\Http\Controllers\Api\SleepController::class,'index']);
	Route::post('sleep/updategoal', [App\Http\Controllers\Api\SleepController::class,'goal']);
  
//Water
	Route::post('water/addwater', [App\Http\Controllers\Api\WaterController::class,'store']);
	Route::get('water', [App\Http\Controllers\Api\WaterController::class,'index']);
	Route::post('water/updategoal', [App\Http\Controllers\Api\WaterController::class,'goal']);

//Steps
	Route::post('step/addstep', [App\Http\Controllers\Api\StepController::class,'store']);
	Route::get('step', [App\Http\Controllers\Api\StepController::class,'index']);
	Route::post('step/updategoal', [App\Http\Controllers\Api\StepController::class,'goal']);

//tips
	Route::get('tips', [App\Http\Controllers\Api\TipsController::class,'index']);
	Route::get('foodchart', [App\Http\Controllers\Api\FoodChartController::class,'index']);
	
	Route::get('foodname', [App\Http\Controllers\Api\FoodChartController::class,'foodname']);
	Route::get('servingquantity', [App\Http\Controllers\Api\FoodChartController::class,'servingquantity']);


//
	Route::get('location', [App\Http\Controllers\Api\LocationController::class,'index']);
	
	Route::post('food/updategoal', [App\Http\Controllers\Api\FoodChartController::class,'goal']);
	Route::post('food/calorieintake', [App\Http\Controllers\Api\FoodChartController::class,'calorieintake']);
	Route::get('getcalorieintake', [App\Http\Controllers\Api\FoodChartController::class,'calorieintakeget']);
	Route::delete('food/deletecalorieintake',[App\Http\Controllers\Api\FoodChartController::class,'destroy']);  
	
//});

/********************************Nagendra Kumar**************************************/

Route::get('send_password_link', [App\Http\Controllers\Api\PasswordResetRequestController::class,'sendEmail']);
Route::post('send_password_link', [App\Http\Controllers\Api\PasswordResetRequestController::class,'sendEmail']);
Route::post('verify_password_otp', [App\Http\Controllers\Api\PasswordResetRequestController::class,'verifypasswordotp']);
Route::post('update_password', [App\Http\Controllers\Api\ChanagePasswordController::class,'updatePassword']);

Route::post('verify_user_email', [App\Http\Controllers\Api\UserVerify::class, 'verify_user_email']);
Route::post('verifyingemail', [App\Http\Controllers\Api\UserVerify::class, 'verifyuser']); 

Route::post('user/devicelog', [App\Http\Controllers\Api\CounterlogController::class,'createdevicelog']);
Route::post('user/getdevicelog', [App\Http\Controllers\Api\CounterlogController::class,'getdevicelog']);
Route::post('user/addexceptionlog', [App\Http\Controllers\Api\CounterlogController::class,'addexceptionlog']);
Route::post('user/failed_login_attempts', [App\Http\Controllers\Api\CounterlogController::class,'failed_login_attempts']);


/********************************Nagendra Kumar**************************************/

//Api Route 

Route::get('your-stories', [App\Http\Controllers\Api\YourStoriesController::class, 'yourstory']);
Route::get('share-your-story', [App\Http\Controllers\Api\YourStoriesController::class, 'sharestory']);

Route::get('get-active', [App\Http\Controllers\Api\GetActiveController::class, 'getactive']);
Route::get('media', [App\Http\Controllers\Api\MediaController::class, 'media']);
Route::get('fit-india-school', [App\Http\Controllers\Api\FitindiaSchoolController::class,'fitindiaschool']);
Route::get('fit-india-school-registration', [App\Http\Controllers\Api\FitindiaSchoolController::class, 'fitindscreg']);
Route::get('create-event', [App\Http\Controllers\Api\FitindiaSchoolController::class, 'createevent']);
Route::get('my-events', [App\Http\Controllers\Api\FitindiaSchoolController::class, 'myevent']);
Route::get('fit-india-school-certification', [App\Http\Controllers\Api\FitindiaSchoolController::class, 'fitindiacertification']);

//Events Api Route



Route::get('fit-india-school-week-2020', [App\Http\Controllers\Api\FitindSch2020Controller::class, 'fitindsch2020']);
Route::get('fit-india-cyclothon-2020', [App\Http\Controllers\Api\FitindSch2020Controller::class, 'fitindCyclothon2020']);

Route::get('fit-india-prabhatpheri-2020', [App\Http\Controllers\Api\FitindSch2020Controller::class, 'fitindPrabhatpheri2020']);

Route::get('mobile/version', [App\Http\Controllers\Api\MobileVer::class, 'versioncheck']);

Route::post('user/logintest', [App\Http\Controllers\Api\UserController::class,'logintest']);
Route::get('mobile/apitest', [App\Http\Controllers\Api\MobileVer::class, 'apitest']);

Route::post('user/devicedetail', [App\Http\Controllers\Api\GenController::class,'devicedetail']);
Route::post('user/reward', [App\Http\Controllers\Api\GenController::class,'createreward']);
Route::post('user/getreward', [App\Http\Controllers\Api\GenController::class,'getreward']);

Route::get('getactive', [App\Http\Controllers\Api\GenController::class,'get_active']);
Route::get('getdietplan', [App\Http\Controllers\Api\GenController::class,'get_dietplan']);

/**** 1-12-2021 ****/
Route::post('user/challenge/getuserdetail', [App\Http\Controllers\Api\UserController::class, 'userdetail']);
Route::post('user/challenge/userchallenge', [App\Http\Controllers\Api\UserController::class, 'userchallenge']);
Route::post('user/challenge/getchallenge', [App\Http\Controllers\Api\UserController::class, 'getchallenge']);
Route::post('user/update_delete_cng_row', [App\Http\Controllers\Api\UserController::class,'updateDeleteChallengeRow']);
Route::post('step/get_unique_steps', [App\Http\Controllers\Api\StepController::class,'getUniqueSteps']);

URL::forceScheme('https');
