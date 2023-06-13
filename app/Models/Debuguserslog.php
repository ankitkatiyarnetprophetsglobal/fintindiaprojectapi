<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debuguserslog extends Model
{
    use HasFactory;
	protected $table ='debug_users';
	public $timestamps = false;
	
	protected $fillable = [
        'user_id',
		'created_ts'        		
    ];
}
