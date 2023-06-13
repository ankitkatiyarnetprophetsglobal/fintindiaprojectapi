<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schoolmeta extends Model
{
    
	use HasFactory;
	protected $table ='schoolmetas';
	public $timestamps = false;
	
	protected $fillable = [
		'user_id',
		'affiliationnum',
		'chain',
		'region',
		'landmark',
		'students',
		'pname',
		'pmobile',
	]; 
}
