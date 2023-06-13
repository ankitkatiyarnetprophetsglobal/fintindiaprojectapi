<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YouthStatus extends Model
{
    use HasFactory;	
		
	protected $table ='wp_youth_club_status';
	public $timestamps = false;
	
	protected $fillable = [
		'user_id',
		'cat_id',
		'cur_status',	
		'status',
		'created',
		'updated'
		
	];    
}
