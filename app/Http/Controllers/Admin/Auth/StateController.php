<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Response, Redirect;
use App\Models\State;


class StateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    if($request->input('search')=='search')
    {
        $search_txt = $request->input('s');
         $states = State::select('id','name','status')->orderBy('name','asc')->where('name','LIKE','%'.$search_txt.'%')->paginate(50);
         $st = State::count();
        
        return view('admin.state.index', compact('states','st'));
    }
    else
    {
        $states = State::select('id','name','status')->orderBy('name','asc')->paginate(50);
        $st = State::count();
        
        return view('admin.state.index', compact('states','st'));

    }

    
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.state.create');
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
            'name' => 'required|unique:states|min:2',
           
        ]);

        
        $state = new State();
        $state->name = $request->name;
        $state->save();
        return redirect('admin/states')->with(['status' => 'success' , 'msg' => 'Successfully added']);
  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state = State::findOrFail($id);
        return view('admin.state.edit',compact('state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		
        $data = $request->validate([
            'name' => 'required'
           
        ]);

        
        State::whereId($id)->update($data);
        return redirect('admin/states')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = State::findOrFail($id);
		$state->delete();
		return redirect('admin/states')->with(['status' => 'success', 'msg' => 'Successfully added']);
    }
}
