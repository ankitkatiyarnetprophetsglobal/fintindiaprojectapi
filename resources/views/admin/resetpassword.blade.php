@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
        
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Reset Password</li>
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
					<h3 class="card-title"> Change Password</h3>
				</div>
				  
				
				
				
				
					<form action="{{ route('admin.resetpassword') }}" method="POST" id="reset-password" novalidate="novalidate">	
					@csrf			
					<div class="row m-3">
					<div class="col-md-12">
									  
						@if (session('success'))
							<div class="alert alert-success">
								{{ session('success') }}
							</div>
						@endif
						
						<h5>Password must contain the following:</h5>
						<ul id="message">
							<li>A <b>lowercase</b> letter</li>
							<li>A <b>capital (uppercase)</b> letter</li>
							<li>A <b>number</b></li>
							<li>Minimum <b>8 characters</b></li>
							<li>Special Character <b>And at least one special character. This can be: !, @, # or any other.</b></li>
						</ul>
					   
					   
						 <div class="form-group"> 
							<label for="password">New Password</label>
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

										@error('password')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
										
						</div>
						
						<div class="form-group"> 
							<label for="password">Confirm Password</label>
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">

										@error('password')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
										
						</div>
						  
						
								
								
						<button class="btn btn-primary" type="submit" value="UPDATE">UPDATE</button>

					</div> 
					</div> 
					   
				   </form>
					
					
				
				  
				  
			</div>
			
			
          
			</div>
		</div>
    </div>
    </section>
    <!-- /.content -->
  </div>
@endsection
