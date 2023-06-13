<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Login</title>

   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="{{ asset('resources/css/style.css') }}" rel="stylesheet">
    
    <link rel="icon" href="{{ asset('resources/images/fit-fav.ico') }}" sizes="32x32" />
    <link rel="icon" href="{{ asset('resources/images/fit-fav.ico') }}" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('resources/images/fit-fav.ico') }}" />
    <meta name="msapplication-TileImage" content="{{ asset('resources/images/fit-fav.ico') }}" />

</head>
<body>
    
<div class="container-fluid">

	<!-- Top Header Bar -->
    <div id="top-header">
        <div class="top-header_Flex">
            <div class="top_head_item"> 
                &nbsp;
            </div>
          <div class="log_reg">
            <div class="log_reg log_status">
				
				
				
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ route('dashboard') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right top-bar-li" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('dashboard') }}" >
                                        {{ __('My Account') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
               
				
				
            </div>
          </div>
        </div>
    </div>
	<!-- Top Header Bar end-->
	
	
    <!-- Header -->
	
	<!-- Header end -->
	 
    <!-- Content section -->
    <section>
  <div class="container">
    <div class="row">
      <div class="col-12 signup_frm">
         <div class="frontlogin">
            <form action="{{ route('admin.postlogin') }}" method="POST" id="frontadmin" novalidate="novalidate">	
				@csrf			
                

                @if (session('status'))
                            <div class="alert alert-danger">
                                {{ session('msg') }}
                            </div>
                @endif

               <div class="frm-details">
                 <h1>{{ __('Login') }}</h1>               
                 
                 <div class="login-row"> 
                    <label for="username">Email / Username</label>
					<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
								
                 </div>
                 
                 <div class="login-row">&nbsp;</div>
                 <div class="login-row"> 
					<label for="password">Password</label>
					<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
								
                </div>
				  
                
				 
                <div class="login-row">&nbsp;</div>
				<div class="login-row">
                            
                                <div class="">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            
                </div>
						
						
                 <input class="submit_button" type="submit" value="LOGIN">

               </div>  
               </form>
			   
         </div>
      </div>
    </div>

  </div>
 
</section>
	<!-- Content section end-->	  
		  
   
	
</div>	
</body>
</html>
