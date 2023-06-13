@extends('layouts.app')
@section('title', 'Update Participants | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<section>
    <div class="banner_area">
            <img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />
            @include('event.userheader')

            <div class="container">
                <div class="et_pb_row">
                    <div class="row ">
                        
                        @include('event.sidebar')
            
                        <div class="col-sm-12 col-md-9 ">
                           
                            
                       
                        <div class="col-sm-12 col-md-8 ">
                            <div class="description_box">
    <br><br>
    <div class="container" id="{{ $active_section_id }}">
        <div class="row">
            <div class="col-md-12">
                <h2><strong>Add Participants *</strong></h2>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                <form action="{{ route('updatparticipant') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}"/>
                    <input type="hidden" name="id" value="{{ $event->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="userEmail"><b>Event</b></label>
                            <input type="text" class="form-control" name="name" value="{{$event->name}}">
                        </div>
                        <h2><strong>Add Participants *</strong></h2>
                        <div class="form-group">
                            <label for="userEmail"><b>No of Participants*</b></label>
                            <input type="text" class="form-control" name="participantnum" value="{{$event->participantnum}}">
                            {!!$errors->first("participantnum", "<span class='text-danger'>:message</span>")!!}
                        </div>
                       
                        <div class="form-group">

                            <label for="userEmail"><b>Participant Name(s)*</b> <i style="color: blue;">(Multiple names can be added in separate lines)</i>
                            </label>
                            
							<textarea name="participant_names" cols="20" rows="10" class="form-control"><?php
							if(!empty($event->participant_names)){
								foreach(unserialize($event->participant_names) as $name){
									echo trim(ucfirst(str_replace("PHP_EOL","<br>",$name)));
									echo "\n";
									}
							}?></textarea>
                            {!!$errors->first("participant_names", "<span class='text-danger'>:message</span>")!!}
                            
                        </div>
                    </div>
                     <div class="login-row"> 
                         <div class="um-field" id="capcha-page-cont">
                           <label for="captcha">Please Enter the Captcha Text</label><br>
                           <div style="float:left; width:115px;  margin: 6px 0;" id="pagecaptcha-cont">
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
                                    
                    <div class="center-on-small-only">
                        <button type="submit" class="btn btn-danger">Update Participants</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div></div></div></div></div></div>
</div>
</section>

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