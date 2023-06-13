<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Response, Redirect;
use App\Models\Ambassador;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;


class AmbassadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */	 
	 
    /* public function sendemail(Request $request){
	   
	   $data = array(
	   
        'name' => "Learning Laravel",
       );

		Mail::send('emails.mytestmail', $data, function ($message){
			$message->from('yourEmail@domain.com', 'Learning Laravel');
			$message->to('nagendragupta85@gmail.com')->subject('Learning Laravel test email');
		});

		return "Your email has been sent successfully";		
	} */	
	
    public function index()
    {
        $states = State::all();
        return view('ambassador',compact('states'));
    }

    
    public function create()
    {
        
    }
    
    public function Store(Request $request){ 
	    $image = '';
	    $role_slug = 'smambassador';
        $year = date("Y/m");
		$request->validate([
            'name' => 'required|string|regex:/(^[a-zA-Z ]+$)+/',
            'email' => 'required|email|string|max:255',
            'contact' => 'required|numeric|digits:10',
            'designation' => 'required|string|regex:/(^[a-zA-Z ]+$)+/',
            'state_name' => 'required|string',
            'district_name' =>'required|string',
            'block_name' => 'required|string',            
            'pincode' => 'required|numeric|digits:6',
            'image' => 'required|image|mimes:jpg,png,gif,svg|max:1024',
            'facebook_profile' => 'required|string',
            'facebook_profile_followers' => 'required|numeric|digits_between:2,7',
            'twitter_profile' => 'required|string',
            'twitter_profile_followers' => 'required|numeric|digits_between:2,7',
            'instagram_profile' => 'required|string',
            'instagram_profile_followers' => 'required|numeric|digits_between:2,7',
            'work_profession' => 'required',
            'description' => 'required',
            'declaration' => 'required'
        ]);

        if($request->file('image'))
        {
            $image = $request->file('image')->store($year,['disk'=>'uploads']);
            $image = url('wp-content/uploads/'.$image);
        }
		
        $state = State::where('id', $request->state_name)->first();
        $district = District::where('id', $request->district_name)->first();
        $block = Block::where('id', $request->block_name)->first();
		
		$user = User::where('email', '=', $request->email)->first();
		$get_role = Role::where('slug', '=', $role_slug)->first();
		
		if(empty($user)){
			$user = new User();			
			$user->name = $request->name;
			$user->email = $request->email;
			$user->phone = $request->contact;
			$user->role =   $get_role->slug;
			$user->rolelabel = $get_role->name;
			$user->role_id = $get_role->id;

			$user->password = Hash::make('Ambassador@123');			
			if($user->save()){		
			// for new user	
			    $usermeta = new Usermeta();
				$usermeta->user_id = $user->id;
				$usermeta->state = $request->state;
				$usermeta->district = $request->district;
				$usermeta->block = $request->block;
				$usermeta->pincode = $request->pincode;   
				$usermeta->orgname = $get_role->name;		
				$usermeta->save();
		
				$ambassador = Ambassador::create([
					'user_id' => $user->id,
					'name' => $request->name,
					'email' => $request->email,
					'contact' => $request->contact,
					'designation' => $request->designation,
					'state_name' => $state->name,
					'state_id' => $request->state_name,
					'district_name' => $district->name,
					'district_id' => $request->district_name,
					'block_name' => $block->name,
					'block_id' => $request->block_name,
					'pincode' => $request->pincode,
					'image' => $image,
					'facebook_profile' => $request->facebook_profile,
					'facebook_profile_followers' => $request->facebook_profile_followers,
					'twitter_profile' => $request->twitter_profile,
					'twitter_profile_followers' => $request->twitter_profile_followers,
					'instagram_profile' => $request->instagram_profile,
					'instagram_profile_followers' => $request->instagram_profile_followers,
					'work_profession' => $request->work_profession,
					'description' => $request->description,	
					'user_checker' => '1',				
				]);	
				if($ambassador){
					return back()->with('success','Request to become a Fit India Ambassador has been submitted successfully. Please wait until your application is verified.');
				}else{
					return back()->with('failed','Something Wrong')->withInput();
				}
			}
		} else {
			// for old user
			$check_ambassador = Ambassador::where('email', '=', $request->email)->where('status', '=', '1')->first();
			if(!empty($check_ambassador)){
				return back()->with('failed','You are already approved user by this email address')->withInput();
			}else{
				$check_ambassador2 = Ambassador::where('email', '=', $request->email)->where('status', '=', '2')->first();
				if(!empty($check_ambassador2)){
					$check_ambassador3 = Ambassador::where('email', '=', $request->email)->where('status', '=', '0')->first();
					if(!empty($check_ambassador3)){
						return back()->with('failed','You are already registered as a ambassador, Please wait until your application is verified')->withInput();
					}else{

						$ambassador = Ambassador::create([
						'user_id' => @$user->id,
						'name' => $request->name,
						'email' => $request->email,
						'contact' => $request->contact,
						'designation' => $request->designation,
						'state_name' => $state->name,
						'state_id' => $request->state_name,
						'district_name' => $district->name,
						'district_id' => $request->district_name,
						'block_name' => $block->name,
						'block_id' => $request->block_name,
						'pincode' => $request->pincode,
						'image' => $image,
						'facebook_profile' => $request->facebook_profile,
						'facebook_profile_followers' => $request->facebook_profile_followers,
						'twitter_profile' => $request->twitter_profile,
						'twitter_profile_followers' => $request->twitter_profile_followers,
						'instagram_profile' => $request->instagram_profile,
						'instagram_profile_followers' => $request->instagram_profile_followers,
						'work_profession' => $request->work_profession,
						'description' => $request->description,
						'user_checker' => '0',					
						]);
						if($ambassador){
							return back()->with('success','Request to become a Fit India Ambassador has been submitted successfully. Please wait until your application is verified.');
						}else{
							return back()->with('failed','Something')->withInput();
						}
					}
				}else{
					$check_ambassador4 = Ambassador::where('email', '=', $request->email)->where('status', '=', '0')->first();
					if(empty($check_ambassador4)){
						$ambassador = Ambassador::create([
						'user_id' => @$user->id,
						'name' => $request->name,
						'email' => $request->email,
						'contact' => $request->contact,
						'designation' => $request->designation,
						'state_name' => $state->name,
						'state_id' => $request->state_name,
						'district_name' => $district->name,
						'district_id' => $request->district_name,
						'block_name' => $block->name,
						'block_id' => $request->block_name,
						'pincode' => $request->pincode,
						'image' => $image,
						'facebook_profile' => $request->facebook_profile,
						'facebook_profile_followers' => $request->facebook_profile_followers,
						'twitter_profile' => $request->twitter_profile,
						'twitter_profile_followers' => $request->twitter_profile_followers,
						'instagram_profile' => $request->instagram_profile,
						'instagram_profile_followers' => $request->instagram_profile_followers,
						'work_profession' => $request->work_profession,
						'description' => $request->description,
						'user_checker' => '0',					
						]);
						if($ambassador){
							return back()->with('success','Request to become a Fit India Ambassador has been submitted successfully. Please wait until your application is verified.');
						}else{
							return back()->with('failed','Something')->withInput();
						}
					}else{
						return back()->with('failed','You are already registered as a ambassador, Please wait until your application is verified')->withInput();
					}
				}
			}
		}
		return back()->withInput();
	}

    public function show($id)
    {
      
    }
   
    public function edit($id)
    {
        
    }
    
    public function update(Request $request, $id)
    {
       
    }
   
    public function destroy($id)
    {
        
    }
    public function getDistrict(Request $request)
    {
        
        $state_id = $request->id;

        $district_list = District::where('state_id', $state_id)->orderby('name', 'asc')->get();
        $district = '<option value="">Select District</option>';
        if(!empty($district_list)){
            foreach ($district_list as $dist) {
               $district .= '<option value="'.$dist['name'].'">'.$dist['name'].'</option>';
            }
        }
        return $district;

    }
    
    public function getBlock(Request $request){
        $block_id = $request->id;
        $block_list = Block::where('district_id', $block_id)->get();
        $block = '<option value="">Select Block</option>';
        if(!empty($block_list))
        {
            foreach ($block_list as $bck)
             {
               $block .= '<option value="'.$bck['name'].'">'.$bck['name'].'</option>';
            }
        }
        return $block;

    }
    public function ambassadorList(){
    	$all_ambassador = Ambassador::where('status', '1')->get();
    	return view('fit-india-ambassador',compact('all_ambassador'));
    }
    
}