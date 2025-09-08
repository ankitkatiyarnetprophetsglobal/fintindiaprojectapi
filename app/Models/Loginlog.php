<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loginlog extends Model
{
    use HasFactory;
	protected $table ='login_logs';
	protected $fillable = [
      'email',
      'phone',
      'otp',
      'status',
      'created_at',
      'updated_at'
    ];
}
