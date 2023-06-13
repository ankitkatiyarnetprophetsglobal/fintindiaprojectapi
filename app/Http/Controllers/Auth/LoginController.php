<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Event;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
	
	  protected function redirectTo()
    {
		$events = Event::where( 'user_id', auth()->user()->id )->count();
		
        if (auth()->user()->role == 'school') {
			if(!empty($events)){
				return '/my-events';
			}else{
				return '/fit-india-school-certification';
			}
		}
		
		if (auth()->user()->role == 'youthclub') {
			if(!empty($events)){
				return '/my-events';
			}else{
				return '/fit-india-youth-club-certificate';
			}
		}
		
		
        return '/dashboard';
    }
	

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
