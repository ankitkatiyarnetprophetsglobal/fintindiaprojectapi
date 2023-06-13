<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Response, Redirect;
use App\Models\Foodname;
use Illuminate\Support\Facades\DB;

class FoodnameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $foodnames =  Foodname::paginate(40);
		$foodnames_count = count($foodnames);
        return view('admin.foodname.index',compact('foodnames','foodnames_count'));
    }

    
    public function create()
    {
        return view('admin.foodname.create');
    }

   
    public function store(Request $request)
    {
       
       $request->validate([
            'foodname' => 'required|unique:foodnames|min:2'
        ]);
        $foodname = new Foodname();
        $foodname->foodname = $request->foodname;
        $foodname->save();
        return redirect('admin/foodnames')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

   
    public function edit($id)
    {
        $foodname = Foodname::findOrFail($id);
        return view('admin.foodname.edit',compact('foodname'));
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'foodname' => 'required|unique:foodnames|min:2'
        ]);
        $foodname = Foodname::find($id);
        $foodname->foodname = $request->foodname;
        $foodname->save();
        return redirect('admin/foodnames')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

   
    public function destroy($id)
    {
        $foodname = Foodname::findOrFail($id);
        $foodname->delete();
        return redirect('admin/foodnames')->with(['status' => 'success', 'msg' => 'Successfully added']);
    }
}
