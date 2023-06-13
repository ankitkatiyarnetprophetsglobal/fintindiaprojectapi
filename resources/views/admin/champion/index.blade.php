@extends('admin.layouts.app')
@section('title', 'Fit India Admin - All Champions')

@section('content')

<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Champions</h1>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                    <li class="breadcrumb-item active"><a href="{{ route('admin.champions.index') }}">Champions</a></li>
                </ol>
            </div>
          </div>   
      </div>
 </section>
    

   
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
               <div class="row mt-2">
                   <div class="col-md-8">
                      <button class="btn btn btn-success btn btn-sm" name="download" value="download" onclick="window.location.href='champion_export?s={{ request()->input('s') }}&search=search';"><i class="fa fa-download"></i> Download</button>
                    </div>
                    <div class="col-md-4 pull-right">
                        <form class="form-inline my-2 my-lg-0 " type="get" action="{{ route('admin.champions.index') }}">
                         <div class="form-group ">
                            <input type="search" name="s" class="form-control mr-sm-2" placeholder="search champion" width="200px">&nbsp;<button type="submit" class="btn btn-primary btn-sm" name="search" value="search" class="btn btn-primary btn-sm"><i class="fa fa-filter" aria-hidden="true"></i> Filter </button>&nbsp;
                          </div>
                        </form> 
                    </div>
              </div>
             <div class="row"><div class="col-md-12"><span class="badge badge-pill badge-info">Total :-{{$total_champ}}</span> <span class="badge badge-pill badge-success"> Approved :-{{$approved_champ}}</span> <span class="badge badge-pill badge-danger">Rejected :-{{$rejected_champ}}</span> <span class="badge badge-pill badge-secondary">Pending :-{{$pending_champ}}</span></div></div>
          </div>

    <!-- Main content -->
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
                      <th>Status</th>
                      <th>Created Date</th>
                      <th>Updated By</th>
                    </tr> 
              </thead>
              <tbody>
              <?php $i=0; ?>
                  @foreach($champions as $champion)
                  <tr>
                      <td>
                          {{++$i}}
                      </td>
                      <td>
                         {{ $champion->name }}
                         /
                         <strong>{{ $champion->email }}</strong>
                         <br>
                         <b>{{ $champion->contact }}</b>
                      </td>
                      <td>
                         {{ $champion->designation }}
                      </td>
                      <td>
                         {{ $champion->state_name }}/{{ $champion->district_name }}/<br>{{ $champion->block_name }}/
                          {{$champion->pincode }}
                      </td>
                      <td>
                         <img src="{{ $champion->image }}" width="60px">
                      </td>
                     <!--  				           
                      <td>
                        {{ $champion->work_profession }}
                        
                      </td> -->
					            <td>
                        @if($champion->status==1)
                         <p id="amb-{{ $champion->id }}"><span class="badge badge-pill badge-success">Approved</span></p>
                         @elseif($champion->status==2)
                         <p id="amb-{{ $champion->id }}"><span class="badge badge-pill badge-danger">Rejected</span></p>
                         @else
                         <p id="amb-{{ $champion->id }}"><span class="badge badge-pill badge-secondary">Pending</span></p>
                          <select class="status_change" id="{{$champion->id}}">
                            <option value="">Please select</option>
                            <option value="1">Approved</option>
                            <option value="2">Rejected</option>
                        </select>​
                         @endif
                      </td> 
                      <td>{{ $champion->created_at }}</td>    
                      <td>{{ $champion->uemail }}</td>  			  
                      </tr>
                  

                  @endforeach
                  
              </tbody>
              
          </table>
        </div>
          <div class="d-flex justify-content-center">
          {{ $champions->links() }} 
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
        url:"{{ url('/admin/champ-status/') }}",
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