@extends('admin.layouts.app')
@section('title', 'Fit India Admin-Post Category')
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
            <h1>Post Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Post Category</li>
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
                    <a class="btn btn-success btn-sm" href="{{ route('admin.category.create') }}">Create New Category</a>
					<div class="card-tools float-sm-left">PostCategory: <strong>{{ $categories_count }}</strong></div><br>
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
                    <th scope="col">Category</th>
                    <th scope="col">Group</th>
                    <th scope="col">status</th>
                    <th scope="col">Category Image</th>
                    <th scope="col">Action</th>
                    <th scope="col"></th>
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                @foreach ($categories as $category)

                  <tr>
                    <th scope="row">{{++$i}}</th>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->group }}</td>
                    <td>
                        @if($category->post_status==1)
                        Active
                        @else($category->post_status==0)
                        Deactive
                        @endif
                    </td>
                    
                    <td> 
                        <img src= "{{ $category->image }}" width="70px">
                    </td> 

                     <td style="width:120px;display:inline-flex !important;">  
                        <a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.category.edit',$category->id) }}"> 
                            <i class="fas fa-pencil-alt"></i></a>&nbsp;<form action="{{ route('admin.category.destroy',$category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                         <button  style="display: inline !important;"class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash" aria-hidden="true" onclick="return confirm('Do you want to delete ?')"></i>&nbsp;</button>
                       </form>             
                      @if($category->post_status==1)
                      &nbsp;&nbsp;<a style="display: inline !important;" class="btn btn-info btn-xs" href="{{url('admin/post_status/0')}}/{{$category->id}}"><i class="fa fa-check-square" aria-hidden="true"></i></a>&nbsp;&nbsp; 
                     @elseif($category->post_status==0)
                      <a style="display: inline !important;" class="btn btn-danger btn-xs" href="{{url('admin/post_status/1')}}/{{$category->id}}"><i class="fa fa-ban" aria-hidden="true"></i></a>
                      @endif              
                     </td>  
                     <td></td>   
                  </tr>
                  @endforeach
              </tbody>
          </table>
           <div class="d-flex justify-content-center">
               {{ $categories->links() }}
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