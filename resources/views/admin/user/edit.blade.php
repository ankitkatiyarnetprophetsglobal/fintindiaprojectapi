@extends('admin.layouts.app')
@section('title', 'Fit India Admin-Edit Users')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">          	
			<a class="" href="{{ route('admin.users.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
            <h1>Update User</h1>
          </div>
		</div> 		
		<div class="row mb-2">  
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item "><a href="{{ route('admin.users.index') }}"> User</li></a>
              <li class="breadcrumb-item active">Edit User</li>
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
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update User</h3>
              </div>
              @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('msg') }}
                            </div>
                @endif
                <div style="clear:both"></div>
                
              <form method="POST" action="{{ route('admin.users.update',$result->id) }}" >
			          @csrf
					      @method('PATCH')
                
                             <input type="hidden" value="{{$result->user_id}}" name="user_id">
							<div class="card-body">							 
                             <div class="form-group">
                                        <label for="formGroupExampleInpu">Name</label>
                                        <input id="" name="name" type="text" placeholder="Name"
                                            value="{{$result->name}}" class="form-control" >
                                            {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInpu"> Mobile</label>
                                        <input id="" name="phone" type="tel" maxlength="10" placeholder=" Mobile" value="{{$result->phone}}" class="form-control">
                                        {!!$errors->first("phone", "<span class='text-danger'>:message</span>")!!}
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInpu"> Email</label>
                                        <input id="" name="email" type="text"  placeholder="email" value="{{$result->email}}" class="form-control" readonly>
                                        {!!$errors->first("email", "<span class='text-danger'>:message</span>")!!}
                                    </div>
                                    
 
                                    <div class="form-group">
                                        <label for="formGroupExampleInpu">State</label>
                                        <select id="state" name="state" class="form-control" aria-required="true" class="form-control">
                                    <?php
                                    foreach($state as $st){
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
                                      {!!$errors->first("state", "<span class='text-danger'>:message</span>")!!}
                                      </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="formGroupExampleInpu">District</label>
                                        <select id="district" name="district" class="form-control" aria-required="true">
                        
                        <?php
                            foreach($district as $dst){
                                
                                
                              if(strtolower(trim($dst->name)) == strtolower(trim($result->district)))
                              {
                                 $sel= 'selected';
                                
                                 
                               } else {
                                  $sel = '';
                                  
                                } 
                                 ?>  
                                 
                                <option value="{{$dst->id}}" <?=$sel?>>{{ $dst->name }}</option>                              
                              <?php  } ?>
                              {!!$errors->first("district", "<span class='text-danger'>:message</span>")!!}
                              
                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInpu">Block</label>
                                       <select id="block" name="block" class="form-control" aria-required="true">
                              <?php
                              foreach($block as $blk){
                              if(strtolower(trim($blk->name)) == strtolower(trim($result->block)))
                              {
                                 $sel= 'selected';
                                
                                 
                               } else {
                                  $sel = '';
                                  
                                } 
                                 ?>  
                                <option value="{{$blk->id}}" <?=$sel?>>{{ $blk->name }}</option>                              
                              <?php  } ?>
                              {!!$errors->first("block", "<span class='text-danger'>:message</span>")!!}
                                    </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="formGroupExampleInpu">City</label>
                                        <input id="ep_city" name="city" type="text" placeholder="City" maxlength="50"
                                            value="{{$result->city}}" class="form-control">
                                            {!!$errors->first("city", "<span class='text-danger'>:message</span>")!!}
                                    </div>

                                    <div class="form-group">
                                        <label>Pincode</label>
                                        <input id="ep_pincode" name="pincode" type="text" placeholder="Pincode"
                                            maxlength="6" value="{{$result->pincode}}" class="form-control">
                                           
                                    </div>
                                    

                                    
                                       
                                    <div class="form-group">
                                        <button type="submit" name="updateprofile" value="Submit" class="btn-primary">Update</button>
                                    </div>
                                </form>
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


            <script type="text/javascript">
                $('#state').change(function(){
                    state_id = $('#state').val();
                    $.ajax({
                        url: "{{ route('admin.user-profile-dis') }}",
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
                        url: "{{ route('admin.user-profile-blk') }}",
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
@endsection
             
             
                      

                                    


               


              