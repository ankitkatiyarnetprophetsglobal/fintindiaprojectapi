<?php 
try{
	
	$ch = curl_init();
	if(isset($_GET['num'])){
		$num = $_GET['num'];
	}else{
		$num = 9588569717;
	}
	
	$url = 'http://164.100.14.211/failsafe/MLink?username=kheloindia.otp&pin=4urd0h68&message=DearUser&mnumber=918824881455&signature=SAISMS&dlt_entity_id=1001433200000021508&dlt_template_id=1007162460765661738';
	
	//print_r($url);
	//exit();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_URL, $url );
	
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);


		//curl_setopt($ch, CURLOPT_TIMEOUT, 80);
		 
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