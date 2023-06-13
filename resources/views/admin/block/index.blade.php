@extends('admin.layouts.app')
@section('title', 'Fit India Admin -All Blocks')
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
            <h1>Blocks</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
              <li class="breadcrumb-item active" aria-current="page">Blocks</li>
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
          <a href="{{ route('admin.blocks.create') }}"> <input type="submit" value="Create New Block" class="btn btn-sm btn-success float-left"> </a>

          <div class="card-tools float-sm-left">No of Blocks: <strong>{{ $blk }}</strong></div><br>
        </div>
        <div class="col-md-10">
          <form class="form-inline my-2 my-lg-0 rtside" method="GET" action="{{ route('admin.blocks.index') }}">
          <input type="search" name="s" class="form-control mr-sm-2" placeholder="Search Block" width="200px">
          <button type="search" class="btn btn-primary btn-sm" name="search" value="search" class="btn btn-primary btn-sm"><i class="fa fa-filter" aria-hidden="true"></i> Filter </button>
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
                    <th scope="col">Block Name</th>
                    <th scope="col">District</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                 @foreach($blocks as $block)
                  <tr>
                    <th scope="row">{{++$i}}</th>
                    <td>
                          {{ $block->name }}
                      </td>
                         @foreach($districts as $district)
                          @if($block->district_id == $district->id)
                            <td>{{$district->name}}</td>
                          @endif
                        @endforeach
                       <td>
                          @if($block->status==1)
                          Active
                          @else($block->status==0)
                          Deactive
                          @endif
                      </td>
                     <td style="width:120px;display:inline-flex !important;">  
                    &nbsp;<a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.blocks.edit',$block->id) }}"> <i class="fas fa-pencil-alt"></i></a>
                    &nbsp;&nbsp;
                    <form action="{{ route('admin.blocks.destroy',$block->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                     <button  style="display: inline !important;" class="btn btn-danger btn-xs" type="submit" onclick="return confirm('Do you want to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;</button>
                    </form> 
                  </td>  
                      
                  </tr>
                  @endforeach
 
              </tbody>
          </table>

        <div class="d-flex justify-content-center">
        {{ $blocks->links() }}
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