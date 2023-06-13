@extends('layouts.app')
@section('title', 'covid-19-info | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<section id="{{ $active_section_id }}">
  <div class="container">
      <div class="row">
        <div class="col-sm-12">
            <h2 class="text-center">PM Modi asks people to follow these easy steps to avoid spreading coronavirus…</h2>
        <br>
        </div>
      </div>
      <div class="row  covid" >
        <div class="col-sm-12 col-md-4 col-lg-4">
        <a href="https://www.youtube.com/watch?v=PTaeZggiMrM&amp;feature=emb_title">   
        <img src="https://fitindia.gov.in/wp-content/uploads/2020/03/covid-19_video.jpg" alt="PM Modi - Covid-19 Video" class="fluid-img">
        </a>
    </div> 
        <div class="col-sm-12 col-md-8">
            <h4>Here are the simple steps which PM Modi asked citizens to follow:</h4>
            <ol type="1" class="olist">
                <li>Stay away from huge gatherings as much possible.</li>
                <li>Wash your hands properly with soap.</li>
                <li>Avoid touching your face, nose and mouth repeatedly.</li>
                <li>Get yourself checked at nearest hospitals if you are frequently coughing or sneezing.</li>
                <li>While sneezing and coughing make sure droplets do not fall on others.</li>
                <li>Wear masks, gloves and try to maintain distance from other people.</li>
                <li>If you wear masks, then adjust it only with clean hands.</li>                
            </ol>
        </div>        
      </div>
      <div class="row">
            <div class="col-sm-12">
                    <div class="see_area see_area_1">   
                        <a class="seemore shadow_O sys" href="http://103.65.20.170/fitind/wp-content/uploads/2021/01/AIIMS-COVID-19-Information-Booklet.pdf" target="_blank">AIIMS Covid-19 Information</a>
                    </div>
            </div>
      </div>
  </div>

  </section>

@endsection