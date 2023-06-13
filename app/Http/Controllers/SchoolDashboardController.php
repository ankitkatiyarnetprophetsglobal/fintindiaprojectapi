<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolDashboard;
use App\Models\Siteoption;

class SchoolDashboardController extends Controller
{
    //
	public function index(){
		$schooldata =  SchoolDashboard::orderBy('flag', 'desc')->get();
		$siteopts = Siteoption::whereIn('key', ['visitors', 'totalschools', 'flag_boards', 'flag_states', 'schools_flagreq','flagupdateOn', 'flag', 'threestar', 'fivestar'] )->select('key','value')->get()->toArray();
		
		return view('schooldashboard', compact('schooldata', 'siteopts'));
	}
}
