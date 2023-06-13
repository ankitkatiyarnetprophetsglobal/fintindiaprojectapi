<?php

namespace App\Http\Controllers\v2\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response;
use App\Models\Block;
use App\Models\District;

class BlockController extends Controller
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
       
	       $blocks = Block::select('id','name','district_id','status')->orderBy('name','asc')->where('name','LIKE','%'.$search_txt.'%')->paginate(50);
           $districts = District::orderBy('name','asc')->get();
           $blk = Block::count();
        
        return view('admin.block.index', compact('districts','blocks','blk'));
        }
        else
        {
            $blocks = Block::orderBy('name','asc')->paginate(50);
           $districts = District::all();
           $blk = Block::count();
        
        return view('admin.block.index', compact('districts','blocks','blk'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = District::orderBy('name','asc')->get();
        return view('admin.block.create',compact('districts'));
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
            'district' => 'required',
			 'name' => 'required|unique:blocks|min:2',
           
        ]);


       
			$block = new Block();
	    	$block->name = $request->name;
	    	$block->district_id = $request->district;
			$block->save();
    	 return back()->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

    
    public function edit($id)
    {
        $districts = District::all();
        $block = Block::findOrFail($id);
        return view('admin.block.edit',compact('block','districts'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'district' => 'required',
			 'name' => 'required|unique:blocks|min:2',
           
        ]);


       
			$block =  Block::find($id);
	    	$block->name = $request->name;
	    	$block->district_id = $request->district;
			$block->save();
    	 return redirect('admin/blocks')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

    
    public function destroy($id)
    {
        $block = Block::findOrFail($id);
		$block->delete();
		return redirect('admin/blocks')->with(['status' => 'success', 'msg' => 'Successfully added']);
    }
}
