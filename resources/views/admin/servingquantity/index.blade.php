@extends('admin.layouts.app')
@section('title', 'Fit India Admin-Serving Quantity')

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
            <h1>ServingQuantity</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"aria-current="page">Servingquantities</li>
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
         <a href="{{ route('admin.servingquantities.create') }}"> <input type="submit" value="Add Food Quantites" class="btn btn-sm btn-success float-right"> </a>
          <div class="card-tools float-sm-left">Servingquantities: <strong>{{ $servingquantities_count }}</strong></div><br>
        </div>
		</div>
		</div>



		<div class="card-body table-responsive p-0">
              
          <table class="table table-striped projects">
              <thead >
                  <tr class="thead-dark">
                      <th>
                          #
                      </th>
                      <th>
                          Name
                      </th>
                      
                      
					  <th>
                          Action
                      </th>
					  
                      
                  </tr>
              </thead>
              <tbody>
                 <?php $i=0; ?>
                  @foreach($servingquantities as $servingquantity)

                  <tr>
                      <td>
                          {{++$i}}
                      </td>
                      <td>
                      {{ $servingquantity->name }} 
                      </td>
              
                      <td style="width:120px;display:inline-flex !important;">  
            &nbsp;<a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.servingquantities.edit', $servingquantity->id) }}"> <i class="fas fa-pencil-alt"></i></a>
            &nbsp;&nbsp;
            <form action="{{ route('admin.servingquantities.destroy', $servingquantity->id) }}" method="POST">
              @csrf
              @method('DELETE')
             <button  style="display: inline !important;" class="btn btn-danger btn-xs" type="submit" onclick="return confirm('Do you want to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;</button>
             </form> </td> 


                  </tr>   
              </tbody>
              @endforeach
          </table>
		  
        
<div class="d-flex justify-content-center">
    {{ $servingquantities->links() }}
        </div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</section>
		</div>
    
  </div>


@endsection