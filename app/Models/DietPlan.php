<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DietPlan extends Model
{
    use HasFactory;
	protected $table ='dietplans';
	public $timestamps = true;

	protected $fillable = [
        'planId',
        'ageGroup',
        'gender',
        'dietType',
        'calories',
		'caloriesTo',
		'planPdf',
		'created_at',
		'updated_at'
    ];
	
	public function getCreatedAtAttribute($value)
	{
		return Carbon::parse($value)->format('Y-m-d H:i:s');
	}	
	
	public function getUpdatedAtAttribute($value)
	{
		return Carbon::parse($value)->format('Y-m-d H:i:s');
	}		
}
