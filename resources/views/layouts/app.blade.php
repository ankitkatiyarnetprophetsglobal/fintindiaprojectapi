<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="twitter:card" value="summary">

    <!-- CSRF Token  -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="msapplication-TileImage" content="{{ asset('resources/images/fit-fav.ico') }}" />
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('resources/images/fit-fav.ico') }}" sizes="32x32"  />
    <link rel="icon" href="{{ asset('resources/images/fit-fav.ico') }}" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('resources/images/fit-fav.ico') }}" />

    <!-- <link rel="stylesheet" href="{{ asset('resources/fonts/bootstrap.min.css') }}" media="screen"> -->
    <link rel="stylesheet" href="{{ asset('resources/css/bootstrap.min.css') }}" media="screen">  
    <link rel="stylesheet" href="{{ asset('resources/css/font-awesome.css') }}" media="screen"> 
   
    <link rel="stylesheet" href="{{ asset('resources/css/dashboard.min.css') }}" media="screen">
    <!-- <link href="{{ asset('resources/css/print.min.css') }}" rel="stylesheet" media="all">   -->
    <link href="{{ asset('resources/css/style.css') }}" rel="stylesheet" media="all">   
    <link href="{{ asset('resources/css/responsive.css') }}" rel="stylesheet" media="screen"> 
    <link href="{{ asset('resources/css/print.css') }}" rel="stylesheet" media="print">  
     

<script src="{{ asset('resources/js/jquery.min.js')}}"></script>
<script src="{{ asset('resources/js/popper.min.js')}}"></script>


</head>
<body>
    @if( request()->has('m')) 
	<style>
		#top-header_web, .header, .menu-bar, #footer_ab, .cust_navbar_mob{ display:none; }
	</style>
	@endif
<div class="container-fluid" id="@yield('pageid')">
    <div class="cust_navbar_mob"><p>Assessiblity Options</p></div>
    <!-- Top Header Bar -->
    <div id="top-header">
        <div class="top-header_Flex">
            <div class="top_head_item"> 
                <a href="schooldashboard">Fit India Dashboard</a>
               <!--  <a href="fit-india-school-week-2020">Fit India School Week</a>
                <a href="fit-india-cyclothon-2020">Fit India Cyclothon</a> -->
            </div>

            
            @php
                $active_section = request()->segment(count(request()->segments()));
                $active_section_id = "id='$active_section'";
            @endphp
          <div class="log_reg">
            <div class="log_reg log_status">
                    <ul class="navbar-nav ml-auto cust_navbar">

                    <li class="nav-item"> <a href="{{ url('screen-reader-access') }}">Screen Reader Access</a></li>
                    <li class="nav-item"> <a href="#{{$active_section}}">Skip to Main Content</a></li>
                    <li class="nav-item resizable"> <a href="Javascript:void(0);" id="increaseFont" >A+</a></li>
                    <li class="nav-item resizable"> <a href="Javascript:void(0);" id="resetFont" >A</a></li>
                    <li class="nav-item resizable"> <a href="Javascript:void(0);" id="decreaseFont">A-</a></li>
                    <li class="nav-item contra resizable">
                        <STRONG ><sub>T</sub><sup>T</sup></STRONG>
                        <ul class="dropItm">
                            <li class="l_contrast">Contrast</li>
                            <li class="h_contrast">High Contrast</li>
                        </ul>
                    </li>
                     <li class="nav-item"> <a href="Javascript:void(0);" onclick="printFile()">Print</a></li>     
                    <!-- <li class="nav-item hin"> <a href="Javascript:void(0);" onclick="loadFont()"> हिंदी</a></li> -->
                        <!-- Authentication Links -->
                        @guest

                                <li class="nav-item l_area">
                                @if (Route::has('login'))
                                    <span><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}|</a></span>
                                @endif
                                @if (Route::has('register'))
                                    <span><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></span>
                                    @endif
                                </li>
                            
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ url('dashboard') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right top-bar-li cus_drop " aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('dashboard') }}" >
                                        {{ __('My Account') }}
                                    </a>
									@if(Auth::user()->role == 'school')
									<a class="dropdown-item" href="{{ url('school-profile') }}/{{ Auth::user()->id }}">
                                        {{ __('Edit Profile') }}
                                    </a>
									@else
                                    <a class="dropdown-item" href="{{ url('edit-profile') }}/{{ Auth::user()->id }}">
                                        {{ __('Edit Profile') }}
                                    </a>
									@endif
                                    <a class="dropdown-item last_child" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     logoutfn();" >
									<!--
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" 
													 -->
													 
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
<script>




