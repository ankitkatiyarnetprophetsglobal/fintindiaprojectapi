<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizTitleList;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Quizuserattempts extends Model
{
    use HasFactory;
	protected $table ='quiz_user_attempts';
	public $timestamps = false;


	protected $fillable = [
        'user_id',
		'quiz_categories_id',
        'quiz_title_list_id',
        'quiz_master_question_answers_id',
        'ans_option_id',
        'is_correct',
        'mark',
        'quiz_timeing',
        'question_status',        
        'status',
        'created_at',        
        'updated_at',        
    ];

}
