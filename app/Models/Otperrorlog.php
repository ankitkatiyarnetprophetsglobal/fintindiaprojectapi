<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Otperrorlog extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
      'phone', 'mic_server_message', 'server_ip', 'log_date'
    ];   
    
}