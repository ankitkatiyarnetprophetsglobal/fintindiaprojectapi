<?php

namespace App\Http\Controllers\v2\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response;
use Illuminate\Validation\Rule;
use App\Models\Errorexception;
use Illuminate\Support\Facades\Validator;

class PostalPinCodeController extends Controller
{
    public function postaldetails( Request $request){       
        
        dd(3121645987);

        $validator=Validator::make($request->all(),[

            'pin_code'=>'required|numeric|digits:6',

        ]);

        if($validator->fails()){

            $error=$validator->errors()->first();

             return response()->json([

                'success' => false,
                'status' => 'error',
                'code' => 400,
                'message' => $error,

            ], 400);
        }


    $ch=curl_init();
    $url="https://api.postalpincode.in/pincode/".$request->pin_code;
    // dd($url);
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

    $resp=curl_exec($ch);
    dd($resp);
    if($e=curl_error($ch)){

        $insertexception = new Errorexception();
        $insertexception->error_exception = $e->getMessage();
        //$insertexception=DB::insert('insert into exception_error_handeling_data(error_exception,date,time)values (?,?,?)', [$ex->getMessage()]);
        $insertexception->save();
        return response()->json(['error'=>$e]);

    }

    else {

        $response = json_decode($resp,true);

        $PostOffice = [];
        $data = $response[0]['PostOffice'];
        foreach ($data as $x => $val) {

            $PostOffice['District'] =  $val['District'];
            if($val['Block'] != 'NA'){
                $PostOffice['Block'] = $val['Block'];
                $PostOffice['Name']  = array();
            }else{
                $PostOffice['Block'] = "";
                $PostOffice['Name'][$x] = $val['Name'];
            }

            $PostOffice['State'] = $val['State'];
        }
        return response()->json([
            'status'=>'success',
            'code'=>200,
            'data'=>$PostOffice
        ],200);
    }
    curl_close($ch);


}
}
