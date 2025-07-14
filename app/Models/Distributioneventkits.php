<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizTitleList;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Distributioneventkits extends Model
{
    use HasFactory;
	protected $table ='distributioneventkits';
	public $timestamps = false;


	protected $fillable = [
        'id',
        'adminfitindiaid',
        'fitindiaid',
        'name',
        'dob',
        'gender',
        'lat',
        'long',
        'address',
        'cycle_check',
        'email_id',
        'mobile_no',
        'date',
        'center',
        'merchandise_status',
        'status',
        'created_at',
        'updated_at'
    ];
}
