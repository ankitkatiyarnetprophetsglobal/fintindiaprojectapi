<?php
namespace App\Exports;
use App\Models\Youth;
use App\Models\YouthStatus;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class YouthExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
	
    public function collection()
    {
        if(request()->has('s') || request()->has('st') || request()->has('dst')|| request()->has('dbk')) {

            return collect(Youth::getAllSearch());

        }  else { 

          return collect(Youth::getAllYouth());
       }
    }
	
    public function headings(): array
    {
        return[
            'Club Name','User Email','State','District','Block','Status'
        ];
    }    

}