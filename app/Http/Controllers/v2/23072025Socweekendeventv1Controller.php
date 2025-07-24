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
use Illuminate\Support\Facades\DB;
use Response;




class Socweekendeventv1Controller extends Controller
{
    public function __construct() {

        $this->middleware('auth:api', ['except' => ['save_datewise_soc_v1','save_datewise_receive_soc_v1']]);
        // $this->middleware('auth:api', ['except' => ['get_datelist_soc','get_status_current_user','get_datewise_event_place','save_datewise_soc','get_remaining_stuff','save_datewise_receive_soc','get_status_waiting_soc','get_status_receive_soc_issue','get_status_receive_current_user','get_status_notgiving_user']]);

    }

    public function save_datewise_soc_v1(Request $request){


        try{
            $user = auth('api')->user();

            if($user){

                $socemid = $request->socemid;
                $user_id = $request->user_id;
                $uname = $request->uname;
                $being_on_cycle_check_value = $being_on_cycle_check = $request->being_on_cycle_check;
                $being_on_cycle_value = $being_on_cycle = $request->being_on_cycle;
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

                if($cycle_check == 0 && $t_shirt_check == 0 && $meal_check == 0 && $being_on_cycle_check == 0){

                    $error_code = '801';
                    $error_message = 'Kindly select a cycle before choosing your Refreshments.';

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
                                            'soc_event_participations.being_on_cycle_check',
                                            'soc_event_participations.being_on_cycle',
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

                            if($being_on_cycle_check == 1){

                                $being_on_cycle_check = $user_taken_data['being_on_cycle_check'];
                                $being_on_cycle = $user_taken_data['being_on_cycle'];

                                if(isset($being_on_cycle_check) || isset($being_on_cycle)){

                                    $error_code = '801';
                                    $error_message = "Cycle booked! See you this Sunday.";

                                    return Response::json(array(
                                        'isSuccess' => 'false',
                                        'code'      => $error_code,
                                        'data'      => null,
                                        'message'   => $error_message
                                    ), 200);
                                }

                            }
                            // dd(27);

                            if($being_on_cycle_check_value == 1 && $being_on_cycle_value == 1){
                                // dd(27);
                                Soceventparticipation::where([
                                                            ['soc_event_participations.id', '=', $id],
                                                            ['soc_event_participations.user_id', '=', $user_id],
                                                            ['soc_event_participations.status', '=', 1],
                                                        ])
                                                        ->update(
                                                            [
                                                                'soc_event_participations.cycle_booking' => null,
                                                                'soc_event_participations.cycle' => null
                                                            ]
                                                        );

                                Soceventparticipation::where([
                                                            ['soc_event_participations.id', '=', $id],
                                                            ['soc_event_participations.user_id', '=', $user_id],
                                                            ['soc_event_participations.status', '=', 1],
                                                        ])
                                                        ->update(
                                                            [
                                                                'soc_event_participations.being_on_cycle_check' => 1,
                                                                'soc_event_participations.being_on_cycle' => 1
                                                            ]
                                                        );

                            }

                            // update cycle
                            if($cycle_check == 1){

                                $taken_cycle_booking = $user_taken_data['cycle_booking'];
                                $taken_cycle_waiting = $user_taken_data['cycle_waiting'];


                                if(isset($taken_cycle_booking) || isset($taken_cycle_waiting)){

                                    $error_code = '801';
                                    $error_message = "Your cycle is already booked";

                                    return Response::json(array(
                                        'isSuccess' => 'false',
                                        'code'      => $error_code,
                                        'data'      => null,
                                        'message'   => $error_message
                                    ), 200);
                                }


                                if(!isset($taken_cycle_booking) && !isset($taken_cycle_waiting)){
                                    // dd("Bring your own cycle");
                                    if($total_cycle_available > 0){

                                        if(!isset($being_on_cycle)){

                                            Soceventparticipation::where([
                                                            ['soc_event_participations.id', '=', $id],
                                                            ['soc_event_participations.user_id', '=', $user_id],
                                                            ['soc_event_participations.status', '=', 1],
                                                        ])
                                                        ->update(
                                                            [
                                                                'soc_event_participations.being_on_cycle_check' => null,
                                                                'soc_event_participations.being_on_cycle' => null
                                                            ]
                                                        );
                                        }

                                        // dd("Done");
                                        if(!isset($user_taken_data['cycle'])){

                                            $booking_id_no = ($remaining_cycle + 1);

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


                                if(isset($taken_tshart_booking) || isset($taken_tshirt_waiting)){

                                    $error_code = '801';
                                    $error_message = "Your T-Shirt is already booked";

                                    return Response::json(array(
                                        'isSuccess' => 'false',
                                        'code'      => $error_code,
                                        'data'      => null,
                                        'message'   => $error_message
                                    ), 200);
                                }

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


                                $taken_meal_booking = $user_taken_data['meal_booking'];
                                $taken_meal_waiting = $user_taken_data['meal_waiting'];

                                if(isset($taken_meal_booking) || isset($taken_meal_waiting)){

                                    $error_code = '801';
                                    $error_message = "Your Refreshment is already booked";

                                    return Response::json(array(
                                        'isSuccess' => 'false',
                                        'code'      => $error_code,
                                        'data'      => null,
                                        'message'   => $error_message
                                    ), 200);
                                }

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

                            if($being_on_cycle_check == 1){

                                $datastore->being_on_cycle_check = $being_on_cycle_check;
                                $datastore->being_on_cycle = $being_on_cycle;

                            }

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
                    'message'   => 'You’ve successfully registered for FIT India Sundays on Cycle.'
                ), 200);

            }else{

                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'message'   =>  'Unauthorized'
                ), 401);

            }

        } catch(Exception $e) {

            $controller_name = 'Socweekendeventv1Controller';
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

    public function save_datewise_receive_soc_v1(Request $request){

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


                $socevent_master_cycle = Soceventmaster::
                                        where([
                                            ['soc_event_masters.id', '=', $socemid],
                                        ])
                                        ->select('soc_event_masters.id','soc_event_masters.cycle','soc_event_masters.t_shirt','soc_event_masters.meal')
                                        ->first();

                if($cycle_check == 1){

                    if(isset($socevent_master_cycle['cycle'])){

                        $master_cycle_count = $socevent_master_cycle['cycle'];

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

                    }else{

                        $error_code = '801';
                        $error_message = "There is no event scheduled for this date(Cycle).";

                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $error_message
                        ), 200);

                    }
                }
                if($t_shirt_check == 1){

                    if(isset($socevent_master_cycle['t_shirt'])){

                        $master_tshirt_count = $socevent_master_cycle['t_shirt'];

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
                    }else{

                        $error_code = '801';
                        $error_message = "There is no event scheduled for this date(T Shirt).";

                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $error_message
                        ), 200);

                    }

                }
                if($meal_check == 1){

                    if(isset($socevent_master_cycle['meal'])){

                        $master_meal_count = $socevent_master_cycle['meal'];

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
                    }else{

                        $error_code = '801';
                        $error_message = "There is no event scheduled for this date(Refreshment).";

                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $error_message
                        ), 200);
                    }

                }

                // calculate useing
                $user_booking_conformation = Soceventparticipation::
                                        where([
                                            ['soc_event_participations.socemid', '=', $socemid],
                                            ['soc_event_participations.user_id', '=', $user_id],
                                            ['soc_event_participations.status', '=', 1],
                                        ])
                                        // ->whereDate('soc_event_participations.event_date', $event_date)
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

                    if($booking_cycle_count == 0 && $booking_tshirt_count == 0 && $booking_meal_count == 0){

                        $error_code = '801';
                        $error_message = 'This user has not participated in the event.';

                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $error_message
                        ), 200);

                    }
                    if($cycle_check == 1){

                        if($booking_cycle_count > 0){

                            $cycle = 1;

                            $user_booking_conformation_receive = Soceventparticipationreceive::
                                            where([
                                                ['soc_event_participation_receives.socemid', '=', $socemid],
                                                ['soc_event_participation_receives.user_id', '=', $user_id],
                                                ['soc_event_participation_receives.status', '=', 1],
                                            ])
                                            ->first();

                            if(isset($user_booking_conformation_receive)){

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
                                                'message'   => 'Cycle issued successfully.'
                                            ), 200);


                            }else{

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

                                        $message = "Cycle issued successfully.";
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

                            }


                        }else{

                            $error_code = '801';
                            $error_message = 'Cycle not booked by this user for this event.';

                            return Response::json(array(
                                'isSuccess' => 'false',
                                'code'      => $error_code,
                                'data'      => null,
                                'message'   => $error_message
                            ), 200);

                        }
                    }
                    if($t_shirt_check == 1){

                        if($booking_tshirt_count > 0){

                            $cycle = 1;

                            $user_booking_conformation_receive = Soceventparticipationreceive::
                                            where([
                                                ['soc_event_participation_receives.socemid', '=', $socemid],
                                                ['soc_event_participation_receives.user_id', '=', $user_id],
                                                ['soc_event_participation_receives.status', '=', 1],
                                            ])
                                            ->first();

                            if(isset($user_booking_conformation_receive)){

                                    $t_shirt = 1;

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
                                                'message'   => 'T-shirt issued successfully.'
                                            ), 200);


                            }else{

                                    $datareceivestore = new Soceventparticipationreceive();
                                    $datareceivestore->socemid = $socemid;
                                    $datareceivestore->user_id = $user_id;
                                    $datareceivestore->uname = $uname;

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

                            }


                        }else{

                            $error_code = '801';
                            $error_message = 'T shirt not booked by this user for this event.';

                            return Response::json(array(
                                'isSuccess' => 'false',
                                'code'      => $error_code,
                                'data'      => null,
                                'message'   => $error_message
                            ), 200);

                        }
                    }
                    if($meal_check == 1){

                        if($booking_meal_count > 0){

                            $cycle = 1;

                            $user_booking_conformation_receive = Soceventparticipationreceive::
                                            where([
                                                ['soc_event_participation_receives.socemid', '=', $socemid],
                                                ['soc_event_participation_receives.user_id', '=', $user_id],
                                                ['soc_event_participation_receives.status', '=', 1],
                                            ])
                                            ->first();

                            if(isset($user_booking_conformation_receive)){

                                    $meal = 1;

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
                                                'message'   => 'Refreshment issued successfully.'
                                            ), 200);


                            }else{

                                    $datareceivestore = new Soceventparticipationreceive();
                                    $datareceivestore->socemid = $socemid;
                                    $datareceivestore->user_id = $user_id;
                                    $datareceivestore->uname = $uname;

                                    if($meal_check == 1){

                                        if($booking_meal_count == 1){
                                            $datareceivestore->meal = $booking_meal_count;
                                            $datareceivestore->meal_admin_user_id = $meal_admin_user_id;
                                        }
                                        if($booking_meal_count == 0){
                                            $datareceivestore->meal = $meal;
                                            $datareceivestore->meal_admin_user_id = $meal_admin_user_id;
                                        }

                                        $message = "Refreshment issued successfully.";
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

                            }


                        }else{

                            $error_code = '801';
                            $error_message = 'Refreshment not booked by this user for this event.';

                            return Response::json(array(
                                'isSuccess' => 'false',
                                'code'      => $error_code,
                                'data'      => null,
                                'message'   => $error_message
                            ), 200);

                        }
                    }

                }else{

                    $error_code = '801';
                    $error_message = 'This user has not participated in the event.';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);

                    // $booking_cycle_count = 0;
                    // $booking_tshirt_count = 0;
                    // $booking_meal_count = 0;
                }

                // $user_booking_conformation = Soceventparticipationreceive::
                //                             where([
                //                                 ['soc_event_participation_receives.socemid', '=', $socemid],
                //                                 ['soc_event_participation_receives.user_id', '=', $user_id],
                //                                 ['soc_event_participation_receives.status', '=', 1],
                //                             ])
                //                             // ->whereDate('soc_event_participation_receives.event_date', $event_date)
                //                             // ->select(
                //                             //         DB::raw('CAST(IFNULL(SUM(soc_event_participation_receives.cycle), 0) AS SIGNED) AS cycle_conformation'),
                //                             //         DB::raw('CAST(IFNULL(SUM(soc_event_participation_receives.t_shirt), 0) AS SIGNED) AS tshirt_conformation'),
                //                             //         DB::raw('CAST(IFNULL(SUM(soc_event_participation_receives.meal), 0) AS SIGNED) AS meal_conformation'),
                //                             //         // DB::raw('CAST(IFNULL(soc_event_participation_receives.cycle, 0) as int) as cycle_conformation'),
                //                             //         // DB::raw('CAST(IFNULL(soc_event_participation_receives.cycle, 0) as int) as cycle_conformation'),
                //                             //         // DB::raw('CAST(IFNULL(soc_event_participation_receives.t_shirt, 0) as int) as tshirt_conformation'),
                //                             //     )
                //                             // ->get();
                //                             ->first();



                // if(isset($user_booking_conformation)){

                //     if($cycle_check == 1){

                //         if(isset($user_booking_conformation)){


                //             // $cycle = $user_booking_conformation['cycle'] + 1;
                //             $cycle = 1;


                //             Soceventparticipationreceive::where([
                //                                                 ['soc_event_participation_receives.socemid', '=', $socemid],
                //                                                 ['soc_event_participation_receives.user_id', '=', $user_id],
                //                                                 ['soc_event_participation_receives.status', '=', 1],
                //                                             ])
                //                                             ->update(
                //                                                 ['soc_event_participation_receives.cycle' => $cycle,
                //                                                 'soc_event_participation_receives.cycle_admin_user_id' => $cycle_admin_user_id]
                //                                             );

                //             return Response::json(array(
                //                                 'isSuccess' => 'true',
                //                                 'code'      => 200,
                //                                 'data'      => null,
                //                                 'message'   => 'Cycle Issued'
                //                             ), 200);
                //         }

                //     }

                //     if($t_shirt_check == 1){

                //         if(isset($user_booking_conformation)){

                //             // $t_shirt = $user_booking_conformation['t_shirt'] + 1;
                //             $t_shirt = 1;

                //             Soceventparticipationreceive::where([
                //                                                 ['soc_event_participation_receives.socemid', '=', $socemid],
                //                                                 ['soc_event_participation_receives.user_id', '=', $user_id],
                //                                                 ['soc_event_participation_receives.status', '=', 1],
                //                                             ])
                //                                             ->update(
                //                                                 [
                //                                                     'soc_event_participation_receives.t_shirt' => $t_shirt,
                //                                                     'soc_event_participation_receives.tshart_admin_user_id' => $tshart_admin_user_id
                //                                                 ]
                //                                             );

                //             return Response::json(array(
                //                                 'isSuccess' => 'true',
                //                                 'code'      => 200,
                //                                 'data'      => null,
                //                                 'message'   => 'T shirt Issued'
                //                             ), 200);
                //         }
                //     }

                //     if($meal_check == 1){

                //         if(isset($user_booking_conformation)){

                //             // $meal = $user_booking_conformation['meal'] + 1;
                //             $meal = 1;

                //             Soceventparticipationreceive::where([
                //                                                 ['soc_event_participation_receives.socemid', '=', $socemid],
                //                                                 ['soc_event_participation_receives.user_id', '=', $user_id],
                //                                                 ['soc_event_participation_receives.status', '=', 1],
                //                                             ])
                //                                             ->update(
                //                                                 [
                //                                                     'soc_event_participation_receives.meal' => $meal,
                //                                                     'soc_event_participation_receives.meal_admin_user_id' => $meal_admin_user_id
                //                                                 ]
                //                                             );

                //             return Response::json(array(
                //                                 'isSuccess' => 'true',
                //                                 'code'      => 200,
                //                                 'data'      => null,
                //                                 'message'   => 'Meal Issued'
                //                             ), 200);
                //         }

                //     }
                // }

                // $datareceivestore = new Soceventparticipationreceive();
                // $datareceivestore->socemid = $socemid;
                // $datareceivestore->user_id = $user_id;
                // $datareceivestore->uname = $uname;

                // if($cycle_check == 1){

                //     if($booking_cycle_count == 1){
                //         $datareceivestore->cycle = $booking_cycle_count;
                //         $datareceivestore->cycle_admin_user_id = $cycle_admin_user_id;
                //     }
                //     if($booking_cycle_count == 0){
                //         $datareceivestore->cycle = $cycle;
                //         $datareceivestore->cycle_admin_user_id = $cycle_admin_user_id;
                //     }

                //     $message = "Cycle Issued";
                // }

                // if($t_shirt_check == 1){

                //     if($booking_tshirt_count == 1){
                //         $datareceivestore->t_shirt = $booking_tshirt_count;
                //         $datareceivestore->tshart_admin_user_id = $tshart_admin_user_id;
                //     }
                //     if($booking_tshirt_count == 0){
                //         $datareceivestore->t_shirt = $t_shirt;
                //         $datareceivestore->tshart_admin_user_id = $tshart_admin_user_id;
                //     }

                //     $message = "T shirt Issued";
                // }

                // if($meal_check == 1){

                //     if($booking_meal_count == 1){
                //         $datareceivestore->meal = $booking_meal_count;
                //         $datareceivestore->meal_admin_user_id = $meal_admin_user_id;
                //     }
                //     if($booking_meal_count == 0){
                //         $datareceivestore->meal = $meal;
                //         $datareceivestore->meal_admin_user_id = $meal_admin_user_id;
                //     }

                //     $message = "Meal Issued";
                // }

                // $datareceivestore->latitude = $latitude;
                // $datareceivestore->longitude = $longitude;
                // $datareceivestore->event_date = $event_date;
                // $datareceivestore->status = 1;
                // $datareceivestore->save();

                // return Response::json(array(
                //     'isSuccess' => 'true',
                //     // 'message_show' =>  'You get tshirt',
                //     // 'successm' => $success_message,
                //     'code'      => 200,
                //     'data'      => null,
                //     'message'   => $message
                // ), 200);

            }else{

                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'message'   =>  'Unauthorized'
                ), 401);

            }

        } catch(Exception $e) {

            $controller_name = 'Socweekendeventv1Controller';
            $function_name = 'save_datewise_receive_soc_v1';
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

}
