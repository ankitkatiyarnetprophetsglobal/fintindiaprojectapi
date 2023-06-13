<?php

namespace App\Http\Controllers\v2\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class GetActiveController extends Controller
{
    public function getactive(){
    	return view('api.get-active');
    }
}
