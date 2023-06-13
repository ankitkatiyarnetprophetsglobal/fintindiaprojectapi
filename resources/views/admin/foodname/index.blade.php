@extends('admin.layouts.app')
@section('title', 'Fit India Admin-Food Names')

@section('content')

<div class="content-wrapper">
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Foodnames</h1>
           <ol class="breadcrumb float-sm-left">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
      <li class="breadcrumb-item active"><a href="{{ route('admin.foodnames.index') }}">Foodnames</a></li>
      </br>
      </ol>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
      </br>
    <li class="breadcrumb-item"></li>
             
            </ol>
          </div>
        </div>
    <ol class="breadcrumb float-sm-right">
      </ol>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
			 <a href="{{ route('admin.foodnames.create') }}"> <input type="submit" value="Create new Food" class="btn btn-sm btn-success float-right"> </a>
          </div>
        </div>
		
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th>
                          #
                      </th>
                      <th>
                          Food Name
                      </th>
					             <th>
                          Action
                      </th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=0; ?>
                  @foreach($foodnames as $foodname)
                  <tr>
                      <td>
                          {{++$i}}
                      </td>
                      <td>
                          {{ $foodname->foodname }}
                      </td>
                        <td style="width:120px;display:inline-flex !important;">  
                      &nbsp;<a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.foodnames.edit',$foodname->id) }}"> <i class="fas fa-pencil-alt"></i></a>
                      &nbsp;&nbsp;
                      <form action="{{ route('admin.foodnames.destroy',$foodname->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                       <button  style="display: inline !important;" class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash" aria-hidden="true" onclick="return confirm('Do you want to delete ?')"></i>&nbsp;</button>
                       </form> </td>    
                  </tr> 
              </tbody>
              @endforeach
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    <div class="d-flex justify-content-center">
    {{ $foodnames->links() }}
    </div>
@endsection