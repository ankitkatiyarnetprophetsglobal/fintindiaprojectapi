<?php

namespace App\Http\Controllers;

use App\Models\GramPanchayat;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use Illuminate\Http\Request;

class GramPanchayatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $states = State::all();
       return view('gram-panchayat',compact('states'));
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

       /* $m_person_info = array_map(NULL, $request->mpname, $request->mpcontact, $request->mpemail);*/

        $image = '';
        $role_slug = 'gmambassador';
        $year = date("Y/m");
        /*$request->validate([
            'name' => 'required|string',
            'age' => 'required',
            'gender' => 'required',
            'state' => 'required',
            'district' =>'required',
            'block' => 'required',
            'pincode' => 'required',
            'panchayat_name' => 'required',
            'document' => 'required',
            'physical_activity' => 'required',
        ]);*/

        if($request->file('document'))
        {
            $image = $request->file('document')->store($year,['disk'=>'uploads']);
            $image = url('wp-content/uploads/'.$image);
        }
        $state = State::where('id', $request->state)->first();
        $district = District::where('id', $request->district)->first();
        $block = Block::where('id', $request->block)->first();
       
        /*echo $state->name;
        echo "====<br>";
        echo $district->name;
        echo "====<br>";
        echo $block->name;
        echo "====<br>";
        die;*/
        $gram_panchayat_obj = new GramPanchayat();
        $gram_panchayat_obj->name = $request->name;
        $gram_panchayat_obj->age = $request->age;
        $gram_panchayat_obj->gender = $request->gender;

        $gram_panchayat_obj->state_name =  @$state->name;   
        $gram_panchayat_obj->state_id = $request->state;

        $gram_panchayat_obj->district_name = @$district->name;
        $gram_panchayat_obj->district_id = $request->district;

        $gram_panchayat_obj->block_name = @$block->name;
        $gram_panchayat_obj->block_id = $request->block;

        $gram_panchayat_obj->pincode = $request->pincode; 



        $gram_panchayat_obj->gram_panchayat_name = $request->panchayat_name;
        $gram_panchayat_obj->document_file = $image;
        $gram_panchayat_obj->physical_activity = $request->physical_activity;
        /*$gram_panchayat_obj->additional_person_info = @serialize($m_person_info);*/

        if($gram_panchayat_obj->save()){
            return back()->with('success','Request to become a Fit India Ambassador has been submitted successfully. Please wait until your application is verified.');
        }else{
            return back()->with('failed','Something Wrong')->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\GramPanchayat  $gramPanchayat
     * @return \Illuminate\Http\Response
     */
    public function show(GramPanchayat $gramPanchayat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Models\GramPanchayat  $gramPanchayat
     * @return \Illuminate\Http\Response
     */
    public function edit(GramPanchayat $gramPanchayat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\GramPanchayat  $gramPanchayat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GramPanchayat $gramPanchayat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\GramPanchayat  $gramPanchayat
     * @return \Illuminate\Http\Response
     */
    public function destroy(GramPanchayat $gramPanchayat)
    {
        //
    }
}
