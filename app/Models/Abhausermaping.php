<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abhausermaping extends Model
{
    
	use HasFactory;
	protected $table ='abha_user_maping';
	public $timestamps = false;
	
	protected $fillable = [
		'id',
		'fid',
		'abha_id',
		'status',
		'status',
		'created_at',
		'updated_at',		
	]; 
}
