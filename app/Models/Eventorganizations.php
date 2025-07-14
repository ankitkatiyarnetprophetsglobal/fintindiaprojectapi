<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventorganizations extends Model
{
    use HasFactory;
	protected $table ='event_organizations';
	public $timestamps = false;


	protected $fillable = [
        'id',
		'user_id',
        'type',
        'category',
        'event_name_store',
        'name',
		'email',
		'contact',
		'state',
		'school_chain',
		'event_bg_image',
		'eventimage1',
		'eventimage2',
		'eventstartdate',
		'eventenddate',
		'organiser_name',
		'participantnum',
		'kmrun',
		'participant_names',
		'role',
		'eventimg_meta',
		'eventdate_meta',
		'eventpnt_meta',
		'eventkm_meta',
		'total_participant',
		'total_kms',
		'excel_sheet',
		'created_at',
		'updated_at'
    ];


}
