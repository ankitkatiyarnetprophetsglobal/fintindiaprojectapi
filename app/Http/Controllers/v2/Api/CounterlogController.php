<?php
namespace App\Http\Controllers\v2\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Devicelog;
use App\Models\Debuguserslog;
use App\Models\Exceptionlog;
use App\Models\LoginAttempt;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CounterlogController extends Controller
{
	public function getDevicelog(Request $request){	
	
		$data = Devicelog::where('user_id', $request->user_id)->get();
		
		if($data->count() > 0){
			return Response::json(array(
				'status'    => 'success',
				'code'      =>  200,
				'data'   => $data
			), 200);
		}else{
			return Response::json(array(
				'status'    => 'error',
				'code'      =>  401,
				'data'   => 'Data not found'
			), 401);
		}
			
		return $data;	
	}	
	
	public function createDevicelog(Request $request){
		
	 $dcount = DB::table('debug_users')
			   ->where('user_id', $request->user_id)				
			   ->count();

	 if($dcount > 0){
			
		$count = DB::table('device_counterlog')
			->where('user_id', $request->user_id)
			->where('event_ts', $request->event_ts)
			->count();

		if($count > 0){
			
			return Response::json(array(
					'status'=> 'success',
					'code'  =>  403 ,
					'data'  => 'Data already exist.'
				), 403);
			
		 } else {
			 
			try {
				
				$dlogdata = new Devicelog();
				
				if(!empty($request->user_id)) $dlogdata->user_id = $request->user_id;				
				
				if(!empty($request->event_ts)){ 
				
				  $dlogdata->event_ts = !empty($request->event_ts) ? date('Y-m-d H:i:s',strtotime($request->event_ts)) : '0000-00-00 00:00:00'; 
				}
				
				if(!empty($request->device_ts)){ 
				
				  $dlogdata->device_ts = !empty($request->device_ts) ? date('Y-m-d H:i:s',strtotime($request->device_ts)) : '0000-00-00 00:00:00'; 
				}

				$dlogdata->counter_val = !empty($request->counter_val) ? $request->counter_val : '0'; 			
			
				if($dlogdata->save()){
					
					return Response::json(array(
						'status'    => 'success',
						'code'      =>  200,
						'data'   => 'Data inserted'
					), 200);
					
				} else {
					
					return Response::json(array(
						'status'    => 'error',
						'code'      =>  401,
						'data'   => 'Some technical issue'
					), 401);
				}
				
			} catch(\Exception $e){  
			
				return Response::json(array(
						'status' => 'error',
						'code'   =>  401,
						'data'   => $e->getMessage()
					), 401);
			 }				
		  }			
			
		} else {
			 
			return Response::json(array(
					'status'=> 'success',
					'code' =>  200,
					'data' => 'Not Log'
				), 200); 						
		}		
	}	
	
	public function addexceptionlog(Request $request){	
      
		$count = DB::table('debug_users')
				->where('user_id', $request->user_id)				
				->count();

		if($count > 0){
			
			try {
				
				$dlogdata = new Exceptionlog();
				
				if(!empty($request->user_id)) $dlogdata->user_id = $request->user_id;				
				
				if(!empty($request->exception_details)){ 
				
				   $dlogdata->exception_details = $request->exception_details;				  
				}
				
				if(!empty($request->exception_ts)){ 			
				   
				  $dlogdata->exception_ts = !empty($request->exception_ts) ? date('Y-m-d H:i:s',strtotime($request->exception_ts)) : date('Y-m-d H:i:s'); 
				}						 
				   
				$dlogdata->created_ts = date('Y-m-d H:i:s'); 						
			
				if($dlogdata->save()){
					
					return Response::json(array(
						'status'    => 'success',
						'code'      =>  200,
						'data'   => 'Data inserted'
					), 200);
					
				} else {
					
					return Response::json(array(
						'status'    => 'error',
						'code'      =>  401,
						'data'   => 'Some technical issue'
					), 401);
				}
				
			} catch(\Exception $e){  
			
				return Response::json(array(
						'status' => 'error',
						'code'   =>  401,
						'data'   => $e->getMessage()
					), 401);
			}		
			
		 } else {
			 
			return Response::json(array(
					'status'=> 'success',
					'code' =>  200,
					'data' => 'Not Log'
				), 200);							
		}	    		
	}
	
	function failed_login_attempts(Request $request){
		
	 try {		
		 
		 if(!empty($request->email) && filter_var($request->email,FILTER_VALIDATE_EMAIL)){
			 
				 $loginattempt = LoginAttempt::create([
					'email' => $request->email,					
					'mobile' =>  !empty($request->mobile) ? $request->mobile : '',
					'device_token' => !empty($request->device_token) ? $request->device_token : '',					
				]);	

              return Response::json(array(					
					'status'    => 'success',
					'code'      =>  200,					
					'message'   =>  array('msg'=>'Login Attempt Created Successfully')
				), 200);
				
		  } else {
			  
			 return Response::json(array(
					'status' => 'error', 'code'  =>  422, 'message'   =>  'Invalid Input'
				), 422);			  
		  }	  
			
		 } catch(Exception $e) { 
		   
			return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'message'   =>  'Unauthorized : '.$e->getmessage()
				), 404);
		}
    }

	
}