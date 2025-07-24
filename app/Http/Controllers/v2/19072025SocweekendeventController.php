<?php

namespace App\Http\Controllers\v2;

use App\Helpers\Helper as HelpersHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\v2\CommonController;
use App\Models\Soceventmaster;
use App\Models\Soceventparticipation;
use App\Models\Soceventparticipationreceive;
use App\Models\Socmasterequipment;
use App\Models\Eventmasterslots;
use Illuminate\Support\Facades\DB;
use Response;




class SocweekendeventController extends Controller
{
    public function __construct() {

        $this->middleware('auth:api', ['except' => ['get_datelist_soc','get_status_current_user','get_datewise_event_place','save_datewise_soc','get_remaining_stuff','save_datewise_receive_soc','get_status_waiting_soc','get_status_receive_soc_issue','get_status_receive_current_user','get_status_notgiving_user','post_soc_return_equipment','get_equipment_name','post_soc_return_equipment_status','soc_allotment_return_status','get_slot_time']]);
        // $this->middleware('auth:api', ['except' => ['get_datelist_soc','get_status_current_user','get_datewise_event_place','save_datewise_soc','get_remaining_stuff','save_datewise_receive_soc','get_status_waiting_soc','get_status_receive_soc_issue','get_status_receive_current_user','get_status_notgiving_user']]);

    }

