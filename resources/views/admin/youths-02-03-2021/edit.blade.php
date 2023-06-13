@extends('admin.layouts.app')
@section('title', 'Create Posts - Fit India')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Post</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('admin.posts.index') }}"> Back</a>
        </div>
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <!-- Main content -->
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Posts</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.posts.update', $post->id) }}" enctype="multipart/form-data">
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
                            <label for="exampleInputEmail1">Title:</label>
                            <input type="text" name="title"  value="{{ $post->title }}" class="form-control" id="title" placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description:</label>
                            <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $post->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Image:</label>
                            <input type="file" name="image"  class="form-control">
                            <!-- <img src="{{ $post->image }}" height="200" width="200"> -->
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