<?php

namespace App\Http\Controllers\v2;

use App\Helpers\Helper as HelpersHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\v2\CommonController;
use App\Models\Errorlog;
use App\Models\Abhaintegration;
use App\Models\Abhausermaping;
use App\Models\Abhauserdetails;
use Response;
use Helper;





class AbhaintegrationController extends Controller
{    
    public function __construct() {

        $this->middleware('auth:api', ['except' => ['getabhaintegrationurl','postabhauserurl']]);

    }
    
    public function getabhaintegrationurl(Request $request){

        try{ 
            
            $user = auth('api')->user();

            if($user){

                $version = $request->version;
                $device_name = $request->device_name;
                
                if($device_name == null || $device_name == ''){

                    $error_code = '801';
                    $error_message = 'Required To Device Name';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);    

                }               
                
                if($version == null || $version == ''){

                    $error_code = '801';
                    $error_message = 'Required To Version ID';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);    

                }               
                
                $error_code = 200;
                $error_message = "Data Not Found";
                $success_message = null;
                $data = Abhaintegration::
                                        select(
                                            'key_value',
                                            'url',
                                            'fitindia_version',
                                            'abha_version',
                                            'status',
                                            )
                                        ->where([
                                                ['device_name','=' , $device_name],
                                                ['fitindia_version','=' , $version],
                                                ['status','=' , 1],
                                                ])                                            
                                        ->get();                                            
                
                if(count($data) > 0){
                
                    return Response::json(array(
                                    'isSuccess' => 'true',
                                    'code'      => $error_code,
                                    'data'      => $data,
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
        
            $controller_name = 'AbhaintegrationController';
            $function_name = 'getabhaintegrationurl';   
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

    public function postabhauserurl(Request $request){

        try{
            
            $user = auth('api')->user();

            if($user){

                $fid = $request->fid;
                $abha_id = $request->abha_id;            
                $abha_address = $request->abha_address;
                $name = $request->name;
                $dob = $request->dob;
                $gender = $request->gender;
                $mobile = $request->mobile;
                $address = $request->address;

                if($fid == null || $fid == ''){

                    $error_code = '801';
                    $error_message = 'Required To Fit India Id';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);    

                }

                if($abha_id == null || $abha_id == ''){

                    $error_code = '801';
                    $error_message = 'Required To Abha Id';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);    

                }

                if($abha_address == null || $abha_address == ''){

                    $error_code = '801';
                    $error_message = 'Required To Abha Address';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);    

                }            
                // dd($abha_address);
                $dataabha_add_checkstatus = Abhauserdetails::select('id','aum_id','abha_address')->where([['abha_address','=' , $abha_address],['status','=' , 1]])->get(); 
                // dd(count($dataabha_add_checkstatus));
                if(count($dataabha_add_checkstatus) >0){
                    
                    // dd("Duplicate Value");
                    $error_code = '801';
                    $error_message = 'Duplicate Abha Address';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);  

                }else{
                    
                    // dd("Value Insert");

                    $data = Abhausermaping::select('id','fid','abha_id')->where([['fid','=' , $fid],['abha_id','=' , $abha_id],['status','=' , 1]])->get();                                            
                    
                    if(count($data) > 0){

                    
                        $oldaum_id = $data[0]['id'];
                        $dataAbhauserdetails = Abhauserdetails::select('id','aum_id','abha_address')->where([['aum_id','=' , $oldaum_id],['abha_address','=' , $abha_address],['status','=' , 1]])->get(); 
                        
                        if(count($dataAbhauserdetails) > 0){                    
                    
                            return Response::json(array(
                                'isSuccess' => 'true',
                                'code'      => 200,
                                'data'      => null,
                                'message'   => 'Data up to date'
                            ), 200);

                        }else{
                    
                            $Abhausermapings = new Abhauserdetails();
                            $Abhausermapings->aum_id = $oldaum_id;
                            $Abhausermapings->abha_address = $abha_address;                          	
                            $Abhausermapings->name = $name;                          	
                            $Abhausermapings->dob = $dob;                          	
                            $Abhausermapings->gender = $gender;                          	
                            $Abhausermapings->mobile = $mobile;                          	
                            $Abhausermapings->address = $address;                          	
                            $Abhausermapings->save();

                            return Response::json(array(
                                'isSuccess' => 'true',
                                'code'      => 200,
                                'data'      => null,
                                'message'   => 'Insert Success'
                            ), 200);
                        }
                        
                    }else{                
                        
                        $Abhausermapings = new Abhausermaping();
                        $Abhausermapings->fid = $fid;
                        $Abhausermapings->abha_id = $abha_id;                          	
                        $Abhausermapings->save();
                        $aumid = $Abhausermapings->id;                
                        
                        $Abhausermapings = new Abhauserdetails();
                        $Abhausermapings->aum_id = $aumid;
                        $Abhausermapings->abha_address = $abha_address;                          	
                        $Abhausermapings->save();            
                    
                        return Response::json(array(
                            'isSuccess' => 'true',
                            'code'      => 200,
                            'data'      => null,
                            'message'   => 'Insert Success'
                        ), 200);
                        
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
            
            $controller_name = 'AbhaintegrationController';
            $function_name = 'postabhauserurl';   
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
    
    public function getabhauserdetail(Request $request){

        try{
            
            $user = auth('api')->user();

            if($user){
                
                $abha_address = $request->abha_address;                

                if($abha_address == null || $abha_address == ''){

                    $error_code = '801';
                    $error_message = 'Required To Abha Address';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);    

                }            
                // dd($abha_address);
                $datadetails = Abhauserdetails::select('abha_id','abha_address','name','dob','gender','mobile','address')
                                                ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')
                                                ->where([['abha_address','=' , $abha_address],['abha_user_maping.status','=' , 1]])->first(); 
                // dd(count($datadetails));
                if(isset($datadetails)){                    

                    return Response::json(array(
						'status'    => 'success',
						'code'      =>  200,
						'message'   =>  $datadetails
					), 200);	

                }else{
                    
                    // dd("Duplicate Value");
                    $error_code = '801';
                    $error_message = 'Data not found';                
                    
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
            
            $controller_name = 'AbhaintegrationController';
            $function_name = 'postabhauserurl';   
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
