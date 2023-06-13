<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request,Response,Redirect;
use App\Models\Youth;
use App\Models\YouthStatus;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection; 
use Illuminate\Support\Facades\Session;
use App\Exports\YouthExport;
use Excel;
use App\Models\Role;
use App\Models\CertQues;
use App\Models\Userkey;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use App\Models\YouthCertRequest;
use App\Models\Admin;

class YouthController extends Controller{
	
 public function index(Request $request){
	 
		$title='Youth Clubs';
		
		$states = State::all();
		$admins_role = Auth::user()->role_id;
		
		//dd($admins_role);
		
		$flag=0;

		if($admins_role == '3')
		{
			
			$admins_state = Auth::user()->state;
			
			
		    $stateadmin = State::where('id',$admins_state)->first()->name;
			$admins_state = Auth::user()->state;
			//dd($admins_state);
		    $stateadmin = State::where('id',$admins_state)->first()->name;			
			
			if(!empty($admins_state)){			
				
				$statesid = $admins_state;
				$district = District:: where('state_id', $statesid)->orderBy("name")->get();				
				//dd($district);				
			}else{ 
				$district = District::orderBy("name")->get();
			}

			if(!empty($admins_state) && !empty($request->district)){
				$disid = District:: where('name', 'like', $request->district)->first()->id;			
				$block = Block:: where('district_id', $disid)->orderBy("name")->get();
			} else{
				$block = Block::orderBy("name")->get();          
			} 
			
		    if($request->input('searchdata') == 'searchdata'){
				
             $data = DB::table('wp_youth_club_details')        
				->leftJoin('wp_youth_club_status', 'wp_youth_club_status.user_id', '=', 'wp_youth_club_details.user_id')
				->leftJoin('users', 'users.id', '=', 'wp_youth_club_details.user_id')
				->select(['users.id','users.email','users.name','wp_youth_club_details.user_id','wp_youth_club_details.cat_id','wp_youth_club_details.nameofclub','wp_youth_club_details.state','wp_youth_club_details.district','wp_youth_club_details.block','wp_youth_club_details.created','wp_youth_club_status.status'])
				->where('wp_youth_club_details.state', '=' ,$stateadmin);			
			 				
				
			if($request->state){
				
			   $data = $data->where('wp_youth_club_details.state', 'LIKE', "%".$request->state."%");
			}
			
			if($request->district){
				
			   $data = $data->where('wp_youth_club_details.district', 'LIKE', "%".$request->district."%");
			}
			
			if($request->block){
				
			   $data = $data->where('wp_youth_club_details.block', 'LIKE', "%".$request->block."%");
			}
			
			if($request->bdaymonth){
				
			   $data = $data->where('wp_youth_club_details.created', 'LIKE', "%".$request->bdaymonth."%");
			}			 
           
			
			$cyouth = $data->count();			
			$youth = $data->paginate(10);
			$flag=1;
						
			$count = DB::table('wp_youth_club_details')        
				->leftJoin('wp_youth_club_status', 'wp_youth_club_status.user_id', '=', 'wp_youth_club_details.user_id')
				->leftJoin('users', 'users.id', '=', 'wp_youth_club_details.user_id')
				->select(['users.id','users.email','users.name','wp_youth_club_details.user_id','wp_youth_club_details.cat_id','wp_youth_club_details.nameofclub','wp_youth_club_details.state','wp_youth_club_details.district','wp_youth_club_details.block','wp_youth_club_details.created','wp_youth_club_status.status'])
				->count();				
         				
		 } else if($request->input('search')=='Search'){  		 			
						
			$data = DB::table('wp_youth_club_details')        
				->leftJoin('wp_youth_club_status', 'wp_youth_club_status.user_id', '=', 'wp_youth_club_details.user_id')
				->leftJoin('users', 'users.id', '=', 'wp_youth_club_details.user_id')
				->select(['users.id','users.email','users.name','wp_youth_club_details.user_id','wp_youth_club_details.cat_id','wp_youth_club_details.nameofclub','wp_youth_club_details.state','wp_youth_club_details.district','wp_youth_club_details.block','wp_youth_club_details.created','wp_youth_club_status.status'])
				->where('wp_youth_club_details.state', '=' ,$stateadmin);

            if($request->youth_name){				
			   $data = $data->where('wp_youth_club_details.nameofclub', 'LIKE', "%".$request->youth_name."%");
			}	
            			
			$cyouth = $data->count();			
			$youth = $data->paginate(10);			
			$flag=1;
			
			$count = DB::table('wp_youth_club_details')        
				->leftJoin('wp_youth_club_status', 'wp_youth_club_status.user_id', '=', 'wp_youth_club_details.user_id')
				->leftJoin('users', 'users.id', '=', 'wp_youth_club_details.user_id')
				->select(['users.id','users.email','users.name','wp_youth_club_details.user_id','wp_youth_club_details.cat_id','wp_youth_club_details.nameofclub','wp_youth_club_details.state','wp_youth_club_details.district','wp_youth_club_details.block','wp_youth_club_details.created','wp_youth_club_status.status'])
				->count();
			
            				
            } else {    
		  
				$youth = DB::table('wp_youth_club_details')        
					->leftJoin('wp_youth_club_status', 'wp_youth_club_status.user_id', '=', 'wp_youth_club_details.user_id')
					->leftJoin('users', 'users.id', '=', 'wp_youth_club_details.user_id')
					->select(['users.id','users.email','users.name','wp_youth_club_details.user_id','wp_youth_club_details.cat_id','wp_youth_club_details.nameofclub','wp_youth_club_details.state','wp_youth_club_details.district','wp_youth_club_details.block','wp_youth_club_details.created','wp_youth_club_status.status'])
					->where('wp_youth_club_details.state', '=' ,$stateadmin);
					$count = $youth->count();
				    $youth = $youth->paginate(50);			
				
				 $cyouth = 0;
                 $flag=1;				 
			}
			
		} else {
			
			
			if(!empty($request->state)){
               $statesid = State:: where('name', 'like', '%'.$request->state.'%')->first()->id;
               $district = District:: where('state_id', $statesid)->get();            
			}else{ 
				$district = District::all();
			}

			if(!empty($request->state) && !empty($request->district)){
				$disid = District:: where('name', 'like', $request->district)->first()->id;			
				$block = Block:: where('district_id', $disid)->get();
			} else{
				$block = Block::all();          
			} 
				
			if($request->input('searchdata')== 'searchdata'){  			  
				$data = DB::table('wp_youth_club_details')        
					->leftJoin('wp_youth_club_status', 'wp_youth_club_status.user_id', '=', 'wp_youth_club_details.user_id')
					->leftJoin('users', 'users.id', '=', 'wp_youth_club_details.user_id')
					->select(['users.id','users.email','users.name','wp_youth_club_details.user_id','wp_youth_club_details.cat_id','wp_youth_club_details.nameofclub','wp_youth_club_details.state','wp_youth_club_details.district','wp_youth_club_details.block','wp_youth_club_details.created','wp_youth_club_status.status']);
				
				if($request->state){
					
				   $data = $data->where('wp_youth_club_details.state', 'LIKE', "%".$request->state."%");
				}
			
				if($request->district){
					
				   $data = $data->where('wp_youth_club_details.district', 'LIKE', "%".$request->district."%");
				}
				
				if($request->block){
					
				   $data = $data->where('wp_youth_club_details.block', 'LIKE', "%".$request->block."%");
				}
				
				if($request->bdaymonth){
					
				   $data = $data->where('wp_youth_club_details.created', 'LIKE', "%".$request->bdaymonth."%");
				}				 
           			
				$cyouth = $data->count();			
				$youth = $data->paginate(10);
				$flag=1;			
					
			  $count = DB::table('wp_youth_club_details')        
				->leftJoin('wp_youth_club_status', 'wp_youth_club_status.user_id', '=', 'wp_youth_club_details.user_id')
				->leftJoin('users', 'users.id', '=', 'wp_youth_club_details.user_id')
				->select(['users.id','users.email','users.name','wp_youth_club_details.user_id','wp_youth_club_details.cat_id','wp_youth_club_details.nameofclub','wp_youth_club_details.state','wp_youth_club_details.district','wp_youth_club_details.block','wp_youth_club_details.created','wp_youth_club_status.status'])
				->count();
				
           			
		  } else if($request->input('search')=='Search'){ 
            
			$data = DB::table('wp_youth_club_details')        
				->leftJoin('wp_youth_club_status', 'wp_youth_club_status.user_id', '=', 'wp_youth_club_details.user_id')
				->leftJoin('users', 'users.id', '=', 'wp_youth_club_details.user_id')
				->select(['users.id','users.email','users.name','wp_youth_club_details.user_id','wp_youth_club_details.cat_id','wp_youth_club_details.nameofclub','wp_youth_club_details.state','wp_youth_club_details.district','wp_youth_club_details.block','wp_youth_club_details.created','wp_youth_club_status.status'])
				->where('wp_youth_club_details.nameofclub', 'LIKE', "%".$request->youth_name."%");               
			 
			 $cyouth = $data->count();			
			 $youth = $data->paginate(10);
			 $flag=1;
			 
			 $count = DB::table('wp_youth_club_details')        
				->leftJoin('wp_youth_club_status', 'wp_youth_club_status.user_id', '=', 'wp_youth_club_details.user_id')
				->leftJoin('users', 'users.id', '=', 'wp_youth_club_details.user_id')
				->select(['users.id','users.email','users.name','wp_youth_club_details.user_id','wp_youth_club_details.cat_id','wp_youth_club_details.nameofclub','wp_youth_club_details.state','wp_youth_club_details.district','wp_youth_club_details.block','wp_youth_club_details.created','wp_youth_club_status.status'])
				->count();				 
			 			
            } else {

                $youth = DB::table('wp_youth_club_details')        
					->leftJoin('wp_youth_club_status', 'wp_youth_club_status.user_id', '=', 'wp_youth_club_details.user_id')
					->leftJoin('users', 'users.id', '=', 'wp_youth_club_details.user_id')
					->select(['users.id','users.email','users.name','wp_youth_club_details.user_id','wp_youth_club_details.cat_id','wp_youth_club_details.nameofclub','wp_youth_club_details.state','wp_youth_club_details.district','wp_youth_club_details.block','wp_youth_club_details.created','wp_youth_club_status.status']);
					$count = $youth->count();
				    $youth = $youth->paginate(50);
					
               	    $flag=0;
				    $cyouth = 0;
             }			
		 }
		 
		 //dd($district);
		 
		 		
        return view('admin.youths.index', compact('youth','title','states','district','block','count','cyouth','admins_role','flag'));
    }
	
