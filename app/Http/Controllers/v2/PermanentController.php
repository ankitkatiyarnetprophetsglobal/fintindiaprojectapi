<?php

namespace App\Http\Controllers\v2;

use App\Helpers\Helper as HelpersHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\v2\CommonController;
use App\Models\Errorlog;
use App\Models\Permanent;
use Response;
use Helper;





class PermanentController extends Controller
{    
    public function __construct() {

        $this->middleware('auth:api', ['except' => ['permanent_delete_user','permanent_delete_user_status','permanent_delete_user_revoke']]);

    }
    
    public function permanent_delete_user(Request $request){

        try{ 
            
            $user = auth('api')->user();

            if($user){               

                $user_id = $request->user_id;
                $email = $request->email;
                $phone = $request->phone;
                $request_date = $request->request_date;
                // dd($request_date);
                $newdate = date('Y-m-d', strtotime($request_date. ' + 30 day'));
                $os_details = $request->os_details;

                if($user_id  == null || $user_id  == ''){

                    $error_code = '801';
                    $error_message = 'Required To User Id';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);    

                }
                
                if($request_date  == null || $request_date  == ''){

                    $error_code = '801';
                    $error_message = 'Required To Request Date';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);    

                }
                
                if($os_details  == null || $os_details  == ''){

                    $error_code = '801';
                    $error_message = 'Required To OS Details';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);    

                }
               
                $Permanents = new Permanent();
                $Permanents->user_id = $user_id;
                $Permanents->email = $email;                          	
                $Permanents->phone = $phone;                          	
                $Permanents->request_date = $newdate;                          	
                $Permanents->os_details = $os_details;                          	                                       	
                $Permanents->save();

                return Response::json(array(
                    'isSuccess' => 'true',
                    'code'      => 200,
                    'data'      => null,
                    'message'   => 'Insert Success'
                ), 200);



            }else{
                
                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'message'   =>  'Unauthorized'
                ), 401);
                
            }

        } catch(Exception $e) { 
        
            $controller_name = 'PermanentController';
            $function_name = 'permanent_delete_user';   
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
    
    public function permanent_delete_user_status(Request $request){

        try{ 
            
            $user = auth('api')->user();

            if($user){               

                $user_id = $request->user_id;                

                if($user_id  == null || $user_id  == ''){

                    $error_code = '801';
                    $error_message = 'Required To User Id';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);    

                }


                $data = Permanent::select('id','user_id','status')->where([['user_id','=' , $user_id],['status','=' , 1]])->get();
                
                if(count($data) > 0){                    

                    return Response::json(array(
						'status'    => 'success',
						'code'      =>  200,
						'message'   =>  $data
					), 200);	

                }else{
                    
                    return Response::json(array(
                        'status'    => 'error',
                        'code'      =>  401,
                        'data'   => 'Data not found'
                    ), 401);
                }
            }else{
                
                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'message'   =>  'Unauthorized'
                ), 401);
                
            }

        } catch(Exception $e) { 
        
            $controller_name = 'PermanentController';
            $function_name = 'permanent_delete_user_status';   
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


    // $sleep = Sleep::where('user_id',$user->id)->where('wakup_date',$wakeupdate)->first();

    // if($sleep){
    //     return Response::json(array(
    //         'hours_count' => $request->sleep_hours,
    //         'statue' => 'success',
    //         'code' => 200,
    //         'message' => 'Time sucessfully updated'
    //     ), 200);
    // }else{
    //     return Response::json(array(
    //         'statue' => 'error',
    //         'code' => 200,
    //         'message' => 'Time not stored'
    //     ), 200); 
    // }


    public function permanent_delete_user_revoke(Request $request){

        try{ 
            
            $user = auth('api')->user();

            if($user){               

                $user_id = $request->user_id;                

                if($user_id  == null || $user_id  == ''){

                    $error_code = '801';
                    $error_message = 'Required To User Id';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);    

                }

                // dd($user_id);
                $data = Permanent::select('id','user_id','status')->where([['user_id','=' , $user_id],['status','=' , 1]])->get();
                
                if(count($data) > 0){                    

                    Permanent::where('user_id', $user_id)->update(['status' => 0]);	
                    
                    return response()->json([
						'isSuccess' => 'true',
                        'code'      => 200,
                        'data'      => null,
                        'message'   => 'Updated Successfully'        
                    ], 200);

                }else{
                    
                    return Response::json(array(
                        'status'    => 'error',
                        'code'      =>  401,
                        'data'   => 'Data not found'
                    ), 401);
                }
            }else{
                
                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'message'   =>  'Unauthorized'
                ), 401);
                
            }

        } catch(Exception $e) { 
        
            $controller_name = 'PermanentController';
            $function_name = 'permanent_delete_user_revoke';   
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
