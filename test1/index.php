<?php 
try{
	$ch = curl_init();
	$num = 9818886995;
	$msg = 'Dear
User, Thanks for registering at FitIndia app. Your OTP code is: 545555, You will use this registration for all activities on FitIndia app.';

$msg = curl_escape($ch, $msg);
$urld = 'http://164.100.14.211/failsafe/MLink?username=kheloindia.otp&pin=4urd0h68&message='.$msg.'&mnumber=91'.$num.'&signature=SAISMS&dlt_entity_id=1001433200000021508&dlt_template_id=1007162460765661738';


	
	
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_URL, $urld );
	
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	
		$response = curl_exec($ch);
		 
		if(curl_error($ch)){
			echo 'Request Error:' . curl_error($ch);
		}
		else
		{
			print_r($response);
		}

	
}catch(Exception $e){
	print_r($e);
}

?>