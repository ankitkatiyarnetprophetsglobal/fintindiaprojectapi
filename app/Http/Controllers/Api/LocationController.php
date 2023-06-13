<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Response;
use Illuminate\Support\Facades\Auth;
use App\Models\State; 
use App\Models\District;
use App\Models\Block;

class LocationController extends Controller
{
    
    public function index()
    {
		
		$jsonarr = array();
		$stateterms = State::all()->toArray();
		foreach($stateterms as $stateterm){
			$jsonarr[] = array('value' => $stateterm['name'], 'id' => $stateterm['id'], 'type'=> 1, 'parentid'=> 0 );
			$districtterms = District::where('state_id', $stateterm['id'])->get()->toArray();
			
			foreach($districtterms as $districtterm){
				$jsonarr[] = array(	'value' => $districtterm['name'], 'id' => $districtterm['id'], 'type' => 2, 'parentid'=> $stateterm['id'] );
				
				$blockterms = Block::where('district_id', $districtterm['id'])->get()->toArray();
				foreach($blockterms as $blockterm){
					$jsonarr[] = array(	'value' => $blockterm['name'], 'id' => $blockterm['id'], 'type'=> 3,
								'parentid'=> $districtterm['id'] );
				}
				
			}
		}
		
		$jsondata = array('Data' => $jsonarr);
		$jsondata = json_encode($jsondata);
		return $jsondata;
    }

   
}
