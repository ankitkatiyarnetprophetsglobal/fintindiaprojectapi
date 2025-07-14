<?php

ini_set("display_errors", 1);

require_once("mail.php");

$from = "noreply.fitindia@gov.in"; // example: testemail@domain.com
// $fullname = $request->fullname;
// $designation = $request->designation;
// $email = $request->email;
// $mobile = $request->mobile;
// $state = $request->state;
// $videourl= $request->videourl;
// $title = $request->title;
// $story = $request->story;

$email = $to = $_GET['email']; // example: testemail@domain.com
$fullname = $_GET['fullname'];
$designation = $_GET['designation'];
$email = $_GET['email'];
$mobile = $_GET['mobile'];
$state = $_GET['state'];
$videourl = $_GET['videourl'];
$title = $_GET['title'];
$story = $_GET['story'];
// echo $email .$name;
// exit;
$subject = "Fit India SHARE YOUR STORY Request";

$msg = "Sample Message Body";
$msg = '<!DOCTYPE HTML><html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title>Fit India SHARE YOUR STORY Request</title>
            <style>.yada{color:green;}</style>
        </head>

        <body>
            <p>Dear Fit India Team,</p>
            <br><br>            
            <p>Below are request for Fit India SHARE YOUR STORY</p>
            <br><br>
            Name : '.$fullname.'"<br>"
            Designation : '.$designation.'<br>
            <p>Email id : '.$email.'<br></p>
            <p>Contact No : '.$mobile.'<br></p>
            <p>State : '.$state.'<br></p>
            <p>URL : '.$videourl.'<br></p>
            <p>Story title : '.$title.'<br></p>
            <p>Your Story : '.$story.'<br></p>
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