<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response;
use App\Models\MobileVersion;
use App\Models\Distributionpermissions;

class MobileVer extends Controller
{
    //
	public function __construct() {

    }

	function versioncheck(Request $request){

		if(empty($request->platform)){
			$versions = MobileVersion::where('status', 1)->orderBy('created_date', 'desc')->get();
		}else{
			$versions = MobileVersion::where('platform',$request->platform)->where('status', 1)
		->orderBy('created_date', 'desc')->limit(1)->get();
		}


			return Response::json(array(
					'status'    => 'sucess',
					'code'      =>  200,
					'message'   =>  'Get version data sucessfully',
					'data' => $versions
				), 200);


	}


	function apitest(Request $request){
		echo "testing API";
		exit();
	}


}
