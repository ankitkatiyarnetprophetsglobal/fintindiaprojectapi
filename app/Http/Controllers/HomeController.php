<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\PostCat;
use App\Models\Post;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
	
	public function checkemail()
    {
		$email = 'consultsandeepsingh@gmail.com';
				$otp = '8989878';
        		$msg = '<!DOCTYPE HTML><html>
						<head>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
							<title>FIT INDIA Email verification OTP</title>
							<style>.yada{color:green;}</style>
						</head>

						<body>
							<p>Dear FitIndia user,</p>
							<br>
							<p>Welcome, We thank you for your registration at FitIndia mobile app.</p>
							<p>Your user id is <'.$email.'> </p>
							<p>Your email id Verification OTP code is : '.$otp.'</p>
							<p>You will use this user id given above for all activities on FitIndia mobile app. The user id cannot be changed and hence we recommend that you store this email for your future reference.</p>
							<p>Regards, <br> Fit India Mission</p>
							
						</body>
						</html>';
			
		$curlparams = array(
						'user_email' =>$email,
						'message' => $msg,
						'subject' => 'FIT INDIA Email verification OTP',						
						'html'=>$msg);

				$curl_options = array(
					CURLOPT_URL => "http://10.247.140.87/mail.php", 
					CURLOPT_POST => true,
					CURLOPT_POSTFIELDS => http_build_query($curlparams),
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_HEADER => false
				);

					$curl = curl_init();
					curl_setopt_array($curl, $curl_options);					
					$result = curl_exec($curl);
					
					var_dump($result);
					curl_close($curl);			  
		   
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function test()
    {
        $user = User::first();
        return $user->usermeta;
    }

    public function contact()
    {
        return view('contact');
    }
    public function about()
    {
        return view('about');
    }
	
	public function fidialogue()
    {
        return view('fidialogue');
    }

    public function getactive(Request $request)
    {        
        $post_category = PostCat::all();
        $post = Post::all();        
        return view('get-active', compact('post_category','post'));
    }

    public function getCategoryPosts(Request $request){

        //dd($request);die;
        if($request->ajax()){
            $cat_id = $request->category_id; 
            //dd($cat_id);           
            if(empty($cat_id)){
                $cat_name = 'children';
                $post = Post::all();
            } else { 
                $post_category = PostCat::find($cat_id);
                $cat_name = $post_category->name; 
                $post=DB::table("posts")
                           ->select("*")
                           ->whereRaw("find_in_set('".$cat_name."',post_category)")
                           ->get();
                //dd($post);
            }            
            return view('get-category-posts', compact('post','cat_name'));
        }
    }

    public function getActiveDetail($id){
        $post = Post::find($id);
        return view('get-active-details', compact('post'));
    } 

}
