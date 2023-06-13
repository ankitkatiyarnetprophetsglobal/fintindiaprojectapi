<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Response, Redirect;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use App\Models\Champion;
use Illuminate\Support\Facades\DB;

class ChampionController extends Controller
{
    
    public function index()
    {
        $states = State::all();
        return view('champion',compact('states'));
    }
	
    public function store()
    {

    }

    
    
    public function ChampStore(Request $request)
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
            'work_profession' => 'required|string',
            'description' => 'required|string',

        ]);
        $state = State::where('id', $request->state_name)->first();
        $district = District::where('id', $request->district_name)->first();
        $block = Block::where('id', $request->block_name)->first();
    
        $champion = new Champion();
        $champion->name = $request->name;
        $champion->email = $request->email;
        $champion->contact = $request->contact;
        $champion->designation = $request->designation;
        $champion->state_name = $state->name;
        $champion->district_name = $district->name;
        $champion->block_name = $block->name;
        $champion->pincode = $request->pincode;
        $champion->image=$image;
        $champion->facebook_profile = $request->facebook_profile;
        $champion->twitter_profile = $request->twitter_profile;
        $champion->instagram_profile = $request->instagram_profile;
        $champion->work_profession = $request->work_profession;
        $champion->description = $request->description;
        $champion->save();
        return back()->with('success','Your Registration Done Sucessfully!!!Thank You');
    }

    
   
    public function ChampDistrict(Request $request)
    {
        $state_id = $request->id;
        $district_list = District::where('state_id', $state_id)->orderby('name', 'asc')->get();
		
		//dd($district_list);
		
        $district = '<option value="">Select District</option>';
        if(!empty($district_list)){
            foreach ($district_list as $dist) {
               $district .= '<option value="'.$dist['id'].'">'.$dist['name'].'</option>';
            }
        }
		
        return $district;

    }
    
    public function ChampBlock(Request $request){
        $block_id = $request->id;
        $block_list = Block::where('district_id', $block_id)->get();
        $block = '<option value="">Select Block</option>';
        if(!empty($block_list)){
            foreach ($block_list as $bck) {
               $block .= '<option value="'.$bck['id'].'">'.$bck['name'].'</option>';
            }
        }
        return $block;

    }
}
