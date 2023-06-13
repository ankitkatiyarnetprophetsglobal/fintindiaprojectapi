@extends('admin.layouts.app')
@section('title', 'Fit India Admin-Edit Block')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">           
			<a class="" href="{{ route('admin.blocks.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
            <h1>Update Block</h1>
          </div>
        </div>
          <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('admin.blocks.index') }}"> Blocks</li></a>
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
                <h3 class="card-title">Update Block</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
			  
              <form method="POST" action="{{ route('admin.blocks.update',$block->id) }}" >
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

                    <label for="exampleInputEmail1">District Name</label>
                    <select class="form-control" id="district" name="district" placeholder="Enter District Name">
				
                      @foreach($districts as $district)
					  @if($block->district_id==$district->id)
                     
                      <option value="{{ $district->id }}">{{ $district->name }}</option>
                      @endif
                      
                      
                      @endforeach
        
                    </select>
                  </div>
                   
                     <div class="form-group">
                    <label for="exampleInputEmail1">Block Name</label>
                    <input type="text" class="form-control" id="block" name="name" value="{{$block->name}}" placeholder="Enter District Name">
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