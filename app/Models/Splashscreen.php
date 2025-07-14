<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Splashscreen extends Model
{
    use HasFactory;
	protected $table ='mobilesplashscreensliders';
	public $timestamps = false;


	protected $fillable = [
        'name',
		'type',
        'landing_url',
        'banner_url',
        'language',
        'start_from',
		'end_to',
		'order'

    ];


}
