@extends('admin.layouts.app')
@section('title', 'Create District - Fit India')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <a class="btn btn-primary btn-sm" href="{{ route('admin.districts.index') }}"> Back</a>
            <h1>Add District</h1>
          </div>
          </div>
     <div class="row mb-2">  
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('admin.districts.index') }}">District</a></li>
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
                <h3 class="card-title">Add District</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.districts.store') }}" >
			          @csrf
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

                    <label for="exampleInputEmail1">State Name</label>
                    <select class="form-control" id="state" name="state" placeholder="Enter State Name">
					<option value="">select state</option>
                      @foreach($states as $state)
                      
                      <option value="{{ $state->id }}">{{ $state->name }}</option>
                      @endforeach
        
                    </select>
                  </div>
                   
                     <div class="form-group">
                    <label for="exampleInputEmail1">District Name</label>
                     <textarea type="text" class="form-control" id="district" name="name" placeholder="Enter District Name" cols="20" rows="10"></textarea>
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