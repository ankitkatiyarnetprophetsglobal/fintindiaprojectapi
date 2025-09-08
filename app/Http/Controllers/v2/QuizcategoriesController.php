<?php

namespace App\Http\Controllers\v2;

use App\Helpers\Helper as HelpersHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\v2\CommonController;
use App\Models\Quizcategories;
use App\Models\Quizmasterqueans;
use App\Models\Mailtrakings;
use App\Models\Quizuserattempts;
use App\Models\Quiztitlelists;
use Response;
use Helper;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Composer\Semver\Interval;

class QuizcategoriesController extends Controller
{
    public function __construct() {

        $this->middleware('auth:api', ['except' => ['quizcategories','quiz_master_question_answers','store_quiz_user_attempt','get_user_rank','getAllUserRank','useremailallsend','useremail','useremailalltwosend','quiz_title_lists_v2']]);

    }

    public function quizcategories(Request $request){

        try{

            $user = auth('api')->user();

            if($user){

                $data = Quizcategories::withCount(['quizTitleLists' => function($q){
                                        $q->whereStatus(true);
                                        }])
                                        ->where([
                                            ['status','=' , 1]
                                            ])
                                        ->get();

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

            $controller_name = 'QuizcategoriesController';
            $function_name = 'quizcategories';
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

    public function quiz_title_lists(Request $request){

        try{

            $quiz_categories_id = $request->quiz_categories_id;
            $user_id = $request->user_id;

            if($user_id == null || $user_id == '' || is_int($request->user_id) === false){

                $error_code = '801';
                $error_message = 'Required User id';

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }

            if($quiz_categories_id == "") {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Quiz Categories ID'
				), 422);
			}

            $user = auth('api')->user();

            if($user){
                // dd("done");
                $data = Quiztitlelists::
                                        leftJoin('quiz_user_attempts', function($leftJoin)use($user_id)
                                        {
                                            $leftJoin->on('quiz_title_lists.id', '=', 'quiz_user_attempts.quiz_title_list_id')
                                                ->where('quiz_user_attempts.user_id', '=', $user_id)
                                                ->distinct('quiz_user_attempts.user_id');
                                        })
                                        ->where([
                                                ['quiz_title_lists.status','=', 1],
                                                ['quiz_title_lists.quiz_categories_id','=', $quiz_categories_id],
                                        ])
                                        // ->where(,)
                                        ->select(
                                                'quiz_title_lists.id as quiz_title_id',
                                                'quiz_title_lists.quiz_categories_id',
                                                'quiz_title_lists.name',
                                                'quiz_title_lists.description',
                                                'quiz_title_lists.icon',
                                                'quiz_title_lists.duration',
                                                'quiz_user_attempts.user_id'
                                                )
                                        // ->take(1)
                                        // ->get();
                                        ->paginate(20);
                // dd($data);
                if($data->count() > 0){
                    return Response::json(array(
                        'status'    => 'success',
                        'code'      =>  200,
                        'message'   =>  null,
                        'data'      => $data,
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

            $controller_name = 'QuizcategoriesController';
            $function_name = 'quiz_title_lists';
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

    public function quiz_title_lists_v2(Request $request){

        try{

            $quiz_categories_id = $request->quiz_categories_id;
            $user_id = $request->user_id;

            if($user_id == null || $user_id == '' || is_int($request->user_id) === false){

                $error_code = '801';
                $error_message = 'Required User id';

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }

            if($quiz_categories_id == "") {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Quiz Categories ID'
				), 422);
			}

            $user = auth('api')->user();

            if($user){
                // dd("done");
                // $data = Quiztitlelists::
                //                         leftJoin('quiz_user_attempts', function($leftJoin)use($user_id)
                //                         {
                //                             $leftJoin->on('quiz_title_lists.id', '=', 'quiz_user_attempts.quiz_title_list_id')
                //                                 ->where('quiz_user_attempts.user_id', '=', $user_id)
                //                                 ->distinct('quiz_user_attempts.user_id');
                //                         })
                //                         ->where([
                //                                 ['quiz_title_lists.status','=', 1],
                //                                 ['quiz_title_lists.quiz_categories_id','=', $quiz_categories_id],
                //                         ])
                //                         // ->where(,)
                //                         ->select(
                //                                 'quiz_title_lists.id as quiz_title_id',
                //                                 'quiz_title_lists.quiz_categories_id',
                //                                 'quiz_title_lists.name',
                //                                 'quiz_title_lists.description',
                //                                 'quiz_title_lists.icon',
                //                                 'quiz_title_lists.duration',
                //                                 'quiz_user_attempts.user_id'
                //                                 )
                //                         // ->take(1)
                //                         // ->get();
                //                         ->paginate(20);
                // dd($data);
                $query = DB::table('quiz_title_lists')
                            ->select([
                                'quiz_title_lists.id as quiz_title_id',
                                'quiz_title_lists.quiz_categories_id',
                                'quiz_title_lists.name',
                                'quiz_title_lists.description',
                                'quiz_title_lists.icon',
                                'quiz_title_lists.duration',
                                'quiz_user_attempts.user_id',
                                DB::raw("SUM(quiz_user_attempts.mark) OVER(PARTITION BY quiz_user_attempts.user_id, quiz_title_lists.id) AS mark"),
                                // 'quiz_user_attempts.mark'
                            ])
                            ->leftJoin('quiz_user_attempts', function ($join)use($user_id) {
                                $join->on('quiz_title_lists.id', '=', 'quiz_user_attempts.quiz_title_list_id')
                                    ->where('quiz_user_attempts.user_id', '=', $user_id);
                            })
                            ->where('quiz_title_lists.status', '=', 1)
                            ->where('quiz_title_lists.quiz_categories_id', '=', $quiz_categories_id)
                            // ->groupBy(
                            //     "quiz_title_lists.id",
                            //     "fitindia.quiz_title_lists.quiz_categories_id",
                            //     "fitindia.quiz_title_lists.name",
                            //     "fitindia.quiz_title_lists.description",
                            //     "fitindia.quiz_title_lists.icon",
                            //     "fitindia.quiz_title_lists.duration",
                            //     "fitindia.quiz_user_attempts.user_id",
                            //     "quiz_user_attempts.mark"
                            // )
                            ->distinct();

                        // $data = $query->get();
                        $data = $query->paginate(20);
                        // dd($data);
                if($data->count() > 0){
                    return Response::json(array(
                        'status'    => 'success',
                        'code'      =>  200,
                        'message'   =>  null,
                        'data'      => $data,
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

            $controller_name = 'QuizcategoriesController';
            $function_name = 'quiz_title_lists';
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

    public function quiz_master_question_answers(Request $request){

        try{
            // dd($request->all());

            $quiz_categories_id = $request->quiz_categories_id;
            $quiz_title_list_id = $request->quiz_title_list_id;

            if($quiz_categories_id == "") {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Quiz Categories ID'
				), 422);
			}

            if($quiz_title_list_id == "") {
				return Response::json(array(
					'status'    => 'error',
					'code'      =>  422,
					'message'   =>  'Quiz title list ID'
				), 422);
			}

            $user = auth('api')->user();

            if($user){

                $data = Quizmasterqueans::where([
                                                ['status','=', 1],
                                                ['quiz_categories_id','=', $quiz_categories_id],
                                                ['quiz_title_list_id','=', $quiz_title_list_id],
                                              ])
                                        ->get();
                if($data->count() > 0){
                    return Response::json(array(
                        'status'    => 'success',
                        'code'      =>  200,
                        'message'   =>  null,
                        'data'      => $data,
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

            $controller_name = 'QuizcategoriesController';
            $function_name = 'quizcategories';
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

    public function store_quiz_user_attempt(Request $request){

        try{
            // dd($request->all());
            // dd(count($request->quizuserattempt));
            $user_id = is_int($request->user_id);

            if($user_id == null || $user_id == '' || $user_id === false){

                $error_code = '801';
                $error_message = 'Required User id';

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }

            if(count($request->quizuserattempt) == 0){
                $error_code = '801';
                $error_message = 'User Attempt List Not Array';

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }

            $user = auth('api')->user();

            if($user){

                    $quizuserattempt = $request->quizuserattempt;

                    foreach($quizuserattempt as $key => $value){
                        // echo $value['quiz_categories_id'];
                        // echo '<br/>';
                        $Quizuserattempt = new Quizuserattempts();
                        $Quizuserattempt->user_id = $request->user_id;
                        $Quizuserattempt->quiz_categories_id = $value['quiz_categories_id'];
                        $Quizuserattempt->quiz_title_list_id = $value['quiz_title_list_id'];
                        $Quizuserattempt->quiz_master_question_answers_id = $value['quiz_master_question_answers_id'];
                        $Quizuserattempt->ans_option_id = $value['ans_option_id'];
                        $Quizuserattempt->is_correct = $value['is_correct'];
                        $Quizuserattempt->mark = $value['mark'];
                        $Quizuserattempt->question_status = $value['question_status'];
                        $Quizuserattempt->quiz_timeing = $value['quiz_timeing'];
                        $Quizuserattempt->status = 1;
                        $Quizuserattempt->save();

                    }

                    // dd("done");
                    return Response::json(array(
                        'isSuccess' => 'true',
                        'code'      => 200,
                        'data'      => null,
                        'message'   => 'Insert Success'
                    ), 200);
                // }


            }else{

                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'message'   =>  'Unauthorized'
                ), 401);

            }

        } catch(Exception $e) {

            $controller_name = 'QuizcategoriesController';
            $function_name = 'store_quiz_user_attempt';
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

    public function get_user_rank(Request $request){
        try{

            $user = auth('api')->user();

            if($user){

                $user_id = is_int($request->user_id);

                if($user_id == null || $user_id == '' || $user_id === false){

                    $error_code = '801';
                    $error_message = 'Required User id';

                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message
                    ), 200);
                }

                // $data = DB::table('user_ranks')
                // $data = DB::table('quiz_user_ranks')
                //             ->where([['user_id','=' , $request['user_id']]])
                //             ->get();


                // if($data->count() > 0){
                //     return Response::json(array(
                //         'status'    => 'success',
                //         'code'      =>  200,
                //         'message'   =>  null,
                //         'data'      => $data
                //     ), 200);
                // }else{
                //     $data = array(array("user_id"=>$request['user_id'], "score"=>"--", "rank"=> "--"));
                //     return Response::json(array(
                //         'status'    => 'error',
                //         'code'      =>  200,
                //         'message'   =>  'Data not found',
                //         'data'   => $data,
                //     ), 401);
                // }

                $data = DB::table('quiz_user_attempts')
                        ->join('usermetas', 'usermetas.user_id', '=', 'quiz_user_attempts.user_id')
                        ->join('users', 'usermetas.user_id', '=', 'users.id')
                        ->where([
                            ['quiz_user_attempts.status','=', 1],
                            // ['quiz_user_attempts.user_id','=' , $request['user_id']]
                        ])
                        // ->whereRaw("quiz_user_attempts.created_at >= NOW()-INTERVAL $days DAY")
                        ->groupBy(
                            // 'quiz_user_attempts.mark',
                            'users.name',
                            'quiz_user_attempts.user_id',
                            // 'quiz_user_attempts.quiz_timeing',
                            // 'quiz_user_attempts.created_at'
                            )
                        ->select(
                            'quiz_user_attempts.user_id',
                            DB::raw('IFNULL(users.name, "Unknown") as name'),
                            DB::raw('SUM(quiz_user_attempts.mark) as score'),
                            DB::raw('sum(quiz_timeing) as quiz_timeing'),
                            // 'quiz_user_attempts.quiz_timeing',
                            DB::raw("dense_rank() over(ORDER by SUM(mark) desc,sum(quiz_timeing) asc) as 'rank'"),
                            'usermetas.image',
                            // 'quiz_user_attempts.created_at'
                        )
                        ->orderby('rank', 'desc')
                        ->get();

                if($data->count() > 0){

                    foreach ($data as $key => $val) {
                        // dd($val);
                        if ($val->user_id === $request['user_id']) {
                            $user_id = $val->user_id;
                            $rank = $val->rank;
                            $score = $val->score;
                            $quiz_timeing = $val->quiz_timeing;
                        }
                    }

                    $all_data = array(array (
                        // "active_user_count" => count($active_user),
                        "user_id" => $user_id,
                        "score" => $score,
                        "quiz_timeing" => $quiz_timeing,
                        "rank" => $rank,
                    ));

                    return Response::json(array(
                        'status'    => 'success',
                        'code'      =>  200,
                        'message'   =>  null,
                        'data'      => $all_data
                    ), 200);


                }else{
                    $data = array(array("user_id"=>$request['user_id'], "score"=>"--", "rank"=> "--"));
                    return Response::json(array(
                        'status'    => 'error',
                        'code'      =>  200,
                        'message'   =>  'Data not found',
                        'data'   => $data,
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

            $controller_name = 'QuizcategoriesController';
            $function_name = 'get_user_rank';
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

    public function getAllUserRank(Request $request){

        try{
            // dd(21231231);
            $type = $request['type'];

            if($type == null || $type == ''){

                $error_code = '801';
                $error_message = 'Required Type';

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }
            // dd($type);
            if($type == 'm'){
                $days = 31;
                // dd("asdfasdfasfd");
                // $transdate = date('d-m-Y', time());
                // $condition_wise = date('m', strtotime($transdate));
                // $sinoprater = '=';
                // $where_condition = "whereMonth";
                // $month_query = "->whereMonth('user_rank.created_at', '=',$month)";
                // dd($query);
            }else if($type == 'w'){
                $days = 8;
                // dd("week");
                // $condition_wise = date('Y-m-d', strtotime("-7 days"));
                // $sinoprater = '>';
                // $where_condition = "where";
                // ->where( 'user_rank.created_at', '>', date('Y-m-d', strtotime("-7 days")))
            }else if($type == 'a'){
                $days = 366;
                // $condition_wise = date('Y-m-d', strtotime("-365 days"));
                // $sinoprater = '>';
                // $where_condition = "where";
            }
            $user = auth('api')->user();

            if($user){

                // $data = DB::table('user_ranks')
                //             ->join('usermetas', 'usermetas.user_id', '=', 'user_ranks.user_id')
                //             ->join('quiz_user_attempts', 'usermetas.user_id', '=', 'user_ranks.user_id')
                //             ->join('users', 'usermetas.user_id', '=', 'users.id')
                //             ->$where_condition('quiz_user_attempts.created_at', $sinoprater, $condition_wise)
                //             // ->where( 'user_rank.created_at', '>', date('Y-m-d', strtotime("-7 days")))
                //             ->select(
                //                         'users.name as name',
                //                         'usermetas.image as image',
                //                         'user_ranks.user_id as user_id',
                //                         'user_ranks.score as score',
                //                         'user_ranks.rank as rank',
                //                         'quiz_user_attempts.created_at'
                //                     )
                //             ->paginate(20);
                            // ->get();
                $date = \Carbon\Carbon::today()->subDays(2);
                // dd($date);
                $date = Carbon::now()->subDays(7);
                // dd($date);
                $data = DB::table('user_ranks')
                            ->join('usermetas', 'usermetas.user_id', '=', 'user_ranks.user_id')
                            ->join('quiz_user_attempts', 'usermetas.user_id', '=', 'user_ranks.user_id')
                            ->join('users', 'usermetas.user_id', '=', 'users.id')
                            // ->$where_condition('quiz_user_attempts.created_at', $sinoprater, $condition_wise)
                            // ->whereRaw("quiz_user_attempts.created_at >= NOW()-INTERVAL $days DAY")
                            ->where('quiz_user_attempts.created_at', '>', date($date))
                            // ->where( 'user_rank.created_at', '>', date('Y-m-d', strtotime("-7 days")))
                            ->select(
                                        // DB::raw('sum("quiz_user_attempts.mark")'),
                                        // DB::raw('users.name','Unknown'),
                                        DB::raw('IFNULL(users.name, "Unknown") as name'),
                                        'user_ranks.score',
                                        'user_ranks.user_id',
                                        // 'users.name',
                                        'usermetas.image',
                                        'user_ranks.rank',
                                        // 'quiz_user_attempts.quiz_timeing',
                                        // DB::raw('quiz_user_attempts.created_at >= NOW()-INTERVAL 30 DAY'),
                                        // 'quiz_user_attempts.created_at',

                                        // 'quiz_user_attempts.user_id',
                                        // 'quiz_user_attempts.user_id',
                                        // 'quiz_user_attempts.quiz_categories_id',
                                        // 'quiz_user_attempts.quiz_title_list_id',
                                        // 'quiz_user_attempts.quiz_master_question_answers_id',
                                    )
                                // ->sum('quiz_user_attempts.mark')
                            ->groupBy(
                                        'user_ranks.user_id',
                                        'users.name',
                                        'usermetas.image',
                                        'user_ranks.rank',
                                        // 'quiz_user_attempts.created_at',
                                        'user_ranks.score',
                                        'quiz_user_attempts.quiz_timeing'
                                    )
                            ->orderby('quiz_user_attempts.quiz_timeing','asc')
                            ->orderby('user_ranks.rank', 'asc')
                            ->paginate(20);
                // dd("done");
                // $transdate = date('d-m-Y', time());

                // $data = DB::select("SELECT sum(quiz_user_attempts.mark) as score,user_ranks.user_id,users.name as name,usermetas.image as image,user_ranks.rank,quiz_user_attempts.created_at
                //                     FROM user_ranks
                //                     inner join usermetas on usermetas.user_id = user_ranks.user_id
                //                     inner join quiz_user_attempts on usermetas.user_id = user_ranks.user_id
                //                     inner join users on users.id = user_ranks.user_id
                //                     where quiz_user_attempts.created_at >= NOW()-INTERVAL 30 DAY
                //                     group by user_ranks.user_id,users.name,usermetas.image,user_ranks.rank,quiz_user_attempts.created_at;");

                // dd(count($data));
                if(count($data) > 0){
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

            $controller_name = 'QuizcategoriesController';
            $function_name = 'getAllUserRank';
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
    public function getAllUserRankv2(Request $request){

        try{

            $type = $request['type'];

            if($type == null || $type == ''){

                $error_code = '801';
                $error_message = 'Required Type';

                return Response::json(array(
                    'isSuccess' => 'false',
                    'code'      => $error_code,
                    'data'      => null,
                    'message'   => $error_message
                ), 200);
            }

            if($type == 'm'){

                $days = 31;

            }else if($type == 'w'){

                $days = 8;

            }else if($type == 'a'){

                $days = 366;

            }
            $user = auth('api')->user();

            if($user){

                $data = DB::table('quiz_user_attempts')
                        ->join('usermetas', 'usermetas.user_id', '=', 'quiz_user_attempts.user_id')
                        ->join('users', 'usermetas.user_id', '=', 'users.id')
                        ->where([
                            ['quiz_user_attempts.status','=', 1]
                        ])
                        ->whereRaw("quiz_user_attempts.created_at >= NOW()-INTERVAL $days DAY")
                        ->groupBy(
                            // 'quiz_user_attempts.mark',
                            'users.name',
                            'quiz_user_attempts.user_id',
                            // 'quiz_user_attempts.quiz_timeing',
                            // 'quiz_user_attempts.created_at'
                            )
                        ->select(
                            'quiz_user_attempts.user_id',
                            DB::raw('IFNULL(users.name, "Unknown") as name'),
                            DB::raw('SUM(quiz_user_attempts.mark) as score'),
                            DB::raw('sum(quiz_timeing) as quiz_timeing'),
                            // 'quiz_user_attempts.quiz_timeing',
                            DB::raw("dense_rank() over(ORDER by SUM(mark) desc,sum(quiz_timeing) asc) as 'rank'"),
                            'usermetas.image',
                            // 'quiz_user_attempts.created_at'
                        )
                        ->orderby('rank', 'asc')
                        ->paginate(20);
                        // ->get();

                // dd($data);
                if(count($data) > 0){
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

            $controller_name = 'QuizcategoriesController';
            $function_name = 'getAllUserRankv2';
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

    public function useremailsend(Request $request){

        try{

            // dd("useremailsend");


            $query = "SELECT id,name,email FROM `users` where phone in (9772749970,9050123455,8435846930,7506342339,8527412805,7006324121,7011556474,8585957826,6357337529,9015161734,9818751007,9473684656,9733009595,9769007788,9871162457,9818943170);";

            $data = DB::select(DB::raw($query));
            // dd($data);
            foreach($data as $key => $value){
                // dd($value);
                $user_id = $value->id;
                $name = $value->name;
                $email = $value->email;
                $event_name = "Fit India Cycling Drive";
                $this->sendMailsingle($email,$name,$user_id,$event_name);
            }

        } catch(Exception $e) {
            dd("not done");
            // $controller_name = 'QuizcategoriesController';
            // $function_name = 'getAllUserRankv2';
            // $error_code = '901';
            // $error_message = $e->getMessage();
            // $send_payload = json_encode($request->all());
            // $response = null;

            // $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);

            // if(empty($request->Location)){
            //     return Response::json(array(
            //         'isSuccess' => 'false',
            //         'code'      => $error_code,
            //         'data'      => null,
            //         'message'   => $error_message
            //     ), 200);
            // }
        }
    }

    // function sendMail($email,$name,$user_id,$event_name){

	// 	// dd($email);
	// 	// dd($name);
    //     $var = 1;
    //     for($var = 0; $var <= 1; $var++){
    //         die;
    //         dd(1);
    //         exit;
    //         echo $var;
    //         echo '<br>';
    //         $curl = curl_init();
    //         curl_setopt_array($curl, array(
    //             CURLOPT_URL => "http://10.246.120.18/test/mail/useremailsend.php?email=$email&name=$name",
    //             CURLOPT_RETURNTRANSFER => true,
    //             CURLOPT_ENCODING => '',
    //             CURLOPT_MAXREDIRS => 10,
    //             CURLOPT_TIMEOUT => 0,
    //             CURLOPT_FOLLOWLOCATION => true,
    //             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //             CURLOPT_CUSTOMREQUEST => 'GET',
    //         ));

    //         // dd("$curl");
    //         $response = curl_exec($curl);
    //         // dd($response);
    //         curl_close($curl);
    //         $new_response = json_decode($response, true);
    //         // dd($new_response);
    //         if($response){
    //             // dd(1);
    //             $Mailtrakings = new Mailtrakings();
    //             $Mailtrakings->user_id = $user_id;
    //             $Mailtrakings->email = $email;
    //             $Mailtrakings->status = 1;
    //             $Mailtrakings->event_name = $event_name;
    //             $Mailtrakings->save();
    //             // return true;
    //         }else{

    //             $Mailtrakings = new Mailtrakings();
    //             $Mailtrakings->user_id = $user_id;
    //             $Mailtrakings->email = $email;
    //             $Mailtrakings->status = 0;
    //             $Mailtrakings->event_name = $event_name;
    //             $Mailtrakings->save();
    //             // return false;
    //         }
    //     }

	// }

    public function useremailallsend(Request $request){

        try{

            dd("useremailallsend");


            // $query = "SELECT id,IFNULL(name, 'Fitindia User') as name,email FROM `users` where id in (SELECT DISTINCT(user_id) FROM `devicedetails`) and id NOT IN (SELECT user_id FROM `mail_trakings`) and email != 'undefined' limit 10000;";
            $query = "SELECT id,IFNULL(name, 'Fitindia User') as name,email FROM `users` where email != 'undefined' limit 1;";

            $data = DB::select(DB::raw($query));
            // dd($data);
            foreach($data as $key => $value){
                // dd($value);
                $user_id = $value->id;
                $name = $value->name;
                $email = $value->email;
                $event_name = "Fit India Cycling Drive";
                $this->sendMailall($email,$name,$user_id,$event_name);
                echo $value->email;
            }

        } catch(Exception $e) {
            dd("not done");
            // $controller_name = 'QuizcategoriesController';
            // $function_name = 'getAllUserRankv2';
            // $error_code = '901';
            // $error_message = $e->getMessage();
            // $send_payload = json_encode($request->all());
            // $response = null;

            // $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);

            // if(empty($request->Location)){
            //     return Response::json(array(
            //         'isSuccess' => 'false',
            //         'code'      => $error_code,
            //         'data'      => null,
            //         'message'   => $error_message
            //     ), 200);
            // }
        }
    }

    public function useremailalltwosend(Request $request){

        try{

            dd("useremailalltwosend");


            // $query = "SELECT id,IFNULL(name, 'Fitindia User') as name,email FROM `users` where id in (SELECT DISTINCT(user_id) FROM `devicedetails`) and id NOT IN (SELECT user_id FROM `mail_trakings`) and email != 'undefined' limit 10000;";
            // $query = "SELECT id,IFNULL(name, 'Fitindia User') as name,email FROM `users` where email != 'undefined' order by id desc limit 10000,10000;";
            $query = "SELECT id,name,email FROM `users` where phone in (9818943170);";

            $data = DB::select(DB::raw($query));
            // dd($data);
            foreach($data as $key => $value){
                // dd($value);
                $user_id = $value->id;
                $name = $value->name;
                $email = $value->email;
                $event_name = "Fit India Cycling Drive";
                $this->sendMailall($email,$name,$user_id,$event_name);
                echo $value->email;
            }

        } catch(Exception $e) {
            dd("not done");
            // $controller_name = 'QuizcategoriesController';
            // $function_name = 'getAllUserRankv2';
            // $error_code = '901';
            // $error_message = $e->getMessage();
            // $send_payload = json_encode($request->all());
            // $response = null;

            // $result = (new CommonController)->error_log($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);

            // if(empty($request->Location)){
            //     return Response::json(array(
            //         'isSuccess' => 'false',
            //         'code'      => $error_code,
            //         'data'      => null,
            //         'message'   => $error_message
            //     ), 200);
            // }
        }
    }

    function sendMailall($email,$name,$user_id,$event_name){

		// dd($email);
		// return dd($name);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://10.246.120.18/test/mail/forgetuseremailsend.php?email=$email&name=$name",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        // dd("$curl");
        $response = curl_exec($curl);
        // dd($response);
        curl_close($curl);
        $new_response = json_decode($response, true);
        // dd($new_response);
        if($response){
            // dd(1);
            $Mailtrakings = new Mailtrakings();
            $Mailtrakings->user_id = $user_id;
            $Mailtrakings->email = $email;
            $Mailtrakings->status = 1;
            $Mailtrakings->event_name = $event_name;
            $Mailtrakings->save();
            // return true;
        }else{

            $Mailtrakings = new Mailtrakings();
            $Mailtrakings->user_id = $user_id;
            $Mailtrakings->email = $email;
            $Mailtrakings->status = 0;
            $Mailtrakings->event_name = $event_name;
            $Mailtrakings->save();
            // return false;
        }

	}

    function sendMailsingle($email,$name,$user_id,$event_name){

        $curl = curl_init();
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => "http://10.246.120.18/test/mail/useremailsend.php?email=$email&name=$name",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'GET',
        // ));
        // return dd($user_id);
        // return dd('http://10.246.120.18/test/mail/useremailsend.php?email='.$email);
        // return dd($name);
        // $email = trim($email);
        // $name = trim($name);
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://10.246.120.18/test/mail/useremailsend.php?email='.$email,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30, // Recommended: not 0 (infinite)
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        // dd("$curl");
        $response = curl_exec($curl);
        // dd($response);
        // curl_close($curl);
        $new_response = json_decode($response, true);
        // dd($new_response);
        if($response){
            // dd(1);
            $Mailtrakings = new Mailtrakings();
            $Mailtrakings->user_id = $user_id;
            $Mailtrakings->email = $email;
            $Mailtrakings->status = 1;
            $Mailtrakings->event_name = $event_name;
            $Mailtrakings->save();
            // return true;
        }else{

            $Mailtrakings = new Mailtrakings();
            $Mailtrakings->user_id = $user_id;
            $Mailtrakings->email = $email;
            $Mailtrakings->status = 0;
            $Mailtrakings->event_name = $event_name;
            $Mailtrakings->save();
            // return false;
        }
	}

    public function useremail(){
        // dd("useremail");
        // $query = "SELECT id,IFNULL(name, 'Fitindia User') as name,email FROM `users` where email != 'undefined' order by id desc limit 1;";
        // $query = "select users.id,IFNULL(users.name, 'Fitindia User') as name,users.email from users left join usermetas on users.id = usermetas.user_id where users.rolewise like '%cyclothon-2024%';";
        // $query = 'SELECT id,IFNULL(name, "Fitindia User") as name,email FROM `users` where email  in ("ghondano.2@gmail.com")';
        $query = 'SELECT id,IFNULL(name, "Fitindia User") as name,email FROM `users` where email  in ("ghondano.2@gmail.com",
                            "ankit.katiyar@netprophetsglobal.com",
                            "dhiraj.tiwari@netprophetsglobal.com",
                            "kvmaithondam2018@gmail.com",
                            "mcmdavps@gmail.com",
                            "gurukul.majra@gmail.com",
                            "PRINCIPALPCVN@GMAIL.COM",
                            "bps.baroda@gmail.com",
                            "info@mmpublicschool.com",
                            "milan.bhatt@pdpu.ac.in",
                            "RAJEEVVERMA303@GMAIL.COM",
                            "avsdilipkumar@gmail.com",
                            "hma1987@gmail.com",
                            "apsyolcantt@gmail.com",
                            "skischoolcbse@gmail.com",
                            "spetercsfbd@gmail.com",
                            "school.doonpublic@gmail.com",
                            "yashasvi.sucess@gmail.com",
                            "davprincipal_anp@yahoo.in",
                            "vikasbharati@yahoo.co.in",
                            "dsbmalg@gmail.com",
                            "vijaysktechindia@gmail.com",
                            "heritagepschool@gmail.com",
                            "allianceinternationalskool@gmail.com",
                            "MATHURMVMFATEHPUR@GMAIL.COM",
                            "bophss.school@gmail.com",
                            "jkpublicschool@gmail.com",
                            "davkatpp@gmail.com",
                            "jsspsmandya@gmail.com",
                            "gpsvednagar@gmail.com",
                            "mumbaicityyoga@gmail.com",
                            "gen.secretaryrsfi@gmail.com",
                            "rnaseer121@gmail.com",
                            "zahidbashir085@gmail.com",
                            "bhatfirdoos42@gmail.com",
                            "mirgowher8493@gmail.com",
                            "shtarkhan@gmail.com",
                            "gk@krmangalam.com",
                            "70365@cbseshiksha.in",
                            "devrupesh@gmail.com",
                            "dpsdmj@rediffmail.com",
                            "dipusikarwar7@gmail.com",
                            "lakshmisurubhotla@gmail.com",
                            "muqeemmanzoor92@gmail.com",
                            "ajazwani2529@gmail.com",
                            "priyadarshanischool2015@gmail.com",
                            "Shahabid613@gmail.com",
                            "abniit.2008@gmail.com",
                            "kridfit@gmail.com",
                            "SMGA_CHUNAR@YAHOO.COM",
                            "hajara.banani@gmail.com",
                            "meenudhuraiya@gmail.com",
                            "1413006ZONE13@GMAIL.COM",
                            "asemilkpur@gmail.com",
                            "valavalasanthi9@gmail.com",
                            "harshitsharma5755@gmail.com",
                            "smart.mind.school1@gmail.com",
                            "khpsbatakurki7@gmail.com",
                            "amar.nadgeri@gmail.com",
                            "monuyadav@gmail.com",
                            "dav.noamundi@gmail.com",
                            "srsaimspublicschool@gmail.com",
                            "happyoga.in3@gmail.com",
                            "vasurhythm.dps@gmail.com",
                            "belagaviendurancesports@gmail.com",
                            "stnicholasgarhbeta@gmail.com",
                            "office@rsvmlearningparadise.com",
                            "apsdora@gmail.com",
                            "gonmeipanti@gmail.com",
                            "honeyn9545@gmail.com",
                            "principal@davmodelasansol.com",
                            "mrutun4@gmail.com",
                            "physiops4707@gmail.com",
                            "radhika.gohelrg@gmail.com",
                            "sanjeevkatameedi@gmail.com",
                            "ms250082@gmail.com",
                            "perikeravindra1971@gmail.com",
                            "vinitsri9580@gmail.com",
                            "dsimmi124@gmail.com",
                            "dinesh.bist@nd.balbharati.org",
                            "principal_gsps@outlook.in",
                            "directorsportscouncilfmu@gmail.com",
                            "rajpootnitin1864@gmail.com",
                            "wanilateef129110@gmail.com",
                            "akashraj048@gmail.com",
                            "cv.betacollegeofeducation@gmail.com",
                            "nsrstwo@yopmail.com",
                            "pmpalakkad.keralapost@gmail.com",
                            "fitindia@yopmail.com",
                            "searchforshankar@gmail.com",
                            "adhimail94@gmail.com",
                            "archanacibi@gmail.com",
                            "perumalbilla9@gmail.com",
                            "alaguhky1998@gmail.com",
                            "gkanthi1987@gmail.com",
                            "nelsonmithun@gmail.com",
                            "mohanbavani@gmail.com",
                            "syedmdnihall@gmail.com",
                            "abhayjudo431@gmail.com",
                            "sportsofficerkasganj@gmail.com",
                            "ankit.katiyar12@netprophetsglobal.com",
                            "ankit.katiyar14@netprophetsglobal.com",
                            "mp4854123@gmail.com",
                            "slg_acc@yahoo.com",
                            "k41817880@gmail.com",
                            "sunitamalikchaudhary@gmail.com",
                            "dr.santha.dunna@esic.nic.in",
                            "dr.anilpal@gmail.com",
                            "anjuharsh504@gmail.com",
                            "jitenderarora600@gmail.com",
                            "simarmahendra007@gmai.lcom",
                            "kk9823314@gmail.com",
                            "gg4090851@gmail.com",
                            "dr.ravinder.kumar@esic.nic.in",
                            "vijay.vku3@gmail.com",
                            "19vivek76@gmail.com",
                            "Maxlisham0@gmail.com",
                            "moirangthemthoiba12@gmail.com",
                            "rananaitik2008@gimal.com",
                            "ekkaanmol492@gmail.com",
                            "goldysingh16422@gmail.com",
                            "sikandersharma703@gmail.com",
                            "davinderps1@gmail.com",
                            "sonychuhan.ss@gmail.com",
                            "rs4078711@gmail.com",
                            "amanrikhi786@gmail.com",
                            "rekhasick@gmail.com",
                            "ps352049@gmail.com",
                            "Singhrai6414@gmail.co",
                            "jagdeepjp701@gmail.com",
                            "sukhjindersingh16234@gmail.com",
                            "mannsharanjeet0@gmail.com",
                            "gs402267@gmail.com",
                            "amanlambi.al@gmail.com",
                            "jaitunisha5764@gmail.com",
                            "deepg7370@gmail.com",
                            "gurmeetmohal1986@gmail.com",
                            "asharanimehra@gmail.com",
                            "khansadikan33@gmail.com",
                            "paorshotm@gmail.com",
                            "harjinderkaur15241@gmail.com",
                            "pardeep.satg83@gmail.com",
                            "kaurmukesh41@gmail.com",
                            "nikkarambehar@gmail.com",
                            "palwindersingh9815391653@gmail.com",
                            "kangjaspreet0@gmail.com",
                            "kmaan003@gmail.com",
                            "skumar11011998@gmail.com",
                            "donewdelhicentral.dl@indiapost.gov.in",
                            "shivkrsharma400@gmail.com",
                            "akarunkumar167@gmail.com",
                            "pmsrtn-dl@indiapost.gov.in",
                            "pmran-dl@indiapost.gov.in",
                            "seramporeho@indiapost.gov.in",
                            "aruna.10035083@gmail.com",
                            "nishthabasak72@gmail.com",
                            "amitswami2936@gmail.com",
                            "rameshkumarpost@gmail.com",
                            "ballabgarhso.hr@indiapost.gov.in",
                            "parvinderjosan243@gmail.com",
                            "ravimanasvi345@gmail.com",
                            "sowmyashree9449@gmail.com",
                            "pehowaso@indiapost.gov.in",
                            "prakavitha07@gmail.com",
                            "ishwarsinghoooooo51@gmail.com",
                            "nvanin1990@gmail.com",
                            "pawan.saini3233@gmail.com",
                            "anilgujjar839@gmail.com",
                            "kumaranand39044@gmail.com",
                            "lakshydakshy503@gmail.com",
                            "cscguhna@gmail.com",
                            "naikgopala727@gaim.com",
                            "sashu0982@gmail.com",
                            "ramesh10310925@gmail.com",
                            "vijaykamboj3983@gmail.com",
                            "dev.hiranwal@gmail.com",
                            "rammharkairon@gmail.com",
                            "aman.dhiman1992@gmail.com",
                            "deepaksharma96402@gmail.com",
                            "sharmaraminwas119@gmail.com",
                            "armaanjagirdar@gmail.com",
                            "rajkumar003138@gmail.com",
                            "kumarsuesh094@gmail.com",
                            "dhandimanoj57@gmail.com",
                            "satpalsingh19081987@gmail.com",
                            "abhishekbramnia@gmail.com",
                            "agog400@gmail.com",
                            "manishas7082@gmail.com",
                            "jarnail1965peh@gmail.com",
                            "ip.pradeepb@gmail.com",
                            "amitdeoban3063@gmail.com",
                            "shankarsherawat112@gmail.com",
                            "jatin13052001@gmail.com",
                            "berwalanup62@gmail.com",
                            "rakeshyadavkakrala@gmail.com",
                            "ramyabv2011@gmail.com",
                            "arunpaliwap23527@gmail.com",
                            "praveenbndo@yahoo.com",
                            "rk328099@gmail.com",
                            "manojseman65021@gmail.com",
                            "shilpalochan6@gmail.com",
                            "monuyadav20121994@gmail.com",
                            "jeevanbn111@gmail.com",
                            "anandagopi.n@gmail.com",
                            "tejsinghrao8@gmail.com",
                            "bhaginderkataria@gmail.com",
                            "savitasharma19876@gmail.com",
                            "sandeepkumarsandeep981357437@gmail.com2",
                            "jakharsanjay396@gmail.com",
                            "74karamjeetsingh@gmail.com",
                            "manojkumarmagu23@gmail.com",
                            "bhajanlalbehbalpur@gmail.com",
                            "sunilkumar4224@gmail.com",
                            "bhajanlalbebhalpur@gmail.com",
                            "viswaneedamso@indiapost.gov.in",
                            "dharmegowda0143@gmail.com",
                            "monupostoffice@gmail.com",
                            "jhaavdesh3006@gmail.com",
                            "hrcdarshan@gmail.com",
                            "anilkrkhanna4@gmail.com",
                            "suprithstance16@gmail.com",
                            "savisanthu383@gmail.com",
                            "maheshgowdamahi.73@gmail.com",
                            "yashwanthgm59@gmail.com",
                            "sujayt110@gmail.com",
                            "Chandrachandrashekar789@gmail.com",
                            "shweathagatti@gmail.com",
                            "nmahadevnayak@gmail.com",
                            "kemparaju279@gmail.com",
                            "vr976899@gmail.com",
                            "santoshkumarsanthu59@gmail.com",
                            "thodupunuri.saikrishna98@gmail.com",
                            "sanjaykp327@gmail.com",
                            "rameshsogala1970@gmail.com",
                            "murthyk891@gmail.com",
                            "shivanandagowda0404@gmail.com",
                            "trajuthimmaraju00@gmail.com",
                            "varugirigowda@gmail.com",
                            "tkhky4991@gmail.mail.com",
                            "santhoshtk22@gmail.com",
                            "manojkhan3048@gmail.com",
                            "VY8878703662@GMAIL.COM",
                            "theWheelmanX@proton.me",
                            "nishant.chhodwani@decathlon.com",
                            "manavroym44@gmail.com",
                            "ysudhir0369@gmail.com",
                            "secretariat@yogasanasport.in",
                            "Drharishkumar1196@gmail.com",
                            "shyamyoga27@gmail.com",
                            "vijay.bhaskaran@decathlon.com",
                            "kumar04031997dhiraj@gmail.com",
                            "deepaksinghpundir032@gmail.com",
                            "sulkhansingh8979@gmail.com",
                            "ravi.nilam5@gmail.com",
                            "sejwalshivam6@gmail.com",
                            "gorollersports@gmail.com",
                            "saurabh.chaudhary@decathlon.com",
                            "dimitri.barury@ciifoundation.in",
                            "debayani.majumder@cii.in",
                            "kcghoshiarpur@gmail.com",
                            "aamhicyclepremi@gmail.com",
                            "anil161078@gmail.com",
                            "nan1456can@gmail.com",
                            "digvijay.s@cii.in",
                            "support@hclcyclothon.com",
                            "jaspal.79@gmail.com",
                            "ccrschennai@gmail.com",
                            "sujit.mishra@nic.in",
                            "yogaarumugam5@gmail.com",
                            "apurv_chaturvedi@oilindia.in",
                            "amrish.aggarwal@igl.co.in",
                            "s.kumaran@igl.co.in",
                            "arbind.mishra@igl.co.in",
                            "sangh.anand@igl.co.in",
                            "nahar.singh@igl.co.in",
                            "sanjay.katoch@eil.co.in",
                            "deepak.sharma232382@gmail.com",
                            "devendra.gautam@igl.co.in",
                            "anish.kundu@eil.co.in",
                            "rahul.sharma@igl.co.in",
                            "hansakapoor@bharatpetroleum.in",
                            "anurag.verma@igl.co.in",
                            "iyyappanice3@gmail.com",
                            "AMAN.TOMAR@IGL.CO.IN",
                            "gamch@goel.edu.in",
                            "mukesh.k@eil.co.in",
                            "bhupindertoor91@gmail.com",
                            "2002ayu0222@babekegroupofinstitutes.org",
                            "SANJEEBKUMAR@IREDA.IN",
                            "rajeevkumar@ireda.in",
                            "hajarilal@ireda.in",
                            "kalimchoudhary7786@gmail.com",
                            "rohitbhaumik4@gmail.com",
                            "drmanjunathgaddi@gmail.com",
                            "principalssmdcollege@gmail.com",
                            "rswain@igl.co.in",
                            "rajakdrkc474@gmail.com",
                            "moreganesh88@gmail.com",
                            "rahimuddinshaikh21@gmail.com",
                            "cppriwprpc@gmail.com",
                            "sanjeevdon2019@gmail.com",
                            "bhagyashrishinde1982@gmail.com",
                            "pawansuryawanshi21@gmail.com",
                            "pasayadan226@gmail.com",
                            "kailash.chander@esic.gov.in",
                            "sndp.das2@gmail.com",
                            "ranganpan.0003@gmail.com",
                            "dramarjyotinayak10@gmail.com",
                            "shainkyrana615@gmail.com",
                            "nishantgavai997@gmail.com",
                            "drssmaharana@gmail.com",
                            "srinibashkara15@gmail.com",
                            "pradipmondal817@gmail.com",
                            "srinibashkaran15@gmail.com",
                            "rrcallahabad@gmail.com",
                            "thesmartcommute@gmail.com",
                            "rgsahc23@gmail.com",
                            "dileep.pei@iadc.ac.in",
                            "nileshguptang25@gmail.com",
                            "jyoti.s@srisriuniversity.edu.in",
                            "alokkumar920471@gmail.com",
                            "s40811703@gmail.com",
                            "akhil@headzup.in",
                            "uditaditya39@gmail.com",
                            "sdayurvedamh@gmail.com",
                            "shamalahire1992@gmail.com",
                            "bipinpala30@gmail.com",
                            "2023ugec092@nitjsr.ac.in",
                            "niteshpatil59595959@gmail.com",
                            "omprakash89992@gmail.com",
                            "kunal16222@gnindia.dronacharya.info",
                            "rkrelish@gmail.com",
                            "khushidubey7053@gmail.com",
                            "n3.salve@gmail.com",
                            "246301137@gkv.ac.in",
                            "yashkumarbairwabairwa@gmail.com",
                            "246301105@gkv.ac.in",
                            "246301155@gkv.ac.in",
                            "ppruthvirajd@gmail.com",
                            "steekam996@gmail.com",
                            "ravirajv679@gmail.com",
                            "246301110@gkv.ac.in",
                            "dharmendra.balyan@gkv.ac.in",
                            "poswallaxmi@gmail.com",
                            "ankitfarroda0002@gmail.com",
                            "poonamrathore9256@gmail.com",
                            "vishwaradyachikkamath384@gmail.com",
                            "mallikpralaya@gmail.com",
                            "monikabtp@gmail.com",
                            "anisha.yadav3003@gmail.com",
                            "kammarpradnya@gmail.com",
                            "246301119@gkv.ac.in",
                            "fouzdarritik4142@gmail.com",
                            "maahendragora@gmail.com",
                            "sunil12sawant@gmail.com",
                            "jayarajkud@gmail.com",
                            "shivanandmaangadi@gmail.com",
                            "palsaniyaanju16@gmail.com",
                            "246301131@gkv.ac.in",
                            "246320043@gkv.ac.in",
                            "balyan1973@gmail.com",
                            "santoshmullur2003@gmail.com",
                            "akashgudagenatti@gmail.com",
                            "mohitmandal717@gmail.com",
                            "lathastanksali@gmail.com",
                            "naveenvannur8363@gmail.com",
                            "harshitasharma22008@gmail.com",
                            "jyotikumari983045@gmail.com",
                            "kumaris0018@gmail.com",
                            "shrutivinay2002@gmail.com",
                            "prasannatumbagi3@gmail.com",
                            "darshanhiremath198@gmail.com",
                            "Anubhavmishraaaaa9@gmail.com",
                            "Abhisheklakhani2005@gmail.com",
                            "charusinghaljn@gmail.com",
                            "usasaini1186@gmail.com",
                            "mayur838482@gmail.com",
                            "venkatesh.cctvoperator@iadc.ac.in",
                            "246301210@gkv.ac.in",
                            "arnabkr516@gmail.com",
                            "niteshm0710@gmail.com",
                            "eylmbaithakfoundation@gmail.com",
                            "sushmamahesh12023@gmail.com",
                            "kirthibendigeri36@gmail.com",
                            "danumenasinkai13@gmail.com",
                            "pavitramysurgi@gmail.com",
                            "jogendrajogi947@gmail.com",
                            "devipushpa74094@gmail.com",
                            "kumarkishan023@gmail.com",
                            "fatimabano9009@gmail.com",
                            "rajashree@curaj.ac.in",
                            "technicalg273@gmail.com",
                            "pawararyan46@gmail.com",
                            "krishanmeenabilod@gmail.com",
                            "kr8309038@gmail.com",
                            "pavitchoudhary160@gmail.com",
                            "madhusudansinghm02@gmail.com",
                            "arpitalamani45@gmail.com",
                            "chesthajangid080@gmail.com",
                            "mehtahimani17@gmail.com",
                            "udarammalodia@gmail.com",
                            "khushitanwar9785@gmail.com",
                            "246301012@gkv.ac.in",
                            "ayushkumr805@gmail.com",
                            "vk181909@gmail.com",
                            "gunjan331166@gamil.com",
                            "anuj.gupta@srsis.org",
                            "jrs83023@gmail.com",
                            "architasharma1007@gmail.com",
                            "Vijaykvijay12345@gmail.com",
                            "omkar27012000@gmail.com",
                            "bhimashirh132@gmail.com",
                            "chamanujjain96@gmail.com",
                            "kashish.1682@kvsrodelhi.in",
                            "leoalokofguwahatisouth@gmail.com",
                            "hanskgupta@gmail.com",
                            "ruksana9599490495@gmail.com",
                            "nizakatKhan8882146898@gmail.com",
                            "shashiparjapti0@gmail.com",
                            "Inderjeetvishard@gmail.com",
                            "co12thbnsrc-bpr@cg.gov.in",
                            "spmainpat@gmail.com",
                            "batallion14caf@yahoo.in",
                            "spgpm090@gmail.com",
                            "kpstf325@gmail.com",
                            "pramodbisht1484@gmail.com",
                            "ashokmaravi6729@gmail.com",
                            "singhramprasad211@gmail.com",
                            "co13bn.cg@nic.in",
                            "comdt.2nd.bn.sakari@gmail.com",
                            "17bncontrolkabirdham@gmail.com",
                            "abhaykumar74347@gmail.com",
                            "siddhant.sharma21@gmail.com",
                            "Manishyadav270793@gmail.com",
                            "cctnskorba@gmail.com",
                            "chhabilalyadav216@gmail.com",
                            "kamalsharma.401.ks@gmail.com",
                            "spptsrajnandgaon@gmail.com",
                            "shivanandsingh22011988@gmail.com",
                            "dinesh.force001@gmail.com",
                            "divijmalekar82@xn--81b0bm8cub.com",
                            "laldeshmukh1993@gmail.com",
                            "jeetvd009@gmail.com",
                            "Prakashssahu257@mail.com",
                            "kartikeshwarjangde@gmail.com",
                            "pinkirajputt701@gmail.com",
                            "dilharansahu1998@gmail.com",
                            "jdk4836@gmail.com",
                            "revendrasahu2213@gmail.com",
                            "manisha.satish.rawate@gmail.com",
                            "channdresh1992sahuji@gmail.com",
                            "vajidrazaa@gmail.com",
                            "tamrajdhawajchaturvedi@gmail.com",
                            "ansh.thakur1987@gmail.com",
                            "khuleshwargayakwad135@gmail.com",
                            "sahu65059@gmail.com",
                            "bhaiyash903@gmail.com",
                            "paliwalbrajpalsingh3@gmail.com",
                            "kalyanray9@gmail.com",
                            "premmadhu94@gmail.com",
                            "sahudileshwar001@gmail.com",
                            "mahi.dnt@gmail.com",
                            "manishkunwar198@gmail.com",
                            "tejkumargavelgovt@gmail.com",
                            "raiumeshkumar91@gmail.com",
                            "ss7987190181@gmail.com",
                            "navdhaji6382@mail.com",
                            "anitanetama087@gmail.com",
                            "co7thbncafbhilai@gmail.com",
                            "cofifteenbnbjr@gmail.com",
                            "mukeshbharati1992@gmail.com",
                            "vikaspsingh1980@gmail.com",
                            "dibrugarhdistrictjudoassoc1989@gmail.com",
                            "chhabratushar541@gmail.com",
                            "nexifyy13@gmail.com",
                            "Hiteshahlawat2512@gmail.com",
                            "editorcpn@gmail.com",
                            "parasharsweta1455@gmail.com",
                            "venkobaskutagamari25@gmail.com",
                            "maanveertravels@gmail.com",
                            "harshitpsoni@yahoo.com",
                            "balaji29563@gmail.com",
                            "neeshantpublicasia@gmail.com",
                            "prajakalam@gmail.com",
                            "raj1969@gmail.com",
                            "santudreambig@gmail.com",
                            "vivekdwivedi850@gmail.com",
                            "naseer216681@gmail.com",
                            "nahmad7@jmi.ac.in",
                            "bhssbpoonch@gmail.com",
                            "waninelofar73@gmail.com",
                            "veersaheedanusuyaprasadsamiti@gmail.com",
                            "anshulovef@gmail.com",
                            "haesbisra@gmail.com",
                            "Nccgschoolvijaynagar@gmail.com",
                            "registrar@chitkarauniversity.edu.in",
                            "info@sacredheartcollege.org",
                            "65634@cbseshiksha.in",
                            "aderf.reg@gmail.com",
                            "info.mcpat@gmail.com",
                            "mandyajsspa@gmail.com",
                            "apspathankot@awesindia.edu.in",
                            "principal2016stmarys@gmail.com",
                            "bauspandaveswar@gmail.com",
                            "dsw@kalingauniversity.ac.in",
                            "contact@svpsjpr.com",
                            "45274@cbseshiksha.in",
                            "principal@masinstitutions.org",
                            "dr.nareshkumari@gmail.com",
                            "70405@CBSESHIKSHA.IN",
                            "pushpendra7080@gmail.com",
                            "n7289934748@gmail.com",
                            "arvind@banasthali.in",
                            "aaravchoudhary.delhi@gmail.com",
                            "bvb.newchandigarh@gmail.com",
                            "info@davmtps.com",
                            "sports@bbpsmv.com",
                            "cbse.gvei@gveisrinagar.com",
                            "harrisarora@gmail.com",
                            "piyushsharma90902@gmail.com",
                            "kaviprem12@gmail.com",
                            "maudgillgeet@gmail.com",
                            "drpkananda@gmail.com",
                            "khems08479@rediffmail.com",
                            "sports@unishivaji.ac.in",
                            "geetrakeshd10@gmail.com",
                            "bharti.chaudhary91@gmail.com",
                            "rkumar191982@gmail.com",
                            "2017000263@sdpsmzn.com",
                            "raj.maurya@nfsu.ac.in",
                            "nidhiaggarwal18290@gmail.com",
                            "lakshmidabral1278@gmail.com",
                            "rohitronny79@gmail.com",
                            "kumarpandeyvipin33@gmail.com",
                            "thisisabhinavsharma09@gmail.com",
                            "rkyadav12391@gmail.com",
                            "nowsheenaashraf78897@gmqil.com",
                            "vinayak87654@gmail.com",
                            "akhan3@jmi.ac.in",
                            "chandtarsem260@gmail.com",
                            "dasmonideepa1@gmail.com",
                            "priyanka.priyankakumari01051993@gmail.com",
                            "habeelhilal123@gmail.com",
                            "habeelhilal123@gmail.com",
                            "malikabasspet@gmail.com",
                            "tasleema808@gamil.com",
                            "gjumanish@gmail.com",
                            "ashishsharma112746@gmail.com",
                            "fayazyetoo12@gmail.com",
                            "ngfsalaknanda.school.info@gmail.com",
                            "deepriya084@gmail.com",
                            "aman9mittal@gmail.com",
                            "ksarnav@gmail.com",
                            "RINKU.KUMAR367@GMAIL.COM",
                            "hussainidudekula7685@gmail.com",
                            "hsmazharulhaq1934@gmail.com",
                            "gfashion06@gmail.com",
                            "ngfsalaknada.school.info@gmail.com",
                            "cyedzuhaib132@gmail.com",
                            "ashishsharma112746@gamil.com",
                            "rizwanaakausar@gmail.com",
                            "drgcsnegi@gmail.com",
                            "tseringwangail28@gmail.com",
                            "directorsports@gku.ac.in",
                            "ericaamrita@gmail.com",
                            "syashvardhan82@gmail.com",
                            "lokesh.choudhary@vgu.ac.in",
                            "dikshabhargava9@gmail.com",
                            "gaurav.gk777@gmail.com",
                            "asha.sharma0056@gmail.com",
                            "info@shardavidyalaya.edu.in",
                            "kksahoo980@gmail.com",
                            "tusharmandal200m@gmail.com",
                            "sjsmrj@yahoo.com",
                            "aijazaijaz456@gmail.com",
                            "sehajpreetsingh80335@gmail.com",
                            "shahsajjad395@gmail.com",
                            "zpeoquilmuqam@gmail.com",
                            "madhubhau93@gmail.com",
                            "perikeravindra@gmail.com",
                            "zahoorkb986@gmail.com",
                            "pawan.physicaleducation@tmu.ac.in",
                            "kalrala@gmail.com",
                            "lakshbhardwaz@gmail.com",
                            "gurmeetsinghshendey@gmail.com",
                            "kalachehal718@gmail.com",
                            "swadhinmaharana212@gmail.com",
                            "aankur.tiwari001@gmail.com",
                            "vandanabhadoriya09@gmail.com",
                            "mishrapravesh2011@gmail.com",
                            "manormapandey970@gmail.com",
                            "mohitgoyal292@gmail.com",
                            "seemasharmx@gmail.com",
                            "deancaecbe@tnau.ac.in",
                            "ramangrewal2627@gmail.com",
                            "OIPS.PALWAL@GMAIL.COM",
                            "gps.dnn@gmail.com",
                            "apsblb79@gmail.com",
                            "anjugoyal1407@gmail.com",
                            "readsws@gmail.com",
                            "pradeesh@ssvminstitutions.ac.in",
                            "19150@cbseshikha.in",
                            "princiafbgd@rediffmail.com",
                            "clcsportssociety@gmail.com",
                            "mjf54414@gmail.com",
                            "poonamkushwaha12345@gmail.com",
                            "kaanikakhuraana@gmail.com",
                            "tanupite07@gmail.com",
                            "ekamnootpannu10@gmail.com",
                            "u868179@gmail.com",
                            "singhsingeeta122@gmail.com",
                            "gargmonu027@gmail.com",
                            "triptishah@gmail.com",
                            "baggasingh45@gmail.com",
                            "menarana109@gamil.cpm",
                            "vashistshivani257@gmail.com",
                            "durjayalkumar@gmail.com",
                            "paridadk2@gmail.com",
                            "dean.edld@rru.ac.in",
                            "sashmitaugc@gmail.com",
                            "nabin.jhili2016@gmail.com",
                            "Principal.cmsb@gmail.com",
                            "head_sports@siu.edu.in",
                            "NMNJAINN@GMAIL.COM",
                            "mgmmodelschools@gmail.com",
                            "Tejshot@gmail.com",
                            "eknoorkour2629@gmail.com",
                            "vs0158004@gmail.com",
                            "71043@CBSESHIKSHA.IN",
                            "71226@CBSESHIKSHA.IN",
                            "24bpes017@student.rru.ac.in",
                            "vidyamandirteachers@gmail.com",
                            "alpesh.parmar@rru.ac.in",
                            "aacc4.bafb@rru.ac.in",
                            "ps9043393@gmail.com",
                            "ashwatio.c010601@gov.in",
                            "mridanshusg.c010901@gov.in",
                            "pandusaras.1@gov.in",
                            "rj.g069601@gov.in",
                            "naik.sri@gov.in",
                            "gopaldhabhai17@gmail.com",
                            "shubhamsurendra1971@gmail.com",
                            "satishbn.c098901@gov.in",
                            "anilk.g161601@gov.in",
                            "lodhishalini6@gmail.com",
                            "maganthakur00@gmail.com",
                            "drsurajanutiyal93@gmail.com",
                            "drashtiharsoda06@gmail.com",
                            "24basm016@student.rru.ac.in",
                            "m.satyaprem1966@gmail.com",
                            "shivendratacbic@gmail.com",
                            "mundhe.pravin@rediffmail.com",
                            "rinathrajendran@gmail.com",
                            "vinesh.chavda123@gmail.com",
                            "gopalmajhi2510@gov.in",
                            "shub2004c@gmail.com",
                            "rajkumarirs@gmail.com",
                            "matee_india@yahoo.com",
                            "pradip.irs@gmail.com",
                            "dvk.g4d9301@gov.in",
                            "architapatel2005@gmail.com",
                            "sachinpatel826930@gmail.com",
                            "liensingson@gmail.com",
                            "chandansonie@gmail.com",
                            "naushada.g079501@gov.in",
                            "raviknt519@gmail.com",
                            "noklentemsmj.g191601@gov.in",
                            "amoristamitkumar555@gmail.com",
                            "greykenny999@gmail.com",
                            "pankajkr3852@gmail.com",
                            "min.tonsing@gov.in",
                            "cgangmei401@gmail.com",
                            "lalaram0107@gmail.com",
                            "kamalakshay@gmail.com",
                            "mayank.koshariya007@gmail.com",
                            "krishanrajmishra91@gmail.com",
                            "shindepravin842@gmail.com",
                            "1104153nssne1@gmail.com",
                            "Yuvysingh302@gmail.com",
                            "vsvengad@gmail.com",
                            "arpitsatsangi2000@gmail.com",
                            "neeteshchapra2023@gmail.com",
                            "pranavchaturvedi0601@gmail.com",
                            "rajeshcj2024@gmail.com",
                            "advamitkumar99@gmail.com",
                            "amitumar99@gmail.com",
                            "sports@unigoa.ac.in",
                            "saivijay.ceo@gmail.com",
                            "anweshg.g4a1801@gov.in",
                            "upsrlmbmmskn@gmail.com",
                            "johnson19600@gmail.com",
                            "sanchitcenex@gmail.com",
                            "hrishikesh2192@gmail.com",
                            "shaliniksc@gmail.com",
                            "manath06@yahoo.com",
                            "sriniinspector@gmail.com",
                            "jasaramleelsar1032@gmail.com",
                            "rair33833@gmail.com",
                            "ravikant.chouhan98@gmail.com",
                            "dineshk.c106601@gov.in",
                            "chocolate2023cherrya@gmail.com",
                            "akm14171eic2014@gmail.com",
                            "jtjerryrodrigo@gmail.com",
                            "VYDTONS19@GMAIL.COM",
                            "venkateswaa.d078601@gov.in",
                            "varghese2001@gmail.com",
                            "jivendra.87@gov.in",
                            "singhak9134@gmail.com",
                            "brajesh.muz2050@gmail.com",
                            "ambe.m.irs@gov.in",
                            "mitra291813@gmail.com",
                            "dineshkg.c019201@gov.in",
                            "principal@esasc.in",
                            "samira.g119401@gov.in",
                            "rajat945428@gmail.com",
                            "kulvant.g011401@gov.in",
                            "chaurasiyashivam656@gmail.com",
                            "asakhilesh6@gmail.com",
                            "shubhajeet.d2024@gov.in",
                            "anuj.k.singh@gov.in",
                            "cgst-gurugram@gov.in",
                            "anand@eximmanagementservices.com",
                            "asawant@exoworld.in",
                            "amitrathee600@yahoo.in",
                            "mksharma2732002@gmail.com",
                            "biharij800@gmail.com",
                            "krishnakumar.kkv@gmail.com",
                            "pratyushak47@gmail.com",
                            "sstomar.90@gmail.com",
                            "arvindks.g150501@gov.in",
                            "amja19976@gmail.com",
                            "daman@shemford.com",
                            "saurabhchauhan.ins@gmail.com",
                            "pankaj.gautampkj@gmail.com",
                            "badalga.g071201@gov.in",
                            "kitsakash@gmail.com",
                            "psg711971@gmail.com",
                            "ashusingh8953849622@gmail.com",
                            "m.anuja24@gov.in",
                            "nishu.tyagi90@gov.in",
                            "sa9165237@gmail.com",
                            "khaganderks.g169001@gov.in",
                            "adityayadav.irs@gov.in",
                            "donamariatom2000@gmail.com",
                            "nitin_ambare@rediffmail.com",
                            "enggmrsks@gmail.com",
                            "sggurung@gmail.com",
                            "prasadgavale1@gmail.com",
                            "gdjainandco@gmail.com",
                            "rahulkumar11224@gmail.com",
                            "maheshk.g109201@gov.in",
                            "theraj.job@gmail.com",
                            "naughtylucky96@gmail.com",
                            "rajeshm.g039101@gov.in",
                            "yogesh.unde@gov.in",
                            "rajendrakumarmeena@orientaluniversity.in",
                            "bhaskar.kuldeep@gmail.com",
                            "pruchi051@gmail.com",
                            "hiteshvp.g019301@gov.in",
                            "zimbamadan@gmail.com",
                            "prakashamit729@gmail.com",
                            "chaitanyakt.g019301@gov.in",
                            "commr-gstfbd@gov.in",
                            "bmnsncr@gmail.com",
                            "nareshgonkar98@gmail.com",
                            "nareshgaonkar98@gmail.com",
                            "cbec.rahuul@gmail.com",
                            "khirwar008@gmail.com",
                            "coonaalji@gmail.com",
                            "nageshkumar1783@gmail.com",
                            "hemantka.g109401@gov.in",
                            "ramny.g101601@gov.in",
                            "pushpakhalkho53@gmail.com",
                            "ramnareshmeena9694@gmail.com",
                            "rajkumarsahanilkr@gmail.com",
                            "cexaedibrugarh@gmail.com",
                            "vk111976@gmail.com",
                            "pankajg.g141401@gov.in",
                            "noproblemhry@gmail.com",
                            "swayam74@yahoo.com",
                            "sandeep.cgst1@gmail.com",
                            "abhialex87097@gmail.com",
                            "mishra.rajnikant@gov.in",
                            "kota.anusha.11421@gmail.com",
                            "ind.akash.patle@lam-world.com",
                            "rahulmeena716@gmail.com",
                            "budlipriya@gmail.com",
                            "anmolp.0108@gov.in",
                            "farukhk.g191801@gov.in",
                            "rajendragundale1@gmail.com",
                            "jibu@flomicgroup.com") order by id desc limit 1000;';
        $data = DB::select(DB::raw($query));
            // dd($data);
            foreach($data as $key => $value){
                // dd($value);
                $user_id = $value->id;
                $name = $value->name;
                $email = $value->email;
                $event_name = "Fit India Cycling Drive";
                // $this->sendMailsingle($email,$name,$user_id,$event_name);
                // dd($this->sendMailsingle($email,$name,$user_id,$event_name));
                echo $value->email;
                echo '<br/>';
            }
    }

}
