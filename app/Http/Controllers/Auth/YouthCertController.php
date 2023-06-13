<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response,Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Role;
use App\Models\CertQues;
use App\Models\Userkey;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use App\Models\User;
use App\Models\YouthStatus;
use App\Models\YouthCertRequest;
use PDF;


class YouthCertController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	
	
	public function updateyouthcert(Request $request)
	{
		  
		
		
		$chkerro = false;
		$validator = Validator::make([],[]);
		
		if($request->youthflagtype == 'motivate'){
			
			$mpnameflag = true;
			foreach($request->mpname as $mpname){ if(!empty($mpname) ){ $mpnameflag = false; } }
			if($mpnameflag){ $chkerro = true; $validator->errors()->add("mpname", 'Name of motivated person is required'); }
			
			$mpcontactflag = true;
			$mpcontactflagnumeric = false;
			foreach($request->mpcontact as $mpcontact){ 
				if(!empty($mpcontact) ){ 
					$mpcontactflag = false;
					if(!is_numeric($mpcontact)) {
							$mpcontactflagnumeric = true;
					}
				} 
			}
			if($mpcontactflag){ $chkerro = true; $validator->errors()->add("mpcontact", 'Motivated person contact is required'); }
			if($mpcontactflagnumeric){ $chkerro = true; $validator->errors()->add("mpcontacttype", 'Motivated person contact must be number'); }
			
			$mpphyactivityflag = true;
			foreach($request->mpphyactivity as $mpphyactivity){ if(!empty($mpphyactivity) ){ $mpphyactivityflag = false; } }
			if($mpphyactivityflag){ $chkerro = true; $validator->errors()->add("mpphyactivity", 'Physical activity/sports is required'); }
		}
		
		if($request->youthflagtype == 'event'){
			
			$eventnameflag = true;
			foreach($request->eventname as $eventname){ if(!empty($eventname) ){ $eventnameflag = false; } }
			if($eventnameflag){ $chkerro = true; $validator->errors()->add("eventname", 'Name of the event is required'); }
			
			$noofparticipantflag = true;
			$noofparticipantnumeric = false;
			foreach($request->noofparticipant as $noofparticipant){ 
				if(!empty($noofparticipant) ){ 
					$noofparticipantflag = false; 
					if(!is_numeric($noofparticipant)) {
						$noofparticipantnumeric = true;
					}
				}
			}
			if($noofparticipantflag){ $chkerro = true; $validator->errors()->add("noofparticipant", 'Number of participants is required'); }
			if($noofparticipantnumeric){ $chkerro = true; $validator->errors()->add("noofparticipanttype", 'Number of participants must be number'); }
			
			
			
		}
		
		if($chkerro){ throw new ValidationException($validator);   }
		
					$certreq = YouthCertRequest::find($request->youthuptflag);
					if($request->youthflagtype == 'motivate'){
						$certreq->mpname = serialize($request->mpname);
						$certreq->mpcontact = serialize($request->mpcontact);
						$certreq->mpphyactivity = serialize($request->mpphyactivity);
					}
					if($request->youthflagtype == 'event'){
						$certreq->eventname = serialize($request->eventname);
						$certreq->noofparticipant = serialize($request->noofparticipant);
						//$certreq->eventphoto = serialize($imgurl);
					}
					
                    if( $certreq->save() ) {
						return back()->with('success','Request added successsfully');
                    }else {
                        return back()->with('error','Request not added successsfully');
                    }
		
					
					
		
	}
	
	
	public function storeyouthcert(Request $request)
	{	
		$rules = [
			'state' => 'required',
			'district' => 'required',
			'block' => 'required',
			'noofmembers' => 'required|numeric|min:1|max:1000',
			'nameofclub' => 'required|min:2|regex:/(^[A-Za-z ]+$)+/',
			'affiliationno' => 'required|min:3',
			'anysports' => 'required_with:anysportsmin',
			'anysportsmin' => 'required_with:anysports',
			'traditionalgame' => 'required_with:traditionalgamemin',
			'traditionalgamemin' => 'required_with:traditionalgame',
			//'walkingmin' => 'required|numeric|min:1',					
			//'cyclingmin' => 'required|numeric|min:1',
			//'runningmin' => 'required|numeric|min:1',
			'otherpa' => 'required_with:otherpamin',
			'otherpamin' => 'required_with:otherpa',
			'motivatecommits' => 'required',
			'youthclubcommits' => 'required',
			'mpname' => 'required|array',
			'mpcontact' => 'required|array',
			'mpphyactivity' => 'required|array',
			//'mpname.*'  => 'required|regex:/(^[A-Za-z ]+$)+/|min:2',
			//'mpcontact.*' => 'required|regex:/(^[0-9]+$)+/|min:10',
			//'mpphyactivity.*' => 'required|regex:/(^[A-Za-z ]+$)+/|min:2',
			'yclubeventcommits' => 'required',
			'eventname' => 'required|array',
			'noofparticipant' => 'required|array',
			//'eventname.*'  => 'required|regex:/(^[A-Za-z0-9 ]+$)+/|min:2',
			//'noofparticipant.*' => 'required|numeric|min:1',
			'eventphoto' => 'required|array',
			//'eventphoto.*' => 'required|mimes:jpg,jpeg,png|max:2000',
        ];

       $messages = [ 
			'anysports.required_with' => 'Any Sports is required',
			'anysportsmin.required_with' => 'Any Sports minutes is required',
			'traditionalgame.required_with' => 'Traditional Game is required',
			'traditionalgamemin.required_with' => 'Traditional Game minutes is required',
			'otherpa.required_with' => 'Any other physical activity is required',
			'otherpamin.required_with' => 'Any other physical activity minutes is required',
			'mpname.required' => 'Name of motivated person is required',
			'mpcontact.required' => 'Contact number is required',
			'mpphyactivity.required' => 'Physical activity/sports is required',
			'mpname.*.required' => 'Name of motivated person is required',
			'mpname.*.regex' => 'Name of motivated person must contain letter only',
			'mpcontact.*.required' => 'Contact number is required',
			'mpcontact.*.regex' => 'Contact number must contain numbers only',
			'mpcontact.*.min' => 'Contact number must contain 10 numbers',
			'mpphyactivity.*.required' => 'Physical activity/sports is required',
			'mpphyactivity.*.regex' => 'Physical activity/sports must contain letter only',
			'eventname.*.required' => 'Name of the event is required',
			'eventname.*.regex' => 'Name of the event must contain letter or number only',
			'noofparticipant.*.required' => 'Number of participants is required',
			'noofparticipant.*.numeric' => 'Number of participants must contain numbers only',
			'noofparticipant.*.min' => 'Number of participants minimum 1',
			'eventphoto.required' => 'Please upload all Fit India event images',
			'eventphoto.*.required' => ' Please upload Fit India event image',
			'eventphoto.*.mimes' => 'Only jpeg, png, jpg images are allowed',
			'eventphoto.*.max' => 'Maximum allowed size for an image is 2MB',
	   ];
	   $request->validate($rules , $messages );
		
		
		$chkerro = false;
		$validator = Validator::make([],[]);
		
		
		$minsum = 0;
		$minsum += $request->anysportsmin + $request->traditionalgamemin + $request->walkingmin + $request->cyclingmin + $request->runningmin + $request->otherpamin;
		if($minsum < 30){
			$chkerro = true;
			$validator->errors()->add("eachmembermin", 'Each member of the Youth club should spend atleast 30 minutes daily for at least 5 days every week for group physical activities');
		}
		
		$mpnameflag = true;
		foreach($request->mpname as $mpname){ if(!empty($mpname) ){ $mpnameflag = false; } }
		if($mpnameflag){ $chkerro = true; $validator->errors()->add("mpname", 'Name of motivated person is required'); }
		
		$mpcontactflag = true;
		$mpcontactflagnumeric = false;
		foreach($request->mpcontact as $mpcontact){ 
			if(!empty($mpcontact) ){ 
				$mpcontactflag = false;
				if(!is_numeric($mpcontact)) {
						$mpcontactflagnumeric = true;
				}
			} 
		}
		if($mpcontactflag){ $chkerro = true; $validator->errors()->add("mpcontact", 'Motivated person contact is required'); }
		if($mpcontactflagnumeric){ $chkerro = true; $validator->errors()->add("mpcontacttype", 'Motivated person contact must be number'); }
		
		$mpphyactivityflag = true;
		foreach($request->mpphyactivity as $mpphyactivity){ if(!empty($mpphyactivity) ){ $mpphyactivityflag = false; } }
		if($mpphyactivityflag){ $chkerro = true; $validator->errors()->add("mpphyactivity", 'Physical activity/sports is required'); }
		
		$eventnameflag = true;
		foreach($request->eventname as $eventname){ if(!empty($eventname) ){ $eventnameflag = false; } }
		if($eventnameflag){ $chkerro = true; $validator->errors()->add("eventname", 'Name of the event is required'); }
		
		$noofparticipantflag = true;
		$noofparticipantnumeric = false;
		foreach($request->noofparticipant as $noofparticipant){ 
			if(!empty($noofparticipant) ){ 
				$noofparticipantflag = false; 
				if(!is_numeric($noofparticipant)) {
					$noofparticipantnumeric = true;
				}
			}
		}
		if($noofparticipantflag){ $chkerro = true; $validator->errors()->add("noofparticipant", 'Number of participants is required'); }
		if($noofparticipantnumeric){ $chkerro = true; $validator->errors()->add("noofparticipanttype", 'Number of participants must be number'); }
		
		
		if($chkerro){ throw new ValidationException($validator);   }
		
		try{

        $certstatus = new YouthStatus();
        $certstatus->user_id = $request->user_id; 
		$certstatus->cat_id  = $request->youthclubreqid;
		$certstatus->cur_status = 'awarded';
		$certstatus->status = 'awarded';
        $certstatus->created  = date('Y-m-d H:i:s');
        $certstatus->updated  = date('Y-m-d H:i:s');
        

        //$certreq = new CertRequest();

        if( $certstatus->save() ) {

		
                try{
                    $certreq = new YouthCertRequest();
                    $certreq->user_id = $request->user_id; 
                    $certreq->cat_id  = $request->youthclubreqid;
                   
					$imgurl = array();
					if($request->hasfile('eventphoto')) {
						$year = date("Y/m");
						foreach($request->file('eventphoto') as $file)
						{
							$name = $file->getClientOriginalName();
							$name = $file->store($year,['disk'=> 'uploads']);
							$name = url('wp-content/uploads/'.$name);
							$imgurl[] = $name;
						}
					}
					
                    $certreq->created  = date('Y-m-d H:i:s');
					$certreq->state = State::find($request->state)->name;
					$certreq->district = District::find($request->district)->name;
					$certreq->block = Block::find($request->block)->name;
					$certreq->noofmembers = $request->noofmembers;
					$certreq->nameofclub = $request->nameofclub;
					$certreq->affiliationno = $request->affiliationno;
					$certreq->anysports = $request->anysports;
					$certreq->anysportsmin = $request->anysportsmin;
					$certreq->traditionalgame = $request->traditionalgame;
					$certreq->traditionalgamemin = $request->traditionalgamemin;
					$certreq->walkingmin = $request->walkingmin;
					$certreq->cyclingmin = $request->cyclingmin;
					$certreq->runningmin = $request->runningmin;
					$certreq->otherpa = $request->otherpa;
					$certreq->otherpamin = $request->otherpamin;
					$certreq->motivatecommits = $request->motivatecommits;	
					$certreq->youthclubcommits = $request->youthclubcommits;
					$certreq->mpname = serialize($request->mpname);
					$certreq->mpcontact = serialize($request->mpcontact);
					$certreq->mpphyactivity = serialize($request->mpphyactivity);
					$certreq->yclubeventcommits = $request->yclubeventcommits;
					$certreq->eventname = serialize($request->eventname);
					$certreq->noofparticipant = serialize($request->noofparticipant);
					$certreq->eventphoto = serialize($imgurl);

                    if( $certreq->save() ) {

                        $userkey = new Userkey();
                        $userkey->user_id = $request->user_id;
                        $userkey->key = 'youthclubreqid';
                        $userkey->value = $request->youthclubreqid;
                        $userkey->save();
			

                        return back()->with('success','Request added successsfully');
                    }else {
                        return back()->with('error','Request not added successsfully');
                    }

                    
                } catch (\Exception $e) {
                    return back()->with('error',$e->getMessage());
                }


            return back()->with('success','Your request have submitted successfully.');
        } else {
            return back()->with('error','Your request not submitted successfully.');
        }
   
    } catch (\Exception $e) {
        return back()->with('error',$e->getMessage());
    }
	
		
	}
	
    public function index(){
        $role = Auth::user()->role;
		$roleslug = $role;
        if($role)
		{
            $appliedfor = false; 
			$currentflag = false;
            $appliedfor = Userkey::where('user_id',Auth::user()->id)->where('key','youthclubreqid')->first();
            if($appliedfor){
                if($appliedfor->value){
                    $appliedfor = $appliedfor->value;
                }
            }

            $flags = CertQues::where('cert_cats_id',12977)->orderBy('priority', 'asc')->get();
                        
            $role = Role::where('slug', $role)->first()->name;
			$states = State::all();
			$districts = District::all();
			$blocks = Block::all();
			
			if($appliedfor){
			
				if($appliedfor == 12977) {
					
					$flagdata = YouthCertRequest::where('user_id', Auth::user()->id)->where('cat_id', 12977)->first();
					$flagstatusdata = YouthStatus::where('user_id', Auth::user()->id)->where('cat_id', 12977)->first();


					return view('event.youthcert', ['role' => $role, 'roleslug'=> $roleslug, 'flags' => $flags, 'appliedfor'=> $appliedfor, 
					'flagdata' => $flagdata, 'flagstatusdata' => $flagstatusdata ,
					'states' => $states, 'districts' => $districts, 'blocks' => $blocks 
					]);
				}
	
			}else{
				return view('event.youthcert', ['role'=> $role, 'roleslug'=> $roleslug,  'flags'=> $flags, 'appliedfor'=> $appliedfor, 'states' => $states, 'districts' => $districts, 'blocks' => $blocks ]);
			}
        }

        return view('event.youthcert');

    }
	public function certYouthclub(Request $request)
	{
		
		
		$user = User::find(Auth::user()->id);
		$name = $user->name;
		
		 $pdf = PDF::loadView('youthclub-certificate',['name' => $name ])->setPaper('a4', 'portrait');
        return $pdf->stream($name.".pdf");
	}
}









