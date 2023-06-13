<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Champion;

class Champion extends Model
{
    use HasFactory;
	protected $table ='champions';
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
    ];
	
	
    public static function getAllChamp()
    {
            
        $result  = Champion::select('champions.name','champions.email','champions.contact','champions.designation','champions.state_name','champions.district_name','champions.block_name','champions.pincode','champions.facebook_profile','champions.facebook_profile_followers','champions.twitter_profile','champions.twitter_profile_followers','champions.instagram_profile','champions.instagram_profile_followers','champions.work_profession','champions.description',  DB::raw('(CASE WHEN champions.status = "1" THEN "Approved" WHEN champions.status = "2" THEN "Rejected" ELSE "Pending" END) AS application_status'),'champions.created_at','admins.email as uemail')
            ->leftJoin('admins', 'admins.id', '=', 'champions.updated_by')
            ->orderBy('champions.id','DESC')
            ->get();
        return $result;
    }
    public static function getAllSearch()
    {
        $search_txt = request()->input('s');
        $result = Champion::select('champions.name','champions.email','champions.contact','champions.designation','champions.state_name','champions.district_name','champions.block_name','champions.pincode','champions.facebook_profile','champions.facebook_profile_followers','champions.twitter_profile','champions.twitter_profile_followers','champions.instagram_profile','champions.instagram_profile_followers','champions.work_profession','champions.description',  DB::raw('(CASE WHEN champions.status = "1" THEN "Approved" WHEN champions.status = "2" THEN "Rejected" ELSE "Pending" END) AS application_status'),'champions.created_at','admins.email as uemail')
            ->leftJoin('admins', 'admins.id', '=', 'champions.updated_by')
            ->where('champions.email','LIKE','%'.$search_txt.'%')
            ->orWhere('champions.name','LIKE','%'.$search_txt.'%')
            ->orWhere('champions.contact','LIKE','%'.$search_txt.'%')
            ->orWhere('champions.state_name','LIKE','%'.$search_txt.'%')
            ->orWhere('champions.district_name','LIKE','%'.$search_txt.'%')
            ->orWhere('champions.block_name','LIKE','%'.$search_txt.'%')
            ->get(40);
            return $result;        
    }
}
