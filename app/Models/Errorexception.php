<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Errorexception extends Model
{
    use HasFactory;
    protected $table="exception_handeling";
    public $timestamps=false;
}
