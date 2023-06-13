@extends('admin.layouts.app')
@section('title', 'Show Youth Details - Fit India')
@section('content')
<div class="content-wrapper">
<style>
.well {
    min-height: 20px;
    padding: 19px;
    margin-bottom: 20px;
    background-color: #f5f5f5;
    border: 1px solid #e3e3e3;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 5%);
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 5%);
}.img-circle {
    border-radius: 50%;
}
img {
    vertical-align: middle;
}

</style>
    <!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
		<div class="row mb-2">
		  <div class="col-sm-11">
		  	<a class="btn btn-primary btn-sm" href="{{ route('admin.youths.index') }}"> Back</a>
			<h1>{{ $title}}</h1>
		  </div>           
		   <div class="row mb-2">  
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
                <div class="pull-right">
                    
                </div>              
            </ol>
          </div>
		  
		  <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">               
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('admin.youths.index') }}">youthclubs</a></li>
            </ol>
          </div>
		  
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">show Youthclubs</h3>
              </div>
			
		<?php 
		  if(!empty($sdata)){
			  foreach($sdata as $val){				  
                //echo "<pre>";print_r($val);
			?>	 
		    <div class="row content">		   
			 <div class="col-sm-3 sidenav">
			  <hr>
			  <ul class="nav nav-pills nav-stacked">
				<li class="active">
				 <div class="well">				  
				  <img src="{{URL::asset('admin/dist/img/default.png')}}" class="img-circle" height="" width="155">
				 </div>				
				</li>
                <li><h6></h6></li>				
			  </ul><br>			 
			</div>
			<div class="col-sm-9">
			  <hr>
			  <h2><?=$val->name?></h2>
			  <h5><span class="glyphicon glyphicon-time"></span>( <?=$val->email?> )</h5>
			  <h5><span class="label label-danger"><b>Club Name : </b> <?=$val->nameofclub?></span><span class="label label-primary"></span></h5><br>
			  <p><b>State Name : </b> <?=$val->state?></p>
			  <p><b>District Name : </b> <?=$val->district?></p>
			  <p><b>Block Name : </b> <?=$val->block?></p>
			  <p><b>Status : </b> <?=$val->status?></p>
			 </div>
		   </div>
          <?php } ?>
		 <?php  } ?>			   
		</div><!-- /.container-fluid -->		  
    </section>
  </div>
@endsection