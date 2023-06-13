@extends('layouts.app')
@section('title', 'share-your-story | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<body>
    <br><br>
    <div class="container" id="{{ $active_section_id }}">
        <div class="row">
            <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <form action="{{ route('sharestory.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="youare">Who are You?*</label>
                            <select name="youare">
                                <option value="Individual">Individual</option>
                                <option value="Govt Organisation">Govt Organisation</option>
                                <option value="Private Organisation">Private Organisation</option>
                                @error('youare')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Designation/occupation *</label>
                            <input type="text" class="form-control" name="designation" value="">
                            @error('designation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Email *</label>
                            <input type="email" class="form-control" name="email" value="">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                         <div class="form-group">
                            <label for="userEmail">Your name as you wish it to appear with your story *</label>
                            <input type="text" class="form-control" name="fullname" value="">
                            @error('fullname')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Story Video Youtube Link (If you've got a video you'd like to share along with your story, put it up on YouTube and enter the link below)</label>
                            <input type="text" class="form-control" name="videourl" value="">
                            @error('videourl')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Story Title *</label>
                            <input type="text" class="form-control" name="title" value="">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                        </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image:</label>
                                <input type="file" name="image" class="form-control" placeholder="Image">
                            </div>
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        <div class="form-group">
                            <label for="userEmail">Your Story *</label>
                            <textarea name="story" cols="30" rows="10" class="form-control"></textarea>
                            @error('story')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                        </div>
                    </div>

                    <div class="modal-footer left">
                         <div class="login-row" style="margin-left: 241px;"> 
                         <div class="um-field" id="capcha-page-cont">
                           <label for="captcha">(Even if you are sharing your story via video, please type 10-15 sentences about it in the box below.)</label><br>
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
                        <button type="submit" class="btn btn-primary">SEND</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
@endsection