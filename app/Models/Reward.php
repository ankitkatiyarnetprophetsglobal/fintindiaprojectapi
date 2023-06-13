<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;
	protected $table ='reward';
	public $timestamps = false;


	protected $fillable = [
        'user_id',
		'type',
        'steps',
        'stepgoal',
        'archived',
        'points',
		'mtime',
		'rewardDate',
		'createDate'	
    ];
	
	
}
