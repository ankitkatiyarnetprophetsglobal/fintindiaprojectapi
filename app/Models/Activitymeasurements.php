<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizTitleList;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Activitymeasurements extends Model
{
    use HasFactory;
	protected $table ='activitymeasurements';
	public $timestamps = false;


	protected $fillable = [
        'id',
        'measurement_type',
        'get_ready_timer',
        'get_location_interval',
        'max_speed',
        'min_speed',
        'warning_dialog_count',
        'ideal_warning_dialog_count',
        'auto_dismiss_dialog_time',
        'emulsion_factor',
        'status',
        'created_at',
        'updated_at',
    ];




}
