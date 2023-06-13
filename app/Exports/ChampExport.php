<?php

namespace App\Exports;

use App\Models\Champion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class ChampExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if(!empty(request()->has('s')))
        {
            return collect(Champion::getAllSearch());
        }
        else
        {
        return collect(Champion::getAllChamp());
        }
    }
    public function headings(): array
    {
        /*return[
           'name','email','contact','state_name','district_name','block_name','pincode','facebook_profile','twitter_profile','instagram_profile',
        ];*/
        return[
           'name','email','contact','designation', 'state_name','district_name','block_name','pincode','facebook_profile','facebook_profile_followers', 'twitter_profile','twitter_profile_followers','instagram_profile','instagram_profile_followers','work_profession','description','application_status','created_at','updated_by'
        ];
    }
   
    

}