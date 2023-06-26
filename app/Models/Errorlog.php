<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Errorlog extends Model
{
    use HasFactory;
	
	protected $table ='Errorlogs';
		
	protected $fillable = [	'function_name','controller_name','error_code','error_message','send_payload','response'];
}
