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
use PDF;

class Challengesv1Controller extends Controller
{    
    public function __construct() {

        $this->middleware('auth:api', ['except' => ['git_event_list_v1','get_User_History_List_v1','gitEventCertificate','git_event_copy_list_v1']]);

    }
    
    public function userdetailsactivities(Request $request){

        try{

            $user_id = is_int($request->user_id);
            $groupid = is_int($request->groupid);
            $ModeGroupid = is_int($request->ModeGroupid);
            $trip_id = $request->trip_id;
            $trip_status = is_int($request->trip_status);
            $ave_pace = $request->ave_pace;
            $speed = $request->speed;
            $steps = $request->steps;
            $distance = $request->distance;
            $uom = $request->uom;
            $date = strtotime($request->Datetime);            
            $date_value = date('Y-m-d h:i:s ',$date);         
            $validator = Validator::make($request->all(), [                 
                'Location.*.lat' => 'Required',
            ],[                
                'Location.*.lat.Required' => 'Location not found' 
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
            
            // if($groupid == null || $groupid == '' || $groupid === false){
                
            //     $error_code = '801';
            //     $error_message = 'Required Group Id';
                
            //     return Response::json(array(
            //         'isSuccess' => 'false',
            //         'code'      => $error_code,
            //         'data'      => null,
            //         'message'   => $error_message
            //     ), 200);    
            // }
            
            if($ModeGroupid == null || $ModeGroupid == '' || $ModeGroupid === false){
                
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
            
            if($trip_status == null || $trip_status == '' || $trip_status === false){
                
                $error_code = '801';
                $error_message = 'Required Trip Trip Status';                
                
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);    
            }
            
            if($ave_pace == null || $ave_pace == ''){
                
                $error_code = '801';
                $error_message = 'Required Trip Ave Pace';              

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);    
            }
            
            if($speed == null || $speed == ''){
                
                $error_code = '801';
                $error_message = 'Required Trip Speed';

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);    
            }
            
            if($steps == null || $steps == ''){
                
                $error_code = '801';
                $error_message = 'Required Trip steps';                
                
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
            
            if(empty($request->Location)){
                
                $error_code = '801';
                $error_message = 'Location is Json Empty';                
                
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => 'Location is Json Empty'
                ), 200);
            }           
        
            $Userdetailsactitrak = new Userdetailsactivitiestrakings();
            $Userdetailsactitrak->user_id = $request->user_id;
            $Userdetailsactitrak->groupid = $request->groupid;
            $Userdetailsactitrak->modegroupid = $request->ModeGroupid;
            $Userdetailsactitrak->trip_id = $request->trip_id;
            $Userdetailsactitrak->trip_status = $request->trip_status;
            $Userdetailsactitrak->ave_pace = $request->ave_pace;
            $Userdetailsactitrak->speed = $request->speed;
            $Userdetailsactitrak->steps = $request->steps;
            $Userdetailsactitrak->distance = $request->distance;
            $Userdetailsactitrak->uom = $request->uom;
            $Userdetailsactitrak->datetime = $request->date_value;
            $Userdetailsactitrak->location = json_encode($request->Location);
            $Userdetailsactitrak->status = 1;
            $Userdetailsactitrak->save();
            
            return Response::json(array(
                'isSuccess' => 'true',
                'code'      => 200,
                'data'      => null,
                'message'   => 'Insert Success'
            ), 200);
            
        } catch (Exception $e) {
            
            $controller_name = 'ChallengesController';
            $function_name = 'userdetailsactivities';   
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;            
            // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);
            $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);
            
