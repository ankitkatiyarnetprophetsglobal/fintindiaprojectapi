<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class PostslLike extends Model
{
    use HasFactory;	
		
	protected $table ='posts_likes';
	// public $timestamps = false;
	
	protected $fillable = [
		'user_id',
		'post_id',
		'like_status',			
		'created_at',
		'updated_at'
		
	];   
	
	public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
