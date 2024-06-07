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
use App\Models\Abhauserlog;
use Response;
use Helper;





class AbhaintegrationController extends Controller
{    
    public function __construct() {

        $this->middleware('auth:api', ['except' => ['getabhaintegrationurl','postabhauserurl','getabhauserdetail','getdetailabhaaddress','abhasearchdetails','deactivateabhaaddress']]);

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
                    'data'   =>  null,
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
                // dd('postabhauserurl');
                $fid = $request->fid;
                $abha_id = $request->abha_id;            
                $abha_address = $request->abha_address;
                $name = $request->name;
                $dob = $request->dob;
                $month = $request->month;
                $year = $request->year;
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
                              
                // dd($abha_address);    
                $dataabha_add_checkstatus = Abhauserdetails::select('deactivate_abha','fid','abha_user_details.id','abha_id','abha_address','name','dob','month','year','gender','mobile','address','abha_card','state_name','town_name','district_name','profile_image')
                                                ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')                                                
                                                ->where([
                                                            ['abha_user_details.abha_address','=' , trim($abha_address)],
                                                            ['abha_user_maping.deactivate_abha','=' , '1'],
                                                            ['abha_user_maping.status','=' , 1]
                                                        ])                                                
                                                ->get();
                                                // ->orderBy('abha_user_details.id', 'DESC')->get();                                                  
                    // dd(count($dataabha_add_checkstatus));                                
                    // dd($dataabha_add_checkstatus);                                
                    if(count($dataabha_add_checkstatus) >0){                    
                        
                        $error_code = '801';
                        $error_message = 'Already Linked';                
                        
                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $error_message
                        ), 200);  

                    }else{
                        
                        $data = Abhausermaping::select('id','fid','abha_id','deactivate_abha')->where([
                                                                                        ['fid','=' , $fid],
                                                                                        ['abha_user_maping.deactivate_abha','=' , 1],
                                                                                        ['abha_id','=' , $abha_id],['status','=' , 1]
                                                                                    ])
                                                                            ->get();                                            
                        // dd(count($data));
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
                                $Abhausermapings->month = $month;
                                $Abhausermapings->year = $year;
                                $Abhausermapings->gender = $gender;                          	
                                $Abhausermapings->mobile = $mobile;                          	
                                $Abhausermapings->address = $address;
                                $Abhausermapings->abha_card = $abha_card;
                                $Abhausermapings->state_name = $state_name;
                                $Abhausermapings->town_name = $town_name;
                                $Abhausermapings->district_name = $district_name;
                                // $Abhausermapings->profile_image2 = $profile_image;
                                $Abhausermapings->save();

                                return Response::json(array(
                                    'isSuccess' => 'true',
                                    'code'      => 200,
                                    'data'      => null,
                                    'message'   => 'Insert Success'
                                ), 200);
                            }
                            
                        }else{                
                            // dd('new data');
                            $dataabha_add_checkstatus = Abhauserdetails::select('fid','abha_user_details.id','abha_id','abha_address','name','dob','month','year','gender','mobile','address','abha_card','state_name','town_name','district_name','profile_image')
                            ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')                                                
                            ->where([
                                        ['abha_user_details.abha_address','=' , $abha_address],
                                        ['abha_user_maping.deactivate_abha','=' , 0],
                                        ['abha_user_maping.status','=' , 1]
                                    ])                                                
                            ->orderBy('abha_user_details.id', 'DESC')->get();  
                            // dd(count($dataabha_add_checkstatus));
                            if(count($dataabha_add_checkstatus) >0){ 
                                // foreach ($dataabha_add_checkstatus as $key_value => $value_data) {

                                //     dd($value_data['abha_address']);
                                // }
                                // dd('abha address is already in check');
                                $data_fid = $dataabha_add_checkstatus[0]['fid'];
                                // dd($data_fid);
                                if($data_fid == $fid){
                                    
                                    $update_query = Abhausermaping::join('abha_user_details', 'abha_user_details.aum_id', '=', 'abha_user_maping.id')
                                                            ->where([
                                                                    ['abha_user_maping.fid','=' , $fid],
                                                                    ['abha_user_details.abha_address','=' , $abha_address],
                                                                    ['abha_user_maping.status','=' , 1],
                                                                    ['abha_user_maping.deactivate_abha','=' , 0],
                                                                ])
                                                            ->update([
                                                                'deactivate_abha' => 1
                                                            ]); 
                                    $Abhauserlogs = new Abhauserlog();
                                    $Abhauserlogs->fid = $fid;
                                    $Abhauserlogs->abha_id = $abha_id;
                                    $Abhauserlogs->status = 1;
                                    $Abhauserlogs->save();

                                    $datatwo = Abhauserdetails::select('abha_user_maping.deactivate_abha','fid','abha_user_details.id','abha_id','abha_address','name','dob','gender','mobile','address','abha_card','state_name','town_name','district_name','profile_image','month','year')
                                                ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')                                                
                                                ->where([
                                                    ['abha_user_maping.fid','=' , $fid],
                                                    ['abha_user_details.abha_address','=' , $abha_address],
                                                    ['abha_user_maping.status','=' , 1],                                                                                                       
                                                    ['abha_user_maping.deactivate_abha','=' , 1],
                                                ])
                                                ->orderBy('abha_user_details.id', 'DESC')->get();
                                    
                                    return Response::json(array(
                                        'status'    => 'success',
                                        'code'      =>  200,
                                        'data'   =>  $datatwo,
                                        'message'   => null
                                    ), 200);




                                }elseif($data_fid != $fid){                                
                                    // dd(987654);
                                    // dd($data_fid);
                                    $data_retrive = Abhauserdetails::select('fid','abha_user_details.id','abha_id','abha_address','name','dob','month','year','gender','mobile','address','abha_card','state_name','town_name','district_name','profile_image')
                                                                                ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')                                                
                                                                                ->where([
                                                                                            ['fid','=' , $data_fid],
                                                                                            ['abha_user_maping.deactivate_abha','=' , 0],
                                                                                            ['abha_user_maping.status','=' , 1]
                                                                                        ])                                                
                                                                                ->orderBy('abha_user_details.id', 'DESC')->get();  
                                    // dd(count($data_retrive));
                                    if(count($data_retrive) >0){ 
                                        // dd($data_retrive[0]['abha_id']);
                                        // dd(count($data_retrive));
                                        $Abhausermapings = new Abhausermaping();
                                        $Abhausermapings->fid = $fid;
                                        $Abhausermapings->abha_id = $data_retrive[0]['abha_id'];
                                        $Abhausermapings->save();
                                        $aumid = $Abhausermapings->id;    
                                        foreach ($data_retrive as $key => $value) {
                                            // dd($fid);
                                            // dd($value);
                                            // dd($value['abha_id']);
                                            $Abhausermapings = new Abhauserdetails();
                                            $Abhausermapings->aum_id = $aumid;
                                            $Abhausermapings->abha_address = $value['abha_address'];
                                            $Abhausermapings->name = $value['name'];
                                            $Abhausermapings->dob = $value['dob'];
                                            $Abhausermapings->month = $value['month'];
                                            $Abhausermapings->year = $value['year'];
                                            $Abhausermapings->gender = $value['gender'];
                                            $Abhausermapings->mobile = $value['mobile'];
                                            $Abhausermapings->address = $value['address'];
                                            $Abhausermapings->abha_card = $value['abha_card'];
                                            $Abhausermapings->state_name = $value['state_name'];
                                            $Abhausermapings->town_name = $value['town_name'];
                                            $Abhausermapings->district_name = $value['district_name'];                                
                                            $Abhausermapings->profile_image = $value['profile_image'];
                                            $Abhausermapings->save(); 
                                        }
                                            return Response::json(array(
                                                'isSuccess' => 'true',
                                                'code'      => 200,
                                                'data'      => null,
                                                'message'   => 'Insert Success'
                                            ), 200);
                                        }

                                }else{
                                    
                                    $error_code = '801';
                                    $error_message = 'Fitindia Id Not Found';                
                                    
                                    return Response::json(array(
                                        'isSuccess' => 'false',
                                        'code'      => $error_code,
                                        'data'      => null,
                                        'message'   => $error_message
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
                                $Abhausermapings->name = $name;
                                $Abhausermapings->dob = $dob;
                                $Abhausermapings->month = $month;
                                $Abhausermapings->year = $year;
                                $Abhausermapings->gender = $gender;
                                $Abhausermapings->mobile = $mobile;
                                $Abhausermapings->address = $address;
                                $Abhausermapings->abha_card = $abha_card;
                                $Abhausermapings->state_name = $state_name;
                                $Abhausermapings->town_name = $town_name;
                                $Abhausermapings->district_name = $district_name;                                
                                $Abhausermapings->save();            
                            
                                return Response::json(array(
                                    'isSuccess' => 'true',
                                    'code'      => 200,
                                    'data'      => null,
                                    'message'   => 'Insert Success'
                                ), 200);
                            }
                        }
                    }
                
                
            }else{
                
                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'data'   =>  null,
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
                
                $datadetails = Abhauserdetails::select('abha_user_details.id','abha_id','abha_address','name','dob','gender','mobile','address','abha_card')
                                                ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')
                                                ->where([['abha_user_maping.fid','=' , $fid],['abha_user_maping.status','=' , 1]])
                                                ->orderBy('abha_user_details.id', 'DESC')->first(); 
                
                if(isset($datadetails)){                    

                    return Response::json(array(
						'status'    => 'success',
						'code'      =>  200,
						'data'   =>  $datadetails,
						'message'   =>  null
					), 200);	

                }else{                   
                
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
                    'data'   =>  null,
                    'message'   =>  'Unauthorized'
                ), 401);
                
            }

        } catch(Exception $e) { 
            
            $controller_name = 'AbhaintegrationController';
            $function_name = 'getabhauserdetail';   
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

                $datacheck = Abhauserdetails::select('fid','abha_user_details.id','abha_id','abha_address','name','dob','gender','mobile','address','abha_card','state_name','town_name','district_name','profile_image')
                                                ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')
                                                ->where([
                                                            ['abha_user_maping.fid','=' , $fid],
                                                            ['abha_user_maping.deactivate_abha','=' , 1],
                                                            ['abha_user_maping.status','=' , 1]
                                                        ])
                                                ->orWhere('abha_user_details.abha_address','=' , $abha_address)                                            
                                                ->orderBy('abha_user_details.id', 'DESC')->get();                                
                if(count($datacheck) > 0 ){                    
                        
                    $datadetails = Abhauserdetails::select('fid','abha_user_details.id','abha_id','abha_address','name','dob','month','year','gender','mobile','address','abha_card','state_name','town_name','district_name','profile_image')
                                                    ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')                                                
                                                    ->where([                                                                
                                                                ['abha_user_details.abha_address','=' , $abha_address],
                                                                ['abha_user_maping.deactivate_abha','=' , 1],
                                                                ['abha_user_maping.status','=' , 1]
                                                            ])                                                
                                                    ->orderBy('abha_user_details.id', 'DESC')->first();
                    
                    if(isset($datadetails)){ 
                        
                        if($datadetails['fid'] == $fid){

                            $datadetailsrecods = Abhauserdetails::select('fid','abha_user_details.id','abha_id','abha_address','name','dob','month','year','gender','mobile','address','abha_card','state_name','town_name','district_name','profile_image')
                                                                        ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')                            
                                                                        ->where([
                                                                                    ['abha_user_maping.fid','=' , $fid],
                                                                                    ['abha_user_details.abha_address','=' , $abha_address],
                                                                                    ['abha_user_maping.deactivate_abha','=' , 1],
                                                                                    ['abha_user_maping.status','=' , 1]
                                                                                ])                            
                                                                        ->orderBy('abha_user_details.id', 'DESC')->get();         

                            return Response::json(array(
                                'status'    => 'success',
                                'code'      =>  200,
                                'data'   =>  $datadetailsrecods,
                                'message'   => null
                            ), 200);	

                        }else{

                            $error_code = '803';
                            $error_message = 'Already Linked';                
                            
                            return Response::json(array(
                                'isSuccess' => 'false',
                                'code'      => $error_code,
                                'data'      => null,
                                'message'   => $error_message
                            ), 200); 
                        }

                    }else{

                        $datadeactive = Abhauserdetails::select('fid','abha_user_details.id','abha_id','abha_address','name','dob','gender','mobile','address','abha_card','state_name','town_name','district_name','profile_image','month','year')
                                                ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')                                                
                                                ->where([
                                                    ['abha_user_maping.fid','=' , $fid],
                                                    ['abha_user_details.abha_address','=' , $abha_address],
                                                    ['abha_user_maping.deactivate_abha','=' , 0],
                                                    ['abha_user_maping.status','=' , 1]
                                                ])                        
                                                ->orderBy('abha_user_details.id', 'DESC')->get();
                        
                        if(count($datadeactive) > 0 ){ 

                            foreach($datadeactive as $key => $value){

                                if($value['fid'] == $fid){

                                    $abha_id = $value['abha_id'];
                                    $update_query = Abhausermaping::join('abha_user_details', 'abha_user_details.aum_id', '=', 'abha_user_maping.id')
                                                            ->where([
                                                                    ['abha_user_maping.fid','=' , $fid],
                                                                    ['abha_user_details.abha_address','=' , $abha_address],
                                                                    ['abha_user_maping.status','=' , 1],
                                                                    ['abha_user_maping.deactivate_abha','=' , 0],
                                                                ])
                                                            ->update([
                                                                'deactivate_abha' => 1
                                                            ]); 
                                    $Abhauserlogs = new Abhauserlog();
                                    $Abhauserlogs->fid = $fid;
                                    $Abhauserlogs->abha_id = $value['abha_id'];
                                    $Abhauserlogs->status = 1;
                                    $Abhauserlogs->save();

                                    $datatwo = Abhauserdetails::select('abha_user_maping.deactivate_abha','fid','abha_user_details.id','abha_id','abha_address','name','dob','gender','mobile','address','abha_card','state_name','town_name','district_name','profile_image','month','year')
                                                ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')                                                
                                                ->where([
                                                    ['abha_user_maping.fid','=' , $fid],
                                                    ['abha_user_details.abha_address','=' , $abha_address],
                                                    ['abha_user_maping.status','=' , 1],                                                                                                       
                                                    ['abha_user_maping.deactivate_abha','=' , 1],
                                                ])
                                                ->orderBy('abha_user_details.id', 'DESC')->get();
                                    
                                    return Response::json(array(
                                        'status'    => 'success',
                                        'code'      =>  200,
                                        'data'   =>  $datatwo,
                                        'message'   => null
                                    ), 200);

                                }                               
                            }                       
                        }else{
                            
                            $error_code = '802';
                            $error_message = 'Abha Address Found But not Fitindia ID Not Found';                 
                            
                            return Response::json(array(
                                'isSuccess' => 'false',
                                'code'      => $error_code,
                                'data'      => null,
                                'message'   => $error_message
                            ), 200);  
                        }

                    }                    
                    
                }else{

                    $error_code = '802';                                   
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
            // dd(1);    
            $user = auth('api')->user();

            if($user){
                
                $key_search = $request->key_search;                
                $abha_id = $request->abha_id;                
                $mobile = $request->mobile;
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
                // dd(321);
                    // $datafidcheck = Abhauserdetails::select('fid','abha_user_details.id','abha_id','abha_address','name','dob','gender','mobile','address','abha_card')
                    // ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')
                    // ->where([
                    //         ['abha_user_maping.fid','=' , $fid]                            
                    //     ])                                 
                    // ->orderBy('abha_user_details.id', 'DESC')->get();
                    // // dd(count($datafidcheck));
                    // if(count($datafidcheck) == 0){
                    //     $error_code = '802';
                    //         $error_message = 'Data not found';                
                            
                    //         return Response::json(array(
                    //             'isSuccess' => 'false',
                    //             'code'      => $error_code,
                    //             'data'      => null,
                    //             'message'   => $error_message
                    //         ), 200); 
                    // }else{    
                        $datacheck = Abhauserdetails::select('fid','abha_user_details.id','abha_id','abha_address','name','dob','gender','mobile','address','abha_card')
                                                ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')
                                                ->where([
                                                        ['abha_user_maping.fid','=' , $fid],
                                                        ['abha_user_maping.deactivate_abha','=' , 1],
                                                        ['abha_user_maping.status','=' , 1],
                                                        // [$mysql_key,'=' , $search_value]
                                                    ])
                                                ->orWhere($mysql_key,'=' , $search_value)                
                                                ->orderBy('abha_user_details.id', 'DESC')->get();
                        // dd(count($datacheck));                            
                        if(count($datacheck) > 0){

                            $datadetails = Abhauserdetails::select('abha_user_maping.deactivate_abha','fid','abha_user_details.id','abha_id','abha_address','name','dob','month','year','gender','mobile','address','abha_card','state_name','town_name','district_name','profile_image','month','year')
                                                            ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')                                                                                                    
                                                            ->where([
                                                                        // ['abha_user_maping.fid','=' , $fid],
                                                                        [$mysql_key,'=' , $search_value],
                                                                        ['abha_user_maping.deactivate_abha','=' , 1],
                                                                        ['abha_user_maping.status','=' , 1]
                                                                    ])
                                                            ->orderBy('abha_user_details.id', 'DESC')->get(); 
                            // dd(count($datadetails));
                            if(count($datadetails) > 0){     

                                foreach($datadetails as $key1 => $value1){

                                        $error_code = '803';
                                        $error_message = 'Already Linked';                
                                        
                                        return Response::json(array(
                                            'isSuccess' => 'false',
                                            'code'      => $error_code,
                                            'data'      => null,
                                            'message'   => $error_message
                                        ), 200); 
                                    }
                                    // if($value1['fid'] == $fid){
                                    //         return Response::json(array(
                                    //         'status'    => 'success',
                                    //         'code'      =>  200,
                                    //         'data'   =>  $datadetails,
                                    //         'message'   =>  null
                                    //     ), 200);
                                    // }
                                    // if($datadetails[0]['fid'] == $fid){

                                    //     return Response::json(array(
                                    //         'status'    => 'success',
                                    //         'code'      =>  200,
                                    //         'data'   =>  $datadetails,
                                    //         'message'   =>  null
                                    //     ), 200);	

                                    // }else{

                                    //     $error_code = '803';
                                    //     $error_message = 'Already Linked';                
                                        
                                    //     return Response::json(array(
                                    //         'isSuccess' => 'false',
                                    //         'code'      => $error_code,
                                    //         'data'      => null,
                                    //         'message'   => $error_message
                                    //     ), 200); 
                                    // }
                                // }

                            }else{                        
                                
                                $datacheckdeactive = Abhauserdetails::select('abha_user_maping.deactivate_abha','fid','abha_user_details.id','abha_id','abha_address','name','dob','gender','mobile','address','abha_card','state_name','town_name','district_name','profile_image','month','year')
                                                        ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')
                                                        // ->where($mysql_key,'=' , $search_value)
                                                        ->where([
                                                            ['abha_user_maping.fid','=' , $fid],
                                                            [$mysql_key,'=' , $search_value],                                                    
                                                            ['abha_user_maping.status','=' , 1]
                                                        ])
                                                        ->orderBy('abha_user_details.id', 'DESC')->get();
                                // dd(987564564);
                                // dd(count($datacheckdeactive));
                                if(count($datacheckdeactive) > 0){
                                    
                                    foreach($datacheckdeactive as $key => $value){
                                        
                                        $abha_id = $value['abha_id'];
                                        // echo '<br/>';
                                        // echo $fid;
                                        // dd($fid);
                                        if($value['fid'] == $fid){
                                            // dd($value['fid']);
                                            $update_query = Abhausermaping::where([
                                                                                    ['abha_user_maping.fid','=' , $fid],
                                                                                    ['abha_user_maping.abha_id','=' , $abha_id],
                                                                                    ['abha_user_maping.status','=' , 1],
                                                                                    ['abha_user_maping.deactivate_abha','=' , 0],
                                                                                    ])
                                                                            ->update([
                                                                                'deactivate_abha' => 1
                                                                            ]);
                                            $Abhauserlogs = new Abhauserlog();
                                            $Abhauserlogs->fid = $fid;
                                            $Abhauserlogs->abha_id = $abha_id;
                                            $Abhauserlogs->status = 1;
                                            $Abhauserlogs->save();
                                            
                                            $datatwo = Abhauserdetails::select('abha_user_maping.deactivate_abha','fid','abha_user_details.id','abha_id','abha_address','name','dob','gender','mobile','address','abha_card','state_name','town_name','district_name','profile_image','month','year')
                                                        ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')
                                                        // ->where($mysql_key,'=' , $search_value)
                                                        ->where([
                                                            ['abha_user_maping.fid','=' , $fid],
                                                            ['abha_user_maping.abha_id','=' , $abha_id],
                                                            ['abha_user_maping.status','=' , 1],                                                                                                       
                                                            ['abha_user_maping.deactivate_abha','=' , 1],
                                                        ])
                                                        ->orderBy('abha_user_details.id', 'DESC')->get();

                                            return Response::json(array(
                                                'status'    => 'success',
                                                'code'      =>  200,
                                                'data'   =>  $datatwo,
                                                'message'   =>  null
                                            ), 200);
                                        
                                        }
                                    }
                                          
                                }else{
                                    // dd(987);
                                    $error_code = '802';
                                    $error_message = 'Data Mismatch';                
                                    
                                    return Response::json(array(
                                        'isSuccess' => 'false',
                                        'code'      => $error_code,
                                        'data'      => null,
                                        'message'   => $error_message
                                    ), 200);
                                }
                            }
                        
                        }else{
                           
                            $error_code = '802';
                            $error_message = 'Data not found';                
                            
                            return Response::json(array(
                                'isSuccess' => 'false',
                                'code'      => $error_code,
                                'data'      => null,
                                'message'   => $error_message
                            ), 200); 

                        }
                    // }
                
            }else{
                
                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'data'   =>  null,
                    'message'   =>  'Unauthorized'
                ), 401);
                
            }

        } catch(Exception $e) { 
            
            $controller_name = 'AbhaintegrationController';
            $function_name = 'abhasearchdetails';   
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
    
    public function deactivateabhaaddress(Request $request){

        try{   
            
            $user = auth('api')->user();

            if($user){                
                
                $abha_id = $request->abha_id;
                $fid = $request->fid;

                if($abha_id == ''){

                    $error_code = '801';
                    $error_message = 'Required To Fitindia id';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);    

                }
                
                
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
                
                $datacheck = Abhauserdetails::select('fid','abha_user_details.id','abha_id','abha_address','name','dob','gender','mobile','address','abha_card','state_name','town_name','district_name','profile_image','month','year')
                                                ->join('abha_user_maping', 'abha_user_maping.id', '=', 'abha_user_details.aum_id')
                                                ->where([
                                                        ['abha_user_maping.abha_id','=' , $abha_id],
                                                        ['abha_user_maping.deactivate_abha','=' , 1],
                                                        ['abha_user_maping.status','=' , 1]
                                                        ])
                                                ->orderBy('abha_user_details.id', 'DESC')->get();
                if(count($datacheck) > 0){
                    $update_query = Abhausermaping::where([
                                                            ['abha_user_maping.abha_id','=' , $abha_id],
                                                            ['abha_user_maping.status','=' , 1],
                                                            ['abha_user_maping.deactivate_abha','=' , 1],
                                                            ])
                                    ->update([
                                        'deactivate_abha' => 0
                                    ]);                    
                    $Abhauserlogs = new Abhauserlog();
                    $Abhauserlogs->fid = $fid;
                    $Abhauserlogs->abha_id = $abha_id;
                    $Abhauserlogs->status = 1;
                    $Abhauserlogs->save();

                    return Response::json(array(
                        'isSuccess' => 'true',
                        'code'      => 200,
                        'data'      => null,
                        'message'   => 'Deactivate Successfully'
                    ), 200);
                }else{
                    
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
                    'data'   =>  null,
                    'message'   =>  'Unauthorized'
                ), 401);
                
            }

        } catch(Exception $e) { 
            
            $controller_name = 'AbhaintegrationController';
            $function_name = 'deactivateabhaaddress';   
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
