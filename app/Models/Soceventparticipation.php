<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizTitleList;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Soceventparticipation extends Model
{
    use HasFactory;
	protected $table ='soc_event_participations';
	public $timestamps = false;


	protected $fillable = [
        'id',
        'socemid',
        'user_id',
        'uname',
        'cycle',
        'cycle_booking',
        'cycle_waiting',
        't_shirt',
        'tshart_booking',
        'tshirt_waiting',
        'meal',
        'meal_booking',
        'meal_waiting',
        'latitude',
        'longitude',
        'event_date',
        'status',
        'created_at',
        'updated_at',
    ];




}
