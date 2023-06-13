@extends('admin.layouts.app')
@section('title', 'Fit India Admin-Update Foofchart')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <a class="" href="{{ route('admin.foodcharts.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back</a>
            <h1>Update Foodcharts</h1>
          </div>
          </div>
     <div class="row mb-2">  
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('admin.foodcharts.index') }}">Foodcharts</a></li>
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
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Foodcharts</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.foodcharts.update',$foodcharts->id) }}">
			          
						@csrf
						@method('PATCH')
						<div class="card-body">
						<div class="um-field">
						<div class="um-field-label">
						<label for="foodname">FoodName</label>
						<div class="um-clear"></div>
						</div>
							<div class="um-field-area">
								<select name="foodname" id="foodname"  class="form-control">
								<?php
								foreach($foodnames as $fdname){

								    // print_r($fdname);

									 if($fdname->id==$foodcharts->foodname_id){
										 $sel1 = "selected";
										}
										 else
										 {
                                          $sel1 = '';
										 }
								?>
								
								<option value="{{ $fdname->id }}" <?=$sel1?>>{{ $fdname->foodname }}</option>
								
								{!!$errors->first("foodname", "<span class='text-danger'>:message</span>")!!}
								
								<?php } ?>
								</select>	
															
							</div>
													
						</div>

								<div class="main_form" style="display: block;">	
											
											<div class="um-field"></div>
											<div class="um-field">
													<div class="um-field-label">
														<label for="servingquantity">Serving Quantity</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">												

													 <select name="servingquantity" id="servingquantity" class="form-control">
                                                        
														 @foreach($servingquantites as $servingquantity)
                                                           
															<?php 
															  if($servingquantity->id==$foodcharts->servingquantity_id){
															     $sel = "selected";
															 } else {
                                                                 $sel = '';
															 }
															  
															?>
															<option value="{{ $servingquantity->id }}" <?=$sel?>>{{ $servingquantity->name }}</option>
															{!!$errors->first("servingquantity", "<span class='text-danger'>:message</span>")!!}
															@endforeach
															</select>	
														
													</div>
											</div>
											<div class="um-field"></div>
											<div class="um-field">
													<div class="um-field-label">
														<label for="measurement">Measurement</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
													<input id="measurement" type="text" name="measurement" class="form-control" value="{{ $foodcharts->measurement }}">
													{!!$errors->first("measurement", "<span class='text-danger'>:message</span>")!!}
														
													</div>
											</div>
								
								
											
											<div class="um-field">
													<div class="um-field-label">
														<label for="unit">Unit</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
														<input type="text" id="unit" class="form-control" name="unit" value="{{ $foodcharts->unit }}">
														{!!$errors->first("unit", "<span class='text-danger'>:message</span>")!!}
													</div>
											</div>
											<div class="um-field">
													<div class="um-field-label">
														<label for="unit">Calories</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
														<input type="text" id="unit" name="calories" class="form-control" value="{{ $foodcharts->calories }}">
														{!!$errors->first("calories", "<span class='text-danger'>:message</span>")!!}
													</div>
											</div>
											
											
											<div class="clearfix">&nbsp;</div>
											
											<div class="um-field">
													<div class="um-field-area">
														<input type="submit" class="btn btn-sm btn-info" name="update-foodcharts" value="Submit">
													</div>
											</div>
											</div>
													</form>
</div>													
											
           
    </section>
	
    <!-- /.content -->
  </div>


@endsection