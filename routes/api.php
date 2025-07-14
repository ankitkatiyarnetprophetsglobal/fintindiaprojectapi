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
Route::post('generate_otp', [App\Http\Controllers\Api\UserVerify::class, 'generateotp']);

//
Route::post('encryt_dumy', [App\Http\Controllers\ItDivController::class, 'encryptFunct']);
Route::post('decrypt_dumy', [App\Http\Controllers\ItDivController::class, 'decryptFunct']);

//Version 2.0 routes
Route::prefix('v2')->group(function(){

	Route::post('master',[App\Http\Controllers\v2\Api\Reviewscontrollers::class,'master']);
    Route::post('feedback',[App\Http\Controllers\v2\Api\Reviewscontrollers::class,'review']);
	Route::post('user/userinfo', [App\Http\Controllers\v2\Api\UserInfo::class,'store']);
	Route::get('user/userinfo', [App\Http\Controllers\v2\Api\UserInfo::class,'index']);


	Route::post('user/create', [App\Http\Controllers\v2\Api\UserController::class,'store']);
	Route::post('user/socialregistration', [App\Http\Controllers\v2\Api\UserController::class,'socialregistraton']);
	Route::post('user/mobileregistration', [App\Http\Controllers\v2\Api\UserController::class,'mobileregistration']);
	Route::post('user/createnew', [App\Http\Controllers\v2\Api\UserController::class,'storenew']);
	Route::post('user/login', [App\Http\Controllers\v2\Api\UserController::class,'login']);
	Route::post('user/emaillogin', [App\Http\Controllers\v2\Api\UserController::class,'elogin']);
	Route::post('user/mobilelogin', [App\Http\Controllers\v2\Api\UserController::class,'mlogin']);

	//Route::group(['middleware' => 'auth'], function () {

		Route::post('user/logout', [App\Http\Controllers\v2\Api\UserController::class, 'logout']);
		Route::post('user/profile', [App\Http\Controllers\v2\Api\UserController::class, 'userProfile']);
		Route::post('user/update', [App\Http\Controllers\v2\Api\UserController::class, 'update']);
		Route::post('user/update_new', [App\Http\Controllers\v2\Api\UserController::class, 'update_new']);

	//Check User Exist
		Route::post('user/check', [App\Http\Controllers\v2\Api\UserController::class, 'check']);

	//Current Logged in User
		Route::post('user/current', [App\Http\Controllers\v2\Api\UserController::class,'getAuthUser']);

	//Sleep Module
		 Route::post('sleep/addsleep', [App\Http\Controllers\v2\Api\SleepController::class,'store']);
		Route::get('sleep', [App\Http\Controllers\v2\Api\SleepController::class,'index']);
		Route::post('sleep/updategoal', [App\Http\Controllers\v2\Api\SleepController::class,'goal']);

	//Water
		Route::post('water/addwater', [App\Http\Controllers\v2\Api\WaterController::class,'store']);
		Route::get('water', [App\Http\Controllers\v2\Api\WaterController::class,'index']);
		Route::post('water/updategoal', [App\Http\Controllers\v2\Api\WaterController::class,'goal']);

	//Steps
		Route::post('step/addstep', [App\Http\Controllers\v2\Api\StepController::class,'store']);
		Route::get('step', [App\Http\Controllers\v2\Api\StepController::class,'index']);
		Route::post('step/updategoal', [App\Http\Controllers\v2\Api\StepController::class,'goal']);

	// postpincode
		Route::get('postpincode', [App\Http\Controllers\v2\Api\PostalPinCodeController::class, 'postaldetails']);

	//tips
		Route::get('tips', [App\Http\Controllers\v2\Api\TipsController::class,'index']);
		Route::get('foodchart', [App\Http\Controllers\v2\Api\FoodChartController::class,'index']);

		Route::get('foodname', [App\Http\Controllers\v2\Api\FoodChartController::class,'foodname']);
		Route::get('servingquantity', [App\Http\Controllers\v2\Api\FoodChartController::class,'servingquantity']);


	//
		Route::get('location', [App\Http\Controllers\v2\Api\LocationController::class,'index']);

		Route::post('food/updategoal', [App\Http\Controllers\v2\Api\FoodChartController::class,'goal']);
		Route::post('food/calorieintake', [App\Http\Controllers\v2\Api\FoodChartController::class,'calorieintake']);
		Route::get('getcalorieintake', [App\Http\Controllers\v2\Api\FoodChartController::class,'calorieintakeget']);
		Route::delete('food/deletecalorieintake',[App\Http\Controllers\v2\Api\FoodChartController::class,'destroy']);

	// posts api
		Route::post('posts/list', [App\Http\Controllers\v2\Api\PostsController::class,'listshow']);
		Route::post('posts/listcopy', [App\Http\Controllers\v2\Api\PostsController::class,'listcopyshow']);
		Route::post('posts/id', [App\Http\Controllers\v2\Api\PostsController::class,'showbyid']);
		Route::post('posts/like', [App\Http\Controllers\v2\Api\PostsController::class,'likebyid']);
		Route::post('posts/comments', [App\Http\Controllers\v2\Api\PostsController::class,'commentsbyid']);
		Route::post('posts/more-comments', [App\Http\Controllers\v2\Api\PostsController::class,'more_comments_pagewise']);
		Route::post('posts/category', [App\Http\Controllers\v2\Api\PostsController::class,'postscategory']);



	//});

	/********************************Nagendra Kumar**************************************/

	Route::get('send_password_link', [App\Http\Controllers\v2\Api\PasswordResetRequestController::class,'sendEmail']);
	Route::post('send_password_link', [App\Http\Controllers\v2\Api\PasswordResetRequestController::class,'sendEmail']);
	Route::post('verify_password_otp', [App\Http\Controllers\v2\Api\PasswordResetRequestController::class,'verifypasswordotp']);
	Route::post('update_password', [App\Http\Controllers\v2\Api\ChanagePasswordController::class,'updatePassword']);

	Route::post('verify_user_email', [App\Http\Controllers\v2\Api\UserVerify::class, 'verify_user_email']);
	Route::post('verifyingemail', [App\Http\Controllers\v2\Api\UserVerify::class, 'verifyuser']);
	Route::post('verifyuservthree', [App\Http\Controllers\v2\Api\UserVerify::class, 'verifyuserthree']);

	Route::post('user/devicelog', [App\Http\Controllers\v2\Api\CounterlogController::class,'createdevicelog']);
	Route::post('user/getdevicelog', [App\Http\Controllers\v2\Api\CounterlogController::class,'getdevicelog']);
	Route::post('user/addexceptionlog', [App\Http\Controllers\v2\Api\CounterlogController::class,'addexceptionlog']);
	Route::post('user/failed_login_attempts', [App\Http\Controllers\v2\Api\CounterlogController::class,'failed_login_attempts']);


	/********************************Nagendra Kumar**************************************/

	//Api Route

	Route::get('your-stories', [App\Http\Controllers\v2\Api\YourStoriesController::class, 'yourstory']);
	Route::get('share-your-story', [App\Http\Controllers\v2\Api\YourStoriesController::class, 'sharestory']);

	Route::get('get-active', [App\Http\Controllers\v2\Api\GetActiveController::class, 'getactive']);
	Route::get('media', [App\Http\Controllers\v2\Api\MediaController::class, 'media']);
	Route::get('fit-india-school', [App\Http\Controllers\v2\Api\FitindiaSchoolController::class,'fitindiaschool']);
	Route::get('fit-india-school-registration', [App\Http\Controllers\v2\Api\FitindiaSchoolController::class, 'fitindscreg']);
	Route::get('create-event', [App\Http\Controllers\v2\Api\FitindiaSchoolController::class, 'createevent']);
	Route::get('my-events', [App\Http\Controllers\v2\Api\FitindiaSchoolController::class, 'myevent']);
	Route::get('fit-india-school-certification', [App\Http\Controllers\v2\Api\FitindiaSchoolController::class, 'fitindiacertification']);

	//Events Api Route



	Route::get('fit-india-school-week-2020', [App\Http\Controllers\v2\Api\FitindSch2020Controller::class, 'fitindsch2020']);
	Route::get('fit-india-cyclothon-2020', [App\Http\Controllers\v2\Api\FitindSch2020Controller::class, 'fitindCyclothon2020']);

	Route::get('fit-india-prabhatpheri-2020', [App\Http\Controllers\v2\Api\FitindSch2020Controller::class, 'fitindPrabhatpheri2020']);

	Route::get('mobile/version', [App\Http\Controllers\v2\Api\MobileVer::class, 'versioncheck']);
	Route::get('mobile/versionemail', [App\Http\Controllers\v2\Api\MobileVer::class, 'versionemail']);

	Route::post('user/logintest', [App\Http\Controllers\v2\Api\UserController::class,'logintest']);
	Route::get('mobile/apitest', [App\Http\Controllers\v2\Api\MobileVer::class, 'apitest']);

	Route::post('user/devicedetail', [App\Http\Controllers\v2\Api\GenController::class,'devicedetail']);
	Route::post('user/reward', [App\Http\Controllers\v2\Api\GenController::class,'createreward']);
	Route::post('user/getreward', [App\Http\Controllers\v2\Api\GenController::class,'getreward']);

	Route::get('getactive', [App\Http\Controllers\v2\Api\GenController::class,'get_active']);
	Route::post('postgetactive', [App\Http\Controllers\v2\Api\GenController::class,'post_get_active']);
	Route::get('getdietplan', [App\Http\Controllers\v2\Api\GenController::class,'get_dietplan']);
	Route::POST('getsplashscreenslider', [App\Http\Controllers\v2\Api\GenController::class,'splash_screen_slider']);
	/**** 1-12-2021 ****/
	Route::post('user/challenge/getuserdetail', [App\Http\Controllers\v2\Api\UserController::class, 'userdetail']);
	Route::post('user/challenge/userchallenge', [App\Http\Controllers\v2\Api\UserController::class, 'userchallenge']);
	Route::post('user/challenge/getchallenge', [App\Http\Controllers\v2\Api\UserController::class, 'getchallenge']);
	Route::post('user/update_delete_cng_row', [App\Http\Controllers\v2\Api\UserController::class,'updateDeleteChallengeRow']);
	Route::post('step/get_unique_steps', [App\Http\Controllers\v2\Api\StepController::class,'getUniqueSteps']);
	Route::post('generate_otp', [App\Http\Controllers\v2\Api\UserVerify::class, 'generateotp']);
	Route::post('generateotpvtwo', [App\Http\Controllers\v2\Api\UserVerify::class, 'generateotpvtwo']);
	Route::get('send_generate_otp/{first}/{secound}', [App\Http\Controllers\v2\Api\UserVerify::class, 'sendsms']);

	//
	// Route::post('encryt_dumy', [App\Http\Controllers\v2\ItDivController::class, 'encryptFunct']);
	// Route::post('decrypt_dumy', [App\Http\Controllers\v2\ItDivController::class, 'decryptFunct']);

	// GroupChallenges api


	Route::get('getactivities',[App\Http\Controllers\v2\ChallengesController::class,'getactivities']);
	Route::post('userdetailsactivities',[App\Http\Controllers\v2\ChallengesController::class,'userdetailsactivities']);
	Route::post('getuserhistorylist',[App\Http\Controllers\v2\ChallengesController::class,'getuserhistorylist']);
	Route::post('userhistorysactivities',[App\Http\Controllers\v2\ChallengesController::class,'userhistorysactivities']);
	Route::post('userparticularactivities',[App\Http\Controllers\v2\ChallengesController::class,'userparticularactivities']);
	Route::post('groupactivitiestraking',[App\Http\Controllers\v2\ChallengesController::class,'groupactivitiestraking']);
	Route::post('deletedactivitiestraking',[App\Http\Controllers\v2\ChallengesController::class,'deletedactivitiestraking']);
	Route::post('getusercarbonsave',[App\Http\Controllers\v2\ChallengesController::class,'getusercarbonsave']);

	Route::post('logintracking',[App\Http\Controllers\v2\TrackingController::class,'logintracking']);

	Route::post('testingvalue',[App\Http\Controllers\v2\ChallengesController::class,'testingvalue']);

	Route::post('user-history-activities-v1',[App\Http\Controllers\v2\Challengesv1Controller::class,'userHistorysActivitiesv1']);
	Route::get('git-event-list-v1',[App\Http\Controllers\v2\Challengesv1Controller::class,'git_event_list_v1']);
	Route::get('git-event-certificate',[App\Http\Controllers\v2\Challengesv1Controller::class,'gitEventCertificate']);
	Route::post('get-userdetails-datewise',[App\Http\Controllers\v2\Challengesv1Controller::class,'getuserdetailsdatewise']);

	Route::post('user-history-activities-v2',[App\Http\Controllers\v2\Challengesv2Controller::class,'userHistorysActivitiesv2']);
	Route::get('get-event-list-v2',[App\Http\Controllers\v2\Challengesv2Controller::class,'geteventlistv2']);
	Route::post('get-userdetails-datewise-v2',[App\Http\Controllers\v2\Challengesv2Controller::class,'getuserdetailsdatewisev2']);

	Route::post('get-abha-integration-url',[App\Http\Controllers\v2\AbhaintegrationController::class,'getabhaintegrationurl']);
	Route::post('post-abha-user-url',[App\Http\Controllers\v2\AbhaintegrationController::class,'postabhauserurl']);
	Route::post('get-abha-user-details',[App\Http\Controllers\v2\AbhaintegrationController::class,'getabhauserdetail']);
	Route::post('get-detail-abha-address',[App\Http\Controllers\v2\AbhaintegrationController::class,'getdetailabhaaddress']);
	Route::post('abha-search-details',[App\Http\Controllers\v2\AbhaintegrationController::class,'abhasearchdetails']);
	Route::post('abha-search-mobile-details',[App\Http\Controllers\v2\AbhaintegrationController::class,'abhamobilesearchdetails']);
	Route::post('deactivate_abha_address',[App\Http\Controllers\v2\AbhaintegrationController::class,'deactivateabhaaddress']);
	Route::post('deactivate-abha-address-v2',[App\Http\Controllers\v2\AbhaintegrationController::class,'deactivateabhaaddressv2']);

	Route::post('get-abha-integration-url-v1',[App\Http\Controllers\v2\Abhaintegrationv1Controller::class,'getabhaintegrationurlv1']);
	Route::post('post-abha-user-url-v1',[App\Http\Controllers\v2\Abhaintegrationv1Controller::class,'postabhauserurlv1']);
	Route::post('get-abha-user-details-v1',[App\Http\Controllers\v2\Abhaintegrationv1Controller::class,'getabhauserdetailv1']);
	Route::post('get-detail-abha-address-v1',[App\Http\Controllers\v2\Abhaintegrationv1Controller::class,'getdetailabhaaddressv1']);
	Route::post('abha-search-details-v1',[App\Http\Controllers\v2\Abhaintegrationv1Controller::class,'abhasearchdetailsv1']);
	Route::post('deactivate-abha-address-v1',[App\Http\Controllers\v2\Abhaintegrationv1Controller::class,'deactivateabhaaddressv1']);



	Route::post('post-delete-user-details',[App\Http\Controllers\v2\PermanentController::class,'permanent_delete_user']);
	Route::post('get-delete-user-status',[App\Http\Controllers\v2\PermanentController::class,'permanent_delete_user_status']);
	Route::post('revoke-delete-user',[App\Http\Controllers\v2\PermanentController::class,'permanent_delete_user_revoke']);



    Route::GET('quiz-categories-list',[App\Http\Controllers\v2\QuizcategoriesController::class,'quizcategories']);
    Route::POST('quiz-title-lists',[App\Http\Controllers\v2\QuizcategoriesController::class,'quiz_title_lists']);
    Route::POST('quiz-title-lists-v2',[App\Http\Controllers\v2\QuizcategoriesController::class,'quiz_title_lists_v2']);
    Route::POST('quiz-master-question-answers',[App\Http\Controllers\v2\QuizcategoriesController::class,'quiz_master_question_answers']);
    Route::POST('user-attempt-quiz',[App\Http\Controllers\v2\QuizcategoriesController::class,'store_quiz_user_attempt']);
    Route::POST('user-rank',[App\Http\Controllers\v2\QuizcategoriesController::class,'get_user_rank']);
    Route::POST('get-all-user-rank',[App\Http\Controllers\v2\QuizcategoriesController::class,'getAllUserRank']);
    Route::POST('get-all-user-rank-v2',[App\Http\Controllers\v2\QuizcategoriesController::class,'getAllUserRankv2']);
    Route::GET('useremailsend',[App\Http\Controllers\v2\QuizcategoriesController::class,'useremailsend']);


	Route::POST('get-weekend-cycle-event',[App\Http\Controllers\v2\WeekendcycleeventsController::class,'get_weekend_cycle_event']);
	Route::POST('event-all-users',[App\Http\Controllers\v2\WeekendcycleeventsController::class,'event_all_count_users']);
	Route::POST('search_userid_event',[App\Http\Controllers\v2\WeekendcycleeventsController::class,'search_userid_event']);
	Route::POST('user-details-event',[App\Http\Controllers\v2\WeekendcycleeventsController::class,'user_details_event']);
	Route::POST('search-userid-event-v2',[App\Http\Controllers\v2\WeekendcycleeventsController::class,'search_userid_event_v2']);
	Route::POST('search-userid-event-v3',[App\Http\Controllers\v2\WeekendcycleeventsController::class,'search_userid_event_v3']);


    Route::get('get-activity-measurement',[App\Http\Controllers\v2\ChallengermastersController::class,'getactivitymeasurement']);
    Route::POST('challenger-masters-list',[App\Http\Controllers\v2\ChallengermastersController::class,'challenger_masters']);
    Route::POST('challenger-masters-id',[App\Http\Controllers\v2\ChallengermastersController::class,'challenger_masters_id']);
    Route::POST('store-challenger-user',[App\Http\Controllers\v2\ChallengermastersController::class,'store_challenger_user']);
    Route::POST('store-challenger-data',[App\Http\Controllers\v2\ChallengermastersController::class,'store_challenger_data']);
    Route::POST('get-challenger-data',[App\Http\Controllers\v2\ChallengermastersController::class,'get_challenger_data']);
    Route::POST('get-challenger-data-weekly',[App\Http\Controllers\v2\ChallengermastersController::class,'get_challenger_data_weekly']);
    Route::POST('get-point-generate',[App\Http\Controllers\v2\ChallengermastersController::class,'get_point_generate']);



    Route::POST('distribution-event-kit',[App\Http\Controllers\v2\DistributioneventkitsController::class,'distribution_event_kit']);
    Route::POST('get-distribution-event-kit',[App\Http\Controllers\v2\DistributioneventkitsController::class,'get_distribution_event_kit']);
    Route::POST('get-distribution-permissions',[App\Http\Controllers\v2\DistributioneventkitsController::class,'get_distribution_permissions']);
    Route::POST('get-give-distribution-permissions',[App\Http\Controllers\v2\DistributioneventkitsController::class,'get_give_distribution_permissions']);

    // Route::get('get-give-distribution-permissions', [App\Http\Controllers\Api\MobileVer::class, 'get_give_distribution_permissions']);

    Route::get('get-equipment-name',[App\Http\Controllers\v2\SocweekendeventController::class,'get_equipment_name']);
    Route::get('get-datelist-soc',[App\Http\Controllers\v2\SocweekendeventController::class,'get_datelist_soc']);
    Route::POST('get-datewise-event-place',[App\Http\Controllers\v2\SocweekendeventController::class,'get_datewise_event_place']);
    Route::POST('get-status-current-user',[App\Http\Controllers\v2\SocweekendeventController::class,'get_status_current_user']);
    Route::POST('save-datewise-soc',[App\Http\Controllers\v2\SocweekendeventController::class,'save_datewise_soc']);
    Route::POST('save-datewise-receive-soc',[App\Http\Controllers\v2\SocweekendeventController::class,'save_datewise_receive_soc']);
    Route::POST('get-status-waiting-soc',[App\Http\Controllers\v2\SocweekendeventController::class,'get_status_waiting_soc']);
    Route::POST('get-status-receive-soc-issue',[App\Http\Controllers\v2\SocweekendeventController::class,'get_status_receive_soc_issue']);
    Route::POST('get-status-receive-current-user',[App\Http\Controllers\v2\SocweekendeventController::class,'get_status_receive_current_user']);
    Route::POST('get-status-notgiving-user',[App\Http\Controllers\v2\SocweekendeventController::class,'get_status_notgiving_user']);
    Route::POST('soc-return-equipment',[App\Http\Controllers\v2\SocweekendeventController::class,'post_soc_return_equipment']);
    Route::POST('soc-return-equipment-status',[App\Http\Controllers\v2\SocweekendeventController::class,'post_soc_return_equipment_status']);
    Route::POST('soc-allotment-return-status',[App\Http\Controllers\v2\SocweekendeventController::class,'socallotment_return_status']);

    Route::GET('useremail',[App\Http\Controllers\v2\QuizcategoriesController::class,'useremail']);


    Route::get('share-story-mail',[App\Http\Controllers\v2\EmailController::class,'sharestorymail']);





	Route::post('example-functions',[App\Http\Controllers\v2\ExampleController::class,'examplefunctions']);


});



URL::forceScheme('https');
