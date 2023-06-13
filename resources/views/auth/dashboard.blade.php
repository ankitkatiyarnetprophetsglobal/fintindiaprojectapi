@extends('layouts.app')
@section('title', 'Dashboard | Fit India')
@section('content')

    <div class="banner_area">
    	<img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />
	    @include('event.userheader')
	    <div class="container">
	        <div class="et_pb_row">
	            <div class="row">
					@include('event.sidebar')
	                <div class="col-sm-12 col-md-9">
	                    <div class="description_box">
	                        <h2>Dashboard</h2>
							@if(strtolower($role) == 'school')
							@else
							@endif
							<p> Dear <strong>{{ Auth::user()->name }} </strong> member, thanks for be a part of Fit India. </p>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <br><br><br><br>
    </div>
@endsection
