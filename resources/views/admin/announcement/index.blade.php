@extends('admin.layouts.app')
@section('title', 'Announcement - Fit India')
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
            <h1>Announcement</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Announcements</li>
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
                  <div class="row" style="margin-right: -85px;">
                    <div class="col-md-2">
                         <a href="{{ route('admin.announcement.create') }}"> <input type="submit" value="Create New Announcement" class="btn btn-success btn-sm float-right"> </a>
						 <div class="card-tools float-sm-left">Announcements: <strong>{{ $annunce_count }}</strong></div><br>
                    </div>
                </div> 
              </div>
              <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
          <table class="table table-striped projects">
              <thead >
                  <tr class="thead-dark">
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Url</th>
                    <th scope="col">Description</th>
                    <th scope="col">status</th>
                    <th scope="col" width="40px">Image</th>
                    <th scope="col" width="40px">Doc Url</th>
                    <th scope="col">Action</th>
                    <th scope="col"></th>
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                @foreach ($annunce as $annu)
                  <tr>
                    <th scope="row">{{++$i}}</th>
                     <td>{{ $annu->title }}</td>
                      <td>{{ $annu->url }}</td>
                      <td>{{ $annu->description }}</td>
                      <td>
                          @if($annu->status==1)
                            <span class="label label-success">Active</span>
                          @else
                          <span class="label label-danger">Dective</span>
                          @endif
                      </td>
                      <td> 
                         <!--  /var/www/html/fitind/wp-content -->
                          <img src= "{{ $annu->image }}" width="70px">
                      </td>
                      <td><a href="{{ $annu->doc }}" target="_blank">Document Url</a></td>
                      <td style="width:120px;display:inline-flex !important;">  
                        &nbsp;<a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.announcement.edit', $annu->id) }}"> <i class="fas fa-pencil-alt"></i></a>
                        &nbsp;&nbsp;
                        <form action="{{ route('admin.announcement.destroy', $annu->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                         <button  style="display: inline !important;" class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash" aria-hidden="true" onclick="return confirm('Do you want to delete ?')"></i>&nbsp;</button>
                       </form>              
                      @if($annu->status==1)                     
                      &nbsp;<a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.announcement.status', $annu->id)}}"><i class="fa fa-check-square" aria-hidden="true"></i></a>
                      @elseif($annu->status==0)
                      &nbsp;<a style="display: inline !important;" class="btn btn-danger btn-xs" href="{{ route('admin.announcement.status', $annu->id)}}"><i class="fa fa-ban" aria-hidden="true"></i></a>
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