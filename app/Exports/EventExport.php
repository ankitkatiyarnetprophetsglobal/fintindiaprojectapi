<?php
namespace App\Exports;
use App\Models\Event;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class EventExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        if(request()->has('ename') || request()->has('st') || request()->has('dst')|| request()->has('dbk')|| request()->has('cat')|| request()->has('dat')){

            return collect(Event::getAllSearch());

        }  else { 

          return collect(Event::getAllEvent());
       }
    }
   
    public function headings(): array
    {
        return[
            'Event_Name','Mobile','Email','Event_Date','KM','Participants','State','District','Block'
        ];
		
    } 
}