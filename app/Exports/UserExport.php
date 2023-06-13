<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Usermeta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class UserExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function collection()
    {
        if((request()->has('uname') || request()->has('st')) || (request()->has('dst') || request()->has('month')) || (request()->has('blk') || request()->has('role'))) {

            return collect(User:: getAllSearch());

        } 
        else{ 

          return collect(User::getAllUser());
		}
    }
    public function headings():array{
		return[
			'ID',
			'Name',
			'Email',
			'Role',
			'Mobile',
			'City',
			'State',
			'District',
			'Block'
		];
	}
    
}
