<?php

namespace App\Http\Controllers;
use App\Models\Role;
use Illuminate\Http\Request,Response;

class RoleController extends Controller
{
    //
	public function index(Request $request){
		
		return Role::where('groupof',$request->groupid)->select('id','slug','name')->get();
	}
}
