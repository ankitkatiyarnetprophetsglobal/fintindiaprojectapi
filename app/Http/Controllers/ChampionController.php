<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Response, Redirect;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use App\Models\Champion;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ChampionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::all();
        return view('champion',compact('states'));
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
	 
    public function ChampStore(Request $request){
	    $image = '';
        $role_slug = 'champion';
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

            $user->password = Hash::make('Champion@123');         
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
        
                $champion = Champion::create([
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
                if($champion){
                    return back()->with('success','Request to become a Fit India Champion has been submitted successfully. Please wait until your application is verified.');
                }else{
                    return back()->with('failed','Something Wrong')->withInput();
                }
            }
        } else {
            // for old user
            $check_champion = Champion::where('email', '=', $request->email)->where('status', '=', '1')->first();
            if(!empty($check_champion)){
                return back()->with('failed','You are already approved user by this email address')->withInput();
            }else{
                $check_champion2 = Champion::where('email', '=', $request->email)->where('status', '=', '2')->first();
                if(!empty($check_champion2)){
                    $check_champion3 = Champion::where('email', '=', $request->email)->where('status', '=', '0')->first();
                    if(!empty($check_champion3)){
                        return back()->with('failed','You are already registered as a Champion, Please wait until your application is verified')->withInput();
                    }else{

                        $champion = Champion::create([
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
                        if($champion){
                            return back()->with('success','Request to become a Fit India Champion has been submitted successfully. Please wait until your application is verified.');
                        }else{
                        return back()->with('failed','Something')->withInput();
                        }
                    }
                }else{
                    $check_champion4 = Champion::where('email', '=', $request->email)->where('status', '=', '0')->first();
                    if(empty($check_champion4)){
                        $champion = Champion::create([
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
                        if($champion){
                            return back()->with('success','Request to become a Fit India Champion has been submitted successfully. Please wait until your application is verified.');
                        }else{
                            return back()->with('failed','Something')->withInput();
                        }
                    }else{
                        return back()->with('failed','You are already registered as a Champion, Please wait until your application is verified')->withInput();
                    }
                }
            }
        }
        return back()->withInput();
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
		
    public function champdistrict(Request $request){       		
		$state_id = $request->id;
        $district_list = District::where('state_id', $state_id)->orderby('name', 'asc')->get();
        $district = '<option value="">Select District</option>';
        if(!empty($district_list)){
            foreach ($district_list as $dist) {
               $district .= '<option value="'.$dist['id'].'">'.$dist['name'].'</option>';
            }
        }
		
        return $district;

    }
    
    public function champblock(Request $request){		
		//dd($request);		
        $block_id = $request->id;		
		//dd($block_id);		
        $block_list = Block::where('district_id', $block_id)->get();
        $block = '<option value="">Select Block</option>';
        if(!empty($block_list)){
            foreach ($block_list as $bck) {
               $block .= '<option value="'.$bck['id'].'">'.$bck['name'].'</option>';
            }
        }
		
        return $block;
    }
    public function championList(){
        $all_champion = Champion::where('status', '1')->get();
        return view('fit-india-champions',compact('all_champion'));
    }
}
