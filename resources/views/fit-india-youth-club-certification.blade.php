@extends('layouts.app')
@section('title', 'Fit india Youth Club Certificate | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp

        <div class="banner_area1">
            <img src="{{ url('resources/imgs/youthclub_b.jpeg') }}" alt="about-fitindia" class="img-fluid expand_img" />
      <section id="{{ $active_section_id }}">
          <div class="container">
              <div class="row et_pb_row_2">
                  <div class="col-sm-12 ">
                      <p>Hon’ble Prime Minister of India has launched the <strong>FIT INDIA MOVEMENT</strong> on
                          29 Aug 2019 with a view to make Physical Fitness a way of life. <strong>FIT INDIA
                              MOVEMENT</strong> aims at behavioural changes – from sedentary lifestyle to
                          physically active way of day-to-day living. Fit India would be a success only when it
                          becomes a people’s movement. We have to play the role of a catalyst.</p>
                      <P>In the above background, the Fit India Mission encourages <strong>YOUTH CLUB</strong> to
                          motivate people to become part of <strong>FIT INDIA MOVEMENT</strong> by inculcating at
                          least 45-60 minutes of physical activities in their day to day lives, individuals and
                          Youth Club can undertake various efforts for their own health and well-being as well as
                          for the health and well-being of fellow Indians.</P>
                      <br>
                  </div>
                  <div class="col-sm-12">
                      <div class="et_pb_bg_layout_light" style="display: initial;">
                    <a class="" href="fit-india-youthclub-registration">Apply For Fit
                        India Youth Club Certification<span style="margin-left:30px"><svg aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="chevron-right"
                                class="svg-inline--fa fa-chevron-right fa-w-1" role="img"
                                xmlns="http://www.w3.org/2000/svg" width="12px" height="15px"
                                viewBox="0 0 320 512">
                                <path fill="currentColor"
                                    d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z">
                                </path>
                            </svg></span></a>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      @endsection
