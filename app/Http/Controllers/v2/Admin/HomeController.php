<?php

namespace App\Http\Controllers\v2\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


class HomeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        return view('admin.home');
    }
	

   

}
