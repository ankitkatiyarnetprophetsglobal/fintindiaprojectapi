<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizTitleList;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Storechallengerdatas extends Model
{
    use HasFactory;
	protected $table ='storechallengerdatas';
	public $timestamps = false;


	protected $fillable = [
        'id',
        'user_id',		
        'steps',
        'date',
        'calery',
        'individual_goals',
        'status',        
        'created_at',
        'updated_at',        
    ];


  

}
