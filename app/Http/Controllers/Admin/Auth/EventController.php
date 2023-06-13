<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request,Response,Redirect;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\Event;
use App\Models\Category;
use App\Exports\EventExport;
use Excel;
use App\Models\EventCat;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use App\Models\Admin;

class EventController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}
    
    public function index(Request $request) {        

       
        $categories = EventCat::all();
        
        $states = State::all();
			
		$admins_role = Auth::user()->role_id;
		$flag=0;
		
		if($admins_role == '3')
		{
			
			$admins_state = Auth::user()->state;
			$stateadmin = State::where('id',$admins_state)->first()->name;
			$admins_state = Auth::user()->state;
			$stateadmin = State::where('id',$admins_state)->first()->name;			
			
			if(!empty($admins_state)){
				$statesid = $admins_state;
				$districts = District:: where('state_id', $statesid)->orderBy("name")->get();            
			}else{ 
				$districts = District::orderBy("name")->get();
			}

			if(!empty($admins_state) && !empty($request->district)){
				$disid = District:: where('name', 'like', $request->district)->first()->id;			
				$blocks = Block:: where('district_id', $disid)->orderBy("name")->get();
			} else{
				$blocks = Block::orderBy("name")->get();          
			} 	
		       

          if($request->input('searchdata')=='searchdata'){   
        
			$data = DB::table('events')        
				->leftJoin('users', 'users.id', '=', 'events.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')
				->select(['events.id','events.category','events.eventimage1','events.eventimage2','events.name','events.eventstartdate','events.eventenddate','events.organiser_name','events.participantnum','events.kmrun','events.user_id','users.email','usermetas.state','usermetas.district','usermetas.block','events.created_at','usermetas.mobile'])
				->where('usermetas.state', '=' ,$stateadmin);


            if($request->state){
                
               $data = $data->where('usermetas.state', 'LIKE', "%".$request->state."%");
            }
            
            if($request->district){
                
               $data = $data->where('usermetas.district', 'LIKE', "%".$request->district."%");
            }
            
            if($request->block){
                
               $data = $data->where('usermetas.block', 'LIKE', "%".$request->block."%");
            }

            if($request->category){
                
               $data = $data->where('events.category', 'LIKE', "%".$request->category."%");
            }
            
            if($request->month){
                
               $data = $data->where('events.created_at', 'LIKE', "%".$request->month."%");
            } 			
			
			$curcount = $data->count();			
			$events = $data->paginate(50);
			$flag=1;
			
            $count =  DB::table('events')        
				->leftJoin('users', 'users.id', '=', 'events.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')
				->select(['events.id','events.category','events.eventimage1','events.eventimage2','events.name','events.eventstartdate','events.eventenddate','events.organiser_name','events.participantnum','events.kmrun','events.user_id','users.email','usermetas.state','usermetas.district','usermetas.block','events.created_at','usermetas.mobile'])
				->count();  			
             
               
      } else if($request->input('search')=='Search'){            

			$data = DB::table('events')        
				->leftJoin('users', 'users.id', '=', 'events.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')
				->select(['events.id','events.category','events.eventimage1','events.eventimage2','events.name','events.eventstartdate','events.eventenddate','events.organiser_name','events.participantnum','events.kmrun','events.user_id','users.email','usermetas.state','usermetas.district','usermetas.block','events.created_at','usermetas.mobile'])
				->where('usermetas.state', '=' ,$stateadmin);

            if($request->event_name){  

              $data = $data->where('events.name', 'LIKE', "%".$request->event_name."%")->orWhere('usermetas.mobile','LIKE', "%".$request->event_name."%");
            }
			
			$curcount = $data->count();			
			$events = $data->paginate(50);
			$flag=1;
			
            $count =  DB::table('events')        
				->leftJoin('users', 'users.id', '=', 'events.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')
				->select(['events.id','events.category','events.eventimage1','events.eventimage2','events.name','events.eventstartdate','events.eventenddate','events.organiser_name','events.participantnum','events.kmrun','events.user_id','users.email','usermetas.state','usermetas.district','usermetas.block','events.created_at','usermetas.mobile'])
				->count();            
               
        } else {

			 $events = DB::table('events')        
				->leftJoin('users', 'users.id', '=', 'events.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')
				->select(['events.id','events.category','events.eventimage1','events.eventimage2','events.name','events.eventstartdate','events.eventenddate','events.organiser_name','events.participantnum','events.kmrun','events.user_id','users.email','usermetas.state','usermetas.district','usermetas.block','events.created_at','usermetas.mobile'])
				->where('usermetas.state', '=' ,$stateadmin);
				 $count = $events->count();
				 $events = $events->paginate(50);
				
				$flag=1;				
				$curcount = 0;

            }
		}
		else{		

		if(!empty($request->state)){
            $statesid = State:: where('name', 'like', '%'.$request->state.'%')->first()->id;
            $districts = District:: where('state_id', $statesid)->get();            
        }else{ 
			$districts = District::all();
		}

        if(!empty($request->state) && !empty($request->district)){
            $disid = District:: where('name', 'like', $request->district)->first()->id;			
            $blocks = Block:: where('district_id', $disid)->get();
        } else{
			$blocks = Block::all();          
		} 

        if($request->input('searchdata')=='searchdata'){   
        
			$data = DB::table('events')        
				->leftJoin('users', 'users.id', '=', 'events.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')
				->select(['events.id','events.category','events.eventimage1','events.eventimage2','events.name','events.eventstartdate','events.eventenddate','events.organiser_name','events.participantnum','events.kmrun','events.user_id','users.email','usermetas.state','usermetas.district','usermetas.block','events.created_at','usermetas.mobile']);


            if($request->state){
                
               $data = $data->where('usermetas.state', 'LIKE', "%".$request->state."%");
            }
            
            if($request->district){
                
               $data = $data->where('usermetas.district', 'LIKE', "%".$request->district."%");
            }
            
            if($request->block){
                
               $data = $data->where('usermetas.block', 'LIKE', "%".$request->block."%");
            }

            if($request->category){
                
               $data = $data->where('events.category', 'LIKE', "%".$request->category."%");
            }
            
            if($request->month){
                
               $data = $data->where('events.created_at', 'LIKE', "%".$request->month."%");
            } 
			
			
			$curcount = $data->count();			
			$events = $data->paginate(50);
			$flag=1;
			
            $count =  DB::table('events')        
				->leftJoin('users', 'users.id', '=', 'events.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')
				->select(['events.id','events.category','events.eventimage1','events.eventimage2','events.name','events.eventstartdate','events.eventenddate','events.organiser_name','events.participantnum','events.kmrun','events.user_id','users.email','usermetas.state','usermetas.district','usermetas.block','events.created_at','usermetas.mobile'])
				->count();         			
             
               
      } else if($request->input('search')=='Search'){            

			$data = DB::table('events')        
				->leftJoin('users', 'users.id', '=', 'events.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')
				->select(['events.id','events.category','events.eventimage1','events.eventimage2','events.name','events.eventstartdate','events.eventenddate','events.organiser_name','events.participantnum','events.kmrun','events.user_id','users.email','usermetas.state','usermetas.district','usermetas.block','events.created_at','usermetas.mobile']);

            if($request->event_name){  

              $data = $data->where('events.name', 'LIKE', "%".$request->event_name."%")->orWhere('usermetas.mobile','LIKE', "%".$request->event_name."%");
            }

             $curcount = $data->count();			
			 $events = $data->paginate(50);
			 $flag=1;
			
            $count =  DB::table('events')        
				->leftJoin('users', 'users.id', '=', 'events.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')
				->select(['events.id','events.category','events.eventimage1','events.eventimage2','events.name','events.eventstartdate','events.eventenddate','events.organiser_name','events.participantnum','events.kmrun','events.user_id','users.email','usermetas.state','usermetas.district','usermetas.block','events.created_at','usermetas.mobile'])
				->count();
               
        } else {

			 $events = DB::table('events')        
				->leftJoin('users', 'users.id', '=', 'events.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')
				->select(['events.id','events.category','events.eventimage1','events.eventimage2','events.name','events.eventstartdate','events.eventenddate','events.organiser_name','events.participantnum','events.kmrun','events.user_id','users.email','usermetas.state','usermetas.district','usermetas.block','events.created_at','usermetas.mobile']);
				 $count = $events->count();
				 $events = $events->paginate(50);
				 
			     $flag=0;        
				 $curcount = 0;			
			
		    }
		}	

        return view('admin.event.index',compact('events','categories','states','districts','blocks','count','admins_role','curcount','flag'));
    }

    
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eventShow($id)
    {
		
		$events =  DB::table('events')        
				->Join('users', 'users.id', '=', 'events.user_id')
				->Join('usermetas', 'usermetas.user_id', '=', 'events.user_id')
				->Join('event_cats', 'event_cats.id', '=', 'events.category')
				->select(['events.id','event_cats.name  as catname','events.eventimage1','events.eventimage2','events.name as eventname','events.eventstartdate','events.eventenddate','events.organiser_name','events.participantnum','events.participant_names','events.kmrun','events.user_id','users.email','usermetas.state','usermetas.district','usermetas.block','events.created_at','usermetas.mobile'])
				->where('events.id',$id)->first(); 
				
       return view('admin.event.show',compact('events'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editEvent($id)
    {
        
		$categories = EventCat::all();
		
		$events = Event::findOrFail($id);
		return view('admin.event.edit',compact('events','categories'));
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
		
		 $request->validate([
            'user_id' => 'required',
           // 'eventimage1' =>'required|image|mimes:jpg,png,jpg,gif,svg|max:2048',
			//'eventimage2' =>'required|image|mimes:jpg,png,jpg,gif,svg|max:2048',
            'eventstartdate' => 'required',
            'eventenddate' => 'required',
            'eventname' => 'required|between:3,120',
            'organiser_name' => 'required',
            'participantnum' => 'required|min:1|max:6',
           // 'kmrun' => 'required|numeric|min:1|max:9999999',
            
            ]);
			
		$event = Event::find($id);
		
		
		$imageName1 = NULL;
        $imageName2 = NULL;
        $year = date("Y/m"); 
        if($request->file('eventimage1'))
		{
            $imageName1 = $request->file('eventimage1')->store($year,['disk'=> 'uploads']);
            $imageName1 = url('wp-content/uploads/'.$imageName1);
        }
		if($request->file('eventimage2')){
            $imageName2 = $request->file('eventimage2')->store($year,['disk'=> 'uploads']);
            $imageName2 = url('wp-content/uploads/'.$imageName2);
        }

        

       
	

		if(!empty($imageName1)){
			$event->eventimage1 = $imageName1;
		}
		if(!empty($imageName2)){
			$event->eventimage2 = $imageName2;
		}
		$event->user_id = $request->user_id;
        $event->eventstartdate = $request->eventstartdate;
        $event->eventenddate = $request->eventenddate;
        $event->name = $request->eventname;
        $event->organiser_name = $request->organiser_name;
        $event->participantnum = $request->participantnum;
        $event->kmrun = $request->kmrun;
		if(!empty($request->participant_names)){
			$memberlist = $request->participant_names;
			$memberlist = explode(PHP_EOL, $memberlist);
			$event->participant_names =serialize($memberlist);
		}
		
		if(!empty($request->video_link)){
			$event->video = $request->video_link;
		}
		
		 
		$event->save();
        return back()->with('success','Event updated successsfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyEvent($id)
    {
        
       $event = Event::findOrFail($id);
	   $event->delete();
	   return redirect('admin/events')->with(['status' => 'success','msg' => 'successfully deleted']);
	   
    }
	public function export(Request $request)
    {
       if(request()->has('ename'))
        {
           
        return Excel::download(new EventExport,'eventlist.xlsx');
        }
      else
        {
        return Excel::download(new EventExport,'eventlist.xlsx');
        }
    }
}
