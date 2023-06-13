<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response,Redirect;
use App\Models\District;
use App\Models\State;


class DistrictController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(Request $request)
    {
        if($request->input('search')=='search')
        {
        $search_txt = $request->input('s');
        $districts = District::select('id','name','state_id','status')->orderBy('name','asc')->where('name','LIKE','%'.$search_txt.'%')->paginate(50);
		$states = State::all();
        $dist = District::count();
        
        return view('admin.district.index', compact('districts','states','dist'));
        }
        else
        {

            $districts = District::orderBy('name','asc')->paginate(50);
            $states = State::all();
            $dist = District::count();
        
        return view('admin.district.index', compact('districts','states','dist'));
        }
    }

    
    public function create()
    {
		$states = State::orderBy('name','asc')->get();
        return view('admin.district.create',compact('states'));
    }


    public function store(Request $request)
    {
		 
		 $request->validate([
            'state' => 'required',
			 'name' => 'required|unique:districts|min:2',
           
        ]);
        $districtlist = $request->input('name');

         $districtlist = explode(",",$districtlist);

         $state = $request->input('state');
        foreach($districtlist as $dist)   
         {          
            $test = array(
                ['name' => $dist,
                'state_id' => $state,
            ]);
            District::insert($test);
         }
        return back()->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

   
    public function edit($id)
    {
		$states = State::all();
        $district = District::findOrFail($id);
        return view('admin.district.edit',compact('states','district'));
    }

   
    public function update(Request $request, $id)
    {
		
		
			$request->validate([
            'state' => 'required',
			 'name' => 'required|unique:districts|min:2',
           
        ]);
		
			$district = District::find($id);
	    	$district->name = $request->name;
	    	$district->state_id = $request->state;
			$district->save();
        return redirect('admin/districts')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

   
    public function destroy($id)
    {
         $district = District::findOrFail($id);
		$district->delete();
		return redirect('admin/districts')->with(['status' => 'success', 'msg' => 'Successfully added']);
    }
}
