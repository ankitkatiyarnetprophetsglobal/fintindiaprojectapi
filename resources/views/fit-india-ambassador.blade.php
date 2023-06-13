@extends('layouts.app')
@section('title', 'Fit India Ambassador | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<div class="container-fluid"> 
    <div>
        <img src="{{asset('wp-content/uploads/2021/01/Ambassador-banner.jpg') }}" class="fluid-img">
    </div>
</div>
<div class="container"> 
<section id="{{ $active_section_id }}">
    <div class="row ">
        <div class="col-sm-12 ahover">
            <a href ="{{asset('wp-content/uploads/2021/01/Guidelines-for-Fit-India-Ambassador.pdf') }}" class="og_btn" target="_blank">Guidelines of Fit India Ambassador</a>
            <a href ="ambassador" class="gr_btn" target="_blank">Register for Fit India Ambassador</a>
           <div class="m-40"></div>
        </div>
         <div class="col-sm-12">
        <p>With the aim of making fitness a priority for all citizens, Fit India Mission office has decided to join hands with well-known names from all walks of life and encourage people to bring about a behavioural change in their lives.</p>
        <p>With this, we aim to connect with well-known faces from different parts of the country, who will not only make fitness as a priority in their lives but also motivate others to do so.</p>
        <p>To honour their dedication and commitment towards our mission, we recognize them as Fit India Ambassadors.</p>
        <br><br>
</div>
        <br>
    </div>

   <div class="row">
        <div class="col-md-12 ">
            @if(!empty($all_ambassador))
                @foreach($all_ambassador as $amb_values)
                    <div class="amb-dv">
                        <div class="amb-colm">
                        <div class="amb-rw">
                                <div class="amb-pic"> 
                                    <img src="{{ $amb_values->image }}" alt="Luke-Coutinho" title="Luke Coutinho" class="fluid-img">
                                </div>
                                <div class="amb-details">
                                    <p class="amb-name">{{ $amb_values->name }}</p>
                                    <p class="amb-desig">{{ $amb_values->designation }}</p>
                                    <p class="amb-state">{{ $amb_values->state_name }}</p>
                                    <p class="amb-social-dv">
                                        <a class="fb-i" href="{{ $amb_values->facebook_profile }}" target="_blank" rel="facebook"></a>
                                        <a class="twt-i" href="{{ $amb_values->twitter_profile }}" target="_blank" rel="twitter"></a>
                                        <a class="insta-i" href="{{ $amb_values->instagram_profile }}" target="_blank" rel="instragram"></a>
                                    </p>
                                </div>
                            </div>
                    </div>
                    </div>
                @endforeach
            @endif

            <!-- <div class="amb_area">
                <div class="d-flex">
                        <div> 
                            <img src="https://fitindia.gov.in/wp-content/uploads/2021/01/Ankita-Raina.jpg" alt="Luke-Coutinho" title="Luke Coutinho" class="fluid-img">
                        </div>
                        <div class="amb-details">
                            <p>Ankita-Raina</p>
                            <p>Indian Tennis Player</p>
                            <p>Gujarat</p>
                            <p class="amb-social-dv">
                                <a class="font_f_r f_c" href="https://www.facebook.com/Ankita-Raina-378053758986611/" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a class="font_f_r t_c" href="https://twitter.com/ankita_champ" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a class="font_f_r i_c" href="https://www.instagram.com/ankitaraina_official/?hl=en" target="_blank" rel="noopener noreferrer"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </p>
                        </div>
                    </div>
            </div> -->

          <!--   <div class="amb_area">
                <div class="d-flex">
                        <div> 
                            <img src="https://fitindia.gov.in/wp-content/uploads/2021/01/Ronak-Gajjar.jpg" alt="Ronak-Gajjar" title="Ronak Gajjar" class="fluid-img">
                        </div>
                        <div class="amb-details">
                            <p>Ronak Gajjar</p>
                            <p>Meditation Expert</p>
                            <p>Maharashtra</p>
                            <p class="amb-social-dv">
                                <a class="font_f_r f_c" href="https://www.facebook.com/ironakgajjar" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a class="font_f_r t_c" href="https://twitter.com/ironakgajjar" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a class="font_f_r i_c" href="https://instagram.com/ironakgajjar?igshid=72ue93hbt8ux" target="_blank" rel="noopener noreferrer"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </p>
                        </div>
                    </div>
    
            </div> -->
            <br>
            <br>
        </div>
    </div>
</section>
</div>
@endsection