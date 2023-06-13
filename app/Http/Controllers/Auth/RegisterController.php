<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\District;
use App\Models\State;
use App\Models\Block;
use App\Models\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'phone' => ['required', 'string', 'min:10', 'max:10'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
			'state' => ['required'],
			'district' => ['required'],
			'block' => ['required'],
			'captcha' => ['required', 'captcha'],
        ],
		['captcha.captcha' => 'Invalid Captcha']);
		
		
		
		$chkerro = false;
		$validator = Validator::make([],[]);
		
		if(empty($data['state'])){
			$chkerro = true;
			$validator->errors()->add("The state field is required");
		}
		if(empty($data['district'])){
			$chkerro = true;
			$validator->errors()->add("The district field is required");
		}
		if(empty($data['block'])){
			$chkerro = true;
			$validator->errors()->add("The block field is required");
		}
		
		if($chkerro){
			throw new ValidationException($validator);   
		}
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {   
	
		$rolearr = Role::where('slug', $data['role'])->select('id','slug','name')->first();
		if(!empty($data['state'])){ $state = State::find($data['state']); } 
		if(!empty($data['district'])){ $district = District::find($data['district']); } 
		if(!empty($data['block'])){ $block = Block::find($data['block']); } 
		
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
			'phone' => $data['phone'],
            'role' =>  $data['role'],
			'rolelabel' => $rolearr['name'],
			'role_id' => $rolearr['id'],
			'password' => Hash::make($data['password']),
        ]);
		
		

        if($user->id){
            $usermeta = new Usermeta();
            $usermeta->user_id = $user->id;
            if(!empty($state['name'])) $usermeta->state = $state['name'];
            if(!empty($district['name'])) $usermeta->district = $district['name'];
            if(!empty($block['name'])) $usermeta->block = $block['name'];
            if(!empty($data['city'])) $usermeta->city = $data['city'];
            if(!empty($data['udise'])) $usermeta->udise = $data['udise'];
			if(!empty($data['phone'])) $usermeta->mobile = $data['phone'];
            if(!empty($data['orgname'])) $usermeta->orgname = $data['orgname'];
            $usermeta->save();
        }
        return $user;
    }

   public function getDistrict(Request $request){
        $state_id = $request->id;
        $district_list = District::where('state_id', $state_id)->orderby('name', 'asc')->get();
        $district = '<option value="">Select District</option>';
        if(!empty($district_list)){
            foreach ($district_list as $dist) {
               $district .= '<option value="'.$dist['id'].'">'.$dist['name'].'</option>';
            }
        }
        return $district;

    }
    
    public function getBlock(Request $request){
        $block_id = $request->id;
        $block_list = Block::where('district_id', $block_id)->get();
        $block = '<option value="">Select Block</option>';
        if(!empty($block_list)){
            foreach ($block_list as $bck) {
               $block .= '<option value="'.$bck['id'].'">'.$bck['name'].'</option>';
            }
        }
		$block .= '<option value="unregistered">Unregistered</option>';
        return $block;

    }
}
