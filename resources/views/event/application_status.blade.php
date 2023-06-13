@extends('layouts.app')
@section('title', 'My Application Status | Fit India')
@section('content')

<div class="banner_area">
	<img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />
			@include('event.userheader')

            <div class="container">
                <div class="et_pb_row">
                    <div class="row ">
                        
						@include('event.sidebar')
						
                        <div class="col-sm-12 col-md-9 ">
                            <div class="description_box">
							@php
							/*
							<p style="color: red; font-size: 22px;" >Stay Tuned for upcoming Fit India Events. </p>
							*/	
							@endphp	
							
							
                                <h2>My application status</h2>
                                
								
								
								
								<div class="wrap event-form">	
									<!-- onsubmit="return create_event_validation()" -->

									@if (session('success'))
										<div class="alert alert-success">
											{{ session('success') }}
										</div>
									@endif
									
									@if(!empty($ambassador_info))
							 	
							 		
									<table class="table table-bordered">
										<tr>
										<th>Name</th>
										<td><?=$ambassador_info->name?></td>
										</tr>
										<tr>
										<th>Email</th>
										<td><?=$ambassador_info->email?></td>
										</tr>
										<tr>
										<th>Contact</th>
										<td><?=$ambassador_info->contact?></td>
										</tr>
										<tr>
										<th>Designation</th>
										<td><?=$ambassador_info->designation?></td>
										</tr>
										<tr>
										<th>State Name</th>
										<td><?=$ambassador_info->state_name?></td>
										</tr>
										<tr>
										<th>District Name</th>
										<td><?=$ambassador_info->district_name?></td>
										</tr>	
										<tr>
										<th>Block Name</th>
										<td><?=$ambassador_info->block_name?></td>
										</tr>
										<tr>
										<th>Facebook Profile</th>
										<td><?=$ambassador_info->facebook_profile?></td>
										</tr>
										<tr>
										<th>Twitter Profile</th>
										<td><?=$ambassador_info->twitter_profile?></td>
										</tr>
										<tr>
										<th>Instagram Profile</th>
										<td><?=$ambassador_info->instagram_profile?></td>
										</tr>
										<tr>
										<th>Facebook Profile Followers</th>
										<td><?=$ambassador_info->facebook_profile_followers?></td>
										</tr>
										<tr>
										<th>Twitter Profile Followers</th>
										<td><?=$ambassador_info->twitter_profile_followers?></td>
										</tr>
										<tr>
										<th>Instagram Profile Followers</th>
										<td><?=$ambassador_info->instagram_profile_followers?></td>
										</tr>
										<tr>
										<th>Work Profession</th>
										<td><?=$ambassador_info->work_profession?></td>
										</tr>
										<tr>
										<th>Description</th>
										<td><?=$ambassador_info->description?></td>
										</tr>
										<tr>
										<th>Status</th>
										<td><strong><?php if($ambassador_info->status=='1'){ echo "<span style='color:green'>Approved</span>"; }elseif($ambassador_info->status=='2'){ echo "<span style='color:red'>Rejected</span>"; }else{ echo "<span style='color:yellow'>Pending</a>"; } ?></strong></td>
										</tr>
										<tr>
										<th>Date</th>
										<td><?=$ambassador_info->created_at;?></td>
										</tr>
									</table>
									
							

									<div class="um-field">
										<div class="um-field-area">
											<a target="_blank" class="btn btn-primary flag-dwn" href="download-ambassador-certificate">Download Certificate</a>
										</div>
									</div>
									@endif
									<br>
									<br>
										@if(!empty($champion_info))
							 	
							 		
									<table class="table table-bordered">
										<tr>
										<th>Name</th>
										<td><?=$champion_info->name?></td>
										</tr>
										<tr>
										<th>Email</th>
										<td><?=$champion_info->email?></td>
										</tr>
										<tr>
										<th>Contact</th>
										<td><?=$champion_info->contact?></td>
										</tr>
										<tr>
										<th>Designation</th>
										<td><?=$champion_info->designation?></td>
										</tr>
										<tr>
										<th>State Name</th>
										<td><?=$champion_info->state_name?></td>
										</tr>
										<tr>
										<th>District Name</th>
										<td><?=$champion_info->district_name?></td>
										</tr>	
										<tr>
										<th>Block Name</th>
										<td><?=$champion_info->block_name?></td>
										</tr>
										<tr>
										<th>Facebook Profile</th>
										<td><?=$ambassador_info->facebook_profile?></td>
										</tr>
										<tr>
										<th>Twitter Profile</th>
										<td><?=$champion_info->twitter_profile?></td>
										</tr>
										<tr>
										<th>Instagram Profile</th>
										<td><?=$champion_info->instagram_profile?></td>
										</tr>
										<tr>
										<th>Facebook Profile Followers</th>
										<td><?=$champion_info->facebook_profile_followers?></td>
										</tr>
										<tr>
										<th>Twitter Profile Followers</th>
										<td><?=$champion_info->twitter_profile_followers?></td>
										</tr>
										<tr>
										<th>Instagram Profile Followers</th>
										<td><?=$champion_info->instagram_profile_followers?></td>
										</tr>
										<tr>
										<th>Work Profession</th>
										<td><?=$champion_info->work_profession?></td>
										</tr>
										<tr>
										<th>Description</th>
										<td><?=$champion_info->description?></td>
										</tr>
										<tr>
										<th>Status</th>
										<td><strong><?php if($champion_info->status=='1'){ echo "<span style='color:green'>Approved</span>"; }elseif($champion_info->status=='2'){ echo "<span style='color:red'>Rejected</span>"; }else{ echo "<span style='color:yellow'>Pending</a>"; } ?></strong></td>
										</tr>
										<tr>
										<th>Date</th>
										<td><?=$champion_info->created_at;?></td>
										</tr>
									</table>
									
							

									<div class="um-field">
										<div class="um-field-area">
											<a target="_blank" class="btn btn-primary flag-dwn" href="download-champion-certificate">Download Certificate</a>
										</div>
									</div>
									@endif
								</div>
								
								
								
							
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><br>
        </div>
		
		
		
		



@endsection
