<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizTitleList;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Quizmasterqueans extends Model
{
    use HasFactory;
	protected $table ='quiz_master_question_answers';
	public $timestamps = false;


	protected $fillable = [
        'quiz_categories_id',
		'quiz_title_list_id',
        'question',
        'option1',
        'option2',
        'option3',
        'option4',
        'option5',
        'answer',
        'mark',
        'time',
        'lang',
        'status',
        'created_at',
        'updated_at',
    ];


  

}
