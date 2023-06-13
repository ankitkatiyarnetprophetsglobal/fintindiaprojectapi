<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfos extends Model
{
    use HasFactory;
	protected $table ='userinfo';
	public $fillable = ['user_id', 'info'];
	public $timestamps = false;
	
}
