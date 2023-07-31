<?php

namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use App\Models\Errorlog;
use Exception;

class Helperstwo {

    // public static function helperfunction1(){
    //     return "helper function 1 response";
    // }

    // public static function saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response){
    //     try{

    //         // DB::insert('insert into errorlogs (function_name, controller_name, error_code, error_message, send_payload, response) values (?, ?, ?, ?, ?, ?)', [ $function_name, $controller_name, $error_code, $error_message, $send_payload, $response]);
    //         // dd(321);
    //         $Errorlog = new Errorlog();
    //         $Errorlog->function_name = $function_name;
    //         $Errorlog->controller_name = $controller_name;
    //         $Errorlog->error_code = $error_code;
    //         $Errorlog->error_message = $error_message;
    //         $Errorlog->send_payload = $send_payload;
    //         $Errorlog->response = $response;            
    //         $Errorlog->save();


    //     }catch(Exception $e){

    //         $e->getMessage();
    //     }    
    // }


    // public static function json_validator($data) {

    //     try{            
    //         if (!empty($data)) {
                
    //             return is_array($data) ? true : false;
    //         }else{
                
    //             return false;
    //         }
        
    //     }catch(Exception $e){

    //         $e->getMessage();
    //     }    
    // }
}