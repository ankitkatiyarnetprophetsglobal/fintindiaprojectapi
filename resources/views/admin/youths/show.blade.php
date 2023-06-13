@extends('admin.layouts.app')
@section('title', 'Show Youth Details - Fit India')
@section('content')
<style>
.mb-3{
	margin-bottom: 0 !important;
	margin-right: 10px;
}
.btn-sm{
	padding: .375rem .75rem;
}
.rtside{
	float:right;
}
.ques{ background: #c5d6e9;
    padding: 10px;
}
.sub_ques_title{ float:left; margin-right:15px; }

.event-form input[type="checkbox"] { height: 20px !important; }
label.cert-questions {
	float: left;
    font-size: 1.1rem;
    font-weight: 400 !important;
	background-color: #007bff;
	color:#ffffff;
    padding:2px 2px;    
}

.ques_row_cont{
	margin-bottom:20px;
	padding:10px;
	border-bottom: 1px solid black;
}
.sub_ques_row_cont{
	margin:2px 0;
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
    background-color:#ffffff;
}

.star-rating-content {
    margin-top: 30px;
    border: 1px solid #ccc;    
	padding: 0px 0px 0px 0px;
    border-radius: 0px;
    position: relative;
}

.star-rating-content.current .rating-heading span.default-i, .star-rating-content.current .rating-heading span.apply-i, .star-rating-content.current .rating-heading span.info-i {
    border: 1px solid #ccc; 
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


}					
</style>
<div class="content-wrapper">    	
	<section class="content-header">
      <div class="container-fluid">
	  <div class="row mb-2">
          <div class="col-sm-6">
            <a class="" href="http://103.65.20.170/fitind/admin/youths"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
           </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>Request for Fit India Youth Club Certification</h1>
          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="http://103.65.20.170/fitind/admin/dashboard">Home</a></li>
				<li class="breadcrumb-item"><a href="#">Youth Clubs</a></li>
				<li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
          </div>
        </div>
      </div>
    </section>	
	
	<section class="content">
	  <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
					<div class="card card-primary direct-chat direct-chat-primary">
						<div class="card-header">
							<h3 class="card-title">Fit India Youth Club Certification Details </h3>
						</div>
						  
						
					<div class="card-body">
						<div class="row">
							<div class="col-md-12 mt-3 ml-3">
		  
							<dl class="row mt-3" style="width:98%;">		 
							  @php $ii= 1; @endphp	
							  
							  @foreach($flags as $que)						
								@php
									$postid = $que->id;
									$questypeid = $que->questypeid;								
								@endphp
								
								<dt class="col-sm-12 ques">{{$ii}}. {{$que->title}} </dt>
								<dd class="col-sm-12 mt-3 ml-3">
							
								<?php 	
									 if(!empty($flagdata->id)){											
										 switch ($questypeid) {
											case "101": ?>											
												<div class="sub_ques_row_cont">
													<table class="table table-striped">
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
													<table class="table table-striped">
														<tr>
														 <th>Daily group Physical Activities by youth Club</th>
														 <th>Please specify</th>
														 <th class="minelem">Minutes</th>
														</tr>
														<tr>
														  <td>Any Sports </td>
														  <td>{{ $flagdata->anysports }}</td>
														  <td class="minelem">{{ $flagdata->anysportsmin }}</td>
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
													<table class="table table-striped">
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
													<table class="table table-striped">
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
																<input type="text" disabled="disabled" name="mpname[]" value="@if(!empty(unserialize($flagdata->mpname)[$i])) {{ unserialize($flagdata->mpname)[$i] }} @endif" />
															</td>
															<td>
																<input type="text" disabled="disabled" name="mpcontact[]" value="@if(!empty(unserialize($flagdata->mpcontact)[$i])) {{ unserialize($flagdata->mpcontact)[$i] }} @endif"/>	</td>
															<td>
																<input type="text" disabled="disabled" name="mpphyactivity[]" value="@if(!empty(unserialize($flagdata->mpphyactivity)[$i])) {{ unserialize($flagdata->mpphyactivity)[$i] }} @endif"/>
															</td>
														</tr>
														<?php }	?>
													 </table>												
						                           </div>						
												</form>													
																						
											<div class="clear"></div>												
											<?php
												break;
											    case "104": ?>
												<div class="sub_ques_row_cont">													
													<table class="table table-striped">
														<tr>
															<td>Undertaking: Youth club commits to organise at least 1 event every quarter</td>
															<td width="90px">
															 <input name="yclubeventcommits"  type="checkbox" value="yes" @if(!empty($flagdata->yclubeventcommits)) {{ 'checked' }} @endif />
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

													<table class="table table-striped">													
													  <?php 
														  for($i=0; $i<4; $i++){
														?>
														<tr>
															<th colspan="2">Fit India event- <?php echo $i+1; ?>: </th>
														</tr>														
														<tr>
															<td>Name of the event</td>
															<td><input type="text" disabled="disabled" name="eventname[]" value="@if(!empty(unserialize($flagdata->eventname)[$i])) {{ unserialize($flagdata->eventname)[$i] }} @endif" />
															</td>
														</tr>														
														<tr>
															<td>Number of participants</td>
															<td><input type="text" disabled="disabled" name="noofparticipant[]"  value="@if(!empty(unserialize($flagdata->noofparticipant)[$i])) {{ unserialize($flagdata->noofparticipant)[$i] }} @endif" />
															</td>
														</tr>														
														<tr>
															<td>Attach photo</td>
															<td>
															@if(!empty(unserialize($flagdata->eventphoto)[$i])) 
																<a href="{{ unserialize($flagdata->eventphoto)[$i] }}">
																	<img src="{{ unserialize($flagdata->eventphoto)[$i] }}" width="100" height="100" />
																</a>
															@endif
															</td>
														</tr>
														<?php } ?>
													</table>
													<div class="clear"></div>
													<div class="note"><u><strong>NOTE :</u> Please submit the complete details of the motivated person every month and event organized quarterly before 31st March 2021 , else your issued certificate will be disqualified.</strong></div>
									
												<div style="clear:both"></div>
													<div class="um-field"></div>
											</form>											
											<?php
												break;												
											default:
												break;
										 } 										
										}			
												
												 
								?>
										

								</dd>

								@php  $ii++; @endphp						
							   @endforeach

							</dl>


						   
						</div>
					 </div>    
					</div>
				  </div>
						 
       </div>
     </div>    
  </div>
</section>
 </div>
@endsection