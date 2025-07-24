<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizTitleList;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Eventmasterslots extends Model
{
    use HasFactory;
	protected $table ='event_master_slots';
	public $timestamps = false;


	protected $fillable = [
        'id',
        'event_id',
        'start_from_serial_no',
        'end_to_serial_no',
        'slot_no',
        'start_from_time',
        'end_to_time',
        'status',
        'created_at',
        'updated_at',
    ];




}
