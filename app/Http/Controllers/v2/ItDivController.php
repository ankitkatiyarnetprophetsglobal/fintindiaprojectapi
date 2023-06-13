<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
class ItDivController extends Controller
{
    private $OPENSSL_CIPHER_NAME = "aes-128-cbc"; //Name of OpenSSL Cipher 
    private $CIPHER_KEY_LEN = 16; //128 bits
   
    
 
	public function encrypt($key,$iv,$data) {
        if (strlen($key) < $this->CIPHER_KEY_LEN) {
            $key = str_pad("$key", $this->CIPHER_KEY_LEN, "0"); //0 pad to len 16
        } else if (strlen($key) > $this->CIPHER_KEY_LEN) {
            $key = substr($str, 0, $this->CIPHER_KEY_LEN); //truncate to 16 bytes
        }
        
        $encodedEncryptedData = base64_encode(openssl_encrypt($data, $this->OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv));
        $encodedIV = base64_encode($iv);
        $encryptedPayload = $encodedEncryptedData.":".$encodedIV;
        
        return $encryptedPayload;
        
    }   
   
    function decrypt($key, $iv, $data) {
        if (strlen($key) < $this->CIPHER_KEY_LEN) {
            $key = str_pad("$key", $this->CIPHER_KEY_LEN, "0"); //0 pad to len 16
        } else if (strlen($key) > $this->CIPHER_KEY_LEN) {
            $key = substr($str, 0, $this->CIPHER_KEY_LEN); //truncate to 16 bytes
        }
        
        // $parts = explode(':', $data); 
        //$decryptedData = openssl_decrypt(base64_decode($parts[0]), $this->OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, base64_decode($parts[1]));
			
        $decryptedData = openssl_decrypt( base64_decode($data), $this->OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv);
        return $decryptedData;
    }


    public function encryptFunct(Request $request){
       $iv = "fedcba9876543210"; #Same as in JAVA
	   $key = "0a9b8c7d6e5f4g3h"; #Same as in JAVA

      $result = encrypt($key,$iv,$request->email);
      dd($result);
        
    }


    public function decryptFunct(Request $request){
        
			if (strpos($request->email, '=') == false) {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Not valid email'
				), 422);
			}
			
            $iv = "fedcba9876543210"; #Same as in JAVA
			$key = "0a9b8c7d6e5f4g3h"; #Same as in JAVA
 
       $result = decrypt($key,$iv,decodeURIComponent($request->email));
       dd($result);
    }
}
