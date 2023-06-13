<?php

// namespace App\Http\Controllers\RatingControllers;
namespace App\Http\Controllers\v2\Api;

use App\Models\Reviews;
use App\Models\Ratings;
use App\Models\Master;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response;

class Reviewscontrollers extends Controller
{
        public $limit=4;
        public $status=1;
        public $others=0;


        public function review(Request $request){
            try
            {
                // dd(232323);
                // dd($request->data);
                foreach($request->data as $key => $value) {

                    //dd($value['user_id']);
                    // echo "$x = $val<br>";
                    $reviewinsert = new Reviews();
                    $reviewinsert->user_id = $value['user_id'];
                    $reviewinsert->option_id = $value['option_id'];
                    $reviewinsert->email = $value['email'];
                    $reviewinsert->response = $value['response'];
                    $reviewinsert->os_name = $value['os_name'];
                    $reviewinsert->os_version = $value['os_version'];
                    $reviewinsert->status = $this->status;
                    $reviewinsert->save();

                    $ratinginsert = new Ratings();
                    $ratinginsert->user_id = $value['user_id'];
                    $ratinginsert->option_id = $value['option_id'];
                    $ratinginsert->email = $value['email'];
                    $ratinginsert->ranking = $value['ranking'];
                    $ratinginsert->os_name = $value['os_name'];
                    $ratinginsert->os_version = $value['os_version'];
                    $ratinginsert->status = $this->status;
                    $ratinginsert->save();
                }
                if($reviewinsert->save()){

					return Response::json(array(
						'status'    => 'success',
						'code'      =>  200,
						'data'   => 'Data inserted'
					), 200);

				} else {

					return Response::json(array(
						'status'    => 'error',
						'code'      =>  401,
						'data'   => 'Some technical issue'
					), 401);
				}
                // return response()->json([
                //     'ratings_value'=>$ratinginsert,
                //     'review_value'=>$reviewinsert,


                // ]);
            }catch(\Exception $ex){
                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  401,
                    'data'   => 'Some technical issue',
                    'error'=>$ex->getMessage()
                ), 401);
            }







        }
        public function master(Request $request){
            // dd($this->others);
            try
            {
                // dd($request->ranking);
               $data = Master::where('status',$this->status)->where('ranking', $request->ranking)->orwhere('ranking', $this->others)->orderBy('id','desc')->take($this->limit)->get() ;
                //    dd($data);
                if($data->count() > 0){
                    return Response::json(array(
                        'status'    => 'success',
                        'code'      =>  200,
                        'data'   => $data
                    ), 200);

                }else{
                        return Response::json(array(
                            'status'    => 'error',
                            'code'      =>  401,
                            'data'   => 'Data not found'
                        ), 401);
                }

            } catch(\Exeption $ex){
                return response()->json([
                    'message' => $ex->getMessage()
                ]);

            }
        }



    }

