<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trackingpic extends Model
{
	use HasFactory;
	protected $table ='trackingpics';
	
	public function eventDetails(){
		return $this->hasOne(EventCat::class,'id','trip_id');
	}

	public function userDetails(){
		return $this->hasOne(User::class,'id','user_id');
	}
}
