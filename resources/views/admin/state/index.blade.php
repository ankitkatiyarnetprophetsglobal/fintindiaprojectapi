@extends('admin.layouts.app')
@section('title', 'Fit India Admin - All States')
@section('content')

<style>
.mb-3{ margin-bottom: 0 !important; margin-right: 10px; }
.btn-sm{ padding: .375rem .75rem; }
.rtside{ float:right; }
</style>
<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>States</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                <li class="breadcrumb-item active" aria-current="page">State</li> 
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
      <div class="card">
        <div class="card-header">
        <div class="row">
        <div class="col-md-2">
         <a href="{{ route('admin.states.create') }}"> <input type="submit" value="Create New State" class="btn btn-sm btn-success float-left"> </a>
          <div class="card-tools float-sm-left">No of States: <strong>{{ $st }}</strong></div><br>
        </div>
        <div class="col-md-10">
        <form class="form-inline my-2 my-lg-0 rtside " method="GET" action="{{ route('admin.states.index') }}">
                <div class="form-group rtside">
                   <input type="search" name="s" class="form-control mr-sm-2" placeholder="Search State" width="200px">
                  <button type="search" name="search" value="search" class="btn btn-primary btn-sm"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
                </div>
            </form>
          </div> 
          </div>
        </div>
              <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
         <table class="table table-striped projects">
              <thead>
                  <tr class="thead-dark">
                    <th scope="col">#</th>
                    <th scope="col">States Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                 @foreach($states as $state)
                  <tr>
                    <th scope="row">{{++$i}}</th>
                    <td>
                        
                      {{$state->name}}
                              
                      </td>
                       <td>
                        @if($state->status==1)
                            Active
                        @else($state->status==0)
                            Deactive
                        @endif
                      </td> 
                     <td style="width:120px;display:inline-flex !important;">  
            &nbsp;<a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.states.edit',$state->id) }}"> <i class="fas fa-pencil-alt"></i></a>
            &nbsp;&nbsp;
            <form action="{{ route('admin.states.destroy',$state->id) }}" method="POST">
              @csrf
              @method('DELETE')
             <button  style="display: inline !important;" class="btn btn-danger btn-xs" type="submit" onclick="return confirm('Do you want to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;</button>
             </form> </td>        
                      
                  </tr>
                  @endforeach
 
              </tbody>
          </table>

        <div class="d-flex justify-content-center">
        {{ $states->links() }}
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