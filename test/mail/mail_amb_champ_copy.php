<?php

ini_set("display_errors", 1);

require_once("mail.php");

$from = "noreply.fitindia@gov.in"; // example: testemail@domain.com

// $email = $to = $_GET['email']; // example: testemail@domain.com
// $otp = $_GET['otp'];
$subject = "Approved";

$name = "Ankit Katiyar";
$type = "Approved";
$email  = $to = "ankit.katiyar@netprophetsglobal.com";
$password = "Admin123456";
$msg = "Sample Message Body";
// $msg = '<!DOCTYPE HTML><html>
//         <head>
//             <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
//             <title>FIT INDIA Email verification OTP</title>
//             <style>.yada{color:green;}</style>
//         </head>

//         <body>
//             <p>Dear FitIndia user,</p>
//             <br>
//             <p>Welcome, We thank you for your registration at FitIndia mobile app.</p>
//             <p>Your user name '.$email.' </p>
//             <p>Your email id Verification OTP code is : '.$otp.'</p>
//             <p>You will use this user id given above for all activities on FitIndia mobile app. The user id cannot be changed and hence we recommend that you store this email for your future reference.</p>
//             <p>Regards, <br> Fit India Mission</p>

//         </body>
//         </html>';
$msg = '<!DOCTYPE HTML><html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title>FIT INDIA Email verification OTP</title>
            <style>.yada{color:green;}</style>
        </head>

        <body>
            <p>Dear '.$name.',</p>
            <br>
            <p>It gives me immense pleasure welcoming you as a <strong>Fit India '.$type.'</strong> for the Fit India Movement. Fit India is a flagship programme of the Government of India, which was launched by Honorable Prime Minister Shri Narendra Modi ji in 2019. His vision was to make Fit India Movement a Peoples Movement, where the government acts as a mere catalyst.</p>
            <p>You will be happy to learn that in the last one year, the Movement has indeed been able to capture the imagination of the citizens of India and people from all walks of life and age groups have come forward to include fitness activities in their daily lives, as envisioned by Honorable PM.</p>
            <p>As a prominent name in the fitness arena, you have the power to motivate people to make fitness as a way of life and make India a FIT NATION.</p>
            <p>Please login to your Fit India profile and download your e-certificate.</p>
            <p>User id: '.$email.'<br>
            Password: '.$password.'</p>
            <p>Regards,<br>
            Ms. Amar Jyoti, IRS<br>
            Mission Director</p>
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
