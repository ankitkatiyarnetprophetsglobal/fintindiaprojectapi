<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Step;
use App\Models\Challengersteps;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StepController extends Controller
{
   
  public function goal(Request $request)
    {
		$user = auth('api')->user();
        if($user){
			
			$fordate = str_replace('/','-',$request->createdOn);
			$datevar = date( "Y-m-d", strtotime($fordate) );
			$step = Step::where('user_id',$user->id)->where('for_date',$datevar)->first();
			
            if (!is_null($step) && !is_null($request->goal) ){
				$updststaus  = $step->update([
					'goal' => $request->goal,
					
				]);
				
				if($updststaus){
                    return Response::json(array(
                        'statue' => 'success',
                        'code' => 200,
                        'message' => 'Step goal sucessfully updated'
                    ), 200);
                }else{
                    return Response::json(array(
                        'statue' => 'error',
                        'code' => 200,
                        'message' => 'Step goal not updated'
                    ), 200); 
                }
				
			}else{
                    
					$fordate = str_replace('/','-',$request->createdOn);
					$datevar = date( "Y-m-d", strtotime($fordate) );
					$step = new Step();
					$step->user_id = $user->id;    
					$step->goal = $request->goal;
					$step->for_date = $datevar;
				   
					if($step->save()){
						return Response::json(array(
							'statue' => 'success',
							'code' => 200,
							'message' => 'Step goal sucessfully updated'
						), 200);
					}else{
						return Response::json(array(
							'statue' => 'error',
							'code' => 304,
							'message' => 'Step goal not updated'
						), 304); 
					}
					
					
            }
			
			
		}else{
            return Response::json(array(
                'status'    => 'error',
                'code'      =>  401,
                'message'   =>  'Unauthorized'
            ), 401);
        }	
		
	}
    public function index(Request $request)
    {	
	
		$user = auth('api')->user();
        if($user){
			
			if(!empty($request->created_on)){
					$datevar = date( "Y-m-d", strtotime($request->created_on) );
					$step = DB::table('steps')
							->select( DB::raw("id, user_id, steps, noofevent, calorie, point, speed, distance, goal, DATE_FORMAT( for_date, '%Y/%m/%d' ) as for_date" )  )
							->where('user_id',$user->id)->where( 'for_date', $datevar )
							->get();
				
				
				return Response::json(array(
						'status'    => 'success',
						'code'      =>  200,
						'message'   =>  $step
					), 200);	
					
			}else{
				$step = DB::table('steps')
							->select( DB::raw("id, user_id, steps, noofevent, calorie, point, speed, distance, goal, DATE_FORMAT( for_date,'%Y/%m/%d' ) as for_date ") )
							->where('user_id',$user->id)
							->get();
							 
				return Response::json(array(
						'status'    => 'success',
						'code'      =>  200,
						'message'   =>  $step
					), 200);
			}
		}else{
            return Response::json(array(
                'status'    => 'error',
                'code'      =>  401,
                'message'   =>  'Unauthorized'
            ), 401);
        }	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth('api')->user();
        if($user){
			
			$fordate = str_replace('/','-',$request->createdOn);
			$datevar = date( "Y-m-d", strtotime($fordate) );
			$step = Step::where('user_id',$user->id)->where('for_date',$datevar)->first();
			
            if (!is_null($step)){
				$steparr = array();
				if(!empty($request->steps)){ 	$steparr['steps'] = $request->steps; 	}
				if(!empty($request->calorie)){ $steparr['calorie'] = $request->calorie;	}
				if(!empty($request->point)){ $steparr['point'] = $request->point;	}
				if(!empty($request->speed)){ $steparr['speed'] = $request->speed;	}
				if(!empty($request->distance)){	$steparr['distance'] = $request->distance;	}
				if(!empty($request->noofevent)){ $steparr['noofevent'] = $request->noofevent;	}
				if(!empty($request->goal)){	$steparr['goal'] = $request->goal;	}
				
				$updststaus  = $step->update( $steparr );
				
				if($updststaus){
					$this->newStepStorage($user->id, $datevar, $request->steps);
                    return Response::json(array(
                        'statue' => 'success',
                        'code' => 200,
                        'message' => 'Step sucessfully updated'
                    ), 200);
                }else{
                    return Response::json(array(
                        'statue' => 'error',
                        'code' => 200,
                        'message' => 'Step not stored'
                    ), 200); 
                }
				
			}else{
				$fordate = str_replace('/','-',$request->createdOn);
				$datevar = date( "Y-m-d", strtotime($fordate) );
				$step = new Step();
                $step->user_id = $user->id;    
                $step->steps = $request->steps;
                $step->noofevent = $request->noofevent;
                $step->calorie = $request->calorie;
				$step->point = $request->point;
				$step->speed = $request->speed;
				$step->distance = $request->distance;
                $step->for_date = $datevar;
				$step->goal = $request->goal;
				

                if($step->save()){
                	$this->newStepStorage($user->id, $datevar, $request->steps);
                    return Response::json(array(
                        'statue' => 'success',
                        'code' => 200,
                        'message' => 'Step sucessfully stored'
                    ), 200);
                }else{
                    return Response::json(array(
                        'statue' => 'error',
                        'code' => 200,
                        'message' => 'Step not stored'
                    ), 200); 
                }
				
			}

		}else{
            return Response::json(array(
                'status'    => 'error',
                'code'      =>  401,
                'message'   =>  'Unauthorized'
            ), 401);
        }		
			
    }

    public function newStepStorage($user_id, $last_step_date, $steps){
    		$ch_step = DB::table('challengers_steps')->where('user_id',$user_id)->first();
		   	if(empty($ch_step)){
		 		$c_storage_step = new Challengersteps(); 
		   		$c_storage_step->user_id = $user_id;
		   		$c_storage_step->last_step_date = $last_step_date;
		   		$c_storage_step->steps = $steps;
		   		$c_storage_step->save();
		   	}else{
		    	$ch_step_exist = DB::table('challengers_steps')->where('user_id',$user_id)->whereDate('last_step_date','<=',$last_step_date)->first();
		    	if(!empty($ch_step_exist)){
			       	$c_step_update = Challengersteps::where('user_id', $user_id)->update(['last_step_date' => $last_step_date, 'steps'=> $steps]);
			    }else{
		       	}
		    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getUniqueSteps(Request $request)
    {
    		$user = auth('api')->user();
    		if($user){
	    		$id = $user->id;
	    		$unique_step = DB::table('challenge')->where('from_userid',$id)->orwhere('to_userid',$id)->get();
	    		$myids = array();
	    		if(!empty($unique_step))
	    		{
	    			foreach ($unique_step as $mysteps) 
	    			{
	    				$l1 = array_search($mysteps->to_userid, $myids, false); 
	    				if (empty($l1))
	    				{
	    					array_push($myids, $mysteps->to_userid);
	    				}

	    				$l2 = array_search($mysteps->from_userid, $myids, false); 
	    				if (empty($l2))
	    				{
	    					array_push($myids, $mysteps->from_userid);
	    				}
	    			}
	    			
	    			$new_results = array();

	    			if (!empty($myids))
	    			{
	    					$new_steps = DB::table('challengers_steps')->whereIn('user_id',$myids)->get(['user_id','steps','last_step_date']);
	    					if(!empty($new_steps))
	    					{
	    						$new_results = $new_steps;
	    					}
	    			}

	    			return Response::json(array(
	                            'status'    => 'success',
	                            'code'      =>  200,
	                            'message'   =>  $new_results
	                             ), 200);
	    		}	
    		}
	}
}
