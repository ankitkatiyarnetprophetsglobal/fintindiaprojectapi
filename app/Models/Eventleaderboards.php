<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventleaderboards extends Model
{
    use HasFactory;
	protected $table ='event_leaderboards';
	public $timestamps = false;


	protected $fillable = [
        'id',
		'eventname',
        'startdate',
        'end_date',
        'active',
        'created_on',		
    ];


}