            return Response::json(array(
                'isSuccess' => 'false',
                'code'      => $error_code,
                'data'      => null,
                'message'   => $error_message
            ), 200);
        }   
        
    }
    
    public function getactivities(Request $request){
        
        try{

            $data = Mastergroupmode::where('status', 1)->get();
            // dd($data);
            // dd(count($data));
            // if(count($data))
            if(count($data) > 0){

                $datajson = json_encode($data);            
                $error_code = 200;
                $error_message = null;
                
                return Response::json(array(
                    'isSuccess' => 'true',
                    'code'      => $error_code,
                    'data'      => $data,
                    'message'   => $error_message
                ), 200);
            }else{

                $error_code = 200;
                $error_message = 'Data not found';
                
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }
            
            
        } catch (Exception $e) {
            
            $controller_name = 'ChallengesController';
            $function_name = 'getactivities';   
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;            
            // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);
            
            
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

    public function userHistorysActivitiesv1(Request $request){

        try{            
            // dd('userhistorysactivitiesv1');
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
            
            // if($groupid == null || $groupid == '' || $groupid === false){
                
            //     $error_code = '801';
            //     $error_message = 'Required Group Id';
                
            //     return Response::json(array(
            //         'isSuccess' => 'false',
            //         'code'      => $error_code,
            //         'data'      => null,
            //         'message'   => $error_message
            //     ), 200);    
            // }
            
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
            
            $controller_name = 'Challengesv1Controller';
            $function_name = 'userhistorysactivitiesv1';   
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

    public function get_User_History_List_v1(Request $request){
        try{
                $user = auth('api')->user();
                if($user){
                    // dd(123456);
                    $user_id = is_int($request->user_id);
                        
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

                        $data = Userhistorytraking::with(['getMasterGroupDetails'])->where('status', 1)->where('user_id', '=', $request->user_id)->get();    
                        
                        if(count($data) > 0){        
                            $error_code = 200;
                            $error_message = null;
                            return Response::json(array(
                                'isSuccess' => 'true',
                                'code'      => $error_code,
                                'data'      => $data,
                                'message'   => $error_message
                            ), 200);
                        }else{
                            
                            $error_code = '801';
                            $error_message = "Data not found";                                
                            
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

        } catch (Exception $e) {
            
            $controller_name = 'Challengesv1Controller';
            $function_name = 'getuserhistorylist';   
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;            
            // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);
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

    public function userparticularactivities(Request $request){
        
        try{   

            $data = $request->all(); 
            // $json_validater = Helper::json_validator($data);
            $json_validater = $this->json_validator($data);

            if($json_validater === true){

                $user_id = is_int($request->user_id);
                $trip_id = $request->trip_id;	

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
            
                $data = Userhistorytraking::with(['getMasterGroupDetails'])->where('status', 1)
                                            ->where('user_id', '=', $request->user_id)
                                            ->where('trip_id', '=', $request->trip_id)
                                            ->get();
                // dd(count($data));
                if(count($data) > 0){

                    $error_code = 200;
                    $error_message = null;

                    return Response::json(array(
                        'isSuccess' => 'true',
                        'code'      => $error_code,
                        'data'      => $data,
                        'message'   => $error_message
                    ), 200);    

                }else{

                    $error_code = '801';
                    $error_message = "Data not found";                                
                    
                    return Response::json(array(
                        'isSuccess' => 'true',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }
                
            }else{
                
                $error_code = '801';
                $error_message = "Json Not Valid";                                
                
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
                

            }

        } catch (Exception $e) {
            
            $controller_name = 'ChallengesController';
            $function_name = 'userparticularactivities';   
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;            
            // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);
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

    public function groupactivitiestraking(Request $request){
        try{

            // dd($request->all());

            // $user_id = is_int($request->user_id);
            
            // if($user_id == null || $user_id == '' || $user_id === false){
                
            //     $error_code = '801';
            //     $error_message = 'Required User id';                
                
            //     return Response::json(array(
            //         'isSuccess' => 'false',
            //         'code'      => $error_code,
            //         'data'      => null,
            //         'message'   => $error_message
            //     ), 200);    
            // }

            $group_id = $request->group_id;
            $user_ids = $request->user_id;
            $datavalue = array();
            // $user_ids_array = explode(",",$user_ids);
            // dd($user_ids);
            // echo ($user_ids_array);    
            // dd(1);    
            foreach($user_ids as $key => $value){
                // echo $value;
                // echo '<br/>';
                $data[] = Userdetailsactivitiestrakings::where('status', 1)->where('groupid', $group_id)->where('user_id', $value)->get();
            }
            // dd($data);
            $i = 0;
            foreach($data as $key => $value){

                foreach($value as $key1 => $value1){
                    // dd($value[0]['user_id']);
                    // if($key1 && $value[$i]['user_id'] != $value[$i]['user_id']){
                    
                    //     ++$i;
                    //    //dd($i);
                    // }
                    $datavalue[$key1]['user_id'] = $value1['user_id'];
                    $datavalue[$key1]['location'][] = json_decode($value1['location']);
                    
                }
               
            }

            if(count($data) > 0){        

                $error_code = 200;
                $error_message = null;

                return Response::json(array(
                    'isSuccess' => 'true',
                    'code'      => $error_code,
                    'data'      => $datavalue,
                    'message'   => $error_message
                ), 200);

            }else{
                
                $error_code = '801';
                $error_message = "Data not found";                                
                
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);                    

            }
            // dd(count($data));
            // $data = Userdetailsactivitiestrakings::where('status', 1)->get();                
            // dd(count($data));
            
            // $i = 0;
            // foreach($data as $key => $value){

            //  if($key && $data[$key-1]->user_id != $data[$key]->user_id){
            //    ++$i;
            //    //dd($i);
            //  }

            //     $datavalue[$i]['user_id'] = $value->user_id;
            //     $datavalue[$i]['location'][] = json_decode($value->location);
            //     // $datavalue['user_id'] = $value->user_id;
            //     // $datavalue['location'][$key] = $value->location;
            //     // $location = 
            //     // $user_id = ;                
            // }
            
                // if(count($data) > 0){        
                //     $error_code = 200;
                //     $error_message = null;
                //     return Response::json(array(
                //         'isSuccess' => 'false',
                //         'code'      => $error_code,
                //         'data'      => $datavalue,
                //         'message'   => $error_message
                //     ), 200);
                // }else{
                    
                //     $error_code = '801';
                //     $error_message = "Data not found";                                
                    
                //     return Response::json(array(
                //         'isSuccess' => 'false',
                //         'code'      => $error_code,
                //         'data'      => null,
                //         'message'   => $error_message
                //     ), 200);
                    

                // }

        }catch(Exception $e){
            
            $controller_name = 'ChallengesController';
            $function_name = 'groupactivitiestraking';   
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;            
            // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);
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

    public function testingvalue(Request $request){

        
        $controller_name = 'ChallengesController';
        $function_name = 'userdetailsactivities';   
        $error_code = '901';
        // $error_message = $e->getMessage();
        $error_message = "error1";
        $send_payload = "";
        $response = "";            
        // saverrorlogsthree($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);
        $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);
        $time = 1687517819;
        $date = strtotime($time);            
        // $date_value = date('Y-m-d h:i:s ',$date); 
        echo date('m/d/y h:i:s', $time);
        dd(date('m/d/y h:i:s', $time));

    }

    public static function json_validator($data) {

        try{            
            if (!empty($data)) {
                
                return is_array($data) ? true : false;
            }else{
                
                return false;
            }
        
        }catch(Exception $e){

            $e->getMessage();
        }    
    }

    public function deletedactivitiestraking(Request $request){
        
        try{

            $user_id = is_int($request->user_id);
            $trip_id = $request->trip_id;

            if($user_id == null || $user_id == '' || $user_id === false){
                
                $error_code = '801';
                $error_message = 'Required Deleted Id';                
                
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
            
            $datadetailsactivitiestrakings = Userdetailsactivitiestrakings::where('status', 1)->where('user_id',$request->user_id)->where('trip_id',$request->trip_id)->get();   
            
            $userhistorytraking_count = Userhistorytraking::where('status', 1)->where('user_id',$request->user_id)->where('trip_id',$request->trip_id)->get();   

            if(count($datadetailsactivitiestrakings) > 0){
                
                foreach($datadetailsactivitiestrakings as $key => $value){

                    $deletactivities = Userdetailsactivitiestrakings::where('user_id', $value['user_id'])->where('trip_id', $value['trip_id'])->update(['status' => 0]);
                }
            
                $deletedhistorytraking = Userhistorytraking::where('user_id', $request->user_id)->where('trip_id', $value['trip_id'])->update(['status' => 0]);                
                
                if($deletedhistorytraking > 0){        
                    $error_code = 200;
                    $error_message = null;
                    $data = "Successfully Deleted Records";

                    return Response::json(array(
                        'isSuccess' => 'true',
                        'code'      => $error_code,
                        'data'      => $data,
                        'message'   => $error_message
                    ), 200);

                }else{

                    $error_code = 200;
                    $error_message = "Somthing Went Wrong";
                    $data = null;

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => $data,
                        'message'   => $error_message
                    ), 200);
                }
            }elseif(count($userhistorytraking_count) > 0){

                $deletedhistorytraking = Userhistorytraking::where('user_id', $request->user_id)->where('trip_id', $request->trip_id)->update(['status' => 0]);                
                
                if($deletedhistorytraking > 0){        
                    $error_code = 200;
                    $error_message = null;
                    $data = "Successfully Deleted Records";

                    return Response::json(array(
                        'isSuccess' => 'true',
                        'code'      => $error_code,
                        'data'      => $data,
                        'message'   => $error_message
                    ), 200);

                }else{

                    $error_code = 200;
                    $error_message = "Somthing Went Wrong";
                    $data = null;

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => $data,
                        'message'   => $error_message
                    ), 200);
                }
            }else{

                $error_code = 901;
                $error_message = "No Record found";
                $data = null;

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => $data,
                    'message'   => $error_message
                ), 200);

            }
        }catch(Exception $e){

            $controller_name = 'ChallengesController';
            $function_name = 'deletedactivitiestraking';   
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;            
            // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);
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
    
    public function git_event_list_v1(Request $request){
        try{ 
            $user = auth('api')->user();
            if($user){

                // dd(123456789);
                $data = EventCat::select('id','name','status')->where('status', '=', 1)->get();    
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
        
            $controller_name = 'Challengesv1Controller';
            $function_name = 'git_event_list_v1';   
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
    public function mobiledownloadFreedomCertificate($user_id,$trip_id){       
            
        $data = Trackingpic::with(['eventDetails'=>function($q){
            $q= $q->whereStatus(true);
        },'userDetails:id,name'])
        ->where('status', 1)->where([['user_id', '=', $user_id],['trip_id','=',$trip_id]])->latest('id')->first();            
        $image = $data->image;
        $participant = $data->userDetails->name;
        $eventDetails = $data->eventDetails->name;
        
        // return view('freedomrun.freedom-participant-certificate',['organiser_name' => $eventDetails, 'participant_name'=> $participant,'map_image'=> $image]);
        
        $pdf = PDF::loadView('freedomrun.freedom-participant-certificate',
        [
            'organiser_name' => $eventDetails, 
            'participant_name'=> $participant,
            'map_image'=> $image
        ])
            ->setPaper('a4', 'landscape');
        
        $pdf->getDomPDF()->setHttpContext(
        
            stream_context_create(['ssl'=>['allow_self_signed'=> TRUE, 'verify_peer' => FALSE, 'verify_peer_name' => FALSE, ]])
        
        );            
        
        return $pdf->download($participant.".pdf");        
    }

    public function git_event_copy_list_v1(Request $request){
        try{ 
            $user = auth('api')->user();
            if($user){

                // dd(123456789);
                $data = EventCat::select('id','name','status')->where('status', '=', 1)->get();    
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
        
            $controller_name = 'Challengesv1Controller';
            $function_name = 'git_event_copy_list_v1';   
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

}
