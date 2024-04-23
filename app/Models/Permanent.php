<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permanent extends Model
{
    
	use HasFactory;
	protected $table ='deletedusers';
	public $timestamps = false;
	
	protected $fillable = [
		'id',
		'user_id',
		'email',
		'phone',
		'request_date',
		'os_details',		
		'status',
		'created_at',
		'updated_at',		
	]; 
}
