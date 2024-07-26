<?php

namespace App\Http\Controllers\v2;

use App\Helpers\Helper as HelpersHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\v2\CommonController;
use App\Models\Errorlog;
use App\Models\Abhaintegration;
use App\Models\Abhausermaping;
use App\Models\Abhauserdetails;
use App\Models\Abhauserlog;
use Response;
use Helper;





class ExampleController extends Controller
{    
    public function __construct() {

        $this->middleware('auth:api', ['except' => ['examplefunctions']]);

    }
    
    public function examplefunctions(Request $request){
        
        $xmlContent = $request->getContent();
        // dd($xmlContent);
        $xml = simplexml_load_string($xmlContent);
        // dd($xml->name);
        dd($xml);
        // For logging and debugging purposes
        // Log::info('Received XML: ' . $xmlContent);

        // Convert XML to JSON for easier manipulation if needed
        $json = json_encode($xml, false);
        // dd($json);
        $data = json_decode($json, true);
        dd($data);
        // Return a response
        return response()->json(
                                    [
                                        'message' => 'XML received', 
                                        'data' => $data
                                    ]
                                );
        
    }
}
