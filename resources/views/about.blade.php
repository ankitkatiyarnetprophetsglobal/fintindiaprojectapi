@extends('layouts.app')
@section('title', 'About Us | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<div id="{{ $active_section_id }}">
<div>
   <img src="{{ asset('resources/imgs/about/about-fitindia.jpg') }}" alt="about-fitindia" class="img-fluid expand_img"/>
</div>

<section>
        <div class="container">
            <div class="row r-m">
                <div class="col-sm-12 col-md-12 r-m">
                    <h2 class="a_heading">What is Fit India Movement?​</h2>
                    <p>The Fit India Movement is a movement to take the nation on a path of fitness and wellness. It provides a unique and exciting opportunity to work towards a healthier India. As part of the movement, individuals and organisations can undertake various efforts for their own health and well-being as well as for the health and well-being of fellow Indians.</p>
                </div>
                <div class="down_lo">
                    <a class="" href="{{asset('wp-content/uploads/2021/01/FITIndia_Logo_Guidelines.pdf') }}" target="_blank">Download Logo Guidelines</a>
                </div>
            </div>
    

    
        <div class="row r-m">
            <div class="col-sm-12 col-md-12 r-m">
                <h2 class=" m-60 m-bot-40">Launch of Fit India Movement by Shri Narendra Modi on 29th August, 2019</h2>
              
            </div>
            <div class="row">
                <div class="col-sm-6 ">
                    <div class="et_pb_video_box">
                    <video controls="">
                        <source type="video/mp4" src="https://fitindia.gov.in/wp-content/uploads/2019/09/WhatsApp-Video-2019-09-10-at-09.04.17-1.mp4">
                        
                    </video>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="et_pb_video_box">
                    <video controls="">
                        <source type="video/mp4" src="https://fitindia.gov.in/wp-content/uploads/2019/09/WhatsApp-Video-2019-09-10-at-09.04.17.mp4">
                        
                    </video>
                    </div>
                </div>
                </div>
            </div>
    </div>
</section>
</div>
@endsection