@extends('admin.layouts.app')
@section('title', 'Fit India Admin - FoodCharts')

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
            <h1>Food Charts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"aria-current="page">Food Charts</li>
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
		
         <a href="{{ route('admin.foodcharts.create') }}"> <input type="submit" value="Create new Foodcharts" class="btn btn-sm btn-success float-right"> </a>
          <div class="card-tools float-sm-left">No of foods: <strong>{{ $foodchart_count }}</strong></div><br>
        </div>
		</div>
		</div>





    <!-- Main content -->
          <div class="card-body table-responsive p-0">			  
          <table class="table table-striped projects">
              <thead>
                  <tr class="thead-dark">
                      <th>
                          #
                      </th>
                      <th>
                          Name
                      </th>
                      <th>
                         Serving Quantity
                      </th>
                      <th>
                          Measurement
                      </th>
                      <th>
                         Unit
                      </th>
                      <th>
                         Calories(Kcl)
                      </th>
                      
					<th class ="text-right">
                          Action
                    </th>
					  
                      
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                  @foreach($foodcharts as $foodchart)

                  <tr>
                      <td>
                          {{++$i}}
                      </td>
                     <td>
                          {{ $foodchart->name }}
                      </td>
                      <td>
                          {{ $foodchart->servingquantity }}
                      </td>
                      <td>
                          {{ $foodchart->measurement }}
                      </td>
                      <td>
                          {{ $foodchart->unit }}
                      </td>
                      <td>
                          {{ $foodchart->calories }}kcl
                      </td>
					  
      <td style="width:120px;display:inline-flex !important;">  
            &nbsp;<a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.foodcharts.edit',$foodchart->id) }}"> <i class="fas fa-pencil-alt"></i></a>
            &nbsp;&nbsp;
            <form action="{{ route('admin.foodcharts.destroy',$foodchart->id) }}" method="POST">
              @csrf
              @method('DELETE')
             <button  style="display: inline !important;" class="btn btn-danger btn-xs" type="submit" onclick="return confirm('Do you want to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;</button>
             </form> </td>    

                  </tr>

                  @endforeach
                  
              </tbody>
          </table>
		   </div>
          <div class="d-flex justify-content-center">
		{{ $foodcharts->links() }}
        </div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</section>
		</div>
        
     
     


@endsection