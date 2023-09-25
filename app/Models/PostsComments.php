<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class PostsComments extends Model
{
    use HasFactory;	
		
	protected $table ='posts_comments';
	// public $timestamps = false;
	
	protected $fillable = [
		'user_id',
		'post_id',
		'comment',	
		'comment_status',
		'status',
		'created_by',
		'update_by',
		'deleted_by',
		'created_at',
		'updated_at',
		'deleted_at'
		
	];  
	
	public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
