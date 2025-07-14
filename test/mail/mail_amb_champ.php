<?php
namespace PHPMailer\PHPMailer;
require_once __DIR__ . '/PHPMailer/src/Exception.php';
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

if(isset($_POST['user_email'])) {
     $email  = $_POST['user_email'];
}
if(isset($_POST['message']))
{
    //$message  =  nl2br(htmlentities($_POST['message']));
    $message = $_POST['message'];
}
if(isset($_POST['name']))
{
    $name  =  $_POST['name'];
}
if(isset($_POST['type'])){
    $type = $_POST['type'];
}
if(isset($_POST['password'])){
    $password = $_POST['password'];
}
if(isset($_POST['reason'])){
    $reason = $_POST['reason'];
}
$subject='';
try {
    $htmlContent = '';
    if($message=='success'){
        $subject = 'Approved';
        $htmlContent.='<p>Dear '.@$name.',</p>';
        $htmlContent.='<p>It gives me immense pleasure welcoming you as a <strong>Fit India '.@$type.'</strong> for the Fit India Movement. Fit India is a flagship programme of the Government of India, which was launched by Honorable Prime Minister Shri Narendra Modi ji in 2019. His vision was to make Fit India Movement a Peoples Movement, where the government acts as a mere catalyst.</p>';
        $htmlContent.='<p>You will be happy to learn that in the last one year, the Movement has indeed been able to capture the imagination of the citizens of India and people from all walks of life and age groups have come forward to include fitness activities in their daily lives, as envisioned by Honorable PM.</p>';
        $htmlContent.='<p>As a prominent name in the fitness arena, you have the power to motivate people to make fitness as a way of life and make India a FIT NATION.</p>';
        $htmlContent.='<p>Please login to your Fit India profile and download your e-certificate.</p>';
        $htmlContent.='<p>User id: '.@$email.'<br>';
        $htmlContent.='Password: '.@$password.'</p>';
        $htmlContent.='<p>Regards,<br>';
        $htmlContent.='Ms. Amar Jyoti, IRS<br>';
        $htmlContent.='Mission Director</p>';
    }else{
        $subject = 'Rejected';
        $htmlContent.='<p>Dear '.@$name.',</p>';
        if($reason=='1'){ //Draft 1 (Generic)
            $htmlContent.='<p>Thank you for showing interest in the position of <strong>Fit India '.@$type.'</strong>. We would like to inform you that your application cannot be processed further as your application do not fulfill the criteria as mentioned on the FIT India website.</p>';
        }elseif($reason=='2'){ // Draft 2 (Followers)
            $htmlContent.='<p>Thank you for showing interest in the position of <strong>Fit India '.@$type.'</strong>. We would like to inform you that your application cannot be processed further as your application do not fulfill the criteria as mentioned on the FIT India website.</p>';
            $htmlContent.='<p>The individual must have cumulative followers in the range of 10K – 100K on their social media platforms (Facebook, Twitter, & Instagram)</p>';
        }elseif($reason=='3'){ // Draft 3 (At least one social media)
            $htmlContent.='<p>Thank you for showing interest in the position of <strong>Fit India '.@$type.'</strong>. We would like to inform you that your application cannot be processed further as your application do not fulfill the criteria as mentioned on the FIT India website.</p>';
            $htmlContent.='The applicant individual needs to be present on at least one social media platform (Facebook, Twitter, or Instagram)</p>';
        }elseif($reason=='4'){ // Draft 4 (Offensive)
            $htmlContent.='<p>Thank you for showing interest in the position of <strong>Fit India '.@$type.'</strong>. We would like to inform you that your application cannot be processed further as your application do not fulfill the criteria as mentioned on the FIT India website.</p>';
            $htmlContent.='<p>The appointed individual, in his/her posts associated with Fit India Mission, shall not include content/text/pictures which may be offensive and hurt sentiments of any religion, caste, gender and sexuality.</p>';
        }else{ // Draft 5 (Criminal and legal offence)
            $htmlContent.='<p>Thank you for showing interest in the position of <strong>Fit India '.@$type.'</strong>. We would like to inform you that your application cannot be processed further as your application do not fulfill the criteria as mentioned on the FIT India website.</p>';
            $htmlContent.='<p>The individual has not been punished for any criminal offence or any criminal legal proceedings shall not be pending against the individual.</p>';
        }

        $htmlContent.='<p>You can apply for the same again once you fulfill the criteria. We hope that you will find an opportunity soon</p>';
        $htmlContent.='<p>With Regards<br>Fit India Team</p>';
    }

    //Server settings
    //$htmlMsg = htmlspecialchars($htmlContent);
//     $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
//     $mail->isSMTP();                                            // Send using SMTP
//     $mail->Host       = 'relay.nic.in';                    // Set the SMTP server to send through
//     $mail->SMTPAuth   = false;                                   // Enable SMTP authentication
//    // $mail->Username   = 'test@gmail.com';                     // SMTP username
//    // $mail->Password   = 'Test@234';                               // SMTP password
//     //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; ENCRYPTION_STARTTLS `PHPMailer::ENCRYPTION_SMTPS` also accepted
//   // $mail->SMTPSecure = 'ssl';
//     $mail->Port       = 25;                                    // TCP port to connect to



    //Recipients
    // $mail->setFrom('noreply@fitindia.gov.in', 'Fit India');
    // $mail->addAddress($email);     // Add a recipient
   // $mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
    //$mail->SMTPDebug  = 0;   // 1 = errors and messages    // 2 = messages only
    // $mail->Host       = "relay.nic.in"; // sets the SMTP server
    $mail->Host       = "164.100.14.95"; // sets the SMTP server
    $mail->Port       = "25";                    // set the SMTP port for the GMAIL server
    //$mail->SMTPAuth = false;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Username = "noreply.fitindia@gov.in";
    $mail->Password = "V2&rM8%dY8";
    $mail->CharSet = 'UTF-8';
    $mail->SetFrom($from_add, "eGreetings");
    $mail->AddReplyTo($from_add, "eGreetings");
    $mail->Subject    = $subject;
    $mail->AddAddress($to_add);

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Fit India '.@$type.': '.@$subject;
    $mail->Body    =  $htmlContent;

    $mail->send();
     echo '<div id="login" class="login"><div class="message">Check your email for the confirmation link.</div></div>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
