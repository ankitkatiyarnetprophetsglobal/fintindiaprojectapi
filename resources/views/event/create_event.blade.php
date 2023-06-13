@extends('layouts.app')
@section('title', 'Organise Event | Fit India')
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
							
							
                                <h2>Organise an Event</h2>
                                
								
								
								
								<div class="wrap event-form">	
									<!-- onsubmit="return create_event_validation()" -->

									@if (session('success'))
										<div class="alert alert-success">
											{{ session('success') }}
										</div>
									@endif
									
									<form name="createeventform" method="post" action="{{ route('store-event') }}" enctype="multipart/form-data" > 
											@csrf
											
											<input type="hidden" name="user_id" value="{{ Auth::id() }}"/>
											<div class="um-field">
													<div class="um-field-label">
														<label for="category">Event Category*</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
														<select name="category" id="category">
															<option value="">Select Category</option>
															@foreach($categories as $category)
																<option value="{{ $category->id }}" @if(!empty(old('category'))) @if(old('category') == $category->id) {{ 'selected' }}@endif @endif > {{ $category->name }} </option>
															@endforeach
															{!!$errors->first("category", "<span class='text-danger'>:message</span>")!!}	
														</select>	
													</div>
											</div>
											{!!$errors->first("category", "<span class='text-danger'>:message</span>")!!}

								<div class="main_form" style="display: block;">	
											
											<div class="um-field"></div>
											<div class="um-field">
													<div class="um-field-label">
														<label for="eventname">Event Name*</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
													<input id="eventname" type="text" name="eventname" value="{{ old('eventname') }}" maxlength="120">
													{!!$errors->first("eventname", "<span class='text-danger'>:message</span>")!!}
														
													</div>
											</div>
								
								
											
											<div class="um-field">
													<div class="um-field-label">
														<label for="eventimage1">Pic 1*</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
														<input type="file" id="eventimage1" name="eventimage1">
														{!!$errors->first("eventimage1", "<span class='text-danger'>:message</span>")!!}
													</div>
											</div>
											
											
											<div class="um-field">
													<div class="um-field-label">
														<label for="eventimage2">Pic 2</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
														<input type="file" id="eventimage2" name="eventimage2">
														{!!$errors->first("eventimage2", "<span class='text-danger'>:message</span>")!!}
													</div>
											</div>											

											
											
											<div class="um-field"> </div>
											<div class="um-field eventclass "> 
												<div class="um-field-label">
														<label for="video_link">Video Link</label>
														<div class="um-clear"></div>
												</div>
													<div class="um-field-area">
														<input id="video_link" type="text" name="video_link" value="{{ old('video_link') }}"  maxlength="120">
														{!!$errors->first("video_link", "<span class='text-danger'>:message</span>")!!}
													</div>
											</div>
											
											
											<div class="um-field">
												<div class="um-field-label">
													<label for="">Event Date*</label>
													<div class="um-clear"></div>
												</div>
												
												<div class="um-field-area">
													<div class="event-row-lt">
													<span id="eventstartdate">From Date</span>
													
													<input type="date" name="eventstartdate" class="eventdate" id="eventstartdate" value="{{ old('eventstartdate') }}">
													{!!$errors->first("eventstartdate", "<span class='text-danger'>:message</span>")!!}
								
													</div>
													<div class="event-row-lt" id="eventenddatediv" style="margin-left:10px;">
														To Date
														<input type="date" name="eventenddate" class="eventdate" id="eventenddate" value="{{ old('eventenddate') }}">
													{!!$errors->first("eventenddate", "<span class='text-danger'>:message</span>")!!}
													
														
													</div>
													<div class="clear clearfix"></div>
												</div>
											</div>

												
											
											<div class="um-field eventclass schoolHide" style="display: block;">
																			<div class="um-field-label">
														<label class="org_name_change" for="organiser_name">Organisation's Name* / School Name*</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
														<input id="organiser_name" type="text" name="organiser_name" value="@if(!empty(old('organiser_name'))) {{ old('organiser_name') }} @else {{ Auth::user()->name }} @endif"  maxlength="120">
														{!!$errors->first("organiser_name", "<span class='text-danger'>:message</span>")!!}
													</div>
											</div>

											
											
											<div class="um-field eventclass cyclonindHide">
													<div class="um-field-label">
														<label for="event_name">No of Participants</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
														<input id="participantnum" type="text" name="participantnum" value="{{ old('participantnum') }}" maxlength="6">
														{!!$errors->first("participantnum", "<span class='text-danger'>:message</span>")!!}
													</div>
											</div>
																		
											
											
											
											<div class="um-field eventclass schoolHide prabhatHide">
													<div class="um-field-label">
														<label for="kmrun">Total KM(Kilometer) Covered</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
														<input id="kmrun" type="text" name="kmrun" value="{{ old('kmrun') }}" maxlength="7">
														{!!$errors->first("kmrun", "<span class='text-danger'>:message</span>")!!}
													</div>
											</div>
											
											
											
											<div class="um-field">
													<div class="um-field-label">
														<label for="mobile">Contact Mobile No.*</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
														<input id="mobile" type="text" name="mobile" value="{{ old('mobile') }}" maxlength="10">
														{!!$errors->first("mobile", "<span class='text-danger'>:message</span>")!!}
													</div>
											</div>
											
											<div class="um-field undertaking" style="display: block;">
													<div class="um-field-label">
														<label for="undertaking">Undertaking*</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area undertakingtxt">
														<input type="checkbox" name="undertaking" @if(!empty(old('undertaking'))) {{ 'checked' }} @endif value="yes" required>
														I undertake to submit complete details of the number of participants and the cumulative KM Covered after the event, I also undertake to follow the guidelines of fit india logo if downloaded for the event.
													</div>
											</div>
															
											
											
											
											
										 <div class="register-row"> 
											<div class="register-row-lft" style="width:50%"> 
											<div class="um-field" id="rcapcha-main-cont">
												<label for="captcha">Please Enter the Captcha Text</label><br>
												<div style="float:left; width:115px; margin: 6px 0;" id="rcaptcha-cont">
													<div class="captchaimg">
														<span>{!! captcha_img() !!}</span>
													</div>
												</div>
												<div style="float:left; margin: 6px 20px 6px 10px; cursor: pointer;" >
												  <button type="button" class="btn btn-info" class="reload" id="reload">
													↻
													</button>
												</div>
												
												<div style="float:right; width:43%">
													<input type="text" id="captcha" name="captcha" required class="form-control @error('captcha') is-invalid @enderror"  placeholder="Captcha">
													@error('captcha')
														<span class="invalid-feedback" role="alert" >
															<strong>{{ $message }}</strong>
														</span>
													@enderror
												</div>

												<div style="clear:both;"></div>
											</div>
											</div>
											
										</div> 
										
										<div style="clear:both"></div>
										
										
											
											<div class="um-field">
													<div class="um-field-area">
														<input type="submit" name="create-event" value="Submit">
													</div>
											</div>
								</div>
								
								
											<br>
											<div class="um-field">
												<div class="um-field-area">
												<a class="et_pb_button et_pb_custom_button_icon et_pb_button_2 et_pb_bg_layout_light" style="font-size: inherit !important; border-radius: 100px; " href="https://fitindia.gov.in/wp-content/uploads/2019/09/Fit-India_logo.zip" data-icon="G">Download Logo</a>
												&nbsp;
												<a class="et_pb_button et_pb_custom_button_icon et_pb_button_2 et_pb_bg_layout_light" style="font-size: inherit !important; border-radius: 100px; " href="https://fitindia.gov.in/wp-content/uploads/2019/10/FITIndia_Logo_Guidelines.pdf" target="_blank" data-icon="G"> Guidelines </a>
												
												</div>
											</div>
									
									</form>
								</div>
								
								
								
							
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><br>
        </div>
		
		
		
		
<script>
    
jQuery('#reload').click(function () {
    jQuery.ajax({
    type: 'GET',
    url: "{{ route('reloadCaptcha')}}",
    success: function (data) {
		jQuery(".captchaimg span").html(data.captcha);
    }
    });
});
</script>



@endsection
