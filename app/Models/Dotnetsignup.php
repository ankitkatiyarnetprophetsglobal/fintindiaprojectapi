<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dotnetsignup extends Model
{
    protected $table = 'dotnetsignup';

    protected $fillable = [
        'kheloindiaid','username','name','mobileno','emailid','gender','dob',
        'querytype','addressline1','addressline2','district','state','pincode',
        'uidno','block','age','role','photoname','weight','height','distance',
        'scoreuint','status'
    ];
}
