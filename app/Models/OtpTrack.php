<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpTrack extends Model
{
    use HasFactory;
	protected $table ='otptrack';
	protected $fillable = [
      'email', 'phone', 'otp'
    ];
}
