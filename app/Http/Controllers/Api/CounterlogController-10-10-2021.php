<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Devicelog;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CounterlogController extends Controller
{
	public function getDevicelog(Request $request)
    {			
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
		
		$count = DB::table('device_counterlog')
				->where('user_id', $request->user_id)
				->where('event_ts', $request->event_ts)
				->count();

		if($count > 0){
			
			return Response::json(array(
					'status'=> 'success',
					'code'  =>  403,
					'data'  => 'Data already exist.'
				), 403);
			
		 } else {
			 
			try {
				
				$dlogdata = new Devicelog();
				
				if(!empty($request->user_id)) $dlogdata->user_id = $request->user_id;	
				
				//0000-00-00 00:00:00
				
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
	}
}