<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Response, Redirect;
use App\Models\Ambassador;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use Illuminate\Support\Facades\DB;

class AmbassadorController extends Controller
{
    
    public function index()
    {
        $states = State::all();
        return view('ambassador',compact('states'));
    }

    
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function AmbdStore(Request $request)
    {
        $image = '';
        $year = date("Y/m");
        if($request->file('image'))
        {
            $image = $request->file('image')->store($year,['disk'=>'uploads']);
            $image = url('wp-content/uploads/'.$image);
        }
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:champions|max:255',
            'contact' => 'required|numeric',
            'designation' => 'required|string|regex:/^[a-zA-Z]+$/u',
            'state_name' => 'required|string',
            'district_name' =>'required|string',
            'block_name' =>'required|string',
            'pincode' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,png,gif,svg|max:2048',
            'facebook_profile' => 'required|string',
            'twitter_profile' => 'required|string',
            'instagram_profile' => 'required|string',
            'work_profession' => 'required|string|regex:/^[a-zA-Z]+$/u',
            'description' => 'required|string|regex:/^[a-zA-Z]+$/u',

        ]);
        
        
        $state = State::where('id',$request->state_name)->first();
        
        $district = District::where('id',$request->district_name)->first();
        $block = Block::where('id',$request->block_name)->first();
    
        $ambassador = new Ambassador();
        $ambassador->name = $request->name;
        $ambassador->email = $request->email;
        $ambassador->contact = $request->contact;
        $ambassador->designation = $request->designation;
        $ambassador->state_name = $state->name;
        $ambassador->district_name = $district->name;
        $ambassador->block_name = $block->name;
        $ambassador->pincode = $request->pincode;
        $ambassador->image=$image;
        $ambassador->facebook_profile = $request->facebook_profile;
        $ambassador->twitter_profile = $request->twitter_profile;
        $ambassador->instagram_profile = $request->instagram_profile;
        $ambassador->work_profession = $request->work_profession;
        $ambassador->description = $request->description;
        $ambassador->save();
        return back()->with('success','Your Registration Done Sucessfully!!!Thank You');
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

    public function AmbsDistrict(Request $request)
    {
        
        $state_id = $request->id;

        $district_list = District::where('state_id', $state_id)->orderby('name', 'asc')->get();
        $district = '<option value="">Select District</option>';
        if(!empty($district_list)){
            foreach ($district_list as $dist) {
               $district .= '<option value="'.$dist['name'].'">'.$dist['name'].'</option>';
            }
        }
        return $district;

    }
    
    public function AmbsBlock(Request $request){
        $block_id = $request->id;
        $block_list = Block::where('district_id', $block_id)->get();
        $block = '<option value="">Select Block</option>';
        if(!empty($block_list))
        {
            foreach ($block_list as $bck)
             {
               $block .= '<option value="'.$bck['name'].'">'.$bck['name'].'</option>';
            }
        }
        return $block;

    }
}