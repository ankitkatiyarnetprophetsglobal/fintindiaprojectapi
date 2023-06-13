<?php
namespace App\Exports;
use App\Models\CertStatus;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class CertExport implements FromCollection,WithHeadings
{
  
	
    public function collection(){
      
       if( !empty(request()->input('name') ) || !empty(request()->input('state')) || !empty(request()->input('dst')) || !empty(request()->input('blk')) || !empty(request()->input('month')) || !empty(request()->input('cert')) ){
			
			return collect(CertStatus::getAllSearch());

        }  else { 
		
			return collect(CertStatus::getAllCert());
       }
    }
	
    public function headings(): array
    {
        return[
            'School_Name','Email','Phone','State','District','Block','Type', 'Status', 'CreatedOn'
        ];
    }    

}