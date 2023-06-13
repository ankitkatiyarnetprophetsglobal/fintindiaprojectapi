@extends('layouts.app')
@section('title', 'Login | Fit India')
@section('content')


<section>
  <div class="container">
    <div class="row">
      
      <div class="col-12 signup_frm">
         <div class="frontlogin">
            <form action="{{ route('login') }}" method="POST" id="frontadmin" novalidate="novalidate">	
				    @csrf			
                <p>New to site? 
                   <a id="fi_signup" href="{{ route('register') }}">Create an Account</a>
                </p>
        
               <div class="frm-details">
                 <h1>{{ __('Login') }}</h1>               
                 
                 <div class="login-row"> 
                 <label for="username">Email / Username</label>
					<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
								
                 </div>
                 <div class="login-row"> 
					<label for="password">Password</label>
					<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
								
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
				 
				 
				<!--  <div class="login-row">
                            
                                <div class="">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            
                </div> -->
						
						
                 <input class="submit_button" type="submit" value="LOGIN">

               </div>  
               </form>
			   <br>
			   @if (Route::has('password.request'))
				<p class="forgot-pass"><a href="{{ route('password.request') }}">{{ __('Lost your password?') }}</a></p>
			   @endif
         </div>
      </div>
    </div>

  </div>
 
</section>
<script>
    
jQuery('#reload').click(function () {
    jQuery.ajax({
    type: 'GET',
    url: 'reloadcaptcha',
    success: function (data) {
		jQuery(".captchaimg span").html(data.captcha);
    }
    });
});
</script>


@endsection
