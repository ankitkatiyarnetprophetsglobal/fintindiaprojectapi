<?php

namespace App\Http\Controllers\v2;

use App\Helpers\Helper as HelpersHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\v2\CommonController;
use App\Models\Errorlog;
use App\Models\Trackingpic;
use Response;
use Helper;
use App\Models\Userdetailsactivitiestrakings;
use App\Models\Userhistorytraking;
use App\Models\Mastergroupmode;
use App\Models\EventCat;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use PDF;

class Challengesv2Controller extends Controller
{
    public function __construct() {

        $this->middleware('auth:api', ['except' => ['userHistorysActivitiesv2','geteventlistv2','getuserdetailsdatewisev2']]);

    }
    public function userHistorysActivitiesv2(Request $request){

        try{

            // dd($request->all());
            $user_id = is_int($request->user_id);
            // $groupid = is_int($request->groupid);
            $modegroupid = is_int($request->modegroupid);
            $trip_id = $request->trip_id;
            $events = $request->events;
            $trip_name = $request->trip_name;
            $commemt = $request->commemt;
            $average_speed = is_int($request->average_speed);
            $max_speed = $request->max_speed;
            $steps = $request->steps;
            $duration = $request->duration;
            $distance = $request->distance;
            $uom = $request->uom;
            $carbonSave = $request->carbonSave;
            $date = strtotime($request->datetime);
            $date_value = date('Y-m-d h:i:s ',$date);


            $validator = Validator::make($request->all(), [

                'location.*.lat' => 'Required',

            ],[

                'location.*.lat.Required' => 'Location not found'

            ]);

            if ($validator->fails()) {

                $error_code = '801';
                $error_message = $validator->messages()->first();

				return Response::json(array(

                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message,

				), 200);
			}

            if($user_id == null || $user_id == '' || $user_id === false){

                $error_code = '801';
                $error_message = 'Required User id';

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }

            if($modegroupid == null || $modegroupid == '' || $modegroupid === false){

                $error_code = '801';
                $error_message = 'Required  Mode Group id';

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }

            if($trip_id == null || $trip_id == ''){

                $error_code = '801';
                $error_message = 'Required Trip Id';

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }

            if($average_speed == null || $average_speed == '' || $average_speed === false){

                $error_code = '801';
                $error_message = 'Required Average Speed';

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }

            if($trip_name == null || $trip_name == '' || $trip_name === false){

                $error_code = '801';
                $error_message = 'Required Trip Name';

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }

            if($max_speed == null || $max_speed == '' || $max_speed === false){

                $error_code = '801';
                $error_message = 'Required Trip Ave Pace';

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }

            if($steps == null || $steps == '' || $steps === false){

                $error_code = '801';
                $error_message = 'Required Trip Speed';

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }

            if($duration == null || $duration == '' || $duration === false){

                $error_code = '801';
                $error_message = 'Required Duration';

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }

            if($distance == null || $distance == ''){

                $error_code = '801';
                $error_message = 'Required Distance';

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }

            if($uom == null || $uom == ''){

                $error_code = '801';
                $error_message = 'Required Units Of Measurement';

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }

            if($date_value == null || $date_value == ''){

                $error_code = '801';
                $error_message = 'Required Date';

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => 'Required Date'
                ), 200);
            }

