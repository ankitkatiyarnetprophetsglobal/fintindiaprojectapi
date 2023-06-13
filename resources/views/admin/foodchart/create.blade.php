@extends('admin.layouts.app')
@section('title', 'Create Foofchart-Fit India')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <a class="" href="{{ route('admin.foodcharts.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back</a>
            <h1>Add Foodcharts</h1>
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
        <div class="row col-sm-offset-1">
          
          <div class="col-md-12 col-sm-offset-1">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Foodcharts</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.foodcharts.store') }}">
			          
											@csrf
										<div class="card-body">	
											<div class="um-field">
													<div class="um-field-label">
														<label for="foodname">FoodName</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
														<select name="foodname" id="foodname" value="" class="form-control">
															<option>Please Select Food Name</option>
															@foreach($foodnames as $fdname)
															<option value="{{ $fdname->id }}">{{ $fdname->foodname }}</option>
															
															{!!$errors->first("foodname", "<span class='text-danger'>:message</span>")!!}
															@endforeach
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
														<select name="servingquantity" id="servingquantity" value="" class="form-control">
															<option>Select Serving Quantity </option>
															@foreach($servingquantites as $servingquantity)
															<option value="{{ $servingquantity->id }}">{{ $servingquantity->name }}</option>
															
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
													<input id="measurement" type="text" name="measurement" value="" class="form-control">
													{!!$errors->first("measurement", "<span class='text-danger'>:message</span>")!!}
														
													</div>
											</div>
								
								
											
											<div class="um-field">
													<div class="um-field-label">
														<label for="unit">Unit</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
														<input type="text" id="unit" name="unit" value="" class="form-control">
														{!!$errors->first("unit", "<span class='text-danger'>:message</span>")!!}
													</div>
											</div>
											<div class="um-field">
													<div class="um-field-label">
														<label for="unit">Calories</label>
														<div class="um-clear"></div>
													</div>
													<div class="um-field-area">
														<input type="text" id="unit" name="calories" value="" class="form-control">
														{!!$errors->first("calories", "<span class='text-danger'>:message</span>")!!}
													</div>
											</div>
<div class="clear-fix">&nbsp;</div>											
											<div class="um-field">
											 <div class="um-field-area">
												<input type="submit" name="add-foodcharts" class="btn btn-sm btn-primary" value="Submit">
											 </div>
											</div>
											</div>
											</div>
											
											
									</form>		
											
           
    </section>
	
    <!-- /.content -->
  </div>


@endsection