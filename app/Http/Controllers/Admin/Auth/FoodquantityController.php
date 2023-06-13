<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Response, Redirect;
use App\Models\ServingQuantity;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class FoodquantityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$servingquantities = ServingQuantity::paginate(40);
		$servingquantities_count = count($servingquantities);
        return view('admin.servingquantity.index',compact('servingquantities','servingquantities_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.servingquantity.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string'
        ]);
        $servingquantity = new ServingQuantity();
        $servingquantity->name =  $request->name;
        $servingquantity->save();
        return redirect('admin/servingquantities')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

    
    public function edit($id)
    {
         $servingquantity = ServingQuantity::findOrFail($id);
        return view('admin.servingquantity.edit',compact('servingquantity'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string'
        ]);
        $servingquantity = ServingQuantity::find($id);
        $servingquantity->name =  $request->name;
        $servingquantity->save();
        return redirect('admin/servingquantities')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

   
    public function destroy($id)
    {
        $servingquantity = ServingQuantity::findOrFail($id);
        $servingquantity->delete();
        return redirect('admin/servingquantities')->with(['status' => 'success', 'msg' => 'Successfully added']);
    }
}
