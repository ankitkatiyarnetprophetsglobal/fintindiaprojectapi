<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PostCat;
use App\Models\User;
use App\Models\PostsComments;
use App\Models\PostslLike;
use App\Models\Language;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'post_category', 'image'];

    public function user(){
        return $this->hasOne(User::class,'id','created_by');
    }

    public function comments(){
        return $this->hasMany(PostsComments::class,'post_id','id');
    }

    public function like(){
        return $this->hasone(PostslLike::class,'post_id','id');
    }
    public function unlike(){
        return $this->hasMany(PostslLike::class,'post_id','id');
    }
    public function PostCat(){
        return $this->hasOne(PostCat::class,'id','post_category_id');
    }
    public function getPostCategoryAttribute($value){
        return PostCat::select('id','name')->whereIn('id',explode(',',$value))->get();
    }    
    public function getPostCategorylang(){
        return $this->hasOne(Language::class,'lang_slug','lang_slug')->select('id','lang_slug','name')->where('status','=','active');
    }    
}
