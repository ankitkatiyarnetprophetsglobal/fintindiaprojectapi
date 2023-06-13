@extends('layouts.app')
@section('title', 'Events Photo| Fit India')
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
                                <h2>Events Photo</h2>
								
								@if (session('error'))
										<div class="alert alert-danger">
											{{ session('error') }}
										</div>
								@endif
								
								@if (session('success'))
										<div class="alert alert-success">
											{{ session('success') }}
										</div>
								@endif
									
								<div class="all-events">
									@if(!empty($events))
                                    @foreach($events as $event)
										@if(!empty($event->eventimage1))
											<article class="cards-list">
												<div class="card-img">
												<img src="{{ $event->eventimage1 }}" />
												</div>
											</article>
										@endif
										
										@if(!empty($event->eventimage2))
											<article class="cards-list">
												<div class="card-img">
												<img src="{{ $event->eventimage2 }}" />
												</div>
											</article>
										@endif
                                    @endforeach
									
									@else
										<div class="no-events">
                                        You do not have added any Event. Do you want to organise an Event? please <a href="{{ route('create-event') }}">Click</a>
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
		
<style>
.delete-event{
    color: #fff;
    font-size: 14px;
    font-weight: 500;
    padding: 8px 15px;
    border-radius: 4px;
    display: block;
    width: 100%;
    text-align: center;
    text-transform: capitalize;
    transition: 0.5s;
    margin-right: 10px;
	background: #e4083b;
}
		</style>
	
@endsection
