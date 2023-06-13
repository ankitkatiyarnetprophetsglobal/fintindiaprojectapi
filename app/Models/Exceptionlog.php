<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exceptionlog extends Model
{
    use HasFactory;
	protected $table ='device_exceptionlog';
	public $timestamps = false;
	
	protected $fillable = [
        'user_id',
		'exception_details',
        'exception_ts',
        'created_ts'			
    ];
}
