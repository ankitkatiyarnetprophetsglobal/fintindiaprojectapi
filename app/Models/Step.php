<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;
	protected $fillable = [
        'user_id',
        'steps',
        'noofevent',
        'calorie',
        'point',
		'speed',
		'distance',
		'goal',
		'for_date'
    ];
}
