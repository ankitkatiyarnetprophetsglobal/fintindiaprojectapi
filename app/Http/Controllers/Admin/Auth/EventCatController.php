<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Response, Redirect;
use App\Models\EventCat;
use Illuminate\Support\Facades\DB;

class EventCatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
   
    public function index()
    {
        $eventcats = EventCat::all();
		$eventcats_count = count($eventcats);
        return view('admin.eventcat.index',compact('eventcats','eventcats_count'));
    }

    
    public function create()
    {
        return view('admin.eventcat.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:event_cats|min:2'
        ]);
        $eventcat = new EventCat();
        $eventcat->name = $request->name;
        $eventcat->save();
        return redirect('admin/eventcats')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

    
    
    
    public function edit($id)
    {
        $eventcat = EventCat::findOrFail($id);
        return view('admin.eventcat.edit',compact('eventcat'));
    }

   
    public function update(Request $request, $id)
    {
       $data =$request->validate([
            'name' => 'required|unique:event_cats|min:2'
        ]);
        EventCat::whereId($id)->update($data);

        return redirect('admin/eventcats')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }
    

    
    public function destroy($id)
    {
        $eventcat = EventCat::findOrFail($id);
		$eventcat->delete();
		return redirect('admin/eventcats')->with(['status' => 'success', 'msg' => 'Successfully added']);
    }
    public function status(Request $request,$type,$id)
    {
        $eventcat = EventCat::findOrFail($id);
        $eventcat->status = $type;
        $eventcat->save();
        return redirect('admin/eventcats')->with(['status' => 'success','msg' => 'successfully added']);
    }
}
