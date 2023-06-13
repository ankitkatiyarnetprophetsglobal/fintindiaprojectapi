<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shareyourstory extends Model
{
    use HasFactory;
    protected $table = 'shareyourstories';

    protected $fillable = ['youare', 'designation', 'email', 'fullname', 'videourl', 'title','image', 'story'];
}
