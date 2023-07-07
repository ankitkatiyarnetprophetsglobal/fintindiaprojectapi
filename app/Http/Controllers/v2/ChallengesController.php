<?php

namespace App\Http\Controllers\v2;

use App\Helpers\Helper as HelpersHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Errorlog;
use Response;
use Helper;
use App\Models\Userdetailsactivitiestrakings;
use App\Models\Userhistorytraking;
use App\Models\Mastergroupmode;
use Exception;
use Illuminate\Support\Facades\Validator;

class ChallengesController extends Controller
{    
    
    public function userdetailsactivities(Request $request){
        try{
            $user_id = is_int($request->user_id);
            $groupid = is_int($request->groupid);
            $ModeGroupid = is_int($request->ModeGroupid);
            $trip_id = is_int($request->trip_id);
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
            
            if($trip_id == null || $trip_id == '' || $trip_id === false){

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
            
            // $function_name = 'userdetailsactivities';   
            // $controller_name = 'ChallengesController';
            $error_code = '901';
            $error_message = $e->getMessage();
            // $send_payload = null;
            // $response = null;            
            // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);
            
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
            
            // $function_name = 'getactivities';   
            // $controller_name = 'ChallengesController';
            $error_code = '901';
            $error_message = $e->getMessage();
            // $send_payload = null;
            // $response = null;            
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

    public function userhistorysactivities(Request $request){

        try{            

            $user_id = is_int($request->user_id);
            // $groupid = is_int($request->groupid);
            $modegroupid = is_int($request->modegroupid);
            $trip_id = is_int($request->trip_id);            
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
            
            if($trip_id == null || $trip_id == '' || $trip_id === false){

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
            $Userdetailsactitrak->status = 1;
            $Userdetailsactitrak->save();
            
            return Response::json(array(
                'isSuccess' => 'true',
                'code'      => 200,
                'data'      => null,
                'message'   => 'Insert Success'
            ), 200);

        } catch (Exception $e) {
            
            // $function_name = 'getactivities';   
            // $controller_name = 'ChallengesController';
            $error_code = '901';
            $error_message = $e->getMessage();
            // $send_payload = null;
            // $response = null;            
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

    public function getuserhistorylist(Request $request){
        try{
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
            

        } catch (Exception $e) {
            
            // $function_name = 'getactivities';   
            // $controller_name = 'getuserhistorylist';
            $error_code = '901';
            $error_message = $e->getMessage();
            // $send_payload = null;
            // $response = null;            
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

    public function userparticularactivities(Request $request){
        
        try{   

            $data = $request->all(); 
            // $json_validater = Helper::json_validator($data);
            $json_validater = $this->json_validator($data);

            if($json_validater === true){

                $user_id = is_int($request->user_id);
                $trip_id = is_int($request->trip_id);	

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
                if($trip_id == null || $trip_id == '' || $trip_id === false){

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
            
            // $function_name = 'userparticularactivities';   
            // $controller_name = 'ChallengesController';
            $error_code = '901';
            $error_message = $e->getMessage();
            // $send_payload = null;
            // $response = null;            
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

    public function groupactivitiestraking(Request $request){
        try{

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
            
            $data = Userdetailsactivitiestrakings::where('status', 1)->get();    
            // dd(count($data));
            $i = 0;
            foreach($data as $key => $value){

             if($key && $data[$key-1]->user_id != $data[$key]->user_id){
               ++$i;
               //dd($i);
             }

                $datavalue[$i]['user_id'] = $value->user_id;
                $datavalue[$i]['location'][] = json_decode($value->location);
                // $datavalue['user_id'] = $value->user_id;
                // $datavalue['location'][$key] = $value->location;
                // $location = 
                // $user_id = ;                
            }
            // dd($datavalue);
            // $datajsonencode = json_encode($datavalue);
            // $datastripslashes = stripslashes($datavalue);
            // $datastripslashes = json_encode($datajsonencode, JSON_UNESCAPED_SLASHES);
            // dd($datajsonencode);
            if(count($data) > 0){        
                $error_code = 200;
                $error_message = null;
                return Response::json(array(
                    'isSuccess' => 'false',
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

        }catch(Exception $e){

            // $function_name = 'userparticularactivities';   
            // $controller_name = 'groupactivitiestraking';
            $error_code = '901';
            $error_message = $e->getMessage();
            // $send_payload = null;
            // $response = null;            
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

    public function testingvalue(Request $request){
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
        // dd($request->deleted_id);
        try{

            $user_id = is_int($request->user_id);
            $trip_id = is_int($request->trip_id);

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
            
            if($trip_id == null || $trip_id == '' || $trip_id === false){
                
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
    
            if(count($datadetailsactivitiestrakings) > 0){  
                      
                foreach($datadetailsactivitiestrakings as $key => $value){

                    $deletactivities = Userdetailsactivitiestrakings::where('user_id', $value['user_id'])->where('trip_id', $value['trip_id'])->update(['status' => 0]);
                }

                // $error_code = 200;
                // $error_message = null;
                // $data = "Successfully Deleted Records";

                // return Response::json(array(
                //     'isSuccess' => 'true',
                //     'code'      => $error_code,
                //     'data'      => $data,
                //     'message'   => $error_message
                // ), 200);

                $deletedhistorytraking = Userhistorytraking::where('user_id', $request->user_id)->where('trip_id', $value['trip_id'])->update(['status' => 0]);                
                // dd($deletedhistorytraking);
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

            // $function_name = 'deletedactivitiestraking';   
            // $controller_name = 'groupactivitiestraking';
            $error_code = '901';
            $error_message = $e->getMessage();
            // $send_payload = null;
            // $response = null;            
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

}
