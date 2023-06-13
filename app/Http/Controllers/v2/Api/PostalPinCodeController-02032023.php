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
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $resp=curl_exec($ch);

        if($e=curl_error($ch)){

            $insertexception = new Errorexception();
            $insertexception->error_exception = $e;
            //$insertexception=DB::insert('insert into exception_error_handeling_data(error_exception,date,time)values (?,?,?)', [$ex->getMessage()]);
            $insertexception->save();
            return response()->json(['error'=>$e]);

        }else {
            $decoded=json_decode($resp,true);
            return response()->json([
                    'data'=>$decoded
            ]);
        }
            curl_close($ch);


    }
}