function logoutfn(){
	var z = confirm("Are you sure to logout?");
	if (z == true) {
		document.getElementById('logout-form').submit();
	}
}


</script>
<script>
$('a[href*="#"]').on('click', function (e) {
    e.preventDefault();

    $('html, body').animate({
        scrollTop: $($(this).attr('href')).offset().top
    }, 500, 'linear');
});


$(document).ready(function(){

   $(".cust_navbar_mob").click(function(){
    $("#top-header").toggle("fast")
   })
})


function printFile(){
    window.print();return false;
}

    $(document).ready(function(){
        $('.h_contrast').click(function(){
            addCSS('./resources/css/contract.css');       
        })
   
    $('.l_contrast').click(function(){
        $('#cont_id').remove();
    })

    // $('#increaseFont').click(function() {
    //     $('body').css("font-size", function() {
    //         return parseInt($(this).css('font-size')) + 18 + 'px';
    //     });
    // });



    var resize = new Array('p,a', '.resizable');
  resize = resize.join(',');

  //resets the font size when "reset" is clicked
  var resetFont = $(resize).css('font-size');
  $("#resetFont").click(function() {
    $(resize).css('font-size', resetFont);
    $('.log_reg a').css('font-size', '12px');
    $('.top_head_item a').css('font-size', '12px');
    $('.panel-title a').css('font-size', '18px');
    $('p').css('font-size', '14px');
    $('body').css('font-size', '14px');
   

    return false;
      
    
  });

  //increases font size when "+" is clicked
  $("#increaseFont").click(function() {
    var originalFontSize = $(resize).css('font-size');
    var originalFontNumber = parseFloat(originalFontSize, 10);
    var newFontSize = originalFontNumber * 1.2;
    $(resize).css('font-size', newFontSize);
    return false;
  });

  //decrease font size when "-" is clicked

  $("#decreaseFont").click(function() {
    var originalFontSize = $(resize).css('font-size');
    var originalFontNumber = parseFloat(originalFontSize, 10);
    var newFontSize = originalFontNumber *0.8;
    $(resize).css('font-size', newFontSize);
    return false;
  });

})   // Include CSS file
        function addCSS(filename){
        var head = document.getElementsByTagName('head')[0];
        var style = document.createElement('link');
        style.href = filename;
        style.type = 'text/css';
        style.id   ='cont_id'
        style.rel = 'stylesheet';
        head.append(style);
        
        }


        $(document).ready(function(){

            // $('#navbarDropdown').hover(function(){

            //      $('.cus_drop').toggle();
               

            // })

        })
</script>
    
    
    <!-- Header -->
        @include('layouts.header')
    <!-- Header end -->
     
    <!-- Content section -->
        @yield('content')
        

    <!-- Content section end-->   
          
    <!-- Footer -->
        @include('layouts.footer')
    <!-- Footer end-->
    
</div> 

<script> 
function loadFont(){

        // var junction_font = new FontFace('hindi', 'url(./resources/fonts/KRDEV010.TTF)');

        // junction_font.load().then(function(loaded_face) {
        //     document.fonts.add(loaded_face);
        //     alert("rk")
        //     document.body.style.fontFamily = '"hindi"';
        // }).catch(function(error) {
          
        // });
    }

</script> 
</body>
</html>
