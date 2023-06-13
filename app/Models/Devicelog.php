<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Devicelog extends Model
{
    use HasFactory;
	protected $table ='device_counterlog';
	public $timestamps = true;
	
	protected $fillable = [
        'user_id',		
		'event_ts',
		'device_ts',
		'counter_val'			
    ];	
	
	public function getCreatedAtAttribute($value)
	{
		return Carbon::parse($value)->format('Y-m-d H:i:s');
	}	
	
	public function getUpdatedAtAttribute($value)
	{
		return Carbon::parse($value)->format('Y-m-d H:i:s');
	}	
}


