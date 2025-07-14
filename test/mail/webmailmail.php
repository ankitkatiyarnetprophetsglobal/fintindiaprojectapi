<?php

ini_set("display_errors", 1);

require_once("mail.php");

$from = "noreply.fitindia@gov.in"; // example: testemail@domain.com

$email = $to = $_GET['email']; // example: testemail@domain.com
$message = $_GET['message'];
$subject = "Fit India Password Reset link";

$msg = "Sample Message Body";
$msg = '<!DOCTYPE HTML><html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title>Fit India Password Reset link</title>
            <style>.yada{color:green;}</style>
        </head>

        <body>
            <p>Dear FitIndia user,</p>
            <br>
            <p>Welcome, We thank you for your registration at FitIndia mobile app.</p>
            <p>Your user name '.$email.' </p>
            <p>Your email id Verification click here : '.$message.'</p>
            <p>You will use this user id given above for all activities on FitIndia mobile app. The user id cannot be changed and hence we recommend that you store this email for your future reference.</p>
            <p>Regards, <br> Fit India Mission</p>            
        </body>
        </html>';

$res = send_mail($from, $to, $subject, $msg);

if($res){
echo "send mail result is ".$res;
}
else
{
echo "Something went wrong. please try again.";
}


?>