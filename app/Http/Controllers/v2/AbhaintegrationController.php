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

        $this->middleware('auth:api', ['except' => ['getabhaintegrationurl','postabhauserurl','getabhauserdetail','getdetailabhaaddress','abhasearchdetails']]);

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
                $abha_card = $request->abha_card;
                $state_name = $request->state_name;
                $town_name = $request->town_name;
                $district_name = $request->district_name;
                $profile_image = $request->profile_image;

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
                
                $dataabha_add_checkstatus = Abhauserdetails::select('id','aum_id','abha_address')->where([['abha_address','=' , $abha_address],['status','=' , 1]])->get(); 
                
                if(count($dataabha_add_checkstatus) >0){                    
                    
                    $error_code = '801';
                    $error_message = 'Duplicate Abha Address';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);  

                }else{

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
                            $Abhausermapings->abha_card = $abha_card;
                            $Abhausermapings->state_name = $state_name;
                            $Abhausermapings->town_name = $town_name;
                            $Abhausermapings->district_name = $district_name;
                            $Abhausermapings->profile_image = $profile_image;
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
                        $Abhausermapings->abha_card = $abha_card;
                        $Abhausermapings->state_name = $state_name;
                        $Abhausermapings->town_name = $town_name;
                        $Abhausermapings->district_name = $district_name;
                        $Abhausermapings->profile_image = $profile_image;                          	
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
                
                $fid = $request->fid;                

                if($fid == null || $fid == ''){

                    $error_code = '801';
                    $error_message = 'Required To Fitindia id';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);    

                }            
                // dd($abha_address);
                $datadetails = Abhauserdetails::select('abha_user_details.id','abha_id','abha_address','name','dob','gender','mobile','address','abha_card')
                                                ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')
                                                ->where([['abha_user_maping.fid','=' , $fid],['abha_user_maping.status','=' , 1]])
                                                ->orderBy('abha_user_details.id', 'DESC')->first(); 
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

    public function getdetailabhaaddress(Request $request){

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
                $datadetails = Abhauserdetails::select('abha_user_details.id','abha_id','abha_address','name','dob','gender','mobile','address','abha_card','state_name','town_name','district_name','profile_image')
                                                ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')                                                
                                                ->where([['abha_user_details.abha_address','=' , $abha_address],['abha_user_maping.status','=' , 1]])                                                
                                                ->orderBy('abha_user_details.id', 'DESC')->first(); 
                // dd(count($datadetails));
                // dd($datadetails);
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
            $function_name = 'getdetailabhaaddress';   
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
     
    public function abhasearchdetails(Request $request){

        try{   
            // dd($request->all());         
            $user = auth('api')->user();

            if($user){
                
                $key_search = $request->key_search;                
                $abha_id = $request->abha_id;                
                $mobile = $request->mobile; 
                
                if($key_search == null || $key_search == ''){

                    $error_code = '801';
                    $error_message = 'Required To Key Search';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);    

                }
                
                if($key_search == "abha_id"){

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

                    $mysql_key = "abha_user_maping.abha_id";
                    $search_value = $abha_id;
                }

                if($key_search == "mobile"){

                    if($mobile == null || $mobile == ''){

                        $error_code = '801';
                        $error_message = 'Required To Mobile';                
                        
                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $error_message
                        ), 200);    
                    }
                    
                    $mysql_key = "abha_user_details.mobile";
                    $search_value = $mobile;
                    
                }

                // dd($mobile);
                $datadetails = Abhauserdetails::select('abha_user_details.id','abha_id','abha_address','name','dob','gender','mobile','address','abha_card','state_name','town_name','district_name','profile_image')
                                                ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')                                                
                                                // ->where([['abha_user_maping.abha_id','=' , $abha_id],['abha_user_maping.status','=' , 1]])                                                
                                                ->where([[$mysql_key,'=' , $search_value],['abha_user_maping.status','=' , 1]])                                                
                                                ->orderBy('abha_user_details.id', 'DESC')->get(); 
                // dd(count($datadetails));
                // dd($datadetails);
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
            $function_name = 'getdetailabhaaddress';   
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
