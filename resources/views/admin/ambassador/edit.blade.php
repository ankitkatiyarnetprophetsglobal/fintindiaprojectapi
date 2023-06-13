@extends('admin.layouts.app')
@section('title', Fit India Admin-Edit Ambassador')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Ambassador</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Update Ambassador</li>
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
                <h3 class="card-title">AmbassadorDetail Update</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.states.update',$state->id) }}" >
			          @csrf
					      @method('PATCH')
                <div class="card-body">


                @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('msg') }}
                            </div>
                @endif


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


                 
				        <div class="form-group">
                   
                   <div class="col-sm-12 col-md-9 ">
    <div class="wrap ambassador-form">	
                    <!-- onsubmit="return create_event_validation()" -->
                    @if (session('success'))
                    <div class="alert alert-success">
                    </div>
                    @endif
                    
     <form name="ambassadorform" method="post" action="ambs-store" enctype="multipart/form-data"> 
     @csrf
                    
         <div class="um-field">
           <h2 for="ambassador_name"> FitIndia Ambassador</h2>
         </div>
                        <div class="um-field">
                            <div class="um-field-label">
                              <label for="name">Your Name</label>
                              <div class="um-clear"></div>
                            </div>
                            <div class="um-field-area">
                              <input id="name" type="text" name="name" value="">
                              {!!$errors->first("name","<span class='text-danger'>:message</span>")!!}
                            </div>
                        </div>
                        <div class="um-field">
                            <div class="um-field-label">
                              <label for="EmailId">Email Id</label>
                              <div class="um-clear"></div>
                            </div>
                            <div class="um-field-area">
                              <input id="email" type="text" name="email" value="">
                              {!!$errors->first("email","<span class='text-danger'>:message</span>")!!}
                            </div>
                        </div>
                        <div class="um-field">
                            <div class="um-field-label">
                              <label for="contact">Contact No</label>
                              <div class="um-clear"></div>
                            </div>
                            <div class="um-field-area">
                              <input id="contact" type="text" name="contact" value="">
                              {!!$errors->first("contact","<span class='text-danger'>:message</span>")!!}
                            </div>
                        </div>
                        <div class="um-field">
                            <div class="um-field-label">
                              <label for="Designation">Designation</label>
                              <div class="um-clear"></div>
                            </div>
                            <div class="um-field-area">
                              <input id="designation" type="text" name="designation" value="">
                              {!!$errors->first("designation","<span class='text-danger'>:message</span>")!!}
                            </div>
                        </div>
                        <div class="um-field">
                            <div class="um-field-label">
                              <label for="state_name">State Name</label>
                              <div class="um-clear"></div>
                            </div>
                            <div class="um-field-area">
                              <select name="state_name" id="state">
                              <option value="">Select State</option>
                              @foreach($states as $state)
                              <option value="{{$state->id}}">{{$state->name}}</option> 
                              @endforeach
                              
                            
                               </select>	
                            </div>
                        </div>
                        <div class="um-field">
                            <div class="um-field-label">
                              <label for="district_name">District Name</label>
                              <div class="um-clear"></div>
                            </div>
                            <div class="um-field-area">
                              <select name="district_name" id="district">
                            	<option value="">Select District</option> 
                             </select>	
                            </div>
                        </div>
                        <div class="um-field">
                            <div class="um-field-label">
                              <label for="block_name">Block Name</label>
                              <div class="um-clear"></div>
                            </div>
                            <div class="um-field-area">
                              <select name="block_name" id="block">
                            <option value="">Select Block</option>
                                              </select>	
                            </div>
                        </div>
                        <div class="um-field">
                            <div class="um-field-label">
                              <label for="pincode">Pincode</label>
                              <div class="um-clear"></div>
                            </div>
                            <div class="um-field-area">
                              <input id="pincode" type="text" name="pincode" value="">
                              {!!$errors->first("pincode","<span class='text-danger'>:message</span>")!!}
                            </div>
                        </div>
                        <div class="um-field">
                            <div class="um-field-label">
                              <label for="image">Choose image to upload</label>
                              <div class="um-clear"></div>
                            </div>
                            <div class="um-field-area">
                              <input type="file" id="image" name="image">
                              {!!$errors->first("image","<span class='text-danger'>:message</span>")!!}
                              
                            </div>
                        </div> 
                        <div class="um-field">
                            <div class="um-field-label">
                              <label for="facebook_profile">Your Facebook Profile</label>
                              <div class="um-clear"></div>
                            </div>
                            <div class="um-field-area">
                              <input id="facebook_profile" type="text" name="facebook_profile" value="">
                              {!!$errors->first("facebook_profile","<span class='text-danger'>:message</span>")!!}
                            </div>
                        </div>
                        <div class="um-field">
                            <div class="um-field-label">
                              <label for="twitter_profile">Your Twitter Profile</label>
                              <div class="um-clear"></div>
                            </div>
                            <div class="um-field-area">
                              <input id="twitter_profile" type="text" name="twitter_profile" value="">
                              {!!$errors->first("twitter_profile","<span class='text-danger'>:message</span>")!!}
                            </div>
                        </div>
                        <div class="um-field">
                            <div class="um-field-label">
                              <label for="instagram_profile">Your Instagram Profile</label>
                              <div class="um-clear"></div>
                            </div>
                            <div class="um-field-area">
                              <input id="instagram_profile" type="text" name="instagram_profile" value="">
                              {!!$errors->first("instagram_profile","<span class='text-danger'>:message</span>")!!}
                            </div>
                        </div>
                        <div class="um-field">
                            <div class="um-field-label">
                              <label for="work_profession">Your work Profession</label>
                              <div class="um-clear"></div>
                            </div>
                            <div class="um-field-area">
                              <input id="work_profession" type="text" name="work_profession" value="">
                              {!!$errors->first("work_profession","<span class='text-danger'>:message</span>")!!}
                            </div>
                        </div>
                        <div class="um-field">
                            <div class="um-field-label">
                              <label for="description">Description</label>
                              <div class="um-clear"></div>
                            </div>
                            <div class="um-field-area">
                              <input id="description" type="text" name="description" value="">
                              {!!$errors->first("description","<span class='text-danger'>:message</span>")!!}
                            </div>
                        </div>
                        <div class="um-field">
                            <div class="um-field-area">
                              <input type="submit" name="create-event" value="Submit">
                            </div>
                        </div>    
                        </form>

<script type="text/javascript">
    $('#state').change(function(){
        state_id = $('#state').val();
        state = $('.state_name').val();
        $.ajax({
            url: "{{ route('getdistrict') }}",
            type: "post",
            data: { "id":state_id,"name":state,"_token": "{{ csrf_token() }}"} ,
            success: function (response) {
               console.log(response);
               $('#district').html(response);
            },
            
        });
    });

    $('#district').change(function(){
        dist_id = $('#district').val();
        $.ajax({
            url: "{{ route('getblock') }}",
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
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
           
            

          </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
	
    <!-- /.content -->
  </div>


@endsection