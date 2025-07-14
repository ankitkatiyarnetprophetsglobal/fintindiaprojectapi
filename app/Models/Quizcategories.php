<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizTitleList;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Quizcategories extends Model
{
    use HasFactory;
	protected $table ='quiz_categories';
	public $timestamps = false;


	protected $fillable = [
        'name',
		'icon',
        'lang',
        'status',
    ];

    public function quizTitleLists(){
        return $this->hasMany(QuizTitleList::class,'quiz_categories_id','id');
    }

    public function getIconAttribute($value)
    {
        //dd($value);
        return $value;
    }


}
