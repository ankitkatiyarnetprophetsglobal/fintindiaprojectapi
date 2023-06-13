<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertRequest extends Model
{
    use HasFactory;
    protected $table = 'wp_star_rating';
    public $timestamps = false;
    protected $fillable = ['user_id', 'cat_id', 'created'];
    
}
