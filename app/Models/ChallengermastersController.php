<?php

namespace App\Http\Controllers\v2;

use App\Helpers\Helper as HelpersHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\v2\CommonController;
use App\Models\Challengermasters;
use App\Models\Ongoingchallenger;
use App\Models\Storechallengerdatas;
use Response;
use Helper;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Composer\Semver\Interval;

class ChallengermastersController extends Controller
{
    public function __construct() {

        $this->middleware('auth:api', ['except' => ['challenger_masters','challenger_masters_id','store_challenger_user','store_challenger_data','get_challenger_data','get_point_generate','get_challenger_data_weekly']]);

    }

    public function challenger_masters(Request $request){

        try{

            $user = auth('api')->user();
            $user_id = $request->user_id;
            if($user_id == null || $user_id == '' || is_int($request->user_id) === false){

                $error_code = '801';
                $error_message = 'Required User id';

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }
            $date = \Carbon\Carbon::today()->subDays(0);
            // dd($date);
            if($user){
                // dd("challenger_masters");
                // $user_id = $request->user_id;
                // $data = Challengermasters::withCount(['quizTitleLists' => function($q){
                // $data_points = DB::select("SELECT sum(ifnull(on_c.point, 0) + ifnull(ur.score, 0)) as point FROM `users` as us LEFT JOIN ongoing_challengers as on_c on us.id = on_c.user_id LEFT JOIN user_ranks ur on ur.user_id = us.id LEFT JOIN challenger_masters cm on cm.id = on_c.challenger_id WHERE us.id = $user_id;");
                // $data_points = DB::select("SELECT sum(ifnull(on_c.point, 0) + ifnull(ur.score, 0)) as point FROM `users` as us LEFT JOIN ongoing_challengers as on_c on us.id = on_c.user_id LEFT JOIN user_ranks ur on ur.user_id = us.id LEFT JOIN challenger_masters cm on cm.id = on_c.challenger_id WHERE us.id = $user_id;");
                $user_ranks = DB::select("SELECT sum(ifnull(ur.score,0)) as user_ranks_point FROM user_ranks as ur WHERE ur.user_id = $user_id;");
                $user_ranks_point = $user_ranks[0]->user_ranks_point;
                $ongoing_challengers = DB::select("SELECT sum(ifnull(on_c.point,0)) as ongoing_challengers_point FROM ongoing_challengers as on_c WHERE on_c.user_id = $user_id;");
                $ongoing_challengers_point = $ongoing_challengers[0]->ongoing_challengers_point;
                $data_points = ($user_ranks_point + $ongoing_challengers_point);


                // dd($data_points[0]->point);
                $data = Challengermasters::
                                        leftJoin('ongoing_challengers', function($leftJoin)use($user_id)
                                        {
                                            $leftJoin->on('challenger_masters.id', '=', 'ongoing_challengers.challenger_id')
                                                ->where('ongoing_challengers.user_id', '=', $user_id);
                                                // ->distinct('quiz_user_attempts.user_id');
                                        })
                                        ->where([
                                                ['challenger_masters.status','=' , 1],
                                                // ['challenger_masters.end_time', '>', date($date)]
                                            ])
                                        ->where('challenger_masters.start_time', '<=', $date)
                                        ->where('challenger_masters.end_time', '>=', $date)
                                        ->select(
                                            'challenger_masters.id',
                                            'challenger_masters.name',
                                            'challenger_masters.image',
                                            'challenger_masters.start_time',
                                            'challenger_masters.end_time',
                                            'challenger_masters.sport_type',
                                            'challenger_masters.banner_type',
                                            'challenger_masters.icon',
                                            // 'challenger_masters.description',
                                            // 'challenger_masters.duration',
                                            // 'challenger_masters.goal',
                                            'challenger_masters.badge_detail',
                                            // 'challenger_masters.reward',
                                            'ongoing_challengers.user_id',
                                            'challenger_masters.title_subereward',
                                        )
                                        ->distinct('quiz_user_attempts.user_id')
                                        // ->groupBy(
                                        // )
                                        ->get();
                // dd($data);

                $all_title = array(
                            "dayly"=>(array("daylytitle"=>"day challenges","daylysubtitle"=>"dayly subtitle")),
                            "recommend"=>(array("recommendtitle"=>"Recommend","recommendsubtitle"=>"recommend sub title")),
                            "weekly"=>(array("weeklytitle"=>"weekly challenges","weeklysubtitle"=>"weekly sub title")),
                            "monthly"=>(array("monthlytitle"=>"monthly challenges","monthlysubtitle"=>"monthly sub title"))
                            );

                // dd($all_title);
                $all_data = array (
                    "all_title" => $all_title,
                    "points" => $data_points,
                    "data" => $data
                  );
                if($data->count() > 0){
                    return Response::json(array(
                        'status'    => 'success',
                        'code'      =>  200,
                        'message'   =>  null,
                        'data'      => $all_data
                    ), 200);
                }else{
                    return Response::json(array(
                        'status'    => 'error',
                        'code'      =>  200,
                        'message'   =>  'Data not found',
                        'data'   => null,
                    ), 401);
                }

            }else{

                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'message'   =>  'Unauthorized'
                ), 401);

            }

        } catch(Exception $e) {

            $controller_name = 'ChallengermastersController';
            $function_name = 'challenger_masters';
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;

            $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);

            if(empty($request->Location)){
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }
        }
    }

    public function challenger_masters_id(Request $request){

        try{

            $user = auth('api')->user();
            $date = \Carbon\Carbon::today()->subDays(0);
            // dd($date);
            if($user){
                // dd("challenger_masters");
                $user_id = $request->user_id;
                $challengermastersid = $request->challengermastersid;
                if($user_id == null || $user_id == '' || is_int($request->user_id) === false){

                    $error_code = '801';
                    $error_message = 'Required User id';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }
                if($challengermastersid == null || $challengermastersid == '' || is_int($request->challengermastersid) === false){

                    $error_code = '801';
                    $error_message = 'Required challenger masters id';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }
                // $data = Challengermasters::withCount(['quizTitleLists' => function($q){
                // $data_points = DB::select("SELECT sum(ifnull(on_c.point,0)+ur.score) as point FROM `users` as us LEFT JOIN ongoing_challengers as on_c on us.id = on_c.user_id LEFT JOIN user_ranks ur on ur.user_id = us.id LEFT JOIN challenger_masters cm on cm.id = on_c.challenger_id WHERE us.id = 2126648;");
                // dd($data_points[0]->point);
                $user_ranks = DB::select("SELECT sum(ifnull(ur.score,0)) as user_ranks_point FROM user_ranks as ur WHERE ur.user_id = $user_id;");
                $user_ranks_point = $user_ranks[0]->user_ranks_point;
                $ongoing_challengers = DB::select("SELECT sum(ifnull(on_c.point,0)) as ongoing_challengers_point FROM ongoing_challengers as on_c WHERE on_c.user_id = $user_id;");
                $ongoing_challengers_point = $ongoing_challengers[0]->ongoing_challengers_point;
                $data_points = ($user_ranks_point + $ongoing_challengers_point);

                $data = Challengermasters::
                                        leftJoin('ongoing_challengers', function($leftJoin)use($user_id)
                                        {
                                            $leftJoin->on('challenger_masters.id', '=', 'ongoing_challengers.challenger_id')
                                                ->where('ongoing_challengers.user_id', '=', $user_id)
                                                ->distinct('quiz_user_attempts.user_id');
                                        })
                                        ->where([
                                                ['challenger_masters.id','=' , $challengermastersid],
                                                ['challenger_masters.status','=' , 1],
                                                // ['challenger_masters.end_time', '>', date($date)]
                                            ])
                                        ->where('challenger_masters.start_time', '<=', $date)
                                        ->where('challenger_masters.end_time', '>=', $date)
                                        ->select(
                                            'challenger_masters.id',
                                            'challenger_masters.name',
                                            'challenger_masters.sub_title',
                                            'challenger_masters.image',
                                            'challenger_masters.start_time',
                                            'challenger_masters.end_time',
                                            'challenger_masters.sport_type',
                                            'challenger_masters.banner_type',
                                            'challenger_masters.icon',
                                            'challenger_masters.description',
                                            'challenger_masters.duration',
                                            'challenger_masters.duration_uom',
                                            'challenger_masters.goal',
                                            'challenger_masters.goal_uom',
                                            'challenger_masters.badge_detail',
                                            'challenger_masters.reward',
                                            'challenger_masters.uom',
                                            'challenger_masters.title_reward',
                                            'challenger_masters.title_subereward',
                                            'ongoing_challengers.user_id',

                                        )
                                        // ->groupBy(
                                        // )
                                        ->first();
                // dd($data);
                $all_data = array (
                    "points" => $data_points,
                    "data" => $data
                  );
                if($data->count() > 0){
                    return Response::json(array(
                        'status'    => 'success',
                        'code'      =>  200,
                        'message'   =>  null,
                        'data'      => $all_data
                    ), 200);
                }else{
                    return Response::json(array(
                        'status'    => 'error',
                        'code'      =>  200,
                        'message'   =>  'Data not found',
                        'data'   => null,
                    ), 401);
                }

            }else{

                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'message'   =>  'Unauthorized'
                ), 401);

            }

        } catch(Exception $e) {

            $controller_name = 'ChallengermastersController';
            $function_name = 'challenger_masters_id';
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;

            $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);

            if(empty($request->Location)){
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }
        }
    }

    public function store_challenger_user(Request $request){

        try{

            $user = auth('api')->user();
            $date = \Carbon\Carbon::today()->subDays(0);
            // dd($date);
            if($user){
                // dd("challenger_masters");
                $user_id = $request->user_id;
                if($user_id == null || $user_id == '' || is_int($request->user_id) === false){

                    $error_code = '801';
                    $error_message = 'Required user id';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                $challengerattempt = $request->challengerattempt;

                    foreach($challengerattempt as $key => $value){
                        // dd($value);
                        $ongoingchallenger = new Ongoingchallenger();
                        $ongoingchallenger->user_id = $request->user_id;
                        $ongoingchallenger->challenger_id = $value['challenger_id'];
                        $ongoingchallenger->point = $value['point'];
                        $ongoingchallenger->sport_type = $value['sport_type'];
                        $ongoingchallenger->duration = $value['duration'];
                        $ongoingchallenger->progess = $value['progess'];
                        $ongoingchallenger->status = 1;
                        $ongoingchallenger->save();
                    }

                    // dd("done");
                    return Response::json(array(
                        'isSuccess' => 'true',
                        'code'      => 200,
                        'data'      => null,
                        'message'   => 'Insert Success'
                    ), 200);

            }else{

                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'message'   =>  'Unauthorized'
                ), 401);

            }

        } catch(Exception $e) {

            $controller_name = 'ChallengermastersController';
            $function_name = 'store_challenger_user';
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;

            $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);

            if(empty($request->Location)){
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }
        }
    }

    public function store_challenger_data(Request $request){

        try{

            $user = auth('api')->user();
            if($user){

                $current_date = date_create(date('Y-m-d'));
                $current_date_format = date_format($current_date,'Y-m-d');
                $date = $request->date;

                if($date == $current_date_format){

                    $user_id = $request->user_id;
                    $date = Carbon::now('Asia/Kolkata');
                    $calery = $request->calery;
                    $individual_goals = $request->individual_goals;
                    $steps = $request->steps;
                    $date = $request->date;

                    if($user_id == null || $user_id == '' || is_int($request->user_id) === false){

                        $error_code = '801';
                        $error_message = 'Required user id';

                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $error_message
                        ), 200);
                    }

                    if($calery == null || $calery == ''){
                        // dd(987);
                        $error_code = '801';
                        $error_message = 'Required calery';

                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $error_message
                        ), 200);
                    }

                    if($steps == null || $steps == '' || is_int($request->steps) === false){
                        // dd(1321313);
                        $error_code = '801';
                        $error_message = 'Required steps';

                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $error_message
                        ), 200);
                    }

                    if($date == null || $date == ''){

                        $error_code = '801';
                        $error_message = 'Required date';

                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $error_message
                        ), 200);
                    }

                    $data = DB::table('storechallengerdatas')
                                ->select('id','user_id', DB::raw('DATE(date) as date'))
                                ->whereDate('date', $date)
                                ->where('user_id', $user_id)
                                ->get();
                    // dd($data[0]->id);
                    if(count($data) > 0){

                        Storechallengerdatas::
                                            where(['id' => $data[0]->id])
                                            ->update([

                                                'steps' => $steps,
                                                'calery' => $calery,
                                                'individual_goals' => $individual_goals,
                                            ]);

                    }else{

                        $storechallengerdatas = new Storechallengerdatas();
                        $storechallengerdatas->user_id = $request->user_id;
                        $storechallengerdatas->steps = $steps;
                        $storechallengerdatas->date = Carbon::now('Asia/Kolkata');
                        $storechallengerdatas->calery = $calery;
                        $storechallengerdatas->individual_goals = $individual_goals;
                        $storechallengerdatas->status = 1;
                        $storechallengerdatas->save();

                    }

                    return Response::json(array(
                        'isSuccess' => 'true',
                        'code'      => 200,
                        'data'      => null,
                        'message'   => 'Insert Success'
                    ), 200);

                }else{

                    return Response::json(array(
                        'isSuccess' => 'true',
                        'code'      => 200,
                        'data'      => null,
                        'message'   => 'Wrong Date'
                    ), 200);

                }

            }else{

                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'message'   =>  'Unauthorized'
                ), 401);

            }

        } catch(Exception $e) {

            $controller_name = 'ChallengermastersController';
            $function_name = 'store_challenger_data';
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;

            $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);

            if(empty($request->Location)){
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }
        }
    }

    public function get_challenger_data_weekly(Request $request){

        try{

            $user = auth('api')->user();
            $user_id = $request->user_id;

            if($user_id == null || $user_id == '' || is_int($request->user_id) === false){

                $error_code = '801';
                $error_message = 'Required User id';

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }

            $date = $startdate = date_create(date("Y-m-d"));
            $start_date_format =  date_format($date,"Y-m-d");
            $start_date = date_add($startdate,date_interval_create_from_date_string("-7 days"));
            $end_date_format =  date_format($start_date,"Y-m-d");

            if($user){

                $data = DB::table('storechallengerdatas')
                                        ->select('user_id','steps','individual_goals', DB::raw('DATE(date) as date'))
                                        ->whereDate('storechallengerdatas.date', '<=', $start_date_format)
                                        ->whereDate('storechallengerdatas.date', '>=', $end_date_format)
                                        ->where('user_id', $user_id)
                                        ->get();

                if($data->count() > 0){

                    return Response::json(array(
                        'status'    => 'success',
                        'code'      =>  200,
                        'message'   =>  null,
                        'data'      => $data
                    ), 200);

                }else{

                    return Response::json(array(
                        'status'    => 'error',
                        'code'      =>  200,
                        'message'   =>  'Data not found',
                        'data'   => null,
                    ), 401);
                }

            }else{

                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'message'   =>  'Unauthorized'
                ), 401);

            }

        } catch(Exception $e) {

            $controller_name = 'ChallengermastersController';
            $function_name = 'get_challenger_data_weekly';
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;

            $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);

            if(empty($request->Location)){
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }
        }
    }

    public function get_challenger_data(Request $request){

        try{

            $user = auth('api')->user();

            if($user){

                $user_id = $request->user_id;
                $date = $request->date;

                if($user_id == null || $user_id == '' || is_int($request->user_id) === false){

                    $error_code = '801';
                    $error_message = 'Required user id';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($date == null || $date == ''){

                    $error_code = '801';
                    $error_message = 'Required date';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                // $data = Storechallengerdatas::where([
                //                             ['storechallengerdatas.user_id','=' , $user_id],
                //                             ['storechallengerdatas.date','=' , $date],
                //                             ['storechallengerdatas.status','=' , 1],
                //                         ])
                //                     ->get();
                $data = DB::table('storechallengerdatas')
                                ->select('id','user_id', DB::raw('DATE(date) as date'))
                                ->whereDate('date', $date)
                                ->where('user_id', $user_id)
                                ->get();
                // dd($data);
                if($data->count() > 0){

                    return Response::json(array(
                        'status'    => 'success',
                        'code'      =>  200,
                        'message'   =>  null,
                        'data'      => $data,
                    ), 200);

                }else{

                    return Response::json(array(
                        'status'    => 'error',
                        'code'      =>  200,
                        'message'   =>  "Data not found",
                        'data'   => null,
                    ), 401);

                }

            }else{

                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'message'   =>  'Unauthorized'
                ), 401);

            }

        } catch(Exception $e) {

            $controller_name = 'ChallengermastersController';
            $function_name = 'get_challenger_data';
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;

            $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);

            if(empty($request->Location)){
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }
        }
    }

    public function get_point_generate(Request $request){

        try{

            $user = auth('api')->user();
            $date = date_create(date("Y-m-d"));
            $start_date = date_add($date,date_interval_create_from_date_string("-1 days"));
            $start_date_format =  date_format($start_date,"Y-m-d");

            if($user){

                $data = Challengermasters::
                                        Join('ongoing_challengers', 'ongoing_challengers.challenger_id', '=', 'challenger_masters.id')
                                        ->where([
                                                ['challenger_masters.status','=' , 1],

                                            ])
                                        ->whereDate('challenger_masters.start_time', '<=', $start_date_format)
                                        ->whereDate('challenger_masters.end_time', '>=', $start_date_format)
                                        ->select(
                                            'challenger_masters.id as challenger_mastersid',
                                            'challenger_masters.sport_type',
                                            'challenger_masters.banner_type',
                                            'challenger_masters.icon',
                                            'challenger_masters.description',
                                            'challenger_masters.duration',
                                            'challenger_masters.goal',
                                            'challenger_masters.badge_detail',
                                            'challenger_masters.reward as oc_reward',
                                            'challenger_masters.title_subereward',
                                            DB::raw('DATE(start_time) as cm_start_time'),
                                            'ongoing_challengers.id as ongoing_challengersid',
                                            'ongoing_challengers.user_id as oc_user_id',
                                            'ongoing_challengers.id as oc_id',
                                        )
                                        ->get();

                if($data->count() > 0){

                    foreach ($data as $value) {

                        $value['challenger_mastersid'];
                        $duration = $value['duration'];
                        $goal = $value['goal'];
                        $value['sport_type'];
                        $banner_type = $value['banner_type'];
                        $oc_reward = $value['oc_reward'];
                        $value['ongoing_challengersid'];
                        $user_id = $value['oc_user_id'];
                        $cm_start_time = $value['cm_start_time'];
                        $oc_id = $value['oc_id'];

                        switch ($value['sport_type']) {

                            case 'w':

                                if($banner_type == 'd'){

                                    $this->daylycalculation($start_date_format,$duration,$cm_start_time,$goal,$oc_reward,$oc_id);
                                }

                                if($banner_type == 'w' || $banner_type == 'm'){

                                    $this->weeklymonthlyculation($duration,$cm_start_time,$goal,$oc_reward,$oc_id);
                                }

                                break;

                            case 'r':

                                if($banner_type == 'd'){

                                    $this->daylykmcalculation($start_date_format,$duration,$cm_start_time,$goal,$oc_reward,$oc_id);
                                }

                                if($banner_type == 'w' || $banner_type == 'm'){

                                    $this->weeklymonthlykmcalculation($start_date_format,$duration,$cm_start_time,$goal,$oc_reward,$oc_id);
                                }
                                // dd("Running");
                                break;

                            case 'c';

                            dd("cycle");
                                break;
                        }

                        // dd(123456);
                    }

                    return Response::json(array(
                        'status'    => 'success',
                        'code'      =>  200,
                        'message'   =>  null,
                        'data'      => "Add point users"
                    ), 200);

                }else{

                    return Response::json(array(
                        'status'    => 'error',
                        'code'      =>  200,
                        'message'   =>  'Data not found',
                        'data'   => null,
                    ), 401);
                }

            }else{

                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'message'   =>  'Unauthorized'
                ), 401);

            }

        } catch(Exception $e) {

            $controller_name = 'ChallengermastersController';
            $function_name = 'challenger_masters';
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;

            $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);

            if(empty($request->Location)){
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }
        }
    }

    function daylycalculation($start_date_format,$duration,$cm_start_time,$goal,$oc_reward,$oc_id){

        $data_calculation = Storechallengerdatas::
                                                where([
                                                        ['storechallengerdatas.status','=',1],
                                                    ])
                                                ->whereDate('storechallengerdatas.date', '=', $start_date_format)
                                                ->select('storechallengerdatas.user_id',DB::raw('SUM(storechallengerdatas.steps) as steps'))
                                                ->groupBy(
                                                    'storechallengerdatas.user_id',
                                                    )
                                                ->get();

        if(count($data_calculation) > 0){

            foreach ($data_calculation as $hey => $value) {

                $steps = $value['steps'];

                if($goal < ((int)$steps)){

                    $extra_days = $duration+1;
                    $date = date_create(date("$cm_start_time"));
                    $date_cal = date_add($date,date_interval_create_from_date_string("$extra_days days"));
                    $date_cal_format =  date_format($date_cal,"Y-m-d");
                    $curent_date =  date_format(date_create(date("Y-m-d")),"Y-m-d");

                    if($date_cal_format == $curent_date){

                        if($goal <= $steps){

                            $steps_value = $steps/$goal;
                            $steps_cal = (int)$steps_value;
                            $point_user_gen = $steps_cal * $oc_reward;

                            $update_query = Ongoingchallenger::
                                                where(['id' => $oc_id,'user_id' => $value['user_id']])
                                                ->update([
                                                    'ongoing_challengers.point' => $point_user_gen
                                                ]);
                            return $update_query;

                        }
                    }
                }
            }
        }
    }

    function weeklymonthlyculation($duration,$cm_start_time,$goal,$oc_reward,$oc_id){

        $extra_days = $duration+1;
        $date = date_create(date("$cm_start_time"));
        $date_cal = date_add($date,date_interval_create_from_date_string("$extra_days days"));
        $date_cal_format =  date_format($date_cal,"Y-m-d");
        $curent_date =  date_format(date_create(date("Y-m-d")),"Y-m-d");

        if($date_cal_format == $curent_date){

            $extra_days = $duration;
            $date = date_create(date("$cm_start_time"));
            $date_cal = date_add($date,date_interval_create_from_date_string("$extra_days days"));
            $date_cal_format =  date_format($date_cal,"Y-m-d");

            $data_calculation = Storechallengerdatas::
                                                    where([
                                                            ['storechallengerdatas.status','=',1],
                                                        ])
                                                    ->whereDate('storechallengerdatas.date', '>=', $cm_start_time)
                                                    ->whereDate('storechallengerdatas.date', '<=', $date_cal_format)
                                                    // ->select(DB::raw('SUM(storechallengerdatas.steps) as steps'))
                                                    ->select('storechallengerdatas.user_id',DB::raw('SUM(storechallengerdatas.steps) as steps'))
                                                    ->groupBy(
                                                        'storechallengerdatas.user_id',
                                                        )
                                                    ->get();

            // if(is_null($data_calculation[0]['steps']) == null){
            if(count($data_calculation) > 0){

                foreach ($data_calculation as $hey => $value) {

                    $steps = $data_calculation[0]['steps'];

                    if($goal <= $steps){

                        $steps_cal = $steps/$goal;
                        $point_user_gen = (int)$steps_cal * $oc_reward;

                        $update_query = Ongoingchallenger::
                                                where(['id' => $oc_id,'user_id' => $value['user_id']])
                                                ->update([
                                                    'ongoing_challengers.point' => $point_user_gen
                                                ]);
                        return $update_query;
                    }
                }
            }
        }
    }

    function daylykmcalculation($start_date_format,$duration,$cm_start_time,$goal,$oc_reward,$oc_id){

        $extra_days = $duration+1;
        $date = date_create(date("$cm_start_time"));
        $date_cal = date_add($date,date_interval_create_from_date_string("$extra_days days"));
        $date_cal_format =  date_format($date_cal,"Y-m-d");
        $curent_date =  date_format(date_create(date("Y-m-d")),"Y-m-d");
        if($date_cal_format == $curent_date){

            $data_calculation = Storechallengerdatas::
                                        where([
                                                ['storechallengerdatas.status','=',1],
                                            ])
                                        ->whereDate('storechallengerdatas.date', '=', $start_date_format)
                                        ->select('storechallengerdatas.user_id',DB::raw('SUM(storechallengerdatas.steps) as steps'))
                                        ->groupBy(
                                            'storechallengerdatas.user_id',
                                            )
                                        ->get();

            if(count($data_calculation) > 0){

                foreach ($data_calculation as $hey => $value) {

                    $steps = $value['steps'];

                    if($goal <= ((int)$steps)){

                        $extra_days = $duration+1;
                        $date = date_create(date("$cm_start_time"));
                        $date_cal = date_add($date,date_interval_create_from_date_string("$extra_days days"));
                        $date_cal_format =  date_format($date_cal,"Y-m-d");
                        $curent_date =  date_format(date_create(date("Y-m-d")),"Y-m-d");

                        if($date_cal_format == $curent_date){

                            if($goal <= $steps){

                                $steps_value = $steps/$goal;
                                $steps_cal = (int)$steps_value;
                                $point_user_gen = $steps_cal * $oc_reward;

                                $update_query = Ongoingchallenger::
                                                    where(['id' => $oc_id,'user_id' => $value['user_id']])
                                                    ->update([
                                                        'ongoing_challengers.point' => $point_user_gen
                                                    ]);
                                return $update_query;

                            }
                        }
                    }
                }
            }
        }
        $mysqlqueryupdate = $oc_id;
        return $mysqlqueryupdate;
    }

    function weeklymonthlykmcalculation($start_date_format,$duration,$cm_start_time,$goal,$oc_reward,$oc_id){

        $extra_days = $duration+1;
        $date = date_create(date("$cm_start_time"));
        $date_cal = date_add($date,date_interval_create_from_date_string("$extra_days days"));
        $date_cal_format =  date_format($date_cal,"Y-m-d");
        $curent_date =  date_format(date_create(date("Y-m-d")),"Y-m-d");

        if($date_cal_format == $curent_date){

            $extra_days = $duration;
            $date = date_create(date("$cm_start_time"));
            $date_cal = date_add($date,date_interval_create_from_date_string("$extra_days days"));
            $date_cal_format =  date_format($date_cal,"Y-m-d");

            $data_calculation = Storechallengerdatas::
                                                    where([
                                                            ['storechallengerdatas.status','=',1],
                                                        ])
                                                    ->whereDate('storechallengerdatas.date', '>=', $cm_start_time)
                                                    ->whereDate('storechallengerdatas.date', '<=', $date_cal_format)
                                                    // ->select(DB::raw('SUM(storechallengerdatas.steps) as steps'))
                                                    ->select('storechallengerdatas.user_id',DB::raw('SUM(storechallengerdatas.steps) as steps'))
                                                    ->groupBy(
                                                        'storechallengerdatas.user_id',
                                                        )
                                                    ->get();

            // if(is_null($data_calculation[0]['steps']) == null){
            if(count($data_calculation) > 0){

                foreach ($data_calculation as $hey => $value) {

                    $steps = $data_calculation[0]['steps'];

                    if($goal <= $steps){
                        // dd($oc_id);
                        // dd($steps);
                        $steps_cal = $steps/$goal;
                        $point_user_gen = (int)$steps_cal * $oc_reward;

                        $update_query = Ongoingchallenger::
                                                where(['id' => $oc_id,'user_id' => $value['user_id']])
                                                ->update([
                                                    'ongoing_challengers.point' => $point_user_gen
                                                ]);
                        return $update_query;
                    }
                }
            }
        }
    }
}
