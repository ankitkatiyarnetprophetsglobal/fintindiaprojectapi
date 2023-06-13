<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GramPanchayat;
class GramPanchayat extends Model
{
    use HasFactory;
    protected $table = 'gram_panchayat_ambassador';
    protected $fillable = [
    	'user_id',
        'name',
        'age',
        'gender',
        'state_name',
        'state_id',
        'district_name',
        'district_id',
        'block_name',
        'block_id',
        'pincode',
        'gram_panchayat_name',
        'document_file',
        'physical_activity',
        'additional_person_info',
        'fitness_event',
        'status',
        'created_at',
        'updated_at'  
    ];
}
