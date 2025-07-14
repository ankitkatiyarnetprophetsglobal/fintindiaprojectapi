<?php

namespace App\Http\Controllers\v2;

use App\Helpers\Helper as HelpersHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\v2\CommonController;
use App\Models\User;
use App\Models\Eventorganizations;
use App\Models\Eventleaderboards;
use App\Models\Usermeta;
use App\Models\EventCat;
use Response;
use Helper;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Composer\Semver\Interval;

class WeekendcycleeventsController extends Controller
{
    public function __construct() {

        $this->middleware('auth:api', ['except' => ['get_weekend_cycle_event','event_all_count_users','search_userid_event','user_details_event']]);

    }

    public function get_weekend_cycle_event(Request $request){

        try{
            
            $user = auth('api')->user();
            if($user){                
                $user_id = $request->user_id;
                
                $WeekNumber = date("w");
                // dd($WeekNumber);
                $data = User::where([['id','=' , $user_id]])->first();

                if(!empty($data)){ 

                    $event_id = $request->event_id;

                    if(empty($event_id)){

                        if($data['role'] == 'namo-fit-india-cycling-club' || $data['rolewise'] =='cyclothon-2024'){
                                                    
                            // dd(count($active_user_count));
                            switch($WeekNumber)
                                    {
                                        case 0 : 
                                            // echo("Today is Sunday."); 
                                            $current_date = date_create(date('Y-m-d'));                                    
                                            // $current_date = date_create(date('2025-01-26'));                                    
                                            $current_date_format = date_format($current_date,'Y-m-d');
                                            // echo "current date" .'++++++++++++ '.$current_date_format .'<br/>';
                                            // current_week
                                            $events = Eventorganizations::
                                                    where('user_id', $user_id)
                                                    ->whereRaw("eventstartdate <=  date('$current_date_format')")
                                                    ->whereRaw("eventenddate >=  date('$current_date_format')")
                                                    ->orderBy('id', 'DESC')->first();                                    
                                            
                                            if(empty($events)){

                                                $date = date_create(date("Y-m-d"));
                                                // $date = date_create(date('2025-01-26'));
                                                $start_date = date_add($date,date_interval_create_from_date_string("0 days"));
                                                $start_date_format =  date_format($start_date,"Y-m-d");                                            
                                                // echo $start_date_format;
                                                // echo '<br/>';
                                                $dateend = date_create(date("Y-m-d"));
                                                // $dateend = date_create(date('2025-01-26'));;
                                                $end_date = date_add($dateend,date_interval_create_from_date_string("6 days"));
                                                $end_date_format =  date_format($end_date,"Y-m-d");
                                                // echo $end_date_format;
                                                $event_data = $this->insert_event_organizations($user_id, $start_date_format, $end_date_format);                                        

                                            }

                                            // two_week                                        
                                            $current_date = date_create(date('Y-m-d'));
                                            $two_week_format = date_add($current_date,date_interval_create_from_date_string("-7 days"));
                                            $two_week_date_format = date_format($two_week_format,"Y-m-d");
                                            $two_week_events = Eventorganizations::
                                                                                    where('user_id', $user_id)
                                                                                    ->whereRaw("eventstartdate <=  date('$two_week_date_format')")
                                                                                    ->whereRaw("eventenddate >=  date('$two_week_date_format')")
                                                                                    ->orderBy('id', 'DESC')->first();
                                            if(empty($two_week_events)){

                                                $date = date_create(date("Y-m-d"));
                                                // $date = date_create(date('2025-01-26'));
                                                $two_week_start_date = date_add($date,date_interval_create_from_date_string("-7 days"));
                                                $two_week_start_date_format =  date_format($two_week_start_date,"Y-m-d");
                                                // echo '<br/>';
                                                // echo $two_week_start_date_format;
                                                // echo '<br/>';
                                                $two_week_dateend = date_create(date("Y-m-d"));
                                                // $two_week_dateend = date_create(date('2025-01-26'));
                                                $two_week_end_date = date_add($two_week_dateend,date_interval_create_from_date_string("-1 days"));
                                                $two_week_end_date_format =  date_format($two_week_end_date,"Y-m-d");
                                                // echo $two_week_end_date_format;
                                                
                                                $data_insert = $this->insert_event_organizations($user_id, $two_week_start_date_format, $two_week_end_date_format);
                                            }

                                            // third_week
                                            $current_date = date_create(date("Y-m-d"));                                    
                                            $three_week_format = date_add($current_date,date_interval_create_from_date_string("-14 days"));
                                            $three_week_date_format = date_format($three_week_format,"Y-m-d");  
                                            $three_week_events = Eventorganizations::
                                                                                    where('user_id', $user_id)
                                                                                    ->whereRaw("eventstartdate <=  date('$three_week_date_format')")
                                                                                    ->whereRaw("eventenddate >=  date('$three_week_date_format')")
                                                                                    ->orderBy('id', 'DESC')->first();
                                            if(empty($three_week_events)){

                                                $date = date_create(date("Y-m-d"));
                                                // $date = date_create(date('2025-01-26'));
                                                $three_week_start_date = date_add($date,date_interval_create_from_date_string("-14 days"));
                                                $three_week_start_date_format =  date_format($three_week_start_date,"Y-m-d");                                    
                                                // echo '<br/>';
                                                // echo $three_week_start_date_format;
                                                // echo '<br/>';
                                                $three_week_dateend = date_create(date("Y-m-d"));
                                                // $three_week_dateend = date_create(date('2025-01-26'));
                                                $three_week_end_date = date_add($three_week_dateend,date_interval_create_from_date_string("-8 days"));
                                                $three_week_end_date_format =  date_format($three_week_end_date,"Y-m-d");                                        
                                                // echo $three_week_end_date_format; 
                                                $data_insert = $this->insert_event_organizations($user_id, $three_week_start_date_format, $three_week_end_date_format);
                                                
                                            }
                                            break;
                                        case 1 : 
                                            // echo("Today is Monday.");                                    
                                            $current_date = date_create(date('Y-m-d'));                                    
                                            // $current_date = date_create(date('2025-01-17'));                                    
                                            $current_date_format = date_format($current_date,'Y-m-d');
                                            // echo "current date" .'++++++++++++ '.$current_date_format .'<br/>';
                                            // current_week
                                            $events = Eventorganizations::
                                                    where('user_id', $user_id)
                                                    ->whereRaw("eventstartdate <=  date('$current_date_format')")
                                                    ->whereRaw("eventenddate >=  date('$current_date_format')")
                                                    ->orderBy('id', 'DESC')->first();                                    
                                            
                                            if(empty($events)){

                                                $date = date_create(date("Y-m-d"));
                                                // $date = date_create(date('2025-01-27'));
                                                $start_date = date_add($date,date_interval_create_from_date_string("-1 days"));
                                                $start_date_format =  date_format($start_date,"Y-m-d");                                            
                                                // echo $start_date_format;
                                                // echo '<br/>';
                                                $dateend = date_create(date("Y-m-d"));
                                                // $dateend = date_create(date('2025-01-27'));;
                                                $end_date = date_add($dateend,date_interval_create_from_date_string("5 days"));
                                                $end_date_format =  date_format($end_date,"Y-m-d");
                                                // echo $end_date_format;
                                                $event_data = $this->insert_event_organizations($user_id, $start_date_format, $end_date_format);                                        

                                            }

                                            // two_week                                        
                                            $current_date = date_create(date('Y-m-d'));
                                            $two_week_format = date_add($current_date,date_interval_create_from_date_string("-7 days"));
                                            $two_week_date_format = date_format($two_week_format,"Y-m-d");
                                            $two_week_events = Eventorganizations::
                                                                                    where('user_id', $user_id)
                                                                                    ->whereRaw("eventstartdate <=  date('$two_week_date_format')")
                                                                                    ->whereRaw("eventenddate >=  date('$two_week_date_format')")
                                                                                    ->orderBy('id', 'DESC')->first();
                                            if(empty($two_week_events)){

                                                $date = date_create(date("Y-m-d"));
                                                // $date = date_create(date('2025-01-27'));
                                                $two_week_start_date = date_add($date,date_interval_create_from_date_string("-8 days"));
                                                $two_week_start_date_format =  date_format($two_week_start_date,"Y-m-d");
                                                // echo '<br/>';
                                                // echo $two_week_start_date_format;
                                                // echo '<br/>';
                                                $two_week_dateend = date_create(date("Y-m-d"));
                                                // $two_week_dateend = date_create(date('2025-01-27'));
                                                $two_week_end_date = date_add($two_week_dateend,date_interval_create_from_date_string("-2 days"));
                                                $two_week_end_date_format =  date_format($two_week_end_date,"Y-m-d");
                                                // echo $two_week_end_date_format;
                                                
                                                $data_insert = $this->insert_event_organizations($user_id, $two_week_start_date_format, $two_week_end_date_format);
                                            }

                                            // third_week
                                            $current_date = date_create(date("Y-m-d"));                                    
                                            $three_week_format = date_add($current_date,date_interval_create_from_date_string("-14 days"));
                                            $three_week_date_format = date_format($three_week_format,"Y-m-d");  
                                            $three_week_events = Eventorganizations::
                                                                                    where('user_id', $user_id)
                                                                                    ->whereRaw("eventstartdate <=  date('$three_week_date_format')")
                                                                                    ->whereRaw("eventenddate >=  date('$three_week_date_format')")
                                                                                    ->orderBy('id', 'DESC')->first();
                                            if(empty($three_week_events)){

                                                $date = date_create(date("Y-m-d"));
                                                // $date = date_create(date('2025-01-27'));
                                                $three_week_start_date = date_add($date,date_interval_create_from_date_string("-15 days"));
                                                $three_week_start_date_format =  date_format($three_week_start_date,"Y-m-d");                                    
                                                // echo '<br/>';
                                                // echo $three_week_start_date_format;
                                                // echo '<br/>';
                                                $three_week_dateend = date_create(date("Y-m-d"));
                                                // $three_week_dateend = date_create(date('2025-01-27'));
                                                $three_week_end_date = date_add($three_week_dateend,date_interval_create_from_date_string("-9 days"));
                                                $three_week_end_date_format =  date_format($three_week_end_date,"Y-m-d");                                        
                                                // echo $three_week_end_date_format; 
                                                $data_insert = $this->insert_event_organizations($user_id, $three_week_start_date_format, $three_week_end_date_format);
                                                
                                            }                                  
                                            break;
                                        case 2 : 
                                            
                                            $current_date = date_create(date('Y-m-d'));                                    
                                            // $current_date = date_create(date('2025-01-28'));                                    
                                            $current_date_format = date_format($current_date,'Y-m-d');
                                            // echo "current date" .'++++++++++++ '.$current_date_format .'<br/>';
                                            // current_week
                                            $events = Eventorganizations::
                                                    where('user_id', $user_id)
                                                    ->whereRaw("eventstartdate <=  date('$current_date_format')")
                                                    ->whereRaw("eventenddate >=  date('$current_date_format')")
                                                    ->orderBy('id', 'DESC')->first();                                    
                                            
                                            if(empty($events)){

                                                $date = date_create(date("Y-m-d"));
                                                // $date = date_create(date('2025-01-28'));
                                                $start_date = date_add($date,date_interval_create_from_date_string("-2 days"));
                                                $start_date_format =  date_format($start_date,"Y-m-d");                                            
                                                // echo $start_date_format;
                                                // echo '<br/>';
                                                $dateend = date_create(date("Y-m-d"));
                                                // $dateend = date_create(date('2025-01-28'));;
                                                $end_date = date_add($dateend,date_interval_create_from_date_string("4 days"));
                                                $end_date_format =  date_format($end_date,"Y-m-d");
                                                // echo $end_date_format;
                                                $event_data = $this->insert_event_organizations($user_id, $start_date_format, $end_date_format);                                        

                                            }

                                            // two_week                                        
                                            $current_date = date_create(date('Y-m-d'));
                                            $two_week_format = date_add($current_date,date_interval_create_from_date_string("-7 days"));
                                            $two_week_date_format = date_format($two_week_format,"Y-m-d");
                                            $two_week_events = Eventorganizations::
                                                                                    where('user_id', $user_id)
                                                                                    ->whereRaw("eventstartdate <=  date('$two_week_date_format')")
                                                                                    ->whereRaw("eventenddate >=  date('$two_week_date_format')")
                                                                                    ->orderBy('id', 'DESC')->first();
                                            if(empty($two_week_events)){

                                                $date = date_create(date("Y-m-d"));
                                                // $date = date_create(date('2025-01-28'));
                                                $two_week_start_date = date_add($date,date_interval_create_from_date_string("-9 days"));
                                                $two_week_start_date_format =  date_format($two_week_start_date,"Y-m-d");
                                                // echo '<br/>';
                                                // echo $two_week_start_date_format;
                                                // echo '<br/>';
                                                $two_week_dateend = date_create(date("Y-m-d"));
                                                // $two_week_dateend = date_create(date('2025-01-28'));
                                                $two_week_end_date = date_add($two_week_dateend,date_interval_create_from_date_string("-3 days"));
                                                $two_week_end_date_format =  date_format($two_week_end_date,"Y-m-d");
                                                // echo $two_week_end_date_format;
                                                
                                                $data_insert = $this->insert_event_organizations($user_id, $two_week_start_date_format, $two_week_end_date_format);
                                            }

                                            // third_week
                                            $current_date = date_create(date("Y-m-d"));                                    
                                            $three_week_format = date_add($current_date,date_interval_create_from_date_string("-14 days"));
                                            $three_week_date_format = date_format($three_week_format,"Y-m-d");  
                                            $three_week_events = Eventorganizations::
                                                                                    where('user_id', $user_id)
                                                                                    ->whereRaw("eventstartdate <=  date('$three_week_date_format')")
                                                                                    ->whereRaw("eventenddate >=  date('$three_week_date_format')")
                                                                                    ->orderBy('id', 'DESC')->first();
                                            if(empty($three_week_events)){

                                                $date = date_create(date("Y-m-d"));
                                                // $date = date_create(date('2025-01-28'));
                                                $three_week_start_date = date_add($date,date_interval_create_from_date_string("-16 days"));
                                                $three_week_start_date_format =  date_format($three_week_start_date,"Y-m-d");                                    
                                                // echo '<br/>';
                                                // echo $three_week_start_date_format;
                                                // echo '<br/>';
                                                $three_week_dateend = date_create(date("Y-m-d"));
                                                // $three_week_dateend = date_create(date('2025-01-28'));
                                                $three_week_end_date = date_add($three_week_dateend,date_interval_create_from_date_string("-10 days"));
                                                $three_week_end_date_format =  date_format($three_week_end_date,"Y-m-d");                                        
                                                // echo $three_week_end_date_format; 
                                                $data_insert = $this->insert_event_organizations($user_id, $three_week_start_date_format, $three_week_end_date_format);
                                                
                                            }
                                            break;
                                        case 3 : 
                                            
                                            $current_date = date_create(date('Y-m-d'));                                    
                                            $current_date_format = date_format($current_date,'Y-m-d');

                                            // current_week
                                            $events = Eventorganizations::
                                                    where('user_id', $user_id)
                                                    ->whereRaw("eventstartdate <=  date('$current_date_format')")
                                                    ->whereRaw("eventenddate >=  date('$current_date_format')")
                                                    ->orderBy('id', 'DESC')->first();                                    
                                            
                                            if(empty($events)){

                                                $date = date_create(date("Y-m-d"));
                                                $start_date = date_add($date,date_interval_create_from_date_string("-3 days"));
                                                $start_date_format =  date_format($start_date,"Y-m-d");                                            
                                                // echo $start_date_format;
                                                // echo '<br/>';
                                                $dateend = date_create(date("Y-m-d"));
                                                $end_date = date_add($dateend,date_interval_create_from_date_string("3 days"));
                                                $end_date_format =  date_format($end_date,"Y-m-d");
                                                // echo $end_date_format;
                                                $event_data = $this->insert_event_organizations($user_id, $start_date_format, $end_date_format);                                        

                                            }

                                            // two_week
                                            $current_date = date_create(date('Y-m-d'));
                                            $two_week_format = date_add($current_date,date_interval_create_from_date_string("-7 days"));
                                            $two_week_date_format = date_format($two_week_format,"Y-m-d");
                                            $two_week_events = Eventorganizations::
                                                                                    where('user_id', $user_id)
                                                                                    ->whereRaw("eventstartdate <=  date('$two_week_date_format')")
                                                                                    ->whereRaw("eventenddate >=  date('$two_week_date_format')")
                                                                                    ->orderBy('id', 'DESC')->first();
                                            if(empty($two_week_events)){

                                                $date = date_create(date("Y-m-d"));
                                                $two_week_start_date = date_add($date,date_interval_create_from_date_string("-10 days"));
                                                $two_week_start_date_format =  date_format($two_week_start_date,"Y-m-d");
                                                // echo '<br/>';
                                                // echo $two_week_start_date_format;
                                                // echo '<br/>';
                                                $two_week_dateend = date_create(date("Y-m-d"));
                                                $two_week_end_date = date_add($two_week_dateend,date_interval_create_from_date_string("-4 days"));
                                                $two_week_end_date_format =  date_format($two_week_end_date,"Y-m-d");
                                                // echo $two_week_end_date_format;
                                                
                                                $data_insert = $this->insert_event_organizations($user_id, $two_week_start_date_format, $two_week_end_date_format);
                                            }

                                            // third_week
                                            $current_date = date_create(date("Y-m-d"));                                    
                                            $three_week_format = date_add($current_date,date_interval_create_from_date_string("-14 days"));
                                            $three_week_date_format = date_format($three_week_format,"Y-m-d");  
                                            $three_week_events = Eventorganizations::
                                                                                    where('user_id', $user_id)
                                                                                    ->whereRaw("eventstartdate <=  date('$three_week_date_format')")
                                                                                    ->whereRaw("eventenddate >=  date('$three_week_date_format')")
                                                                                    ->orderBy('id', 'DESC')->first();
                                            if(empty($three_week_events)){

                                                $date = date_create(date("Y-m-d"));
                                                $three_week_start_date = date_add($date,date_interval_create_from_date_string("-17 days"));
                                                $three_week_start_date_format =  date_format($three_week_start_date,"Y-m-d");                                    
                                                // echo '<br/>';
                                                // echo $three_week_start_date_format;
                                                // echo '<br/>';
                                                $three_week_dateend = date_create(date("Y-m-d"));
                                                $three_week_end_date = date_add($three_week_dateend,date_interval_create_from_date_string("-11 days"));
                                                $three_week_end_date_format =  date_format($three_week_end_date,"Y-m-d");                                        
                                                // echo $three_week_end_date_format; 
                                                $data_insert = $this->insert_event_organizations($user_id, $three_week_start_date_format, $three_week_end_date_format);
                                                
                                            }
                                            break;
                                        case 4 : 
                                            // echo("Today is thursday."); 
                                            $current_date = date_create(date('Y-m-d'));                                    
                                            // $current_date = date_create(date('2025-01-30'));                                    
                                            $current_date_format = date_format($current_date,'Y-m-d');
                                            // echo "current date" .'++++++++++++ '.$current_date_format .'<br/>';
                                            // current_week
                                            $events = Eventorganizations::
                                                    where('user_id', $user_id)
                                                    ->whereRaw("eventstartdate <=  date('$current_date_format')")
                                                    ->whereRaw("eventenddate >=  date('$current_date_format')")
                                                    ->orderBy('id', 'DESC')->first();                                    
                                            
                                            if(empty($events)){

                                                $date = date_create(date("Y-m-d"));
                                                // $date = date_create(date('2025-01-30'));
                                                $start_date = date_add($date,date_interval_create_from_date_string("-4 days"));
                                                $start_date_format =  date_format($start_date,"Y-m-d");                                            
                                                // echo $start_date_format;
                                                // echo '<br/>';
                                                $dateend = date_create(date("Y-m-d"));
                                                // $dateend = date_create(date('2025-01-30'));;
                                                $end_date = date_add($dateend,date_interval_create_from_date_string("2 days"));
                                                $end_date_format =  date_format($end_date,"Y-m-d");
                                                // echo $end_date_format;
                                                $event_data = $this->insert_event_organizations($user_id, $start_date_format, $end_date_format);                                        

                                            }

                                            // two_week
                                            $current_date = date_create(date('Y-m-d'));                                        
                                            $two_week_format = date_add($current_date,date_interval_create_from_date_string("-7 days"));
                                            $two_week_date_format = date_format($two_week_format,"Y-m-d");
                                            $two_week_events = Eventorganizations::
                                                                                    where('user_id', $user_id)
                                                                                    ->whereRaw("eventstartdate <=  date('$two_week_date_format')")
                                                                                    ->whereRaw("eventenddate >=  date('$two_week_date_format')")
                                                                                    ->orderBy('id', 'DESC')->first();
                                            if(empty($two_week_events)){

                                                $date = date_create(date("Y-m-d"));
                                                // $date = date_create(date('2025-01-30'));
                                                $two_week_start_date = date_add($date,date_interval_create_from_date_string("-11 days"));
                                                $two_week_start_date_format =  date_format($two_week_start_date,"Y-m-d");
                                                // echo '<br/>';
                                                // echo $two_week_start_date_format;
                                                // echo '<br/>';
                                                $two_week_dateend = date_create(date("Y-m-d"));
                                                // $two_week_dateend = date_create(date('2025-01-30'));
                                                $two_week_end_date = date_add($two_week_dateend,date_interval_create_from_date_string("-5 days"));
                                                $two_week_end_date_format =  date_format($two_week_end_date,"Y-m-d");
                                                // echo $two_week_end_date_format;
                                                
                                                $data_insert = $this->insert_event_organizations($user_id, $two_week_start_date_format, $two_week_end_date_format);
                                            }

                                            // third_week
                                            $current_date = date_create(date("Y-m-d"));                                    
                                            $three_week_format = date_add($current_date,date_interval_create_from_date_string("-14 days"));
                                            $three_week_date_format = date_format($three_week_format,"Y-m-d");  
                                            $three_week_events = Eventorganizations::
                                                                                    where('user_id', $user_id)
                                                                                    ->whereRaw("eventstartdate <=  date('$three_week_date_format')")
                                                                                    ->whereRaw("eventenddate >=  date('$three_week_date_format')")
                                                                                    ->orderBy('id', 'DESC')->first();
                                            if(empty($three_week_events)){

                                                $date = date_create(date("Y-m-d"));
                                                // $date = date_create(date('2025-01-30'));
                                                $three_week_start_date = date_add($date,date_interval_create_from_date_string("-18 days"));
                                                $three_week_start_date_format =  date_format($three_week_start_date,"Y-m-d");                                    
                                                // echo '<br/>';
                                                // echo $three_week_start_date_format;
                                                // echo '<br/>';
                                                $three_week_dateend = date_create(date("Y-m-d"));
                                                // $three_week_dateend = date_create(date('2025-01-30'));
                                                $three_week_end_date = date_add($three_week_dateend,date_interval_create_from_date_string("-12 days"));
                                                $three_week_end_date_format =  date_format($three_week_end_date,"Y-m-d");                                        
                                                // echo $three_week_end_date_format; 
                                                $data_insert = $this->insert_event_organizations($user_id, $three_week_start_date_format, $three_week_end_date_format);
                                                
                                            }
                                            break;
                                        case 5 : 
                                            // echo("Today is Friday."); 
                                            $current_date = date_create(date('Y-m-d'));                                    
                                            // $current_date = date_create(date('2025-01-31'));                                    
                                            $current_date_format = date_format($current_date,'Y-m-d');
                                            // echo "current date" .'++++++++++++ '.$current_date_format .'<br/>';
                                            // current_week
                                            $events = Eventorganizations::
                                                    where('user_id', $user_id)
                                                    ->whereRaw("eventstartdate <=  date('$current_date_format')")
                                                    ->whereRaw("eventenddate >=  date('$current_date_format')")
                                                    ->orderBy('id', 'DESC')->first();                                    
                                            
                                            if(empty($events)){

                                                $date = date_create(date("Y-m-d"));
                                                // $date = date_create(date('2025-01-31'));
                                                $start_date = date_add($date,date_interval_create_from_date_string("-5 days"));
                                                $start_date_format =  date_format($start_date,"Y-m-d");                                            
                                                // echo $start_date_format;
                                                // echo '<br/>';
                                                $dateend = date_create(date("Y-m-d"));
                                                // $dateend = date_create(date('2025-01-31'));;
                                                $end_date = date_add($dateend,date_interval_create_from_date_string("1 days"));
                                                $end_date_format =  date_format($end_date,"Y-m-d");
                                                // echo $end_date_format;
                                                $event_data = $this->insert_event_organizations($user_id, $start_date_format, $end_date_format);                                        

                                            }

                                            // two_week                                        
                                            $current_date = date_create(date('Y-m-d'));
                                            $two_week_format = date_add($current_date,date_interval_create_from_date_string("-7 days"));
                                            $two_week_date_format = date_format($two_week_format,"Y-m-d");
                                            $two_week_events = Eventorganizations::
                                                                                    where('user_id', $user_id)
                                                                                    ->whereRaw("eventstartdate <=  date('$two_week_date_format')")
                                                                                    ->whereRaw("eventenddate >=  date('$two_week_date_format')")
                                                                                    ->orderBy('id', 'DESC')->first();
                                            if(empty($two_week_events)){

                                                $date = date_create(date("Y-m-d"));
                                                // $date = date_create(date('2025-01-31'));
                                                $two_week_start_date = date_add($date,date_interval_create_from_date_string("-12 days"));
                                                $two_week_start_date_format =  date_format($two_week_start_date,"Y-m-d");
                                                // echo '<br/>';
                                                // echo $two_week_start_date_format;
                                                // echo '<br/>';
                                                $two_week_dateend = date_create(date("Y-m-d"));
                                                // $two_week_dateend = date_create(date('2025-01-31'));
                                                $two_week_end_date = date_add($two_week_dateend,date_interval_create_from_date_string("-6 days"));
                                                $two_week_end_date_format =  date_format($two_week_end_date,"Y-m-d");
                                                // echo $two_week_end_date_format;
                                                
                                                $data_insert = $this->insert_event_organizations($user_id, $two_week_start_date_format, $two_week_end_date_format);
                                            }

                                            // third_week
                                            $current_date = date_create(date("Y-m-d"));                                    
                                            $three_week_format = date_add($current_date,date_interval_create_from_date_string("-14 days"));
                                            $three_week_date_format = date_format($three_week_format,"Y-m-d");  
                                            $three_week_events = Eventorganizations::
                                                                                    where('user_id', $user_id)
                                                                                    ->whereRaw("eventstartdate <=  date('$three_week_date_format')")
                                                                                    ->whereRaw("eventenddate >=  date('$three_week_date_format')")
                                                                                    ->orderBy('id', 'DESC')->first();
                                            if(empty($three_week_events)){

                                                $date = date_create(date("Y-m-d"));
                                                // $date = date_create(date('2025-01-31'));
                                                $three_week_start_date = date_add($date,date_interval_create_from_date_string("-19 days"));
                                                $three_week_start_date_format =  date_format($three_week_start_date,"Y-m-d");                                    
                                                // echo '<br/>';
                                                // echo $three_week_start_date_format;
                                                // echo '<br/>';
                                                $three_week_dateend = date_create(date("Y-m-d"));
                                                // $three_week_dateend = date_create(date('2025-01-31'));
                                                $three_week_end_date = date_add($three_week_dateend,date_interval_create_from_date_string("-13 days"));
                                                $three_week_end_date_format =  date_format($three_week_end_date,"Y-m-d");                                        
                                                // echo $three_week_end_date_format; 
                                                $data_insert = $this->insert_event_organizations($user_id, $three_week_start_date_format, $three_week_end_date_format);
                                                
                                            }
                                            // dd($end_date_format);
                                            break;
                                        case 6 : 
                                            // echo("Today is Saturday.");                                        
                                            $current_date = date_create(date('Y-m-d'));                                    
                                            // $current_date = date_create(date('2025-01-01'));                                    
                                            $current_date_format = date_format($current_date,'Y-m-d');
                                            // echo "current date" .'++++++++++++ '.$current_date_format .'<br/>';
                                            // current_week
                                            $events = Eventorganizations::
                                                    where('user_id', $user_id)
                                                    ->whereRaw("eventstartdate <=  date('$current_date_format')")
                                                    ->whereRaw("eventenddate >=  date('$current_date_format')")
                                                    ->orderBy('id', 'DESC')->first();                                    
                                            
                                            if(empty($events)){

                                                $date = date_create(date("Y-m-d"));
                                                // $date = date_create(date('2025-01-01'));
                                                $start_date = date_add($date,date_interval_create_from_date_string("-6 days"));
                                                $start_date_format =  date_format($start_date,"Y-m-d");                                            
                                                // echo $start_date_format;
                                                // echo '<br/>';
                                                $dateend = date_create(date("Y-m-d"));
                                                // $dateend = date_create(date('2025-01-01'));;
                                                $end_date = date_add($dateend,date_interval_create_from_date_string("0 days"));
                                                $end_date_format =  date_format($end_date,"Y-m-d");
                                                // echo $end_date_format;
                                                $event_data = $this->insert_event_organizations($user_id, $start_date_format, $end_date_format);                                        

                                            }

                                            // two_week                                        
                                            $current_date = date_create(date('Y-m-d'));
                                            $two_week_format = date_add($current_date,date_interval_create_from_date_string("-7 days"));
                                            $two_week_date_format = date_format($two_week_format,"Y-m-d");
                                            $two_week_events = Eventorganizations::
                                                                                    where('user_id', $user_id)
                                                                                    ->whereRaw("eventstartdate <=  date('$two_week_date_format')")
                                                                                    ->whereRaw("eventenddate >=  date('$two_week_date_format')")
                                                                                    ->orderBy('id', 'DESC')->first();
                                            if(empty($two_week_events)){

                                                $date = date_create(date("Y-m-d"));
                                                // $date = date_create(date('2025-01-01'));
                                                $two_week_start_date = date_add($date,date_interval_create_from_date_string("-13 days"));
                                                $two_week_start_date_format =  date_format($two_week_start_date,"Y-m-d");
                                                // echo '<br/>';
                                                // echo $two_week_start_date_format;
                                                // echo '<br/>';
                                                $two_week_dateend = date_create(date("Y-m-d"));
                                                // $two_week_dateend = date_create(date('2025-01-01'));
                                                $two_week_end_date = date_add($two_week_dateend,date_interval_create_from_date_string("-7 days"));
                                                $two_week_end_date_format =  date_format($two_week_end_date,"Y-m-d");
                                                // echo $two_week_end_date_format;
                                                
                                                $data_insert = $this->insert_event_organizations($user_id, $two_week_start_date_format, $two_week_end_date_format);
                                            }

                                            // third_week
                                            $current_date = date_create(date("Y-m-d"));                                    
                                            $three_week_format = date_add($current_date,date_interval_create_from_date_string("-14 days"));
                                            $three_week_date_format = date_format($three_week_format,"Y-m-d");  
                                            $three_week_events = Eventorganizations::
                                                                                    where('user_id', $user_id)
                                                                                    ->whereRaw("eventstartdate <=  date('$three_week_date_format')")
                                                                                    ->whereRaw("eventenddate >=  date('$three_week_date_format')")
                                                                                    ->orderBy('id', 'DESC')->first();
                                            if(empty($three_week_events)){

                                                $date = date_create(date("Y-m-d"));
                                                // $date = date_create(date('2025-01-01'));
                                                $three_week_start_date = date_add($date,date_interval_create_from_date_string("-20 days"));
                                                $three_week_start_date_format =  date_format($three_week_start_date,"Y-m-d");                                    
                                                // echo '<br/>';
                                                // echo $three_week_start_date_format;
                                                // echo '<br/>';
                                                $three_week_dateend = date_create(date("Y-m-d"));
                                                // $three_week_dateend = date_create(date('2025-01-01'));
                                                $three_week_end_date = date_add($three_week_dateend,date_interval_create_from_date_string("-14 days"));
                                                $three_week_end_date_format =  date_format($three_week_end_date,"Y-m-d");                                        
                                                // echo $three_week_end_date_format; 
                                                $data_insert = $this->insert_event_organizations($user_id, $three_week_start_date_format, $three_week_end_date_format);
                                                
                                            }
                                            break;
                                    }

                                    $event_data = $this->event_organizations_count_user($user_id,$current_date_format);
                                            $all_data = array (
                                                // "active_user_count" => count($active_user),
                                                "title_text" => "Leaderboard",
                                                "message_show" => "Photos will be deleted after 30 days",
                                                "event_data_count" => count($event_data),                    
                                                "event_data" => $event_data                    
                                            );
                                            return Response::json(array(
                                                'status'    => 'success',
                                                'code'      =>  200,
                                                'message'   =>  null,
                                                'data'      => $all_data
                                            ), 200);
                        }else{

                            return Response::json(array(
                                'status'    => 'error',
                                'code'      =>  200,
                                'message'   =>  'Mismatch role',
                                'data'   => null,
                            ), 401);

                        }
                    }else{

                        // $event_data = $this->event_organizations_count_user($event_id);
                        
                        // $event_data = Eventorganizations::
                        //                                 where('id', $event_id)
                        //                                 // ->whereRaw("eventstartdate <=  date('$current_date_format')")
                        //                                 // ->whereRaw("eventenddate >=  date('$current_date_format')")
                        //                                 ->orderBy('id', 'DESC')->paginate(10);
                        $current_date = date_create(date('Y-m-d'));
                        $current_date_format = date_format($current_date,'Y-m-d');
                        $event_data = $this->event_organizations_count_user($user_id,$current_date_format);
                        if($event_data->count() > 0){
                            $all_data = array (
                                // "active_user_count" => count($active_user),
                                "title_text" => "Leaderboard",
                                "message_show" => "Photos will be deleted after 30 days",
                                "event_data_count" => count($event_data),                    
                                "event_data" => $event_data                    
                            );
                            return Response::json(array(
                                'status'    => 'success',
                                'code'      =>  200,
                                'message'   =>  null,
                                'data'      => $all_data,
                            ), 200);
                        }else{
                            return Response::json(array(
                                'status'    => 'error',
                                'code'      =>  200,
                                'message'   =>  'Data not found',
                                'data'   => null,
                            ), 401);
                        }
                        // dd("event display as per id");
                    }
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

            $controller_name = 'WeekendcycleeventsController';
            $function_name = 'get_weekend_cycle_event';
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

    function insert_event_organizations($user_id, $start_date_format, $end_date_format) {
       
        $user_information = DB::table('users')
                                            ->join('usermetas', 'usermetas.user_id', '=', 'users.id')
                                            ->where([
                                                ['users.id', '=', $user_id]
                                            ])
                                            ->select(                                                                        
                                                'users.id',
                                                'users.name',
                                                'users.email',
                                                "users.phone",                                                                        
                                                "usermetas.user_id",                                                                        
                                                "usermetas.state",                                                                        
                                                "usermetas.participant_number"
                                            )
                                            ->first();
        // dd($user_information->name);                                
        // Usermeta::where('user_id','=',$user_id)->orderBy('id', 'DESC')->first();
        $categories_name = EventCat::where('status',2)->where('id','=',13078)->orderBy('id', 'DESC')->first();
        // dd($categories_name);
        $imgurl = null;
        $prt_date = null;
        $number_of_partcipant = null;
        $video_link = null;
        $km = null;
        $run = new Eventorganizations();
        $run->user_id = $user_id;            
        $run->category = $categories_name['id']; // event category from event_cat table
        $run->event_name_store = $categories_name['name'];
        $run->name = $user_information->name;
        $run->email = $user_information->email;
        $run->contact = $user_information->phone;
        $run->state = $user_information->state;
        $run->participantnum = $user_information->participant_number;
        $run->school_chain = null;
        $run->eventstartdate = $start_date_format;
        $run->eventenddate = $end_date_format;
        $run->eventimg_meta = "a:0:{}";
        $run->event_bg_image = isset($event_background_image) ? $event_background_image : null;
        $run->eventdate_meta = serialize($prt_date);
        $run->eventpnt_meta = serialize($number_of_partcipant);
        $run->eventkm_meta = serialize($km);
        $run->organiser_name = $user_information->name;
        $run->role = 'organizer';
        $run->video_link = "a:1:{i:0;N;}";
        $run->save();
        // $categories = EventCat::where('status',2)->orderBy('id', 'DESC')->get();      
        // $event_data = Eventorganizations::where('user_id', $user_id)->orderBy('id', 'DESC')->get();  
        // $role = Role::where('slug', $role)->first()->name;
        // return $event_data;
    }

    function event_organizations_count_user($event_id){
        
        // $event_data = Eventorganizations::
        //         join('userhistorytrakings as uh', 'event_organizations.user_id', '=', 'uh.user_id')
        //         // where('user_id', $user_id)
        //         // ->whereRaw("eventstartdate <=  date('$current_date_format')")
        //         // ->whereRaw("eventenddate >=  date('$current_date_format')")
        //         // orderBy('id', 'DESC')->get();
        //         ->select('event_organizations.user_id','event_organizations.event_name_store','event_organizations.eventstartdate','event_organizations.eventenddate','event_organizations.id as event_id')
        //         ->where('uh.created_by', '>=', '2024-12-17 00:00:01')
        //         ->orderBy('uh.id', 'DESC')->paginate(50);
        $event_data = Eventleaderboards::orderBy('id', 'DESC')->get();
        
        return $event_data;
    }

    public function event_all_count_users(Request $request){
        try{

                $user = auth('api')->user();
                
                if($user){ 

                    $name = $request->name;
                    $number_user_list = 50;
                    if (isset($name)) {
                        $active_all_user = User::
                                                join('event_organizations','event_organizations.user_id', '=',	'users.id')
                                                ->join('usermetas','usermetas.user_id', '=',	'users.id')
                                                ->join('userhistorytrakings', 'users.id', '=', 'userhistorytrakings.user_id')
                                                ->where(
                                                [
                                                    // ['users.rolewise', '=', 'cyclothon-2024'],
                                                    ['users.name','=' , $name],
                                                ])
                                                ->where(function($q){
                                                    $q->where('users.rolewise', '=', 'cyclothon-2024')->orWhere('users.role','=' , 'namo-fit-india-cycling-club');
                                                })
                                                ->where('userhistorytrakings.created_by', '>=', '2024-12-17 00:00:01')
                                                // ->where('event_organizations.eventstartdate', '>=', '2024-12-17')
                                                ->where('userhistorytrakings.modegroupid', 2)
                                                ->select('users.id as user_id','users.name','usermetas.image as image','users.rolewise','users.role','event_organizations.id as event_id','event_organizations.eventstartdate','event_organizations.eventenddate','event_organizations.event_bg_image')
                                                ->groupBy('users.id','users.name','usermetas.image','users.rolewise','users.role','event_organizations.id','event_organizations.eventstartdate','event_organizations.eventenddate')                                                
                                                // ->orWhere('users.role','=' , 'namo-fit-india-cycling-club')
                                                ->paginate($number_user_list);
                    }else{
                        
                        $active_all_user = User::
                                                join('event_organizations','event_organizations.user_id', '=',	'users.id')
                                                ->join('usermetas','usermetas.user_id', '=',	'users.id')
                                                ->join('userhistorytrakings', 'users.id', '=', 'userhistorytrakings.user_id')
                                                // ->where([['users.rolewise', '=', 'cyclothon-2024']])
                                                ->where(function($q){
                                                    $q->where('users.rolewise', '=', 'cyclothon-2024')->orWhere('users.role','=' , 'namo-fit-india-cycling-club');
                                                })
                                                // ->where('userhistorytrakings.created_by', '>=', '2024-12-17 00:00:01')
                                                // ->where('event_organizations.eventstartdate', '>=', '2024-12-17')
                                                ->where('userhistorytrakings.modegroupid', 2)
                                                ->select('users.id as user_id','users.name','usermetas.image as image','users.rolewise','users.role','event_organizations.id as event_id','event_organizations.eventstartdate','event_organizations.eventenddate','event_organizations.event_bg_image')
                                                ->groupBy('users.id','users.name','usermetas.image','users.rolewise','users.role','event_organizations.id','event_organizations.eventstartdate','event_organizations.eventenddate')
                                                // ->orWhere('users.role','=' , 'namo-fit-india-cycling-club')
                                                ->paginate($number_user_list);
                        
                        // dd( $active_all_user);
                    }
                    // dd($user_id);

                    // $active_all_participantnum = User::
                    //                         join('event_organizations','event_organizations.user_id', '=',	'users.id')
                    //                         ->where([['users.rolewise', '=', 'cyclothon-2024']])
                    //                         ->where(function($q){
                    //                             $q->where('users.rolewise', '=', 'cyclothon-2024')->orWhere('users.role','=' , 'namo-fit-india-cycling-club');
                    //                         })
                    //                         // ->select('users.id as user_id','users.name','usermetas.image as image','users.rolewise','users.role','event_organizations.id as event_id','event_organizations.eventstartdate','event_organizations.eventenddate')
                    //                         ->select(DB::raw('SUM(IFNULL(event_organizations.participantnum, 0)) as participantnum'))
                    //                         ->get();
                    $active_all_participantnum = DB::table('usermetas')
                                        ->join('users', 'users.id', '=', 'usermetas.user_id')
                                        ->join('event_organizations', 'event_organizations.user_id', '=', 'users.id')
                                        ->join('userhistorytrakings', 'users.id', '=', 'userhistorytrakings.user_id')
                                        ->whereRaw('CHAR_LENGTH(usermetas.participant_number) < ?', [5])
                                        ->where(function($q){
                                                    $q->where('users.rolewise', '=', 'cyclothon-2024')->orWhere('users.role','=' , 'namo-fit-india-cycling-club');
                                                })
                                        // ->where('users.rolewise', 'cyclothon-2024')
                                        ->whereRaw('CHAR_LENGTH(event_organizations.participantnum) < ?', [5])
                                        ->where('userhistorytrakings.modegroupid', 2)
                                        ->select(DB::raw('SUM(COALESCE(usermetas.participant_number + event_organizations.participantnum, 0)) as participantnum'))
                                        ->groupBy('users.id','users.name','usermetas.image','users.rolewise','users.role','event_organizations.id','event_organizations.eventstartdate','event_organizations.eventenddate')
                                        ->value('participantnum');
                    // dd((int)$active_all_participantnum);
                                            // $data_points = DB::select("SELECT sum(ifnull(on_c.point, 0) + ifnull(ur.score, 0)) as point FROM `users` as us LEFT JOIN ongoing_challengers as on_c on us.id = on_c.user_id LEFT JOIN user_ranks ur on ur.user_id = us.id LEFT JOIN challenger_masters cm on cm.id = on_c.challenger_id WHERE us.id = $user_id;")
                    // $participantnum_count = (int)$active_all_participantnum[0]['participantnum'];
                    // $total_count = $participantnum_count + count($active_all_user);
                    $total_count = (int)$active_all_participantnum;

                    $all_data = array (
                        // "active_user_count" => count($active_user),
                        "title_text" => "Leaderboard",
                        "total_count" => $total_count,
                        "all_user" => $active_all_user,
                    );
                    // dd((int)$active_all_participantnum['participantnum']);

                    if($active_all_user->count() > 0){
                        return Response::json(array(
                            'status'    => 'success',
                            'code'      =>  200,
                            'message'   =>  null,
                            'data'      => $all_data,
                        ), 200);
                        
                    }else{
                        $all_data = array (
                            // "active_user_count" => count($active_user),
                            "title_text" => "Leaderboard",
                            "total_count" => "--",
                            "all_user" => "Data not found",
                        );
                        return Response::json(array(
                            'status'    => 'error',
                            'code'      =>  200,
                            'message'   =>  $all_data,
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

                $controller_name = 'WeekendcycleeventsController';
                $function_name = 'get_weekend_cycle_event';
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
    
    public function search_userid_event(Request $request){
        
        try{

            $user = auth('api')->user();
                           
            if($user){ 

                $event_id = $request->event_id;  
                $name = $request->name;  
                $number_user_list = 50;
                if (isset($event_id) && isset($name)){

                    $active_all_user = User::
                                            join('event_organizations','event_organizations.user_id', '=',	'users.id')
                                            ->join('usermetas','usermetas.user_id', '=',	'users.id')
                                            ->join('userhistorytrakings', 'users.id', '=', 'userhistorytrakings.user_id')
                                            ->where(
                                            [
                                                // ['users.rolewise', '=', 'cyclothon-2024'],
                                                ['users.name','=' , $name],
                                                ['event_organizations.id','=' , $event_id],
                                            ])
                                            ->where(function($q){
                                                $q->where('users.rolewise', '=', 'cyclothon-2024')->orWhere('users.role','=' , 'namo-fit-india-cycling-club');
                                            })
                                            ->where('userhistorytrakings.created_by', '>=', '2024-12-17 00:00:01')
                                            // ->where('event_organizations.eventstartdate', '>=', '2024-12-17')
                                            ->where('userhistorytrakings.modegroupid', 2)
                                            ->select('users.id as user_id','users.name','usermetas.image as image','users.rolewise','users.role','event_organizations.id as event_id','event_organizations.eventstartdate','event_organizations.eventenddate','event_organizations.event_bg_image')
                                            ->groupBy('users.id','users.name','usermetas.image','users.rolewise','users.role','event_organizations.id','event_organizations.eventstartdate','event_organizations.eventenddate')                                                
                                            // ->orWhere('users.role','=' , 'namo-fit-india-cycling-club')
                                            ->paginate($number_user_list);

                }else if (isset($event_id)) {
                    $active_all_user = User::
                                            join('event_organizations','event_organizations.user_id', '=',	'users.id')
                                            ->join('usermetas','usermetas.user_id', '=',	'users.id')
                                            ->join('userhistorytrakings', 'users.id', '=', 'userhistorytrakings.user_id')
                                            ->where(
                                            [
                                                // ['users.rolewise', '=', 'cyclothon-2024'],
                                                ['event_organizations.id','=' , $event_id],
                                            ])
                                            ->where(function($q){
                                                $q->where('users.rolewise', '=', 'cyclothon-2024')->orWhere('users.role','=' , 'namo-fit-india-cycling-club');
                                            })
                                            ->where('userhistorytrakings.created_by', '>=', '2024-12-17 00:00:01')
                                            // ->where('event_organizations.eventstartdate', '>=', '2024-12-17')
                                            ->where('userhistorytrakings.modegroupid', 2)
                                            ->select('users.id as user_id','users.name','usermetas.image as image','users.rolewise','users.role','event_organizations.id as event_id','event_organizations.eventstartdate','event_organizations.eventenddate','event_organizations.event_bg_image')
                                            ->groupBy('users.id','users.name','usermetas.image','users.rolewise','users.role','event_organizations.id','event_organizations.eventstartdate','event_organizations.eventenddate')                                                
                                            // ->orWhere('users.role','=' , 'namo-fit-india-cycling-club')
                                            ->paginate($number_user_list);
                    // dd( $active_all_user);
                }else{
                    
                    $active_all_user = User::
                                            join('event_organizations','event_organizations.user_id', '=',	'users.id')
                                            ->join('usermetas','usermetas.user_id', '=',	'users.id')
                                            ->join('userhistorytrakings', 'users.id', '=', 'userhistorytrakings.user_id')
                                            // ->where([['users.rolewise', '=', 'cyclothon-2024']])
                                            ->where(function($q){
                                                $q->where('users.rolewise', '=', 'cyclothon-2024')->orWhere('users.role','=' , 'namo-fit-india-cycling-club');
                                            })
                                            // ->where('userhistorytrakings.created_by', '>=', '2024-12-17 00:00:01')
                                            // ->where('event_organizations.eventstartdate', '>=', '2024-12-17')
                                            ->where('userhistorytrakings.modegroupid', 2)
                                            ->select('users.id as user_id','users.name','usermetas.image as image','users.rolewise','users.role','event_organizations.id as event_id','event_organizations.eventstartdate','event_organizations.eventenddate','event_organizations.event_bg_image')
                                            ->groupBy('users.id','users.name','usermetas.image','users.rolewise','users.role','event_organizations.id','event_organizations.eventstartdate','event_organizations.eventenddate')
                                            // ->orWhere('users.role','=' , 'namo-fit-india-cycling-club')
                                            ->paginate($number_user_list);
                    
                    // dd( $active_all_user);
                }
                    // dd($user_id);

                    // $active_all_participantnum = User::
                    //                         join('event_organizations','event_organizations.user_id', '=',	'users.id')
                    //                         ->where([['users.rolewise', '=', 'cyclothon-2024']])
                    //                         ->where(function($q){
                    //                             $q->where('users.rolewise', '=', 'cyclothon-2024')->orWhere('users.role','=' , 'namo-fit-india-cycling-club');
                    //                         })
                    //                         // ->select('users.id as user_id','users.name','usermetas.image as image','users.rolewise','users.role','event_organizations.id as event_id','event_organizations.eventstartdate','event_organizations.eventenddate')
                    //                         ->select(DB::raw('SUM(IFNULL(event_organizations.participantnum, 0)) as participantnum'))
                    //                         ->get();
                    $active_all_participantnum = DB::table('usermetas')
                                        ->join('users', 'users.id', '=', 'usermetas.user_id')
                                        ->join('event_organizations', 'event_organizations.user_id', '=', 'users.id')
                                        ->join('userhistorytrakings', 'users.id', '=', 'userhistorytrakings.user_id')
                                        ->whereRaw('CHAR_LENGTH(usermetas.participant_number) < ?', [5])
                                        ->where(function($q){
                                                    $q->where('users.rolewise', '=', 'cyclothon-2024')->orWhere('users.role','=' , 'namo-fit-india-cycling-club');
                                                })
                                        // ->where('users.rolewise', 'cyclothon-2024')
                                        ->whereRaw('CHAR_LENGTH(event_organizations.participantnum) < ?', [5])
                                        ->where('userhistorytrakings.modegroupid', 2)
                                        ->select(DB::raw('SUM(COALESCE(usermetas.participant_number + event_organizations.participantnum, 0)) as participantnum'))
                                        ->groupBy('users.id','users.name','usermetas.image','users.rolewise','users.role','event_organizations.id','event_organizations.eventstartdate','event_organizations.eventenddate')
                                        ->value('participantnum');
                    // dd((int)$active_all_participantnum);
                                            // $data_points = DB::select("SELECT sum(ifnull(on_c.point, 0) + ifnull(ur.score, 0)) as point FROM `users` as us LEFT JOIN ongoing_challengers as on_c on us.id = on_c.user_id LEFT JOIN user_ranks ur on ur.user_id = us.id LEFT JOIN challenger_masters cm on cm.id = on_c.challenger_id WHERE us.id = $user_id;")
                    // $participantnum_count = (int)$active_all_participantnum[0]['participantnum'];
                    // $total_count = $participantnum_count + count($active_all_user);
                    $total_count = (int)$active_all_participantnum;

                    $all_data = array (
                        // "active_user_count" => count($active_user),
                        "title_text" => "Leaderboard",
                        "total_count" => $total_count,
                        "all_user" => $active_all_user,
                    );
                    // dd((int)$active_all_participantnum['participantnum']);

                    if($active_all_user->count() > 0){
                        return Response::json(array(
                            'status'    => 'success',
                            'code'      =>  200,
                            'message'   =>  null,
                            'data'      => $all_data,
                        ), 200);
                        
                    }else{
                        $all_data = array (
                            // "active_user_count" => count($active_user),
                            "title_text" => "Leaderboard",
                            "total_count" => "--",
                            "all_user" => "Data not found",
                        );
                        return Response::json(array(
                            'status'    => 'error',
                            'code'      =>  200,
                            'message'   =>  $all_data,
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
                // $user = auth('api')->user();
                // // dd("search_userid_event");
                // if($user){ 

                //     $name = $request->name;
                //     $number_user_list = 50;
                //     if (isset($name)) {
                //         $active_all_user = User::
                //                                 join('event_organizations','event_organizations.user_id', '=',	'users.id')
                //                                 ->where(
                //                                 [
                //                                     ['users.rolewise', '=', 'cyclothon-2024'],
                //                                     ['users.name','=' , $name],
                //                                 ])
                //                                 ->orWhere('users.role','=' , 'namo-fit-india-cycling-club')
                //                                 ->paginate($number_user_list);
                //     }else{
                        
                //         $active_all_user = User::
                //                                 join('event_organizations','event_organizations.user_id', '=',	'users.id')
                //                                 ->where([['users.rolewise', '=', 'cyclothon-2024']])
                //                                 ->orWhere('users.role','=' , 'namo-fit-india-cycling-club')
                //                                 ->paginate($number_user_list);
                        
                //     }
                //     // dd($user_id);

                //     $active_all_participantnum = User::
                //                             join('event_organizations','event_organizations.user_id', '=',	'users.id')
                //                             ->where([['users.rolewise', '=', 'cyclothon-2024']])
                //                             ->orWhere('users.role','=' , 'namo-fit-india-cycling-club')
                //                             ->select(DB::raw('SUM(IFNULL(event_organizations.participantnum, 0)) as participantnum'))
                //                             ->get();

                //                             // $data_points = DB::select("SELECT sum(ifnull(on_c.point, 0) + ifnull(ur.score, 0)) as point FROM `users` as us LEFT JOIN ongoing_challengers as on_c on us.id = on_c.user_id LEFT JOIN user_ranks ur on ur.user_id = us.id LEFT JOIN challenger_masters cm on cm.id = on_c.challenger_id WHERE us.id = $user_id;")
                //     $participantnum_count = (int)$active_all_participantnum[0]['participantnum'];
                //     $total_count = $participantnum_count + count($active_all_user);

                //     $all_data = array (
                //         // "active_user_count" => count($active_user),
                //         "title_text" => "Leaderboard",
                //         "total_count" => $total_count,
                //         "all_user" => $active_all_user,
                //     );
                //     // dd((int)$active_all_participantnum['participantnum']);

                //     if($active_all_user->count() > 0){
                //         return Response::json(array(
                //             'status'    => 'success',
                //             'code'      =>  200,
                //             'message'   =>  null,
                //             'data'      => $all_data,
                //         ), 200);
                        
                //     }else{
                //         $all_data = array (
                //             // "active_user_count" => count($active_user),
                //             "title_text" => "Leaderboard",
                //             "total_count" => "--",
                //             "all_user" => "Data not found",
                //         );
                //         return Response::json(array(
                //             'status'    => 'error',
                //             'code'      =>  200,
                //             'message'   =>  $all_data,
                //             'data'   => null,
                //         ), 401);
                //     }
                    
                // }else{

                //     return Response::json(array(
                //         'status'    => 'error',
                //         'code'      =>  801,
                //         'message'   =>  'Unauthorized'
                //     ), 401);
    
                // }
                            
            } catch(Exception $e) {

                $controller_name = 'WeekendcycleeventsController';
                $function_name = 'search_userid_event';
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
    
    public function user_details_event(Request $request){
        
        try{

                // dd("123456");
                $user = auth('api')->user();
                
                if($user){ 

                    $user_id = $request->user_id;                    
                    $event_id = $request->event_id;                    
                    $date = $request->date;                    
                    // dd( $user_id);
                    $data = DB::table('users as u')
                                ->join('userhistorytrakings as uh', 'u.id', '=', 'uh.user_id')
                                ->join('event_organizations as eo', 'eo.user_id', '=', 'u.id')
                                ->select(
                                    'u.name',
                                    // 'eo.id',
                                    DB::raw('SUM(uh.duration) as total_duration'),
                                    DB::raw('SUM(uh.distance) as total_distance'),
                                    'uh.uom',
                                    'uh.modegroupid',
                                    // 'eo.state',
                                    'eo.event_bg_image',
                                    DB::raw('DATE(uh.created_by) as created_date')
                                )
                                ->where('u.id', $user_id)
                                // ->where('eo.id', $event_id)
                                ->where('uh.created_by', '>=', '2024-12-17 00:00:01')
                                ->where('uh.modegroupid', 2)
                                // ->whereDate('uh.created_by', '2025-01-08')
                                // ->whereDate('uh.created_by', $date)
                                // ->groupBy('eo.state','u.name', 'eo.id', 'uh.uom', 'uh.modegroupid', DB::raw('DATE(uh.created_by)'))
                                ->groupBy('u.name', 'uh.uom', 'uh.modegroupid','eo.event_bg_image', DB::raw('DATE(uh.created_by)'))
                                ->get();
                    
                    if($data->count() > 0){
                        // dd($data);
                        // foreach($data as $key => $value){
                        //     // dd($value);
                        //     // dd($value->id);
                        //     // dd($value->creation_date);
                        //     $end_date_format = $start_date_format = $value->creation_date;
                        //     // $data_insert = $this->insert_event_organizations($user_id, $start_date_format, $end_date_format);
                        // }
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

                $controller_name = 'WeekendcycleeventsController';
                $function_name = 'user_details_event';
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
