<?php
namespace App\Http\Controllers\v2\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request,Response,Redirect;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use App\Exports\UserExport;
use Excel;
use PDF;
use App\Models\Admin;
use App\Models\Role;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}
    
    public function index(Request $request){
		
		$states = State::all();
		$roles = Role::all();
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
			
		    if($request->input('searchdata') == 'searchdata'){      	
			  $user = DB::table('users')
				->join('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id','users.name','users.email','users.role','users.phone','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at'])
				->where('usermetas.state', '=' ,$stateadmin);
				
				 
            if(!empty($request->state))
            {
				$user = $user->where('usermetas.state', 'LIKE', "%".$request->state."%");
            }
            
            if($request->district)
            {
				$user = $user->where('usermetas.district', 'LIKE', "%".$request->district."%");
			}
            
            if($request->block)
            {
				$user = $user->where('usermetas.block', 'LIKE', "%".$request->block."%");   
            }
			
            if($request->month)
            {
				$user = $user->where('users.created_at', 'LIKE', "%".$request->month."%");
			}
			if($request->role)
            {
				$user = $user->where('users.role', 'LIKE', "%".$request->role."%");   
            }
			
			$curcount = $user->count();			
			$user = $user->paginate(50);
			$flag=1;
			
            $count =  DB::table('users')
				->join('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id','users.name','users.email','users.role','users.phone','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at'])
				->where('usermetas.state', '=' ,$stateadmin)
				->count();
			
		 } else if($request->input('search')=='search'){
			$user = DB::table('users')
					->join('usermetas','users.id', '=',	'usermetas.user_id')
					->select(['users.id','users.name','users.email','users.role','users.phone','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at'])
					->where('usermetas.state', '=' ,$stateadmin);
				
				

            if($request->user_name){  
					$user = $user->where('users.email', 'LIKE', "%".$request->user_name."%")
								->orWhere('users.name', 'LIKE', "%".$request->user_name."%")
								->orWhere('users.phone', 'LIKE', "%".$request->user_name."%");
              
            }
			
			$curcount = $user->count();			
			$user = $user->paginate(50);
			$flag=1;
			
            $count =  DB::table('users')
				->join('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id','users.name','users.email','users.role','users.phone','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at'])
				->count();
				
            } else {    
		  
				$user = DB::table('users')
				->join('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id','users.name','users.email','users.role','users.phone','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at'])
				->where('usermetas.state', '=' ,$stateadmin);
				$count = $user->count();
				$user = $user->paginate(50);				
				$flag=1;	
				$curcount = 0;
            }
			
		} else {
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
				
			if($request->input('searchdata')== 'searchdata'){     
     	
			  $user = DB::table('users')
				->join('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id','users.name','users.email','users.role','users.phone','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at']);
				
				 
            if(!empty($request->state))
            {
				$user = $user->where('usermetas.state', 'LIKE', "%".$request->state."%");
            }
            
            if($request->district)
            {
				$user = $user->where('usermetas.district', 'LIKE', "%".$request->district."%");
			}
            
            if($request->block)
            {
				$user = $user->where('usermetas.block', 'LIKE', "%".$request->block."%");   
            }
			if($request->role)
            {
				$user = $user->where('users.role', 'LIKE', "%".$request->role."%");   
            }
			
            if($request->month)
            {
				$user = $user->where('users.created_at', 'LIKE', "%".$request->month."%");
			}
			
			$curcount = $user->count();			
			$user = $user->paginate(50);
			$flag=1;
			
            $count =  DB::table('users')
				->join('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id','users.name','users.email','users.role','users.phone','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at'])
				->count();
			
		  } else if($request->input('search')=='search'){ 
            
             $user = DB::table('users')
				->join('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id','users.name','users.email','users.role','users.phone','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at'])
				->where('users.email', 'LIKE', "%".$request->user_name."%")
                ->orWhere('users.name', 'LIKE', "%".$request->user_name."%")
				->orWhere('users.phone', 'LIKE', "%".$request->user_name."%");
				
				$curcount = $user->count();				
				$user = $user->paginate(50);              
                $flag=1;
				
				$count =  DB::table('users')
				->join('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id','users.name','users.email','users.role','users.phone','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at'])
				->count();
			
            } else { 
        
				$user = DB::table('users')
				->join('usermetas','users.id', '=',	'usermetas.user_id')
				->select(['users.id','users.name','users.email','users.role','users.phone','usermetas.city','usermetas.state','usermetas.district','usermetas.block','users.created_at']);
				$count = $user->count();
				$user = $user->paginate(50);
				$flag=0;
				$curcount = 0;
             }			
		 }
			
         return view('admin.user.index', compact('user','states','districts','blocks','count','admins_role','curcount','flag','roles'));
    }         


    public function show($id)
    {
       
    }
    
    public function editUser($id){    
        $state = State::all();
        $district = District::all();
        $block = Block::all();        
        $role = User::where('id', $id)->first();
        //print_r($id);
        //exit();
       
        $result = DB::table('users')                        
				->join('usermetas','users.id', '=','usermetas.user_id')                           
				->select(['users.id','users.email','users.name','usermetas.user_id','users.phone','usermetas.city','usermetas.state','usermetas.district','usermetas.block','usermetas.pincode'])
				->where('users.id',$id)
				->first();                   
                        
               return view('admin.user.edit',compact('state','result','district','block'));
    }
    
    public function update(Request $request , $id){
         $request->validate([
            'name' => 'required|string',
            'user_id' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'state' => 'required|string',
            'district' => 'required|string',
            'block' => 'required|string',
            'city' => 'required|string',
            
        ]);
        
       
        $states = State::where('id',$request->state)->first();
        $districts = District::where('id',$request->district)->first();
        $blocks = Block::where('id',$request->block)->first();
        
        
        $users  = User::find($id);
        //dd($users);
        $usermetas = Usermeta::where('user_id',$id)->first();
        //dd($usermetas);
        
        $users->name = $request->name;
        $users->phone = $request->phone;
        $users->email = $request->email;
        
        $usermetas->pincode = $request->pincode;
        $usermetas->state = $states->name;
        //$usermetas->state_id = $states->id;
        $usermetas->district = $districts->name;
        //$usermetas->district_id = $districts->id;
        $usermetas->block = $blocks->name;
        //$usermetas->block_id = $blocks->id;
        $usermetas->orgname = $request->organisationname;
        $usermetas->city = $request->city;
        $usermetas->user_id = $request->user_id;
        $users->save();
        $usermetas->save();
        return redirect('admin/users')->with('success','User updated successsfully');
        

 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyUser($id,$uid)
    {
        
        $user = User::findOrFail($id);
        //$usermeta = Usermeta::where('user_id',$uid)->first();
        
        
	   $user->usermeta()->delete();
       //$usermeta->usermeta()->delete();
	   return redirect('admin/users')->with(['status' => 'success','msg' => 'successfully deleted']);
    }


	 public function userExport()
    {

        if(request()->has('uname'))
        {
           
           
            
           
          return Excel::download(new UserExport,'userlist.xlsx');

       }
        else if(request()->has('st'))
       {


          return Excel::download(new UserExport,'userlist.xlsx');

       }
       else if(request()->has('dst'))
       {



          return Excel::download(new UserExport,'userlist.xlsx');

       }
       else if(request()->has('blk'))
       {


          return Excel::download(new UserExport,'userlist.xlsx');

       }
       else if(request()->has('month'))
       {



          return Excel::download(new UserExport,'userlist.xlsx');

       }
	   else if(request()->has('role'))
       {



          return Excel::download(new UserExport,'userlist.xlsx');

       }
       
        else
         {

          return Excel::download(new UserExport,'userlist.xlsx');
       }

        

    }
	 public function createPDF()
	 {
      
				$result = DB::table('users')
                        ->join('usermetas','users.id', '=',
                            'usermetas.user_id')
                        ->get(['users.id','users.email','users.name','users.role','usermetas.mobile','usermetas.city','usermetas.state','usermetas.district','usermetas.block']);

      
      
      $pdf = PDF::loadView('admin.user.index', compact('result'))->setOptions(['defaultFont' => 'sans-serif']);

      
      return $pdf->download('pdf_file.pdf');
    }
	


    public function userprofileDis()
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
    public function userprofileBlk()
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
	
	
	public function resetpassForm(){
        return view('admin.resetpassword');
    }
	public function resetPassword(Request $request)
	{
		
		
		$request->validate([
		'password' => ['required','string','min:8','max:15','regex:/[a-z]/',

        'regex:/[A-Z]/',

        'regex:/[a-z]/',

        'regex:/[0-9]/',

        'regex:/[@$!%*#?&]/','confirmed',]
		]);
		 
		Admin::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);
		return back()->with('success','Password updated successsfully');
		
	}
	
}
    












