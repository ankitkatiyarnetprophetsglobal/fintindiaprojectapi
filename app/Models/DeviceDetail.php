<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceDetail extends Model
{
    use HasFactory;
	protected $table ='devicedetails';
	public $timestamps = false;


	protected $fillable = [
        'user_id',
        'deviceType',
        'deviceVersion',
        'deviceName',
        'sensorPresent',
		'logfor',
		'createDate'	
    ];
	
	
}
