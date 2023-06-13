<?php

namespace App\Http\Controllers\v2\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function media(){
    	return view('api.media');
    }
}
