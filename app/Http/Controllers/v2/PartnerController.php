<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Response, Redirect;
use App\Models\Partner;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('become-partner');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|string|regex:/(^[a-zA-Z ]+$)+/',
            'email' => 'required|string|unique:partners|max:255',
            'contact' => 'required|digits:10',
            'designation'=> 'required|string|regex:/(^[a-zA-Z ]+$)+/',
            'sociallink' => 'required|string',
            'story' => 'required|string',
            'specify' => 'required|string',
        ]);
        
        $partners = new Partner();
        $partners->name = $request->name;
        $partners->email = $request->email;
        $partners->contact = $request->contact;
        $partners->designation = $request->designation;
        $partners->sociallink = $request->sociallink;
        $partners->story = $request->story;
        $partners->specify = $request->specify;
        $partners->save();
        return back()->with('success','Your information has been  Sucessfully submited!!!Thank you for your interest'); 

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
