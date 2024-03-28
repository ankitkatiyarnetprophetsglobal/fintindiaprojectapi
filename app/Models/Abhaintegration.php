<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abhaintegration extends Model
{
    
	use HasFactory;
	protected $table ='abhaintegration';
	public $timestamps = false;
	
	protected $fillable = [
		'key_value',
		'url',
		'fitindia_version',
		'abha_version',
		'status',
		'created_at',
		'updated_at',		
	]; 
}
