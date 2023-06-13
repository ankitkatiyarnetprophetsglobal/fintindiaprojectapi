<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request,Response,Redirect;
use App\Models\Sleep;
use App\Models\User;

class SleepChartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $users = User::all();
        $sleeps = Sleep::paginate(8);
		$sleep_count = count($sleeps);
        return view('admin.sleepchart.index',compact('users','sleeps','sleep_count'));
    }

   
   
    public function edit($id)
    {
        $sleeps = Sleep::findOrFail($id);
        return view('admin.sleepchart.edit',compact('sleeps'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([ 
            'bed_date' => 'string',
            'bed_time' => 'string',
            'wakup_date' => 'string',
            'wakup_time' => 'string',
            'sleep_hours' => 'string',
        ]);
         Sleep::whereId($id)->update($data);

        return redirect('admin/sleepcharts')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

    
    public function destroy($id)
    {
        $sleep = Sleep::findOrFail($id);
        $sleep->delete();
       return redirect('admin/sleepcharts')->with(['status' => 'success','msg' => 'successfully deleted']);
    }
}
