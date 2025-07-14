<?php

namespace App\Http\Controllers\v2;

use App\Helpers\Helper as HelpersHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\v2\CommonController;
use App\Models\Challengermasters;
use App\Models\Ongoingchallenger;
use App\Models\Storechallengerdatas;
use Response;
use Helper;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Composer\Semver\Interval;

class EmailController extends Controller
{
    public function __construct() {

        $this->middleware('auth:api', ['except' => ['sharestorymail']]);

    }

    public function sharestorymail(Request $request){

        try{

            // dd("123456");
            // $email = "ankit.katiyar@netprophetsglobal.com";
            $email = request()->has('email');
            dd($email);
            $otp = "123456";
            return dd($this->sendMailOtp($email,$otp));


        } catch(Exception $e) {

            $controller_name = 'EmailController';
            $function_name = 'sharestorymail';
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;

            $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);

            if(empty($request->Location)){
                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }
        }
    }

    public function sendMailOtp($email,$otp){


		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://10.246.120.18/test/mail/example1.php?email=$email&otp=$otp",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$response = curl_exec($curl);
		//dd($response);
		curl_close($curl);
		//$new_response = json_decode($response, true);
		if($response){
			return true;
		}else{
			return false;
		}

	}


}
