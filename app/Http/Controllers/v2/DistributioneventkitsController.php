<?php

namespace App\Http\Controllers\v2;

use App\Helpers\Helper as HelpersHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\v2\CommonController;
use App\Models\Distributioneventkits;
use App\Models\Distributionpermissions;
use Response;
use Helper;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Composer\Semver\Interval;

class DistributioneventkitsController extends Controller
{
    public function __construct() {

        $this->middleware('auth:api', ['except' => ['distribution_event_kit','get_distribution_event_kit','get_distribution_permissions','get_give_distribution_permissions']]);

    }

    public function distribution_event_kit(Request $request){

        try{

            $user = auth('api')->user();
            $adminfitindiaid = $request->adminfitindiaid;
            $fitindiaid = $request->fitindiaid;
            $lat = $request->lat;
            $long = $request->long;
            $address = $request->address;
            $cycle_check = $request->cycle_check;
            $center = $request->center;
            $name = $request->name;
            $dob = $request->dob;
            $gender = $request->gender;
            $email_id = $request->email_id;
            $mobile_no = $request->mobile_no;
            $date = $request->date;
            $merchandise_status = $request->merchandise_status;

            $data = Distributioneventkits::where([['fitindiaid','=' , $fitindiaid],['status','=',1]])->whereDate('date', $date)->first();

            // if($data->count() > 0){
            if (isset($data)) {
                    // dd($data['id']);
                    $update_query = Distributioneventkits::
                                                    where(['id' => $data['id']])
                                                    ->update([
                                                        'merchandise_status' => $merchandise_status
                                                    ]);
                    $data = Distributioneventkits::where([['fitindiaid','=' , $fitindiaid],['status','=',1]])->whereDate('date', $date)->first();

                    if (isset($data)) {

                        return Response::json(array(
                            'status'    => 'success',
                            'code'      =>  200,
                            'message_show' =>  'You get tshirt',
                            'message'   =>  null,
                            'data'      => $data,
                        ), 200);

                    }else{

                        return Response::json(array(
                        'status'    => 'error',
                        'code'      =>  200,
                        'message'   =>  'Something went wrong',
                        'data'   => null,
                        ), 401);

                    }
            }else{

                if($adminfitindiaid == null || $adminfitindiaid == '' || is_int($request->adminfitindiaid) === false){

                    $error_code = '801';
                    $error_message = 'Required Admin Fit Indiaid';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($fitindiaid == null || $fitindiaid == '' || is_int($request->fitindiaid) === false){

                    $error_code = '801';
                    $error_message = 'Required Fit India id';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($lat == null || $lat == ''){

                    $error_code = '801';
                    $error_message = 'Required Latitude';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($long == null || $long == ''){

                    $error_code = '801';
                    $error_message = 'Required Longitude';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($address == null || $address == ''){

                    $error_code = '801';
                    $error_message = 'Required Address';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($cycle_check == null || $cycle_check == '' || is_int($request->cycle_check) === false){

                    $error_code = '801';
                    $error_message = 'Required Cycle Check';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($center == null || $center == '' ){

                    $error_code = '801';
                    $error_message = 'Required Center';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($merchandise_status == null || $merchandise_status == '' || is_int($request->merchandise_status) === false){

                    $error_code = '801';
                    $error_message = 'Required Merchandise Status';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }



                $date = \Carbon\Carbon::today()->subDays(0);

                if($user){

                        $ongoingchallenger = new Distributioneventkits();
                        $ongoingchallenger->adminfitindiaid = $adminfitindiaid;
                        $ongoingchallenger->fitindiaid = $fitindiaid;
                        $ongoingchallenger->name = $name;
                        $ongoingchallenger->dob = $dob;
                        $ongoingchallenger->gender = $gender;
                        $ongoingchallenger->lat = $lat;
                        $ongoingchallenger->long = $long;
                        $ongoingchallenger->address = $address;
                        $ongoingchallenger->cycle_check = $cycle_check;
                        $ongoingchallenger->email_id = $email_id;
                        $ongoingchallenger->mobile_no = $mobile_no;
                        $ongoingchallenger->date = $date;
                        $ongoingchallenger->center = $center;
                        $ongoingchallenger->merchandise_status = $merchandise_status;
                        $ongoingchallenger->status = 1;
                        $ongoingchallenger->save();

                        $success_message = "Success message";

                        return Response::json(array(
                            'isSuccess' => 'true',
                            'message_show' =>  'You get tshirt',
                            'successm' => $success_message,
                            'code'      => 200,
                            'data'      => null,
                            'message'   => 'Insert Success'
                        ), 200);

                }else{

                    return Response::json(array(
                        'status'    => 'error',
                        'code'      =>  801,
                        'message'   =>  'Unauthorized'
                    ), 401);

                }
            }

        } catch(Exception $e) {

            $controller_name = 'DistributioneventkitsController';
            $function_name = 'distribution_event_kit';
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

    public function get_distribution_event_kit(Request $request){

        try{

            $user = auth('api')->user();
            $date = \Carbon\Carbon::today()->subDays(0);
            // dd($date);
            if($user){

                $fitindiaid = $request->fitindiaid;
                $date = $request->date;

                if($fitindiaid == null || $fitindiaid == '' || is_int($request->fitindiaid) === false){

                    $error_code = '801';
                    $error_message = 'Required Fit India Id';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                if($date == null || $date == ''){

                    $error_code = '801';
                    $error_message = 'Required Date';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                $data = Distributioneventkits::where([['fitindiaid','=' , $fitindiaid],['status','=',1]])->whereDate('date', $date)->get();

                if($data->count() > 0){

                    return Response::json(array(
                        'status'    => 'success',
                        'message_show' =>  'This user alerdy get tshirt',
                        'code'      =>  200,
                        'message'   =>  null,
                        'data'      => $data
                    ), 200);

                }else{

                    return Response::json(array(
                        'status'    => 'error',
                        'code'      =>  200,
                        'message'   =>  'Data not found',
                        'data'   => null,
                    ), 401);
                }

            }else{

                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'message'   =>  'Unauthorized'
                ), 401);

            }

        } catch(Exception $e) {

            $controller_name = 'DistributioneventkitsController';
            $function_name = 'get_distribution_event_kit';
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

    public function get_distribution_permissions(Request $request){

        try{

            $user = auth('api')->user();
            if($user){

                $fid = $request->fid;

                if($fid == null || $fid == '' || is_int($request->fid) === false){

                    $error_code = '801';
                    $error_message = 'Required Fit India Id';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                $data = Distributionpermissions::where([['fid','=' , $fid],['status','=',1]])->get();

                if($data->count() > 0){

                    return Response::json(array(
                        'status'    => 'success',
                        'code'      =>  200,
                        'message'   =>  null,
                        'data'      => $data
                    ), 200);

                }else{

                    return Response::json(array(
                        'status'    => 'error',
                        'code'      =>  200,
                        'message'   =>  'Data not found',
                        'data'   => null,
                    ), 401);
                }

            }else{

                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'message'   =>  'Unauthorized'
                ), 401);

            }

        } catch(Exception $e) {

            $controller_name = 'DistributioneventkitsController';
            $function_name = 'get_distribution_permissions';
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

    public function get_give_distribution_permissions(Request $request){

         try{

            $user = auth('api')->user();
            if($user){


                    $main_admin_id = $request->main_admin_id;
                    $give_permission_user_id = $request->give_permission_user_id;

                    if($main_admin_id === 1998024){

                        $Distributionpermiss = new Distributionpermissions();
                        $Distributionpermiss->fid = $give_permission_user_id;
                        $Distributionpermiss->status = 1;
                        $Distributionpermiss->save();

                        return Response::json(array(
                            'isSuccess' => 'true',

                            'code'      => 200,
                            'data'      => null,
                            'message'   => 'Insert Success'
                        ), 200);


                    }else{

                        $error_code = '801';
                        $error_message = 'You are not authorized user';

                        return Response::json(array(
                            'isSuccess' => 'false',
                            'code'      => $error_code,
                            'data'      => null,
                            'message'   => $error_message
                        ), 200);
                    }

                }else{

                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'message'   =>  'Unauthorized'
                ), 401);

            }
        } catch(Exception $e) {

            $controller_name = 'DistributioneventkitsController';
            $function_name = 'get_give_distribution_permissions';
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


}
