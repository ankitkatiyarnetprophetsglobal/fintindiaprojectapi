<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizTitleList;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Quiztitlelists extends Model
{
    use HasFactory;
	protected $table ='quiz_title_lists';
	public $timestamps = false;


	protected $fillable = [
        'id',
        'quiz_categories_id',		
        'name ',
        'description',
        'icon',
        'duration',
        'status',
        'created_at',
        'updated_at'        
    ];


  

}
