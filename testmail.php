<?php
namespace PHPMailer\PHPMailer;
require_once __DIR__ . '/PHPMailer/src/Exception.php';
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);
$email  = "consultsandeepsingh@gmail.com";
$message = "Welcome Fit India";
try {
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = '164.100.14.95';                     // Set the SMTP server to send through relay.nic.in
    $mail->SMTPAuth   = false;                                   // Enable SMTP authentication
    $mail->Port       = 25;                                    // TCP port to connect to

    $mail->setFrom('noreply@fitindia.gov.in', 'Fit India');
    $mail->addAddress($email);     // Add a recipient
   
	if(isset($_POST['subject'])) {
		$subject = $_POST['subject']; 
	}else{
		$subject = 'Fit India';
	}
	
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    =  $message; 
    
	//echo '<pre>';
	//print_r($mail);
    $mail->send(); 
     echo '<div id="login" class="login"><div class="message">Check your email for the confirmation link.</div></div>';
} catch (Exception $e) {
	echo '<pre>';
	print_r($e); 
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>