@extends('layouts.app')
@section('title', 'Fit India - Youth Club Certificate Request')
@section('content')

<div class="banner_area">
   <img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />
   @include('event.userheader')
	
	 
	 
    <div class="container">
        <div class="et_pb_row">
            <div class="row ">

				@include('event.sidebar')
					
				<div class="col-sm-12 col-md-9 ">
                <div class="description_box wrap event-form accordion yc-questions">
                   
                    
					
					@if($errors->any())
						<div class="alert alert-danger">
						{{ 'There is some validation error, please check each field and fill correct value' }}
						</div>
					@endif	
					
					@if (session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
					@endif
					
					@if (session('error'))
						<div class="alert alert-danger">
							{{ session('error') }}
						</div>
					@endif
					
					
					@if($roleslug == 'youthclub')
					
			
<!-- Flag Request Start -->

					
			<div id="tab-12977" class="star-rating-content current" >
				<?php if(empty($flagdata->id)){ ?>
				<form name="createeventform" method="post" action="{{route('storeyouthcert')}}" enctype="multipart/form-data">
					@csrf
					<?php } ?>
					<div class="rating-heading">
					<h3>
						Request for Fit India Youth Club Certification  
					</h3>
					<span class="default-i @if(!empty($flagstatusdata->status)) {{ strtolower($flagstatusdata->status) }} @endif">@if(!empty($flagstatusdata->cur_status)) @if($flagstatusdata->cur_status == 'awarded') <i class="fa fa-star-half-o" aria-hidden="true"> </i> @endif {{ ucwords($flagstatusdata->cur_status) }} @else <i class="fa fa-ban" aria-hidden="true"> </i>  {{ 'Not Applied' }} @endif</span>
					
					
					</div>
					<div class="inner" >
				
				
						<div class="um-field">
						
								<input type="hidden" name="youthclubreqid" value="12977" />
								<input type="hidden" name="questions" value="4" />
								<input type="hidden" name="user_id" value="{{ Auth::id() }}" />
								
						</div>
					    @php $ii= 1; @endphp	
						@foreach($flags as $que)						
                            @php
								$postid = $que->id;
								$questypeid = $que->questypeid;
								
                            @endphp
						
								<div class="um-field">
									<div class="um-field-label ques ques_row_cont">
										
										<label class="cert-questions"><span class="star-ques-sr">{{$ii}}.</span> {{$que->title}}</label>
										
										<?php 
										
										
										if(!empty($flagdata->id)){
											
										switch ($questypeid) {
											case "101": ?>
											
												<div class="sub_ques_row_cont">
													<table>
														<tr>
														<th>State</th>
														<td> {{ $flagdata->state }} </td>
														</tr>
														
														<tr>
														<th>District</th>
														<td> {{ $flagdata->district }} </td>
														</tr>
														
														<tr>
														<th>Block</th>
														<td> {{ $flagdata->block }} </td>
														</tr>
														
														<tr>
														<th>Number of Members</th>
														<td> {{ $flagdata->noofmembers }} </td>
														</tr>
														
														<tr>
														<th>Name of youth Club</th>
														<td>{{ $flagdata->nameofclub }} </td>
														</tr>
														
														<tr>
														<th>Affiliation Certification Number</th>
														<td> {{ $flagdata->affiliationno }}  </td>
														</tr>
														
													</table>
												</div>
												
												<div class="note"> Disclaimer : Kindly verify the details for Q1, once submitted cannot be edited.
												</div>
												
												<div class="clear"></div>
												
												
												
											<?php
												break;
											case "102": ?>
												
												<div class="sub_ques_row_cont">
													<table>
														<tr>
														<th>Daily group Physical Activities by youth Club</th>
														<th>Please specify</th>
														<th class="minelem">Minutes</th>
														</tr>
														
														
														<tr>
														<td>Any Sports </td>
														<td>
														{{ $flagdata->anysports }}
														
														
														</td>
														<td class="minelem">
														{{ $flagdata->anysportsmin }}
														
														</td>
														</tr>
														
														<tr>
														<td>Traditional Game </td>
														<td>
														
														{{ $flagdata->traditionalgame }}
														</td>
														<td class="minelem">
														{{ $flagdata->traditionalgamemin }}
														
														</td>
														</tr>
														
														<tr>
														<td>Walking</th>
														<td> </td>
														<td class="minelem">
														{{ $flagdata->walkingmin }}
														
														</td>
														</tr>
														
														<tr>
														<td>Cycling</td>
														<td> </td>
														<td class="minelem">
														{{ $flagdata->cyclingmin }}
														
														</td>
														</tr>
														
														<tr>
														<td>Running</td>
														<td> </td>
														<td class="minelem">
														{{ $flagdata->runningmin }}
														
														</td>
														</tr>
														
														<tr>
														<td>Any other physical activity </td>
														<td>
														{{ $flagdata->otherpa }}
														
														</td>
														<td class="minelem">
														{{ $flagdata->otherpamin }}
														
														</td>
														</tr>
														
													</table>
													
												</div>
												
												<div class="note"> Note: Mandatory to fill minimum of 30 minutes to qualify</div>
												<div class="clear"></div>
											

											<?php
												break;
												
											case "103": ?>
												
												<div class="sub_ques_row_cont">
												
													
													<table>
														<tr>
															<td>Undertaking- each member commits to motivate one person every month</td>
															<td>
															<input name="motivatecommits" type="checkbox" value="yes" 
																@if( !empty($flagdata->motivatecommits)) {{ 'checked' }} @endif />
															</td>
														</tr>
														
														<tr>
															<td>Undertaking- Youth Club commits to add at least 10 names/ numbers of motivated persons by 31st March 2021 in the given format</td>
															<td>
															<input name="youthclubcommits" type="checkbox" value="yes" 
															@if( !empty($flagdata->youthclubcommits)) {{ 'checked' }} @endif />
															
															<br>
															If yes (names and phone numbers to be filled by 31st March 2021) Format given below
															</td>
														</tr>
													</table>	
													
													
														@error("mpname") 
															<div class="alert alert-danger">{{ $message }}</div>
														@enderror
														@error("mpcontact") 
															<div class="alert alert-danger">{{ $message }}</div>
														@enderror
														
														@error("mpcontacttype") 
															<div class="alert alert-danger">{{ $message }}</div>
														@enderror
														
														
														@error("mpphyactivity") 
															<div class="alert alert-danger">{{ $message }}</div>
														@enderror
														
													<form method="post" action="{{route('updateyouthcert')}}" enctype="multipart/form-data">
													@csrf
													<input type="hidden" name="youthuptflag" value="{{$flagdata->id}}">
													<input type="hidden" name="youthflagtype" value="motivate">
													<table class="motivate-tbl" id="motivatetbl" >
														
														
														<tr>
															<th>S. No.</th>
															<th>Name of motivated person</th>
															<th>Contact number</th>
															<th>Physical activity/sports</th>
														</tr>
														<?php 
														for($i=0; $i<10; $i++){
														?>
														
														<tr>
															<td>
																<?php echo $i+1; ?>
															</td>
															<td>
																<input type="text" name="mpname[]" value="@if(!empty(unserialize($flagdata->mpname)[$i])) {{ unserialize($flagdata->mpname)[$i] }} @endif" />
															</td>
															<td>
																<input type="text" name="mpcontact[]" value="@if(!empty(unserialize($flagdata->mpcontact)[$i])) {{ unserialize($flagdata->mpcontact)[$i] }} @endif"/>	</td>
															<td>
																<input type="text" name="mpphyactivity[]" value="@if(!empty(unserialize($flagdata->mpphyactivity)[$i])) {{ unserialize($flagdata->mpphyactivity)[$i] }} @endif"/>
															</td>
														</tr>
														<?php 
														}
														?>
														
														
													</table>
													
													
													<div class="um-field">
															<div class="um-field-area">
																<input type="submit" name="youth_club_updbtn" value="Update" />
															</div>
													</div>
													
						</div>
						
													</form>
													
													</div>
												
												<div class="clear"></div>
												
											<?php
												break;
												
												
											case "104": ?>
												<div class="sub_ques_row_cont">
													
													<table>
														<tr>
															<td>Undertaking: Youth club commits to organise at least 1 event every quarter</td>
															<td width="90px">
															<input name="yclubeventcommits" type="checkbox" value="yes" @if(!empty($flagdata->yclubeventcommits)) {{ 'checked' }} @endif />
															
														
														
															</td>
														</tr>
													</table>	
													
													<form method="post" action="{{route('updateyouthcert')}}" enctype="multipart/form-data">
													@csrf
													<input type="hidden" name="youthuptflag" value="{{$flagdata->id}}">
													<input type="hidden" name="youthflagtype" value="event">	
													<input type="hidden" name="eventimg" value="{{$flagdata->eventphoto}}" />
														@error("eventname") 
															<div class="alert alert-danger">{{ $message }}</div>
														@enderror
														@error("noofparticipant") 
															<div class="alert alert-danger">{{ $message }}</div>
														@enderror
														
														@error("noofparticipanttype") 
															<div class="alert alert-danger">{{ $message }}</div>
														@enderror
														
														@error("eventphoto") 
															<div class="alert alert-danger">{{ $message }}</div>
														@enderror

													<table id="eventcommit" >	
													
														<?php 
														for($i=0; $i<4; $i++){
														?>
														
														
														
														<tr>
															<th colspan="2">Fit India event- <?php echo $i+1; ?>: </th>
														</tr>
														
														<tr>
															<td>Name of the event</td>
															<td> <input type="text" name="eventname[]" value="@if(!empty(unserialize($flagdata->eventname)[$i])) {{ unserialize($flagdata->eventname)[$i] }} @endif" />
															</td>
														</tr>
														
														<tr>
															<td>Number of participants</td>
															<td> <input type="text" name="noofparticipant[]"  value="@if(!empty(unserialize($flagdata->noofparticipant)[$i])) {{ unserialize($flagdata->noofparticipant)[$i] }} @endif" />
															
															</td>
														</tr>
														
														<tr>
															<td>Attach photo</td>
															<td> <input type="file" name="eventphoto[$i]" />
															@if(!empty(unserialize($flagdata->eventphoto)[$i])) 
																<a href="{{ unserialize($flagdata->eventphoto)[$i] }}">
																	<img src="{{ unserialize($flagdata->eventphoto)[$i] }}" width="100" height="100" />
																</a>
															@endif
															</td>
														</tr>
														<?php } ?>
													</table>	
													
													<div class="um-field">
															<div class="um-field-area">
																<input type="submit" name="youth_club_updbtn" value="Update" />
															</div>
													</div>
													<div class="clear"></div>
													<div class="note"><u><strong>NOTE :</u> Please submit the complete details of the motivated person every month and event organized quarterly before 31st March 2021 , else your issued certificate will be disqualified.</strong></div>
									
												<div style="clear:both"></div>
													<div class="um-field">
								
						</div>
													</form>
													<div class="um-field-area">
									<a href="{{ route('youthclub-cert') }}"><button type="submit" name="submit_cert" class="btn btn-primary btn-sm" value="Download Certificate" />Download Certificate</button></a>
								</div>
													
													
													
												
												
											<?php
												break;
												
											default:
												break;
										} 
										
										}else{
											
											
											switch ($questypeid) {
											case "101": ?>
											
												<div class="sub_ques_row_cont">
													<table>
														<tr>
														<th>State</th>
														<td>
														<select id="state" name="state" class="form-control @error('state') is-invalid @enderror">
															<option value="">State</option>
															@foreach($states as $state)
																<option value="{{ $state->id }}" @if(old('state') == $state->id) {{ 'selected' }} @endif >{{ $state->name}} </option>
															@endforeach
														</select>
														@error('state')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
								
														</td>
														</tr>
														
														<tr>
														<th>District</th>
														<td>
														<select id="district" name="district" class="form-control @error('district') is-invalid @enderror">
															<option value="">District</option>
															@foreach($districts as $district)
																<option value="{{ $district->id }}" @if(old('district') == $district->id) {{ 'selected' }} @endif >{{ $district->name}} </option>
															@endforeach
														</select>
														@error('district')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
														
														</td>
														</tr>
														
														<tr>
														<th>Block</th>
														<td>
														<select id="block" name="block" class="form-control @error('block') is-invalid @enderror">
															<option value="">Block</option>
															@foreach($blocks as $block)
																<option value="{{ $block->id }}" @if(old('block') == $block->id) {{ 'selected' }} @endif >{{ $block->name}} </option>
															@endforeach
														</select>
														@error('block')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
														</td>
														</tr>
														
														<tr>
														<th>Number of Members</th>
														<td>
														<input type="text" name="noofmembers" class="form-control @error('noofmembers') is-invalid @enderror" value="{{ old('noofmembers') }}" />
														@error('noofmembers')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
														</td>
														</tr>
														
														<tr>
														<th>Name of youth Club</th>
														<td>
										<input type="text" name="nameofclub" class="form-control @error('nameofclub') is-invalid @enderror" value="{{ old('nameofclub') }}" />
														@error('nameofclub')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
														</td>
														</tr>
														
														<tr>
														<th>Affiliation Certification Number</th>
														<td>
														<input type="text" name="affiliationno" class="form-control @error('affiliationno') is-invalid @enderror" value="{{ old('affiliationno') }}" />
														@error('affiliationno')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
														</td>
														</tr>
														
													</table>
												</div>
												
												<div class="note"> Disclaimer : Kindly verify the details for Q1, once submitted cannot be edited.
												</div>
												
												<div class="clear"></div>
												
												
												
											<?php
												break;
											case "102": ?>
												
												<div class="sub_ques_row_cont">
													@error('eachmembermin')
														<div class="alert alert-danger">
															{{ $message }}
														</div>
													@enderror
														
													<table>
														<tr>
														<th>Daily group Physical Activities by youth Club</th>
														<th>Please specify</th>
														<th class="minelem">Minutes</th>
														</tr>
														
														
														<tr>
														<td>Any Sports </td>
														<td>
														<input type="text" name="anysports" class="form-control @error('anysports') is-invalid @enderror" value="{{ old('anysports') }}" />
														@error('anysports')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
														
														</td>
														<td class="minelem">
														<input type="number" name="anysportsmin" class="form-control @error('anysportsmin') is-invalid @enderror" value="{{ old('anysportsmin') }}" min="0" />
														@error('anysportsmin')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
														</td>
														</tr>
														
														<tr>
														<td>Traditional Game </td>
														<td>
														<input type="text" name="traditionalgame" class="form-control @error('traditionalgame') is-invalid @enderror" value="{{ old('traditionalgame') }}" />
														@error('traditionalgame')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
														</td>
														<td class="minelem">
														<input type="number" name="traditionalgamemin" class="form-control @error('traditionalgamemin') is-invalid @enderror" value="{{ old('traditionalgamemin') }}"  min="0" />
														@error('traditionalgamemin')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
														</td>
														</tr>
														
														<tr>
														<td>Walking</th>
														<td> </td>
														<td class="minelem">
														<input type="number" name="walkingmin" class="form-control @error('walkingmin') is-invalid @enderror" value="{{ old('walkingmin') }}" min="0" />
														@error('walkingmin')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
														</td>
														</tr>
														
														<tr>
														<td>Cycling</td>
														<td> </td>
														<td class="minelem">
														<input type="number" name="cyclingmin" class="form-control @error('cyclingmin') is-invalid @enderror" value="{{ old('cyclingmin') }}" min="0" />
														@error('cyclingmin')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
														</td>
														</tr>
														
														<tr>
														<td>Running</td>
														<td> </td>
														<td class="minelem">
														<input type="number" name="runningmin" class="form-control @error('runningmin') is-invalid @enderror" value="{{ old('runningmin') }}"  min="0" />
														@error('runningmin')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
														</td>
														</tr>
														
														<tr>
														<td>Any other physical activity </td>
														<td>
														<input type="text" name="otherpa" class="form-control @error('otherpa') is-invalid @enderror" value="{{ old('otherpa') }}" />
														@error('otherpa')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
														</td>
														<td class="minelem">
														<input type="number" name="otherpamin" class="form-control @error('otherpamin') is-invalid @enderror" value="{{ old('otherpamin') }}" min="0" />
														@error('otherpamin')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
														@enderror
														</td>
														</tr>
														
													</table>
													
												</div>
												
												<div class="note"> Note: Mandatory to fill minimum of 30 minutes to qualify</div>
												<div class="clear"></div>
												
												
												
												


											<?php
												break;
												
											case "103": ?>
												
												<div class="sub_ques_row_cont">
												
													
													<table>
														<tr>
															<td>Undertaking- each member commits to motivate one person every month</td>
															<td>
															<input name="motivatecommits" type="checkbox" value="yes" class="form-control @error('motivatecommits') is-invalid @enderror" @if(!empty(old('motivatecommits'))) {{ 'checked' }} @endif />
															@error('motivatecommits')
																<span class="invalid-feedback" role="alert">
																	<strong>{{ $message }}</strong>
																</span>
															@enderror
															
															</td>
														</tr>
														
														<tr>
															<td>Undertaking- Youth Club commits to add at least 10 names/ numbers of motivated persons by 31st March 2021 in the given format</td>
															<td>
															<input name="youthclubcommits" type="checkbox" value="yes" class="form-control @error('youthclubcommits') is-invalid @enderror" @if(!empty(old('youthclubcommits'))) {{ 'checked' }} @endif onclick="showmotivatetbl(this)" />
															@error('youthclubcommits')
																<span class="invalid-feedback" role="alert">
																	<strong>{{ $message }}</strong>
																</span>
															@enderror
															<br>
															If yes (names and phone numbers to be filled by 31st March 2021) Format given below
															</td>
														</tr>
													</table>	
														@error("mpname") 
															<div class="alert alert-danger">{{ $message }}</div>
														@enderror
														@error("mpcontact") 
															<div class="alert alert-danger">{{ $message }}</div>
														@enderror
														
														@error("mpcontacttype") 
															<div class="alert alert-danger">{{ $message }}</div>
														@enderror
														
														
														@error("mpphyactivity") 
															<div class="alert alert-danger">{{ $message }}</div>
														@enderror
													
													<table class="motivate-tbl" id="motivatetbl" style="@if(empty(old('youthclubcommits'))) {{ 'display:none' }} @endif">
														
														
														<tr>
															<th>S. No.</th>
															<th>Name of motivated person</th>
															<th>Contact number</th>
															<th>Physical activity/sports</th>
														</tr>
														<?php 
														for($i=0; $i<10; $i++){
														?>
														
														<tr>
															<td>
																<?php echo $i+1; ?>
															</td>
															<td>
																<input type="text" name="mpname[]" class="form-control @error("mpname.$i") is-invalid @enderror" value="@if(!empty(old('mpname')[$i])) {{ old('mpname')[$i] }} @endif" />
																@error("mpname.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
															</td>
															<td>
																<input type="text" name="mpcontact[]" class="form-control @error("mpcontact.$i") is-invalid @enderror" value="@if(!empty(old('mpcontact')[$i])) {{ old('mpcontact')[$i] }} @endif" />
																@error("mpcontact.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
															</td>
															<td>
																<input type="text" name="mpphyactivity[]" class="form-control @error("mpphyactivity.$i") is-invalid @enderror" value="@if(!empty(old('mpphyactivity')[$i])) {{ old('mpphyactivity')[$i] }} @endif" />
																@error("mpphyactivity.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
															</td>
														</tr>
														<?php 
														}
														?>
														
														
													</table>
													
													</div>
												
												<div class="clear"></div>
												
											<?php
												break;
												
												
											case "104": ?>
												<div class="sub_ques_row_cont">
													
													<table>
														<tr>
															<td>Undertaking: Youth club commits to organise at least 1 event every quarter</td>
															<td width="90px">
															<input name="yclubeventcommits" type="checkbox" value="yes"  class="form-control @error('yclubeventcommits') is-invalid @enderror" @if(!empty(old('yclubeventcommits'))) {{ 'checked' }} @endif onclick="eventcommit(this)" />
															
															@error('yclubeventcommits')
																<span class="invalid-feedback" role="alert">
																	<strong>{{ $message }}</strong>
																</span>
															@enderror
														
															</td>
														</tr>
													</table>	
													
														@error("eventname") 
															<div class="alert alert-danger">{{ $message }}</div>
														@enderror
														@error("noofparticipant") 
															<div class="alert alert-danger">{{ $message }}</div>
														@enderror
														
														@error("noofparticipanttype") 
															<div class="alert alert-danger">{{ $message }}</div>
														@enderror
														
														@error("eventphoto") 
															<div class="alert alert-danger">{{ $message }}</div>
														@enderror
													<table id="eventcommit" style="@if(empty(old('yclubeventcommits'))) {{ 'display:none' }} @endif">	
													
														<?php 
														for($i=0; $i<4; $i++){
														?>
														
														
														
														<tr>
															<th colspan="2">Fit India event- <?php echo $i+1; ?>: </th>
														</tr>
														
														<tr>
															<td>Name of the event</td>
															<td> <input type="text" name="eventname[]" class="form-control @error("eventname.$i") is-invalid @enderror" value="@if(!empty(old('eventname')[$i])) {{ old('eventname')[$i] }} @endif" />
															@error("eventname.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
															</td>
														</tr>
														
														<tr>
															<td>Number of participants</td>
															<td> <input type="text" name="noofparticipant[]" class="form-control @error("noofparticipant.$i") is-invalid @enderror" value="@if(!empty(old('noofparticipant')[$i])) {{ old('noofparticipant')[$i] }} @endif" />
															@error("noofparticipant.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
															</td>
														</tr>
														
														<tr>
															<td>Attach photo</td>
															<td> <input type="file" name="eventphoto[]" class="form-control @error("eventphoto.$i") is-invalid @enderror" />
															@error("eventphoto.$i") <div class="alert alert-danger">{{ $message }}</div>@enderror
															</td>
														</tr>
														<?php } ?>
													</table>	
													
													
													</div>
													
												<div class="note"><u><strong>NOTE :</u> Please submit the complete details of the motivated person every month and event organized quarterly before 31st March 2021 , else your issued certificate will be disqualified.</strong></div>
									
												<div style="clear:both"></div>
												
											<?php
												break;
												
											default:
												break;
										}
										
											
										}
									
										
										?>
										
										
										
									</div>
									
								</div>
						
						@php  $ii++; @endphp
						
						@endforeach
						
						
						<?php if(empty($flagdata->id)){ ?>
						<div class="um-field">
								<div class="um-field-area">
									<input type="submit" name="youth_club_subbtn" value="Submit" />
								</div>
						</div>						
						<?php } ?>				
					</div>
				
				<?php if(empty($flagdata->id)){ ?> </form> <?php } ?>
				
			</div>
			



<!-- Flag Request Close -->





                    @else
                        <div class="event-form my-event">                    
                            <div class="all-events">
                                <div class="no-events">You aren't registered as Youth Club, you cannot apply for Youth Club Certification</div>
                            </div>
                        </div>

                    @endif

	
				</div>
                </div>

 
            </div>
        </div>
    </div>

</div>	
	
<style>
.event-form input[type="checkbox"] { height: 20px !important; }
span.star-ques-sr, label.cert-questions {
	font-weight: 600;
}
.ques_row_cont{
	margin-bottom:20px;
	padding:10px;
	border-bottom: 1px solid black;
}
.sub_ques_row_cont{
	margin:10px 0;
}
.entry-content tr td, body.et-pb-preview #main-content .container tr td {
	padding: 6px 24px;
	border-top: 1px solid #000;
}
.note{ color:blue; }
.motivate-tbl input[type=text]{  width: 145px; }
input[type=number]{  width: 80px; }
.int-popup { margin: 14% auto; }

.star-rating-content.current {
    border: 2px solid rgba(33,150,243,0.4);
    background-color: rgba(33,150,243,0.04);
}

.star-rating-content {
    margin-top: 30px;
    border: 1px solid #ccc;
    padding: 20px 30px 30px 30px;
    border-radius: 10px;
    position: relative;
}

.star-rating-content.current .rating-heading span.default-i, .star-rating-content.current .rating-heading span.apply-i, .star-rating-content.current .rating-heading span.info-i {
    border: 2px solid #a1d3fa;
    color: #2196f3!important;
}

.star-rating-content.current .rating-heading span.default-i{
    right: -2px;
    top: -2px;
	position: absolute;
    padding: 8px 10px 8px 20px;
    border-radius: 0 10px 0 10px;
    font-style: normal;
}

.entry-content table, body.et-pb-preview #main-content .container table {
    width: 100%;
    margin: 0 0 15px 0;
    border: 1px solid #eee;
    text-align: left;
}
.sub_ques_row_cont {
    margin: 10px 0;
}

.yc-questions table, .yc-questions th, .yc-questions td {
    border: 1px solid rgba(33,150,243,0.5)!important;
}

 table {
    width: 100%;
    margin: 0 0 15px 0;
    border: 1px solid #eee;
    text-align: left;
}

.container tr td {
    padding: 6px 24px;
    border-top: 1px solid #000;
}

.container tr th {
    padding: 9px 24px;
    color: #555;
    font-weight: 700;
}
.yc-questions tr:nth-child(odd) {
    background: #e4f3ff;
}
.note {
    color: #000!important;
    background: #fff27c;
    padding: 8px 15px;
    font-size: 14px;
    font-weight: 400;
}

input[type=submit] {
    background-color: #000 !important;
    color: #fff !important;
    font-weight: 500 !important;
    border: 0 !important;
    padding: 10px 18px !important;
    border-radius: 5px !important;
    cursor: pointer !important;
	box-shadow: none !important;
	text-transform: none !important;
}


}
					
</style>
			
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
  
function showmotivatetbl(elem){
	  if (elem.checked == true){
		 jQuery("#motivatetbl").show();
	  }else{
		 jQuery("#motivatetbl").hide(); 
	  }
	  
	
}
function eventcommit(elem){
	if (elem.checked == true){
		 jQuery("#eventcommit").show();
	  }else{
		 jQuery("#eventcommit").hide(); 
	  }
}		
</script>		
@endsection