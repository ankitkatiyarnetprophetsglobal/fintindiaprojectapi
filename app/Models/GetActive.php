<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class GetActive extends Model
{
    use HasFactory;
	protected $table ='getactive';
	public $timestamps = true;

	protected $fillable = [
        'category',
        'ageGroup',
        'gender',
        'testType',
        'videoUrl',
		'videoId',
		'title',
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
