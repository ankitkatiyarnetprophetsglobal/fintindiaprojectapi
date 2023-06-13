@extends('layouts.app')
@section('title', 'Become-a-partner | Fit India')
@section('content')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<section id= "{{ $active_section_id }}">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
          <h1 >Expression of Interest to Become a Partner</h1>
            <p>Join us in making India a Fit, Healthy and Happy India. If you are interested in organising a Fit India
              event or contribute in any way, get in touch with us.</p>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true"
                      aria-controls="collapseOne">
                      Background
                    </a>
                  </h4>

                </div>
                <div id="collapseOne" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                    <p>Hon’ble Prime Minister has launched the Fit India Movement on 29th of August 2019 to promote
                      Fitness amongst all. While Fitness involves all aspects of life, the Fit India Movement focuses on
                      physical fitness of all to start with. Fit India is not a government program. Government’s role is
                      of a catalyst to involve all citizens to promote Fitness as a people’s movement.</p>
                    <p>Fit India aims at promoting physical fitness of all by inculcating a habit of fitness in all
                      citizens. Physical fitness can be achieved by developing a habit of spending 45 to 60 minutes
                      daily for physical activities viz. sports, walking, cycling, dancing, yogasan or any other form of
                      physical activity.</p>
                    <p><strong>MoYS has set up a Fit India Mission Office at Jawaharlal Nehru Stadium, New Delhi in
                        partnership with CII.</strong> Fit India Mission solicits partnerships for promoting Fit India
                      Movement from interested organisations.</p>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                  <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                      aria-expanded="false" aria-controls="collapseTwo">
                      Eligibility for Becoming Fit India Partner
                    </a>
                  </h4>

                </div>
                <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel"
                  aria-labelledby="headingTwo">
                  <div class="panel-body">
                    <p>Any registered organisation (including for profit organisation) under any relevant law:</p>
                    <ol style=" padding-left: 15px;">
                      <li>a) Active in the field of Fitness; or</li>
                      <li>b) Willing to promote Fitness through its goods and services; or</li>
                      <li>c) Demonstrates or has demonstrated its intent to promote Fitness among its
                        customers/clients/dealers/business partners.</li>
                      <li>d) Makes a commitment with delineated targets, modes and approach to promote Fit India.</li>
                    </ol>
                  </div>
                </div>
              </div>
              <div class="panel panel-default ">
                <div class="panel-heading" role="tab" id="headingThree">
                  <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                      aria-expanded="false" aria-controls="collapseThree">
                      Process of Becoming Fit India Partner
                    </a>
                  </h4>

                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                  <div class="panel-body">
                    <p>Eligible organisations may register their intent of becoming a Fit India Partner on the website
                      of Fit India Mission <a href="www.fitindia.gov.in">www.fitindia.gov.in</a> or you can directly
                      send your proposal on partnership[dot]fitindia[at]gmail[dot]com</p>
                    <p>The Fit India Mission Office would examine all the proposals received online on the above web
                      portal on regular basis, and solicit further information and have one to one meeting, if required.
                    </p>
                    <p>Upon mutual agreement between the Fit India Mission Office and the applicant Organisation with
                      regard to desirability and well defined commitments for Fit India is reached, the Fit India
                      Mission Office would issue a letter to the applicant organisation conveying its acceptance as a
                      Fit India Partner.</p>
                    <p>On becoming a Fit India Partner, the partner Organisation could use the Fit India Logo and
                      mention itself as Fit India Partner.</p>
                    <p>Fit India logo guidelines will be provided to successful partners.</p>
                  </div>
                </div>
              </div>

              <div class="panel panel-default ">
                <div class="panel-heading" role="tab" id="headingThree">
                  <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                      aria-expanded="false" aria-controls="collapseThree">
                      Ethics for Fit India Partner
                    </a>
                  </h4>

                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                  <div class="panel-body">
                    <p>All Fit India Partners would have to adhere to the following ethical guidelines to continue as a
                      Fit India Partner:</p>
                    <span><strong>Negative List:</strong></span>
                    <ol>
                      <li>1. No shaming of body, culture, food, religious practice or race, etc.</li>
                      <li>2. No product to be marked as essential Fit India Product.</li>
                      <li>3. No food to be promoted as a Fitness or Fit India food or supplement.</li>

                      <span><strong>Positive List:</strong></span>
                      <li>1. Fitness is Easy, eg physical activity and exercise can be done easily at any place at any
                        time and anywhere.</li>
                      <li>2. Fitness is Fun, eg sports, dancing, playing, walking, cycling, and spending time with
                        family for outdoor activities, etc.</li>
                      <li>3. Fitness is Free, eg no compulsion to have any equipment or joining the club or facility.

                        SAMPLE AGREEMENT
                      </li>
                    </ol>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-md-3 offset-md-1">          
            <div class="row">
              <div class="">

              <!-- <button type="button et_pb_button_btn" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              Sample agreement</button> -->
            
                <a class="et_pb_button_btn" href="  {{asset('resources/pdf/Fit-India-Letters-Sunboard-India-Sports-Summit.pdf') }}" target="_blank">Sample
                  agreement</a>
              </div>

              <div class="">
                <a class="et_pb_button_btn_cust et_pb_text_inner_button" href="become-partner" >Become a Partner</a>
              </div>

              
            </div>
            <br>
          </div>
        </div>

        <div class="row mt-70">
          <div class="col-sm-12">
            <h2 class="text-center">Partners</h2>
          </div>
          <div class="brand_logo">
            <img src=" {{asset('resources/imgs/partner/goqii_logo.png') }}">
            <img src="{{asset('resources/imgs/partner/cii_logo.png') }}">
            <img src="{{asset('resources/imgs/partner/sequoia_logo.png') }}">
            <img src="{{asset('resources/imgs/partner/spefl.png') }}">
            <img src="{{asset('resources/imgs/partner/transstaida_logo.png') }}">

          </div>
        </div>    
        
      </div>



    </section>
    
      
    </div>
  </div>
</div>

@endsection