<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YouthCertRequest extends Model
{
    use HasFactory;
	protected $table ='wp_youth_club_details';
	public $timestamps = false;
	
	protected $fillable = [
		'user_id',
		'cat_id',
		'created',
		'state',
		'district',
		'block',
		'noofmembers',
		'nameofclub',
		'affiliationno',
		'anysports',
		'anysportsmin',
		'traditionalgame',
		'traditionalgamemin',
		'walkingmin',
		'cyclingmin',
		'runningmin',
		'otherpa',
		'otherpamin',
		'motivatecommits',	
		'youthclubcommits',
		'mpname',
		'mpcontact',
		'mpphyactivity',
		'yclubeventcommits',
		'eventname',
		'noofparticipant',
		'eventphoto',
	]; 
}
