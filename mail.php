<?php
namespace PHPMailer\PHPMailer;
require_once __DIR__ . '/PHPMailer/src/Exception.php';
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

if(isset($_POST['user_email'])){      
	 $email  = $_POST['user_email'];
}

if(isset($_POST['message'])){	 
   // $message  =  nl2br(htmlentities($_POST['message']));
	$message  =  $_POST['message'];
	
}

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = '164.100.14.95' ;                    // Set the SMTP server to send through 'relay.nic.in'
    $mail->SMTPAuth   = false;                                   // Enable SMTP authentication
   // $mail->Username   = 'test@gmail.com';                     // SMTP username
   // $mail->Password   = 'Test@234';                               // SMTP password
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; ENCRYPTION_STARTTLS `PHPMailer::ENCRYPTION_SMTPS` also accepted
  // $mail->SMTPSecure = 'ssl';
    $mail->Port       = 25;                                    // TCP port to connect to

   
    
    //Recipients
    $mail->setFrom('noreply@fitindia.gov.in', 'Fit India');
    $mail->addAddress($email);     // Add a recipient
   // $mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');


    // Content
	if(isset($_POST['subject'])) {
		$subject = $_POST['subject']; 
	}else{
		$subject = 'Fit India Password Reset';
	}
	
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    =  $message; 
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send(); 
     echo '<div id="login" class="login"><div class="message">Check your email for the confirmation link.</div></div>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>