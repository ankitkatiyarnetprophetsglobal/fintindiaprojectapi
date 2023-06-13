<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LoginAttempt extends Model
{
    use HasFactory;
	protected $table ='failed_login_attempts';
	public $timestamps = true;
	
	protected $fillable = [
        'email',
		'mobile',
        'device_token',        		
    ];	
		
}
