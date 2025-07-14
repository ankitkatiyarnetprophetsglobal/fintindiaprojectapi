<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizTitleList;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Ongoingchallenger extends Model
{
    use HasFactory;
	protected $table ='ongoing_challengers';
	public $timestamps = false;


	protected $fillable = [
        'id',
        'user_id',		
        'challenger_id',
        'point',
        'sport_type',
        'duration',
        'progess',
        'status',
        'created_at',
        'updated_at',        
    ];


  

}
