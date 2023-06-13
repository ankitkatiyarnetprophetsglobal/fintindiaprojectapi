<?php
namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use Illuminate\Http\Request,Response,Redirect;
use App\Models\Youth;
use App\Models\YouthStatus;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection; 
use Illuminate\Support\Facades\Session;
use App\Exports\YouthExport;
use Excel;
use App\Models\State;
use App\Models\District;
use App\Models\Block;


class YouthController extends Controller
{
	
public function index(Request $request) {
    //$youth = Youth::limit(1000)->get(); 		
    $title='Youth Clubs';
	$states = State::all();
	$district = District::all();
	$block = Block::all();	

    //dd($request);		
	   
   //DB::enableQueryLog();	  
	
	if($request->input('searchdata')=='searchdata')
	{	
		
	  $data = DB::table('wp_youth_club_details')        
		->leftJoin('wp_youth_club_status', 'wp_youth_club_status.user_id', '=', 'wp_youth_club_details.user_id')
		->leftJoin('users', 'users.id', '=', 'wp_youth_club_details.user_id')
		->select(['users.id','users.email','users.name','wp_youth_club_details.user_id','wp_youth_club_details.cat_id','wp_youth_club_details.nameofclub','wp_youth_club_details.state','wp_youth_club_details.district','wp_youth_club_details.block','wp_youth_club_status.status']);


			if($request->state){
				
			   $data = $data->where('wp_youth_club_details.state', 'LIKE', "%".$request->state."%");
			}
			
			if($request->district){
				
			   $data = $data->where('wp_youth_club_details.district', 'LIKE', "%".$request->district."%");
			}
			
			if($request->block){
				
			   $data = $data->where('wp_youth_club_details.block', 'LIKE', "%".$request->block."%");
			}
		   
			$youth=$data->paginate(50);			
               
    } else if($request->input('search')=='search'){ 
			
	  $data=DB::table('wp_youth_club_details')        
		->leftJoin('wp_youth_club_status', 'wp_youth_club_status.user_id', '=', 'wp_youth_club_details.user_id')
		->leftJoin('users', 'users.id', '=', 'wp_youth_club_details.user_id')
		->select(['users.id','users.email','users.name','wp_youth_club_details.user_id','wp_youth_club_details.cat_id','wp_youth_club_details.nameofclub','wp_youth_club_details.state','wp_youth_club_details.district','wp_youth_club_details.block','wp_youth_club_status.status']);
				//->paginate(50); 
				
			if($request->youth_name){				
			   $data = $data->where('wp_youth_club_details.nameofclub', 'LIKE', "%".$request->youth_name."%");
			}
			
			$youth=$data->paginate(50);	
		
		
        } else { 
		
$youth = DB::table('wp_youth_club_details')        
->leftJoin('wp_youth_club_status', 'wp_youth_club_status.user_id', '=', 'wp_youth_club_details.user_id')
->leftJoin('users', 'users.id', '=', 'wp_youth_club_details.user_id')
->select(['users.id','users.email','users.name','wp_youth_club_details.user_id','wp_youth_club_details.cat_id','wp_youth_club_details.nameofclub','wp_youth_club_details.state','wp_youth_club_details.district','wp_youth_club_details.block','wp_youth_club_status.status'])
   ->paginate(50);   	   
		} 
		
		//dd(DB::getQueryLog()); 	   
    		
        return view('admin.youths.index', compact('youth','title','states','district','block'));			
    }	
	
	public function getyouthsdistrict(Request $request){  

	  //dd($request);
	
        $state_id = $request->id;		
        $stname = $request->stname;		
		//dd($state_id);
		
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
	  
      //dd($block_id);
	  
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
        		
		//DB::enableQueryLog();	  
		
		$title='Show Youth Clubs';
		
		$sdata = DB::table('wp_youth_club_details')        
				->leftJoin('wp_youth_club_status', 'wp_youth_club_status.user_id', '=', 'wp_youth_club_details.user_id')
				->leftJoin('users', 'users.id', '=', 'wp_youth_club_details.user_id')
				->select(['users.id','users.email','users.name','wp_youth_club_details.user_id','wp_youth_club_details.cat_id','wp_youth_club_details.nameofclub','wp_youth_club_details.state','wp_youth_club_details.district','wp_youth_club_details.block','wp_youth_club_status.status'])
				->where('wp_youth_club_details.user_id', 'LIKE', "%".$uid."%")
				->where('wp_youth_club_details.cat_id', 'LIKE', "%".$cid."%")
		        ->paginate(50);  
		
		//dd(DB::getQueryLog()); 	
		
		return view('admin.youths.show', compact('title','sdata'));
    }

}
