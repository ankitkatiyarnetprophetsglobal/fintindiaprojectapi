<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mastergroupmode extends Model
{
    use HasFactory;
	
	protected $table ='mastergroupmodes';
		
	protected $fillable = [	'image','sport_mode','duration','status'];
}
