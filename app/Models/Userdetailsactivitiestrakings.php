<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userdetailsactivitiestrakings extends Model
{
    
	use HasFactory;
	protected $table ='Userdetailsactivitiestrakings';
	public $timestamps = false;
	
	protected $fillable = [
		'user_id',
		'groupid',
		'modegroupid',
		'trip_id',
		'trip_status',
		'ave_pace',
		'speed',
		'steps',
		'distance',
		'datetime',
		'location',
		'status',
	]; 
}
