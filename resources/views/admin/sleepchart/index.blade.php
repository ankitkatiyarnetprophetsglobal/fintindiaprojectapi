@extends('admin.layouts.app')
@section('title', 'Fit India Admin - SleepCharts')
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
            <h1>Sleep charts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Sleep charts</li>
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
                    <th scope="col">user_name</th>
                    <th scope="col">Bed Date</th>
                    <th scope="col">Bed Time</th>
                    <th scope="col">Wakeup Date</th>
                    <th scope="col">Wakeup Time</th>
                    <th scope="col">Sleep Hours</th>
                    <th scope="col">Goal Achieve</th>
                    <th scope="col">Action</th>
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                @foreach($sleeps as $sleep)
                  <tr>
                    <th scope="row">{{++$i}}</th>
                    <td>
                      @foreach($users as $user)
                          @if($user->id == $sleep->user_id)
                          {{ $user->name }}
                          @endif
                      @endforeach
                    </td>
                    <td>{{ $sleep->bed_date }}</td>
                    <td>{{ $sleep->bed_time }}</td>
                    <td>{{ $sleep->wakup_date  }}</td>
                    <td>{{ $sleep->wakup_time }} </td> 
                    <td>{{ $sleep->sleep_hours }}</td>  
                    <td>{{ $sleep->goal_achieve }}</td>
                     <td style="width:120px;display:inline-flex !important;">  
                        <a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.sleepcharts.edit',$sleep->id) }}"> <i class="fas fa-pencil-alt"></i></a>&nbsp;&nbsp;<form action="{{ route('admin.sleepcharts.destroy',$sleep->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                         <button  style="display: inline !important;"class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;</button>
                         </form>
                       </td>  
                  </tr>
                  @endforeach
              </tbody>
          </table>
         <div class="d-flex justify-content-center">
           {{ $sleeps->links() }}
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