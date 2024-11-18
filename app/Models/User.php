<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Usermeta;
use App\Models\Userverification;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone','role', 'rolelabel', 'role_id', 'password','verified','deviceid','authid','FCMToken','viamedium',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   
    public function usermeta(){
        return $this->hasOne(Usermeta::class);
    } 
	
	public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }


	public static function getAllUser(){
	  $records = DB::table('users')
		->join('usermetas','users.id', '=', 'usermetas.user_id')
		->get(['users.id','users.name','users.email','users.role','usermetas.mobile','usermetas.city','usermetas.state','usermetas.district','usermetas.block']);
		
		return $records;
	}
		
		
	public static function getAllSearch(){
		
		if(request()->input('search')=='search'){       
			$result = DB::table('users')
					->join('usermetas','users.id', '=', 'usermetas.user_id')
					->select(['users.id','users.name','users.email','users.role','usermetas.mobile','usermetas.city','usermetas.state','usermetas.district','usermetas.block']);
		

		if(!empty(request()->input('uname'))){
			
		   $result = $result->where('users.email', 'LIKE', "%".request()->input('uname')."%")
							->orWhere('users.name', 'LIKE', "%".request()->input('uname')."%")
							->orWhere('users.phone', 'LIKE', "%".request()->input('uname')."%");
		}
		
		if(!empty(request()->input('st'))){
			
		   $result = $result->where('usermetas.state', 'LIKE', "%".request()->input('st')."%");
		}
		
		
		if(!empty(request()->input('dst'))){
			
		   $result = $result->where('usermetas.district', 'LIKE', "%".request()->input('dst')."%");
		}
		if(!empty(request()->input('blk'))){
			
		   $result = $result->where('usermetas.block', 'LIKE', "%".request()->input('blk')."%");
		}
		if(!empty(request()->input('month'))){
			
		   $result = $result->where('users.created_at', 'LIKE', "%".request()->input('month')."%");
		}
		if(!empty(request()->input('role')))
          {
				$result = $result->where('users.role', 'LIKE', "%".request()->input('role')."%");   
        }
	   
		$result=$result->get(); 
	}

	 return $result;   
  }
  public function getNameAttribute($value){
    
    if($value == null){
        return 'Anonymous';
    }
    return $value;
  }

  public function verifyUser(){		 
	  return $this->hasOne(Userverification::class);
      //return $this->hasOne('App\Models\Userverification');
  } 
}