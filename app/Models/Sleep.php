<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sleep extends Model
{
    use HasFactory;

    protected $table = 'sleep';
    protected $fillable = [
        'user_id',
        'sleep_date',
        'sleep_time',
        'wakup_date',
        'wakup_time',
		'bed_date',
		'bed_time',
		'sleep_hours',
		'goal' 
    ];

}
