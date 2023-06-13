<?php
namespace App\Http\Controllers\v2\Admin\Auth;
use App\Http\Controllers\Controller;
use App\Models\CertStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request,Response,Redirect;
use App\Models\CertRequest;
use App\Models\CertQues;
use App\Models\CertCat;
use App\Exports\CertExport;
use Excel;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use App\Models\User;
use App\Models\Admin;

class StarratingstatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(Request $request){        
		
		$states = State::orderBy("name")->get();
		$admins_role = Auth::user()->role_id;
		$flag = 0;	
		
		$certcats = CertCat::all();	
			
		if($admins_role == '3'){
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
		  
				$result = DB::table('wp_star_rating_status')        
				->leftJoin('users','users.id', '=', 'wp_star_rating_status.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'wp_star_rating_status.user_id')
				->select(array('wp_star_rating_status.*','users.id as userid','users.name','users.email','users.phone','users.role', 'users.rolelabel','usermetas.state','usermetas.district','usermetas.block','wp_star_rating_status.created'))
				->where('usermetas.state', '=' ,$stateadmin);
				
				if($request->state) {
				   $result = $result->where('usermetas.state', 'LIKE', "%".$request->state."%");
				}
            
				if($request->district){
					$result = $result->where('usermetas.district', 'LIKE', "%".$request->district."%");
				}
            
				if($request->block){
				   $result = $result->where('usermetas.block', 'LIKE', "%".$request->block."%");
				}				
			
				if($request->month){
					$result = $result->where('wp_star_rating_status.created', 'LIKE', "%".$request->month."%");
				}
			
				if($request->certificate){
					$result = $result->where('wp_star_rating_status.cat_id', 'LIKE', "%".$request->certificate."%");
				}
           
				$curcount = $result->count();
				$starratingstatus = $result->paginate(50);
				$flag = 1;	
				unset($result);
			
				$count = DB::table('wp_star_rating_status')        
				->leftJoin('users','users.id', '=', 'wp_star_rating_status.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'wp_star_rating_status.user_id')
				->select(array('wp_star_rating_status.*','users.id as userid','users.name','users.email','users.phone','users.role', 'users.rolelabel','usermetas.state','usermetas.district','usermetas.block','wp_star_rating_status.created'))
				->where('usermetas.state', '=' ,$stateadmin)
				->count();			  
			
			} else if($request->input('search')=='search'){
			
				$result = DB::table('wp_star_rating_status')        
					->leftJoin('users','users.id', '=', 'wp_star_rating_status.user_id')
					->leftJoin('usermetas', 'usermetas.user_id', '=', 'wp_star_rating_status.user_id')
					->select(array('wp_star_rating_status.*','users.id as userid','users.name','users.email','users.phone','users.role', 'users.rolelabel','usermetas.state','usermetas.district','usermetas.block','wp_star_rating_status.created'))
					->where('usermetas.state', '=' ,$stateadmin);
			
				if($request->name){
				   $result = $result->where('users.name', 'LIKE', "%".$request->name."%")->orWhere('users.email','LIKE',"%".$request->name."%")->orWhere('users.phone', 'LIKE', "%".$request->name."%");
				}
			
				$curcount = $result->count();
				$starratingstatus = $result->paginate(50);
				$flag = 1;	
				unset($result);
			
				 $result = DB::table('wp_star_rating_status')        
				->leftJoin('users','users.id', '=', 'wp_star_rating_status.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'wp_star_rating_status.user_id')
				->select(array('wp_star_rating_status.*','users.id as userid','users.name','users.email','users.phone','users.role','users.rolelabel','usermetas.state','usermetas.district','usermetas.block','wp_star_rating_status.created'))
				->where('usermetas.state', '=' ,$stateadmin);
				
				$count = $result->count();
				unset($result);			
		   
			} else {

			   $result = DB::table('wp_star_rating_status')        
				->leftJoin('users','users.id', '=', 'wp_star_rating_status.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'wp_star_rating_status.user_id')
				->select(array('wp_star_rating_status.*','users.id as userid','users.name','users.email','users.phone','users.role','users.rolelabel','usermetas.state','usermetas.district','usermetas.block','wp_star_rating_status.created'))
				->where('usermetas.state', '=' ,$stateadmin);
				
				$count = $result->count();		   
				$starratingstatus = $result->paginate(50);
			    $flag = 1;	
				$curcount = 0;
				unset($result);				
			}
			return view('admin.starrating.index',compact('starratingstatus', 'states', 'districts', 'blocks', 'count','certcats','admins_role','curcount','flag','stateadmin'));			

			
		}
		else {
				
			if(!empty($request->state)){
			$statesid = State:: where('name', 'like', '%'.$request->state.'%')->first()->id;
			$districts = District:: where('state_id', $statesid)->orderBy("name")->get();            
			}else{ 
				$districts = District::orderBy("name")->get();
			}

			if(!empty($request->state) && !empty($request->district)){
				$disid = District:: where('name', 'like', $request->district)->first()->id;			
				$blocks = Block:: where('district_id', $disid)->orderBy("name")->get();
			} else{
				$blocks = Block::orderBy("name")->get();          
			} 	
		
			if($request->input('searchdata')=='searchdata'){   
		  
				$result = DB::table('wp_star_rating_status')        
				->leftJoin('users','users.id', '=', 'wp_star_rating_status.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'wp_star_rating_status.user_id')
				->select(array('wp_star_rating_status.*','users.id as userid','users.name','users.email','users.phone','users.role', 'users.rolelabel','usermetas.state','usermetas.district','usermetas.block','wp_star_rating_status.created'));
			
				if($request->state) {
				   $result = $result->where('usermetas.state', 'LIKE', "%".$request->state."%");
				}
            
				if($request->district){
					$result = $result->where('usermetas.district', 'LIKE', "%".$request->district."%");
				}
            
				if($request->block){
				   $result = $result->where('usermetas.block', 'LIKE', "%".$request->block."%");
				}				
			
				if($request->month){
					$result = $result->where('wp_star_rating_status.created', 'LIKE', "%".$request->month."%");
				}
			
				if($request->certificate){
					$result = $result->where('wp_star_rating_status.cat_id', 'LIKE', "%".$request->certificate."%");
				}
           
				$curcount = $result->count();
				$starratingstatus = $result->paginate(50);
				$flag = 1;	
				unset($result);
			
				$count = DB::table('wp_star_rating_status')        
				->leftJoin('users','users.id', '=', 'wp_star_rating_status.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'wp_star_rating_status.user_id')
				->select(array('wp_star_rating_status.*','users.id as userid','users.name','users.email','users.phone','users.role', 'users.rolelabel','usermetas.state','usermetas.district','usermetas.block','wp_star_rating_status.created'))
				->count();
				  
			
			} else if($request->input('search')=='search'){
			
				$result = DB::table('wp_star_rating_status')        
					->leftJoin('users','users.id', '=', 'wp_star_rating_status.user_id')
					->leftJoin('usermetas', 'usermetas.user_id', '=', 'wp_star_rating_status.user_id')
					->select(array('wp_star_rating_status.*','users.id as userid','users.name','users.email','users.phone','users.role', 'users.rolelabel','usermetas.state','usermetas.district','usermetas.block','wp_star_rating_status.created'));
			
				if($request->name){
				   $result = $result->where('users.name', 'LIKE', "%".$request->name."%")->orWhere('users.email','LIKE',"%".$request->name."%")->orWhere('users.phone', 'LIKE', "%".$request->name."%");
				}
			
				$curcount = $result->count();
				$starratingstatus = $result->paginate(50);
				$flag = 1;	
				unset($result);
			
				 $result = DB::table('wp_star_rating_status')        
				->leftJoin('users','users.id', '=', 'wp_star_rating_status.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'wp_star_rating_status.user_id')
				->select(array('wp_star_rating_status.*','users.id as userid','users.name','users.email','users.phone','users.role','users.rolelabel','usermetas.state','usermetas.district','usermetas.block','wp_star_rating_status.created'));
				
				$count = $result->count();
				unset($result);				
		   
			} else {

			   $result = DB::table('wp_star_rating_status')        
				->leftJoin('users','users.id', '=', 'wp_star_rating_status.user_id')
				->leftJoin('usermetas', 'usermetas.user_id', '=', 'wp_star_rating_status.user_id')
				->select(array('wp_star_rating_status.*','users.id as userid','users.name','users.email','users.phone','users.role','users.rolelabel','usermetas.state','usermetas.district','usermetas.block','wp_star_rating_status.created'));
				
				$count = $result->count();		   
				$starratingstatus = $result->paginate(50);
			    $flag = 0;	
				$curcount = 0;
				unset($result); 
				
			}
				
		}

		
        return view('admin.starrating.index',compact('starratingstatus', 'states', 'districts', 'blocks', 'count','certcats','admins_role','curcount','flag'));

    }
	
	
	public function export()
     { 
        

	return Excel::download(new CertExport,'schoolcert.xlsx');

		if(request()->has('state'))
		{
			
           
          return Excel::download(new CertExport,'schoolcert.xlsx');

       } 
        else if(request()->has('name'))
       {
        

          return Excel::download(new CertExport,'schoolcert.xlsx');

       }
       else if(request()->has('dst'))
       {
		   

          return Excel::download(new CertExport,'schoolcert.xlsx');

       }
       else if(request()->has('blk'))
       {
		   

          return Excel::download(new CertExport,'schoolcert.xlsx');

       }
       else if(request()->has('month'))
       {
		   

          return Excel::download(new CertExport,'schoolcert.xlsx');

       }
	   else if(request()->has('cert'))
       {
		   

          return Excel::download(new CertExport,'schoolcert.xlsx');

       }
        else 
		{
            
          return Excel::download(new CertExport,'schoolcert.xlsx');
      
		}
}

    
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
    public function FlagRequest($cat_id,$user_id)
    {
        $flagdata = CertRequest::where('user_id',$user_id)->where('cat_id',$cat_id)->first();
        $starratingstatus = CertStatus::where('user_id',$user_id)->where('cat_id',$cat_id)->first();
        $flags = CertCat::where('id',$cat_id)->first();
		$users = User::where('users.id',$user_id)->leftJoin('usermetas','usermetas.user_id','=', 'users.id')->get(['name', 'email', 'phone', 'state','district','block']);
		$certques = CertQues::where('cert_cats_id',$cat_id)->get();

    	return view('admin.starrating.schoolflag',compact('flagdata','starratingstatus','flags', 'users', 'certques'));
    }
}
