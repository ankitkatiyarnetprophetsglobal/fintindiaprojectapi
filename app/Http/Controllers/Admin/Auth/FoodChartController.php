<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request,Response,Redirect;
use App\Models\FoodChart;
use App\Models\Foodname;
use App\Models\ServingQuantity;

class FoodChartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()

    {
        $foodcharts = FoodChart::paginate(40);
		$foodchart_count = count($foodcharts);
        return view('admin.foodchart.index',compact('foodcharts','foodchart_count'));
    }

    
    public function create()
    {
        $foodnames = Foodname::all();
        $servingquantites = ServingQuantity::all();
       return view('admin.foodchart.create',compact('foodnames','servingquantites'));
    }

    
    public function store(Request $request)
    {
        $fdname = Foodname::where('id', $request->foodname)->first();
        

        $servqt = ServingQuantity::where('id', $request->servingquantity)->first();
       
        
         $request->validate([
            'foodname' => 'string',
            'servingquantity' => 'string',
            'measurement' => 'numeric',
            'unit' => 'string',
            'calories' => 'numeric',
        ]);
        $foodchart = new FoodChart();
        $foodchart->name = $fdname->foodname;
        $foodchart->servingquantity = $servqt->name;
        $foodchart->measurement = $request->measurement;
        $foodchart->foodname_id=$fdname->id;
        $foodchart->servingquantity_id=$servqt->id;
        $foodchart->unit = $request->unit;
        $foodchart->calories = $request->calories;
        $foodchart->save();


        return redirect('admin/foodcharts')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $foodnames = Foodname::all();
        $servingquantites = ServingQuantity::all();
        $foodcharts = FoodChart::findOrFail($id);
        return view('admin.foodchart.edit',compact('foodcharts','servingquantites','foodnames'));
    }

   
    public function update(Request $request, $id)
    {
        $fdname = Foodname::where('id', $request->foodname)->first();

        $servqt = ServingQuantity::where('id', $request->servingquantity)->first();
        
        $data = $request->validate([
            'foodname' => 'string',
            'servingquantity' => 'string',
            'measurement' => 'numeric',
            'unit' => 'string',
            'calories' => 'numeric',
        ]);
        $foodchart = FoodChart::find($id);
        $foodchart->name = $fdname->foodname;
        $foodchart->servingquantity = $servqt->name;
        $foodchart->measurement = $request->measurement;
        $foodchart->foodname_id=$fdname->id;
        $foodchart->servingquantity_id=$servqt->id;
        $foodchart->unit = $request->unit;
        $foodchart->calories = $request->calories;
        $foodchart->save();


        return redirect('admin/foodcharts')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

    
    public function destroy($id)
    {
        $foodchart = FoodChart::findOrFail($id);
        $foodchart->delete();
       return redirect('admin/foodcharts')->with(['status' => 'success','msg' => 'successfully deleted']);
    }
}
