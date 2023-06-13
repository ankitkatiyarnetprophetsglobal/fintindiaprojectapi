<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ambassador;

class Ambassador extends Model {
   
	use HasFactory;
	protected $table ='ambassadors';
	
	protected $fillable = [
        'user_id',
        'name',
        'email',
        'contact',
        'designation',
        'state_name',
        'state_id',
        'district_name',
        'district_id',
        'block_name',
        'block_id',
        'pincode',
        'image',
        'facebook_profile',
        'facebook_profile_followers',
        'twitter_profile',
        'twitter_profile_followers',
        'instagram_profile',
        'instagram_profile_followers',
        'work_profession',
        'description',
        'status',
        'user_checker',
        'created_at'        
    ];	
	
    public static function getAllambs()
    {
            
        $result = Ambassador::select('ambassadors.name','ambassadors.email','ambassadors.contact','ambassadors.designation','ambassadors.state_name','ambassadors.district_name','ambassadors.block_name','ambassadors.pincode','ambassadors.facebook_profile','ambassadors.facebook_profile_followers','ambassadors.twitter_profile','ambassadors.twitter_profile_followers','ambassadors.instagram_profile','ambassadors.instagram_profile_followers','ambassadors.work_profession','ambassadors.description',  DB::raw('(CASE WHEN ambassadors.status = "1" THEN "Approved" WHEN ambassadors.status = "2" THEN "Rejected" ELSE "Pending" END) AS application_status'),'ambassadors.created_at','admins.email as uemail')
            ->leftJoin('admins', 'admins.id', '=', 'ambassadors.updated_by')
            ->orderBy('ambassadors.id','DESC')
            ->get();
            return $result;
    }
    public static function getAllSearch()
    {
            $search_txt = request()->input('s');
            $result =  Ambassador::select('ambassadors.name','ambassadors.email','ambassadors.contact','ambassadors.designation','ambassadors.state_name','ambassadors.district_name','ambassadors.block_name','ambassadors.pincode','ambassadors.facebook_profile','ambassadors.facebook_profile_followers','ambassadors.twitter_profile','ambassadors.twitter_profile_followers','ambassadors.instagram_profile','ambassadors.instagram_profile_followers','ambassadors.work_profession','ambassadors.description',  DB::raw('(CASE WHEN ambassadors.status = "1" THEN "Approved" WHEN ambassadors.status = "2" THEN "Rejected" ELSE "Pending" END) AS application_status'),'ambassadors.created_at','admins.email as uemail')
                ->leftJoin('admins', 'admins.id', '=', 'ambassadors.updated_by')
                ->where('ambassadors.email','LIKE','%'.$search_txt.'%')
                ->orWhere('ambassadors.name','LIKE','%'.$search_txt.'%')
                ->orWhere('ambassadors.contact','LIKE','%'.$search_txt.'%')
                ->orWhere('ambassadors.state_name','LIKE','%'.$search_txt.'%')
                ->orWhere('ambassadors.district_name','LIKE','%'.$search_txt.'%')
                ->orWhere('ambassadors.block_name','LIKE','%'.$search_txt.'%')
                ->get(40);
            return $result;        
    }
}
