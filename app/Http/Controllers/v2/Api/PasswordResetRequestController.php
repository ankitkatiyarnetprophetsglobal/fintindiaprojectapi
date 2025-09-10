<?php
namespace App\Http\Controllers\v2\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\SendMailreset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\OtpTrack;

class PasswordResetRequestController extends Controller{ 

	private $OPENSSL_CIPHER_NAME = "aes-128-cbc"; //Name of OpenSSL Cipher 
    private $CIPHER_KEY_LEN = 16; 

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
            $key = str_pad("$key", $this->CIPHER_KEY_LEN, "0"); 
        } else if (strlen($key) > $this->CIPHER_KEY_LEN) {
            $key = substr($str, 0, $this->CIPHER_KEY_LEN); 
        }
       
        $decryptedData = openssl_decrypt( base64_decode($data), $this->OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv);
        return $decryptedData;
    }

	///By Ankit ji

	public function sendMailOtp($email,$otp){

		
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://10.246.120.18/test/mail/example2.php?email=$email&otp=$otp",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
		));
		
		$response = curl_exec($curl);
		//dd($response);
		curl_close($curl);
		//$new_response = json_decode($response, true);
		if($response){
			return true;
		}else{
			return false;
		}

	}

	///By Ankit ji	
	
    public function sendEmail(Request $request){
		
		// dd(123456);
		
		try{ 
			$iv = "fedcba9876543210"; 
			$key = "0a9b8c7d6e5f4g3h";
				
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
			
			
			
			$validator = Validator::make(array("email" => $email), [
				'email' => 'required|email',
			]);
		
		
			/*
			$validator = Validator::make($request->all(), [
				'email' => 'required|email',
			]);
			*/
		
			if ($validator->fails()) {
				return Response::json(array(
					'success' => false,
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  $validator->messages()->first()
				), 422);
			}


			
		
			$userverf = User::where('email', $email)->first();
			$phone = $userverf['phone'];
			if(!empty($userverf)){
				$otp = mt_rand(100000,999999);
				$otptoken = mt_rand(100000,999999);
				// dd($otp);
				$start = date( "Y-m-d 00:00:00");
				$end = date( "Y-m-d 23:59:59");
				
				$otpcnt = OtpTrack::where('email', $email)->where('type','password')->whereBetween('created_at',[$start,$end])->count();
				// print_r($otpcnt); 
				
				if($otpcnt > 20){				
					return Response::json(array(
							'status'    => 'error',
							'code'      =>  401,
							'message'   =>  'Your request limit exceeds'
						), 401);
				}
				
				$passverf = DB::table('userpassverification')->where('email', $email)->first();
				
				if(empty($passverf)){
					
					$passverfotp = DB::table('userpassverification')->insert( ['email'=> $email, 'otp'=> $otp, 'otptoken'=> $otptoken] );
					// dd($passverfotp);
					if($passverfotp){
					
						
						
						$otptrc = new OtpTrack();
						$otptrc->email = $email;
						$otptrc->otp = $otp;
						$otptrc->type = 'password';
						$otptrc->save();
						
						// $this->send( $email, $otp );
						$this->sendMailOtp($email,$otp); // this is working
						$num = $phone;

						try{	
							$ch = curl_init();	
							$msg = 'Dear User, Thanks for registering at FitIndia app. Your OTP code is: '.$otp.', You will use this registration for all activities on FitIndia app.';
							$msg = curl_escape($ch, $msg);
							$urld = 'http://164.100.14.211/failsafe/MLink?username=kheloindia.otp&pin=4urd0h68&message='.$msg.'&mnumber=91'.$num.'&signature=SAISMS&dlt_entity_id=1001433200000021508&dlt_template_id=1007162460765661738';
										
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
							curl_setopt($ch, CURLOPT_URL, $urld );
								
							curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
							$response = curl_exec($ch);
								
								
						}catch(Exception $e){
							print_r($e);
						}
 
						$otptoken = $this->encrypt($key, $iv, $otptoken);

						return response()->json([
							'success' => true,
							'status' => 'success',
							'otptoken'=> $otptoken,
							'reqtime' => $request->reqtime,
							'code' =>  200,
							'message' => 'OTP successfully has been sent',         
						], 200);
						
						
						
					}else{
						
						return response()->json([
							'success' => false,
							'status' => 'error',
							'code' =>  422,
							'message' => 'OTP not sent',         
						], 422);
					}
					
				}else{
					
					// dd(123456);
					$passverfotp = DB::table('userpassverification')->where('email', $email)->update(['otp'=> $otp, 'otptoken'=> $otptoken ]);					
					if($passverfotp){ 
					
						// dd($passverfotp);
						$otptrc = new OtpTrack();
						$otptrc->email = $email;
						$otptrc->otp = $otp;
						$otptrc->type = 'password';
						$otptrc->save();
						
						// $this->send( $email, $otp ); email not working
						$this->sendMailOtp($email,$otp); // this is working
						$num = $phone;
						
						try{	
							$ch = curl_init();	
							$msg = 'Dear User, Thanks for registering at FitIndia app. Your OTP code is: '.$otp.', You will use this registration for all activities on FitIndia app.';
							$msg = curl_escape($ch, $msg);
							$urld = 'http://164.100.14.211/failsafe/MLink?username=kheloindia.otp&pin=4urd0h68&message='.$msg.'&mnumber=91'.$num.'&signature=SAISMS&dlt_entity_id=1001433200000021508&dlt_template_id=1007162460765661738';
										
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
							curl_setopt($ch, CURLOPT_URL, $urld );
								
							curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
							$response = curl_exec($ch);
								
								
						}catch(Exception $e){
							print_r($e);
						}

						$otptoken = $this->encrypt($key, $iv, $otptoken);
						
						return response()->json([
							'success' => true,
							'status' => 'success',
							'otptoken'=> $otptoken,
							'reqtime' => $request->reqtime,
							'code' =>  200,
							'message' => 'OTP successfully has been sent',         
						], 200);
						
					}else{
						
						return response()->json([
							'success' => false,
							'status' => 'error',
							'code' =>  422,
							'message' => 'OTP not sent',         
						], 422);
						
					}
					
				}
				
						
			}else{
				return Response::json(array(
					'success' => false,
					'status'    => 'error',
					'code'      =>  404,
					'message'   =>  'Use does not exist with this email'
				), 404);
			}
				
		} catch(Exception $e) { 
		   
			return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'message'   =>  'Unauthorized : '.$e->getmessage()
				), 404);
			

		}
		
    }
	
	
	public function verifypasswordotp(Request $request){
		
		
		$validator = Validator::make($request->all(), [
            'email' => 'required|email|max:156',
			'otp' => 'required|regex:/\b\d{6}\b/'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
			return response()->json([
				'success' => false,
				'status' => 'error',
				'code' => 400,
				'message' => $error,         
			], 400);
        }	
		
		
		
		$passverf = DB::table('userpassverification')->where('email', $request->email)->first();
		if($passverf){
			
			if($passverf->otp == $request->otp){
				
				return response()->json([
					'success' => true,
					'status' => 'success', 
					'code' => 200,
					'message' => 'User password reset OTP verified'       
				], 200);
				
			}else{
				return response()->json([
					'success' => false,
					'status' => 'error',
					'code' => 401,
					'message' => 'User password reset OTP do not match'       
				], 401);
				
			}
			
		}else{
			return response()->json([
				'success' => false,
				'status' => 'error',
				'code' => 400,
				'message' => 'User password reset request not found',         
			], 400);
		}
		
		
	}
	
	
	public function send( $email, $msg){
		
		
		$otp = $msg;
        		$msg = '<!DOCTYPE HTML><html>
						<head>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
							<title>FIT INDIA User Password Reset OTP</title>
						</head>

						<body>
							<p>Dear FitIndia user,</p>
							<br>
							<p>Welcome, We thank you for your registration at FitIndia mobile app.</p>
							<p>Your user id is '.$email.' </p>
							<p>Your password reset Verification OTP code is : '.$otp.'</p>
							
							<p>Regards, <br> Fit India Mission</p>
							
						</body>
						</html>';
			
		$curlparams = array(
						'user_email' =>$email,
						'message' => $msg,
						'subject' => 'FIT INDIA User Password Reset OTP',						
						);

				$curl_options = array(
					CURLOPT_URL => "http://10.246.120.25/mail.php", 
					CURLOPT_POST => true,
					CURLOPT_POSTFIELDS => http_build_query($curlparams),
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_HEADER => false
				);

				$curl = curl_init();
				curl_setopt_array($curl, $curl_options);					
				$result = curl_exec($curl);
				curl_close($curl);
					
		/*
        $token = $this->createToken($email);         
        $site_url=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $url_link=explode('api/', $site_url); 
		
		$linkurl=$url_link[0].'update-password?token='.$token;		
			
		$curl_to_post_parameters = array(
						'user_email'=>$email,
						'message'=>$linkurl,
						'subject'=>'Change Your Password'						
						);

					   $curl_options = array(
						CURLOPT_URL => "https://fitindia.gov.in/mail.php",
						CURLOPT_POST => true,
						CURLOPT_POSTFIELDS => http_build_query($curl_to_post_parameters),
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_HEADER => false
					);

					$curl = curl_init();
					curl_setopt_array($curl, $curl_options);					
					$result = curl_exec($curl);
					curl_close($curl);			  
		*/
		
    }	
	
	public function createToken($email){
		
      $isToken = DB::table('password_resets')->where('email', $email)->first();

      if($isToken) {
        return $isToken->token;
      }

      $token = Str::random(80);
      $this->saveToken($token, $email);
      return $token;
    }
	
	
	public function saveToken($token, $email){
		
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()            
        ]);
    }
	
	public function validEmail($email) {

       return !!User::where('email', $email)->first();
    }	
	
}
