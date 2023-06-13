@extends('layouts.app')
@section('title', 'Fit India Freedom Run| Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<div class="banner_area1">
<img src="{{ asset('resources/imgs/prabhatpheri.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />

<section id="{{ $active_section_id }}">
    <div class="container">
        <div class="row et_pb_row_2">
            <div class="col-sm-12 ">
                <h2>Guidelines for Fit India Prabhat Pheri </h2>
                <h3>Introduction</h3>
                <p>Based on the call of our Honourable PM Mr. Modi, Fit India will be launching Fit India Prabhat Pheri advocating the message “फिटनेस का डोज़ – आधा घंटा रोज़” campaign in December 2020.</p>
                <P>Fit India Prabhat Pheri can be organised by city councils, villages, panchayats, societies, RWA’s, NGO’s and special interest groups across India. You can also start a Fit India Prabhat Pheri group by involving your organisation, community, family and friends.
                </P> 
            </div>
        </div>
        <div class="row et_pb_row_2">
        <div class="col-sm-12">
        <h2>Why organise a Prabhat Pheri?</h2>
        <p>Prabhat Pheri is one of the ethnic Indian ways to promote a fit and healthy India. People in Indian villages have been taking part in early morning processions since ancient times chanting songs and using musical instruments. This activity can spread the benefits of fitness which will bring in a positive change in the local communities.</p>
            </div>
        </div>
          <div class="row et_pb_row_2">
            <div class="col-sm-12">         
                <h2>Who can organise Fit India Prabhat Pheri?</h2>
                <ul class="a">
                    <li>Village, Town or City Council/ Panchayat/ Anganwadi / Block</li>
                  
                    <li> Society or RWA</li>
                    <li> Interest Groups</li>
                    
                    <li>NGOs</li>
                    <li>Communities</li>
                    <li>IndiSchools/ Colleges and Universitiesviduals</li>
                </ul>
                <p>Organisers must ensure that all “Fit India Prabhat Pheri” events are listed on <a href="www.fitindia.gov.in" style="color:#ff6600;">www.fitindia.gov.in</a> portal and are non-commercial in nature.</p>                                                         
            </div>
           
        </div>
        <div class="row et_pb_row_2">
            <div class="col-sm-12">
                <h3>Guidelines for Organisers</h3>
                <ul class="a">
                    <li>Fit India Prabhat Pheri can be organised by any group, RWAs and communities etc to create awareness on fitness through early morning processions.
                    </li>
                    <li>Guidelines in relation to COVID-19 issued by the Ministry of Home Affairs and relevant state bodies to be duly complied with.</li>
                    <li>To become an organiser, you must register online on <a href="fitindia.gov.in">fitindia.gov.in</a></li>
                    <li>As an organiser, you will be responsible for conceptualizing, executing and ensuring a smooth and successful Fit India Prabhat Pheri event to maximize public participation.</li>
                    <li>You can invite other organisations as well for online registration.</li>
                    <li>You can get sponsorship and have partners to organise this event.</li>
                    <li>Fit India Mission office will provide standard FIT INDIA design templates for
                        branding elements on the
                        registration portal for organisers to download and use the same:</li>
                    <li>Organisers will get FIT INDIA Movement partner – certificate from Fit India.</li>
                    <li>You can get sponsorship and have partners to organise this event.</li>
                    <li>Fit India Mission office will provide a standard FIT INDIA design templates for branding elements on the registration portal for organisers to download and use the same:</li>
                    <li>Creatives for Prabhat Pheri have been created and available on the website. Some of the creatives can be downloaded from the website</li>
                   <li>Organisers will get FIT INDIA Movement e – certificate from Fit India.</li>
                    <li>Those interested in partnership can also write to Fit India Mission office on: <a
                            href="fitindia@gmail.com" style="color:#ff6600;">fitindia@gmail.com</a></li>
                </ul>
            </div>
        </div>

        <div class="row et_pb_row_2">
            <div class="col-sm-12">
                <h3>Other Guidelines for organisers</h3>
                <ul class="a">
                    <li>Identify route for the event, create map.</li>
                    <li>Inform local bodies about the event.</li>
                    <li>Inform communities around you about the Fit India Prabhat Pheri event.</li>
                    <li>Partner with local businesses who can sponsor FIT INDIA tee shirts / caps for children.</li>                                
                    <li>Any queries regarding Fit India Cyclothon to be sent to Fit India Mission office on: <a href="fitindia@gmail.com" style="color:#ff6600;">fitindia@gmail.com</a></li>
                </ul>
            </div>
        </div>


        <div class="row et_pb_row_2">
            <div class="col-sm-12">
                <h3>How to use the Fit India Prabhat Pheri templates Fit India Logo</h3>
                <ul class="a">
                    <li>Download the Fit India Logo</li>
                    <li>Do not edit the Fit India Logo (colour or dimension)</li>
                    <li>To be used only for events in promotion of Fit India Movement</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection