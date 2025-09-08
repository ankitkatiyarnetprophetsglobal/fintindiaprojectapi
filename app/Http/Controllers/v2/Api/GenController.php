<?php
namespace App\Http\Controllers\v2\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response;
use Illuminate\Support\Facades\Auth;
use App\Models\DeviceDetail;
use App\Models\Reward;
use App\Models\Splashscreen;
use App\Models\DietPlan;
use App\Models\GetActive;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\DB;

class GenController extends Controller
{
	public function get_active(Request $request)
    {
		$data = GetActive::all();
		
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
	}
	
	public function get_dietplan(Request $request)
    {
		$query = DB::table('dietplans');

		if(!empty($request->calorievalue)){
			
		 $query->where('calories', '<=', $request->calorievalue);
		 
		}
		
		if(!empty($request->calorievalue)){
			
		   $query->where('caloriesTo', '>', $request->calorievalue);
		}
		
		if(!empty($request->diettype)){
			
		   $query->where('dietType', '=', $request->diettype);
		}		
		
		$data = $query->get();		
		
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
	}
	
	/* public function get_dietplan(Request $request)
    {
		$data = DietPlan::all();
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
	}	 */
   
	public function devicedetail(Request $request){		
		
		try{
			
			$user_id = $request->user_id;
			// dd(is_numeric($user_id));
			if($user_id == null || $user_id == '' || is_numeric($user_id) === false){
					
				$error_code = '801';
				$error_message = 'Required User id';                
				
				return Response::json(array(
					'isSuccess' => 'false',
					'code'      => $error_code,
					'data'      => null,
					'message'   => $error_message
				), 200);    
			}

			$logdata = new DeviceDetail();
			if(!empty($request->user_id)) $logdata->user_id = $request->user_id;
			if(!empty($request->deviceType)) $logdata->deviceType = $request->deviceType;
			if(!empty($request->deviceVersion)) $logdata->deviceVersion = $request->deviceVersion;
			if(!empty($request->deviceName)) $logdata->deviceName = $request->deviceName;
			if(!empty($request->sensorPresent)) $logdata->sensorPresent = $request->sensorPresent;
			
			$logdata->logfor = 'login';
			date_default_timezone_set("Asia/Calcutta");
			$cdate = date("Y-m-d h:i:s");
			$logdata->createDate = $cdate;
			
			if($logdata->save()){
						return Response::json(array(
						'status'    => 'success',
						'code'      =>  200,
						'data'   => 'Data inserted'
					), 200);
			}else{
					return Response::json(array(
					'status'    => 'error',
					'code'      =>  401,
					'data'   => 'Some technical issue'
				), 401);
			}

		} catch (Exception $e) {
            
            $controller_name = 'GenController';
            $function_name = 'devicedetail';   
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;            
            // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);
            $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);
            
            return Response::json(array(
                'isSuccess' => 'false',
                'code'      => $error_code,
                'data'      => null,
                'message'   => $error_message
            ), 200);
        } 
	}
	
	public function getreward(Request $request)
    {	
		$data = Reward::where('user_id', $request->user_id)->get();
		
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
	
	public function createreward(Request $request)
    {		
		try{
			$logdata = new Reward();
			if(!empty($request->user_id)) $logdata->user_id = $request->user_id;
			//if(!empty($request->steps)) $logdata->steps = $request->steps;
			//if(!empty($request->stepgoal)) $logdata->stepgoal = $request->stepgoal;
			if(!empty($request->archived)) $logdata->archived = $request->archived;
			//if(!empty($request->points)) $logdata->points = $request->points;
			//if(!empty($request->mtime)) $logdata->mtime = $request->mtime;
			if(!empty($request->type)) $logdata->type = $request->type;
			
			if(!empty($request->createDate)){ 
				$logdata->createDate = $request->createDate;
			}else{ 
				date_default_timezone_set("Asia/Calcutta");
				$cdate = date("Y-m-d");
			
				$logdata->createDate = $cdate;
			}
			
			###################Nagendra##############################
				
			$logdata->steps = (!empty($request->steps) ? $request->steps : '0');
			
			$logdata->stepgoal = (!empty($request->stepgoal) ? $request->stepgoal : '0');
			
			$logdata->points = (!empty($request->points) ? $request->points : '0');		
			
			if(!empty($request->mtime)){ 
			
			  $logdata->mtime =  date('Y-m-d H:i:s',strtotime($request->mtime));
			}
			
			if(!empty($request->rewardDate)) $logdata->rewardDate = $request->rewardDate;

            ###################Nagendra##############################			
		
			if($logdata->save()){
				return Response::json(array(
					'status'    => 'success',
					'code'      =>  200,
					'data'   => 'Data inserted'
				), 200);
			}else{
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  401,
					'data'   => 'Some technical issue'
				), 401);
			}
			
		} catch (\Exception $e) {
            
			return Response::json(array(
					'status'    => 'error',
					'code'      =>  401,
					'data'   => $e->getMessage()
				), 401);
        }
					
		
		
	}

	public function splash_screen_slider(Request $request){
		
        $data = Splashscreen::
                    where([
                        ['type','=' , $request->type],
                        ['status','=' , 1]
                        ])
                    ->orderBy('order', 'DESC')
                    ->select(['name','type','landing_url','banner_url','start_from','end_to','order'])
                    ->get();


        if($data->count() > 0){
				return Response::json(array(
					'taketest'    => 0, // 0 is running mssql and 1 in not running mssql
					'status'    => 'success',
					'code'      =>  200,
					'message'   =>  null,
                    'data'      => $data,
				), 200);
			}else{
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  401,
                    'message'   =>  'Data not found',
					'data'   => null,
				), 401);
			}

    }
}
