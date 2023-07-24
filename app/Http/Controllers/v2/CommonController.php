<?php

namespace App\Http\Controllers\v2;

use App\Helpers\Helper as HelpersHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Errorlog;
use Response;
use Exception;
use Illuminate\Support\Facades\Validator;

class CommonController extends Controller
{    
    
    public function error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response){

        try{

            // dd($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);
            $Errorlog = new Errorlog();
            $Errorlog->function_name = $function_name;
            $Errorlog->controller_name = $controller_name;
            $Errorlog->error_code = $error_code;
            $Errorlog->error_message = $error_message;
            $Errorlog->send_payload = $send_payload;
            $Errorlog->response = $response;            
            $Errorlog->status = 1;            
            $Errorlog->save();
            
        } catch (Exception $e) {
            
            // $controller_name = 'ChallengesController';
            // $function_name = 'userdetailsactivities';   
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
