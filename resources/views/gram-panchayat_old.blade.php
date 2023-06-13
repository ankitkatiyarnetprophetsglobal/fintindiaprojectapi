@extends('layouts.app')
@section('title', 'Fit India Gram Panchayat Ambassador')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<section id="{{ $active_section_id }}">
	<div class="container">
	    <div class="row">
	        <div class="col-sm-12">
	            
	        </div>
	    </div>
	    <h1 class="heading">Be a Fit India Gram Panchayat Ambassador</h1>

		<div class="row">
	    	<div class="col-sm-12 col-md-12">
1.	He/she should be nominated by Sarpanch/Mukhiya/Pradhan of Gram Panchayat as Fit India coordinator for organising community fitness events. He/ She should preferably be an elected representative.
                 <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="Select State">State:-</label>
                      <select name="state_name" id="state" class="form-control">
                      <option value="">Select State</option>
                      @foreach($states as $state)
                        <option value="{{$state->id}}">{{$state->name}}</option> 
                      @endforeach
                  </select>
                  {!!$errors->first("state_name","<span class='text-danger'>:message</span>")!!}
                  </div>
                  </div>

             
                  
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="District">District:-</label>
                      <select name="district_name" id="district" class="form-control">
                       <option value="">Select District</option>
                     </select>
                     {!!$errors->first("district_name","<span class='text-danger'>:message</span>")!!}
                  </div>
                  </div>
                   </div>
                  <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="Block">Block:-</label>
                      <select name="block_name" id="block" class="form-control">
                        <option value="">Select Block</option>
                      </select>
                      {!!$errors->first("block_name","<span class='text-danger'>:message</span>")!!}
                  </div>
                  </div>

                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="Pincode">Pincode:-</label>
                      <input type="text" name="pincode" id="pincode" value="{{ old('pincode') }}" class="form-control" maxlength="6">
                      {!!$errors->first("pincode","<span class='text-danger'>:message</span>")!!}
                  	</div>
                  </div>
              </div>

              	<div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="gram-panchayat-name">Gram Panchayat Name:-</label>
                      <input type="text" name="gram_panchayat_name" id="gram-panchayat-name" value="{{ old('gram_panchayat_name') }}" class="form-control" maxlength="6">
                      {!!$errors->first("gram_panchayat_name","<span class='text-danger'>:message</span>")!!}
                  	</div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="file">Attach supporting document- (Letter from concerned GP)</label>
                      <input type="file" name="image" id="image" class="form-control">
                      {!!$errors->first("image","<span class='text-danger'>:message</span>")!!}
                      </div>
                  </div>
                 </div>


                  	2.	He/she should be preferably in the age group 18-50 years.
                   <div class="row">
                    <div class="col-sm-12 col-md-4">
                    	<div class="form-group">
                      		<label for="fname">Name:-</label>
                  			<input type="text" name="name" id="amb_name" class="form-control" value="{{ old('name') }}">
                  			{!!$errors->first("name","<span class='text-danger'>:message</span>")!!}
                  		</div>
                   </div>

                  <div class="col-sm-12 col-md-4">
                    <div class="form-group">
                      <label for="age">Age:-</label>
                  		<input type="text" name="age" id="age" class="form-control" value="{{ old('age') }}">
                  		{!!$errors->first("name","<span class='text-danger'>:message</span>")!!}
                  	</div>
                  </div>
                  
                  <div class="col-sm-12 col-md-4">
                    <div class="form-group">
                      <label for="gender">Gender:-</label>
                   		<select name="getnder" id="gender" class="form-control">
                        	<option value="">Select Gender</option>
                      	</select>
                      {!!$errors->first("gender","<span class='text-danger'>:message</span>")!!}
                  	</div>
                  </div>
              </div>


                  3.	He/she should be aware about the importance of physical fitness and spend 30-60 minutes daily for at least 5 days every week for physical activities. Physical activities could be playing any sport, traditional game, walking, cycling, dancing, running, or any other physical activity.     
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                    	<label for="gender">YES:-</label>
                  		<input type="radio" name="physical_activity" value="yes">
                  	</div>
                </div>
                 <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                    	<label for="gender">NO:-</label>
                		<input type="radio" name="physical_activity" value="no">
                	</div>
                </div>

                4.	He/she should motivate one additional person every month (minimum 10 persons in a year) for incorporating physical activity of 30-60 minutes in their daily routine.
 				<br><br>
 				<div class="row">
 					<div class="col-sm-12 col-md-6">
                    	<div class="form-group">
                		Undertaking- He/she commits to motivate one person every month/ minimum 10 persons in a year
            			</div>
        			</div>

 					<div class="col-sm-12 col-md-6">
                    	<div class="form-group">
                			<input type="checkbox" name="">
            			</div>
        			</div>
    			</div>
     			<div class="row">
 					<div class="col-sm-12 col-md-6">
                    	<div class="form-group">
               				If yes (names and phone numbers to be filled by 31st March)
							Format given below
            			</div>
        			</div>
 					<div class="col-sm-12 col-md-6">
                    	<div class="form-group">
                			<input type="checkbox" name="">
            			</div>
        			</div>
    			</div>

    		<table class="motivate-tbl" id="motivatetbl" style="display: table;">
				<tbody>
					<tr>
						<th>S. No.</th>
						<th>Name of motivated person</th>
						<th>Contact number and email id (if available)</th>
					</tr>
					<tr>
						<td>1</td>
						<td><input type="text" name="mpname[]"></td>
						<td><input type="text" name="mpcontact[]"></td>
						<td><input type="text" name="mpphyactivity[]"></td>
					</tr>
					<tr>
						<td>2</td>
						<td><input type="text" name="mpname[]"></td>
						<td><input type="text" name="mpcontact[]"></td>
						<td><input type="text" name="mpphyactivity[]"></td>
					</tr>
					<tr>
						<td>3</td>
						<td><input type="text" name="mpname[]"></td>
						<td><input type="text" name="mpcontact[]"></td>
						<td><input type="text" name="mpphyactivity[]"></td>
					</tr>
					<tr>
						<td>4</td>
						<td><input type="text" name="mpname[]"></td>
						<td><input type="text" name="mpcontact[]"></td>
						<td><input type="text" name="mpphyactivity[]"></td>
					</tr>
					<tr>
						<td>5</td>
						<td><input type="text" name="mpname[]"></td>
						<td><input type="text" name="mpcontact[]"></td>
						<td><input type="text" name="mpphyactivity[]"></td>
					</tr>
					<tr>
						<td>6</td>
						<td><input type="text" name="mpname[]"></td>
						<td><input type="text" name="mpcontact[]"></td>
						<td><input type="text" name="mpphyactivity[]"></td>
					</tr>
					<tr>
						<td>7</td>
						<td><input type="text" name="mpname[]"></td>
						<td><input type="text" name="mpcontact[]"></td>
						<td><input type="text" name="mpphyactivity[]"></td>
					</tr>
					<tr>
						<td>8</td>
						<td><input type="text" name="mpname[]"></td>
						<td><input type="text" name="mpcontact[]"></td>
						<td><input type="text" name="mpphyactivity[]"></td>
					</tr>
						<tr>
						<td>9</td>
						<td><input type="text" name="mpname[]"></td>
						<td><input type="text" name="mpcontact[]"></td>
						<td><input type="text" name="mpphyactivity[]"></td>
					</tr>
						<tr>
						<td>10</td>
						<td><input type="text" name="mpname[]"></td>
						<td><input type="text" name="mpcontact[]"></td>
						<td><input type="text" name="mpphyactivity[]"></td>
					</tr>
					</tbody>
				</table>

				5.	He/she should organise one community physical fitness event every quarter with minimum 100 participants. Such event could be any sport, running, dancing, cycling or yogasan sessions.
				 <div class="row">
				 <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                    	Undertaking: He/she commits to organise at least one event every quarter
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                    	Yes<input type="radio" name="organise_event" value="yes">
                    	No<input type="radio" name="organise_event" value="no">
                    </div>
                  </div>

              	</div>


              	 <table class="motivate-tbl" id="motivatetbl" >
				<tbody>
					<tr>
						<th colspan="2">Fit India event- 1</th>
						<!-- <td></td> -->
					</tr>
					<tr>
						<td>Name of the event</td>
						<td><input type="text" name="name_of_event"></td>
					</tr>
					<tr>
						<td>Number of participants</td>
						<td><input type="number" name="no_of_event"></td>
					</tr>
					<tr>
						<td>Attach photo</td>
						<td><input type="file" name="event_photo">Photo (JPEG/PNG etc format)</td>
					</tr>

					<tr>
						<th colspan="2">Fit India event- 2</th>
					</tr>
					<tr>
						<td>Name of the event</td>
						<td><input type="text" name="name_of_event"></td>
					</tr>
					<tr>
						<td>Number of participants</td>
						<td><input type="number" name="no_of_event"></td>
					</tr>
					<tr>
						<td>Attach photo</td>
						<td><input type="file" name="event_photo">Photo (JPEG/PNG etc format)</td>
					</tr>

					<tr>
						<th colspan="2">Fit India event- 3</th>
					</tr>
					<tr>
						<td>Name of the event</td>
						<td><input type="text" name="name_of_event"></td>
					</tr>
					<tr>
						<td>Number of participants</td>
						<td><input type="number" name="no_of_event"></td>
					</tr>
					<tr>
						<td>Attach photo</td>
						<td><input type="file" name="event_photo">Photo (JPEG/PNG etc format)</td>
					</tr>

					<tr>
						<th colspan="2">Fit India event- 4</th>
					</tr>
					<tr>
						<td>Name of the event</td>
						<td><input type="text" name="name_of_event"></td>
					</tr>
					<tr>
						<td>Number of participants</td>
						<td><input type="number" name="no_of_event"></td>
					</tr>
					<tr>
						<td>Attach photo</td>
						<td><input type="file" name="event_photo">Photo (JPEG/PNG etc format)</td>
					</tr>

					



					
					</tbody>
				</table>







	    	</div>
		</div>
	</div>
</section>
<!-- <script src='https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js'></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script> -->

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