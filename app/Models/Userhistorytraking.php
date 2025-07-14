<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userhistorytraking extends Model
{
    use SoftDeletes;
	use HasFactory;
	protected $table ='userhistorytrakings';
	public $timestamps = false;

	protected $fillable = [
		'user_id',
		'groupid',
		'modegroupid',
		'trip_id',
		'trip_name',
		'commemt',
		'average_speed',
		'max_speed',
		'steps',
		'duration',
		'distance',
		'uom',
		'carbonSave',
		'datetime',
		'location',
		'status',
	];

	public function getMasterGroupDetails(){
		return $this->hasOne(Mastergroupmode::class,'id','modegroupid');
	}
}
