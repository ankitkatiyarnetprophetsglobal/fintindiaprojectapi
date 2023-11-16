<?php

namespace App\Http\Controllers\v2\Api;

use App\Models;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response;
use App\Http\Controllers\v2\CommonController;
use App\Models\Post;
use App\Models\PostslLike;
use App\Models\PostCat;
use App\Models\PostsComments;
use Exception;
use JWTAuth;
use DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response

     */
	public function __construct() {

        $this->middleware('auth:api', ['except' => ['listshow','showbyid','likebyid','postscategory','more_comments_pagewise']]);
    
    } 
	public function listshow(Request $request){

        // dd($request->all());
        $user = auth('api')->user();
        try{ 
            if($user){
                
                $PostCat_data = PostCat::select('id','name','image')->where('status', '=', 1)->orderBy('name', 'ASC')->get();   
                $post_category_id = $request->post_category_id;
                $lang_slug = $request->lang_slug;
                $user_id = $request->user_id;
                
                if($post_category_id == 'all' && $lang_slug == 'all'){
                    //  dd($user_id);                   
                    $data_post = Post::with('getPostCategorylang')->with(['like' => function($q) use($user_id){
                        $q->whereUserId($user_id)->select('user_id','post_id','like_status');
                        // $q->whereLikeStatus(true);                    
                    }])
                    ->withCount(['like' => function($q) use($user_id){
                        $q->whereLikeStatus(true);                    
                    }])->where([['published', '=', 2]])
                    ->paginate(10);    

                }elseif($lang_slug == 'all'){
                    
                    $query = Post::with('getPostCategorylang')->with(['like' => function($q) use($user_id){
                        $q->whereUserId($user_id)->select('user_id','post_id','like_status');
                        // $q->whereLikeStatus(true);                    
                    }])
                    ->withCount(['like' => function($q) use($user_id){
                        $q->whereLikeStatus(true);                    
                    }])->where([['published', '=', 2]]);
                 
                    foreach(explode(',',$request->post_category_id) as $key => $val){

                        if($key == 0){
                            $query = $query->whereRaw('FIND_IN_SET(?, post_category)', [$val]);
                        }else{
                            $query = $query->orWhereRaw('FIND_IN_SET(?, post_category)', [$val]);  
                        }
                    }
                    $data_post = $query->paginate(10);

                }elseif($post_category_id == 'all'){
                    
                    $data_post = Post::with('getPostCategorylang')->with(['like' => function($q) use($user_id){
                        $q->whereUserId($user_id)->select('user_id','post_id','like_status');
                        // $q->whereLikeStatus(true);                    
                    }])
                    ->withCount(['like' => function($q) use($user_id){
                        $q->whereLikeStatus(true);                    
                    }])->where([['published', '=', 2],['lang_slug',$lang_slug]])                
                    ->paginate(10);    

                }else{
                    $query = Post::with('getPostCategorylang')
                        ->withCount(['like' => function($q){
                        $q->whereLikeStatus(true);
                    }])->where([['published', '=', 2],['lang_slug',$lang_slug]]);
                 
                    foreach(explode(',',$request->post_category_id) as $key => $val){

                        if($key == 0){
                            $query = $query->whereRaw('FIND_IN_SET(?, post_category)', [$val]);
                        }else{
                            $query = $query->orWhereRaw('FIND_IN_SET(?, post_category)', [$val]);  
                        }
                    }
                    $data_post = $query->paginate(10);                  
                
                }

                $a1=array( 'PostCat_data' => $PostCat_data);
                $a2=array("data_post" => $data_post);
                
                $data =array_merge($a1,$a2);
                
                $error_code = 200;                             
                
                if(count($data) >0){

                    $error_message = null;   
                    
                    return Response::json(array(
                        'isSuccess' => 'true',
                        'code'      => $error_code,
                        'data'      => $data,
                        'message'   => $error_message
                    ), 200);

                }else{

                    $error_message = "Data Not Found";
                    $error_code = '201';
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => "",
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
            
            $controller_name = 'PostsController';
            $function_name = 'listshow';   
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;            
            // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);3
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
    public function showbyid(Request $request){
        // dd($request->all());        
        
        try{ 
            $search_id = $request['id'];
            $user_id = $request['user_id'];
            // dd($user_id);    
            $user = auth('api')->user();
            if($user){
                
                $error_code = 200;
                $error_message = null;
                
                // $data = Post::paginate(50);
                // $data = Post::get();
                $datacount = Post::where('id', $search_id)->get();
                // dd(count($data));
                if(count($datacount) >0){

                    $data = Post::select('id','title','description','image','post_category_wise','video_post','published','created_by')->with(
                    // $data = Post::with(
                        [
                        'comments'=>function($m){
                            $m->wherecommentStatus(true)->select('id','user_id','comment','post_id','comment_status','created_by','created_at')->where("comment_status","=",1)->take(10);
                        },
                        'comments.user:id,name',
                        'like' => function($q) use($user_id){
                            // $q->with('user:id,name')->whereLikeStatus(true)->select('id','user_id','post_id','like_status');
                            $q->whereUserId($user_id)->select('user_id','post_id','like_status');
                        },
                        // 'unlike' => function($q){
                        //     $q->with('user:id,name')->whereLikeStatus(false)->select('id','user_id','post_id','like_status');
                        // },
                        'user:id,name'
                        ]
                        )->withCount(['like' => function($q){
                            $q->whereLikeStatus(true);
                        }])
                        ->withCount(['unlike' => function($q){
                            $q->whereLikeStatus(false);
                        }])
                        // ->whereLikeStatus(true)->whereUserId($user_id)->select('like_status')
                        ->where('id', $search_id)->where('status','=', 1)
                        ->where('published','=', 2)->orderBy('id', 'DESC')->first();
                   
                //    dd($data);
                   
                //     $PostslLike = PostslLike::where('post_id', $search_id)->where('like_status','=', 1)->get();
                //     $PostsComments = PostsComments::where('post_id', $search_id)->where('status','=', 1)->get();
                //     dd($PostsComments);
                    return Response::json(array(
                        'isSuccess' => 'true',
                        'code'      => $error_code,
                        'data'      => $data,
                        'message'   => $error_message
                    ), 200);                  

                }else{
                    $error_message = "Data Not Found";
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => "",
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
            
            $controller_name = 'PostsController';
            $function_name = 'listshow';   
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;            
            // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);3
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
    public function likebyid(Request $request){
        // dd($request->all());        
        
        $user = auth('api')->user();

        try{
            if($user){

                $user_id = $request['user_id'];
                $post_id = $request['post_id'];
                $like_status = $request['like_status'];
                
                if($user_id == ''){
                    
                    $error_code = '801';
                    $error_message = 'User Id';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message 
                    ), 200);
                    
                }
                
                if($post_id == ''){
                    
                    $error_code = '801';
                    $error_message = 'post Id';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message 
                    ), 200);

                }
                
                if($like_status == '' || $like_status >= 2 || $like_status <= -1){
                // if ((bool)$like_status != true || (bool)$like_status != false) {
                    
                    $error_code = '801';
                    $error_message = 'Like Status';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message 
                    ), 200);

                }
                $data  = 'Insert Success';
                $error_code = 200;
                $error_message = null;
                
                // $Userdetailsactitrak = new PostslLike();
                $Userdetailsactitrak = PostslLike::updateOrCreate(['user_id' =>  $user_id], ['post_id' => $post_id]);
                $Userdetailsactitrak->user_id = $user_id;
                $Userdetailsactitrak->post_id = $post_id;
                $Userdetailsactitrak->like_status = $like_status;                                        
                $Userdetailsactitrak->save();


                // $data = Post::paginate(50);
                // $data = Post::get();
                // $data = Post::where('id', $post_id)->get();
                // dd($data);
                return Response::json(array(
                    'isSuccess' => 'true',
                    'code'      => $error_code,
                    'data'      => $data,
                    'message'   => $error_message
                ), 200);                  
                
            }else{
            
                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'message'   =>  'Unauthorized'
                ), 401);
                
            }
            
        } catch(Exception $e) { 
            
            $controller_name = 'PostsController';
            $function_name = 'likebyid';   
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;            
            // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);3
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
    public function commentsbyid(Request $request){
        // dd($request['user_id']);        
        
        $user = auth('api')->user();

        try{ 
            
            if($user){

                $user_id = $request['user_id'];
                $post_id = $request['post_id'];
                $comment = $request['comment'];
                $status = 1;
                $created_by = $request['created_by'];
                $updated_by = $request['updated_by'];

                if($user_id == ''){
                    
                    $error_code = '801';
                    $error_message = 'user id';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message 
                    ), 200);
                    
                }
                
                if($post_id == ''){
                    
                    $error_code = '801';
                    $error_message = 'post id';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message 
                    ), 200);

                }
                
                if($comment == ''){
                    
                    $error_code = '801';
                    $error_message = 'Comment';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message 
                    ), 200);

                }
                
                if($created_by == ''){
                    
                    $error_code = '801';
                    $error_message = 'Created By';                
                    
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => null,
                        'message'   => $error_message 
                    ), 200);

                }
                
                // if($updated_by == ''){
                    
                //     $error_code = '801';
                //     $error_message = 'Update By';                
                    
                //     return Response::json(array(
                //         'isSuccess' => 'false',
                //         'code'      => $error_code,
                //         'data'      => null,
                //         'message'   => $error_message 
                //     ), 200);

                // }

                $data  = 'Insert Success';
                $error_code = 200;
                $error_message = null;
                
                $PostsComments = new PostsComments();
                $PostsComments->user_id = $user_id;
                $PostsComments->post_id = $post_id;
                $PostsComments->comment = $comment;
                $PostsComments->status = $status;                                        
                $PostsComments->created_by = $created_by;
                $PostsComments->update_by = $updated_by;
                $PostsComments->save();

                
                return Response::json(array(
                    'isSuccess' => 'true',
                    'code'      => $error_code,
                    'data'      => $data,
                    'message'   => $error_message
                ), 200);                  
                
            }else{
            
                return Response::json(array(
                    'status'    => 'error',
                    'code'      =>  801,
                    'message'   =>  'Unauthorized'
                ), 401);
                
            }
            
        } catch(Exception $e) { 
            
            $controller_name = 'PostsController';
            $function_name = 'commentsbyid';   
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;            
            // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);3
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
    public function postscategory(Request $request){

        $user = auth('api')->user();
        // dd($request->all());
        try{ 
            if($user){
                // if($request->post_category_id == 'all'){
                //     $data = Post::with('PostCat')->where('published', '=', 2)->get();                
                // }else{
                //     $data = Post::with('PostCat')->where([['post_category_id', '=', $request->post_category_id],['published', '=', 2]])->get();                
                // }
                $error_code = 200;
                $error_message = null;
                
                // $data = Post::paginate(50);
                $data = PostCat::where('status', '=', 1)->get();                
                
                if(count($data) >0){
                    return Response::json(array(
                        'isSuccess' => 'true',
                        'code'      => $error_code,
                        'data'      => $data,
                        'message'   => $error_message
                    ), 200);
                }else{
                    $error_message = "Data Not Found";
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => "",
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
            
            $controller_name = 'PostsController';
            $function_name = 'postscategory';   
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;            
            // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);3
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

    public function more_comments_pagewise(Request $request){        
        // dd($request->all());
        $user = auth('api')->user();
        try{ 
            if($user){
                
                $data = PostsComments::select('id','user_id','post_id','comment','created_at')
                ->with(['user:id,name'])->where([['comment_status', '=', 1],['post_id','=', $request->post_id]])->paginate(10);   
                // dd(count($data));
                
                $error_code = 200;                             
                
                if(count($data) >0){

                    $error_message = null;   
                    
                    return Response::json(array(
                        'isSuccess' => 'true',
                        'code'      => $error_code,
                        'data'      => $data,
                        'message'   => $error_message
                    ), 200);

                }else{

                    $error_message = "Data Not Found";
                    $error_code = '201';
                    return Response::json(array(
                        'isSuccess' => 'false',
                        'code'      => $error_code,
                        'data'      => "",
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
            
            $controller_name = 'PostsController';
            $function_name = 'more_comments_pagewise';   
            $error_code = '901';
            $error_message = $e->getMessage();
            $send_payload = json_encode($request->all());
            $response = null;            
            // $var = Helper::saverrorlogs($function_name,$controller_name,$error_code,$error_message,$send_payload,$response);3
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
