<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usertracking extends Model
{
    use SoftDeletes;
	use HasFactory;
	protected $table ='usertrackings';
	public $timestamps = false;
	
	protected $fillable = [
		'user_id',
		'company_name',
		'device_name',
		'device_version',
		'os_name',
		'os_version',
		'api_name',
		'api_version',
		'login_datetime',
		'status'		
	]; 
	
}
