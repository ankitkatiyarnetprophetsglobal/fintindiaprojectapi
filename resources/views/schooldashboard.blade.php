@extends('layouts.app')
@section('title', 'Fit India Dashboard | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
  <link rel="stylesheet" href="resources/css/dashboard.css">  

<div class="container">
    <section class="sec_area" id="{{ $active_section_id }}">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Fit India Dashboard</h1>
                <br><br>
            </div>
        </div>
        <div  class="d-flex flex-lg-row flex_col_cust"> 
            <div class="bg_dash_left ">
                <div>
                <img src="resources/imgs/fit_india_logo-w.png"/>
                </div>
                <div>
                <p>Status as on </p>
                <p>17 Feb 2021</p>
                </div> 
            </div>
			
            <div class=" bg_dash_right"> 
            <div class="d-flex">
                <div class="dash_reco">
                    <h4>39112K</h4>
                    <p>Site Visitors</p>
                </div>
                <div class="dash_reco">
                    <h4>444344</h4>
                    <p>Total Schools registered</p>
                </div>
            </div>
            <h2>Fit India School Certification</h2>
            <div class="d-flex ">
            <div class="dash_col">
                <h2>56</h2>
                <p>Boards</p>
            </div>
            <div class="dash_col  ">
                <h2>37</h2>
                <p>States/UTs</p>
            </div>
            <div class="dash_col">
                <h2>222308</h2>
                <p>Schools</p>
            </div>
            <div class="dash_col">                          
                <p>School Certification by Request</p>
            <div>
                <ul>
                    <li>Fit India Flag</li>
                    <li>
                        <div class="progress">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></span>
                    </div>
                    </li>
                    <li>2223083</li>
                </ul>
                <ul>
                <li>3 Star</li>
                <li>
                    <div class="progress">
                         <div class="progress-bar bg-info" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></span>
                    </div>
               </li>
                <li>37386</li>
                </ul>
                <ul>
                <li>5 Star</li>
                <li>
                    <div class="progress">
                <div class="progress-bar bg-info" role="progressbar" style="width: 15%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></span>
                </div>
                </li>
                <li>12262</li>
                </ul>
            </div>
            </div>
            </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row">
		
		 
			
		 
            <div class="col-12">
                <h2>Leading States For School Certificate Requests</h2>
                <table class="table table-striped bar_row">
                    <tbody>
                      <tr>                        
                        <td>State</td>
                        <td>Flag</td>
                        <td>3 Star</td>
                        <td>5 Star</td>
                        <td ></td>
                      </tr>
					  
						@php
							$flgcount = 0; $tscount = 0; $fscount = 0;  $i=0;
						@endphp
						
						@foreach($schooldata as $data)
							@php
								$tot = $data['flag'] + $data['threestar'] + $data['fivestar'];
								$flgcount += $data['flag']; $tscount += $data['threestar']; $fscount += $data['fivestar'];
								if(!$i){ $finflag = $tot; $i++; }
								
								
								$mainwidth = ($tot / $finflag) * 100;
								$flag_width = ($data['flag'] / $tot) * 100;
								$threestar_width = ($data['threestar'] / $tot) * 100;
								$fivestar_width = ($data['fivestar'] / $tot) * 100;
							@endphp
							<tr>                        
								<td>{{ $data['state'] }}</td>
								<td class="g_c">{{ $data['flag'] }}</td>
								<td class="b_c">{{ $data['threestar'] }}</td>
								<td class="p_c">{{ $data['fivestar'] }}</td>
								<td >
									<div class="progress progress_cust d-flex" style="width:{{$mainwidth}}%">
										<div class="progress-bar g_c" style="width: {{$flag_width}}%"></div>
										<div class="progress-bar b_c" style="width: {{$threestar_width}}%"> </div>
										<div class="progress-bar p_c" style="width: {{$fivestar_width}}%"> </div>
									</div>
								</td>
							</tr>
						
						@endforeach
			
			
                    </tbody>
                  </table>
            </div>
        </div>
    </section>

     <section >
       <br>
        <div class="row">
            <div class=" event-row-half">
                <h3>Fit India Plog Run </h3>
                <div class="d-flex justify-content-between">
                <div class="event-row "><span>43256</span><h6>Event</h6> </div>
                <div class="event-row"><span>3007543</span><h6>Participation</h6> </div>
                </div>
            </div>
            <div class=" event-row-half">
                <h3>Fit India Cyclothon </h3>
                <div class="d-flex justify-content-between">
                <div class="event-row"><span>15706</span><h6>Event</h6> </div>
                <div class="event-row"><span>3500000</span><h6>Participation</h6> </div>
                </div>
            </div>
        </div>        
    </section>
</li>
</ul>
</div>
@endsection