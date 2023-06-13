
@extends('admin.layouts.app')
@section('title', 'Fit India Admin-All Posts')

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
            <h1>Posts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"aria-current="page">Posts</li>
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
         <a href="{{ route('admin.posts.create') }}"> <input type="submit" value="create new posts" class="btn btn-sm btn-success float-left"> </a>
          <div class="card-tools float-sm-left">No of Posts: <strong>{{ $post_count }}</strong></div><br>
        </div>
        <div class="col-md-10">
        <form class="form-inline my-2 my-lg-0 rtside " method="GET" action="{{ route('admin.posts.index') }}">
                <div class="form-group rtside">

                  <select class="custom-select custom-select mb-3" name="postcategory" id="category" style="width:180px" >
            <option value="">Select Category</option>       
             @foreach($post_category as $post_cat)
              <option data-name="{{ $post_cat->id }}" value="{{ $post_cat->name }}">{{ $post_cat->name }}</option> 
             @endforeach            
          </select>
                   
                  <button type="search" name="search" value="search" class="btn btn-primary btn-sm"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
                </div>
            </form>
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
                    <th scope="col">Category</th>
                    <th scope="col">Description</th>
                    <th scope="col" width="40px">Image</th>
                    <th scope="col">Action</th>
                    <th scope="col"></th>
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                @foreach ($posts as $post)
                  <tr>
                    <th scope="row">{{++$i}}</th>
                    
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->post_category }}</td>
                    <td>{{ $post->description }}</td>
                    <td> 
                        <img src= "{{ $post->image }}" width="70px">
                    </td>   
                     <td style="width:120px;display:inline-flex !important;">  
                        <a class="btn btn-info btn-xs" href="{{ route('admin.posts.show',$post->id) }}"> <i class="fa fa-eye" title="View" aria-hidden="true"></i></a>&nbsp;&nbsp;
                        <a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.posts.edit',$post->id) }}"> <i class="fas fa-pencil-alt"></i></a>
                        &nbsp;&nbsp;
                        <form action="{{ route('admin.posts.destroy',$post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                         <button  style="display: inline !important;"class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash" aria-hidden="true" onclick="return confirm('Do you want to delete ?')"></i>&nbsp;</button>
                       </form>
                     </td>    
                  </tr>
                  @endforeach
              </tbody>
          </table>
          <div class="d-flex justify-content-center">
           {{ $posts->links() }}
         </div>
         </div>
      </div>
        </div>
      </div>
      </div>
    </section>
    
  </div>
@endsection