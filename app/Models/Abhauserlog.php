<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abhauserlog extends Model
{
    
	use HasFactory;
	protected $table ='abha_user_logs';
	public $timestamps = false;
	
	protected $fillable = [
		'id',
		'fid',
		'abha_id',
		'status',		
		'created_at',		
	]; 
}