	public function getyouthsdistrict(Request $request){		
        $state_id = $request->id;		
        $stname = $request->stname;		
				
        $district_list = District::where('state_id', $state_id)->orderby('name', 'asc')->get();
        $district = '<option value="">Select District</option>';
        if(!empty($district_list)){
            foreach ($district_list as $dist) {              
               $district .= '<option data-disname="'.$dist['id'].'" value="'.$dist['name'].'">'.$dist['name'].'</option>';
            }
        }
        return $district;
    }
    
    public function getyouthsblock(Request $request){			
      
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
	
	public function export(Request $request) {       
     
       if(request()->has('s')){
           
          return Excel::download(new YouthExport,'youthlist.xlsx');

       } 
       else if(request()->has('st'))
       {

          return Excel::download(new YouthExport,'youthlist.xlsx');

       } else  {

          return Excel::download(new YouthExport,'youthlist.xlsx');
       }
    }   

    public function create()
    {
       
    }
   
    public function store(Request $request)
    {
        
    }
   
    public function show($uid, $cid){
        $role = Auth::user()->role;		
		$roleslug = $role;
        $flags = CertQues::where('cert_cats_id',$cid)->orderBy('priority', 'asc')->get();		
		$role = Role::where('slug', $role)->first();
		$states = State::all();
		$districts = District::all();
		$blocks = Block::all();
		
		$flagdata = YouthCertRequest::where('user_id',$uid)->where('cat_id', $cid)->first();
		$flagstatusdata = YouthStatus::where('user_id', $uid)->where('cat_id', $cid)->first();  		
		
		$title='Show Youth Clubs';
		
		/*$sdata = DB::table('wp_youth_club_details')        
				->leftJoin('wp_youth_club_status', 'wp_youth_club_status.user_id', '=', 'wp_youth_club_details.user_id')
				->leftJoin('users', 'users.id', '=', 'wp_youth_club_details.user_id')
				->select(['users.id','users.email','users.name','wp_youth_club_details.user_id','wp_youth_club_details.cat_id','wp_youth_club_details.nameofclub','wp_youth_club_details.state','wp_youth_club_details.district','wp_youth_club_details.block','wp_youth_club_status.status'])
				->where('wp_youth_club_details.user_id', 'LIKE', "%".$uid."%")
				->where('wp_youth_club_details.cat_id', 'LIKE', "%".$cid."%")
		        ->paginate(50);*/

        return view('admin.youths.show',compact('title','role','roleslug','flags','states','districts','flagdata','flagstatusdata','blocks'));		
				
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
}