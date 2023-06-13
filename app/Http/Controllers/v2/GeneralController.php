<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siteoption;
use App\Models\Event;
use App\Models\EventCat;
use App\Models\Feedback;
use App\Models\State;
use App\Models\Shareyourstory;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    public function fitindschoolweek2020(){
    	return view('fit-india-school-week');
    }
	
	static public function sitecounter(){
		$vistor = Siteoption::where('key','visitors')->first();
		$vistor->increment('value');
		return $vistor->value;
	}
	
	static public function updatedon(){
		$updatedon = Siteoption::where('key','siteupdateOn')->first();
		return $updatedon->value;
	}
	
	
	
	
	public function getallEvents(Request $request)
	{
		$categories = EventCat::all();
		if($request->input('search') == 'search')
		{
			
			$events =  DB::table('events') 
				->leftJoin('users', 'users.id', '=', 'events.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')	
				->leftJoin('event_cats', 'event_cats.id', '=', 'events.category')
				->select(['events.id','event_cats.name  as catname','events.eventimage1','events.eventimage2','events.name as eventname','events.eventstartdate','users.name'])
				->where('events.category', 'LIKE', "%".$request->category."%")->paginate(40);
				$count = $events->count();
		}
		else{
		$events =  DB::table('events')        
				->Join('users', 'users.id', '=', 'events.user_id')
				
				->Join('event_cats', 'event_cats.id', '=', 'events.category')
				->select(['events.id','event_cats.name  as catname','events.eventimage1','events.eventimage2','events.name as eventname','events.eventstartdate','users.name'])->paginate(40);
		
		$count = $events->count();
		}
		return view('all-events',compact('events','categories','count'));
		}
	
	public function showEvent($id)
	{
		$events =  DB::table('events')        
				->Join('users', 'users.id', '=', 'events.user_id')
				
				->Join('event_cats', 'event_cats.id', '=', 'events.category')
				->select(['event_cats.name  as catname','events.eventimage1','events.name as eventname','users.name'])
				->where('events.id',$id)
				->first();
		return view('show-events-list',compact('events'));
	}
	
	public function showVideo(Request $request)
	{
		$categories = EventCat::all();
		if($request->input('search') == 'search')
		{
			
			$events =  DB::table('events') 
				->leftJoin('users', 'users.id', '=', 'events.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')	
				->leftJoin('event_cats', 'event_cats.id', '=', 'events.category')
				->select(['events.id','event_cats.name  as catname','events.name as eventname','events.video','users.name','usermetas.city','usermetas.state'])
				->where('events.category', 'LIKE', "%".$request->category."%")->paginate(40);
				
		}
		else{
			
		$events =  DB::table('events') 
				->leftJoin('users', 'users.id', '=', 'events.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')	
				->leftJoin('event_cats', 'event_cats.id', '=', 'events.category')
				->select(['events.id','event_cats.name  as catname','events.name as eventname','events.video','users.name','usermetas.city','usermetas.state'])->paginate(40);
		
		
		}
		return view('video-stream',compact('events','categories'));
		
		
	}
	public function getallPhotos(Request $request)
	{
		$categories = EventCat::all();
		if($request->input('search') == 'search')
		{
			
			$events =  DB::table('events') 
				->leftJoin('users', 'users.id', '=', 'events.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')	
				->leftJoin('event_cats', 'event_cats.id', '=', 'events.category')
				->select(['events.id','event_cats.name  as catname','events.name as eventname','users.name','usermetas.city','usermetas.state','events.eventimage1','events.eventimage2'])
				->where('events.category', 'LIKE', "%".$request->category."%")->paginate(40);
				
		}
		else{
		 
		$events =  DB::table('events') 
				->leftJoin('users', 'users.id', '=', 'events.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'events.user_id')	
				->leftJoin('event_cats', 'event_cats.id', '=', 'events.category')
				->select(['events.id','event_cats.name  as catname','events.name as eventname','users.name','usermetas.city','usermetas.state','events.eventimage1','events.eventimage2'])->paginate(40);
		
		
		
		}
		return view('photo-stream',compact('events','categories'));
		
		
	}
	public function feedback()
	{
		return view('feedback');
	}
	public function feedbackStore(Request $request)
	{
		$request->validate([
		'department' => 'required',
		'name' => 'required',
		'email' =>'required',
		'mobile' => 'required|digits:10',
		'feedback' => 'required',
		]);
		$feedback = new Feedback();
		$feedback->department = $request->department;
		$feedback->name = $request->name;
		$feedback->email = $request->email;
		$feedback->mobile = $request->mobile;
		$feedback->feedback = $request->feedback;
		$feedback->save();
		return back()->with('message','Thank you!!! for your response');
		
	}
	public function shareStory(Request $request)
	{
		$states = State::all();
		return view('your-story',compact('states'));
		
	}
	public function saveStory(Request $request)
	{
		 
		$image = '';
        $year = date("Y/m"); 
        if($request->file('image'))
        {
            $image = $request->file('image')->store($year,['disk'=> 'uploads']);
            $image = url('wp-content/uploads/'.$image);
        }
        $request->validate([
            'youare' => 'required|string|min:3|max:255',
            'designation' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255',
            'fullname' => 'required|string|min:3|max:255',
            
			'state' => 'required',
            'title' => 'required|string|min:3|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'story' => 'required|string|min:3|max:255',
			'captcha' => ['required', 'captcha'],
        ]);
         
        $yourstory = new Shareyourstory;
        $yourstory->youare = $request->youare;
        $yourstory->designation = $request->designation;
        $yourstory->email = $request->email;
        $yourstory->fullname = $request->fullname;
        $yourstory->videourl = $request->videourl;
        $yourstory->title = $request->title;
        $yourstory->image = $request->image;
        $yourstory->story = $request->story;
		$yourstory->state = $request->state;
        $yourstory->save();
        return back()->with('message',"Insert successfully");
	}
	
}
