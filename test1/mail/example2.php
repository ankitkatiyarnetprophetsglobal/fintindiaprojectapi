<?php

// ini_set("display_errors", 1);

require_once("mail.php");
// echo '1312';
$email =  $_GET['email'];
$otp =  $_GET['otp'];
//$subject =  $_GET['subject '];
// echo  $email;
// echo  $otp;
// exit;
$from = "noreply.fitindia@gov.in"; // example: testemail@domain.com

$to = $email; // example: testemail@domain.com

$subject = "FIT INDIA User Password Reset OTP";

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

$res = send_mail($from, $to, $subject, $msg);

if($res){
//echo " send mail result is ".$res;
return true;
}
else
{
    return false;
//echo "Something went wrong. please try again.";
}

?>