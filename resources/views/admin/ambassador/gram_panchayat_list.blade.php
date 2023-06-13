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
                        <button class="btn btn btn-success btn btn-sm" name="download" value="download" onclick="window.location.href='ambassador_export?s={{ request()->input('s') }}&search=search';"><i class="fa fa-download"></i> Download Excel</button>
                    </div>
                    <div class="col-md-4 pull-right">
                        <form class="form-inline my-2 my-lg-0" type="get" action="{{ route('admin.ambassadors.index') }}">
                            <input type="search" name="s" class="form-control mr-sm-2" placeholder="search gram panchayat" width="200px">&nbsp;<button type="submit" class="btn btn-primary btn-sm" name="search" value="search" class="btn btn-primary btn-sm"><i class="fa fa-filter" aria-hidden="true"></i> Filter </button>&nbsp;
                        </form> 
                    </div>
                </div>
                <div class="row"><div class="col-md-12">Total :-{{$total_gm_list}}</div></div>
          </div>
      <!-- Default box -->    
          <div class="card-body table-responsive p-0"> 
            <table class="table table-striped projects">
              <thead>
                  <tr class="thead-dark">
                      <th>#</th>
                      <th>
                        Name/Email
                      </th>
                      
                     <!--  <th>Designation</th> -->
                      <th>State/District/Block<br>Pincode</th>
                      <th>Document</th>
                      <!-- <th>Status</th> -->
                      <th>Created Date</th>
                      <th>Action</th>
                     <!--  <th>Updated By</th> -->
					          </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                  @foreach($gm_list as $gm_data)
                  <tr>
                      <td>
                          {{++$i}}
                      </td>
                      <td>
                         {{ $gm_data->name }}
                         </td>
                        
                    
                     <!--  <td>
                         {{ $gm_data->designation }}
                      </td> -->
                      <td>
                         {{ $gm_data->state_name }}/{{ $gm_data->district_name }}/{{ $gm_data->block_name }}/<br>
                          {{ $gm_data->pincode }}
                      </td>
                      <td>
                        <!--  <img src="{{ $gm_data->document_file }}" width="80px"> -->
                        <a href="{{ $gm_data->document_file }}" download>Download Document</a>
                      </td>
                     <!--  <td>
                        @if($gm_data->status==1)
                         <p id="amb-{{ $gm_data->id }}"><span class="badge badge-pill badge-success">Approved</span></p>
                         @elseif($gm_data->status==2)
                         <p id="amb-{{ $gm_data->id }}"><span class="badge badge-pill badge-danger">Rejected</span></p>
                         @else
                         <p id="amb-{{ $gm_data->id }}"><span class="badge badge-pill badge-secondary">Pending</span></p>
                          <select class="status_change" id="{{$gm_data->id}}">
                            <option value="">Please select</option>
                            <option value="1">Approved</option>
                            <option value="2">Rejected</option>
                        </select>​
                         @endif
                      </td>	 -->
                      <td>{{ $gm_data->created_at }}</td>	
                      <td><a href="{{url('admin/panchayatdetail')}}" class="fa fa-eye"><i class="bi bi-eye"></i></a></td>
                      <!-- <td>{{ $gm_data->uemail }}</td>	 -->		  
			              </tr>
                  @endforeach
                </tbody>
            </table>
           </div>
           <div class="d-flex justify-content-center">
          {{ $gm_list->links() }} 
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