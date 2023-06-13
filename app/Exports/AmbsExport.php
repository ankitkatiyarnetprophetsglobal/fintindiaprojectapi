<?php

namespace App\Exports;

use App\Models\Ambassador;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class AmbsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if(!empty(request()->has('s')))
        {
            return collect(Ambassador::getAllSearch());
        }
        else
        {
        return collect(Ambassador::getAllambs());
        }
    }
    public function headings(): array
    {
        return[
           'name','email','contact','designation', 'state_name','district_name','block_name','pincode','facebook_profile','facebook_profile_followers', 'twitter_profile','twitter_profile_followers','instagram_profile','instagram_profile_followers','work_profession','description','application_status','created_at','updated_by'
        ];
    }
   
    

}