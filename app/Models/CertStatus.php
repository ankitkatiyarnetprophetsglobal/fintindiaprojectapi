<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CertStatus extends Model
{
    use HasFactory;
    protected $table = 'wp_star_rating_status';
    public $timestamps = false;
    protected $fillable = ['user_id', 'cat_id', 'cur_status', 'status', 'created', 'updated'];
	
	
	public static function getAllCert()
    {
      
	   $starratingstatus = DB::table('wp_star_rating_status')
	   ->leftJoin('users',  'users.id', '=', 'wp_star_rating_status.user_id')
	   ->leftJoin('usermetas',  'usermetas.user_id', '=', 'wp_star_rating_status.user_id')
	   ->leftJoin('cert_cats',  'cert_cats.id', '=', 'wp_star_rating_status.cat_id')
	   ->get([ 'users.name', 'users.email', 'users.phone', 'usermetas.state', 'usermetas.district', 'usermetas.block', 'cert_cats.name as certname', 'wp_star_rating_status.status', 'wp_star_rating_status.created']);
       
 	   return $starratingstatus;    
    }
	
	
	
	public static function getAllSearch(){  


      if(request()->input('search')=='search'){   
	 			 
		$data = DB::table('wp_star_rating_status')        
		->leftJoin('users','users.id', '=', 'wp_star_rating_status.user_id')
		->leftJoin('usermetas', 'usermetas.user_id', '=', 'wp_star_rating_status.user_id')
		->leftJoin('cert_cats',  'cert_cats.id', '=', 'wp_star_rating_status.cat_id')
		->select(['users.name','users.email','users.phone','usermetas.state','usermetas.district','usermetas.block','cert_cats.name as certname', 'wp_star_rating_status.status', 'wp_star_rating_status.created']);
		 
      		if(!empty(request()->input('name'))){
			   $data = $data->where('users.name', 'LIKE', "%".request()->input('name')."%")->orWhere('users.email','LIKE',"%".request()->name."%");
			}
			
			if(!empty(request()->input('state'))){
				
			   $data = $data->where('usermetas.state', 'LIKE', "%".request()->input('state')."%");
			}
			
			if(!empty(request()->input('dst'))){
				
			   $data = $data->where('usermetas.district', 'LIKE', "%".request()->input('dst')."%");
			}

			if(!empty(request()->input('blk'))){
              
               $data = $data->where('usermetas.block', 'LIKE', "%".request()->input('blk')."%");
            }
			
			 if(!empty(request()->input('cert')))
            {
                 $data = $data->where('wp_star_rating_status.cat_id', request()->input('cert'));             
            }

            if(!empty(request()->input('month')))
            {
                 $data = $data->where('wp_star_rating_status.created', request()->input('month'));
            } 		

			$data = $data->get();			
		    return $data;
			
                  
        }
		
		//dd($result);

        //return $result;   
    }
	

    /* public static function getAllSearch(){


	  if(request()->input('search')=='search'){ 

           //dd(request());exit;	  
   
		if(!empty(request()->input('name'))){
			
	       $starratingstatus = CertStatus::leftJoin('users','users.id','=','wp_star_rating_status.user_id')
		     ->leftJoin('usermetas','usermetas.user_id', '=', 'wp_star_rating_status.user_id')
             ->where('users.name', 'LIKE', "%".request()->name."%")
             ->orWhere('users.email','LIKE',"%".request()->name."%")
             ->limit(40)->get(array('wp_star_rating_status.*','users.name','users.email','users.phone','users.role','users.rolelabel','usermetas.state','usermetas.district','usermetas.block'));              
             
              //return $starratingstatus;         
			}
   

			if(!empty(request()->input('state')))
            {
                $starratingstatus = CertStatus::leftJoin('users',  'users.id', '=', 'wp_star_rating_status.user_id')->leftJoin('usermetas',  'usermetas.user_id', '=', 'wp_star_rating_status.user_id')->where('usermetas.state', 'LIKE', "%".request()->state."%")->limit(40)->get(array('wp_star_rating_status.*', 'users.name', 'users.email', 'users.phone', 'users.role', 'users.rolelabel', 'usermetas.state', 'usermetas.district', 'usermetas.block'));
                //return $starratingstatus; 
               
            }
            
            if(!empty(request()->input('dst')))        
            {
				 $starratingstatus = CertStatus::leftJoin('users',  'users.id', '=', 'wp_star_rating_status.user_id')->leftJoin('usermetas',  'usermetas.user_id', '=', 'wp_star_rating_status.user_id')->where('usermetas.district', 'LIKE', "%".request()->district."%")->limit(40)->get(array('wp_star_rating_status.*', 'users.name', 'users.email', 'users.phone', 'users.role', 'users.rolelabel', 'usermetas.state', 'usermetas.district', 'usermetas.block'));
                //return $starratingstatus; 
               
            }
            
            if(!empty(request()->input('blk')))
            {
                $starratingstatus = CertStatus::leftJoin('users',  'users.id', '=', 'wp_star_rating_status.user_id')->leftJoin('usermetas',  'usermetas.user_id', '=', 'wp_star_rating_status.user_id')->where('usermetas.block', 'LIKE', "%".request()->block."%")->limit(40)->get(array('wp_star_rating_status.*', 'users.name', 'users.email', 'users.phone', 'users.role', 'users.rolelabel', 'usermetas.state', 'usermetas.district', 'usermetas.block'));
                
              //return $starratingstatus; 
            }

             if(!empty(request()->input('cert')))
            {
                $starratingstatus = CertStatus::leftJoin('users',  'users.id', '=', 'wp_star_rating_status.user_id')->leftJoin('usermetas',  'usermetas.user_id', '=', 'wp_star_rating_status.user_id')->where('wp_star_rating_status.cat_id', 'LIKE', "%".request()->certificate."%")->limit(40)->get(array('wp_star_rating_status.*', 'users.name', 'users.email', 'users.phone', 'users.role', 'users.rolelabel', 'usermetas.state', 'usermetas.district', 'usermetas.block'));
                
              //return $starratingstatus; 
            }

            if(!empty(request()->input('month')))
            {
                $starratingstatus = CertStatus::leftJoin('users',  'users.id', '=', 'wp_star_rating_status.user_id')->leftJoin('usermetas',  'usermetas.user_id', '=', 'wp_star_rating_status.user_id')->where('wp_star_rating_status.created', 'LIKE', "%".request()->month."%")->limit(40)->get(array('wp_star_rating_status.*', 'users.name', 'users.email', 'users.phone', 'users.role', 'users.rolelabel', 'usermetas.state', 'usermetas.district', 'usermetas.block'));
                
               //return $starratingstatus;
            } 

			//$result = $starratingstatus->get();
           // return $starratingstatus;			
	    }
		
 	   return $starratingstatus;
      //return $starratingstatus;   
	}*/
    
}
