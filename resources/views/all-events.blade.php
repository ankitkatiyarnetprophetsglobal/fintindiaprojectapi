@extends('layouts.app')
@section('title', 'Fit India All Event | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<section id="{{ $active_section_id }}">
  <div class="container">  
        <div class="row">
            <div class="col-sm-12  flex_parent ">
                <h2 class="heading_h2">All Events</h2>
                <div class="flex_child  all_event">
                  <p><strong>Total Events:</strong><span>250190</span></p>                     
                    <div class="form-group">                          
                        <select class="form-control" id="sel1">
                          <option>All Cities</option>
                          <option>A KONDURU</option>
                          <option>A MUKKULAM</option>
                          <option>A.KONDURU</option>
                        </select>                        
                   </div>
                    <div class="form-group form-group_last-child">                          
                        <select class="form-control" id="event_id">
                        <option>Event Type</option>
                        <option>AFC Women's Football Day powered by FIT India</option>
                        <option>Fit India active women sunday with GOQii</option>
                        <option>Fit India Cyclothon</option>
                        </select>                        
                    </div>
                  
                    <div class="event_button"><a  href="javascript:void(0)">View Videos</a></div>
                    <div class="event_button"><a  href="javascript:void(0)">View Photo</a></div>                       
                </div>
            </div>
        </div>   
        <div class="row">
            <div class="col-sm-12  col-md-4 col-lg-4">
                <div class="card shadow all_evt_area">
                    <div>
                        <img src="https://fitindia.gov.in/wp-content/uploads/2020/07/image12-2.jpg" class="img-fluid" />

                        <div class="card-left">
                            <div class="__evt-date-col">
                                <p class="__evt-date">28</p>
                                <p class="__evt-month">Jul</p>
                            </div>
                        </div>
                        <div class="cat-col">AFC Women's Football Day powered by FIT India</div>
                    </div>
                        <div class="evt_detail">
                            <h2>Dertefrd</h2>
                            <p>Andaman and Nicobar Islands Aandankovil East</p>
                        </div>
                        <div class="join-btn">
                            <a href="https://fitindia.gov.in/events/womens-football-2/">View Details</a>
                        </div>
                    </div>
            </div>

            <div class="col-sm-12  col-md-4 col-lg-4">
                <div class="card shadow all_evt_area">
                    <div>
                        <img src="https://fitindia.gov.in/wp-content/uploads/2020/07/image12-2.jpg" class="img-fluid" />

                        <div class="card-left">
                            <div class="__evt-date-col">
                                <p class="__evt-date">28</p>
                                <p class="__evt-month">Jul</p>
                            </div>
                        </div>
                        <div class="cat-col">AFC Women's Football Day powered by FIT India</div>
                    </div>
                        <div class="evt_detail">
                            <h2>Dertefrd</h2>
                            <p>Andaman and Nicobar Islands Aandankovil East</p>
                        </div>
                        <div class="join-btn">
                            <a href="https://fitindia.gov.in/events/womens-football-2/">View Details</a>
                        </div>
                    </div>
            </div>

            <div class="col-sm-12  col-md-4 col-lg-4">
                <div class="card shadow all_evt_area">
                    <div>
                        <img src="https://fitindia.gov.in/wp-content/uploads/2020/07/image12-2.jpg" class="img-fluid" />

                        <div class="card-left">
                            <div class="__evt-date-col">
                                <p class="__evt-date">28</p>
                                <p class="__evt-month">Jul</p>
                            </div>
                        </div>
                        <div class="cat-col">AFC Women's Football Day powered by FIT India</div>
                    </div>
                        <div class="evt_detail">
                            <h2>Dertefrd</h2>
                            <p>Andaman and Nicobar Islands Aandankovil East</p>
                        </div>
                        <div class="join-btn">
                            <a href="https://fitindia.gov.in/events/womens-football-2/">View Details</a>
                        </div>
                    </div>
            </div>

            <div class="col-sm-12  col-md-4 col-lg-4">
                <div class="card shadow all_evt_area">
                    <div>
                        <img src="https://fitindia.gov.in/wp-content/uploads/2020/07/image12-2.jpg" class="img-fluid" />

                        <div class="card-left">
                            <div class="__evt-date-col">
                                <p class="__evt-date">28</p>
                                <p class="__evt-month">Jul</p>
                            </div>
                        </div>
                        <div class="cat-col">AFC Women's Football Day powered by FIT India</div>
                    </div>
                        <div class="evt_detail">
                            <h2>Dertefrd</h2>
                            <p>Andaman and Nicobar Islands Aandankovil East</p>
                        </div>
                        <div class="join-btn">
                            <a href="https://fitindia.gov.in/events/womens-football-2/">View Details</a>
                        </div>
                    </div>
            </div>

            <div class="col-sm-12  col-md-4 col-lg-4">
                <div class="card shadow all_evt_area">
                    <div>
                        <img src="https://fitindia.gov.in/wp-content/uploads/2020/07/image12-2.jpg" class="img-fluid" />

                        <div class="card-left">
                            <div class="__evt-date-col">
                                <p class="__evt-date">28</p>
                                <p class="__evt-month">Jul</p>
                            </div>
                        </div>
                        <div class="cat-col">AFC Women's Football Day powered by FIT India</div>
                    </div>
                        <div class="evt_detail">
                            <h2>Dertefrd</h2>
                            <p>Andaman and Nicobar Islands Aandankovil East</p>
                        </div>
                        <div class="join-btn">
                            <a href="https://fitindia.gov.in/events/womens-football-2/">View Details</a>
                        </div>
                    </div>
            </div>
        </div> 
  </div>
</section>
@endsection