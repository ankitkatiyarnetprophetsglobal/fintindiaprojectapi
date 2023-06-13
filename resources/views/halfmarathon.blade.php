@extends('layouts.app')
@section('title', 'Fit India J&K Half Marathon (Pahalgam) | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<div class="img-fluid expand_img">
				<img class="fluid-img" src="{{ asset('resources/imgs/pahalgam-banner.jpg') }}" />
			</div>
  <section>
  
    <div class="container" id="{{ $active_section_id }}">
				
			
			
        <div class="row">
            <div class="col-md-6 offset-md-3">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <form action="{{ route('save-feedback') }}" method="POST" >
                    @csrf
                    <h1 class="page__title title" id="page-title">Fit India J&K Half Marathon </h1>
                   
                    <div class="row">
						<div class="col-md-12 mt-3">
						
                        <div class="form-group">
							<label for="userEmail">Name*</label>
                            <input type="text" class="form-control" name="name" value="">
                            {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
                        </div>
                        
                        <div class="form-group">
                            <label for="userEmail">Email*</label>
                            <input type="email" class="form-control" name="email" value="">
                            {!!$errors->first("email", "<span class='text-danger'>:message</span>")!!}
                        </div>
                        
						<div class="form-group">
                            <label for="userEmail">Contact*</label>
                            <input type="number" class="form-control" name="mobile" value="">
                            {!!$errors->first("mobile", "<span class='text-danger'>:message</span>")!!}
                        </div>
						
						
						<div class="form-group">
                            <label for="gender">Gender*</label>
							
							<div class="form-check form-check-inline ml-3">
							  <input class="form-check-input" type="radio" name="gender" id="gender1"  value="Male"  />
							  <label class="form-check-label" for="gender1">Male </label>
							</div>

							<div class="form-check form-check-inline">
							   <input class="form-check-input" type="radio" name="gender" id="gender2"  value="Female"  />
							  <label class="form-check-label" for="gender2">Female </label>
							</div>

							<div class="form-check form-check-inline">
							   <input class="form-check-input" type="radio" name="gender" id="gender3"  value="Other"  />
							  <label class="form-check-label" for="gender3">Other </label>
							</div>
							
							{!!$errors->first("gender", "<span class='text-danger'>:message</span>")!!}

                        </div>
						
						
					<div class="form-group">
						<label for="Select State">State</label>
						<select name="state_name" id="state" class="form-control">
						<option value="">Select State</option>
							@foreach($states as $state)
								<option value="{{$state->id}}">{{$state->name}}</option> 
							@endforeach
						</select>
						{!!$errors->first("state_name","<span class='text-danger'>:message</span>")!!}
					</div>
                 
                  
                    <div class="form-group">
						<label for="District">District</label>
						<select name="district_name" id="district" class="form-control">
							<option value="">Select District</option>
						</select>
						{!!$errors->first("district_name","<span class='text-danger'>:message</span>")!!}
					</div>
                  

					<div class="form-group">
						<label for="Block">Block</label>
						<select name="block_name" id="block" class="form-control">
							<option value="">Select Block</option>
						</select>
                      {!!$errors->first("block_name","<span class='text-danger'>:message</span>")!!}
					</div>
					
					<div class="form-group">
						<label for="Block">T-Shirt Size </label>
						<select name="block_name" id="block" class="form-control">
							<option value="">Select Size</option>
							<option value="xs">xs</option>
							<option value="s">s</option>
							<option value="m">m</option>
							<option value="l">l</option>
							<option value="xl">xl</option>
							<option value="xxl">xxl</option>
						</select>
                      {!!$errors->first("block_name","<span class='text-danger'>:message</span>")!!}
					</div>
					
				  
                   
                        <div class="login-row" > 
                         <div class="um-field" id="capcha-page-cont">
                           <label for="captcha"></label><br>
                           <div style="float:left; width:115px;" id="pagecaptcha-cont">
                                <div class="captchaimg">
                                    <span>{!! captcha_img() !!}</span>
                                </div>
                            </div>
                           <div style="float:left; margin: 6px 20px 6px 10px; cursor: pointer;">
                             <button type="button" class="btn btn-info" class="reload" id="reload"> ↻ </button>
                           </div>
                           
                           <div style="float:left; width:40%">
                               <input type="text" id="captcha" name="captcha" class="form-control @error('captcha') is-invalid @enderror" required  placeholder="Captcha">
                                @error('captcha')
                                    <span class="invalid-feedback" role="alert" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           </div>
                           <div style="clear:both;"></div>
							</div>
                    
                        
                        </div>
						
						<div class="form-group">
                            
							<button type="submit" class="btn btn-primary feed_btn">SUBMIT</button>
                        </div>
						
					</div>
					</div>
                </form>
            </div>
        </div>
    </div>
    </section>
<script type="text/javascript">
    $('#state').change(function(){
    state_id = $('#state').val();
    $.ajax({
        url: "{{ route('champdistrict') }}",
        type: "post",
        data: { "id":state_id,"_token": "{{ csrf_token() }}"} ,
        success: function (response) {
           console.log(response);
           $('#district').html(response);
        },
    });
  });

  $('#district').change(function(){
    dist_id = $('#district').val();
    $.ajax({
        url: "{{ route('champblock') }}",
        type: "post",
        data: { "id":dist_id,"_token": "{{ csrf_token() }}"} ,
        success: function (response) {
           console.log(response);
           $('#block').html(response);
        },
        
    });
  });
  </script> 
@endsection