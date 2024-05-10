<?php
namespace App\Http\Controllers\v2\Api;
use App\Models;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response;
use App\Models\Userverification;
use Illuminate\Support\Facades\Validator;
use App\Models\Otperrorlog;
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
	
	///By Ankit ji

	public function sendMailOtp($email,$otp){

		
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://10.246.120.18/test/mail/example1.php?email=$email&otp=$otp",						   
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
	
	public function generateotp(Request $request){		
		// dd('23322332233223');die;		
       	try{ 
			$iv ="fedcba9876543210"; 
			$key="0a9b8c7d6e5f4g3h";
				
			if(strpos($request->reqtime, '=') == false){
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Not valid request'
				), 422);
			}				
				 
			$reqtimevar = $this->decrypt($key, $iv, $request->reqtime);			
			$key = $reqtimevar.'fitind';			
			$email = $this->decrypt($key, $iv, trim($request->email));//email sms send						
			$email = trim($email);
			$mobile = $this->decrypt($key, $iv, $request->mobile);//phone number sms send	
		   		   
		    $messsages = array(
					'email.required'=>'Please enter the email.',
					'email.email'=>'Please enter valid email.',
					'mobile.required'=>'Please enter the mobile number.',
					'mobile.numeric'=>'Please enter numeric value.',
					'mobile.digits'=>'Please enter min 10 digit number.',
			);



			// dd($email);
			if(empty($email) && !empty($mobile) && is_numeric($mobile) && $mobile=='0000000000'){
			 
			    return Response::json(array(
					'status' => 'error', 'code'=> 500, 'data' =>'[]'
				), 500);			
				
			} else if(empty($email) && !empty($mobile) && is_numeric($mobile) && $mobile!='0000000000'){
			  
			   $validator = Validator::make( array("phone" => $mobile),['phone' => 'required|digits:10'],$messsages);			
			  				
			} else if(empty($mobile) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
			   
			   $validator = Validator::make( array("email" => $email),['email' => 'required|email'],$messsages);			
			
			} else if(!empty($mobile) && is_numeric($mobile) && $mobile!='0000000000' && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
			   			 
				$validator = Validator::make( array("phone" => $mobile,"email" => $email),['phone' => 'required|digits:10','email' => 'required|email'],$messsages);			
			
			} else {
				
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

			$otp = mt_rand(100000,999999);			
			$phone_otp = $otp;
			$cflag='';
				
			$start = date( "Y-m-d 00:00:00");
			$end = date( "Y-m-d 23:59:59");				
							
			if(empty($email) && !empty($mobile) && is_numeric($mobile) && $mobile!='0000000000'){
			
			    $userverification = Userverification::where('phone', $mobile)->first();
				
				$otpcnt = OtpTrack::where('phone', $mobile)->where('type','user')->whereBetween('created_at',[$start,$end])->count();
				
				$cflag='0';
				
			} else if(empty($mobile) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){					
								
				$userverification = Userverification::where('email', $email)->first();				
				
				$otpcnt = OtpTrack::where('email', $email)->where('type','user')->whereBetween('created_at',[$start,$end])->count();
				
				$cflag='1';	
				
			} else if(!empty($mobile) && is_numeric($mobile) && $mobile!='0000000000' && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
			  
			    $userverification = Userverification::where('email', $email)->where('phone', $mobile)->first();				
				
				$otpcnt = OtpTrack::where('email', $email)->where('phone', $mobile)->where('type','user')->whereBetween('created_at',[$start,$end])->count();
				
				$cflag='3';	
			}			
			            
			 if(!empty($userverification)){
						
						if(empty($userverification->isverified)){
							
							if($cflag==1){	
															
								Userverification::where('email', $email)->update(['otp' => $otp]);
															
								$otptrc = new OtpTrack();
								$otptrc->email = $email;
								$otptrc->otp = $otp;
								$otptrc->type = 'user';
								$otptrc->save();
								
								// $emailres = $this->send( $email, $otp ); // email not working
								$this->sendMailOtp($email,$otp); // this is working
								
								
								return response()->json([
									'status' => 'success',
									'code'   =>  200,
									'success' => true,
									'message' => 'Email OTP successfully has been send', 
									'reqtime' => $request->reqtime,
								], 200);	
								
							} else if($cflag==0){
								
								//echo "bbbb".$mobile; //die;
								
								Userverification::where('phone', $mobile)->update(['otp' => $phone_otp]);	 
							    
								$smsres = $this->sendsms($mobile,$phone_otp);
								
								$otptrc = new OtpTrack();
								$otptrc->phone = $mobile;
								$otptrc->otp = $phone_otp;
								$otptrc->type = 'user';
								$otptrc->save();
					
								return response()->json([
								'success' => true,
								'status'  => 'success',
							    'code'    =>  200,
								'message' => 'Phone OTP successfully has been send', 
								'reqtime' => $request->reqtime,
								], 200);
								
							} else if($cflag==3){
								
								if(!empty($email)){									
									//echo "cccc".$email; 
									
								    Userverification::where('email', $email)->update(['otp' => $otp]);
							
 							        $otptrc = new OtpTrack();
									$otptrc->email = $email;
									$otptrc->otp = $otp;
									$otptrc->type = 'user';
									$otptrc->save();									
									
									// $emailres = $this->send( $email, $otp ); // email not working										
									$this->sendMailOtp($email,$otp); // this is working
									
								} else if(!empty($mobile)){
									
									//echo "dddd".$mobile; 
									
									Userverification::where('phone', $mobile)->update(['otp' => $phone_otp]);	 
							    
									$smsres = $this->sendsms($mobile,$phone_otp);									
									$otptrc = new OtpTrack();
									$otptrc->phone = $mobile;
									$otptrc->otp = $phone_otp;
									$otptrc->type = 'user';
									$otptrc->save();								
								}													
								
								return response()->json([
								'success' => true,
								'status'  => 'success',
							    'code'    =>  200,
								'message' => 'Phone Emil OTP successfully has been send', 
								'reqtime' => $request->reqtime,
								], 200);
								
							}					

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
						 
							//echo "kkkk1".$email; //die;
							
                            $userv = new Userverification();
							$userv->email = $email;
							$userv->otp = $otp;						
							$userv->save();
							
							$otptrc = new OtpTrack();
							$otptrc->email = $email;
							$otptrc->otp = $otp;
							$otptrc->type = 'user';
							$otptrc->save();
							
							$emailres =  $this->send($email,$otp);
							$this->sendMailOtp($email,$otp); // this is working
							
							return response()->json([
							'status'    => 'success',
							'code'      =>  200,
								'success' => true,
								'message' => 'Email OTP successfully has been send', 
								'reqtime' => $request->reqtime,
								], 200);							
								 
						 } else if($cflag==3){
							 
							$chk = Userverification::where('email', $email)->first();
							$otchk = OtpTrack::where('email', $email)->first();
							
							$chkm = Userverification::where('phone', $mobile)->first();
							$otchkm = OtpTrack::where('phone', $mobile)->first();
							
							//echo "<pre>";print_r($chk->email);																			 
							 if(!empty($chk->email)){								 
								$userv = Userverification::find($chk->id);
								$userv->email = $email;
								$userv->otp = $otp;						
								$userv->save();								
							 } else {								 
								$userv = new Userverification();
								$userv->email = $email;
								$userv->otp = $otp;						
								$userv->save(); 								 
							 }
							 
							 if(!empty($otchk->email)){								 
								$otptrc = OtpTrack::find($otchk->id);
								$otptrc->email = $email;
								$otptrc->otp = $otp;						
								$otptrc->save();								
							 } else {								 
								$otptrc = new OtpTrack();
								$otptrc->email = $email;
								$otptrc->otp = $otp;						
								$otptrc->save(); 								 
							 }          								
				            	
							  $emailres = $this->send($email,$otp);								
							  $this->sendMailOtp($email,$otp); // this is working 	
							
							//###################################
							
							if(!empty($chkm->phone)){								 
								$userv = Userverification::find($chkm->id);
								$userv->phone = $mobile;
								$userv->otp = $phone_otp;						
								$userv = $userv->save();						
							 } else {								 
								$userv = new Userverification();
								$userv->phone = $mobile;
								$userv->otp = $phone_otp;						
								$userv = $userv->save();							 
							 }
							 
							 if(!empty($otchkm->phone)){								 
								$otptrc = OtpTrack::find($otchkm->id);
								$otptrc->phone = $mobile;
								$otptrc->otp = $phone_otp;
								$otptrc->type = 'user';
								$otptrc = $otptrc->save();							
							 } else {								 
								$otptrc = new OtpTrack();
								$otptrc->phone = $mobile;
								$otptrc->otp = $phone_otp;
								$otptrc->type = 'user';
								$otptrc = $otptrc->save();							 
							 }								
								
							$smsres = $this->sendsms($mobile, $phone_otp); 													 
							 
							return response()->json([
							'status'    => 'success',
							'code'      =>  200,
								'success' => true,
								'message' => 'Phone Email OTP successfully has been send', 
								'reqtime' => $request->reqtime,
								], 200); 

							 
						 } else if($cflag==0){	

                            //echo "kkkk4".$mobile; //die;						 
							
							$userv = new Userverification();
							$userv->phone = $mobile;
							$userv->otp = $phone_otp;						
							$res = $userv->save();							
													
							$otptrc = new OtpTrack();
							$otptrc->phone = $mobile;
							$otptrc->otp = $phone_otp;
							$otptrc->type = 'user';
							$res = $otptrc->save();
							
							$smsres = $this->sendsms($mobile,$phone_otp);
							
							return response()->json([
							    'status'    => 'success',
							    'code'      =>  200,
								'success' => true,
								'message' => 'Phone OTP successfully has been send', 
								'reqtime' => $request->reqtime,
								], 200);							 
						 }												
					}					

				} catch(Exception $e){ 				   
					return Response::json(array(
							'status'    => 'error',
							'code'      =>  404,
							'message'   =>  'Unauthorized : '.$e->getmessage()
						), 404);
				}			
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
								// $emailres = $this->send( $email, $otp ); // email not working
								$this->sendMailOtp($email,$otp); // this is working
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
							$this->sendMailOtp($email,$otp); // this is working
							
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
		//dd('done');
	$ch = curl_init();
	
	$msg = 'Dear User, Thanks for registering at FitIndia app. Your OTP code is: '.$otp.', You will use this registration for all activities on FitIndia app.';
	$date = date("Y-m-d");	
	$otperrorlog = Otperrorlog::create([
		'phone' =>  $num,
		'server_ip' => '10.246.120.18',
		'log_date' =>  $date,
		'status' => 1
	]);
	$id = $otperrorlog['id'];
	$msg = curl_escape($ch, $msg);
	$urld = 'http://164.100.14.211/failsafe/MLink?username=kheloindia.otp&pin=4urd0h68&message='.$msg.'&mnumber=91'.$num.'&signature=SAISMS&dlt_entity_id=1001433200000021508&dlt_template_id=1007162460765661738';
	
		
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_URL, $urld );
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		$response = curl_exec($ch);
		// dd($response);
		$date = date("Y-m-d");              
		// $time =  date("H:i a");		
		Otperrorlog::where('id', $id)->update(['mic_server_message' => $response]);	
		
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
		

	// new function 20-04-2023
    public function generateotpvtwo(Request $request){
		// dd('23322332233223');die;
       	try{
			$iv ="fedcba9876543210";
			$key="0a9b8c7d6e5f4g3h";

			if(strpos($request->reqtime, '=') == false){
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Not valid request'
				), 422);
			}

			$reqtimevar = $this->decrypt($key, $iv, $request->reqtime);
			$key = $reqtimevar.'fitind';
			$email = $this->decrypt($key, $iv, trim($request->email));//email sms send			
			$email = trim($email);
			$mobile = $this->decrypt($key, $iv, $request->mobile);//phone number sms send
			// dd($reqtimevar);
		    $messsages = array(
					'email.required'=>'Please enter the email.',
					'email.email'=>'Please enter valid email.',
					'mobile.required'=>'Please enter the mobile number.',
					'mobile.numeric'=>'Please enter numeric value.',
					'mobile.digits'=>'Please enter min 10 digit number.',
			);



			// dd($request->email);
			if(empty($email) && !empty($mobile) && is_numeric($mobile) && $mobile=='0000000000'){

			    return Response::json(array(
					'status' => 'error', 'code'=> 500, 'data' =>'[]'
				), 500);

			} else if(empty($email) && !empty($mobile) && is_numeric($mobile) && $mobile!='0000000000'){

			   $validator = Validator::make( array("phone" => $mobile),['phone' => 'required|digits:10'],$messsages);

			} else if(empty($mobile) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){

			   $validator = Validator::make( array("email" => $email),['email' => 'required|email'],$messsages);

			} else if(!empty($mobile) && is_numeric($mobile) && $mobile!='0000000000' && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){

				$validator = Validator::make( array("phone" => $mobile,"email" => $email),['phone' => 'required|digits:10','email' => 'required|email'],$messsages);

			} else {

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

			$otp = mt_rand(100000,999999);
			$phone_otp = $otp;
			$cflag='';

			$start = date( "Y-m-d 00:00:00");
			$end = date( "Y-m-d 23:59:59");

			if(empty($email) && !empty($mobile) && is_numeric($mobile) && $mobile!='0000000000'){

			    $userverification = Userverification::where('phone', $mobile)->first();

				$otpcnt = OtpTrack::where('phone', $mobile)->where('type','user')->whereBetween('created_at',[$start,$end])->count();

				$cflag='0';

			} else if(empty($mobile) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){

				$userverification = Userverification::where('email', $email)->first();

				$otpcnt = OtpTrack::where('email', $email)->where('type','user')->whereBetween('created_at',[$start,$end])->count();

				$cflag='1';

			} else if(!empty($mobile) && is_numeric($mobile) && $mobile!='0000000000' && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){

			    $userverification = Userverification::where('email', $email)->where('phone', $mobile)->first();

				$otpcnt = OtpTrack::where('email', $email)->where('phone', $mobile)->where('type','user')->whereBetween('created_at',[$start,$end])->count();

				$cflag='3';
			}

			if(!empty($userverification)){

					// if(empty($userverification->isverified)){

						if($cflag==1){

							Userverification::where('email', $email)->update(['otp' => $otp]);

							$otptrc = new OtpTrack();
							$otptrc->email = $email;
							$otptrc->otp = $otp;
							$otptrc->type = 'user';
							$otptrc->save();

							// $emailres = $this->send( $email, $otp ); // email not working
							// $this->sendMailOtp($email,$otp); // this is working


							return response()->json([
								'status' => 'success',
								'code'   =>  200,
								'success' => true,
								'message' => 'Email OTP successfully has been send',
								'reqtime' => $request->reqtime,
							], 200);

						} else if($cflag==0){

							//echo "bbbb".$mobile; //die;

							Userverification::where('phone', $mobile)->update(['otp' => $phone_otp]);

							$smsres = $this->sendsms($mobile,$phone_otp);

							$otptrc = new OtpTrack();
							$otptrc->phone = $mobile;
							$otptrc->otp = $phone_otp;
							$otptrc->type = 'user';
							$otptrc->save();

							return response()->json([
							'success' => true,
							'status'  => 'success',
							'code'    =>  200,
							'message' => 'Phone OTP successfully has been send',
							'reqtime' => $request->reqtime,
							], 200);

						} else if($cflag==3){

							if(!empty($email)){
								//echo "cccc".$email;

								Userverification::where('email', $email)->update(['otp' => $otp]);

								$otptrc = new OtpTrack();
								$otptrc->email = $email;
								$otptrc->otp = $otp;
								$otptrc->type = 'user';
								$otptrc->save();

								// $emailres = $this->send( $email, $otp ); // email not working
								// $this->sendMailOtp($email,$otp); // this is working

							} else if(!empty($mobile)){

								//echo "dddd".$mobile;

								Userverification::where('phone', $mobile)->update(['otp' => $phone_otp]);

								$smsres = $this->sendsms($mobile,$phone_otp);
								$otptrc = new OtpTrack();
								$otptrc->phone = $mobile;
								$otptrc->otp = $phone_otp;
								$otptrc->type = 'user';
								$otptrc->save();
							}

							return response()->json([
							'success' => true,
							'status'  => 'success',
							'code'    =>  200,
							'message' => 'Phone Emil OTP successfully has been send',
							'reqtime' => $request->reqtime,
							], 200);

						}

					// } else {

					// 	return response()->json([
					// 		'status'    => 'success',
					// 		'code'      =>  201,
					// 		'success' => true,
					// 		'message' => 'You are already Verified',
					// 		'reqtime' => $request->reqtime,
					// 		], 201);
					// }

				} else {

						if($cflag==1){

						//echo "kkkk1".$email; //die;

						$userv = new Userverification();
						$userv->email = $email;
						$userv->otp = $otp;
						$userv->save();

						$otptrc = new OtpTrack();
						$otptrc->email = $email;
						$otptrc->otp = $otp;
						$otptrc->type = 'user';
						$otptrc->save();

						// $emailres =  $this->send($email,$otp); // this is not working
						// $this->sendMailOtp($email,$otp); // this is working

						return response()->json([
						'status'    => 'success',
						'code'      =>  200,
							'success' => true,
							'message' => 'Email OTP successfully has been send',
							'reqtime' => $request->reqtime,
							], 200);

						} else if($cflag==3){

						$chk = Userverification::where('email', $email)->first();
						$otchk = OtpTrack::where('email', $email)->first();

						$chkm = Userverification::where('phone', $mobile)->first();
						$otchkm = OtpTrack::where('phone', $mobile)->first();

						//echo "<pre>";print_r($chk->email);
							if(!empty($chk->email)){
							$userv = Userverification::find($chk->id);
							$userv->email = $email;
							$userv->otp = $otp;
							$userv->save();
							} else {
							$userv = new Userverification();
							$userv->email = $email;
							$userv->otp = $otp;
							$userv->save();
							}

							if(!empty($otchk->email)){
							$otptrc = OtpTrack::find($otchk->id);
							$otptrc->email = $email;
							$otptrc->otp = $otp;
							$otptrc->save();
							} else {
							$otptrc = new OtpTrack();
							$otptrc->email = $email;
							$otptrc->otp = $otp;
							$otptrc->save();
							}

							$emailres = $this->send($email,$otp);
						//   $this->sendMailOtp($email,$otp); // this is working

						//###################################

						if(!empty($chkm->phone)){
							$userv = Userverification::find($chkm->id);
							$userv->phone = $mobile;
							$userv->otp = $phone_otp;
							$userv = $userv->save();
							} else {
							$userv = new Userverification();
							$userv->phone = $mobile;
							$userv->otp = $phone_otp;
							$userv = $userv->save();
							}

							if(!empty($otchkm->phone)){
							$otptrc = OtpTrack::find($otchkm->id);
							$otptrc->phone = $mobile;
							$otptrc->otp = $phone_otp;
							$otptrc->type = 'user';
							$otptrc = $otptrc->save();
							} else {
							$otptrc = new OtpTrack();
							$otptrc->phone = $mobile;
							$otptrc->otp = $phone_otp;
							$otptrc->type = 'user';
							$otptrc = $otptrc->save();
							}

						$smsres = $this->sendsms($mobile, $phone_otp);

						return response()->json([
						'status'    => 'success',
						'code'      =>  200,
							'success' => true,
							'message' => 'Phone Email OTP successfully has been send',
							'reqtime' => $request->reqtime,
							], 200);


						} else if($cflag==0){

						//echo "kkkk4".$mobile; //die;

						$userv = new Userverification();
						$userv->phone = $mobile;
						$userv->otp = $phone_otp;
						$res = $userv->save();

						$otptrc = new OtpTrack();
						$otptrc->phone = $mobile;
						$otptrc->otp = $phone_otp;
						$otptrc->type = 'user';
						$res = $otptrc->save();

						$smsres = $this->sendsms($mobile,$phone_otp);

						return response()->json([
							'status'    => 'success',
							'code'      =>  200,
							'success' => true,
							'message' => 'Phone OTP successfully has been send',
							'reqtime' => $request->reqtime,
							], 200);
						}
				}

			} catch(Exception $e){
				return Response::json(array(
						'status'    => 'error',
						'code'      =>  404,
						'message'   =>  'Unauthorized : '.$e->getmessage()
					), 404);
			}
	}


	public function verifyuserthree(Request $request){		
		// dd($request->all());		
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

			$reqtimevar = $this->decrypt($key, $iv, $request->reqtime);				
			$otp = $this->decrypt($key, $iv, $request->otp);
			$key = $reqtimevar . 'fitind';
			$email = $this->decrypt($key, $iv, $request->email);	
			// dd($otp);
			// dd($email);				
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
						
				// $verifyUser = Userverification::where([['phone', $email],['isverified','=',0]])->latest()->first();	
				$verifyUser = Userverification::where('phone', $email)->latest()->first();			
				$cflag='0';
			} else if(filter_var($email, FILTER_VALIDATE_EMAIL)){					
				
				// $verifyUser = Userverification::where([['email', $email],['isverified','=',0]])->latest()->first();				
				$verifyUser = Userverification::where('email', $email)->latest()->first();
				$cflag='1';					
			}		
			
			//$verifyUser = Userverification::where('email', $email)->first();	
			// dd($otp);   
		if(isset($verifyUser)){			
			// dd($verifyUser->otp);
			if(!empty($verifyUser->isverified)){
				// dd($verifyUser->otp);
				if($cflag == 1){								
					// dd($verifyUser->otp);
					if($otp === $verifyUser->otp){				
						
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
					// dd((int)$otp);
					// dd((int)($verifyUser->otp));
					if((int)$otp == (int)$verifyUser->otp){				
						
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
				}	
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