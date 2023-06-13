@extends('admin.layouts.app')
@section('title', 'Fit India Admin-Update Sleep')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <a class="" href="{{ route('admin.sleepcharts.index') }}"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
            <h1>Update Sleepcharts</h1>
          </div>
          </div>
     <div class="row mb-2">  
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('admin.sleepcharts.index') }}">sleepcharts</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
  
	<section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-12 col-sm-offset-1">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Sleep</h3>
              </div>              
              <form method="POST" action="{{ route('admin.sleepcharts.update',$sleeps->id) }}">			          
				@csrf
				@method('PATCH')
				<div class="card-body col-offset-1">
					<div class="form-group">
						<div class="um-field-label">
							<label for="Bed_Date">Bed_Date</label>
								<div class="um-clear"></div>
						</div>
						<div class="form-group">
							<input type="date" name="bed_date" id="bed_date" value="{{ $sleeps->bed_date }}" class="form-control">
														
						{!!$errors->first("bed_date", "<span class='text-danger'>:message</span>")!!}
																
						</div>
													
					</div>
					<div class="um-field">
						<div class="form-group">
							<label for="Bed_Time">Bed_Time</label>
								<div class="um-clear"></div>
						</div>
						<div class="form-group">
							<input type="text" name="bed_time" id="bed_time" value="{{ $sleeps->bed_time }}" class="form-control">
														
						{!!$errors->first("bed_time", "<span class='text-danger'>:message</span>")!!}
																
						</div>
													
					</div>
					<div class="um-field">
						<div class="form-group">
							<label for="Wakeup_Date">Wakeup_Date</label>
								<div class="um-clear"></div>
						</div>
						<div class="um-field-area">
							<input type="date" name="wakup_date" id="wakeup_date" value="{{ $sleeps->wakup_date }}" class="form-control">
														
						{!!$errors->first("wakeup_date", "<span class='text-danger'>:message</span>")!!}
																
						</div>
													
					</div>
					<div class="um-field">
						<div class="form-group">
							<label for="Wakeup_Time">Wakeup_time</label>
								<div class="um-clear"></div>
						</div>
						<div class="um-field-area">
							<input type="text" name="wakup_time" id="wakeup_time" value="{{ $sleeps->wakup_time }}" class="form-control">
														
						{!!$errors->first("wakeup_time", "<span class='text-danger'>:message</span>")!!}
																
						</div>
													
					</div>
					<div class="um-field">
						<div class="form-group">
							<label for="Sleep_hours">Sleep_hours</label>
								<div class="um-clear"></div>
						</div>
						<div class="um-field-area">
							<input type="text" name="sleep_hours" id="sleep_hours" value="{{ $sleeps->sleep_hours }}" class="form-control">
														
						{!!$errors->first("sleep_hours", "<span class='text-danger'>:message</span>")!!}
																
						</div>													
					</div>
					<div class="clear-fix">&nbsp;</div>
					<div class="um-field">
						<div class="form-group">
						<button type="submit" name="update-foodcharts" value="update" class="btn btn-primary btn-sm">update</button>
						</div>
					</div>
				</div>
															
											
            </div> 

          </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
											

@endsection