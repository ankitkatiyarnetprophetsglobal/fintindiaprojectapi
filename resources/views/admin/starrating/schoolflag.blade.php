@extends('admin.layouts.app')
@section('title', 'School Certificate Request Detail')
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
</style>
<div class="content-wrapper">
	<section class="content-header">
      <div class="container-fluid">
		<div class="row mb-2">
          <div class="col-sm-6">
            <a class="" href="{{ route('admin.starratings.index') }}"> <i class="fas fa-long-arrow-alt-left"></i>Back </a>
          </div>
        </div>		
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>School Certification Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('admin.starratings.index') }}">School Certificates</a></li>
				<li class="breadcrumb-item active" aria-current="page">Detail</li>
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
		  
		  
			<div class="card card-primary direct-chat direct-chat-primary">
				<div class="card-header">
					<h3 class="card-title">Request for Fit India {{ $flags->name }}</h3>
				</div>
				  
				
				<div class="card-body">
				
					<div class="row">
						<div class="col-md-12 mt-3 ml-3">
						
						<dl class="row ml-3">
						  <dt class="col-sm-2">Name</dt>
						  <dd class="col-sm-10">{{ $users[0]->name }}</dd>
						  
						  <dt class="col-sm-2">Email</dt>
						  <dd class="col-sm-10">{{ $users[0]->email }}</dd>
						  
						  <dt class="col-sm-2">Phone</dt>
						  <dd class="col-sm-10">{{ $users[0]->phone }}</dd>
						  
						  <dt class="col-sm-2">State</dt>
						  <dd class="col-sm-10">{{ $users[0]->state }}</dd>
						  
						  <dt class="col-sm-2">District</dt>
						  <dd class="col-sm-10">{{ $users[0]->district }}</dd>
						  
						  <dt class="col-sm-2">Block</dt>
						  <dd class="col-sm-10">{{ $users[0]->block }}</dd>
						</dl>
						
						<hr>
						<dl class="row mt-3" style="width:98%;">
						<?php
						  
						  // School Flag
						  if($flags->id == 1621){
							  $qno = 1;
						  foreach($certques as $certque){ ?>
						  
							<dt class="col-sm-12 ques">{{$qno}}. {{ $certque->title }} </dt>
							<dd class="col-sm-12 mt-3 ml-3">							  
							<?php
								$questypeid = $certque->questypeid;
								
								switch ($questypeid) {
											case "1": ?>
											
											
											<dl class="row mt-3">
											  <dt class="col-sm-4">No. of teachers trained in PE </dt>
											  <dd class="col-sm-8">{{ $flagdata->peteacherno }}</dd>
											</dl>
												<div class="sub_ques_row pe-ques-detail" id="peteachernamerow" >
													@if(!empty($flagdata->peteacherno))
														<dl class="row">
														  <dt class="col-sm-4">Name of teachers </dt>
														  <dd class="col-sm-8">
														  @php $i = 1;  @endphp
														
															@if(!empty($flagdata->peteachernames))
															@foreach(unserialize($flagdata->peteachernames) as $peteachernames)
															<div>
																<span>{{$i++}} . </span>
																	{{ $peteachernames }}
															</div>
														   @endforeach
															@endif
														  </dd>
														</dl>
														<div class="clear"></div>
													@endif
												</div>
											<?php
												break;
											case "2": ?>
												
												<dl class="row mt-3">
													  <dt class="col-sm-4">No. of Playgrounds </dt>
													  <dd class="col-sm-8">
														@if(!empty($flagdata->playgroundno)) 
															{{ $flagdata->playgroundno }}
														@endif
														</dd>
												</dl>
											
											
											<div class="sub_ques_row sub_ques-head" id="playgroundrow" >
												
												
												@if(!empty($flagdata->playgroundno))
												
											
												
												<div class="sub_ques_elem">
													
													<dl class="row">
													  <dt class="col-sm-12">Playgrounds</dt>
													</dl>
											
													<dl class="row">
														<dt class="col-sm-1">#</dt>
														<dt class="col-sm-2">Shape</dt>
														<dt class="col-sm-2">Area (sqft</dt>
														<dt class="col-sm-2">Longest Side (ft)</dt>
														<dt class="col-sm-3">Distance from School(Km)</dt>
														<dt class="col-sm-2">Attachment</dt>
													</dl>	
													@php $i = 0; @endphp
													@if(!empty($flagdata->playgroundno))
													@while($i < $flagdata->playgroundno)
													<div class="playground-row playground-heading">
														<div class="playgroundshape">
															<dl class="row">
															<dt class="col-sm-1">{{ ($i+1) }}</dt>
															  <dd class="col-sm-2"> 
																	@if(!empty(unserialize($flagdata->playgroundshape)[$i]))
																		{{ unserialize($flagdata->playgroundshape)[$i] }}
																	@endif
															  </dd>
															  <dd class="col-sm-2"> {{ unserialize($flagdata->playgroundarea)[$i] }}	</dd>
															  <dd class="col-sm-2"> {{ unserialize($flagdata->playgroundlside)[$i] }}	</dd>
															  <dd class="col-sm-3"> {{ unserialize($flagdata->schooldistance)[$i] }}	</dd>
															  <dd class="col-sm-2"> 
															  @if(!empty( unserialize($flagdata->playgroundimg)[$i]) )
															
																@if(substr(unserialize($flagdata->playgroundimg)[$i], -4) == '.pdf')
																	<a href="{{ unserialize($flagdata->playgroundimg)[$i] }}" target="_blank" > View </a>
																	<br>
																	
																@else
																	<a href="{{ unserialize($flagdata->playgroundimg)[$i] }}" target="_blank" ><img src="{{ unserialize($flagdata->playgroundimg)[$i] }}" width="100" height="100" /></a>
																	<br>
																@endif
																
																@endif

															  </dd>
															</dl>
															
														</div>
													</div>
																  
													@php $i++; @endphp
													@endwhile
													@endif
												</div>
												<div class="clear"></div>
												@endif
											</div>
											<div class="sub_ques_row sub_ques-head  playground-section sub_ques-head-padding  playground-section " id="outdoorsportsrow" >
											
											<dl class="row">
												<dt class="col-sm-4">Outdoor Sports Played
													<div> (minimum 2) </div>
												</dt>
											  <dd class="col-sm-8">
												@php
													$outarr = sizeof( unserialize($flagdata->outdoorsports) );
													$i = 0;
												@endphp
												
												@while($i < $outarr) 
														<div>
														
														
														<?php if( unserialize($flagdata->outdoorsports)[$i] == "Any other sport including indigenous games"){
															echo unserialize($flagdata->outdoorsports)[$i]. " : ".$flagdata->othersportsplayed;
														}else{
															echo unserialize($flagdata->outdoorsports)[$i];
														}															?>
														</div>
														
													
													@php $i++; @endphp
												@endwhile
													
													
												
											  </dd>
											</dl>
											
												
													
												<div class="clear"></div>
											</div>
												
												


											<?php
												break;
												
											case "3":
											
												?>
												<div class="mt-3">
													<label><input name="studentspending60min" type="checkbox" value="yes" 
													@if(!empty( $flagdata->studentspending60min )) {{ 'checked' }} @endif /> 
														<div class="back-end fitindia-r box fit-checkbox"><span></span></div>
													</label>
												</div>
												
												
											<?php
												break;
												
												
											case "4":
											
												?>
												<div class="sub_ques_row  sub_ques-head">
												
												
												<dl class="row mt-3">
												  <dt class="col-sm-12">Daily Physical Activities by Students </dt>
												</dl>
											
												<dl class="row">
												  <dt class="col-sm-4">With the Assembly </dt>
													<dd class="col-sm-8">
													@if(!empty( $flagdata->assemblyactivityno ))
																{{ $flagdata->assemblyactivityno }} min
													@endif
													</dd>
												
												
												
												
													<dt class="col-sm-4">Physical Education (PE) Periods</dt>
													<dd class="col-sm-8">
														@if(!empty( $flagdata->physeduperiodno ))
																{{ $flagdata->physeduperiodno }} min
														@endif
													</dd>
												
												
												
													<dt class="col-sm-4">Before School hours/ after school hours</dt>
													<dd class="col-sm-8">
														@if(!empty( $flagdata->schoolclosreno ))
																{{ $flagdata->schoolclosreno }} min
															@endif
													</dd>
													
													<dt class="col-sm-4">Other/free play</dt>
													<dd class="col-sm-8">
														@if(!empty( $flagdata->otheractivityno ))
																{{ $flagdata->otheractivityno }} min
															@endif
													</dd>
													
													
												</dl>
												
											
												</div>
											<?php
												break;
												
											default:
												break;
										}
								
							?>
						  </dd>
							
						  <?php
						  $qno++;
								}
						  }
						  
			// -- School Flag 			  
						  ?>
						  
						  
						  
						  
						  
						 <?php  
						   // Three Star
						  
						 if($flags->id == 1622){
							 $threedata = $flagdata;
							 unset($flagdata);
							 $qno = 1;;
							 foreach($certques as $certque){  ?>
						  
								<dt class="col-sm-12 ques">{{ $qno }}. {{ $certque->title }} </dt>
								<dd class="col-sm-12 mt-3 ml-3">
								<?php
								$questypeid = $certque->questypeid;
										
										switch ($questypeid) {
											case "5": ?>
											
											<dl class="row mt-3">
											  <dt class="col-sm-4">No. of teachers in school</dt>
											  <dd class="col-sm-8">{{ $threedata->totnoteachers }}</dd>
											  
											  <dt class="col-sm-8">No. of teachers in school spending at least 60 minutes/ day for physical activities
														</dt>
											  <dd class="col-sm-4">{{ $threedata->noteachersplaying }}</dd>
											  
											  
											  <dt class="col-sm-8">School encourages teachers to participate in sports or fitness in school? 
														(attach picture/circular)
														</dt>
											  <dd class="col-sm-4">
												@if(substr($threedata->encouragesdoc, -4) == '.pdf')
															<a href="{{ $threedata->encouragesdoc }}" target="_blank" > View </a>
															<br>
														@else
															<a href="{{ $threedata->encouragesdoc }}" target="_blank" ><img src="{{ $threedata->encouragesdoc }}" width="100" height="100" /></a>
															<br>
															
														@endif
											  </dd>
											  
											  
											  <dt class="col-sm-8">School motivates all teachers to do 60 minutes of physical activity every day 
														(eg. Posters, SMS, emails, circulars) (attach relevant doc)
														</dt>
											  <dd class="col-sm-4">
												
														@if(substr($threedata->motivatesdoc, -4) == '.pdf')
															<a href="{{ $threedata->motivatesdoc }}" target="_blank" > View </a>
															<br>
														@else
															<a href="{{ $threedata->motivatesdoc }}" target="_blank" ><img src="{{ $threedata->motivatesdoc }}" width="100" height="100" /></a>
															<br>
														@endif
											  </dd>
											  
											</dl>
											
											
												
												
											<?php
												break;
												case "6": ?>
												
												<dl class="row mt-3">
												  <dt class="col-sm-4">No. of teachers </dt>
												  <dd class="col-sm-8">{{ $threedata->trainedteacherno }}</dd>
												</dl>
											
												
												
													

												<div class="sub_ques_row sub_ques-head  playground-section" id="trainedteacherrow" 
												@empty($threedata->trainedteacherno) @php  echo 'style="display:none"'; @endphp @endempty >
												
												
												@empty($threedata->trainedteacherno)
													@else
													<dl class="row">
													 <dt class="col-sm-1"># </dt>
													 <dt class="col-sm-5">Teacher/Coach Name </dt>
													 <dt class="col-sm-3">Sport 1 </dt>
													 <dt class="col-sm-3">Sport 2 </dt>
													</dl>
												
													<div class="sub_ques_elem fullwidth"> 
													
													<dl class="row">
													@php $i = 0; @endphp
														
													@if(!empty($threedata->trainedteacherno))
													@while($i < $threedata->trainedteacherno)
													
													<dd class="col-sm-1">{{ ($i+1) }}</dd>
													<dd class="col-sm-5">{{ unserialize($threedata->trainedteachername)[$i] }} </dd>
													<dd class="col-sm-3">{{ unserialize($threedata->sportsone)[$i] }}</dd>
													<dd class="col-sm-3">{{ unserialize($threedata->sporttwo)[$i] }}</dd>
													
													@php $i++; @endphp
													@endwhile
													@endif
													
													
													</div>
													<div class="clear"></div>
												
												
												@endempty
												
												
												
												

												</div>
											<?php	
												break;
												
												
												case "7": ?>
												
												
													
													<dl class="row mt-3">
													  <dt class="col-sm-4">Outdoor Sports ( minimum 2 ) </dt>
													  <dd class="col-sm-8">
														
														
														@php
															$outarr = sizeof( unserialize($threedata->outdoorfacility) );
															$i = 0;
														@endphp
												
														@while($i < $outarr) 
															<div style="font-weight:400;"> {{ unserialize($threedata->outdoorfacility)[$i] }}
															@if(unserialize($threedata->outdoorfacility)[$i] == 'Any other sport including indigenous games') : {{ $threedata->outdoorextrafacility }}
															@endif
															</div>
															
														@php $i++; @endphp
														@endwhile
												
														</dd>
													</dl>
														
														
													
													
													<dl class="row">
													  <dt class="col-sm-4">Indoor Sports ( minimum 2 ) </dt>
													  <dd class="col-sm-8">
														
														
														@php
															$outarr = sizeof( unserialize($threedata->indoorfacility) );
															$i = 0;
														@endphp
												
														@while($i < $outarr) 
															<div style="font-weight:400;"> {{ unserialize($threedata->indoorfacility)[$i] }}
															@if(unserialize($threedata->indoorfacility)[$i] == 'Any other sport including indigenous games') : {{ $threedata->indoorextrafacility }}
															@endif
															</div>
															
														@php $i++; @endphp
														@endwhile
														</dd>
													</dl>
														

													
												
												<?php	
												break;
												
												
												case "8":
												?>
												<div class="fitIndia-radio-col fitIndia-checkbox-col fit-no-width check-box-position" style="top:0; ">
													<label><input name="traditionalgames" type="checkbox" value="yes" @if(!empty( $threedata->traditionalgames )) {{ 'checked' }} @endif /> 
														<div class="back-end fitindia-r box fit-checkbox" ><span></span></div>
													</label>
												</div>

												<?php	
												break;
												
												
												case "9":
												?>
												<div class="inner-align" style="margin-top: 15px; width:97%;">
													@if(substr($threedata->schoolcertificate, -4) == '.pdf')
														<a href="{{ $threedata->schoolcertificate }}" target="_blank" > View </a>
														<br>
													@else
														<a href="{{ $threedata->schoolcertificate }}" target="_blank" ><img src="{{ $threedata->schoolcertificate }}" width="100" height="100" /></a>
														<br>
													@endif 
																								
												</div>
												
											<?php
												break;
												
											default:
												break;
										}
										?>
						  </dd>
							
						  <?php $qno++;
									}
						 }
						 ?>
						 
						 
						 
						 
						 
						 
						 <?php
						 
						 // Five Star
						  
						 if($flags->id == 1623){
							 $fivedata = $flagdata;
							 unset($flagdata);
							 $qno = 1;
							 foreach($certques as $certque){  ?>
						  
								<dt class="col-sm-12 ques">{{ $qno }}. {{ $certque->title }} </dt>
								<dd class="col-sm-12 mt-3 ml-3">
								<?php
								$questypeid = $certque->questypeid;
								
						 switch ($questypeid){
												case "9":
												?>
												
												<dl class="row">
											  <dt class="col-sm-10">
											  <input type="checkbox" name="intraschoolcomp[]" value="Conducts quarterly Intra-school Competitions" @if(!empty($fivedata->intraschoolcomp))
																	{{ (collect(unserialize($fivedata->intraschoolcomp))->contains("Conducts quarterly Intra-school Competitions")) ? 'checked':'' }}
																	@endif  />
												 Conducts quarterly Intra-school Competitions (need not be all classes) (attach document)

											  </dt>
											  <dd class="col-sm-2">
												@if(substr($fivedata->quarterintraschooldoc, -4) == '.pdf')
													<a href="{{ $fivedata->quarterintraschooldoc }}" target="_blank" > View </a>
													<br>
												@else
													<a href="{{ $fivedata->quarterintraschooldoc }}" target="_blank" ><img src="{{ $fivedata->quarterintraschooldoc }}" width="100" height="100" /></a>
													<br>
												@endif
											  </dd>
											</dl>
											
											
											<dl class="row">
											  <dt class="col-sm-10">
											  <input type="checkbox" name="intraschoolcomp[]" value="Participates in Inter-school Competition" 
														@if(!empty( $fivedata->intraschoolcomp ))
																	{{ (collect( unserialize($fivedata->intraschoolcomp) )->contains("Participates in Inter-school Competition")) ? 'checked':'' }}
																	@endif
														/>  Participates in Inter-school Competition (attach document)

											  </dt>
											  <dd class="col-sm-2">
												@if(substr($fivedata->participateintraschooldoc, -4) == '.pdf')
													<a href="{{ $fivedata->participateintraschooldoc }}" target="_blank" > View </a>
													<br>
												@else
													<a href="{{ $fivedata->participateintraschooldoc }}" target="_blank" ><img src="{{ $fivedata->participateintraschooldoc }}" width="100" height="100" /></a>
													<br>
												@endif
											  </dd>
											</dl>
											
												
												<dl class="row">
												  <dt class="col-sm-10"><input type="checkbox" name="intraschoolcomp[]" value="Celebrate Annual Sports Day" 
														@if(!empty($fivedata->intraschoolcomp))
																	{{ (collect(unserialize($fivedata->intraschoolcomp))->contains("Celebrate Annual Sports Day")) ? 'checked':'' }}
																	@endif
														/>  Celebrate Annual Sports Day (attach document) </dt>
												  <dd class="col-sm-2">@if(substr($fivedata->celebrateannualsportdoc, -4) == '.pdf')
													<a href="{{ $fivedata->celebrateannualsportdoc }}" target="_blank" > View </a>
													<br>
												@else
													<a href="{{ $fivedata->celebrateannualsportdoc }}" target="_blank" ><img src="{{ $fivedata->celebrateannualsportdoc }}" width="100" height="100" /></a>
													<br>
												@endif</dd>
												</dl>
												
												<dl class="row">
												  <dt class="col-sm-10">Achievements, if any in Inter-school, District, State or National Level  </dt>
												  <dd class="col-sm-2">{{ $fivedata->achievements }}</dd>
												</dl>
											
												
											
												<?php
												break;
												case "10":
												?>
												
												<dl class="row">
											  <dt class="col-sm-10"><input name="alltrainedpe" type="checkbox" value="yes" @if(!empty( $fivedata->alltrainedpe )) {{ 'checked' }}  @endif />
											  All teachers have attended some certified online/offline course on PE for at least one week
												<br>
												(Principal/ Management should certify this on school’s letterhead- attach document)


											  </dt>
											  <dd class="col-sm-2">	
											  @if(substr($fivedata->pecertifieddoc, -4) == '.pdf')
													<a href="{{ $fivedata->pecertifieddoc }}" target="_blank" > View </a>
													<br>
												@else
													<a href="{{ $fivedata->pecertifieddoc }}" target="_blank" ><img src="{{ $fivedata->pecertifieddoc }}" width="100" height="100" /></a>
													<br>
												@endif
												</dd>
											</dl>
											
											
											<?php
												break;
												
												
												
												
												
												case "11": ?>
												
												<dl class="row">
												  <dt class="col-sm-4">No. of Sports Coaches </dt>
												  <dd class="col-sm-8">{{ $fivedata->sportscoachno }}</dd>
												</dl>
											
											
												<dl class="row">
												  <dt class="col-sm-1"> #	</dt>
												  <dt class="col-sm-3"> Coach Name	</dt>
												  <dt class="col-sm-3"> Sports	</dt>
												</dl>
											

												
												@if(!empty( $fivedata->sportscoachno ))
													
												
													
													@php $i = 0; @endphp
													@while($i < $fivedata->sportscoachno )
													
													<dl class="row">
													<dd class="col-sm-1"> {{ ($i+1) }}	</dd>
													<dd class="col-sm-3"> {{ unserialize($fivedata->sportscoachname)[$i] }}	</dd>
													<dd class="col-sm-3"> {{ unserialize($fivedata->coachsports)[$i] }}	</dd>
													
													</dl>
													@php $i++; @endphp	
													@endwhile
														
												
												
												
												@endif

												
											<?php	
												break;
											
											case "12": ?>
												
											<dl class="row">
											  <dt class="col-sm-4"> Board </dt>
											  <dd class="col-sm-6">{{ $fivedata->peboard }}</dd>
											  <dd class="col-sm-2">@if(substr($fivedata->curriculumboarddoc, -4) == '.pdf')
													<a href="{{ $fivedata->curriculumboarddoc }}" target="_blank" > View </a>
													<br>
												@else
													<a href="{{ $fivedata->curriculumboarddoc }}" target="_blank" ><img src="{{ $fivedata->curriculumboarddoc }}" width="100" height="100" /></a>
													<br>
												@endif
												</dd>
											</dl>
											
											
											
											
											
												
										<?php
											break;
											
											
											
											case "13": ?>
												
												 
												<div style="font-weight: 400;margin: 15px;"> Note: Minimum 80% of Students fitness assessment must be done </div>
													
												<dl class="row">
													<dt class="col-sm-4">ID(School Affiliation Code)on schoolfitness.kheloindia.gov.in </dt>
													<dt class="col-sm-4">No of students </dt>
													<dt class="col-sm-4">No of students fitness assessment done </dt>
												</dl>
												<dl class="row">
													<dd class="col-sm-4">{{ $fivedata->schoolfitnessid }} </dd>	
													<dd class="col-sm-4">{{ $fivedata->noofstudents }} </dd>
													<dd class="col-sm-4">{{ $fivedata->noofassessments }} </dd>
													
												</dl>
												
												
											<?php	
												break;
											
											
											case "14": ?>
												<dl class="row mt-3">
													<dt class="col-sm-4">Facilities </dt>
													<dt class="col-sm-4">Open to </dt>

												</dl>
													
													
													<?php
														$i=0;
														while($i < 4){ ?>
														<dl class="row">
															<dd class="col-sm-4">{{ unserialize($fivedata->facilities)[$i] }}  </dd>
															<dd class="col-sm-4">{{ unserialize($fivedata->opento)[$i] }}  </dd>
																 
														</dl>
														<?php $i++; } ?>
														
													
											<?php	
												break;
												
												

											
											default:
												break;
										}
										?>
						  </dd>
							
						  <?php $qno++;
									}
						 }
										
						?>
						 
						 </dl> 
						
						
						</div>
					</div>
				</div>
				  
				  
			</div> 







        </div>
      </div>
	  </div>

    </section>
    <!-- /.content -->
  </div>


@endsection