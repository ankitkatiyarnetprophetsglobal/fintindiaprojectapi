<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizTitleList;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Socmasterequipment extends Model
{
    use HasFactory;
	protected $table ='soc_master_equipments';
	public $timestamps = false;


	protected $fillable = [
        'id',
        'name',
        'status',
        'uname',
        'status',
        'created_at',
        'updated_at',
    ];




}
