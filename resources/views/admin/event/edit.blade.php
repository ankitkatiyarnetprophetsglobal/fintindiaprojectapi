@extends('admin.layouts.app')
@section('title', 'Fit India Admin-Edit Events')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
		    <a class="" href="{{ route('admin.events.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
          	<!--<a class="btn btn-primary" href="{{ route('admin.events.index') }}">Back</a>-->
            <h1>Update Event</h1>
          </div>
		</div> 		
		<div class="row mb-2">  
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('admin.events.index') }}"> Event</li></a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->  
	<section class="content">
      <div class="container-fluid">
        <div class="row">          
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Event for 
					@foreach($categories as $category)  @if( $events->category == $category->id ) {{ str_replace("-", " ",$category->name) }} @endif @endforeach
				</h3>
              </div>
             
              <form method="POST" action="{{ route('admin.events.update',$events->id) }}" enctype="multipart/form-data"> 

					@csrf
					@method('PATCH')
					
					
									
					<input type="hidden" name="user_id" value="{{ $events->user_id }}">					
					 <div class="card-body">
					    
							@if (session('success'))
										<div class="alert alert-success">
											{{ session('success') }}
										</div>
							@endif
									
						<div class="form-group">
							<label for="name">Event Name</label>
							 <input id="eventname" type="text" name="eventname" class="form-control" value="{{$events->name}}">
						    {!!$errors->first("eventname", "<span class='text-danger'>:message</span>")!!}	
						</div>	
					
						<div class="form-group">
							<label for="pic1">Pic 1</label>
							<input type="file" id="eventimage1" name="eventimage1" class="form-control" value="$events->eventimage1">
							{!!$errors->first("eventimage1", "<span class='text-danger'>:message</span>")!!}
							<?php if($events->eventimage1!=''){ ?>
							 <img src="{{ $events->eventimage1 }}" width="100" height="100">
						    <?php } ?>
						</div>	
						
						<div class="form-group">
							<label for="pic2">Pic 2</label>
							<input type="file" id="eventimage2" name="eventimage2" class="form-control" value="$events->eventimage2">
							{!!$errors->first("eventimage2", "<span class='text-danger'>:message</span>")!!}
							<?php if($events->eventimage2!=''){ ?>
							 <img src="{{ $events->eventimage2 }}" width="100" height="100">
						    <?php } ?>
						</div>	
						
						<div class="form-group">
							<label for="videolink">Video Link</label>
							<input id="video_link" type="text" name="video_link" class="form-control" value="{{ old('video_link') }}">
							{!!$errors->first("video_link", "<span class='text-danger'>:message</span>")!!}
						</div>	
						
		               <div class="um-field-label">
							<label for="">Event Date*</label>
							<div class="um-clear"></div>
						</div>
						
						<div class="form-group">
							<label for="fromdate">From Date</label>
							<input type="date" name="eventstartdate" class="eventdate" id="eventstartdate" class="form-control" value="{{ $events->eventstartdate }}">
							{!!$errors->first("eventstartdate", "<span class='text-danger'>:message</span>")!!}
						
						   <label for="tdate">To Date</label>
							<input type="date" name="eventenddate" class="eventdate" id="eventenddate" class="form-control" value="{{ $events->eventenddate }}">
							{!!$errors->first("eventenddate", "<span class='text-danger'>:message</span>")!!}						
						</div>	

                        <div class="form-group">
							<label class="org_name_change" for="organiser_name">Organisation's Name* / School Name*</label>
							<input id="organiser_name" type="text" name="organiser_name" class="form-control" value="{{ $events->organiser_name }}">
							{!!$errors->first("organiser_name", "<span class='text-danger'>:message</span>")!!}
						</div>		
											
						<div class="form-group">
							<label for="event_name">No of Participants</label>
							<input id="participantnum" type="text" name="participantnum" class="form-control" value="{{ $events->participantnum }}">
							{!!$errors->first("participantnum", "<span class='text-danger'>:message</span>")!!}
						</div>							
						
					   <div class="form-group">
							<label for="kmrun">Total KM(Kilometer) Covered</label>
							<input id="kmrun" type="text" name="kmrun" class="form-control" value="{{ $events->kmrun }}">
							{!!$errors->first("kmrun", "<span class='text-danger'>:message</span>")!!}
						</div>	
						
						<div class="form-group">
							<label for="participant_names">Name of Participants</label>
							
							<textarea id="participant_names" name="participant_names" class="form-control">@if(!empty($events->participant_names))@foreach(unserialize($events->participant_names) as $name){{ trim(ucfirst(str_replace("PHP_EOL","<br>",$name)))}}{{"\n"}}@endforeach @endif</textarea>
							{!!$errors->first("participant_names", "<span class='text-danger'>:message</span>")!!}
						</div>						
						 			
				
						<div class="um-field">
						<div class="um-field-area">
							<input type="submit" name="create-event" class="btn btn-sm btn-primary" value="Submit">
						</div>
				   </div>
				</form>
			    </div>						
            
      </div><!-- /.container-fluid -->
    </section>	
    <!-- /.content -->
  </div>
@endsection