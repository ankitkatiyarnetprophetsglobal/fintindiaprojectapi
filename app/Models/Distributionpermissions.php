<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuizTitleList;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Distributionpermissions extends Model
{
    use HasFactory;
	protected $table ='distribution_permissions';
	public $timestamps = false;


	protected $fillable = [
        'id',
        'fid',
        'status',
        'created_at',
        'updated_at'
    ];
}
