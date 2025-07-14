<?php

ini_set("display_errors", 1);

require_once("mail.php");

$from = "noreply.fitindia@gov.in"; // example: testemail@domain.com

$email = $to = $_GET['email']; // example: testemail@domain.com
$name = $_GET['name'];
// echo $email .$name;
// exit;
$subject = "Join Us Every Sunday for the Fit India Cycling Movement! 🚴‍♀️🚴‍♂️";

$msg = "Sample Message Body";
$msg = '<!DOCTYPE HTML><html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title>Join Us Every Sunday for the Fit India Cycling Movement! 🚴‍♀️🚴‍♂️</title>
            <style>.yada{color:green;}</style>
        </head>

        <body>
            <p>Dear '.$name.',</p>            
            <p>We are thrilled to invite you to be a part of the Fit India Cycling Movement, held every Sunday. Together, lets pedal towards a healthier and more active lifestyle!</p>
            <p>Details of the Event:</p>
            <p>Date: Every Sunday</p>
            <p>How to Register:</p>
            <p>Simply visit https://fitindia.gov.in/ and complete your registration to join this exciting movement.</p>
            <p>Lets make fitness a priority and inspire others in our community to do the same. Dont miss out on this fantastic opportunity to ride together for a healthier tomorrow.</p>
            <p>Feel free to share this email with your friends and family. The more, the merrier!</p>
            <p>See you on Sunday with your cycling gear!</p>
            <p>Best regards, <br> Fit India Mission</p>
            
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