            if(empty($request->location)){

                $error_code = '801';
                $error_message = 'Location is Json Empty';

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => 'Location is Json Empty'
                ), 200);
            }

            if($events == null || $events == '' || $events === false){

                $events  = 0;
            }

            $Userdetailsactitrak = new Userhistorytraking();
            $Userdetailsactitrak->user_id = $request->user_id;
            $Userdetailsactitrak->groupid = $request->groupid;
            $Userdetailsactitrak->modegroupid = $request->modegroupid;
            $Userdetailsactitrak->trip_id = $request->trip_id;
            $Userdetailsactitrak->trip_name = $request->trip_name;
            $Userdetailsactitrak->commemt = $request->commemt;
            $Userdetailsactitrak->average_speed = $request->average_speed;
            $Userdetailsactitrak->max_speed = $request->max_speed;
            $Userdetailsactitrak->steps = $request->steps;
            $Userdetailsactitrak->duration = $request->duration;
            $Userdetailsactitrak->distance = $request->distance;
            $Userdetailsactitrak->uom = $request->uom;
            $Userdetailsactitrak->carbonSave = $carbonSave;
            $Userdetailsactitrak->datetime = $date_value;
            $Userdetailsactitrak->location = json_encode($request->location);
            $Userdetailsactitrak->events = $events;
            $Userdetailsactitrak->status = 1;
            $Userdetailsactitrak->save();

            return Response::json(array(
                'isSuccess' => 'true',
                'code'      => 200,
                'data'      => null,
                'message'   => 'Insert Success'
            ), 200);

        } catch (Exception $e) {

            $controller_name = 'Challengesv2Controller';
            $function_name = 'userhistorysactivitiesv2';
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;
            // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);3
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
    public function geteventlistv2(Request $request){
        try{
            $user = auth('api')->user();
            if($user){

                // dd(123456789);
                // $data = EventCat::select('id','name','status')->where('status', '=', 1)->get();
                $data = EventCat::select('id','name','status')->where('status', '=', 1)->where('id', '=', 13081)->get();
                // dd($data);
                $error_code = 200;

                if(count($data) >0){

                    $error_message = null;

                    return Response::json(array(
                        'isSuccess' => 'true',
                        'code'      => $error_code,
                        'data'      => $data,
                        'message'   => $error_message
                    ), 200);

                }else{

                    $error_message = "Data Not Found";

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => "",
                        'message'   => $error_message
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

            $controller_name = 'Challengesv2Controller';
            $function_name = 'geteventlistv2';
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;
            // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);3
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
    public function getuserdetailsdatewisev2(Request $request){
        try{

            $user = auth('api')->user();

            if($user){

                $user_id = is_int($request->user_id);
                $todate = $request->todate;
                $fromdate = $request->fromdate;
                $error_code = 200;
                $error_message = "Data Not Found";
                $success_message = null;

                if($user_id == null || $user_id == '' || $user_id === false){

                    $error_code = '801';
                    $error_message = 'Required User id';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);

                }

                if($todate == null || $todate == ''){

                    $error_code = '801';
                    $error_message = 'Required To Date';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);

                }

                if($fromdate == null || $fromdate == ''){

                    $error_code = '801';
                    $error_message = 'Required From Date';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);

                }

                $datauserhistorytraking = Userhistorytraking::
                                                            select(
                                                                'user_id',
                                                                'groupid',
                                                                'modegroupid',
                                                                'trip_id',
                                                                'average_speed',
                                                                'uom',
                                                                'duration',
                                                                'distance',
                                                                'max_speed',
                                                                // DB::raw('DATE(created_by) as date'),
                                                                )
                                                            ->selectRaw(
                                                                'DATE(created_by) as date'
                                                                )
                                                                ->where([
                                                                        ['status','=' , 1],
                                                                        ['user_id', '=', $request->user_id]
                                                                        ])
                                                            // ->whereBetween(DB::raw('DATE(created_by)'), [$todate, $fromdate])
                                                            ->whereDate('created_by', '>=', $todate)
                                                            ->whereDate('created_by', '<=', $fromdate)
                                                            ->get();

                if(count($datauserhistorytraking) > 0){

                    return Response::json(array(
                                    'isSuccess' => 'true',
                                    'code'      => $error_code,
                                    'data'      => $datauserhistorytraking,
                                    'message'   => $success_message
                                ), 200);

                }else{

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
                    'code'      =>  801,
                    'message'   =>  'Unauthorized'
                ), 401);

            }

        } catch(Exception $e) {

            $controller_name = 'Challengesv2Controller';
            $function_name = 'getuserdetailsdatewisev2';
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
