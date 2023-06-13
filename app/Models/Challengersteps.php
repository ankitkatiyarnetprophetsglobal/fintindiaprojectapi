<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challengersteps extends Model
{
    use HasFactory;
    protected $table = 'challengers_steps';
    protected $fillable = [
        'user_id',
        'last_step_date',
        'steps'
    ];
}
