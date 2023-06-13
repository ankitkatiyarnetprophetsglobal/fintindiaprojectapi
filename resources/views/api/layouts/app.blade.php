<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts 
    <script src="{{ asset('public/js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
     -->
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
    <link rel="stylesheet" href="{{ asset('resources/css/dashboard.min.css') }}">

</head>
<body>
    
<div class="container-fluid">
	<!-- Top Header Bar -->
   
	<!-- Top Header Bar end-->
	
	
    <!-- Header -->
		
	<!-- Header end -->
	 
    <!-- Content section -->
        @yield('content')
	<!-- Content section end-->	  
		  
    <!-- Footer -->
		
	<!-- Footer end-->
	
</div>	
</body>
</html>
