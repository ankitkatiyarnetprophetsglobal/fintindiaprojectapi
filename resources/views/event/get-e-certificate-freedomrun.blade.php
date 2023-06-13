@extends('layouts.app')
@section('title', ' Get Freedom Run Certificate | Fit India')
@section('content')
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
                                <h2><b>Generate E-certificate for Fit India {{$users->name}}</b></h2>
                                <div class="wrap event-form">   
            <form action="{{ route('download-e-cert') }}" method="POST" onsubmit="return chkcaptchaval();">
                @csrf
                                <div class="um-field">
                
                            <input type="text" name="category" id="category" value="<?php 
                                    foreach($categories as $events_cat){
                                        if($events_cat->id != $users->category)
                                         continue;
                                        echo '';
                                        if($events_cat->id == $users->category)echo ' ';
                                        echo str_replace('-',' ',$events_cat->name);

                                    }                               
                                ?>" readonly />
                            </div> 
                            <div class="um-field">
							
							
                    <select name="cert_type" id="cert_type"  onchange="select_cert_type(this.value)">
                        
                        <?php
                        if($users->role == 'subscriber'){
                            echo '<option value="individual">Individual</option>';
                            
                        }
						else if(!empty($users->participant_names)){
							
							echo '<option value="organiser">Organiser</option>';
							echo '<option value="participant">Participant</option>';
						}
						
						else if($users->category==13053 && $users->role == 'school'){
                            echo '<option value="organiser">Organiser</option>';
                        }
						
                        else{
                            echo '<option value="organiser">Organiser</option>';
                        }
                        ?>
                    </select>
                </div>
					<?php 
						$participant_names = unserialize($users->participant_names);
                        
						
				if(!empty($participant_names) && $users->role != 'subscriber'){ ?>
				<div class="um-field" id="participantdiv" style="display: none;">
				<select name="participant">
					<?php
						foreach($participant_names as $single_participant){
							echo '<option value="'.ucfirst(trim($single_participant)).'">'.ucfirst(trim($single_participant)).'</option>';
						}
				    ?>
				</select>
                            </div>

                                   
							<?php 
				}?>
               
                <input type="hidden" name="eventstartdate" value="{{ $users->eventstartdate }}">
                <input type="hidden" name="eventenddate" value="{{ $users->eventenddate }}">
                <input type="hidden" name="category" value="{{ $users->category }}">
                <input type="hidden" name="organiser_name" value="{{ $users->organiser_name }}">
                <input type="hidden" name="name" value="{{ $users->name }}">
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
                                            <div class="clearfix"> </div>
                            <div class="um-field">
                <button class="btn btn-danger btn-lg" type="submit" name="submit" value="Download Certificate" style="background-color:#FF339F " >Download Certificate</button>
                </div>
                                       </div>
                                     </div>
            </form>
        </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
</div>
<script>
    
    function chkcaptchaval(){
        if(document.getElementById('imppagecaptcha').value != document.getElementById('pagecaptcha').value){
            alert('captcha do not match');
            return false;
        }
        return true;
    }
    function select_cert_type(el){
        if(el == 'participant'){
            document.getElementById('participantdiv').style.display='block';
        }else{
            document.getElementById('participantdiv').style.display='none';
        }
    }
    
    
    function select_link(el){
            var s = window.location.href;
            var n = s.indexOf('?');
            s = s.substring(0, n != -1 ? n : s.length);

            window.location.href = s + '?eventid='+el;

            if(el.length){
            window.location.href = s + '?eventid='+el;
            }else{
            window.location.href = s;
            }
        }
    
    </script>
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
</div>
<br><br><br><br>
                                
@endsection