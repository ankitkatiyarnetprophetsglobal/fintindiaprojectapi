<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizTitleList;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Soceventparticipationreceive extends Model
{
    use HasFactory;
	protected $table ='soc_event_participation_receives';
	public $timestamps = false;


	protected $fillable = [
        'id',
        'socemid',
        'user_id',
        'uname',
        'cycle',
        'cycle_admin_user_id',
        't_shirt',
        'tshart_admin_user_id',
        'meal',
        'meal_admin_user_id',
        'latitude',
        'longitude',
        'event_date',
        'cycle_return',
        'cycle_return_admin_user_id',
        'status',
        'created_at',
        'updated_at',
    ];




}
