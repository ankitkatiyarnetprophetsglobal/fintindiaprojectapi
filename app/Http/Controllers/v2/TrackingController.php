<?php

namespace App\Http\Controllers\v2;

use App\Helpers\Helper as HelpersHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Errorlog;
use Response;
use Helper;
use App\Models\Usertracking;
use Exception;
use Illuminate\Support\Facades\Validator;

class TrackingController extends Controller
{    
    
    public function logintracking(Request $request){
        try{
            
            // dd($request->all());
            // dd($request['user_id']);
            $user_id = $request['user_id'];
            $company_name = $request['company_name'];
            $device_name = $request['device_name'];
            $device_version = $request['device_version'];
            $os_name = $request['os_name'];
            $os_version = $request['os_version'];
            $api_name = $request['api_name'];
            $api_version = $request['api_version'];
            $login_datetime = $request['login_datetime'];
            $status = $request['status'];
            
            $Userdetailsactitrak = new Usertracking();
            $Userdetailsactitrak->user_id = $user_id;
            $Userdetailsactitrak->company_name = $company_name;
            $Userdetailsactitrak->device_name = $device_name;
            $Userdetailsactitrak->device_version = $device_version;
            $Userdetailsactitrak->os_name = $os_name;
            $Userdetailsactitrak->os_version = $os_version;
            $Userdetailsactitrak->api_name = $api_name;
            $Userdetailsactitrak->api_version = $api_version;
            $Userdetailsactitrak->login_datetime = $login_datetime;            
            $Userdetailsactitrak->status = 1;
            $Userdetailsactitrak->save();

            return Response::json(array(
                'isSuccess' => 'true',
                'code'      => 200,
                'data'      => null,
                'message'   => 'Insert Success'
            ), 200);
            
        } catch (Exception $e) {
            
            // $function_name = 'logintracking';   
            // $controller_name = 'TrackingController';
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
}
