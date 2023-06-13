<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usermeta extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','dob','age','gender','mobile','address', 'pincode', 'height', 'weight', 'state', 'district', 'block', 'city', 'profile_picurl', 'udise', 'orgname'];
    
    public function user()
    {
        return $this->belongsTo(App\Models\User::class, 'user_id');
    }
    
}
