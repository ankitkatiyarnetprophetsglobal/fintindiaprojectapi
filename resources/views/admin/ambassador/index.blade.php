@extends('admin.layouts.app')
@section('title', 'Fit India Admin - All Ambassadors')
@section('content')

<div class="content-wrapper"> 
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Ambassador</h1>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.ambassadors.index') }}">Ambassador List</a></li>
                </ol>
            </div>
          </div>   
      </div>
  </section>
    <!-- Main content -->
  <section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
               <div class="row mt-2">
                    <div class="col-md-8">
                        <button class="btn btn btn-success btn btn-sm" name="download" value="download" onclick="window.location.href='ambassador_export?s={{ request()->input('s') }}&search=search';"><i class="fa fa-download"></i> Download</button>
                    </div>
                    <div class="col-md-4 pull-right">
                        <form class="form-inline my-2 my-lg-0" type="get" action="{{ route('admin.ambassadors.index') }}">
                            <input type="search" name="s" class="form-control mr-sm-2" placeholder="search ambassador" width="200px">&nbsp;<button type="submit" class="btn btn-primary btn-sm" name="search" value="search" class="btn btn-primary btn-sm"><i class="fa fa-filter" aria-hidden="true"></i> Filter </button>&nbsp;
                        </form> 
                    </div>
                </div>
                <div class="row"><div class="col-md-12"><span class="badge badge-pill badge-info">Total :-{{$total_amb}}</span> <span class="badge badge-pill badge-success"> Approved :-{{$approved_amb}}</span> <span class="badge badge-pill badge-danger">Rejected :-{{$rejected_amb}}</span> <span class="badge badge-pill badge-secondary">Pending :-{{$pending_amb}}</span></div></div>
          </div>
      <!-- Default box -->    
          <div class="card-body table-responsive p-0"> 
            <table class="table table-striped projects">
              <thead>
                  <tr class="thead-dark">
                      <th>#</th>
                      <th>
                        Name/
                        Email/<br>
                        Contact No.
                      </th>
                      <th>Designation</th>
                      <th>State/District/Block<br>Pincode</th>
                      <th>Image</th>
                      <th>Status</th> <!-- <th>Action</th>   -->
                      <th>Created Date</th>
                      <th>Updated By</th>
					          </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                  @foreach($ambassadors as $ambassador)
                  <tr>
                      <td>
                          {{++$i}}
                      </td>
                      <td>
                         {{ $ambassador->name }}
                         <br>
                         <strong>{{ $ambassador->email }}</strong>
                         <br>
                         <b>{{ $ambassador->contact }}</b>
                      </td>
                      <td>
                         {{ $ambassador->designation }}
                      </td>
                      <td>
                         {{ $ambassador->state_name }}/{{ $ambassador->district_name }}/{{ $ambassador->block_name }}/<br>
                          {{ $ambassador->pincode }}
                      </td>
                      <td>
                         <img src="{{ $ambassador->image }}" width="80px">
                      </td>
                      <td>
                        @if($ambassador->status==1)
                         <p id="amb-{{ $ambassador->id }}"><span class="badge badge-pill badge-success">Approved</span></p>
                         @elseif($ambassador->status==2)
                         <p id="amb-{{ $ambassador->id }}"><span class="badge badge-pill badge-danger">Rejected</span></p>
                         @else
                         <p id="amb-{{ $ambassador->id }}"><span class="badge badge-pill badge-secondary">Pending</span></p>
                          <select class="status_change" id="{{$ambassador->id}}">
                            <option value="">Please select</option>
                            <option value="1">Approved</option>
                            <option value="2">Rejected</option>
                        </select>​
                         @endif
                      </td>	
                      <td>{{ $ambassador->created_at }}</td>	
                      <td>{{ $ambassador->uemail }}</td>			  
			              </tr>
                  @endforeach
                </tbody>
            </table>
           </div>
           <div class="d-flex justify-content-center">
          {{ $ambassadors->links() }} 
          </div>      
        </div>
        </div>
        </div>  
        </div>
    </section>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script type="text/javascript">
    jQuery(document).ready(function(){
      jQuery('.status_change').change(function(){
      var amb_id = jQuery(this).attr('id');
      var status = jQuery(this).val();
      jQuery.ajax({
        type:"POST",
        url:"{{ url('/admin/ambassador-activation/') }}",
        data : {'amb_id' :amb_id,'status':status, '_token': '{{ csrf_token() }}'},
        beforeSend: function() {
              jQuery('#amb-'+amb_id).html('<img width="35" with="35" src="{{url("/wp-content/uploads/2021/01/loader.gif")}}">');
            },
        success:function(res){
          var response_obj = JSON.parse(res);
            if(response_obj.status=='1'){
              jQuery('#'+amb_id).remove();
              jQuery('#amb-'+amb_id).html('<span class="badge badge-pill badge-success">Approved</span>');
            }else if(response_obj.status=='2'){
              jQuery('#'+amb_id).remove();
              jQuery('#amb-'+amb_id).html('<span class="badge badge-pill badge-danger">Rejected</span>');
            }else{
              jQuery('#amb-'+amb_id).html('<span class="badge badge-pill badge-secondary">Pending</span>');
            }
        }
     });
  });
    });
  </script>
@endsection