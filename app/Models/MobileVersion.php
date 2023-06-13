<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileVersion extends Model
{
    use HasFactory;
	protected $table ='ver_check';
	public $fillable = ['name', 'version', 'type', 'status', 'description', 'release_date', 'created_date'];
	public $timestamps = false;
}
