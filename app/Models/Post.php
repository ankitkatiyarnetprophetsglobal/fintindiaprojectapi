<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PostCat;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'post_category', 'image'];

    
}
