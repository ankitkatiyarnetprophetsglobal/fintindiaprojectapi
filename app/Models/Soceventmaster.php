<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizTitleList;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Soceventmaster extends Model
{
    use HasFactory;
	protected $table ='soc_event_masters';
	public $timestamps = false;


	protected $fillable = [
        'id',
        'socemid',
        'user_id',
        'uname',
        'cycle',
        't_shirt',
        'latitude',
        'longitude',
        'event_date',
        'status',
        'created_at',
        'updated_at',
    ];

}
