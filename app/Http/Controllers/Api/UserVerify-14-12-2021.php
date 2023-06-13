<?php
namespace App\Http\Controllers\Api;
use App\Models;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response;
use App\Models\Userverification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyMail;
use App\Models\User;
use App\Models\OtpTrack;

class UserVerify extends Controller
{
	
       private $OPENSSL_CIPHER_NAME = "aes-128-cbc"; //Name of OpenSSL Cipher 
        private $CIPHER_KEY_LEN = 16; 
	
	function decrypt($key, $iv, $data) {
        if(strlen($key) < $this->CIPHER_KEY_LEN) {
            $key = str_pad("$key", $this->CIPHER_KEY_LEN, "0"); 
        } else if (strlen($key) > $this->CIPHER_KEY_LEN) {
            $key = substr($str, 0, $this->CIPHER_KEY_LEN); 
        }
       
        $decryptedData = openssl_decrypt( base64_decode($data), $this->OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv);
        return $decryptedData;
    }	
	
      
    
	public function verify_user_email(Request $request){

                   
		try{ 
			$iv = "fedcba9876543210"; 
			$key = "0a9b8c7d6e5f4g3h";
				
				if(strpos($request->reqtime, '=') == false){
					return Response::json(array(
						'status'    => 'error',
						'code'      =>  422,
						'message'   =>  'Not valid request'
					), 422);
				}				
				
				/*if(strpos($request->rcaptcha, '=') == false){
					return Response::json(array(
						'status'    => 'error',
						'code'      =>  422,
						'message'   =>  'Not valid request'
					), 422);
				}
				
				if(empty($request->captcha)){
					return Response::json(array(
						'status'    => 'error',
						'code'      =>  422,
						'message'   =>  'Captcha Required'
					), 422);
				}*/
				
				 
			$reqtimevar = $this->decrypt($key, $iv, $request->reqtime);
			
			//$rcaptchavar = $this->decrypt($key, $iv, $request->rcaptcha);			
			/*if($request->captcha != $rcaptchavar) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Invalid Captcha'
				), 422);
			}*/
				
			$key = $reqtimevar . 'fitind';
			$email = $this->decrypt($key, $iv, $request->email);//phone number sms send	

            if(is_numeric($email)){				
				$validator = Validator::make(
					array( "phone" => $email),['phone' => 'required|digits:10']
				);
				
			}else if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				
				$validator = Validator::make( array( "email" => $email ), ['email' => 'required|email']);
				
			}else{
				return Response::json(array(
					'status' => 'error', 'code'  =>  422, 'message'   =>  'Invalid Input'
				), 422);
			}	           
							
				/*$validator = Validator::make(array("email" => $email), [
					'email' => 'required|email',
				]);*/
				
				if($validator->fails()){
					return Response::json(array(
						'status'    => 'error',
						'code'      =>  422,
						'message'   =>  $validator->messages()->first()
					), 422);
				}

				$otp = mt_rand(100000,999999);	
				$phone_otp = $otp;
				 
				$cflag='';
				
                $start = date( "Y-m-d 00:00:00");
				$end = date( "Y-m-d 23:59:59");				
				
				if(is_numeric($email)){						
					//echo "aaaa";			
					$userverification = Userverification::where('phone', $email)->first();
					$otpcnt = OtpTrack::where('phone', $email)->where('type','user')->whereBetween('created_at',[$start,$end])->count();
					$cflag='0';
				} else if(filter_var($email, FILTER_VALIDATE_EMAIL)){					
					//echo "bbbb";					
					$userverification = Userverification::where('email', $email)->first();
                    $otpcnt = OtpTrack::where('email', $email)->where('type','user')->whereBetween('created_at',[$start,$end])->count();
                    $cflag='1';					
				}							
				
				//$userverification = Userverification::where('email', $email)->first();
				
				/* $start = date( "Y-m-d 00:00:00");
				$end = date( "Y-m-d 23:59:59"); */
				
				//$otpcnt = OtpTrack::where('email', $email)->where('type','user')->whereBetween('created_at',[$start,$end])->count();
				//print_r($otpcnt); 
				
				
				//echo $cflag;die;
				
				if($otpcnt > 2){				
					return Response::json(array(
							'status'    => 'error',
							'code'      =>  401,
							'message'   =>  'Your request limit exceeds'
						), 401);
				}
					
				  
					if(!empty($userverification)){
						
						if(empty($userverification->isverified)){
							
							if($cflag==1){								
								//echo "aaaa".$email; die;								
								Userverification::where('email', $email)->update(['otp' => $otp]);
															
								$otptrc = new OtpTrack();
								$otptrc->email = $email;
								$otptrc->otp = $otp;
								$otptrc->type = 'user';
								$otptrc->save();
								$emailres = $this->send($email, $otp);
								return response()->json([
								'status'    => 'success',
							'code'      =>  200,
								'success' => true,
								'message' => 'OTP successfully has been sent', 
								'reqtime' => $request->reqtime,
								], 200);	
								
							} else if($cflag==0){
								//echo "bbbb".$email; die;
								Userverification::where('phone', $email)->update(['otp' => $phone_otp]);	 
							    $smsres = $this->sendsms($email,$otp);							
								$otptrc = new OtpTrack();
								$otptrc->phone = $email;
								$otptrc->otp = $phone_otp;
								$otptrc->type = 'user';
								$otptrc->save();
					
								return response()->json([
								'success' => true,
								'status'    => 'success',
							'code'      =>  200,
								'message' => 'Phone OTP successfully updated', 
								'reqtime' => $request->reqtime,
								], 200);								
							}
							
							/*Userverification::where('email', $email)->update(['otp' => $otp]); 
							$this->send($email,$otp);							
							$otptrc = new OtpTrack();
							$otptrc->email = $email;
							$otptrc->otp = $otp;
							$otptrc->type = 'user';
							$otptrc->save();
				
							return response()->json([
							'success' => true,
							'message' => 'OTP successfully has been sent', 
							'reqtime' => $request->reqtime,
							], 200); */

						} else {
							
							return response()->json([
							'status'    => 'success',
							'code'      =>  201,
							'success' => true,
							'message' => 'You are already Verified', 
							'reqtime' => $request->reqtime,
							], 201);
						}

					} else {

						 if($cflag==1){							 
							
                            $userv = new Userverification();
							$userv->email = $email;
							$userv->otp = $otp;						
							$userv->save();
							
							$otptrc = new OtpTrack();
							$otptrc->email = $email;
							$otptrc->otp = $otp;
							$otptrc->type = 'user';
							$otptrc->save();
							
							$emailres = $this->send($email,$otp);
							
							return response()->json([
							'status'    => 'success',
							'code'      =>  200,
								'success' => true,
								'message' => 'OTP successfully has been sent', 
								'reqtime' => $request->reqtime,
								], 200);							
								 
						 } else if($cflag==0){						 
							
							$userv = new Userverification();
							$userv->phone = $email;
							$userv->otp = $phone_otp;						
							$res = $userv->save();
							
													
							$otptrc = new OtpTrack();
							$otptrc->phone = $email;
							$otptrc->otp = $phone_otp;
							$otptrc->type = 'user';
							$res = $otptrc->save();
							
							$smsres = $this->sendsms($email,$otp);
							return response()->json([
							'status'    => 'success',
							'code'      =>  200,
								'success' => true,
								'message' => 'Phone OTP successfully updated', 
								'reqtime' => $request->reqtime,
								], 200);							 
						 }						

						/*$userv = new Userverification();
						$userv->email = $email;
						$userv->otp = $otp;						
						$userv->save();						
						$this->send($email,$otp);						
						$otptrc = new OtpTrack();
						$otptrc->email = $email;
						$otptrc->otp = $otp;
						$otptrc->type = 'user';
						$otptrc->save();
							
						return response()->json([
							'success' => true,
							'message' => 'OTP successfully has been sent', 
							'reqtime' => $request->reqtime,
							], 200); */						
					}					

		} catch(Exception $e) { 
		   
			return Response::json(array(
					'status'    => 'error',
					'code'      =>  404,
					'message'   =>  'Unauthorized : '.$e->getmessage()
				), 404);
		}			
	}
	

	public function send($email,$msg){
				$otp = $msg;
        		$msg = '<!DOCTYPE HTML><html>
						<head>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
							<title>FIT INDIA Email verification OTP</title>
							<style>.yada{color:green;}</style>
						</head>

						<body>
							<p>Dear FitIndia user,</p>
							<br>
							<p>Welcome, We thank you for your registration at FitIndia mobile app.</p>
							<p>Your user id is <'.$email.'> </p>
							<p>Your email id Verification OTP code is : '.$otp.'</p>
							<p>You will use this user id given above for all activities on FitIndia mobile app. The user id cannot be changed and hence we recommend that you store this email for your future reference.</p>
							<p>Regards, <br> Fit India Mission</p>
							
						</body>
						</html>';
			
		$curlparams = array(
						'user_email' =>$email,
						'message' => $msg,
						'subject' => 'FIT INDIA Email verification OTP',						
						'html'=>' <!DOCTYPE HTML><html>
						<head>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
							<title>FIT INDIA Email verification OTP</title>
							<style>.yada{color:green;}</style>
						</head>

						<body>
							<p style="color:red">Please find '.$msg.'</p>
							
						</body>
						</html>');

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
		   
    }
 	
	public function sendsms($num,$otp){
	try{
	$ch = curl_init();
	
	$msg = 'Dear
User, Thanks for registering at FitIndia app. Your OTP code is: '.$otp.', You will use this registration for all activities on FitIndia app.';

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
		   
    }
   
   public function verifyuser(Request $request){		
	   //dd($request);		
	   try{ 
			$iv = "fedcba9876543210"; 
			$key = "0a9b8c7d6e5f4g3h";
				
				if(strpos($request->reqtime, '=') == false) {
					return Response::json(array(
						'status'    => 'error',
						'code'      =>  422,
						'message'   =>  'Not valid request'
					), 422);
				}
				
				if(strpos($request->otp, '=') == false) {
					return Response::json(array(
						'status'    => 'error',
						'code'      =>  422,
						'message'   =>  'Not valid otp'
					), 422);
				}
				
				
				/*if (strpos($request->rcaptcha, '=') == false) {
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
				} */
				
				 
			$reqtimevar = $this->decrypt($key, $iv, $request->reqtime);
			//$rcaptchavar = $this->decrypt($key, $iv, $request->rcaptcha);
			$otp = $this->decrypt($key, $iv, $request->otp);
			
			/*if($request->captcha != $rcaptchavar) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Invalid Captcha'
				), 422);
			}*/
				
			$key = $reqtimevar . 'fitind';
			$email = $this->decrypt($key, $iv, $request->email);

            //dd($otp);
            //dd($email);
			
            if($otp){             
			  $validator = Validator::make(
			   array("otp" => $otp),[				
				'otp' => 'required|regex:/\b\d{6}\b/']
			  );			

            } else if(is_numeric($email)){				
				$validator = Validator::make(
					array( "phone" => $email),['phone' => 'required|digits:10']
				);
				
			} else if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				
				$validator = Validator::make( array( "email" => $email ), ['email' => 'required|email']);
				
			} else{
				return Response::json(array(
					'status' => 'error', 'code'  =>  422, 'message'   =>  'Invalid Input'
				), 422);
			}			
		
		    /*$validator = Validator::make( array("email" => $email,"otp" => $otp), [
				'email' => 'required|email|max:156',
				'otp' => 'required|regex:/\b\d{6}\b/'
			]); */

			if($validator->fails()) {
				$error = $validator->errors()->first();
				return response()->json([
				'success' => false,
				'status' => 'error',
				'code' => 400,
				'message' => $error,         
				], 400);
			}
			
			$cflag='0';
			
			if(is_numeric($email)){						
						
				$verifyUser = Userverification::where('phone', $email)->first();				
				$cflag='0';
			} else if(filter_var($email, FILTER_VALIDATE_EMAIL)){					
				
				$verifyUser = Userverification::where('email', $email)->first();				
				$cflag='1';					
			}		
		 
			//$verifyUser = Userverification::where('email', $email)->first();	
		   
		if(!empty($verifyUser)){			
			
			if(empty($verifyUser->isverified)){

             if($cflag==1){								
	            //echo $otp."aaaa".$email; die;
				if($otp == $verifyUser->otp){				
					
					//Userverification::where('email', $request->email)->update(['isverified' => '1']);
					
					$userverf = User::where('email', $email)->first();
					
					if(!empty($userverf)){	 
					
						User::where('email', $email)->update(['verified' => '1']);
					}	
						Userverification::where('email', $email)->update(['isverified' => '1']);
						
						return response()->json([
						'success' => true,
						'status'    => 'sucess',
						'code'      =>  200,
						'reqtime' => $request->reqtime,
						'message' => 'Your e-mail is verified',         
						], 200);						
				  
				}else{
					return Response::json(array(
					'status'    => 'error',
					'success' => false,
					'code'      =>  422,
					'message'   =>  'OTP does not match'
					), 422);
				}
				
			 } else if($cflag==0){
				 
				 if($otp == $verifyUser->otp){				
					
					//Userverification::where('email', $request->email)->update(['isverified' => '1']);
					
					$userverf = User::where('phone', $email)->first();
					
					if(!empty($userverf)){	
					
						User::where('phone', $email)->update(['verified' => '1']);
					}	
						Userverification::where('phone', $email)->update(['isverified' => '1']);
						
						return response()->json([
						'success' => true,
						'status'    => 'sucess',
						'code'      =>  200,
						'reqtime' => $request->reqtime,
						'message' => 'Your phone number is verified',         
						], 200);						
				  
				} else {
					return Response::json(array(
					'status'    => 'error',
					'success' => false,
					'code'      =>  422,
					'message'   =>  'OTP does not match'
					), 422);
				}
				 
				//echo $otp."bbbb".$email; die;///9818654322 				 
			 }	
			
				/* if($otp == $verifyUser->otp){				
					
					//Userverification::where('email', $request->email)->update(['isverified' => '1']);
					
					$userverf = User::where('email', $email)->first();
					
					if(!empty($userverf)){	
					
						User::where('email', $email)->update(['verified' => '1']);
					}	
						Userverification::where('email', $email)->update(['isverified' => '1']);
						
						return response()->json([
						'success' => true,
						'status'    => 'sucess',
						'code'      =>  200,
						'reqtime' => $request->reqtime,
						'message' => 'Your e-mail is verified',         
						], 200);						
				  
				}else{
					return Response::json(array(
					'status'    => 'error',
					'success' => false,
					'code'      =>  422,
					'message'   =>  'OTP does not match'
					), 422);
				} */
			  
			  
			} else {
			  
			  return response()->json([
				'success' => true,
				'status'    => 'sucess',
				'code'      =>  200,
				'reqtime' => $request->reqtime,
				'message' => 'Your data'.$email.' is already verified',         
				], 200);
			}

		  } else {

			 return Response::json(array(
					'status'    => 'error',
					'success' => false,
					'code'      =>  422,
					'message'   =>  'Sorry your '.$email.' cannot be identified'
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
 }