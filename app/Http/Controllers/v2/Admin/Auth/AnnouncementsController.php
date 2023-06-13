<?php

namespace App\Http\Controllers\v2\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\DB;


class AnnouncementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $annunce = Announcement::all();
		$annunce_count = count($annunce);
        return view('admin.announcement.index',compact('annunce','annunce_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.announcement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $image = '';
        $document_url = '';
        $year = date("Y/m"); 
        if($request->file('image'))
        {
            $image = $request->file('image')->store('doc',['disk'=> 'uploads']);
            $image = url('wp-content/uploads/'.$image);
            
        }
        if($request->file('doc'))
        {
            $document_url = $request->file('doc')->store('doc',['disk'=> 'uploads']);
            $document_url = url('wp-content/uploads/'.$document_url);
        }
        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'description' => 'required',
            /*'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:1000000',*/
            'doc' => 'required|mimes:doc,xlsx,pdf|max:1000000'
        ]); 

        $annunce = new Announcement;
           $annunce->image = $image;  
           $annunce->doc = $document_url;           
           $annunce->url = $request->url;
           $annunce->title = $request->title;
           $annunce->description = $request->description; 
           $annunce->save();
        return redirect()->route('admin.announcement.index')
        ->with('success','Announcement has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($id);die;
        $annunce = Announcement::findOrFail($id);
        return view('admin.announcement.edit',compact('annunce'));
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
        $image = '';
        $document_url = '';
        $year = date("Y/m"); 
          $request->validate([
            'title' => 'required',
            'url' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'description' => 'required',
           
         ]);

        if($request->file('image'))
        {
            $image = $request->file('image')->store($year,['disk'=> 'uploads']);
            $image = url('wp-content/uploads/'.$image);
        }

        $annunce = Announcement::find($id);
        $annunce->title = $request->title;
        $annunce->url = $request->url;
        $annunce->description = $request->description;
        $annunce->image = $image;
        $annunce->save();
    
        return redirect('admin/announcement')->with(['status' => 'success' , 'msg' => 'Successfully added']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $annunce = Announcement::findOrFail($id);
        $annunce->delete();
        return redirect('admin/announcement')->with(['status' => 'success', 'msg' => 'Successfully added']);
    }

    public function announStatus($id)
    {
        $annunce = Announcement::findOrFail($id);        
        if($annunce->status == 1){
            $annunce->status = 0;
        } else {
            $annunce->status = 1;
        }       
        $annunce->save();
        return redirect('admin/announcement')->with(['status' => 'success','msg' => 'successfully added']);
    }
}
