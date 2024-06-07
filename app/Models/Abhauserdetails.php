<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abhauserdetails extends Model
{
    
	use HasFactory;
	protected $table ='abha_user_details';
	public $timestamps = false;
	
	protected $fillable = [
		'id',
		'aum_id',
		'abha_id',
		'abha_address',
		'name',
		'dob',
		'gender',
		'mobile',
		'address',
		'status',
		'created_at',
		'updated_at',		
	]; 
}