    public function get_datelist_soc(Request $request){

        try{

            $user = auth('api')->user();

            if($user){
                $event_date = date("Y-m-d");
                $data = Soceventmaster::
                            where([
                                    ['soc_event_masters.status','=' , 1],
                                ])
                            ->whereDate('soc_event_masters.event_date', '>=' , $event_date)
                            ->select('event_date')
                            ->groupBy('event_date')
                            ->get();


                if($data->count() > 0){

                        return Response::json(array(
                            'status'    => 'success',
                            'statusbar'    => 1,
                            'socbookingterms'    => 1,
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

            $controller_name = 'SocweekendeventController';
            $function_name = 'get_datelist_soc';
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;

            $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);

            // if(empty($e)){
            //     return Response::json(array(
            //         'isSuccess' => 'false',
            //         'code'      => $error_code,
            //         'data'      => null,
            //         'message'   => $error_message
            //     ), 200);
            // }
        }
    }

    public function get_datewise_event_place(Request $request){

        try{

            $user = auth('api')->user();

            if($user){
                // $socemid = $request->socemid;
                $event_date = $request->event_date;


                // if($event_date == null || $event_date == ''){

                //     $error_code = '801';
                //     $error_message = 'Required soce event date';

                //     return Response::json(array(
                //         'isSuccess' => 'false',
                //         'code'      => $error_code,
                //         'data'      => null,
                //         'message'   => $error_message
                //     ), 200);
                // }
                if($event_date == null || $event_date == ''){

                    $data = DB::table('soc_event_masters as sem')
                        ->leftjoin('soc_event_participations as sep', 'sep.socemid', '=', 'sem.id')
                        ->select(
                            'sem.id',
                            'sem.venue',
                            'sem.cycle',
                            'sem.t_shirt',
                            'sem.meal',
                            DB::raw('CAST(IFNULL((sem.cycle - SUM(sep.cycle)), 0) AS SIGNED) AS remaining_cycle'),
                            DB::raw('CAST(IFNULL((sem.t_shirt - SUM(sep.t_shirt)), 0) AS SIGNED) AS remaining_tshirt'),
                            DB::raw('CAST(IFNULL((sem.meal - SUM(sep.meal)), 0) AS SIGNED) AS remaining_meal'),
                        )

                        ->where([
                                    ['sem.status','=' , 1]

                                ])
                        ->groupBy('sem.id', 'sem.venue', 'sem.cycle', 'sem.t_shirt','sem.meal')
                        ->get();

                }else{

                    $data = DB::table('soc_event_masters as sem')
                            ->leftjoin('soc_event_participations as sep', 'sep.socemid', '=', 'sem.id')
                            ->select(
                                'sem.id',
                                'sem.venue',
                                'sem.cycle',
                                'sem.t_shirt',
                                'sem.meal',
                                DB::raw('CAST(IFNULL((sem.cycle - SUM(sep.cycle)), 0) AS SIGNED) AS remaining_cycle'),
                                DB::raw('CAST(IFNULL((sem.t_shirt - SUM(sep.t_shirt)), 0) AS SIGNED) AS remaining_tshirt'),
                                DB::raw('CAST(IFNULL((sem.meal - SUM(sep.meal)), 0) AS SIGNED) AS remaining_meal'),
                            )
                            ->whereDate('sem.event_date', $event_date)
                            ->where([
                                        ['sem.status','=' , 1]

                                    ])
                            ->groupBy('sem.id', 'sem.venue', 'sem.cycle', 'sem.t_shirt','sem.meal')
                            ->get();
                }

                if($data->count() > 0){
                // if (isset($data)) {

                        return Response::json(array(
                            'status'    => 'success',
                            'statusbar'    => 1,
                            'socbookingterms'    => 1,
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

            $controller_name = 'SocweekendeventController';
            $function_name = 'get_datewise_event_place';
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;

            $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);

            if(empty($e)){
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }
        }
    }

    public function get_status_current_user(Request $request){

        try{

            $user = auth('api')->user();

            if($user){

                $socemid = $request->socemid;
                $user_id = $request->user_id;

                if($socemid == null || $socemid == ''){

                    $error_code = '801';
                    $error_message = 'Required soc master id';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($user_id == null || $user_id == ''){

                    $error_code = '801';
                    $error_message = 'Required user id';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                $data = Soceventparticipation::

                            where([
                                    ['soc_event_participations.status','=' , 1],
                                    ['soc_event_participations.socemid','=' , $socemid],
                                    ['soc_event_participations.user_id','=' , $user_id],
                                ])
                            // ->whereDate('event_date', $event_date)
                            ->select('id','being_on_cycle_check','being_on_cycle','cycle','cycle_booking','cycle_waiting','t_shirt','tshart_booking','tshirt_waiting','meal','meal_booking','meal_waiting')
                            ->first();

                    if (isset($data)){
                    // if($data->count() > 0){

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

            $controller_name = 'SocweekendeventController';
            $function_name = 'get_remaining_stuff';
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;

            $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);

            if(empty($e)){
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }
        }
    }

    public function save_datewise_soc(Request $request){

        try{
            $user = auth('api')->user();

            if($user){

                $socemid = $request->socemid;
                $user_id = $request->user_id;
                $uname = $request->uname;
                $cycle_check = $request->cycle_check;
                $cycle = $request->cycle;
                $t_shirt = $request->t_shirt;
                $t_shirt_check = $request->t_shirt_check;
                $meal = $request->meal;
                $meal_check = $request->meal_check;
                $latitude = $request->latitude;
                $longitude = $request->longitude;
                $event_date = $request->event_date;

                if($socemid == null || $socemid == ''){

                    $error_code = '801';
                    $error_message = 'Required soc event master id';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($user_id == null || $user_id == ''){

                    $error_code = '801';
                    $error_message = 'Required soc user id';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($uname == null || $uname == ''){

                    $error_code = '801';
                    $error_message = 'Required soc user name';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($cycle_check == 0 && $t_shirt_check == 0 && $meal_check == 0){

                    $error_code = '801';
                    $error_message = 'Please select at lest one item to book Cycle or Meal or T Shirt';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($latitude == null || $latitude == ''){

                    $error_code = '801';
                    $error_message = 'Required soc latitude';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($longitude == null || $longitude == ''){

                    $error_code = '801';
                    $error_message = 'Required soc longitude';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($event_date == null || $event_date == ''){

                    $error_code = '801';
                    $error_message = 'Required soc event date';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                // total avalablie
                $socevent_master_cycle = Soceventmaster::
                                        where([
                                            ['soc_event_masters.id', '=', $socemid],
                                        ])
                                        ->select('soc_event_masters.id','soc_event_masters.cycle','soc_event_masters.t_shirt','soc_event_masters.meal')
                                        ->first();

                $master_cycle_count = $socevent_master_cycle['cycle'];
                $master_tshirt_count = $socevent_master_cycle['t_shirt'];
                $master_meal_count = $socevent_master_cycle['meal'];
                // dd(13212311313131);
                if($cycle_check == 1){
                    if($master_cycle_count == 0){
                        $error_code = '801';
                        $error_message = "Cycle booking is currently unavailable.";

                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $error_message
                        ), 200);
                    }
                }
                if($t_shirt_check == 1){
                    if($master_tshirt_count == 0){
                        $error_code = '801';
                        $error_message = "T-shirt booking is currently unavailable.";

                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $error_message
                        ), 200);
                    }
                }

                if($meal_check == 1){
                    if($master_meal_count == 0){
                        $error_code = '801';
                        $error_message = "Meal booking is currently unavailable.";

                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $error_message
                        ), 200);
                    }
                }


                $user_taken_data = Soceventparticipation::
                                        where([
                                            ['soc_event_participations.socemid', '=', $socemid],
                                            ['soc_event_participations.user_id', '=', $user_id],
                                        ])
                                        ->select(
                                            'soc_event_participations.id',
                                            'soc_event_participations.user_id',
                                            'soc_event_participations.cycle',
                                            'soc_event_participations.cycle_booking',
                                            'soc_event_participations.cycle_waiting',
                                            'soc_event_participations.t_shirt',
                                            'soc_event_participations.tshart_booking',
                                            'soc_event_participations.tshirt_waiting',
                                            'soc_event_participations.meal',
                                            'soc_event_participations.meal_booking',
                                            'soc_event_participations.meal_waiting'
                                            )
                                        ->first();
                    // dd($user_taken_data);
                    if(isset($user_taken_data)){

                        $id = $user_taken_data['id'];

                        $user_takesn_cycle_count = Soceventparticipation::
                                        where([
                                            ['soc_event_participations.socemid', '=', $socemid],
                                        ])
                                        ->select(
                                            DB::raw('CAST(IFNULL(SUM(soc_event_participations.cycle), 0) AS SIGNED) AS remaining_cycle'),
                                            DB::raw('CAST(IFNULL(SUM(soc_event_participations.t_shirt), 0) AS SIGNED) AS remaining_tshirt'),
                                            DB::raw('CAST(IFNULL(SUM(soc_event_participations.meal), 0) AS SIGNED) AS remaining_meal'),
                                            )
                                        ->first();

                        $remaining_cycle = $user_takesn_cycle_count['remaining_cycle'];
                        $remaining_tshirt = $user_takesn_cycle_count['remaining_tshirt'];
                        $remaining_meal = $user_takesn_cycle_count['remaining_meal'];
                        // calculate remaining
                        $total_cycle_available = ($master_cycle_count - $remaining_cycle);
                        $total_tshart_available = ($master_tshirt_count - $remaining_tshirt);
                        $total_meal_available = ($master_meal_count - $remaining_meal);

                        // update cycle

                        if($cycle_check == 1){

                            $taken_cycle_booking = $user_taken_data['cycle_booking'];
                            $taken_cycle_waiting = $user_taken_data['cycle_waiting'];

                            if(!isset($taken_cycle_booking) && !isset($taken_cycle_waiting)){

                                if($total_cycle_available > 0){

                                    if(!isset($user_taken_data['cycle'])){
                                        // dd($remaining_cycle);
                                        $booking_id_no = ($remaining_cycle + 1);
                                        // dd($booking_id_no);
                                        $cycle_booking = "Booking Id:- ".$booking_id_no;

                                        Soceventparticipation::where([
                                                        ['soc_event_participations.id', '=', $id],
                                                        ['soc_event_participations.user_id', '=', $user_id],
                                                        ['soc_event_participations.status', '=', 1],
                                                    ])
                                                    ->update(
                                                        [
                                                            'soc_event_participations.cycle_booking' => $cycle_booking,
                                                            'soc_event_participations.cycle' => $cycle
                                                        ]
                                                    );

                                    }

                                }

                                if($total_cycle_available == 0){

                                    $remaining_cycle_cal = Soceventparticipation::
                                                    where([
                                                        ['soc_event_participations.socemid', '=', $socemid],
                                                        ['soc_event_participations.cycle_waiting', 'like', "%Waiting id:-%"],
                                                    ])
                                                    ->select(DB::raw('count(soc_event_participations.cycle_waiting) as count_cycle_waiting'))
                                                    ->first();

                                    $remaining_cycle_cal_wat = $remaining_cycle_cal['count_cycle_waiting'] + 1;

                                    $cycle_waiting = "Waiting id:- ".$remaining_cycle_cal_wat;

                                    Soceventparticipation::where([
                                                                ['soc_event_participations.id', '=', $id],
                                                                ['soc_event_participations.user_id', '=', $user_id],
                                                                ['soc_event_participations.status', '=', 1],
                                                            ])
                                                            ->update(
                                                                [
                                                                    'soc_event_participations.cycle_waiting' => $cycle_waiting,
                                                                    'soc_event_participations.cycle' => null
                                                                ]
                                                            );
                                }
                            }
                        }
                        // update tshart
                        if($t_shirt_check == 1){

                            $taken_tshart_booking = $user_taken_data['tshart_booking'];
                            $taken_tshirt_waiting = $user_taken_data['tshirt_waiting'];

                            if(!isset($taken_tshart_booking) && !isset($taken_tshirt_waiting)){

                                if($total_tshart_available > 0){

                                    if(!isset($user_taken_data['t_shirt'])){

                                        $booking_tshart_id_no = ($remaining_tshirt +1);
                                        $tshart_booking = "Booking Id:- ". $booking_tshart_id_no;

                                        Soceventparticipation::where([
                                                        ['soc_event_participations.id', '=', $id],
                                                        ['soc_event_participations.user_id', '=', $user_id],
                                                        ['soc_event_participations.status', '=', 1],
                                                    ])
                                                    ->update(
                                                        [
                                                            'soc_event_participations.tshart_booking' => $tshart_booking,
                                                            'soc_event_participations.t_shirt' => $t_shirt
                                                        ]
                                                    );
                                    }
                                }

                                if($total_tshart_available == 0){

                                    if(!isset($user_taken_data['tshart_booking'])){

                                        $remaining_tshirt_cal = Soceventparticipation::
                                                            where([
                                                                ['soc_event_participations.socemid', '=', $socemid],
                                                                ['soc_event_participations.tshirt_waiting', 'like', "%Waiting id:-%"],
                                                            ])
                                                            ->select(DB::raw('count(soc_event_participations.tshirt_waiting) as count_tshirt_waiting'))
                                                            ->first();

                                        $remaining_tshirt_cal = $remaining_tshirt_cal['count_tshirt_waiting'] + 1;
                                        $tshirt_waiting = "Waiting id:- ".$remaining_tshirt_cal;

                                        Soceventparticipation::where([
                                                    ['soc_event_participations.id', '=', $id],
                                                    ['soc_event_participations.user_id', '=', $user_id],
                                                    ['soc_event_participations.status', '=', 1],
                                                ])
                                                ->update(
                                                    [
                                                        'soc_event_participations.tshirt_waiting' => $tshirt_waiting,
                                                        'soc_event_participations.t_shirt' => null
                                                    ]
                                                );
                                    }

                                }
                            }
                        }
                        // insert meal
                        if($meal_check == 1){

                            // dd($total_meal_available);
                            $taken_meal_booking = $user_taken_data['meal_booking'];
                            $taken_meal_waiting = $user_taken_data['meal_waiting'];

                            if(!isset($taken_meal_booking) && !isset($taken_meal_waiting)){

                                if($total_meal_available > 0){

                                    if(!isset($user_taken_data['meal'])){

                                        $booking_meal_no = ($remaining_meal +1);
                                        $meal_booking = "Booking Id:- ". $booking_meal_no;

                                        Soceventparticipation::where([
                                                        ['soc_event_participations.id', '=', $id],
                                                        ['soc_event_participations.user_id', '=', $user_id],
                                                        ['soc_event_participations.status', '=', 1],
                                                    ])
                                                    ->update(
                                                        [
                                                            'soc_event_participations.meal_booking' => $meal_booking,
                                                            'soc_event_participations.meal' => $meal
                                                        ]
                                                    );
                                    }
                                }

                                if($total_meal_available == 0){

                                    if(!isset($user_taken_data['meal_booking'])){

                                        $remaining_meal_cal = Soceventparticipation::
                                                            where([
                                                                ['soc_event_participations.socemid', '=', $socemid],
                                                                ['soc_event_participations.meal_waiting', 'like', "%Waiting id:-%"],
                                                            ])
                                                            ->select(DB::raw('count(soc_event_participations.meal_waiting) as count_meal_waiting'))
                                                            ->first();
                                        $remaining_meal_cal_wat = $remaining_meal_cal['count_meal_waiting'] + 1;
                                        $meal_waiting = "Waiting id:- ".$remaining_meal_cal_wat;

                                        Soceventparticipation::where([
                                                                        ['soc_event_participations.id', '=', $id],
                                                                        ['soc_event_participations.user_id', '=', $user_id],
                                                                        ['soc_event_participations.status', '=', 1],
                                                                    ])
                                                                    ->update(
                                                                        [
                                                                            'soc_event_participations.meal_waiting' => $meal_waiting,
                                                                            'soc_event_participations.meal' => null
                                                                        ]
                                                                    );

                                    }

                                }
                            }
                        }
                    }else{

                        // dd($user_taken_data);
                        $user_takesn_cycle_count = Soceventparticipation::
                                        where([
                                            ['soc_event_participations.socemid', '=', $socemid],
                                        ])
                                        ->select(
                                            DB::raw('CAST(IFNULL(SUM(soc_event_participations.cycle), 0) AS SIGNED) AS remaining_cycle'),
                                            DB::raw('CAST(IFNULL(SUM(soc_event_participations.t_shirt), 0) AS SIGNED) AS remaining_tshirt'),
                                            DB::raw('CAST(IFNULL(SUM(soc_event_participations.meal), 0) AS SIGNED) AS remaining_meal'),
                                            // DB::raw('CAST(IFNULL(sum(soc_event_participations.cycle), 0) as int) as remaining_cycle'),
                                            // DB::raw('CAST(IFNULL(sum(soc_event_participations.t_shirt), 0) as int) as remaining_tshirt'),
                                            // DB::raw('CAST(IFNULL(sum(soc_event_participations.meal), 0) as int) as remaining_meal'),
                                            )
                                        ->first();

                        $remaining_cycle = $user_takesn_cycle_count['remaining_cycle'];
                        $remaining_tshirt = $user_takesn_cycle_count['remaining_tshirt'];
                        $remaining_meal = $user_takesn_cycle_count['remaining_meal'];
                        // calculate remaining
                        $total_cycle_available = ($master_cycle_count - $remaining_cycle);
                        $total_tshart_available = ($master_tshirt_count - $remaining_tshirt);
                        $total_meal_available = ($master_meal_count - $remaining_meal);

                        // insert cycle
                        if($cycle_check == 1){

                            if($total_cycle_available > 0){

                                $booking_id_no = ($remaining_cycle + 1);
                                $cycle_booking = "Booking Id:- ".$booking_id_no;

                            }
                            if($total_cycle_available == 0){

                                $remaining_cycle_cal = Soceventparticipation::
                                                    where([
                                                        ['soc_event_participations.socemid', '=', $socemid],
                                                        ['soc_event_participations.cycle_waiting', 'like', "%Waiting id:-%"],
                                                    ])
                                                    ->select(DB::raw('count(soc_event_participations.cycle_waiting) as count_cycle_waiting'))
                                                    ->first();

                                $remaining_cycle_cal_wat = $remaining_cycle_cal['count_cycle_waiting'] + 1;

                                $cycle_waiting = "Waiting id:- ".$remaining_cycle_cal_wat;

                            }
                        }
                        // insert tshart
                        if($t_shirt_check == 1){
                            if($total_tshart_available > 0){

                                $booking_tshart_id_no = ($remaining_tshirt +1);
                                $tshart_booking = "Booking Id:- ". $booking_tshart_id_no;
                            }
                            if($total_tshart_available == 0){

                                $remaining_tshirt_cal = Soceventparticipation::
                                                    where([
                                                        ['soc_event_participations.socemid', '=', $socemid],
                                                        ['soc_event_participations.tshirt_waiting', 'like', "%Waiting id:-%"],
                                                    ])
                                                    ->select(DB::raw('count(soc_event_participations.tshirt_waiting) as count_tshirt_waiting'))
                                                    ->first();

                                $remaining_tshirt_cal = $remaining_tshirt_cal['count_tshirt_waiting'] + 1;
                                $tshirt_waiting = "Waiting id:- ".$remaining_tshirt_cal;

                            }
                        }
                        // insert meal
                        if($meal_check == 1){
                            if($total_meal_available > 0){

                                $booking_meal_no = ($remaining_meal +1);
                                $meal_booking = "Booking Id:- ". $booking_meal_no;

                            }
                            if($total_meal_available == 0){

                                $remaining_meal_cal = Soceventparticipation::
                                                    where([
                                                        ['soc_event_participations.socemid', '=', $socemid],
                                                        ['soc_event_participations.meal_waiting', 'like', "%Waiting id:-%"],
                                                    ])
                                                    ->select(DB::raw('count(soc_event_participations.meal_waiting) as count_meal_waiting'))
                                                    ->first();
                                $remaining_meal_cal_wat = $remaining_meal_cal['count_meal_waiting'] + 1;
                                $meal_waiting = "Waiting id:- ".$remaining_meal_cal_wat;

                            }
                        }
                        // Save Data
                        $datastore = new Soceventparticipation();
                        $datastore->socemid = $socemid;
                        $datastore->user_id = $user_id;
                        $datastore->uname = $uname;

                        if($cycle_check == 1){

                            if(isset($cycle_waiting)){

                                $datastore->cycle_waiting = $cycle_waiting;
                                $datastore->cycle = null;
                            }else{

                                $datastore->cycle = $cycle;
                                $datastore->cycle_booking = $cycle_booking;
                            }
                        }

                        if($t_shirt_check == 1){

                            if(isset($tshirt_waiting)){

                                $datastore->tshirt_waiting = $tshirt_waiting;
                                $datastore->t_shirt = null;

                            }else{
                                $datastore->t_shirt = $t_shirt;
                                $datastore->tshart_booking = $tshart_booking;

                            }
                        }
                        if($meal_check == 1){

                            if(isset($meal_waiting)){

                                $datastore->meal_waiting = $meal_waiting;
                                $datastore->meal = null;

                            }else{

                                $datastore->meal = $meal;
                                $datastore->meal_booking = $meal_booking;
                            }
                        }

                        $datastore->latitude = $latitude;
                        $datastore->longitude = $longitude;
                        $datastore->event_date = $event_date;
                        $datastore->status = 1;
                        $datastore->save();
                    }

                return Response::json(array(
                    'isSuccess' => 'true',
                    // 'message_show' =>  'You get tshirt',
                    // 'successm' => $success_message,
                    'code'      => 200,
                    'data'      => null,
                    'message'   => 'You’ve successfully registered for FIT India Sundays on Cycle.”'
                ), 200);

            }else{

                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'message'   =>  'Unauthorized'
                ), 401);

            }

        } catch(Exception $e) {

            $controller_name = 'SocweekendeventController';
            $function_name = 'save_datewise_soc';
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;

            $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);

            if(empty($e)){
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }
        }
    }

    public function save_datewise_receive_soc(Request $request){

        try{

            $user = auth('api')->user();

            if($user){

                $socemid = $request->socemid;
                $user_id = $request->user_id;
                $uname = $request->uname;
                $cycle_check = $request->cycle_check;
                $cycle = $request->cycle;
                $cycle_admin_user_id = $request->cycle_admin_user_id;
                $t_shirt = $request->t_shirt;
                $t_shirt_check = $request->t_shirt_check;
                $tshart_admin_user_id = $request->tshart_admin_user_id;
                $meal = $request->meal;
                $meal_check = $request->meal_check;
                $meal_admin_user_id = $request->meal_admin_user_id;
                $latitude = $request->latitude;
                $longitude = $request->longitude;
                $event_date = $request->event_date;

                if($socemid == null || $socemid == ''){

                    $error_code = '801';
                    $error_message = 'Required soc event master id';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($user_id == null || $user_id == ''){

                    $error_code = '801';
                    $error_message = 'Required soc user id';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($uname == null || $uname == ''){

                    $error_code = '801';
                    $error_message = 'Required soc user name';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                // if($cycle == ''){

                //     $error_code = '801';
                //     $error_message = 'Required soc cycle';

                //     return Response::json(array(
                //         'isSuccess' => 'false',
                //         'code'      => $error_code,
                //         'data'      => null,
                //         'message'   => $error_message
                //     ), 200);
                // }

                // if($cycle_admin_user_id == null || $cycle_admin_user_id == ''){

                //     $error_code = '801';
                //     $error_message = 'Required soc cycle admin user id';

                //     return Response::json(array(
                //         'isSuccess' => 'false',
                //         'code'      => $error_code,
                //         'data'      => null,
                //         'message'   => $error_message
                //     ), 200);
                // }

                // if($t_shirt == ''){

                //     $error_code = '801';
                //     $error_message = 'Required soc t shirt';

                //     return Response::json(array(
                //         'isSuccess' => 'false',
                //         'code'      => $error_code,
                //         'data'      => null,
                //         'message'   => $error_message
                //     ), 200);
                // }

                // if($tshart_admin_user_id == null || $tshart_admin_user_id == ''){

                //     $error_code = '801';
                //     $error_message = 'Required soc tshart admin user id';

                //     return Response::json(array(
                //         'isSuccess' => 'false',
                //         'code'      => $error_code,
                //         'data'      => null,
                //         'message'   => $error_message
                //     ), 200);
                // }

                // if($meal == ''){

                //     $error_code = '801';
                //     $error_message = 'Required soc meal';

                //     return Response::json(array(
                //         'isSuccess' => 'false',
                //         'code'      => $error_code,
                //         'data'      => null,
                //         'message'   => $error_message
                //     ), 200);
                // }

                // if($meal_admin_user_id == null || $meal_admin_user_id == ''){

                //     $error_code = '801';
                //     $error_message = 'Required soc meal admin user id';

                //     return Response::json(array(
                //         'isSuccess' => 'false',
                //         'code'      => $error_code,
                //         'data'      => null,
                //         'message'   => $error_message
                //     ), 200);
                // }


                if($latitude == null || $latitude == ''){

                    $error_code = '801';
                    $error_message = 'Required soc latitude';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($longitude == null || $longitude == ''){

                    $error_code = '801';
                    $error_message = 'Required soc longitude';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($event_date == null || $event_date == ''){

                    $error_code = '801';
                    $error_message = 'Required soc event date';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                // calculate useing
                $user_booking_conformation = Soceventparticipation::
                                        where([
                                            ['soc_event_participations.socemid', '=', $socemid],
                                            ['soc_event_participations.user_id', '=', $user_id],
                                            ['soc_event_participations.status', '=', 1],
                                        ])
                                        ->whereDate('soc_event_participations.event_date', $event_date)
                                        ->select(
                                            DB::raw('CAST(IFNULL(SUM(soc_event_participations.cycle), 0) AS SIGNED) AS cycle_conformation'),
                                            DB::raw('CAST(IFNULL(SUM(soc_event_participations.t_shirt), 0) AS SIGNED) AS tshirt_conformation'),
                                            DB::raw('CAST(IFNULL(SUM(soc_event_participations.meal), 0) AS SIGNED) AS meal_conformation'),
                                            // DB::raw('CAST(IFNULL(soc_event_participations.cycle, 0) as int) as cycle_conformation'),
                                            // DB::raw('CAST(IFNULL(soc_event_participations.t_shirt, 0) as int) as tshirt_conformation'),
                                            // DB::raw('CAST(IFNULL(soc_event_participations.meal, 0) as int) as meal_conformation'),
                                            )
                                        ->first();

                if(isset($user_booking_conformation)){

                    $booking_cycle_count = $user_booking_conformation['cycle_conformation'];
                    $booking_tshirt_count = $user_booking_conformation['tshirt_conformation'];
                    $booking_meal_count = $user_booking_conformation['meal_conformation'];

                }else{

                    $booking_cycle_count = 0;
                    $booking_tshirt_count = 0;
                    $booking_meal_count = 0;
                }

                $user_booking_conformation = Soceventparticipationreceive::
                                            where([
                                                ['soc_event_participation_receives.socemid', '=', $socemid],
                                                ['soc_event_participation_receives.user_id', '=', $user_id],
                                                ['soc_event_participation_receives.status', '=', 1],
                                            ])
                                            // ->whereDate('soc_event_participation_receives.event_date', $event_date)
                                            // ->select(
                                            //         DB::raw('CAST(IFNULL(SUM(soc_event_participation_receives.cycle), 0) AS SIGNED) AS cycle_conformation'),
                                            //         DB::raw('CAST(IFNULL(SUM(soc_event_participation_receives.t_shirt), 0) AS SIGNED) AS tshirt_conformation'),
                                            //         DB::raw('CAST(IFNULL(SUM(soc_event_participation_receives.meal), 0) AS SIGNED) AS meal_conformation'),
                                            //         // DB::raw('CAST(IFNULL(soc_event_participation_receives.cycle, 0) as int) as cycle_conformation'),
                                            //         // DB::raw('CAST(IFNULL(soc_event_participation_receives.cycle, 0) as int) as cycle_conformation'),
                                            //         // DB::raw('CAST(IFNULL(soc_event_participation_receives.t_shirt, 0) as int) as tshirt_conformation'),
                                            //     )
                                            // ->get();
                                            ->first();

                if(isset($user_booking_conformation)){

                    if($cycle_check == 1){

                        if(isset($user_booking_conformation)){


                            $cycle = $user_booking_conformation['cycle'] + 1;


                            Soceventparticipationreceive::where([
                                                                ['soc_event_participation_receives.socemid', '=', $socemid],
                                                                ['soc_event_participation_receives.user_id', '=', $user_id],
                                                                ['soc_event_participation_receives.status', '=', 1],
                                                            ])
                                                            ->update(
                                                                ['soc_event_participation_receives.cycle' => $cycle,
                                                                'soc_event_participation_receives.cycle_admin_user_id' => $cycle_admin_user_id]
                                                            );

                            return Response::json(array(
                                                'isSuccess' => 'true',
                                                'code'      => 200,
                                                'data'      => null,
                                                'message'   => 'Cycle Issued'
                                            ), 200);
                        }

                    }

                    if($t_shirt_check == 1){

                        if(isset($user_booking_conformation)){

                            $t_shirt = $user_booking_conformation['t_shirt'] + 1;

                            Soceventparticipationreceive::where([
                                                                ['soc_event_participation_receives.socemid', '=', $socemid],
                                                                ['soc_event_participation_receives.user_id', '=', $user_id],
                                                                ['soc_event_participation_receives.status', '=', 1],
                                                            ])
                                                            ->update(
                                                                [
                                                                    'soc_event_participation_receives.t_shirt' => $t_shirt,
                                                                    'soc_event_participation_receives.tshart_admin_user_id' => $tshart_admin_user_id
                                                                ]
                                                            );

                            return Response::json(array(
                                                'isSuccess' => 'true',
                                                'code'      => 200,
                                                'data'      => null,
                                                'message'   => 'T shirt Issued'
                                            ), 200);
                        }
                    }

                    if($meal_check == 1){

                        if(isset($user_booking_conformation)){

                            $meal = $user_booking_conformation['meal'] + 1;

                            Soceventparticipationreceive::where([
                                                                ['soc_event_participation_receives.socemid', '=', $socemid],
                                                                ['soc_event_participation_receives.user_id', '=', $user_id],
                                                                ['soc_event_participation_receives.status', '=', 1],
                                                            ])
                                                            ->update(
                                                                [
                                                                    'soc_event_participation_receives.meal' => $meal,
                                                                    'soc_event_participation_receives.meal_admin_user_id' => $meal_admin_user_id
                                                                ]
                                                            );

                            return Response::json(array(
                                                'isSuccess' => 'true',
                                                'code'      => 200,
                                                'data'      => null,
                                                'message'   => 'Meal Issued'
                                            ), 200);
                        }

                    }
                }

                $datareceivestore = new Soceventparticipationreceive();
                $datareceivestore->socemid = $socemid;
                $datareceivestore->user_id = $user_id;
                $datareceivestore->uname = $uname;

                if($cycle_check == 1){

                    if($booking_cycle_count == 1){
                        $datareceivestore->cycle = $booking_cycle_count;
                        $datareceivestore->cycle_admin_user_id = $cycle_admin_user_id;
                    }
                    if($booking_cycle_count == 0){
                        $datareceivestore->cycle = $cycle;
                        $datareceivestore->cycle_admin_user_id = $cycle_admin_user_id;
                    }

                    $message = "Cycle Issued";
                }

                if($t_shirt_check == 1){

                    if($booking_tshirt_count == 1){
                        $datareceivestore->t_shirt = $booking_tshirt_count;
                        $datareceivestore->tshart_admin_user_id = $tshart_admin_user_id;
                    }
                    if($booking_tshirt_count == 0){
                        $datareceivestore->t_shirt = $t_shirt;
                        $datareceivestore->tshart_admin_user_id = $tshart_admin_user_id;
                    }

                    $message = "T shirt Issued";
                }

                if($meal_check == 1){

                    if($booking_meal_count == 1){
                        $datareceivestore->meal = $booking_meal_count;
                        $datareceivestore->meal_admin_user_id = $meal_admin_user_id;
                    }
                    if($booking_meal_count == 0){
                        $datareceivestore->meal = $meal;
                        $datareceivestore->meal_admin_user_id = $meal_admin_user_id;
                    }

                    $message = "Meal Issued";
                }

                $datareceivestore->latitude = $latitude;
                $datareceivestore->longitude = $longitude;
                $datareceivestore->event_date = $event_date;
                $datareceivestore->status = 1;
                $datareceivestore->save();

                return Response::json(array(
                    'isSuccess' => 'true',
                    // 'message_show' =>  'You get tshirt',
                    // 'successm' => $success_message,
                    'code'      => 200,
                    'data'      => null,
                    'message'   => $message
                ), 200);

            }else{

                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'message'   =>  'Unauthorized'
                ), 401);

            }

        } catch(Exception $e) {

            $controller_name = 'SocweekendeventController';
            $function_name = 'save_datewise_soc';
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;

            $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);

            if(empty($e)){
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }
        }
    }

    public function get_status_waiting_soc(Request $request){

        try{

            $user = auth('api')->user();

            if($user){

                $socemid = $request->socemid;
                // $user_id = $request->user_id;

                if($socemid == null || $socemid == ''){

                    $error_code = '801';
                    $error_message = 'Required soc master id';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                // if($user_id == null || $user_id == ''){

                //     $error_code = '801';
                //     $error_message = 'Required user id';

                //     return Response::json(array(
                //         'isSuccess' => 'false',
                //         'code'      => $error_code,
                //         'data'      => null,
                //         'message'   => $error_message
                //     ), 200);
                // }

                $data = Soceventparticipation::

                            where([
                                    ['soc_event_participations.status','=' , 1],
                                    ['soc_event_participations.socemid','=' , $socemid],
                                ])
                            // ->whereDate('event_date', $event_date)
                            ->select('id','cycle_waiting','tshirt_waiting','meal_waiting')
                             ->orderBy('soc_event_participations.id', 'DESC')
                            ->first();

                if (isset($data)){
                // if($data->count() > 0){

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

            $controller_name = 'SocweekendeventController';
            $function_name = 'get_status_waiting_soc';
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;

            $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);

            if(empty($e)){
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }
        }
    }

    public function get_status_receive_soc_issue(Request $request){

        try{

            $user = auth('api')->user();

            if($user){
                // $socemid = $request->socemid;
                $event_date = $request->event_date;

                if($event_date == null || $event_date == ''){

                    $data = DB::table('soc_event_masters as sem')
                        ->leftjoin('soc_event_participation_receives as sepr', 'sepr.socemid', '=', 'sem.id')
                        ->select(
                            'sem.id',
                            'sem.venue',
                            'sem.cycle',
                            'sem.t_shirt',
                            'sem.meal',
                            // DB::raw('CAST(IFNULL((sem.cycle - SUM(sepr.cycle)), 0) AS SIGNED) AS remaining_cycle'),
                            // DB::raw('CAST(IFNULL((sem.t_shirt - SUM(sepr.t_shirt)), 0) AS SIGNED) AS remaining_tshirt'),
                            // DB::raw('CAST(IFNULL((sem.meal - SUM(sepr.meal)), 0) AS SIGNED) AS remaining_meal'),
                            DB::raw('CAST(IFNULL(SUM(sepr.cycle), 0) AS SIGNED) AS remaining_cycle'),
                                DB::raw('CAST(IFNULL(SUM(sepr.t_shirt), 0) AS SIGNED) AS remaining_tshirt'),
                                DB::raw('CAST(IFNULL(SUM(sepr.meal), 0) AS SIGNED) AS remaining_meal'),
                        )

                        ->where([
                                    ['sem.status','=' , 1]

                                ])
                        ->groupBy('sem.id', 'sem.venue', 'sem.cycle', 'sem.t_shirt','sem.meal')
                        ->get();

                }else{

                    $data = DB::table('soc_event_masters as sem')
                            ->leftjoin('soc_event_participation_receives as sepr', 'sepr.socemid', '=', 'sem.id')
                            ->select(
                                'sem.id',
                                'sem.venue',
                                'sem.cycle',
                                'sem.t_shirt',
                                'sem.meal',
                                // DB::raw('CAST(IFNULL((sem.cycle - SUM(sepr.cycle)), 0) AS SIGNED) AS remaining_cycle'),
                                // DB::raw('CAST(IFNULL((sem.t_shirt - SUM(sepr.t_shirt)), 0) AS SIGNED) AS remaining_tshirt'),
                                // DB::raw('CAST(IFNULL((sem.meal - SUM(sepr.meal)), 0) AS SIGNED) AS remaining_meal'),
                                DB::raw('CAST(IFNULL(SUM(sepr.cycle), 0) AS SIGNED) AS remaining_cycle'),
                                DB::raw('CAST(IFNULL(SUM(sepr.t_shirt), 0) AS SIGNED) AS remaining_tshirt'),
                                DB::raw('CAST(IFNULL(SUM(sepr.meal), 0) AS SIGNED) AS remaining_meal'),
                            )
                            ->whereDate('sem.event_date', $event_date)
                            ->where([
                                        ['sem.status','=' , 1]

                                    ])
                            ->groupBy('sem.id', 'sem.venue', 'sem.cycle', 'sem.t_shirt','sem.meal')
                            ->get();
                }

                if($data->count() > 0){
                // if (isset($data)) {

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

            $controller_name = 'SocweekendeventController';
            $function_name = 'get_status_receive_soc_issue';
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;

            $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);

            if(empty($e)){
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }
        }
    }

    // get_status_receive_current_user
    public function get_status_receive_current_user(Request $request){

        try{

            $user = auth('api')->user();

            if($user){

                $socemid = $request->socemid;
                $user_id = $request->user_id;

                if($socemid == null || $socemid == ''){

                    $error_code = '801';
                    $error_message = 'Required soc master id';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($user_id == null || $user_id == ''){

                    $error_code = '801';
                    $error_message = 'Required user id';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                $data = Soceventparticipationreceive::

                            where([
                                    ['soc_event_participation_receives.status','=' , 1],
                                    ['soc_event_participation_receives.socemid','=' , $socemid],
                                    ['soc_event_participation_receives.user_id','=' , $user_id],
                                ])
                            // ->whereDate('event_date', $event_date)
                            ->select('id','cycle','t_shirt','meal')
                            ->first();

                if (isset($data)){
                // if($data->count() > 0){

                        return Response::json(array(
                            'status'    => 'success',
                            'code'      =>  200,
                            'message_cycle'   =>  "Cycle Already Issued",
                            'message_tshirt'   =>  "T-shirt Already Issued",
                            'message_meal'   =>  "Meal Already Issued",
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

            $controller_name = 'SocweekendeventController';
            $function_name = 'get_remaining_stuff';
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;

            $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);

            if(empty($e)){
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }
        }
    }

    public function get_status_notgiving_user(Request $request){

        try{

            $user = auth('api')->user();

            if($user){

                $socemid = $request->socemid;
                $user_id = $request->user_id;

                if($socemid == null || $socemid == ''){

                    $error_code = '801';
                    $error_message = 'Required soc master id';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($user_id == null || $user_id == ''){

                    $error_code = '801';
                    $error_message = 'Required user id';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                $data = Soceventparticipation::

                            where([
                                    ['soc_event_participations.status','=' , 1],
                                    ['soc_event_participations.socemid','=' , $socemid],
                                    ['soc_event_participations.user_id','=' , $user_id],
                                ])
                            // ->whereDate('event_date', $event_date)
                            ->select('id','cycle','cycle_booking','cycle_waiting','t_shirt','tshart_booking','tshirt_waiting','meal','meal_booking','meal_waiting')
                            ->first();

                    if (isset($data)){
                    // if($data->count() > 0){
                        $cycle_check_value = $request->cycle_check;
                        $tshirt_check_value = $request->t_shirt_check;
                        $meal_check_value = $request->meal_check;

                        $cycle_value = $data['cycle'];
                        $tshirt_value = $data['t_shirt'];
                        $meal_value = $data['meal'];
                        if($cycle_check_value == 1){

                            if($cycle_check_value == 1 && $cycle_value == 1){
                                $meassage_show = "You don't request for a Cycle in booking.";
                            }else{
                                $meassage_show = "User don't request for a Cycle in booking.";
                            }

                        }

                        if($tshirt_check_value == 1){

                            if($tshirt_check_value == 1 && $tshirt_value == 1){
                                $meassage_show = "You don't request for a T-Shirt in booking.";
                            }else{
                                $meassage_show = "User don't request for a T-Shirt in booking.";
                            }

                        }

                        if($meal_check_value == 1){

                            if($meal_check_value == 1 && $meal_value == 1){
                                $meassage_show = "You don't request for a Meal in booking.";
                            }else{
                                $meassage_show = "User don't request for a Meal in booking.";
                            }

                        }

                        // if($cycle_value == 1 && $tshirt_value == 1 && $meal_value == 1){
                        //     $meassage_show = "You don't request for a Cycle, T-Shirt and Meal in booking .";
                        // }

                        return Response::json(array(
                            'status'    => 'success',
                            'code'      =>  200,
                            'meassage_show'  => $meassage_show,
                            'message'   =>  null,
                            'data'      => $data
                        ), 200);

                    }else{

                        $meassage_show = "User don't request anything .";

                        return Response::json(array(
                            'status'    => 'success',
                            'code'      =>  200,
                            'meassage_show'  => $meassage_show,
                            'message'   =>  null,
                            'data'      => $data
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

            $controller_name = 'SocweekendeventController';
            $function_name = 'get_status_notgiving_user';
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;

            $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);

            if(empty($e)){
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }
        }
    }

    public function get_equipment_name(){

         try{

            $user = auth('api')->user();

            if($user){

                $data = Socmasterequipment::where([['status','=',1]])->get();

                    if(count($data) > 0){

                        return Response::json(array(
                                    'isSuccess' => 'true',
                                    'code'      => 200,
                                    'data'      => $data,
                                    'message'   => null
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

            $controller_name = 'SocweekendeventController';
            $function_name = 'post_soc_return_equipment_status';
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

    public function post_soc_return_equipment(Request $request){

         try{

            $user = auth('api')->user();

            if($user){


                    $event_master_id = $request->socemid;
                    $cycle_check = $request->cycle_check;
                    $user_id = $request->user_id;
                    $cycle_admin_user_id = $request->cycle_admin_user_id;

                    if($event_master_id == null || $event_master_id == ''){

                        $error_code = '801';
                        $error_message = 'Required event master id';

                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $error_message
                        ), 200);
                    }

                    if($cycle_check == null || $cycle_check == ''){

                        $error_code = '801';
                        $error_message = 'Required soc cycle check';

                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $error_message
                        ), 200);
                    }


                    if($user_id == null || $user_id == ''){

                        $error_code = '801';
                        $error_message = 'Required user id';

                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $request->user_id
                        ), 200);
                    }

                    if($cycle_admin_user_id == null || $cycle_admin_user_id == ''){

                        $error_code = '801';
                        $error_message = 'Required soc cycle admin user id';

                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $error_message
                        ), 200);
                    }


                    $data = Soceventparticipationreceive::where([
                                                                    ['socemid','=' , $event_master_id],
                                                                    ['user_id','=' , $user_id],
                                                                    ['status','=',1]
                                                                ])
                                                                ->first();



                    // dd($data);

                    if (isset($data)){

                        if($data['cycle'] > $data['cycle_return']){
                            $cycle_return = $data['cycle_return'] + 1;

                            Soceventparticipationreceive::where([
                                                        ['soc_event_participation_receives.id', '=', $data['id']],
                                                    ])
                                                    ->update(
                                                        [
                                                            'soc_event_participation_receives.cycle_return' => $cycle_return,
                                                            'soc_event_participation_receives.cycle_return_admin_user_id' => $cycle_admin_user_id
                                                        ]
                                                    );

                            return Response::json(array(
                                        'isSuccess' => 'true',
                                        'code'      => 200,
                                        'data'      => null,
                                        'message'   => 'Thank you for returning your cycle! We hope you enjoyed your ride'
                                    ), 200);
                        }else{

                            $error_code = '801';
                            $error_message = 'User already return cycle';

                            return Response::json(array(
                                'isSuccess' => 'false',
                                'code'      => $error_code,
                                'data'      => null,
                                'message'   => $error_message
                            ), 200);
                        }

                    }else{

                        return Response::json(array(
                            'status'    => 'error',
                            'code'      =>  200,
                            'message'   =>  'Cycle Not Allotted',
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

            $controller_name = 'SocweekendeventController';
            $function_name = 'post_soc_return_equipment_status';
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

    public function post_soc_return_equipment_status(Request $request){

         try{

            $user = auth('api')->user();

            if($user){


                    $event_master_id = $request->socemid;
                    $cycle_check = $request->cycle_check;
                    $user_id = $request->user_id;

                    if($event_master_id == null || $event_master_id == ''){

                        $error_code = '801';
                        $error_message = 'Required event master id';

                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $error_message
                        ), 200);
                    }

                    if($cycle_check == null || $cycle_check == ''){

                        $error_code = '801';
                        $error_message = 'Required soc cycle check';

                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $error_message
                        ), 200);
                    }


                    if($user_id == null || $user_id == ''){

                        $error_code = '801';
                        $error_message = 'Required user id';

                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $error_message
                        ), 200);
                    }


                    $data = Soceventparticipationreceive::where([
                                                                    ['socemid','=' , $event_master_id],
                                                                    ['user_id','=' , $user_id],
                                                                    ['status','=',1]
                                                                ])
                                                                ->select('id','cycle','cycle_return')
                                                                ->first();

                    if (isset($data)){

                        if($data['cycle_return'] == $data['cycle']) {

                            return Response::json(array(
                                    'isSuccess' => 'true',
                                    'code'      => 200,
                                    'data'      => 1,
                                    'message'   => 'Refreshments can be offered to the users.'
                            ), 200);
                        }

                        if($data['cycle'] > $data['cycle_return']){

                            return Response::json(array(
                                    'isSuccess' => 'true',
                                    'code'      => 200,
                                    'data'      => 0,
                                    'message'   => 'Cycle not returned. Refreshments cannot be provided to the users.'
                            ), 200);
                        }

                        if($data['cycle'] < $data['cycle_return']){

                            return Response::json(array(
                                    'isSuccess' => 'true',
                                    'code'      => 200,
                                    'data'      => 2,
                                    'message'   => 'user already return cycle'
                            ), 200);
                        }

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

            $controller_name = 'SocweekendeventController';
            $function_name = 'post_soc_return_equipment_status';
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

    public function soc_allotment_return_status(Request $request){

         try{

            $user = auth('api')->user();

            if($user){


                    $event_master_id = $request->socemid;

                    if($event_master_id == null || $event_master_id == ''){

                        $error_code = '801';
                        $error_message = 'Required event master id';

                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $error_message
                        ), 200);
                    }

                    $data = Soceventparticipationreceive::where([
                                                                ['socemid','=' , $event_master_id],
                                                                ['status','=',1]
                                                            ])
                                                                ->select(
                                                                    'id',
                                                                    DB::raw('CAST(IFNULL((SUM(cycle)), 0) AS SIGNED) AS giving_cycle'),
                                                                    DB::raw('CAST(IFNULL((SUM(cycle_return)), 0) AS SIGNED) AS return_cycle'),
                                                                )
                                                                ->groupBy('id','cycle','cycle_return')
                                                                ->first();
                    // dd($data);

                    if (isset($data)){

                        return Response::json(array(
                            'status'    => 'success',
                            'statusbar'    => 1,
                            'socbookingterms'    => 1,
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

            $controller_name = 'SocweekendeventController';
            $function_name = 'soc_allotment_return_status';
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



    public function get_slot_time(Request $request){

        try{

            $user = auth('api')->user();

            if($user){
                
                $user_id = $request->user_id;
                $event_id = $request->socemid;

                    $data = Soceventparticipation::

                            where([
                                    ['soc_event_participations.status','=' , 1],
                                    ['soc_event_participations.user_id','=' , $user_id],
                                    ['soc_event_participations.socemid','=' , $event_id],
                                ])
                            ->select('id','cycle_booking','cycle_waiting')
                            ->orderBy('soc_event_participations.id', 'DESC')
                            ->first();
                    
                    if(isset($data)){
                        

                        if(isset($data['cycle_booking'])){
                            
                            $remove_string_cycle_booking =  str_replace("Booking Id:- ", "",$data['cycle_booking']);
                            $data_eventslot = Eventmasterslots::whereRaw('? BETWEEN start_from_serial_no AND end_to_serial_no', [$remove_string_cycle_booking])
                                    ->where('status', 1)
                                    ->where('event_id', $event_id)
                                    ->first();

                            if(isset($data_eventslot)){
                                return Response::json(array(
                                    'isSuccess' => 'true',
                                    'code'      => 200,
                                    'data'      => $data_eventslot,
                                    'message'   => null
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
                                    'code'      =>  200,
                                    'message'   =>  'Data not found',
                                    'data'   => null,
                                ), 401);
                        }

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

            $controller_name = 'SocweekendeventController';
            $function_name = 'get_slot_time';
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
