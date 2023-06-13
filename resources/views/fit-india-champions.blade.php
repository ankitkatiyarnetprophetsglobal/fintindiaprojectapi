@extends('layouts.app')
@section('title', 'Fit India Champions | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<div class="container-fluid"> 
    <div>
        <img src="{{asset('wp-content/uploads/2021/01/champions-bannerdhjwehfjhwfu.png') }}" class="fluid-img">
    </div>
</div>
<div class="container"> 
<section id="{{ $active_section_id }}">
    <div class="row ">
        <div class="col-sm-12 ahover">
            <a href = "{{asset('wp-content/uploads/2021/01/Guidelines-for-Fit-India-Champion.pdf') }}" class="og_btn" target="_blank">Guidelines of Fit India Champion</a>
            <a href ="champion" class="gr_btn" target="_blank">Register for Fit India Champion</a>
           <div class="m-40"></div>
        </div>
         <div class="col-sm-12">
            <p>With the aim of making fitness a priority for all citizens, Fit India Mission office has decided to join hands with well-known names from all walks of life and encourage people to bring about a behavioural change in their lives.</p>
            <p>With this, we aim to connect with well-known faces from different parts of the country, who will not only make fitness as a priority in their lives but also motivate others to do so.</p>
            <p>To honour their dedication and commitment towards our mission, we recognize them as Fit India Champion.</p>
            <br><br>
        </div>
        <br>
    </div>
    <div class="row">
        <div class="col-md-12 ">
             @if(!empty($all_champion))
                @foreach($all_champion as $champion_value)
                     <div class="amb-dv">
                        <div class="amb-colm">
                        <div class="amb-rw">
                                <div class="amb-pic"> 
                                     <img src="{{ $champion_value->image }}" alt="{{ $champion_value->name }}" title="{{ $champion_value->name }}" class="fluid-img">
                                </div>
                                <div class="amb-details">
                                    <p class="amb-name">{{ $champion_value->name }}</p>
                                    <p class="amb-desig">{{ $champion_value->designation }}</p>
                                    <p class="amb-state">{{ $champion_value->state_name }}</p>
                                    <p class="amb-social-dv">
                                        <a class="fb-i"href="{{ $champion_value->facebook_profile }}" target="_blank" rel="facebook"></a>
                                        <a class="twt-i" href="{{ $champion_value->twitter_profile }}" target="_blank" rel="twitter"></a>
                                    <a class="insta-i" href="{{ $champion_value->instagram_profile }}" target="_blank" rel="instragram"></a>
                                    </p>
                                </div>
                            </div>
                    </div>
                    </div>
                @endforeach
            @endif
<!-- 
            <div class="amb_area">
                <div class="d-flex">
                        <div> 
                            <img src="https://fitindia.gov.in/wp-content/uploads/2021/01/Mickey-Mehta.jpg" alt="Luke-Coutinho" title="Luke Coutinho" class="fluid-img">
                        </div>
                        <div class="amb-details">
                            <p>Mickey Mehta</p>
                            <p>Holistic Health Guru</p>
                            <p>Maharashtra</p>
                            <p class="amb-social-dv">
                                <a class="font_f_r f_c" href="https://www.facebook.com/LukeCoutinhoOfficial/" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a class="font_f_r t_c" href="https://twitter.com/LukeCoutinho17" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a class="font_f_r i_c" href="https://www.instagram.com/luke_coutinho/" target="_blank" rel="noopener noreferrer"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </p>
                        </div>
                    </div>
            </div> -->

         <!--    <div class="amb_area">
                <div class="d-flex">
                        <div> 
                            <img src="https://fitindia.gov.in/wp-content/uploads/2021/01/Shweta-Rathore.jpg" alt="Luke-Coutinho" title="Luke Coutinho" class="fluid-img">
                        </div>
                        <div class="amb-details">
                            <p>Shweta Rathore</p>
                            <p>Miss World Fitness</p>
                            <p>Maharashtra</p>
                            <p class="amb-social-dv">
                                <a class="font_f_r f_c" href="https://www.facebook.com/LukeCoutinhoOfficial/" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a class="font_f_r t_c" href="https://twitter.com/LukeCoutinho17" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a class="font_f_r i_c" href="https://www.instagram.com/luke_coutinho/" target="_blank" rel="noopener noreferrer"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </p>
                        </div>
                    </div>
            </div> -->


        </div>
       
    </div>
  
</section>
</div>
@endsection