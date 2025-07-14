<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizTitleList;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Mailtrakings extends Model
{
    use HasFactory;
	protected $table ='mail_trakings';
	public $timestamps = false;


	protected $fillable = [
        'id',
		'user_id',
        'email',
        'status',
        'event_name',
        'created_at',        
    ];


  

}
