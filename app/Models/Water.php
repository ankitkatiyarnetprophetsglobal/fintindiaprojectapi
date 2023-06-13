<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Water extends Model
{
    use HasFactory;
	protected $fillable = [
        'user_id',
        'quantity',
        'goal',
        'weekly_completion',
        'for_date'
	];
}
