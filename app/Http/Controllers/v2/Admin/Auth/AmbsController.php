<?php

namespace App\Http\Controllers\v2\admin\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Response, Redirect;
use App\Models\Ambassador;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use Illuminate\Support\Facades\DB;
use App\Exports\AmbsExport;
use Excel;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\Admin;
use App\Models\GramPanchayat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AmbsController extends Controller
{
    
    public function index(Request $request)
    {
		$admins = Admin::all();
		
		$admins_role = Auth::user()->role_id;
        if($request->input('search')=='search')
        {
            
            $search_txt = $request->input('s');
            $ambassadors = Ambassador::select('ambassadors.id','ambassadors.name','ambassadors.email','ambassadors.contact','ambassadors.designation','ambassadors.state_name','ambassadors.district_name','ambassadors.block_name','ambassadors.pincode','ambassadors.facebook_profile','ambassadors.twitter_profile','ambassadors.instagram_profile','ambassadors.work_profession','ambassadors.description','ambassadors.image','ambassadors.status','ambassadors.created_at','admins.email as uemail')
                ->leftJoin('admins', 'admins.id', '=', 'ambassadors.updated_by')
                        ->where('ambassadors.email','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.name','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.contact','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.state_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.district_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.block_name','LIKE','%'.$search_txt.'%')
                        ->paginate(40);
             $total_amb = Ambassador::select('*')
                ->leftJoin('admins', 'admins.id', '=', 'ambassadors.updated_by')
                        ->where('ambassadors.email','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.name','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.contact','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.state_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.district_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.block_name','LIKE','%'.$search_txt.'%')
                        ->count();

             $pending_amb = Ambassador::select("*")
                        ->where('ambassadors.status', '0')
                        ->where(function($query) use ($search_txt){
                            $query->where('ambassadors.email','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.contact','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.state_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.district_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.block_name','LIKE','%'.$search_txt.'%');
                        })->count();
                        
            $approved_amb = Ambassador::select("*")
                        ->where('ambassadors.status', '1')
                        ->where(function($query) use ($search_txt){
                            $query->where('ambassadors.email','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.contact','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.state_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.district_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.block_name','LIKE','%'.$search_txt.'%');
                        })->count();

            $rejected_amb = Ambassador::select("*")
                        ->where('ambassadors.status', '2')
                        ->where(function($query) use ($search_txt){
                            $query->where('ambassadors.email','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.contact','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.state_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.district_name','LIKE','%'.$search_txt.'%');
                            $query->orWhere('ambassadors.block_name','LIKE','%'.$search_txt.'%');
                        })->count();
        }
        else
        {
           $ambassadors = Ambassador::select('ambassadors.id','ambassadors.name','ambassadors.email','ambassadors.contact','ambassadors.designation','ambassadors.state_name','ambassadors.district_name','ambassadors.block_name','ambassadors.pincode','ambassadors.facebook_profile','ambassadors.twitter_profile','ambassadors.instagram_profile','ambassadors.work_profession','ambassadors.description','ambassadors.image','ambassadors.status','ambassadors.created_at','admins.email as uemail')
            ->leftJoin('admins', 'admins.id', '=', 'ambassadors.updated_by')
            ->orderBy('ambassadors.id', 'DESC')
            ->paginate(40);
            $total_amb = Ambassador::all()->count();
            $rejected_amb = Ambassador::where('status','2')->count();
            $approved_amb = Ambassador::where('status','1')->count();
            $pending_amb = Ambassador::where('status','0')->count();
        }
        
        return view('admin.ambassador.index',compact('ambassadors','total_amb','rejected_amb','approved_amb','pending_amb'));
    }

 
    
   
    public function exportAmbassador()
    {
       if(request()->has('s'))
        {
           
        return Excel::download(new AmbsExport,'ambassadorlist.xlsx');
        }
      else
        {
        return Excel::download(new AmbsExport,'ambassadorlist.xlsx');
        }
    }
   /* public function ambsActive(Request $request,$ambs,$aid)
    {
        $ambassador = Ambassador::findOrFail($aid);
        $ambassador->status = $ambs;
        $ambassador->save();
        return redirect('admin/ambassadors')->with(['status' => 'success','msg' => 'successfully added']);

    }*/
    public function ambsActive(Request $request)
    {
        $auth_user = Auth::user();
        $response = array();
        $id = $request->amb_id;
        $status = $request->status;
        $ambassador = Ambassador::findOrFail($id);
        $ambassador->status = $status;
        $ambassador->updated_by = $auth_user->id;
        if($ambassador->save()){
            $amb_info = Ambassador::find($id);
            if($amb_info->status=='1'){
                if($amb_info->user_checker=='0'){
                    $pass = "Use your old password";
                }else{
                    $pass = "Ambassador@123";
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
    public function gramPanchayatAmbassadorList(Request $request)
    {

        /*if($request->input('search')=='search')
        {
            
            $search_txt = $request->input('s');
            $ambassadors = Ambassador::select('ambassadors.id','ambassadors.name','ambassadors.email','ambassadors.contact','ambassadors.designation','ambassadors.state_name','ambassadors.district_name','ambassadors.block_name','ambassadors.pincode','ambassadors.facebook_profile','ambassadors.twitter_profile','ambassadors.instagram_profile','ambassadors.work_profession','ambassadors.description','ambassadors.image','ambassadors.status','ambassadors.created_at','admins.email as uemail')
                ->leftJoin('admins', 'admins.id', '=', 'ambassadors.updated_by')
                        ->where('ambassadors.email','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.name','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.contact','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.state_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.district_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.block_name','LIKE','%'.$search_txt.'%')
                        ->paginate(40);
             $ambassadors_count = Ambassador::select('*')
                ->leftJoin('admins', 'admins.id', '=', 'ambassadors.updated_by')
                        ->where('ambassadors.email','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.name','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.contact','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.state_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.district_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('ambassadors.block_name','LIKE','%'.$search_txt.'%')
                        ->get();
            $total_amb = count($ambassadors_count);
        }
        else
        {
           $ambassadors = Ambassador::select('ambassadors.id','ambassadors.name','ambassadors.email','ambassadors.contact','ambassadors.designation','ambassadors.state_name','ambassadors.district_name','ambassadors.block_name','ambassadors.pincode','ambassadors.facebook_profile','ambassadors.twitter_profile','ambassadors.instagram_profile','ambassadors.work_profession','ambassadors.description','ambassadors.image','ambassadors.status','ambassadors.created_at','admins.email as uemail')
            ->leftJoin('admins', 'admins.id', '=', 'ambassadors.updated_by')
            ->orderBy('ambassadors.id', 'DESC')
            ->paginate(40);
            $total_amb = Ambassador::all()->count();
        }*/
        $gm_list = GramPanchayat::select('gram_panchayat_ambassador.id','gram_panchayat_ambassador.name','gram_panchayat_ambassador.age','gram_panchayat_ambassador.gender','gram_panchayat_ambassador.state_name','gram_panchayat_ambassador.district_name','gram_panchayat_ambassador.block_name','gram_panchayat_ambassador.pincode','gram_panchayat_ambassador.document_file','gram_panchayat_ambassador.status','gram_panchayat_ambassador.created_at')
                       /* ->where('gram_panchayat_ambassador.name','LIKE','%'.$search_txt.'%')
                        ->orWhere('gram_panchayat_ambassador.state_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('gram_panchayat_ambassador.district_name','LIKE','%'.$search_txt.'%')
                        ->orWhere('gram_panchayat_ambassador.block_name','LIKE','%'.$search_txt.'%')*/
                        ->orderBy('gram_panchayat_ambassador.id', 'DESC')
                        ->paginate(40);

        $total_gm_list = GramPanchayat::all()->count();
        return view('admin.ambassador.gram_panchayat_list',compact('gm_list','total_gm_list'));
    }
    public function gramPanchayatAmbDetail(){
        return view('admin.ambassador.gram_panchayat_detail');
    }



}
