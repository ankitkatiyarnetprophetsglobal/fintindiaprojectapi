<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Auth;

class Event extends Model
{
    use HasFactory;

   public static function getAllEvent(){

        $rolename=Auth::user()->role;
        $statename=Auth::user()->state;
        //dd($statename);
            
        $result = Event::select('events.category',
                    'events.name','events.eventstartdate','events.eventenddate','events.organiser_name',
                    'events.participantnum','events.kmrun','users.name','users.email')
                ->join('users','events.user_id','=','users.id') 
                ->join('usermetas','events.user_id', '=', 'usermetas.user_id')
                ->join('states','usermetas.state', '=', 'states.name'); 
                //->join('users','events.user_id','=','users.id');

                if($statename){
                
                   $result = $result->where('states.id', 'LIKE', "%".$statename."%");
                }

               return $result=$result->get();                  
                //->get();
                //return $result;    
    }


    public static function getAllSearch(){
        
        $rolename=Auth::user()->role;
        $statename=Auth::user()->state;
        //dd($statename);
         //dd(Auth::user()->id);

        $search_txt = request()->input('s');

        $result = Event::select('events.category',
                'events.name','events.eventstartdate','events.eventenddate','events.organiser_name',
                'events.participantnum','events.kmrun','users.email')
                ->join('users','events.user_id','=','users.id') 
                ->join('usermetas','events.user_id', '=', 'usermetas.user_id')
                ->join('states','usermetas.state', '=', 'states.name'); 
            //->join('users','events.user_id','=','users.id');
            //->where('users.email','LIKE','%'.$search_txt.'%')
            //->get();

        if($search_txt){

           $result = $result->where('users.email', 'LIKE', "%".$search_txt."%");
        }

        if($statename){

           $result = $result->where('states.id', 'LIKE', "%".$statename."%");
        }                   


       return $result=$result->get(); 




        /*if(request()->input('search')=='search')
        {
            $search_txt = request()->input('s');
            
            
            $result = Event::select('events.category',
                        'events.name','events.eventstartdate','events.eventenddate','events.organiser_name',
                        'events.participantnum','events.kmrun','users.email')
                    ->join('users','events.user_id','=','users.id')
                    ->where('users.email','LIKE','%'.$search_txt.'%')
                    ->get();
           
           
            return $result;        
        }*/

    }
}

