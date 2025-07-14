<?php

namespace App\Http\Controllers\v2;

use App\Helpers\Helper as HelpersHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\v2\CommonController;
use App\Models\User;
use App\Models\Eventorganizations;
use App\Models\Eventleaderboards;
use App\Models\Userhistorytraking;
use App\Models\Usermeta;
use App\Models\EventCat;
use Response;
use Helper;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Composer\Semver\Interval;

class WeekendcycleeventsController extends Controller
{
    public function __construct() {

        $this->middleware('auth:api', ['except' => ['get_weekend_cycle_event','event_all_count_users','search_userid_event','user_details_event','search_userid_event_v2','search_userid_event_v3']]);

    }

    public function get_weekend_cycle_event(Request $request){

        try{
            $user = auth('api')->user();

            if($user){

                $event_data = Eventleaderboards::where('active', '=', 1)->orderBy('id', 'ASC')->get();

                $all_data = array (
                    "event_count" => count($event_data),
                    "title_text" => "Leaderboard",
                    "message_show" => "Photos will be deleted after 30 days",
                    "event_date" => $event_data,
                );

                if($event_data->count() > 0){

                    return Response::json(array(
                        'status'    => 'success',
                        'code'      =>  200,
                        'message'   =>  null,
                        'data'      => $all_data,
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

            $controller_name = 'WeekendcycleeventsController';
            $function_name = 'get_weekend_cycle_event';
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

    public function event_all_count_users(Request $request){
        try{

                $user = auth('api')->user();

                if($user){

                    $name = $request->name;
                    $number_user_list = 50;
                    if (isset($name)) {

                        $data_user = Userhistorytraking::
                                                        join('users', 'users.id', '=', 'userhistorytrakings.user_id')
                                                        ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                                                        ->leftJoin('user_leaderboard_images',  'user_leaderboard_images.user_id', '=', 'users.id')
                                                        ->select('user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->where('distance', '>', 1)
                                                        ->where('users.name', '=', $name)
                                                        ->where('created_by', '>=', '2024-12-17 00:00:01')
                                                        ->groupBy('user_id','fitindia.user_leaderboard_images.user_cycle_image','fitindia.users.name','fitindia.usermetas.state','fitindia.usermetas.image')
                                                        ->orderByDesc('total_distance')
                                                        ->paginate(50);

                        $data_user_count = Userhistorytraking::
                                                            join('users', 'users.id', '=', 'userhistorytrakings.user_id')
                                                            ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                                                            ->leftJoin('user_leaderboard_images',  'user_leaderboard_images.user_id', '=', 'users.id')
                                                            ->select('user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                            ->where('distance', '>', 1)
                                                            ->where('users.name', '=', $name)
                                                            ->where('created_by', '>=', '2024-12-17 00:00:01')
                                                            ->groupBy('user_id','fitindia.user_leaderboard_images.user_cycle_image','fitindia.users.name','fitindia.usermetas.state','fitindia.usermetas.image')
                                                            ->orderByDesc('total_distance')
                                                            ->get();
                    }else{

                        $data_user = Userhistorytraking::
                                            join('users', 'users.id', '=', 'userhistorytrakings.user_id')
                                            ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                                            ->leftJoin('user_leaderboard_images',  'user_leaderboard_images.user_id', '=', 'users.id')
                                            ->select('user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                            ->where('distance', '>', 1)
                                            ->where('created_by', '>=', '2024-12-17 00:00:01')
                                            ->groupBy('user_id','fitindia.user_leaderboard_images.user_cycle_image','fitindia.users.name','fitindia.usermetas.state','fitindia.usermetas.image')
                                            ->orderByDesc('total_distance')
                                            ->paginate(50);
                        $data_user_count = Userhistorytraking::
                                            join('users', 'users.id', '=', 'userhistorytrakings.user_id')
                                            ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                                            ->leftJoin('user_leaderboard_images',  'user_leaderboard_images.user_id', '=', 'users.id')
                                            ->select('user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                            ->where('distance', '>', 1)
                                            ->where('created_by', '>=', '2024-12-17 00:00:01')
                                            ->groupBy('user_id','fitindia.user_leaderboard_images.user_cycle_image','fitindia.users.name','fitindia.usermetas.state','fitindia.usermetas.image')
                                            ->orderByDesc('total_distance')
                                    ->get();
                    }
                    // dd($data_user);
                    $all_data = array (
                        // "active_user_count" => count($active_user),
                        "total_user_count" => count($data_user_count),
                        "all_user" => $data_user,
                    );
                    // dd((int)$active_all_participantnum['participantnum']);

                    if($data_user->count() > 0){
                        return Response::json(array(
                            'status'    => 'success',
                            'code'      =>  200,
                            'message'   =>  null,
                            'data'      => $all_data,
                        ), 200);

                    }else{
                        $all_data = array (
                            // "active_user_count" => count($active_user),
                            "title_text" => "Leaderboard",
                            "total_count" => "--",
                            "all_user" => "Data not found",
                        );
                        return Response::json(array(
                            'status'    => 'error',
                            'code'      =>  200,
                            'message'   =>  $all_data,
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

                $controller_name = 'WeekendcycleeventsController';
                $function_name = 'get_weekend_cycle_event';
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

    public function search_userid_event(Request $request){

        try{

            $user = auth('api')->user();

            if($user){

                    $to_date = $request->to_date;
                    $end_date = $request->end_date;

                    if (isset($to_date) && isset($end_date)) {

                        // dd($end_date);
                        $data_user = Userhistorytraking::
                                                        join('users', 'users.id', '=', 'userhistorytrakings.user_id')
                                                        ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                                                        ->leftJoin('user_leaderboard_images',  'user_leaderboard_images.user_id', '=', 'users.id')
                                                        ->select('user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->where('distance', '>', 1)
                                                        ->whereBetween('created_by',[$to_date,$end_date])
                                                        ->where('created_by', '>=', '2024-12-17 00:00:01')
                                                        ->groupBy('user_id','fitindia.user_leaderboard_images.user_cycle_image','fitindia.users.name','fitindia.usermetas.state','fitindia.usermetas.image')
                                                        ->orderByDesc('total_distance')
                                                        ->paginate(50);

                        $data_user_count = Userhistorytraking::
                                                        join('users', 'users.id', '=', 'userhistorytrakings.user_id')
                                                        ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                                                        ->leftJoin('user_leaderboard_images',  'user_leaderboard_images.user_id', '=', 'users.id')
                                                        ->select('user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->where('distance', '>', 1)
                                                        ->whereBetween('created_by',[$to_date,$end_date])
                                                        ->where('created_by', '>=', '2024-12-17 00:00:01')
                                                        ->groupBy('user_id','fitindia.user_leaderboard_images.user_cycle_image','fitindia.users.name','fitindia.usermetas.state','fitindia.usermetas.image')
                                                        ->orderByDesc('total_distance')
                                                        ->get();
                    }

                    if(count($data_user_count) > 0){

                        $count_data = count($data_user_count);

                    }else{
                        $count_data = 0;
                    }
                    $all_data = array (
                        // "active_user_count" => count($active_user),
                        "total_user_count" => $count_data,
                        "all_user" => $data_user,
                    );
                    // dd((int)$active_all_participantnum['participantnum']);

                    if($data_user->count() > 0){
                        return Response::json(array(
                            'status'    => 'success',
                            'code'      =>  200,
                            'message'   =>  null,
                            'data'      => $all_data,
                        ), 200);

                    }else{
                        $all_data = array (
                            // "active_user_count" => count($active_user),
                            "title_text" => "Leaderboard",
                            "total_count" => "--",
                            "all_user" => "Data not found",
                        );
                        return Response::json(array(
                            'status'    => 'error',
                            'code'      =>  200,
                            'message'   =>  $all_data,
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
                // $user = auth('api')->user();
                // // dd("search_userid_event");
                // if($user){

                //     $name = $request->name;
                //     $number_user_list = 50;
                //     if (isset($name)) {
                //         $active_all_user = User::
                //                                 join('event_organizations','event_organizations.user_id', '=',	'users.id')
                //                                 ->where(
                //                                 [
                //                                     ['users.rolewise', '=', 'cyclothon-2024'],
                //                                     ['users.name','=' , $name],
                //                                 ])
                //                                 ->orWhere('users.role','=' , 'namo-fit-india-cycling-club')
                //                                 ->paginate($number_user_list);
                //     }else{

                //         $active_all_user = User::
                //                                 join('event_organizations','event_organizations.user_id', '=',	'users.id')
                //                                 ->where([['users.rolewise', '=', 'cyclothon-2024']])
                //                                 ->orWhere('users.role','=' , 'namo-fit-india-cycling-club')
                //                                 ->paginate($number_user_list);

                //     }
                //     // dd($user_id);

                //     $active_all_participantnum = User::
                //                             join('event_organizations','event_organizations.user_id', '=',	'users.id')
                //                             ->where([['users.rolewise', '=', 'cyclothon-2024']])
                //                             ->orWhere('users.role','=' , 'namo-fit-india-cycling-club')
                //                             ->select(DB::raw('SUM(IFNULL(event_organizations.participantnum, 0)) as participantnum'))
                //                             ->get();

                //                             // $data_points = DB::select("SELECT sum(ifnull(on_c.point, 0) + ifnull(ur.score, 0)) as point FROM `users` as us LEFT JOIN ongoing_challengers as on_c on us.id = on_c.user_id LEFT JOIN user_ranks ur on ur.user_id = us.id LEFT JOIN challenger_masters cm on cm.id = on_c.challenger_id WHERE us.id = $user_id;")
                //     $participantnum_count = (int)$active_all_participantnum[0]['participantnum'];
                //     $total_count = $participantnum_count + count($active_all_user);

                //     $all_data = array (
                //         // "active_user_count" => count($active_user),
                //         "title_text" => "Leaderboard",
                //         "total_count" => $total_count,
                //         "all_user" => $active_all_user,
                //     );
                //     // dd((int)$active_all_participantnum['participantnum']);

                //     if($active_all_user->count() > 0){
                //         return Response::json(array(
                //             'status'    => 'success',
                //             'code'      =>  200,
                //             'message'   =>  null,
                //             'data'      => $all_data,
                //         ), 200);

                //     }else{
                //         $all_data = array (
                //             // "active_user_count" => count($active_user),
                //             "title_text" => "Leaderboard",
                //             "total_count" => "--",
                //             "all_user" => "Data not found",
                //         );
                //         return Response::json(array(
                //             'status'    => 'error',
                //             'code'      =>  200,
                //             'message'   =>  $all_data,
                //             'data'   => null,
                //         ), 401);
                //     }

                // }else{

                //     return Response::json(array(
                //         'status'    => 'error',
                //         'code'      =>  801,
                //         'message'   =>  'Unauthorized'
                //     ), 401);

                // }

            } catch(Exception $e) {

                $controller_name = 'WeekendcycleeventsController';
                $function_name = 'search_userid_event';
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

    public function user_details_event(Request $request){

        try{

                // dd("123456");
                $user = auth('api')->user();

                if($user){

                    $user_id = $request->user_id;

                    if (isset($user_id)) {

                        $data = Userhistorytraking::
                                                join('users', 'users.id', '=', 'userhistorytrakings.user_id')
                                                ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                                                ->leftJoin('user_leaderboard_images',  'user_leaderboard_images.user_id', '=', 'users.id')
                                                ->select('users.name','usermetas.state','user_leaderboard_images.user_cycle_image','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                ->where('distance', '>', 1)
                                                ->where('usermetas.user_id', '=', $user_id)
                                                ->where('created_by', '>=', '2024-12-17 00:00:01')
                                                ->groupBy('user_id','fitindia.user_leaderboard_images.user_cycle_image')
                                                ->orderByDesc('total_distance')
                                                ->get();
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
                                'message'   =>  'Data not found',
                                'data'   => null,
                            ), 401);
                        }

                    }

                }else{

                    return Response::json(array(
                        'status'    => 'error',
                        'code'      =>  801,
                        'message'   =>  'Unauthorized'
                    ), 401);

                }

            } catch(Exception $e) {

                $controller_name = 'WeekendcycleeventsController';
                $function_name = 'user_details_event';
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

    public function search_userid_event_v2_backup(Request $request){

        try{

            $user = auth('api')->user();

            if($user){

                    $to_date = $request->to_date;
                    $end_date = $request->end_date;
                    $name = $request->name;
                    $event_id = $request->event_id;
                    // dd($name);
                    if(isset($to_date) && isset($end_date) && isset($name)){

                        $data_user = Userhistorytraking::
                                                        join('users', 'users.id', '=', 'userhistorytrakings.user_id')
                                                        ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                                                        ->leftJoin('user_leaderboard_images',  'user_leaderboard_images.user_id', '=', 'users.id')
                                                        // ->select('user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->select(DB::raw("dense_rank() over(ORDER by SUM(distance) desc,SUM(duration) asc) as 'position'"),'user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->where('distance', '>', 1)
                                                        ->where('users.name', 'like', '%'. $name .'%')
                                                        ->whereBetween('created_by',[$to_date,$end_date])
                                                        ->where('created_by', '>=', '2024-12-17 00:00:01')
                                                        ->groupBy('user_id','fitindia.user_leaderboard_images.user_cycle_image','fitindia.users.name','fitindia.usermetas.state','fitindia.usermetas.image')
                                                        ->orderByDesc('total_distance')
                                                        ->paginate(50);

                        $data_user_count = Userhistorytraking::
                                                        join('users', 'users.id', '=', 'userhistorytrakings.user_id')
                                                        ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                                                        ->leftJoin('user_leaderboard_images',  'user_leaderboard_images.user_id', '=', 'users.id')
                                                        // ->select('user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->select(DB::raw("dense_rank() over(ORDER by SUM(distance) desc,SUM(duration) asc) as 'position'"),'user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->where('distance', '>', 1)
                                                        ->where('users.name', 'like', '%'. $name .'%')
                                                        ->whereBetween('created_by',[$to_date,$end_date])
                                                        ->where('created_by', '>=', '2024-12-17 00:00:01')
                                                        ->groupBy('user_id','fitindia.user_leaderboard_images.user_cycle_image','fitindia.users.name','fitindia.usermetas.state','fitindia.usermetas.image')
                                                        ->orderByDesc('total_distance')
                                                        ->get();

                    }else if (isset($to_date) && isset($end_date)) {
                        

                        $data_user = Userhistorytraking::
                                                        join('users', 'users.id', '=', 'userhistorytrakings.user_id')
                                                        ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                                                        ->leftJoin('user_leaderboard_images',  'user_leaderboard_images.user_id', '=', 'users.id')
                                                        // ->select('user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->select(DB::raw("dense_rank() over(ORDER by SUM(distance) desc,SUM(duration) asc) as 'position'"),'user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->where('distance', '>', 1)
                                                        ->whereBetween('created_by',[$to_date,$end_date])
                                                        ->where('created_by', '>=', '2024-12-17 00:00:01')
                                                        ->groupBy('user_id','fitindia.user_leaderboard_images.user_cycle_image','fitindia.users.name','fitindia.usermetas.state','fitindia.usermetas.image')
                                                        ->orderByDesc('total_distance')
                                                        ->paginate(50);

                        $data_user_count = Userhistorytraking::
                                                        join('users', 'users.id', '=', 'userhistorytrakings.user_id')
                                                        ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                                                        ->leftJoin('user_leaderboard_images',  'user_leaderboard_images.user_id', '=', 'users.id')
                                                        // ->select('user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->select(DB::raw("dense_rank() over(ORDER by SUM(distance) desc,SUM(duration) asc) as 'position'"),'user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->where('distance', '>', 1)
                                                        ->whereBetween('created_by',[$to_date,$end_date])
                                                        ->where('created_by', '>=', '2024-12-17 00:00:01')
                                                        ->groupBy('user_id','fitindia.user_leaderboard_images.user_cycle_image','fitindia.users.name','fitindia.usermetas.state','fitindia.usermetas.image')
                                                        ->orderByDesc('total_distance')
                                                        ->get();
                    }
                    else if(isset($name)){
                        // dd($name);
                        $data_user = Userhistorytraking::
                                                        join('users', 'users.id', '=', 'userhistorytrakings.user_id')
                                                        ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                                                        ->leftJoin('user_leaderboard_images',  'user_leaderboard_images.user_id', '=', 'users.id')
                                                        // ->select('user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->select(DB::raw("dense_rank() over(ORDER by SUM(distance) desc,SUM(duration) asc) as 'position'"),'user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->where('distance', '>', 1)
                                                        ->where('users.name', '=', $name)
                                                        // ->whereBetween('created_by',[$to_date,$end_date])
                                                        ->where('created_by', '>=', '2024-12-17 00:00:01')
                                                        ->groupBy('user_id','fitindia.user_leaderboard_images.user_cycle_image','fitindia.users.name','fitindia.usermetas.state','fitindia.usermetas.image')
                                                        ->orderByDesc('total_distance')
                                                        ->paginate(50);

                        $data_user_count = Userhistorytraking::
                                                        join('users', 'users.id', '=', 'userhistorytrakings.user_id')
                                                        ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                                                        ->leftJoin('user_leaderboard_images',  'user_leaderboard_images.user_id', '=', 'users.id')
                                                        // ->select('user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->select(DB::raw("dense_rank() over(ORDER by SUM(distance) desc,SUM(duration) asc) as 'position'"),'user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->where('distance', '>', 1)
                                                        ->where('users.name', '=', $name)
                                                        // ->whereBetween('created_by',[$to_date,$end_date])
                                                        ->where('created_by', '>=', '2024-12-17 00:00:01')
                                                        ->groupBy('user_id','fitindia.user_leaderboard_images.user_cycle_image','fitindia.users.name','fitindia.usermetas.state','fitindia.usermetas.image')
                                                        ->orderByDesc('total_distance')
                                                        ->get();

                    }

                    $event_data = Eventleaderboards::where('active', '=', 1)->where('id', '=', $event_id)->orderBy('id', 'ASC')->first();

                    if(isset($to_date)){

                        if($event_data['id'] != 1){

                            $event_data = Eventleaderboards::where('active', '=', 1)->where('id', '=', $event_id)->orderBy('id', 'ASC')->get();
                            $event_count = count($event_data);

                        }else{

                            $event_data = Eventleaderboards::where('active', '=', 1)->orderBy('id', 'ASC')->get();
                            $event_count = count($event_data);

                        }
                    }
                    // dd($event_count);
                    if(count($data_user_count) > 0){

                        $count_data = count($data_user_count);

                    }else{
                        $count_data = 0;
                    }

                    $all_data = array (

                        "event_count" => $event_count,
                        "total_user_count" => $count_data,
                        "all_user" => $data_user,
                    );

                    if($data_user->count() > 0){
                        return Response::json(array(
                            'status'    => 'success',
                            'code'      =>  200,
                            'message'   =>  null,
                            'data'      => $all_data,
                        ), 200);

                    }else{
                        $all_data = array (

                            "title_text" => "Leaderboard",
                            "total_count" => "--",
                            "all_user" => "Data not found",

                        );

                        return Response::json(array(

                            'status'    => 'error',
                            'code'      =>  200,
                            'message'   =>  $all_data,
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

                $controller_name = 'WeekendcycleeventsController';
                $function_name = 'search_userid_event_v2_backup';
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



    public function search_userid_event_v2(Request $request){

        try{

            $user = auth('api')->user();

            if($user){

                    $to_date = $request->to_date;
                    $end_date = $request->end_date;
                    $name = $request->name;
                    $event_id = $request->event_id;
                    // dd($name);
                    if(isset($to_date) && isset($end_date) && isset($name)){
                        // dd(123456);
                        $data_user = Userhistorytraking::
                                                        join('users', 'users.id', '=', 'userhistorytrakings.user_id')
                                                        ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                                                        ->leftJoin('user_leaderboard_images',  'user_leaderboard_images.user_id', '=', 'users.id')
                                                        // ->select('user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))                                                        
                                                        ->select(DB::raw("dense_rank() over(ORDER by SUM(distance) desc,SUM(duration) asc) as 'position'"),DB::raw('case when user_leaderboard_images.status = 1 then user_leaderboard_images.user_cycle_image else null end as user_cycle_image'),'users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->where('distance', '>', 1)
                                                        ->where('users.name', 'like', '%'. $name .'%')
                                                        ->whereBetween('created_by',[$to_date,$end_date])
                                                        ->where('created_by', '>=', '2024-12-17 00:00:01')
                                                        ->groupBy('user_id','fitindia.user_leaderboard_images.user_cycle_image','fitindia.users.name','fitindia.usermetas.state','fitindia.usermetas.image','user_leaderboard_images.status')
                                                        ->orderByDesc('total_distance')
                                                        ->paginate(50);

                        $data_user_count = Userhistorytraking::
                                                        join('users', 'users.id', '=', 'userhistorytrakings.user_id')
                                                        ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                                                        ->leftJoin('user_leaderboard_images',  'user_leaderboard_images.user_id', '=', 'users.id')
                                                        ->select('user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->where('distance', '>', 1)
                                                        ->where('users.name', 'like', '%'. $name .'%')
                                                        ->whereBetween('created_by',[$to_date,$end_date])
                                                        ->where('created_by', '>=', '2024-12-17 00:00:01')
                                                        ->groupBy('user_id','fitindia.user_leaderboard_images.user_cycle_image','fitindia.users.name','fitindia.usermetas.state','fitindia.usermetas.image')
                                                        ->orderByDesc('total_distance')
                                                        ->get();

                    }else if (isset($to_date) && isset($end_date)) {
                        // dd(321564);
                        
                        // $data_user = Userhistorytraking::
                        //                                 join('users', 'users.id', '=', 'userhistorytrakings.user_id')
                        //                                 ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                        //                                 ->leftJoin('user_leaderboard_images',  'user_leaderboard_images.user_id', '=', 'users.id')
                        //                                 ->select('user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                        //                                 // ->select(DB::raw('case when user_leaderboard_images.status = 1 then user_leaderboard_images.user_cycle_image else null end as user_cycle_image'),'users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                        //                                 // ->select(DB::raw("dense_rank() over(ORDER by SUM(duration) desc) as 'position'"),DB::raw('case when user_leaderboard_images.status = 1 then user_leaderboard_images.user_cycle_image else null end as user_cycle_image'),'users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                        //                                 ->where('user_leaderboard_images.status', '=', 1)
                        //                                 ->where('distance', '>', 1)
                        //                                 ->whereBetween('created_by',[$to_date,$end_date])
                        //                                 ->where('created_by', '>=', '2024-12-17 00:00:01')
                        //                                 ->groupBy('user_id','fitindia.user_leaderboard_images.user_cycle_image','fitindia.users.name','fitindia.usermetas.state','fitindia.usermetas.image','user_leaderboard_images.status')
                        //                                 ->orderByDesc('total_distance')
                        //                                 ->paginate(50);

                        // $data_user_count = Userhistorytraking::
                        //                                 join('users', 'users.id', '=', 'userhistorytrakings.user_id')
                        //                                 ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                        //                                 ->leftJoin('user_leaderboard_images',  'user_leaderboard_images.user_id', '=', 'users.id')
                        //                                 ->select('user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                        //                                 ->where('distance', '>', 1)
                        //                                 ->whereBetween('created_by',[$to_date,$end_date])
                        //                                 ->where('created_by', '>=', '2024-12-17 00:00:01')
                        //                                 ->groupBy('user_id','fitindia.user_leaderboard_images.user_cycle_image','fitindia.users.name','fitindia.usermetas.state','fitindia.usermetas.image')
                        //                                 ->orderByDesc('total_distance')
                        //                                 ->get();
                        $data_user = Userhistorytraking::
                                                        join('users', 'users.id', '=', 'userhistorytrakings.user_id')
                                                        ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                                                        ->leftJoin('user_leaderboard_images',  'user_leaderboard_images.user_id', '=', 'users.id')                                                        
                                                        // ->select(DB::raw("dense_rank() over(ORDER by SUM(distance) desc,SUM(duration) asc) as 'position'"),'user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))                                                        
                                                        ->select(DB::raw("dense_rank() over(ORDER by SUM(distance) desc,SUM(duration) asc) as 'position'"),DB::raw('case when user_leaderboard_images.status = 1 then user_leaderboard_images.user_cycle_image else null end as user_cycle_image'),'users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->where('distance', '>', 1)
                                                        ->whereBetween('created_by',[$to_date,$end_date])
                                                        ->where('created_by', '>=', '2024-12-17 00:00:01')
                                                        ->groupBy('user_id','fitindia.user_leaderboard_images.user_cycle_image','fitindia.users.name','fitindia.usermetas.state','fitindia.usermetas.image','user_leaderboard_images.status')
                                                        ->orderByDesc('total_distance')
                                                        ->paginate(50);

                        $data_user_count = Userhistorytraking::
                                                        join('users', 'users.id', '=', 'userhistorytrakings.user_id')
                                                        ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                                                        ->leftJoin('user_leaderboard_images',  'user_leaderboard_images.user_id', '=', 'users.id')
                                                        // ->select('user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->select(DB::raw("dense_rank() over(ORDER by SUM(distance) desc,SUM(duration) asc) as 'position'"),'user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->where('distance', '>', 1)
                                                        ->whereBetween('created_by',[$to_date,$end_date])
                                                        ->where('created_by', '>=', '2024-12-17 00:00:01')
                                                        ->groupBy('user_id','fitindia.user_leaderboard_images.user_cycle_image','fitindia.users.name','fitindia.usermetas.state','fitindia.usermetas.image')
                                                        ->orderByDesc('total_distance')
                                                        ->get();
                    }
                    else if(isset($name)){
                        // dd($name);
                        $data_user = Userhistorytraking::
                                                        join('users', 'users.id', '=', 'userhistorytrakings.user_id')
                                                        ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                                                        ->leftJoin('user_leaderboard_images',  'user_leaderboard_images.user_id', '=', 'users.id')
                                                        // ->select('user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))                                                        
                                                        ->select(DB::raw("dense_rank() over(ORDER by SUM(distance) desc,SUM(duration) asc) as 'position'"),DB::raw('case when user_leaderboard_images.status = 1 then user_leaderboard_images.user_cycle_image else null end as user_cycle_image'),'users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->where('distance', '>', 1)
                                                        ->where('users.name', '=', $name)
                                                        // ->whereBetween('created_by',[$to_date,$end_date])
                                                        ->where('created_by', '>=', '2024-12-17 00:00:01')
                                                        ->groupBy('user_id','fitindia.user_leaderboard_images.user_cycle_image','fitindia.users.name','fitindia.usermetas.state','fitindia.usermetas.image','user_leaderboard_images.status')
                                                        ->orderByDesc('total_distance')
                                                        ->paginate(50);

                        $data_user_count = Userhistorytraking::
                                                        join('users', 'users.id', '=', 'userhistorytrakings.user_id')
                                                        ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                                                        ->leftJoin('user_leaderboard_images',  'user_leaderboard_images.user_id', '=', 'users.id')
                                                        ->select('user_leaderboard_images.user_cycle_image','users.name','usermetas.state','usermetas.image','userhistorytrakings.user_id', DB::raw('SUM(duration) as total_duration'), DB::raw('SUM(distance) as total_distance'))
                                                        ->where('distance', '>', 1)
                                                        ->where('users.name', '=', $name)
                                                        // ->whereBetween('created_by',[$to_date,$end_date])
                                                        ->where('created_by', '>=', '2024-12-17 00:00:01')
                                                        ->groupBy('user_id','fitindia.user_leaderboard_images.user_cycle_image','fitindia.users.name','fitindia.usermetas.state','fitindia.usermetas.image')
                                                        ->orderByDesc('total_distance')
                                                        ->get();

                    }

                    $event_data = Eventleaderboards::where('active', '=', 1)->where('id', '=', $event_id)->orderBy('id', 'ASC')->first();

                    if(isset($to_date)){

                        if($event_data['id'] != 1){

                            $event_data = Eventleaderboards::where('active', '=', 1)->where('id', '=', $event_id)->orderBy('id', 'ASC')->get();
                            $event_count = count($event_data);

                        }else{

                            $event_data = Eventleaderboards::where('active', '=', 1)->orderBy('id', 'ASC')->get();
                            $event_count = count($event_data);

                        }
                    }
                    // dd($event_count);
                    if(count($data_user_count) > 0){

                        $count_data = count($data_user_count);

                    }else{
                        $count_data = 0;
                    }

                    $all_data = array (

                        "event_count" => $event_count,
                        "total_user_count" => $count_data,
                        "all_user" => $data_user,
                    );

                    if($data_user->count() > 0){
                        return Response::json(array(
                            'status'    => 'success',
                            'code'      =>  200,
                            'message'   =>  null,
                            'data'      => $all_data,
                        ), 200);

                    }else{
                        $all_data = array (

                            "title_text" => "Leaderboard",
                            "total_count" => "--",
                            "all_user" => "Data not found",

                        );

                        return Response::json(array(

                            'status'    => 'error',
                            'code'      =>  200,
                            'message'   =>  $all_data,
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

                $controller_name = 'WeekendcycleeventsController';
                $function_name = 'search_userid_event_v2';
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

}
