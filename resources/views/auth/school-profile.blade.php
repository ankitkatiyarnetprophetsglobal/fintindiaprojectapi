
@extends('layouts.app')
@section('title', ' Edit Profile | Fit India')
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
                                <h2>Update Profile</h2>
								@if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                <form id="fi-register" class="register-form" action="{{ url('update-school') }}/{{Auth::user()->id}}" method="post" novalidate="novalidate">
                              @csrf
                              @method('PUT')
                             <input type="hidden" value="{{$result->user_id}}" name="user_id"> 
                      
                             


                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
  
                    </div>
                @endif
                
                <div style="clear:both"></div>
                

                                    <div class="form-row">
                                        <label>School Name</label>
                                        <input id="" name="name" type="text" placeholder="School Name"
                                            value="{{$result->name}}">
											{!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
                                    </div>
									
                                    <div class="form-row">
                                        <label>No. of Students</label>
                                        <input id="" name="students" type="text" placeholder="No. of Students"
                                            value="{{$result->students}}">
											{!!$errors->first("students", "<span class='text-danger'>:message</span>")!!}
                                    </div>
									
									<div class="form-row">
                                        <label>Principal Name</label>
                                        <input id="" name="pname" type="text" placeholder="Principal Name"
                                            value="{{$result->pname}}">
											{!!$errors->first("pname", "<span class='text-danger'>:message</span>")!!}
											
                                    </div>
									
									 <div class="form-row">
                                        <label>Principal Mobile</label>
                                        <input id="" name="pmobile" type="tel" maxlength="10" placeholder="Principal Mobile" value="{{$result->pmobile}}">
										{!!$errors->first("pmobile", "<span class='text-danger'>:message</span>")!!}
                                    </div>
									
									 <div class="form-row">
                                        <label>Board Affiliation Number</label>
                                        <input id="" name="affiliationnum" type="tel" maxlength="10"
                                            placeholder="Affiliation Numbere" value="{{$result->affiliationnum}}">
											{!!$errors->first("affiliationnum", "<span class='text-danger'>:message</span>")!!}
                                    </div>
									
									<div class="form-row">
                                        <label>Udise</label>
                                        <input id="" name="udise" type="tel" maxlength="10"
                                            placeholder="Udise Numbere" value="{{$result->udise}}">
											{!!$errors->first("udise", "<span class='text-danger'>:message</span>")!!}
                                    </div>
									
									<div class="form-row">
                                        <label> Mobile</label>
                                        <input id="" name="phone" type="tel" maxlength="10" placeholder=" Mobile" value="{{$result->phone}}">
										{!!$errors->first("phone", "<span class='text-danger'>:message</span>")!!}
                                    </div>
                                    
 
                                    <div class="form-row">
                                        <label>State</label>
                                        <select id="state" name="state" class="required" aria-required="true">
                                    <?php
                                    foreach($states as $st){
                                //echo "<pre>";print_r($st->name);
                              if(strtolower(trim($st->name)) == strtolower(trim($result->state)))
                                 {
                                      $ksel= 'selected';
 
                                        } else {
                                        $ksel = '';
                                  
                                         } 
                                        ?>  
                                

                                    <option value="{{$st->id}}" <?=$ksel?>>{{ $st->name }}</option>                              
                                      <?php } ?>
                                      </select>
                                    </div>

                                    <div class="form-row">
                                        <label>District</label>
                                        <select id="district" name="district" class="required" aria-required="true">
                        
                        <?php
                            foreach($districts as $dst){
                                
                                
                              if(strtolower(trim($dst->name)) == strtolower(trim($result->district)))
                              {
                                 $sel= 'selected';
                                
                                 
                               } else {
                                  $sel = '';
                                  
                                } 
                                 ?>  
                                 
                                <option value="{{$dst->id}}" <?=$sel?>>{{ $dst->name }}</option>                              
                              <?php  } ?>
                              
                        </select>
                                    </div>
                                    <div class="form-row">
                                        <label>Block</label>
                                       <select id="block" name="block" class="required" aria-required="true">
                              <?php
                              foreach($blocks as $blk){
                              if(strtolower(trim($blk->name)) == strtolower(trim($result->block)))
                              {
                                 $sel= 'selected';
                                
                                 
                               } else {
                                  $sel = '';
                                  
                                } 
                                 ?>  
                                <option value="{{$blk->id}}" <?=$sel?>>{{ $blk->name }}</option>                              
                              <?php  } ?>
                                    </select>
                                    </div>

                                    <div class="form-row">
                                        <label>City</label>
                                        <input id="ep_city" name="city" type="text" placeholder="City" maxlength="50"
                                            value="{{$result->city}}">
											{!!$errors->first("city", "<span class='text-danger'>:message</span>")!!}
                                    </div>

                                    <div class="form-row">
                                        <label>Pincode</label>
                                        <input id="ep_pincode" name="pincode" type="text" placeholder="Pincode"
                                            maxlength="6" value="{{$result->pincode}}">
											{!!$errors->first("pincode", "<span class='text-danger'>:message</span>")!!}
                                    </div>
									
								<div class="form-row">					
                                       <label>Board</label>
                                       <select id="board" name="board">
											<?php
										foreach($boards as $board){
                                
                                
										if(strtolower(trim($board->boardname)) == strtolower(trim($result->board)))
											{
												$sel= 'selected';
                                
                                 
											} else {
											$sel = '';
                                  
													} 
											?>  
                                 
                                <option value="{{$board->id}}" <?=$sel?>>{{ $board->boardname }}</option>                              
                              <?php  } ?>
                                     </select> 
                                                
                                    </div>
									
									<div class="form-row">							
                                        <label>Chain (optional)</label>
                                        <select id="chain" name="chain">
                                           <?php
										foreach($chainopts as $chainopt){
                                
                                
										if(strtolower(trim($chainopt->chainname)) == strtolower(trim($result->chain)))
											{
												$sel= 'selected';
                                
                                 
											} else {
											$sel = '';
                                  
													} 
											?>  
                                 
                                <option value="{{$chainopt->id}}" <?=$sel?>>{{ $chainopt->chainname }}</option>                              
                              <?php  } ?>
                                        </select>
                                    </div>
									
                                    
									
									<div class="form-row">
                                        <label>Address</label>
                                        <input id="" name="region" type="text"
                                            placeholder="Address" maxlength="50" value="{{$result->region}}">
											{!!$errors->first("region", "<span class='text-danger'>:message</span>")!!}
                                    </div>
									
									<div class="form-row">
                                        <label>Landmark</label>
                                        <input id="" name="landmark" type="text"
                                            placeholder="Landmark" maxlength="50" value="{{$result->landmark}}">
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

                                    <div class="form-row ">
                                        <input type="submit" name="updateprofile" value="Submit" class="widthblock">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <script type="text/javascript">
                $('#state').change(function(){
                    state_id = $('#state').val();
                    $.ajax({
                        url: "{{ route('profile-dis') }}",
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
                        url: "{{ route('profile-blk') }}",
                        type: "post",
                        data: { "id":dist_id,"_token": "{{ csrf_token() }}"} ,
                        success: function (response) {
                           console.log(response);
                           $('#block').html(response);
                        },
                    });
                });
            </script>			
            </div>
        </div>
    </div>
</div>
</div>
    <br><br><br><br>
</div>
@endsection