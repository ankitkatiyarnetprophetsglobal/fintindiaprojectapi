<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Userdetailsactivitiestrakings extends Model
{

	use HasFactory;
	protected $table ='userdetailsactivitiestrakings';
	public $timestamps = false;

	protected $fillable = [
		'user_id',
		'groupid',
		'modegroupid',
		'trip_id',
		'trip_status',
		'ave_pace',
		'speed',
		'steps',
		'distance',
		'datetime',
		'location',
		'carbonSave',
		'status',
	];

	public function getLocationAttribute($value)
    {
        return json_decode($value);
    }

	public function location(){
		return $this->hasMany(Userdetailsactivitiestrakings::class,'user_id','user_id');
	}
}
