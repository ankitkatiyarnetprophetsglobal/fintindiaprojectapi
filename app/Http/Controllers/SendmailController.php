<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Response, Redirect;
use App\Service\SmsServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use FolderNameUsuallyGitHubUserName\ClassNameorGitHubProjectName\ClassException;
//use App\Service\SmsServiceProvider;

//use Juanparati\Sendinblue\SMS;
//use Juanparati\Sendinblue\MailTemplate;
//use Juanparati\Sendinblue\Facades\Template;

class SendmailController extends Controller{	
	
//https://api.sendinblue.com/v3/emailCampaigns
//$mailin = new Mailin('https://api.sendinblue.com/v2.0','MY_KEY');
	
   public function sendemail(Request $request){	  

   $data = array(	   
	   'name' => "Learning Laravel",
	);

	Mail::send('emails.mytestmail', $data, function ($message){
    	$message->from('yourEmail@domain.com', 'Learning Laravel');
	    $message->to('nagendragupta85@gmail.com')->subject('Learning Laravel test email');
	});

	return "Your email has been sent successfully";	  
  }
 
   
		/*$config=SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
		
		//echo "<pre>";print_r($config);exit;
		
		$apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(
			new GuzzleHttp\Client(),
			$config
		);
		
		$templateId = 1;
		$sendEmail = new \SendinBlue\Client\Model\SendEmail();
		
		dd($sendEmail);*/
		
		/* $sendEmail['emailTo'] = array('example@example.com');
		$sendEmail['emailCc'] = array('example1@example1.com');
		$sendEmail['headers'] = array('Some-Custom-Name' => 'unique-id-1234');
		$sendEmail['attributes'] = array('FNAME' => 'Jane', 'LNAME' => 'Doe');
		$sendEmail['replyTo'] = 'replyto@domain.com';
		$sendEmail['attachmentUrl'] = 'https://example.net/upload-file.pdf';

		try {
			$result = $apiInstance->sendTemplate($templateId, $sendEmail);
			print_r($result);
		} catch (Exception $e) {
			echo 'Exception when calling TransactionalEmailsApi->sendTemplate: ', $e->getMessage(), PHP_EOL;
		}   */
   
   
      //echo "test";exit;
   //}
  
    /*  public function sendemail(SmsServiceProvider $awesome_service)
     {
         
		 echo "ddd";exit;
		 
		 //$awesome_service->register();		 
         //return new Response();
     }
 */

       //echo "aaaa";  	 
		/* // Configure API key authorization: api-key 
		$config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
		// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
		// $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api-key', 'Bearer');
		// Configure API key authorization: partner-key
		$config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('partner-key', 'YOUR_API_KEY');
		// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
		// $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('partner-key', 'Bearer');

		$apiInstance = new SendinBlue\Client\Api\SMSCampaignsApi(
			// If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
			// This is optional, `GuzzleHttp\Client` will be used as default.
			new GuzzleHttp\Client(),
			$config
		);
		$campaignId = 789; // int | id of the campaign
		$sendReport = new \SendinBlue\Client\Model\SendReport(); // \SendinBlue\Client\Model\SendReport | Values for send a report

		try {
			$apiInstance->sendSmsReport($campaignId, $sendReport);
		} catch (Exception $e) {
			echo 'Exception when calling SMSCampaignsApi->sendSmsReport: ', $e->getMessage(), PHP_EOL;
		} */
  
  
  
  
	/*$sms->send(function($sms) {
        $sms->to('+917056513157');
        $sms->sender('Mr Foo');
        $sms->message('Hello Mr Bar');
    });
	 */
     /*	  
	  //Mail::to($user)->send(new MailNotify($user));	   
		 MailTemplate::send(100, function($message){
          $message->to('nagendragupta85@gmail.com');       
          $message->attributes(['placeholder1' => 'one', 'placeholder2' => 'two']);       
        });  		
		
		
		
		SMS::sender('TheBoss');         // Sender name (Spaces and symbols are not allowed)
		SMS::to('+917056513157');         // Mobile number with internal code (ES)
		SMS::message('Come to work!');  // SMS message
		SMS::tag('lazydev');            // Tag (Optional)
		//SMS::webUrl('http://example.com/endpoint'); // Notification webhook (Optional);
		SMS::send();
	*/

/*	

   SMS::send(function($sms) {
        $sms->to('+918700912542');
        $sms->sender('Mr Foo');
        $sms->message('Hello Mr Bar');        
    }); 
	 
	//dd('test');
	require('../mailin.php');
	$mailin = new Mailin("https://api.sendinblue.com/v2.0","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");
	$data = array( "to" => "+918700912542",
	"from" => "From",
	"text" => "Good morning - test",
	"web_url" => "http://example.com",
	"tag" => "Tag1",
	"type" => "transactional"
	);		
	var_dump($mailin->send_sms($data));
	die();*/		
	/*	*/

 }