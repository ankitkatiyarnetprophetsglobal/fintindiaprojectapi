@extends('layouts.app')
@section('title', 'My Events | Fit India')
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
                                <h2>My Events</h2>
								
									@if (session('success'))
										<div class="alert alert-success">
											{{ session('success') }}
										</div>
									@endif
									
								<div class="all-events">
									@if(!empty($events))
                                    @foreach($events as $event)
									
									<?php
									$date =  $event->eventstartdate;
									$month = date('M', strtotime($date));
									$show_date = date('j', strtotime($date));
									?>
									<article class="cards-list">
										<div class="card-img">
											<img src="{{ $event->eventimage1 }}" alt="FIT INDIA">
												<div class="card-left">
												 <div class="__evt-date-col">
													  <p class="__evt-date"><?php echo $show_date; ?></p>
													  <p class="__evt-month"><?php echo $month; ?></p>
												 </div>
											</div>					
										</div>

										<div class="card-details">
										
											<div class="card-right">
												
												<div class="card-title">
												 <h4>
												 	{{ $event->name }} 
												</div>
												<div class="venue-details">
												   <span class="participantnum"> Participants : {{ $event->participantnum }} </span>
												   @if(!empty($event->kmrun)) <br><span class="kmrun"> Km(Ride) :  {{ $event->kmrun }}  </span> @endif
												   <br><span class="organiser_name"> Organisation name : {{ $event->organiser_name }} </span>	
												</div>
												
											</div>
										</div>
										<div class="join-btn" style="position: inherit;">
										   
												<div class="add">
													<a class="add-participants" href="{{ route('add-participant', $event->id )}}">Add Participants</a>
												</div>
												
											<div class="editdel">
												<a class="edit-event " href="{{ route('eventedit', $event->id) }}">Edit</a>
												
												
												
												<form action="{{ route('eventdestroy',$event->id) }}" method="POST">
												  @csrf
												  @method('DELETE')
												 <button class="delete-event" type="submit" onclick="return confirm('Are you sure, You want to delete this event ?')" >Delete</button>
												</form>
			 
											</div>
											
											
											<div class="add">
												<a class="dwnl-btn add-participants" href="{{ route('event-e-cert', $event->id) }}">Download Certificate</a>
												<br>
											</div>
											
										</div>
									</article>

                                    @endforeach
									
									@else
										<div class="no-events">
                                        You do not have added any Event. Do you want to organise an Event? please <a href="">Click</a>
										</div>
									@endif
									<div class="fi-certnote" style="font-size: 14px;font-style: italic;padding: 0 0 0 20px;clear: both;color: #494545;line-height: 1.2;">NOTE : Certificate can only be downloaded by the End of the Event date Selected by You.</div>
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
