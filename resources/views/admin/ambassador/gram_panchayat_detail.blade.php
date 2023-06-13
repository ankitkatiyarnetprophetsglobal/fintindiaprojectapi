@extends('admin.layouts.app')
@section('title', 'Fit India Admin - Gram Panchayat Ambassador Details')
@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gram Panchayat Ambassador</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Gram Panchayat Ambassador</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Gram Panchayat Ambassador Details</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Name</label>
                  <input type="name" class="form-control" value="test" disabled="disabled">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" value="test@gmail.com" disabled="disabled">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Age</label>
                  <input type="number" class="form-control" value="12" disabled="disabled">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Gender</label>
                  <input type="text" class="form-control" value="male" disabled="disabled">
                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>State</label>
                  <select class="form-control select2" disabled="disabled" style="width: 100%;">
                    <option disabled="disabled" selected="selected">Alabama</option>
                  </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>District</label>
                  <select class="form-control select2" disabled="disabled" style="width: 100%;">
                    <option disabled="disabled" selected="selected">Alabama</option>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Block</label>
                  <select class="form-control select2" disabled="disabled" data-placeholder="Select a State" style="width: 100%;">
                    <option disabled="disabled" selected="selected">Alabama</option>
                  </select>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Pincode</label>
                  <input type="text" class="form-control" value="111111" disabled="disabled">
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <h5>Custom Color Variants</h5>
            <div class="row">
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label>Minimal (.select2-danger)</label>
                  <select class="form-control select2 select2-danger" disabled="disabled" data-dropdown-css-class="select2-danger" style="width: 100%;">
                    <option disabled="disabled" selected="selected">Alabama</option>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label>Multiple (.select2-purple)</label>
                  <div class="select2-purple">
                    <select class="form-control select2" disabled="disabled"  data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                      <option class="disabled" selected="selected">Alabama</option>
                    </select>
                  </div>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer"></div>
        </div>
        <!-- /.card -->

      

       

      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    @endsection