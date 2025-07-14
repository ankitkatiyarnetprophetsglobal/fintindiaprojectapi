<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizTitleList;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Challengermasters extends Model
{
    use HasFactory;
	protected $table ='challenger_masters';
	public $timestamps = false;


	protected $fillable = [
        'id',
        'name',	
        'sub_title',	
        'image',
        'start_time',
        'end_time',
        'sport_type',
        'banner_type',
        'icon',
        'description',
        'duration',
        'duration_uom',
        'goal',
        'goal_uom',
        'badge_detail',
        'reward',
        'uom',
        'title_reward',
        'title_subereward',
        'status',
        'created_at',
        'updated_at'        
    ];


  

}
