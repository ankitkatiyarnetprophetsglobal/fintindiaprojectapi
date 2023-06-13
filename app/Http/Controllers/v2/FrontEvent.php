<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\District;
use App\Models\Block;

class FrontEvent extends Controller
{
    //
	public function index(){
		$states = State::all();
		return view('halfmarathon',compact('states'));
	}
}
