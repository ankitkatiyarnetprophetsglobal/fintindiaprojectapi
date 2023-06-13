@extends('layouts.app')
@section('title', 'Champion And Ambassador | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp

<head>
 <title>champion & ambassador</title>
</head>
<body>

    <div class="container-fluid">

        <div class="champ-ambass">

            <div class="banner">
                <img src="{{ asset('resources/imgs/Common-Page-Banner.jpg') }}" class="fluid-img"  alt="banner">
            </div>
        </div>
    </div>

<section id="{{ $active_section_id }}">

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12"> 
            <div class="content" >
                <div class="champion-content" style="color:#0c71c3;">
                    <h2>Criteria for being a Fit India Champion</h2>
                </div>

                <ul style="line-height:1.5rem;padding:0 15px">
                    <li>The applicant individual needs to be present on at least one social media platform (Facebook, Twitter, or Instagram)</li>
                    <li>The individual must have followers in the range of <strong>100K – 1 Million </strong>on respective social media platform (Facebook, Twitter, & Instagram)</li>
                    <li>The individual should be a fitness enthusiast and he/she should be willing and ready to post fitness related content on his/her social media handles by using #FitIndiaMovement, #NewIndiaFitIndia or any other hashtag promoted by Fit India mission.</li>
                    <li>The individual tags Fit India’s official social media handles in fitness related content created by the Champion</li>
                    <li>The individual organizes/participates in Fit India’s on-ground/virtual events wherever possible</li>
                    <li>The individual must be following Fit India Movement’s Social media handles (@FitIndiaOff)</li>
                    <li>If selected, the individual’s association with Fit India Movement will be purely non-commercial and he/she cannot use the name or logo of Fit India Movement for any commercial promotion or benefits</li>
                </ul>
                    <br><br>
                    <div class="ahover">
                        <a href="fit-india-champions" target="_blank" class="og_btn" style=" background-color: #0c71c3;;">APPLY</a>
                    </div>

                    
                <div class="ambassador-content" style="color:#8300e9; padding:2rem 0 0 0;">
                <br>
                    <h2>Criteria for being a Fit India Ambassador</h2>
                </div>

                <ul style="line-height:1.5rem;padding:0 15px">
                    <li>The applicant individual needs to be present on at least one social media platform (Facebook, Twitter, or Instagram)</li>
                    <li>The individual must have followers in the range of <strong>10K – 100K </strong> on respective social media platform (Facebook, Twitter, & Instagram)</li>
                    <li>The individual should be a fitness enthusiast and he/she should be willing and ready to post fitness related content on his/her social media handles by using #FitIndiaMovement, #NewIndiaFitIndia or any other hashtag promoted by Fit India mission.</li>
                    <li>The individual tags Fit India’s official social media handles in fitness related content created by the Ambassador</li>
                    <li>The individual organizes/participates in Fit India’s on-ground/virtual events wherever possible</li>
                    <li>The individual must be following Fit India Movement’s Social media handles (@FitIndiaOff)</li>
                    <li>If selected, the individual’s association with Fit India Movement will be purely non-commercial and he/she cannot use the name or logo of Fit India Movement for any commercial promotion or benefits.</li>
                </ul>
                <br><br>
                <div  class="ahover">
                    <a href="fit-india-ambassador" target="_blank" class="og_btn" style=" background-color: #8300e9;">APPLY</a>
                </div> 
                
            </div>
            </div>
    </div>
</div>
</section>
</body>
@endsection