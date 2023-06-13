<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\YouthStatus;

class Youth extends Model
{
    use HasFactory;
	
	protected $table ='wp_youth_club_details';
	public $timestamps = false;
	
	protected $fillable = [
	'user_id',
 	'cat_id',
	'created',
	'state',
	'district',
	'block',
	'noofmembers', 
	'nameofclub',
	'affiliationno', 
	'anysports',
	'anysportsmin',
	'traditionalgame',
	'traditionalgamemin',
	'walkingmin', 
	'cyclingmin', 
	'runningmin', 
	'otherpa', 
	'otherpamin',
	'motivatecommits', 
	'youthclubcommits',
	'mpname',
	'mpcontact',
	'mpphyactivity', 
	'yclubeventcommits',
	'eventname', 
	'noofparticipant', 
	'eventphoto'
	];


   public static function getAllYouth()
    {
       
	   $result = DB::table('wp_youth_club_details')        
        ->leftJoin('wp_youth_club_status', 'wp_youth_club_status.user_id', '=', 'wp_youth_club_details.user_id')
		->leftJoin('users', 'users.id', '=', 'wp_youth_club_details.user_id')
        ->select(['wp_youth_club_details.nameofclub','users.email','wp_youth_club_details.state',
        	'wp_youth_club_details.district','wp_youth_club_details.block','wp_youth_club_status.status'])->get();
       
 	   return $result;	
    
    }

   public static function getAllSearch(){  

      if(request()->input('search')=='search'){ 

	    $data = DB::table('wp_youth_club_details')        
		->leftJoin('wp_youth_club_status','wp_youth_club_status.user_id', '=', 'wp_youth_club_details.user_id')
		->leftJoin('users', 'users.id', '=', 'wp_youth_club_details.user_id')
		->select(['wp_youth_club_details.nameofclub','users.email','wp_youth_club_details.state','wp_youth_club_details.district','wp_youth_club_details.block','wp_youth_club_status.status']);
			

            if(!empty(request()->input('s'))){
				
			   $data = $data->where('wp_youth_club_details.nameofclub', 'LIKE', "%".request()->input('s')."%");
			}
			
			if(!empty(request()->input('st'))){
				
			   $data = $data->where('wp_youth_club_details.state', 'LIKE', "%".request()->input('st')."%");
			}
			
			if(!empty(request()->input('dst'))){
				
			   $data = $data->where('wp_youth_club_details.district', 'LIKE', "%".request()->input('dst')."%");
			}

			if(!empty(request()->input('dbk'))){
              
               $data = $data->where('wp_youth_club_details.block', 'LIKE', "%".request()->input('dbk')."%");
            }
		   
			$result=$data->get(); 			   
                  
        }


        return $result;   
    }  

}