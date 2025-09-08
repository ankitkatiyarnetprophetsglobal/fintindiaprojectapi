<?php

namespace App\Http\Controllers\v2\Api;

use App\Models;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\Challenge;
use App\Models\Loginlog;
use App\Models\Dotnetsignup;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use ErrorException;
use Exception;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use PDO;

class UserController extends Controller
{

	public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'logintest', 'store', 'storenew', 'check','getchallenge','logout','userProfile','update','updateDeleteChallengeRow','mobileregistration','socialregistraton','elogin','mlogin','updateone']]);
    }

	private $OPENSSL_CIPHER_NAME = "aes-128-cbc"; //Name of OpenSSL Cipher
    private $CIPHER_KEY_LEN = 16; //128 bits
    private $DB_SQL_CONNECTION = 'sqlsrv';
    private $DB_SQL_HOST = '10.72.163.124';
    private $DB_SQL_PORT = '1433';
    private $DB_DATABASE_SQL_NAME = 'FitIndia_Fitness';
    private $DB_SQL_PASSWORD = 'Adm$2^3#SqlServ';
    private $DB_SQL_USERNAME = 'sa';


	function encrypt($key, $iv, $data) {
        if (strlen($key) < $this->CIPHER_KEY_LEN) {
            $key = str_pad("$key", $this->CIPHER_KEY_LEN, "0"); //0 pad to len 16
        } else if (strlen($key) > $this->CIPHER_KEY_LEN) {
            $key = substr($str, 0, $this->CIPHER_KEY_LEN); //truncate to 16 bytes
        }

        $encodedEncryptedData = base64_encode(openssl_encrypt($data, $this->OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv));
        $encodedIV = base64_encode($iv);
        $encryptedPayload = $encodedEncryptedData.":".$encodedIV;

        return $encryptedPayload;

    }

    function decrypt($key, $iv, $data) {
        if (strlen($key) < $this->CIPHER_KEY_LEN) {
            $key = str_pad("$key", $this->CIPHER_KEY_LEN, "0"); //0 pad to len 16
        } else if (strlen($key) > $this->CIPHER_KEY_LEN) {
            $key = substr($str, 0, $this->CIPHER_KEY_LEN); //truncate to 16 bytes
        }

        // $parts = explode(':', $data);
        //$decryptedData = openssl_decrypt(base64_decode($parts[0]), $this->OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, base64_decode($parts[1]));

        $decryptedData = openssl_decrypt( base64_decode($data), $this->OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv);
        return $decryptedData;
    }


	function logintest(Request $request){

		try{
			$iv = "fedcba9876543210"; #Same as in JAVA
			$key = "0a9b8c7d6e5f4g3h"; #Same as in JAVA

			$data = $request->email;
			//$encrypted = $this->encrypt($key, $iv, $data);

			if (strpos($request->email, '=') == false) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Not valid email'
				), 422);
			}

			if (strpos($request->password, '=') == false) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Not valid password'
				), 422);
			}

			if (strpos($request->reqtime, '=') == false) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Not valid request'
				), 422);
			}



			$reqtimevar = $this->decrypt($key, $iv, $request->reqtime);


			$key = $reqtimevar . 'fitind';

			$email = $this->decrypt($key, $iv, $request->email);
			$password = $this->decrypt($key, $iv, $request->password);




			return Response::json(array(
				'token' => 'XTRTTRYRTYYYYYUUNYYYYUYNYYIU',
				'status'    => 'success',
				'code'      =>  200,
				'reqtime' => $request->reqtime,
				'message'   =>  array('msg'=>'You are successfully logged in')
			), 200);

		} catch(Exception $e) {

			return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'message'   =>  'Unauthorized : '.$e->getmessage()
				), 404);
		}
	}


	function check(Request $request){

		$email = $request->email;
        // echo "local";

		if(is_numeric($email)){

			$validator = Validator::make(
				array("phone" => $email),
				['phone' => 'required|digits:10']
			);

		} else if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

			$validator = Validator::make(array("email" => $email),[
				'email' => 'required|email',
			]);

		} else{
			return Response::json(array(
				'status' => 'error', 'code'  =>  422, 'message'   =>  'Invalid Input'
			), 422);
		}

		if($validator->fails()){
            return Response::json(array(
                'status'    => 'error',
                'code'      =>  422,
                'message'   =>  $validator->messages()->first()
            ), 422);
        }

		if(is_numeric($email)){

		    $user = User::where('phone', $request->email)->first();

		} else if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

			$user = User::where('email', $request->email)->first();
		}

		 //$user = User::where('email', $request->email)->first();

		 if($user){
			return Response::json(array(
                'status'    => 'success',
                'code'      =>  200,
                'message'   =>  'User exist with  '.$user->email
            ), 200);
		 }

		return Response::json(array(
                'status'    => 'error',
                'code'      =>  422,
                'message'   =>  'User not found'
            ), 422);
	}


	function login(Request $request){

		try{

			$iv = "fedcba9876543210"; #Same as in JAVA
			$key = "0a9b8c7d6e5f4g3h"; #Same as in JAVA
            $start = date( "Y-m-d 00:00:00");
            $end = date( "Y-m-d 23:59:59");
			$data = $request->email;
			//$encrypted = $this->encrypt($key, $iv, $data);

			// if (strpos($request->email, '=') == false) {
			// 	return Response::json(array(
			// 		'status'    => 'error',
			// 		'code'      =>  422,
			// 		'message'   =>  'Not valid email'
			// 	), 422);
			// }

			// if (strpos($request->password, '=') == false) {
			// 	return Response::json(array(
			// 		'status'    => 'error',
			// 		'code'      =>  422,
			// 		'message'   =>  'Not valid password'
			// 	), 422);
			// }

			// if (strpos($request->reqtime, '=') == false) {
			// 	return Response::json(array(
			// 		'status'    => 'error',
			// 		'code'      =>  422,
			// 		'message'   =>  'Not valid request'
			// 	), 422);
			// }

			/*
			if (strpos($request->rcaptcha, '=') == false) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Not valid request'
				), 422);
			}

			if(empty($request->captcha)) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Captcha Required'
				), 422);
			}

			*/

			$reqtimevar = $this->decrypt($key, $iv, $request->reqtime);
			//$rcaptchavar = $this->decrypt($key, $iv, $request->rcaptcha);
			/*
			if($request->captcha != $rcaptchavar) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Invalid Captcha'
				), 422);
			}
			*/
            // $key = $this->throttleKey($request);
            // // dd($key);
            // // If more than 3 wrong attempts, block login
            // if (RateLimiter::tooManyAttempts($key, 3)) {
            //     $seconds = RateLimiter::availableIn($key);
            //     return response()->json([
            //         'message' => 'Too many wrong login attempts. Please try again tomorrow.',
            //         'retry_after_seconds' => $seconds
            //     ], 429);
            // }

			$key = $reqtimevar . 'fitind';
            // $encrypted = $this->encrypt($key, $iv, $request->email);
			$email = $this->decrypt($key, $iv, $request->email);
			// $email = $request->email;
			// $email = 'ankit.katiyar4@netprophetsglobal.com';
			$password = $this->decrypt($key, $iv, $request->password);
			// $password = $request->password;
            // $password =  'Sai@123456';

            // dd($email);
            // dd($password);
			if(is_numeric($email)){

				$validator = Validator::make(
					array( "phone" => $email, "password" => $password),
					['phone' => 'required|digits:10', 'password' => 'required|string|min:6']
				);

			}else if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

				$validator = Validator::make( array( "email" => $email, "password" => $password ), [
					'email' => 'required|email',
					'password' => 'required|string|min:6',
				]);

			}else{
				dd(18);
				return Response::json(array(
					'status' => 'error', 'code'  =>  422, 'message'   =>  'Invalid Input'
				), 422);
			}



			if ($validator->fails()) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  $validator->messages()->first()
				), 422);

				//return response()->json($validator->errors(), 422);
			}

			// dd($password);
			// dd(Hash::make($password));

            $Loginlogcount = Loginlog::where('email', $email)->where('status','=', 1)->whereBetween('created_at',[$start,$end])->count();

            if($Loginlogcount >= 3){

                return Response::json(array(
                        'status'    => 'error',
                        'code'      =>  401,
                        'message'   =>  'You have reached the limit of 3 logins for today. Please try again tomorrow.'
                    ), 401);
            }

			if (! $token = auth('api')->attempt($validator->validated())) {

                // $Loginlogcount = Loginlog::where('email', $email)->where('status','=', 1)->whereBetween('created_at',[$start,$end])->count();

                $login_log = new Loginlog();
                $login_log->email = $email;
                $login_log->ip = $request->ip();
                $login_log->status = 1;
                $login_log->save();

				return Response::json(array(
					'status'    => 'error',
					'code'      =>  401,
					'message'   =>  'Unauthorized'
				), 401);
				// return response()->json(['error' => 'Unauthorized'], 401);
			}

            // $Loginlogcount = Loginlog::where('email', $email)->where('status','=', 1)->whereBetween('created_at',[$start,$end])->count();

            if($Loginlogcount > 0){
                Loginlog::where('email', $email)
                ->whereBetween('created_at', [$start, $end])
                ->update([
                    'status' => 0
                ]);
            }

			return Response::json(array(
				'token' => $this->createNewToken($token),
				'status'    => 'success',
				'code'      =>  200,
				'reqtime' => $request->reqtime,
				'message'   =>  array('msg'=>'You are successfully logged in')
			), 200);

		} catch(Exception $e) {

			return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'message'   =>  'Unauthorized : '.$e->getmessage()
				), 404);
		}
	}

	public function getAuthUser(Request $request)
    {
        return response()->json(auth('api')->user());
    }

    function store(Request $request){
		// dd($request->all());
		// dd($request->email);


		// dd('ankit katiyar');
		try{
			$iv = "fedcba9876543210"; #Same as in JAVA
			$key = "0a9b8c7d6e5f4g3h"; #Same as in JAVA.
			// $encrypted = $this->encrypt($key, $iv, $request->email);
			// $reqemail = $this->encrypt($key, $iv, $request->email);
			// dd($encrypted);

		if (strpos($request->email, '=') == false) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Not valid email'
				), 422);
			}

			if (strpos($request->password, '=') == false) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Not valid password'
				), 422);
			}

			if (strpos($request->reqtime, '=') == false) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Not valid request'
				), 422);
			}

			/*
			if (strpos($request->rcaptcha, '=') == false) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Not valid request'
				), 422);
			}

			if(empty($request->captcha)) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Captcha Required'
				), 422);
			}
			*/

			//$email = $this->decrypt($key, $request->email);
			//$password = $this->decrypt($key, $request->password);


			$reqtimevar = $this->decrypt($key, $iv, $request->reqtime);
			//$rcaptchavar = $this->decrypt($key, $iv, $request->rcaptcha);
			/*
			if($request->captcha != $rcaptchavar) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Invalid Captcha'
				), 422);
			}
			*/


			$key = $reqtimevar . 'fitind';

			$email = $this->decrypt($key, $iv, $request->email);
			$password = $this->decrypt($key, $iv, $request->password);
			$email = trim($email);
			// dd($email);
			// $rules=array(
			// 	// 'name' => ['required', 'string', 'max:255'],
			// 	'role' => ['required', 'in:subscriber,school,group' ],
			// 	'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			// 	// 'email' => ['required','unique:users','email'],
			// 	'phone' => ['required', 'string', 'min:10', 'max:10'],
			// 	'password' => ['required', 'string', 'min:8'],
			// 	//'age' => ['required', 'min:1','max:2' ],
			// );

		//    dd($rules);
			// $validator = Validator::make( array( "email" => $email, "password" => $password, "role"=> $request->role , "name" => $request->name, "phone" => $request->phone ), [
			$validator = Validator::make( array( "email" => $email, "password" => $password, "role"=> $request->role, "phone" => $request->phone ), [

				// 'name' => 'required|string|max:255',
				'role' => 'required|in:subscriber,school,group',
				// 'email' => 'required|email|max:255|unique:users',
				'email' => 'required|email|unique:users,email',
				'password' => 'required|string|min:6',
				'phone' => 'required|string|min:10|max:10'
			]);

			// $validator = Validator::make($request->all(),$rules);
			// $validator = Validator::make($request->all(),$rules);


			// dd($validator->messages());


			if($validator->fails())
			{
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  400,
					'message'   =>  array( 'msg'=>$validator->messages()->first() )
				), 400);

				return $validator->messages()->all();
			}

			if($request['name'] != ''){
				$name = $request['name'];
		   }else{
				$name = null;
		   }

			$user = User::create([
				'name' =>  $name,
				'email' => $email,
				'role' =>  $request->role,
				'phone' => $request->phone,
				'password' => Hash::make($password)
			]);


			// dd($user);



			if($user){

				$usermeta = new Usermeta();

				$usermeta->user_id = $user->id;
				if($request->phone) $usermeta->mobile = $request->phone;
				if($request->gender) $usermeta->gender = $request->gender;
				if($request->dob) $usermeta->dob = $request->dob;
				if($request->age) $usermeta->age = $request->age;
				if($request->address) $usermeta->address = $request->address;
				if($request->pincode) $usermeta->pincode = $request->pincode;
				if($request->height) $usermeta->height = $request->height;
				if($request->weight) $usermeta->weight = $request->weight;
				if($request->state) $usermeta->state = $request->state;
				if($request->district) $usermeta->district = $request->district;
				if($request->block) $usermeta->block = $request->block;
				if($request->city) $usermeta->city = $request->city;
				if($request->udise) $usermeta->udise = $request->udise;
				if($request->orgname) $usermeta->orgname = $request->orgname;
				$usermeta->save();


			}



			if($user->id){

					if ( $token = auth('api')->attempt($validator->validated())) {
						//return $this->createNewToken($token);
						$usertoken = $this->createNewToken($token);
					//}

					return Response::json(array(
						'token' => $usertoken,
						'status'    => 'success',
						'code'      =>  200,
						'reqtime' => $request->reqtime,
						'message'   =>  array('msg'=>'User has been created successfully')
					), 200);
				}
			}
			//return $user;

		} catch(Exception $e) {

			return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'message'   =>  'Unauthorized : '.$e->getmessage()
				), 404);
		}
    }


	function storenew(Request $request){
		try{
			$iv = "fedcba9876543210"; #Same as in JAVA
			$key = "0a9b8c7d6e5f4g3h"; #Same as in JAVA

			if (strpos($request->email, '=') == false) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Not valid email or phone'
				), 422);
			}

			if (strpos($request->password, '=') == false) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Not valid password'
				), 422);
			}

			if (strpos($request->reqtime, '=') == false) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Not valid request'
				), 422);
			}



			$reqtimevar = $this->decrypt($key, $iv, $request->reqtime);


			$key = $reqtimevar . 'fitind';

			$email = $this->decrypt($key, $iv, $request->email);
			$password = $this->decrypt($key, $iv, $request->password);



			if(is_numeric($email)){

				$validator = Validator::make(
					array("phone" => $email , "password" => $password ),
					['phone' => 'required|digits:10', 'password' => 'required|string|min:6',]
				);

				if($validator->fails()){
					return Response::json(array(
						'status'    => 'error',
						'code'      =>  400,
						'message'   =>  array( 'msg'=>$validator->messages()->first() )
					), 400);

				}


				$user = User::create([
					'phone' => $email,
					'password' => Hash::make($password),
					'via' => 1
				]);


				if($user->id){

					if ( $token = auth('api')->attempt($validator->validated())) {

						$usertoken = $this->createNewToken2($token);


						return Response::json(array(
							'token' => $usertoken,
							'status'    => 'success',
							'code'      =>  200,
							'reqtime' => $request->reqtime,
							'message'   =>  array('msg'=>'User has been created successfully')
						), 200);
					}
				}




			} else if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

				$validator = Validator::make(array("email" => $email , "password" => $password),
				[
					'email' => 'required|email', 'password' => 'required|string|min:6',
				]
				);

				if($validator->fails()){
					return Response::json(array(
						'status'    => 'error',
						'code'      =>  400,
						'message'   =>  array( 'msg'=>$validator->messages()->first() )
					), 400);

				}


				$user = User::create([
					'email' => $email,
					'password' => Hash::make($password),
					'via' => 1
				]);


			if($user->id){

				if ( $token = auth('api')->attempt($validator->validated())) {

					$usertoken = $this->createNewToken2($token);


					return Response::json(array(
						'token' => $usertoken,
						'status'    => 'success',
						'code'      =>  200,
						'reqtime' => $request->reqtime,
						'message'   =>  array('msg'=>'User has been created successfully')
					), 200);
				}
			}

			} else{
				return Response::json( array(
					'status' => 'error', 'code'  =>  422, 'message'   =>  'Invalid Input'
				), 422);
			}






		} catch(Exception $e) {

			return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'message'   =>  'Unauthorized : '.$e->getmessage()
				), 404);


		}
    }

	function updateone(Request $request){

		try{

			dd($request->all());

			}catch(Exception $e){
			dd($e->getMessage());
			return Response::json(array(
				'status'    => 'error',
				'code'      =>  401,
				'message'   =>  'Unauthorized'
			), 500);
		}
    }
	function update(Request $request){

		// try{
			$user = auth('api')->user();

			if($user){

				$json_data = json_decode($request->json_val,true);
				// dd($json_data);
				if($json_data==null){
					$json_data = json_decode(base64_decode($request->json_val),true);
				}
				$user = User::find($user->id);
				$email = $json_data['email'];
				User::where('id', $user->id)->update(['email' => $email]);

				$user->name = $json_data['name'];
				if(!empty($json_data['email'])) $user->phone = $json_data['email'];
				if(!empty($json_data['phone'])) $user->phone = $json_data['phone'];
				if(!empty($json_data['mobile'])) $user->phone = $json_data['mobile'];

				$user->save();

				$usermeta = Usermeta::where('user_id', $user->id)->first();

				if(!empty($json_data['phone'])) $usermeta->mobile = $json_data['phone'];
				if(!empty($json_data['mobile'])) $usermeta->mobile = $json_data['mobile'];
				if(!empty($json_data['gender'])) $usermeta->gender = $json_data['gender'];
				if(!empty($json_data['dob'])) $usermeta->dob = $json_data['dob'];
				if(!empty($json_data['age'])) $usermeta->age = $json_data['age'];
				if(!empty($json_data['address'])) $usermeta->address = $json_data['address'];
				if(!empty($json_data['pincode'])) $usermeta->pincode = $json_data['pincode'];
				if(!empty($json_data['height'])) $usermeta->height = $json_data['height'];
				if(!empty($json_data['weight'])) $usermeta->weight = $json_data['weight'];
				if(!empty($json_data['state'])) $usermeta->state = $json_data['state'];
				if(!empty($json_data['district'])) $usermeta->district = $json_data['district'];
				if(!empty($json_data['block'])) $usermeta->block = $json_data['block'];
				if(!empty($json_data['city'])) $usermeta->city = $json_data['city'];
				if(!empty($json_data['udise'])) $usermeta->udise = $json_data['udise'];
				if(!empty($json_data['orgname'])) $usermeta->orgname = $json_data['orgname'];
				if(!empty($json_data['profile_picurl'])) $usermeta->image = $json_data['profile_picurl'];



				$year = date("Y/m");



				if($request->file('profile_pic'))
				{
					/*
					$validator = Validator::make( array("profile_pic" => $request->file('profile_pic')),[
						'profile_pic' => 'required|mimes:png.jpg,jpeg',
					]);


					if($validator->fails())
					{
						return Response::json(array(
							'status'    => 'error',
							'code'      =>  400,
							'message'   =>  array( 'msg'=>$validator->messages()->first() )
						), 400);

					}
				*/

				try{
					$file = $request->file('profile_pic');
					$destinationPath = "/var/www/html/wp-content/uploads/2021/profile/";

					echo 'File Name: '.$file->getClientOriginalName(); echo '<br>';
					echo 'File Extension: '.$file->getClientOriginalExtension(); echo '<br>';
					echo 'File Real Path: '.$file->getRealPath(); echo '<br>';
					echo 'File Mime Type: '.$file->getMimeType(); echo '<br>';
					echo 'File Size: '.$file->getSize(); echo '<br>';
				}catch(Exception $e){
					// print_r($e);
				}
					/*



					$file = $request->file('profile_pic');
					$file_name = time().".".$file->getClientOriginalExtension();
					//wp-content/uploads/2021/profile
					$res = $file->move($destinationPath , $file_name);
					print_r($res);
					//$imageName1 = url('public/images/'.$file_name);
					//print_r($imageName1);
					exit();




					$imageName1 = $request->file('profile_pic')->store(['disk'=> 'public']);
					$imageName1 = url('wp-content/uploads/'.$imageName1);
					$usermeta->image = $imageName1;
					*/
				}

				$usermeta->save();
				if($user->id){

					$data = User::join('usermetas', 'users.id', '=', 'usermetas.user_id')->where("users.id", $user->id)->get(['users.id','users.role','users.name', 'users.email', 'users.phone', 'usermetas.*']);
					return Response::json(array(
						'status'    => 'success',
						'code'      =>  200,
						'user'   =>  $data
						), 200);

					return Response::json(array(
						'status'    => 'success',
						'code'      =>  200,
						'message'   =>  array('msg'=>'User has been updated successfully')
					), 200);
				}
			}else{
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  401,
					'message'   =>  'Unauthorized'
				), 401);
			}
		// }catch(Exception $e){
		// 	// dd($e);
		// 	dd($e->getMessage());
		// 	return Response::json(array(
		// 		'status'    => 'error',
		// 		'code'      =>  401,
		// 		'message'   =>  'Unauthorized'
		// 	), 500);
		// }
    }

     function update_new(Request $request){
        $user = auth('api')->user();
        if($user){


            $json_data = json_decode($request->json_val,true);
            $user = User::find($json_data['id']);
            $user->name = $json_data['name'];
            $user->save();

            $usermeta = Usermeta::where('user_id', $json_data['id'])->first();
            if(!empty($json_data['phone'])) $usermeta->mobile = $json_data['phone'];
            if(!empty($json_data['gender'])) $usermeta->gender = $json_data['gender'];
            if(!empty($json_data['dob'])) $usermeta->dob = $json_data['dob'];
            if(!empty($json_data['age'])) $usermeta->age = $json_data['age'];
            if(!empty($json_data['address'])) $usermeta->address = $json_data['address'];
            if(!empty($json_data['pincode'])) $usermeta->pincode = $json_data['pincode'];
            if(!empty($json_data['height'])) $usermeta->height = $json_data['height'];
            if(!empty($json_data['weight'])) $usermeta->weight = $json_data['weight'];
            if(!empty($json_data['state'])) $usermeta->state = $json_data['state'];
            if(!empty($json_data['district'])) $usermeta->district = $json_data['district'];
            if(!empty($json_data['block'])) $usermeta->block = $json_data['block'];
            if(!empty($json_data['city'])) $usermeta->city = $json_data['city'];
            if(!empty($json_data['udise'])) $usermeta->udise = $json_data['udise'];
            if(!empty($json_data['orgname'])) $usermeta->orgname = $json_data['orgname'];

            $year = date("Y/m");
            if($request->file('profile_pic'))
            {
                $imageName1 = $request->file('profile_pic')->store($year,['disk'=> 'uploads']);
                $imageName1 = url('wp-content/uploads/'.$imageName1);
                $usermeta->image = $imageName1;
            }

            $usermeta->save();
            if($user->id){

				$data = User::join('usermetas', 'users.id', '=', 'usermetas.user_id')->where("users.id", $user->id)->get(['users.id','users.role','users.name', 'users.email', 'users.phone', 'usermetas.*']);
				return Response::json(array(
					'status'    => 'success',
					'code'      =>  200,
					'user'   =>  $data
					 ),
					 200
				 );


            }
        }else{
             return Response::json(array(
                'status'    => 'error',
                'code'      =>  401,
                'message'   =>  'Unauthorized'
            ), 401);
        }
    }




	public function logout() {

       $logout = auth('api')->logout();

       return Response::json(array(
        'status'    => 'success',
        'code'      =>  200,
        'message'   =>  'User successfully signed out'
        ), 200);



       // return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile(Request $request) {

      // return response()->json(auth('api')->user());
       $user = auth('api')->user();


        if($user){

            $data = User::join('usermetas', 'users.id', '=', 'usermetas.user_id')->where("users.id", $user->id)
       ->get(['users.id','users.role','users.name', 'users.email', 'users.phone', 'usermetas.*']);
            return Response::json(array(
                'status'    => 'success',
                'code'      =>  200,
                'user'   =>  $data
                 ), 200);

        }else{
            return Response::json(array(
                'status'    => 'error',
                'code'      =>  401,
                'message'   =>  'Unauthorized'
            ), 401);
        }



    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        $user = auth('api')->user();

        $data = User::join('usermetas', 'users.id', '=', 'usermetas.user_id')->where("users.id", $user->id)
        ->get(['users.id', 'users.role', 'users.name', 'users.email', 'users.phone', 'usermetas.user_id', 'usermetas.dob', 'usermetas.age', 'usermetas.gender', 'usermetas.address', 'usermetas.state', 'usermetas.district', 'usermetas.block', 'usermetas.city', 'usermetas.orgname', 'usermetas.udise', 'usermetas.pincode', 'usermetas.height', 'usermetas.weight', 'usermetas.image', 'usermetas.board',
'usermetas.created_at', 'usermetas.updated_at' ]);



        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            //'user' => auth('api')->user()->usermeta()
            'user' => $data
        ]);
    }

	protected function createNewToken2($token){
        $user = auth('api')->user();

		$data = User::where( "users.id", $user->id )->get(['users.id', 'users.role', 'users.email', 'users.phone']);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            //'user' => auth('api')->user()->usermeta()
            'user' => $data
        ]);

    }

    function userdetail(Request $request){

		$user = auth('api')->user();

		if($user->id){

		    $email = $request->email;
			$messsages = array(
					'email.required'=>'Please enter the email.',
					'mobile.required'=>'Please enter the mobile number.',
					'mobile.numeric'=>'Please enter numeric value.',
					'mobile.digits'=>'Please enter min 10 digit number.',
			);

		   if(!empty($email) && is_numeric($email) && $email=='0000000000'){

			  /*return Response::json(array(
					'status' => 'error', 'code'=> 500, 'data' =>'[]'
				), 500);*/

			} else if(!empty($email) && is_numeric($email) && $email!='0000000000'){

				$validator = Validator::make( array("phone" => $email),['phone' => 'required|digits:10'],$messsages);


			} else if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

				$validator = Validator::make(array("email" => $email),[
					'email' => 'required|email',
				]);

			} else {

				/*return Response::json(array(
					'status' => 'error', 'code'  =>  422, 'message'   =>  'Invalid Input'
				), 422);*/
			}

			// if($validator->fails()){
			// 	return Response::json(array(
			// 		'status'    => 'error',
			// 		'code'      =>  422,
			// 		'message'   =>  $validator->messages()->first()
			// 	), 422);
			// }

			if(is_numeric($email)){

				$user = User::where('phone', $request->email)->get();

			} else if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

				$user = User::where('email', $request->email)->get();
			}

			$marray=array();
			$userdata='';

			if(!empty($user)){

				// update code for school role
				if($user[0]->role == 'school' && $user[0]->role != auth('api')->user()->role){
					return Response::json(array(
						'status'    => 'error',
						'code'      =>  422,
						'message'   =>  'User not found'
					), 422);
				}
				// update code for school role

			  foreach($user as $val){
				 $userdata=array(
						"id" => $val->id,
						"name" => $val->name,
						"email" => $val->email,
						"phone" => $val->phone,
						"role" => $val->role,
				   );

				  array_push($marray,$userdata);
			}

			return Response::json(array(
				'status'    => 'success',
				'code'      =>  200,
				'data'   => !empty($marray) ? $marray : @$marray
			  ), 200);
			}

			return Response::json(array(
				'status'    => 'error',
				'code'      =>  422,
				'message'   =>  'User not found'
			), 422);

			}else{
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  401,
					'message'   =>  'Unauthorized'
				), 401);
			}
	}

	function userchallenge(Request $request)
	{
	    $user = auth('api')->user();
		$marray=array();
		$chkemail=array();
		$email = $request->email;
		$rules = array(
				'email.required'=>'Please enter the email.',
				'email.email'=>'Please enter valid email.',
		);

		$myArray = explode(',', $email);
		$chflag='0';
		$flag='';

		foreach($myArray as $key => $val){

			$rules['email.'.$key] = 'required|email';
			$validator = Validator::make(array("email" => $myArray),$rules);
			$kuser = User::where('email', '=', $val)->first();

			if(!empty($kuser->email)){

				 $userdata=array(
						"from_userid" => $user->id,
						"from_email" => $user->email,
						"name" => $kuser->name,
						"to_userid" => $kuser->id,
						"to_email" => $kuser->email,
						"phone" => $kuser->phone,
						"role" => $kuser->role,
				   );

				  array_push($marray,$userdata);

			} else {

				array_push($chkemail,$val);
				$chflag='1';
			}
        }


		if(!empty($marray))
		{

			foreach($marray as $vl)
			{

			 $cdata = DB::select("select * from challenge where from_userid='".$vl['from_userid']."' AND to_userid='".$vl['to_userid']."' order by id asc");
			 if(count($cdata) > 0 )
			 {
				$cid = $cdata[0]->id;

				$challenge  = Challenge::find($cid);
				$challenge->from_userid = $vl['from_userid'];
				$challenge->from_email = $vl['from_email'];
				$challenge->to_userid = $vl['to_userid'];
				$challenge->to_email = $vl['to_email'];
				$challenge->status = "0";

				$flag='update';
			 }
			 else
			 {

				$challenge = new Challenge;
				$challenge->from_userid = $user->id;
				$challenge->from_email = $user->email;
				$challenge->to_userid = $vl['to_userid'];
				$challenge->to_email = $vl['to_email'];
				$challenge->status = "0";
				$challenge->save();

                $flag='insert';
			  }
			}
		}

		$comma_separated = implode(", ", $chkemail);

		if($flag=='update')
		{
			if ($chflag == '1')
			{
				return response()->json([
					'success' => false,
					'message' => 'Data not updated',
					'rejected_emails' => $comma_separated
				  ], 200);
			}
			else
			{
				return response()->json([
					'success' => true,
					'message' => 'Data successfully updated'
				  ], 200);
			}
		}
		else
		{
			if ($chflag == '1')
			{
				return response()->json([
					'success' => false,
					'message' => 'Data not inserted',
					'rejected_emails' => $comma_separated
				  ], 200);
			}
			else
			{
				return response()->json([
					'success' => true,
					'message' => 'Data successfully inserted'
				  ], 200);
			}
		}
	}

	function getchallenge(Request $request){
		$user = auth('api')->user();

		if(!empty($user)){
		    $email = $user->email;
			$messsages = array(
					'email.required'=>'Please enter the email.',
					'email.email'=>'Please enter valid email.',

			);

		   if(filter_var($email, FILTER_VALIDATE_EMAIL)){

				$validator = Validator::make(array("email" => $email),[
					'email' => 'required|email',
				]);

			} else {
				return Response::json(array(
					'status'=>'error','code'=>422,'message'=>'Invalid Input'
				), 422);
			}

			if($validator->fails()){
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  $validator->messages()->first()
				), 422);
			}

			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				$challenge = DB::table('challenge')
							->leftJoin('users as u1', 'challenge.from_email','=','u1.email')
							->leftJoin('users as u2', 'challenge.to_email','=','u2.email')
							->where('challenge.from_email', $email)
							->orWhere('challenge.to_email', $email)
							->select('challenge.*', 'u1.name as from_name', 'u2.name as to_name')
							->take(15)
							->get();
		    }
			$marray=array();
			$userdata='';

			if(!empty($challenge)){
			  foreach($challenge as $val){
				 $userdata=array(
						"id" => $val->id,
						"from_userid" => $val->from_userid,
						"to_userid" => $val->to_userid,
						"from_email" => $val->from_email,
						"to_email" => $val->to_email,
						"status" => $val->status,
						"from_name" => $val->from_name,
						"to_name" => $val->to_name,
						"created_at" => $val->created_at,
						"updated_at" => $val->updated_at,
				   );

				  array_push($marray,$userdata);
			}

			return Response::json(array(
				'status'    => 'success',
				'code'      =>  200,
				'data'   => !empty($marray) ? $marray : 'Data Not Found'
			  ), 200);
			}

			return Response::json(array(
				'status'    => 'error',
				'code'      =>  422,
				'message'   =>  'User not found'
			), 422);

			}else{
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  401,
					'message'   =>  'Unauthorized'
				), 401);
			}
	}

	function updateDeleteChallengeRow(Request $request){
		$user = auth('api')->user();
		if($user->id){
			$msg='';
			$operation = $request->operation; //2 => delete, 1-> update
			$from_userid = $request->from_userid;
			$to_userid = $request->to_userid;
			$status = $request->status;
			$challenge_data = DB::table('challenge')->where('from_userid', $from_userid)->where('to_userid',$to_userid)->first();
			if(!empty($challenge_data)){
				if($operation=='2'){
					$result = DB::table('challenge')->where('from_userid', $from_userid)->where('to_userid',$to_userid)->delete();
					$msg = "Row Deleted";
				}elseif($operation=='1'){
					$result = DB::table('challenge')->where('from_userid', $from_userid)->where('to_userid',$to_userid)->update(array('status' => $status));
					$msg = "Row Updated";
				}else{
					$msg = "Wrong Status";
				}
			}else{
				$msg = "Data Not Found";
			}
			if(isset($result)){
				return Response::json(array(
						'status' => 'success',
						'code'   => 200,
						'message' => $msg
					), 200);
			}else{
				return Response::json(array(
						'status'    => 'error',
						'code'      =>  422,
						'message'   =>  $msg
					), 422);
			}
		}else{
			return Response::json(array(
					'status'    => 'error',
					'code'      =>  401,
					'message'   =>  'Unauthorized'
				), 401);
		}

	}
	function socialregistraton(Request $request){

		try{
			// dd(99999);
			$iv = "fedcba9876543210"; #Same as in JAVA
			$key = "0a9b8c7d6e5f4g3h"; #Same as in JAVA.

			// if (strpos($request->email, '=') == false) {
			if (strpos($request->email, '=') == false && $request->medium != 'apple') {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Not valid email'
				), 422);
			}

			if (strpos($request->reqtime, '=') == false) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Not valid request'
				), 422);
			}

			$reqtimevar = $this->decrypt($key, $iv, $request->reqtime);

			$key = $reqtimevar . 'fitind';
			$emailtrim = trim($request->email);
			if(isset($request->email)){

			}
			$email = $this->decrypt($key, $iv, $emailtrim);
			$password = "Sai@1234";
			$deviceid = $request->deviceid;
			$FCMToken = $request->FCMToken;
			$medium = $request->medium;
			$authid = $request->authid;
			$viamedium = $request->viamedium;
			$email = trim($email);

			// only for apple not given email
			if($medium != 'apple' && $email == ''){

				if($deviceid == '' || $authid == '' || $email == ''){
					return Response::json(array(
						'status'    => 'error',
						'code'      =>  422,
						'message'   =>  "Required Filed"
					), 422);
				}
			}

			if($medium == 'apple' && $email == ''){

				if($deviceid == '' || $authid == ''){

					return Response::json(array(
						'status'    => 'error',
						'code'      =>  422,
						'message'   =>  "Required Filed"
					), 422);

				}
			}

			// only for apple not given email
			if($medium == 'apple' && $email == false){

				$email = 'undefined';
				// dd($authid);
				$user_table = User::where('authid' , '=', $authid)->get();
				$usercount = $user_table->count();
				// dd($usercount);
				if($usercount == 0){

					$validator = Validator::make( array( "email" => $email, "password" => $password, "role"=> $request->role), [

						'role' => 'required|in:subscriber',
						'email' => 'required',
						// 'authid' => 'required|authid|unique:users,authid',
						'authid' => 'unique:users,authid',
						'password' => 'required|string|min:6',
					]);

				}else{

					return Response::json(array(
							'status'    => 'error',
							'code'      =>  400,
							'message'   =>  array( 'msg'=> "Auth id is duplicate")
						), 400);

				}

			}else if($medium != 'apple' && $email != ''){

				$validator = Validator::make(array("email" => $email, "password" => $password, "role"=> $request->role), [

					'role' => 'required|in:subscriber',
					'email' => 'required|email|unique:users,email',
					'authid' => 'unique:users,authid',
					'password' => 'required|string|min:6',
				]);

				if($validator->fails()){

					return Response::json(array(
						'status'    => 'error',
						'code'      =>  400,
						'message'   =>  array( 'msg'=>$validator->messages()->first() )
					), 400);
				}

			}else if($medium == 'apple' && $email != ''){

				$validator = Validator::make(array("email" => $email, "password" => $password, "role"=> $request->role), [

					'role' => 'required|in:subscriber',
					'email' => 'required|email|unique:users,email',
					'password' => 'required|string|min:6',
				]);

				if($validator->fails()){

					return Response::json(array(
						'status'    => 'error',
						'code'      =>  400,
						'message'   =>  array( 'msg'=>$validator->messages()->first() )
					), 400);
				}

			}
			else{

				return Response::json(array(
							'status'    => 'error',
							'code'      =>  400,
							'message'   =>  array( 'msg'=> "Something Went Wrong")
						), 400);
			}

			if($request->name == ''){

				$name = $request->name;
			}else{

				$name = null;
			}

			$user = User::create([
				'name' =>  $name,
				'email' => $email,
				'role' =>  $request->role,
				'phone' => $request->phone,
				'deviceid' => $deviceid,
				'FCMToken' => $FCMToken,
				'authid' => $authid,
				'viamedium' => $viamedium,
				'password' => Hash::make($password)
			]);

			if($user){
				$usermeta = new Usermeta();
				$usermeta->user_id = $user->id;
				// $usermeta->user_id = 1866791;
				if($request->phone) $usermeta->mobile = $request->phone;
				if($request->gender) $usermeta->gender = $request->gender;
				if($request->dob) $usermeta->dob = $request->dob;
				if($request->age) $usermeta->age = $request->age;
				if($request->address) $usermeta->address = $request->address;
				if($request->pincode) $usermeta->pincode = $request->pincode;
				if($request->height) $usermeta->height = $request->height;
				if($request->weight) $usermeta->weight = $request->weight;
				if($request->state) $usermeta->state = $request->state;
				if($request->district) $usermeta->district = $request->district;
				if($request->block) $usermeta->block = $request->block;
				if($request->city) $usermeta->city = $request->city;
				if($request->udise) $usermeta->udise = $request->udise;
				if($request->orgname) $usermeta->orgname = $request->orgname;
				if($request->medium) $usermeta->medium = $request->medium;
				if($medium == 'gmail'){

					if($request->gmail) $usermeta->gmail = $request->gmail;

				}elseif($request->medium == 'facebook'){

					if($request->facebook) $usermeta->facebook = $request->facebook;

				}elseif($request->medium == 'apple'){

					if($request->apple) $usermeta->apple = $request->apple;

				}

				$usermeta->save();

			}

			if($user->save()){

				if ( $token = auth('api')->attempt($validator->validated())) {

					$usertoken = $this->createNewToken($token);

					return Response::json(array(
						'token' => $usertoken,
						'status'    => 'success',
						'code'      =>  200,
						'reqtime' => $request->reqtime,
						'message'   =>  array('msg'=>'User has been created successfully')
					), 200);
				}
			}

		} catch(Exception $e) {

			return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'message'   =>  'Unauthorized : '.$e->getmessage()
				), 404);
		}
	}

	function mobileregistration(Request $request){
		// dd(123456);
		try{
			$iv = "fedcba9876543210"; #Same as in JAVA
			$key = "0a9b8c7d6e5f4g3h"; #Same as in JAVA.

			$phone = $request->phone;
			$role = $request->role;
			$device = $request->device;
			$FCMToken = $request->FCMToken;
			$reqtime = $request->reqtime;
			$viamedium = $request->viamedium;
            $password = "Sai@1234";

			if ($phone == '' || $role == '' || $device == '' || $FCMToken == '' || $reqtime == '') {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  "Required Filed"
				), 422);
			}

			if(strpos($reqtime, '=') == false){
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Not valid request'
				), 422);
			}

			$reqtimevar = $this->decrypt($key, $iv, $reqtime);
			$key = $reqtimevar . 'fitind';

			$validator = Validator::make( array( "phone" => $phone, "password" => $password, "role"=> $role), [

				'role' => 'required|in:subscriber',
				'phone' => 'required|string|min:10|max:10|unique:users,phone',
				'password' => 'required|string|min:6',

			]);

			if($validator->fails()){

				return Response::json(array(
					'status'    => 'error',
					'code'      =>  400,
					'message'   =>  array( 'msg'=>$validator->messages()->first() )
				), 400);
			}

		   	if($request->name == ''){

				$name = $request->name;
		   	}else{

				$name = null;
		   	}
			$user = new User();
			$user->name = $name;
			$user->email = 'undefined';
			$user->role = $request->role;
			$user->phone = $request->phone;
			$user->deviceid = $device;
			$user->viamedium = $viamedium;
			$user->FCMToken = $FCMToken;
			$user->password = Hash::make($password);

			// $user = User::create([
			// 	'name' =>  $name,
			// 	'email' => 'undefined',
			// 	'role' =>  $request->role,
			// 	'phone' => $request->phone,
			// 	'deviceid' => $device,
			// 	'viamedium' => $viamedium,
			// 	'FCMToken' => $FCMToken,
			// 	'password' => Hash::make($password)
			// ]);

			if($user->save()){
				$usermeta = new Usermeta();
				$usermeta->user_id = $user->id;
				// $usermeta->user_id = 1866770;
				if($request->mobile) $usermeta->mobile = $request->phome;
				if($request->gender) $usermeta->gender = $request->gender;
				if($request->dob) $usermeta->dob = $request->dob;
				if($request->age) $usermeta->age = $request->age;
				if($request->address) $usermeta->address = $request->address;
				if($request->pincode) $usermeta->pincode = $request->pincode;
				if($request->height) $usermeta->height = $request->height;
				if($request->weight) $usermeta->weight = $request->weight;
				if($request->state) $usermeta->state = null;
				if($request->district) $usermeta->district = null;
				if($request->block) $usermeta->block = $request->block;
				if($request->city) $usermeta->city = $request->city;
				if($request->udise) $usermeta->udise = $request->udise;
				if($request->orgname) $usermeta->orgname = $request->orgname;
				$usermeta->save();
			}

			if($user->id){
				if ($token = auth('api')->attempt($validator->validated())) {
					$usertoken = $this->createNewToken($token);
					return Response::json(array(
						'token' => $usertoken,
						'status'    => 'success',
						'code'      =>  200,
						'reqtime' => $request->reqtime,
						'message'   =>  array('msg'=>'User has been created successfully')
					), 200);
				}
			}

		} catch(Exception $e) {

			return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'message'   =>  'Unauthorized : '.$e->getmessage()
				), 404);
		}
	}

    function elogin(Request $request){

		try{
			$iv = "fedcba9876543210"; #Same as in JAVA
			$key = "0a9b8c7d6e5f4g3h"; #Same as in JAVA

			$data = $request->email;
			// $password = 'Sai@1234';
			//$encrypted = $this->encrypt($key, $iv, $data);

			if (strpos($request->email, '=') == false && $request->medium != 'apple') {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Not valid email'
				), 422);
			}

			if (strpos($request->reqtime, '=') == false) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Not valid request'
				), 422);
			}


			$reqtimevar = $this->decrypt($key, $iv, $request->reqtime);

			$key = $reqtimevar . 'fitind';

			$emailtrim = trim($request->email);
			$email = $this->decrypt($key, $iv, $emailtrim);
			// $email = $request->email;
            // dd($email);
            // $password = $this->decrypt($key, $iv, $request->password);
			// $password = "Sai@1234";
			$deviceid = $request->deviceid;
			$authid = $request->authid;
			$FCMToken = $request->FCMToken;
			$medium = $request->medium;

			// if(($email == '' || $deviceid == '' || $medium == '' || $authid == '') && $medium != 'apple'){
			// if($email == '' || $deviceid == '' || $medium == '' || $authid == ''){
			if($deviceid == '' || $medium == '' || $authid == ''){
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  "Required Filed"
				), 422);
			}


			if(is_numeric($email)){

				$validator = Validator::make(
					array( "phone" => $email),
					['phone' => 'required|digits:10', 'password' => 'required|string|min:6']
				);

			}else if (filter_var($email, FILTER_VALIDATE_EMAIL) && $medium != 'apple') {

				$validator = Validator::make( array( "email" => $email ), [
					'email' => 'required|email',
				]);

			}else if($authid != "" && $medium == 'apple') {
				$validator = Validator::make( array("authid" => $authid ), [
					'authid' => 'required',
				]);
			}else{
				return Response::json(array(
					'status' => 'error', 'code'  =>  422, 'message'   =>  'Invalid Input'
				), 422);
			}

			// dd('233233');

			if ($validator->fails()) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  $validator->messages()->first()
				), 422);

			}
			// email with auth id
			if($email != null || $email != ''){

				$user = User::whereEmail($email)->first();

                if($user != null){
                    if (!JWTAuth::fromUser($user)) { //! $token = JWTAuth::attempt($validator->validated())

                        //$token = auth()->tokenById($user->id);
                        return Response::json(array(
                            'status'    => 'error',
                            'code'      =>  401,
                            'message'   =>  'Unauthorized'
                        ), 401);
                    }
                }else{

					return Response::json(array(
						'status'    => 'error',
						'code'      =>  401,
						'message'   =>  'User Not Found'
					), 401);

				}

				if($user->deviceid == null || $user->authid == null ){
					User::where('id', $user->id)->update(['deviceid' => $deviceid, 'authid' => $authid]);
				}

				if($token = JWTAuth::fromUser($user)){

						$data = User::join('usermetas', 'users.id', '=', 'usermetas.user_id')->where("users.id", $user->id)
									->get(['users.id', 'users.role', 'users.name', 'users.email', 'users.phone', 'usermetas.user_id', 'usermetas.dob', 'usermetas.age', 'usermetas.gender', 'usermetas.address', 'usermetas.state', 'usermetas.district', 'usermetas.block', 'usermetas.city', 'usermetas.orgname', 'usermetas.udise', 'usermetas.pincode', 'usermetas.height', 'usermetas.weight', 'usermetas.image', 'usermetas.board',
									'usermetas.created_at', 'usermetas.updated_at' ]);
						$token_data = response()->json([
							'access_token' => $token,
							'token_type' => 'bearer',
							'expires_in' => auth('api')->factory()->getTTL() * 60,
							'user' => $data
						]);

					return Response::json(array(
										'token' => $token_data,
										'status'    => 'success',
										'code'      =>  200,
										'reqtime' => $request->reqtime,
										'message'   =>  array('msg'=>'You are successfully logged in')
									), 200);
				}
				else{
					return response()->json(['error'=>'Unauthorised'], 401);
				}

			}else{ // without email and with auth id

				// $user = User::whereAuthid($authid)->first();
				$user = User::whereAuthid($authid)->orderby('id','desc')->first();
				// dd($user);
				if($user == null){
					return Response::json(array(
						'status'    => 'error',
						'code'      =>  401,
						'message'   =>  'Unauthorized'
					), 401);
				}
				if (!JWTAuth::fromUser($user)) { //! $token = JWTAuth::attempt($validator->validated())

					//$token = auth()->tokenById($user->id);
					return Response::json(array(
						'status'    => 'error',
						'code'      =>  401,
						'message'   =>  'Unauthorized'
					), 401);
				}
				if($user->deviceid == null || $user->authid == null ){
					User::where('id', $user->id)->update(['deviceid' => $deviceid, 'authid' => $authid]);
				}

				if($token = JWTAuth::fromUser($user)){

						$data = User::join('usermetas', 'users.id', '=', 'usermetas.user_id')->where("users.id", $user->id)
									->get(['users.id', 'users.role', 'users.name', 'users.email', 'users.phone', 'usermetas.user_id', 'usermetas.dob', 'usermetas.age', 'usermetas.gender', 'usermetas.address', 'usermetas.state', 'usermetas.district', 'usermetas.block', 'usermetas.city', 'usermetas.orgname', 'usermetas.udise', 'usermetas.pincode', 'usermetas.height', 'usermetas.weight', 'usermetas.image', 'usermetas.board',
									'usermetas.created_at', 'usermetas.updated_at' ]);
						$token_data = response()->json([
							'access_token' => $token,
							'token_type' => 'bearer',
							'expires_in' => auth('api')->factory()->getTTL() * 60,
							'user' => $data
						]);

					return Response::json(array(
										'token' => $token_data,
										'status'    => 'success',
										'code'      =>  200,
										'reqtime' => $request->reqtime,
										'message'   =>  array('msg'=>'You are successfully logged in')
									), 200);
				}
				else{
					return response()->json(['error'=>'Unauthorised'], 401);
				}
			}

			// dd(12345);



			// $user = user::whereemail('bhavishyagulati@gmail.com')->first();
			// // $userToken=JWTAuth::fromUser($user);
			// dd($user);
			// $user=user::where('email','=','user2@gmail.com')->first();




			// old code
			// if (!$userToken=JWTAuth::fromUser($user)) {
			// 			return response()->json(['error' => 'invalid_credentials'], 401);
			// 		}

			// return response()->json(compact('userToken'));

			// return Response::json(array(
			// 	'token' => $this->createNewToken($token),
			// 	'status'    => 'success',
			// 	'code'      =>  200,
			// 	'reqtime' => $request->reqtime,
			// 	'message'   =>  array('msg'=>'You are successfully logged in')
			// ), 200);

		} catch(Exception $e) {

			return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'message'   =>  'Unauthorized : '.$e->getmessage()
				), 404);
		}
	}

	function mlogin(Request $request){

		try{
			$iv = "fedcba9876543210"; #Same as in JAVA
			$key = "0a9b8c7d6e5f4g3h"; #Same as in JAVA

			$mobile = $request->mobile;

			if (strpos($request->reqtime, '=') == false) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Not valid request'
				), 422);
			}

			$reqtimevar = $this->decrypt($key, $iv, $request->reqtime);

			$key = $reqtimevar . 'fitind';

			$deviceid = $request->deviceid;
			$FCMToken = $request->FCMToken;
			$medium = $request->medium;

			if($mobile == '' || $deviceid == '' || $medium == ''){
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  "Required Filed"
				), 422);
			}

			if(is_numeric($mobile)){

				$validator = Validator::make(
					array( "phone" => $mobile),
					[
						'phone' => 'required|digits:10',
					]
				);

			}
			else{

				return Response::json(array(
					'status' => 'error', 'code'  =>  422, 'message'   =>  'Invalid Input'
				), 422);

			}

			if ($validator->fails()) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  $validator->messages()->first()
				), 422);
			}

			$user = User::wherephone($mobile)->first();

            if($user != null){

                if ($user == null) { //! $token = JWTAuth::attempt($validator->validated())
                    return Response::json(array(
                        'status'    => 'error',
                        'code'      =>  401,
                        'message'   =>  'Unauthorized'
                    ), 401);
                }

            }else{

                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  401,
                    'message'   =>  'User Not Found'
                ), 401);

            }
			if($user->deviceid == null ){
				User::where('id', $user->id)->update(['deviceid' => $deviceid]);
			}

			if($token = JWTAuth::fromUser($user)){

					$data = User::join('usermetas', 'users.id', '=', 'usermetas.user_id')->where("users.id", $user->id)
								->get(['users.id', 'users.role', 'users.name', 'users.email', 'users.phone', 'usermetas.user_id', 'usermetas.dob', 'usermetas.age', 'usermetas.gender', 'usermetas.address', 'usermetas.state', 'usermetas.district', 'usermetas.block', 'usermetas.city', 'usermetas.orgname', 'usermetas.udise', 'usermetas.pincode', 'usermetas.height', 'usermetas.weight', 'usermetas.image', 'usermetas.board',
								'users.created_at', 'users.updated_at' ]);
					$token_data = response()->json([
						'access_token' => $token,
						'token_type' => 'bearer',
						'expires_in' => auth('api')->factory()->getTTL() * 60,
						'user' => $data
					]);

				return Response::json(array(
									'token' => $token_data,
									'status'    => 'success',
									'code'      =>  200,
									'reqtime' => $request->reqtime,
									'message'   =>  array('msg'=>'You are successfully logged in')
								), 200);
			}
			else{
				return response()->json(['error'=>'Unauthorised'], 401);
			}

		} catch(Exception $e) {

			return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'message'   =>  'Unauthorized : '.$e->getmessage()
				), 404);
		}
	}

    protected function throttleKey(Request $request){

        // Use email as the unique key for rate limiting
        return Str::lower($request->input('email')) . '|login';
    }
}
