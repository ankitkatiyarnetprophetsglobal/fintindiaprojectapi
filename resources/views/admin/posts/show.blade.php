@extends('admin.layouts.app')
@section('title', ' Fit India Admin-Show Posts')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->	
	<section class="content-header">
      <div class="container-fluid">
	   <div class="row mb-2">
          <div class="col-sm-6">           
			<a class="" href="{{ route('admin.posts.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
            <h1>Show Posts</h1>
          </div>
        </div>
	  
        <!--<div class="row mb-2">
          <div class="col-sm-12">
            <h1>Show Posts</h1>
          </div>
		    </div>-->  
		  
    		<div class="row mb-2">  
    		  <div class="col-sm-6">
    		    <div class="pull-right">
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item "><a href="{{ route('admin.posts.index') }}">Posts</a></li>
                  <li class="breadcrumb-item active">show posts</li>
                </ol>
              </div>  
            </div>
          </div>		  
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <hr>	
    <section class="content-header">
      <div class="container-fluid">
        <!-- <div class="row">
          <div class="col-md-12">
          
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">show posts</h3>
              </div>
            </div>
          </div>
		    </div> -->

<!--  <div class="e_img">
             <img src="{{asset('resources/imgs/Fit-India-Dialogue-banner.jpg') }}" />
        </div> -->

	     <div class="row ml-3">		 
      		<div class="col-md-12"> 
          
      		  <div class="card">
                  <div class="card-header card-primary bg_blue">
                  <h3 class="card-title">show posts</h3>
                </div> 
              <div class="e_img" style="padding-left: 244px;">
      			  <img src="{{ $post->image }}" class="card-img-top">
            </div>
      			  <div class="card-body">
      				<h5 class="card-title">Title : <b>{{ $post->title }}</b></h5>
      				<p class="card-text"></p>
      			  </div>

      			  <ul class="list-group list-group-flush">
        				<li class="list-group-item">Category : <b>{{ $post->post_category }}<b></li>
        				<li class="list-group-item">{{ $post->description }}</li>
                <li class="list-group-item">Created at: {{ date('d-m-y', strtotime($post->created_at)) }}</li>
                <li class="list-group-item">Updated at: {{ date('d-m-y', strtotime($post->updated_at)) }}</li>
      			  </ul>
      			</div>
      		</div>
      </div>
	  </div>
    </section>
  </div>
@endsection