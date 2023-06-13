@extends('admin.layouts.app')
@section('title', 'Fit India Admin - All Event Category')
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
            <h1>Event Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Event Category</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                  <div class="row">
                    <div class="col-md-2">
                         <a href="{{ route('admin.eventcats.create') }}"> <input type="submit" value="Create new EventCategory" class="btn btn-success btn-sm float-right"> </a>
						 <div class="card-tools float-sm-left">EventCategory: <strong>{{ $eventcats_count }}</strong></div><br>
                  </div>
                  <div class="col-md-2">
                  </div>
                </div> 
              </div>
              <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
              
          <table class="table table-striped projects">
              <thead >
                  <tr class="thead-dark">
                    <th scope="col">#</th>
                    <th scope="col">Event CategoryName</th>
                    <th scope="col">Group</th>
                    <th scope="col">status</th>
                    <th scope="col">Action</th>
                    <th scope="col"></th>
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                @foreach($eventcats as $eventcat)

                  <tr>
                    <th scope="row">{{++$i}}</th>
                    <td>{{ $eventcat->name }}</td>                      
                    <td>{{ $eventcat->group }}</td>
                      <td>
                        @if($eventcat->status==1)
                        Active
                        @else($eventcat->status==0)
                        Deactive
                        @endif
                      </td> 
                      <td style="width:120px;display:inline-flex !important;">  
                      &nbsp;<a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.eventcats.edit',$eventcat->id) }}"> <i class="fas fa-pencil-alt"></i></a>
                      &nbsp;&nbsp;
                      <form action="{{ route('admin.eventcats.destroy',$eventcat->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                       <button  style="display: inline !important;" class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash" aria-hidden="true" onclick="return confirm('Do you want to delete ?')"></i>&nbsp;</button>
                       </form>
                                
                      @if($eventcat->status==1)             
                      &nbsp;<a style="display: inline !important;" class="btn btn-info btn-xs" href="{{url('admin/status/0')}}/{{$eventcat->id}}"><i class="fa fa-check-square" aria-hidden="true"></i></a>
                      @elseif($eventcat->status==0)
                      &nbsp;<a style="display: inline !important;" class="btn btn-danger btn-xs" href="{{url('admin/status/1')}}/{{$eventcat->id}}"><i class="fa fa-ban" aria-hidden="true"></i></a>
                      @endif
                      
                      </td>
                      <td></td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
         </div>
      </div>
        </div>
      </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
@endsection