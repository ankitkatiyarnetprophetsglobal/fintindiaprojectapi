<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Response, Redirect;
use App\Models\Champion;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use App\Exports\ChampExport;
use Excel;
use Illuminate\Support\Facades\Auth;

class ChampController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
   
    public function index(Request $request)
    {
		$admins = Admin::all();
		
		$admins_role = Auth::user()->role_id;
        if($request->input('search')=='search')
        {
            
            $search_txt = $request->input('s');
            $champions = Champion::select('champions.id','champions.name','champions.email','champions.contact','champions.designation','champions.state_name','champions.district_name','champions.block_name','champions.pincode','champions.facebook_profile','champions.twitter_profile','champions.instagram_profile','champions.work_profession','champions.description','champions.image','champions.status','champions.created_at','admins.email as uemail')
                ->leftJoin('admins', 'admins.id', '=', 'champions.updated_by')
                        ->where('champions.email','LIKE','%'.$search_txt.'%')
                        ->orWhere('champions.name','LIKE','%'.$search_txt.'%')
                        ->orWhere('champions.contact','LIKE','%'.$search_txt.'%')
                        ->orWhere('champions.state_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('champions.district_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('champions.block_name','LIKE','%'.$search_txt.'%')
                        ->paginate(40);
            $total_champ = Champion::select('*')
                ->leftJoin('admins', 'admins.id', '=', 'champions.updated_by')
                        ->where('champions.email','LIKE','%'.$search_txt.'%')
                        ->orWhere('champions.name','LIKE','%'.$search_txt.'%')
                        ->orWhere('champions.contact','LIKE','%'.$search_txt.'%')
                        ->orWhere('champions.state_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('champions.district_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('champions.block_name','LIKE','%'.$search_txt.'%')
                        ->count();

           $pending_champ = Champion::select("*")
                        ->where('champions.status', '0')
                        ->where(function($query) use ($search_txt){
                            $query->where('champions.email','LIKE','%'.$search_txt.'%');
                            $query->orWhere('champions.name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('champions.contact','LIKE','%'.$search_txt.'%');
                            $query->orWhere('champions.state_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('champions.district_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('champions.block_name','LIKE','%'.$search_txt.'%');
                        })->count();
                        
            $approved_champ = Champion::select("*")
                        ->where('champions.status', '1')
                        ->where(function($query) use ($search_txt){
                            $query->where('champions.email','LIKE','%'.$search_txt.'%');
                            $query->orWhere('champions.name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('champions.contact','LIKE','%'.$search_txt.'%');
                            $query->orWhere('champions.state_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('champions.district_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('champions.block_name','LIKE','%'.$search_txt.'%');
                        })->count();

            $rejected_champ = Champion::select("*")
                        ->where('champions.status', '2')
                        ->where(function($query) use ($search_txt){
                            $query->where('champions.email','LIKE','%'.$search_txt.'%');
                            $query->orWhere('champions.name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('champions.contact','LIKE','%'.$search_txt.'%');
                            $query->orWhere('champions.state_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('champions.district_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('champions.block_name','LIKE','%'.$search_txt.'%');
                        })->count();
        }
        else
        {
            $champions = Champion::select('champions.id','champions.name','champions.email','champions.contact','champions.designation','champions.state_name','champions.district_name','champions.block_name','champions.pincode','champions.facebook_profile','champions.twitter_profile','champions.instagram_profile','champions.work_profession','champions.description','champions.image','champions.status','champions.created_at','admins.email as uemail')
                ->leftJoin('admins', 'admins.id', '=', 'champions.updated_by')
                ->orderBy('champions.id', 'DESC')
                ->paginate(40);
            $total_champ = Champion::all()->count();
            $pending_champ = Champion::where('status','0')->count();
            $approved_champ = Champion::where('status','1')->count();
            $rejected_champ = Champion::where('status','2')->count();
        }
        return view('admin.champion.index',compact('champions','total_champ','pending_champ','approved_champ','rejected_champ'));
    }

    
   
    public function exportChamp()
    {
       if(request()->has('s'))
        {
           
        return Excel::download(new ChampExport,'championlist.xlsx');
        }
      else
        {
        return Excel::download(new ChampExport,'championlist.xlsx');
        }
    }
    public function champStatus(Request $request)
    {
        $auth_user = Auth::user();
        $response = array();
        $id = $request->amb_id;
        $status = $request->status;
        $ambassador = Champion::findOrFail($id);
        $ambassador->status = $status;
        $ambassador->updated_by = $auth_user->id;
        if($ambassador->save()){
            $amb_info = Champion::find($id);
            if($amb_info->status=='1'){
                if($amb_info->user_checker=='0'){
                    $pass = "Use your old password";
                }else{
                    $pass = "Champion@123";
                }
                $response = array('status'=>1,'msg'=>'Approved','pass'=>$pass);
                /*$ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,"http://10.247.140.87/mail_amb_champ.php");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,"user_email=$email&message=success&name=$names&type=Champion&password=$pass");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close ($ch);*/    
            }
            elseif($amb_info->status=='2'){
                $response = array('status'=>2,'msg'=>'Rejected');
               /* $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,"http://10.247.140.87/mail_amb_champ.php");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,"user_email=$email&message=failed&name=$names&type=Champion&password=none");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close ($ch);*/
            }
            else{
                $response = array('status'=>0,'msg'=>'Pending');
            }
        }
        else{
            $response = array('status'=>0,'msg'=>'failed');
        }
        echo json_encode($response);
        die;

    }
}
