<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Challenge extends Model
{
    use HasFactory;
    protected $table = 'challenge';
    public $timestamps = true;
	
    protected $fillable = ['from_userid','from_email','to_userid','to_email','status'];
						 
	public function getCreatedAtAttribute($value)
	{
		return Carbon::parse($value)->format('Y-m-d H:i:s');
	}	
	
	public function getUpdatedAtAttribute($value)
	{
		return Carbon::parse($value)->format('Y-m-d H:i:s');
	}	  
}