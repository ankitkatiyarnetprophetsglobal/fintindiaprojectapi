@extends('api.layouts.app')
    <link rel="stylesheet" href="{{ URL::asset('resources/css/component.css') }}">

    <section>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h2 class="heading">Your Stories</h2>
            <p class="text-center">Stories have the power to inspire and empower. We’re collecting stories of your Fitness experiences.</p>
            <div class="et_pb_button_module_wrapper ">
                <a class="et_pb_button" href="share-your-story">Share Your Story</a>
            </div>
        </div>
        </div>
        
          <div class="row" style="display: block;">
            <ul class="grid effect-2" id="grid">
            <li>
            <a href="javascript:void(0)">
            <div class="shar_div shadow">
              <img src="{{ URL::asset('resources/imgs/home/Sardar-Gurbachan-Singh_Hockey-Olympian-400x250.jpg') }}" />
              <h3>Sardar Gurbachan Singh, Hockey Olympian (1964,1968) & had been Coach of 1976 Indian Olympics</h3>
              </a>
              <div class="shar_div_inner inner_span">            
                <span>by </span>
                <span><a href="https://fitindia.gov.in/author/fitindia/">fitindia</a></span> | <span>Aug 27, 2019</span>
              </div>
          </div>
             
            </li>
            <li>
              <a href="javascript:void(0)">
              <div  class="shar_div shadow"> 
                <img src="{{ URL::asset('resources/imgs/home/Surya_Namaskar-400x250.jpg') }}" />
                  <h3>Daily Routine of Surya Namaskar and Cardio, 85+ years</h3>
                  </a>
                  <div class="shar_div_inner inner_span">            
                    <span>by </span><span><a href="https://fitindia.gov.in/author/fitindia/">fitindia</a></span> | <span>Aug 27, 2019</span>
                  </div>           
              </div>
            </li>
            <li>
              <a href="javascript:void(0)">
              <div  class="shar_div shadow"> 
                <img src="{{ URL::asset('resources/imgs/home/T_A_ANGAPPAN-400x250.jpg') }}" />
                <h3>T.A ANGAPPAN , AGE 88</h3>
                </a>
                <div class="shar_div_inner inner_span">            
                  <span>by </span><span><a href="https://fitindia.gov.in/author/fitindia/">fitindia</a></span> | <span>Aug 27, 2019</span>
                </div>
               </div>
            </li>
            <li>
              <a href="javascript:void(0)">
              <div  class="shar_div shadow"> 
                <img src="{{ URL::asset('resources/imgs/home/Cycling_Rajpath-400x250.jpg') }}" />
                <h3>Fitness Enthusiasts – Cycling on Rajpath</h3>
                </a>
                <div class="shar_div_inner inner_span">            
                  <span>by </span><span><a href="https://fitindia.gov.in/author/fitindia/">fitindia</a></span> | <span>Aug 27, 2019</span>
                </div>
              </div>
            </li>
            <li>
              <a href="javascript:void(0)">
              <div class="shar_div shadow">
                <img src="{{ URL::asset('resources/imgs/home/Lawn_Tennis-400x250.jpg') }}" />
                  <h3>Mr Avinash Chandra Seth born in 1940 playing Lawn Tennis</h3>
                  </a>
                  <div class="shar_div_inner inner_span">            
                    <span>by </span><span><a href="https://fitindia.gov.in/author/fitindia/">fitindia</a></span> | <span>Aug 27, 2019</span>
                  </div>
              </div>
            </li>
            <li>
              <a href="javascript:void(0)">
              <div class="shar_div shadow">
                <img src="{{ URL::asset('resources/imgs/home/Baljit-Singh_Architect-400x250.jpg') }}" />
                  <h3>Shri Balkrishnarao Bhoshe, 100th Year Running</h3>
                  </a>
                  <div class="shar_div_inner inner_span">            
                    <span>by </span><span><a href="https://fitindia.gov.in/author/fitindia/">fitindia</a></span> | <span>Aug 27, 2019</span>
                  </div>
              </div>
            </li>
            <li>
              <a href="javascript:void(0)">
              <div class="shar_div shadow">
                <img src="{{ URL::asset('resources/imgs/home/Krishna-Kumar_Bhattacharya-400x250.jpg') }}" />
                  <h3>Krishna Kumar Bhattacharya, 87</h3>
                  </a>
                  <div class="shar_div_inner inner_span">            
                    <span>by </span><span><a href="https://fitindia.gov.in/author/fitindia/">fitindia</a></span> | <span>Aug 27, 2019</span>
                  </div>
              </div>
            </li>
            <li>
              <a href="javascript:void(0)">
              <div class="shar_div shadow">
                <img src="{{ URL::asset('resources/imgs/home/Siddhant-Raguram_Lawyer-400x250.jpg') }}" />
                  <h3>Siddhant Raguram, Lawyer</h3>
                  </a>
                  <div class="shar_div_inner inner_span">            
                    <span>by </span><span><a href="https://fitindia.gov.in/author/fitindia/">fitindia</a></span> | <span>Aug 27, 2019</span>
                  </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="see_area ">
          <a class="seemore shadow_O sys" href="share-your-story">Share Your Story</a>
        </div>
    </div>
    </section>
    <script src="{{ URL::asset('resources/js/modernizr.custom.js') }}"></script>
    <script src="{{ URL::asset('resources/js/masonry.pkgd.min.js') }}"></script>
    <script src="{{ URL::asset('resources/js/imagesloaded.js') }}"></script>
    <script src="{{ URL::asset('resources/js/classic.js') }}"></script>
    <script src="{{ URL::asset('resources/js/imagescroll.js') }}"></script>
      
    <script>
        new AnimOnScroll( document.getElementById( 'grid' ), {
        minDuration : 0.4,
        maxDuration : 0.7,
        viewportFactor : 0.2
      });
      var $grid = $('.grid').masonry({
      });
    </script>