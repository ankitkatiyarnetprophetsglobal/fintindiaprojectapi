<?php

namespace App\Http\Controllers\v2\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\State;
Use App\Models\District;
use App\Models\Block;
use App\Models\User;
use App\Models\Usermeta;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Schoolmeta;
use App\Models\Board;
use App\Models\Chainopt;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
        

   
    public function index()
    {   $role = Auth::user()->role;
        if($role){
            $role = Role::where('slug', $role)->first()->name;
            return view('auth.dashboard', ['role' => $role ]);
        }
        return view('auth.dashboard');
    }
    public function editProfile($id)
    {
        
       
        
        $state = State::all();
        $district = District::all();
        $block = Block::all();
        
        $role = Auth::user()->role;
        if($role){
            $role = Role::where('slug', $role)->first()->name;
        }
        
		
        $result = DB::table('users')
                        
                        ->join('usermetas','users.id', '=',
                            'usermetas.user_id')
                           
                        ->select(['users.id','users.email','users.name','users.role','usermetas.user_id','usermetas.orgname','users.phone','usermetas.city','usermetas.state','usermetas.district','usermetas.block','usermetas.pincode'])
                        ->where('users.id',$id)
                        ->first();
                        
                        return view('auth/edit-profile',compact('role','state','result','district','block'));
    }

    public function update(Request $request , $id)
    {
         $request->validate([
            'name' => 'required|string',
            'user_id' => 'required',
            'phone' => 'required|digits:10',
            'pincode' => 'required|numeric',
            'state' => 'required|string',
            'district' => 'required|string',
            'block' => 'required|string',
            'city' => 'required|string',
			'captcha' => ['required', 'captcha'],
            
        ]);
        
       
        $states = State::where('id',$request->state)->first();
        $districts = District::where('id',$request->district)->first();
        $blocks = Block::where('id',$request->block)->first();
        
        
        $users  = User::find($id);
       
        $usermetas = Usermeta::where('user_id',$id)->first();
        
        
        $users->name = $request->name;
        $users->phone = $request->phone;
        
        $usermetas->pincode = $request->pincode;
        $usermetas->state = $states->name;
       
        $usermetas->district = $districts->name;
        
        $usermetas->block = $blocks->name;
        
        $usermetas->orgname = $request->orgname;
        $usermetas->city = $request->city;
        $usermetas->user_id = $request->user_id;
        $users->save();
        $usermetas->save();
        return back()->with('success','User updated successsfully');
        

 
    }
	public function schoolProfile(Request $request,$id)
	{
		
		$states = State::all();
		$boards = Board::all();
		$chainopts = Chainopt::all();
		$role = Auth::user()->role;
		//$districts = District::all();
		//$blocks = Block::all();
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
        if($role){
            $role = Role::where('slug', $role)->first()->name;
        }
		//$school = Schoolmeta::all();
		$result = DB::table('users')->leftJoin('usermetas','users.id', '=',
                            'usermetas.user_id')
                        ->leftJoin('schoolmetas','users.id', '=', 'schoolmetas.user_id') 
                        ->select(['users.id','users.email','users.name','users.role','usermetas.user_id','users.phone','usermetas.city','usermetas.state','usermetas.district','usermetas.block','usermetas.pincode'
						,'usermetas.board','usermetas.orgname','usermetas.udise','schoolmetas.affiliationnum','schoolmetas.chain','schoolmetas.region','schoolmetas.landmark','schoolmetas.students','schoolmetas.pname','schoolmetas.pmobile'])
                        ->where('users.id',$id)
                        ->first();
		return view('auth.school-profile',compact('role','boards','chainopts','states','districts','blocks','result'));
		
	}
	public function updateSchool(Request $request , $id)
	{
		

		
		$request->validate([
            'name' => 'required|string',
            'user_id' => 'required',
            
            'pincode' => 'required|numeric',
            'state' => 'required|string',
            'district' => 'required|string',
            'block' => 'required|string',
            'city' => 'required|string',
			'students' => 'required|numeric',
			'pname' => 'required',
			'pmobile' => 'required|digits:10',
			'affiliationnum' => 'required|digits:10',
			'udise' => 'required|regex:/^[\w-]*$/|min:10|max:11',
			'phone' => 'required|digits:10',
			'board' => 'required|string',
			'chain' => 'required|string',
			'region' => 'required|string',
			'landmark' => 'required|string',
			'captcha' => ['required', 'captcha'],
            
        ]);
		$states = State::where('id',$request->state)->first();
        $districts = District::where('id',$request->district)->first();
        $blocks = Block::where('id',$request->block)->first();
		$boards = Board::where('id',$request->board)->first();
		$chains = Chainopt::where('id',$request->chain)->first();
		
		$users  = User::find($id);
        
        $usermetas = Usermeta::where('user_id',$id)->first();
        $schoolmetas = Schoolmeta::where('user_id',$id)->first();
		
		if(empty($schoolmetas)){
			$schoolmetas = new Schoolmeta();
			
			$users->name = $request->name;
			$users->phone = $request->phone;
			$usermetas->pincode = $request->pincode;
			$usermetas->state = $states->name;
			
			$usermetas->district = $districts->name;
			
			$usermetas->block = $blocks->name;
		   
			$usermetas->udise = $request->udise;
			$usermetas->city = $request->city;
			$usermetas->user_id = $request->user_id;
			
			$schoolmetas->students = $request->students;
			$schoolmetas->pname = $request->pname;
			$schoolmetas->pmobile = $request->pmobile;
			$schoolmetas->landmark = $request->landmark;
			$schoolmetas->region = $request->region;
			$usermetas->board = $boards->boardname;
			$schoolmetas->chain = $chains->chainname;
			$schoolmetas->affiliationnum = $request->affiliationnum;
			$schoolmetas->user_id = $request->user_id;
			$users->save();
			$usermetas->save();
			$schoolmetas->save();
			
		}else{
			$schoolmetas->update(['students' => $request->students,'pname' => $request->pname,
			'pmobile' => $request->pmobile,
			'landmark' => $request->landmark,
			'region' => $request->region,
			'chain' => $chains->chainname,
			'affiliationnum' => $request->affiliationnum,
			'user_id' => $request->user_id,
			
			]);
		}
		return back()->with('success','School updated successsfully');
			
		
	}
    public function profileDis()
    {
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
    public function profileBlk()
    {
        $block_id = $request->id;
        $block_list = Block::where('district_id', $block_id)->get();
        $block = '<option value="">Select Block</option>';
        if(!empty($block_list)){
            foreach ($block_list as $bck) {
               $block .= '<option value="'.$bck['id'].'">'.$bck['name'].'</option>';
            }
        }
        return $block;

    }
    
    
}
