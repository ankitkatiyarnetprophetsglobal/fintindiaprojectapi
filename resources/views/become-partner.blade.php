@extends('layouts.app')
@section('title', 'become a partner | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<body>
<section id="{{ $active_section_id }}">

   
    <div class="container">
        
        <div class="row">
            <div class="col-md-12">
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                <form action="{{ route('become-partner.store') }}" method="POST" >
                    @csrf
                    <div class="card-body">
                    <div class="modal-body">
                        <h2>Become A Partner</h2>
                        <div class="form-group">
                            <label for="youare">Your Name*</label>
                            <input type="text" class="form-control" name="name" value="" >
                               {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Are you representing an Organisation or Group (specify name)?*
                            </label>
                            <input type="text" class="form-control" name="specify" value="">
                           {!!$errors->first("specify", "<span class='text-danger'>:message</span>")!!}
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Designation*
                            </label>
                            <input type="text" class="form-control" name="designation" value="">
                            {!!$errors->first("designation", "<span class='text-danger'>:message</span>")!!}
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Email *</label>
                            <input type="email" class="form-control" name="email" value="">
                             {!!$errors->first("email", "<span class='text-danger'>:message</span>")!!}
                        </div>
                         <div class="form-group">
                            <label for="userEmail">Mobile No*</label>
                            <input type="text" class="form-control" name="contact" value="" maxlength="10">
                             {!!$errors->first("contact", "<span class='text-danger'>:message</span>")!!}
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Website / Social Page (specify one)
                            </label>    
                            <input type="text" class="form-control" name="sociallink" value="">
                             {!!$errors->first("sociallink", "<span class='text-danger'>:message</span>")!!}
                            
                        </div>
                    
                        
                        <div class="form-group">
                            <label for="userEmail">How do you want to contribute to FIT INDIA as a Partner?
                            </label>
                            <textarea name="story" cols="30" rows="10" class="form-control"></textarea>
                             {!!$errors->first("story", "<span class='text-danger'>:message</span>")!!}  
                            
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
                           <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">SEND</button>
                           </div>
                           <div style="clear:both;"></div>
                       </div>
                     </div>
                </form>
            </div>
        </div>
    </div>
    
    </section>
</body>
@endsection