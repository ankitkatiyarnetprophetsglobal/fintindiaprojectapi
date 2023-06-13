@extends('admin.layouts.app')
@section('title', 'School Cetificates')

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
            <h1>School Certification</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
				      <li class="breadcrumb-item active" aria-current="page">School Certification</li>
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
		  <div class="card">
        <div class="card-header">
			  <div class="row">
			  <div class="col-md-2">
			  @php
				$url = "schoolcert_export?search=search";
				if( !empty( request()->input('name') ) ){  $url .= '&name='.request()->input('name'); }
				if( !empty( request()->input('state') ) ){  $url .= '&state='.request()->input('state'); }
                if($admins_role == '3'){  $url .= '&state='.$stateadmin; }				
				if( !empty( request()->input('district') ) ){  $url .= '&dst='.request()->input('district'); }
				if( !empty( request()->input('block') ) ){  $url .= '&blk='.request()->input('block'); } 
				if( !empty( request()->input('certificate') ) ){  $url .= '&cert='.request()->input('certificate'); } 
				if( !empty( request()->input('month') ) ){  $url .= '&month='.request()->input('month'); } 				
			  @endphp
			  
			  <button class="btn btn-success btn-sm dwl" name="download" value="download" onclick="window.location.href='{{ $url }}';"><i class="fa fa-download"></i> Download</button>
			  </div>
			  <div class="col-md-10">
			  <form class="form-inline my-2 my-lg-0 rtside " type="get" action="{{ route('admin.starratings.index') }}">
                <div class="form-group rtside">				
				<select class="custom-select custom-select mb-3" name="certificate" id="school_certification" style="width:130px" >
					<option value="">Certificate</option>
					@foreach($certcats as $certcat)
					<?php
					   //dd($certcat);
					
					   if($certcat->id == 12977) continue;
						   if(!empty($_REQUEST['certificate'])&& $_REQUEST['certificate']==$certcat->id)
						   {
							 $certselect='selected';
						   }else{
							 $certselect='';
						   }
						  ?> 
					  <option data-disname="{{ $certcat->id }}" <?=$certselect?>  value="{{ $certcat->id }}">{{ $certcat->name }}</option> 
					 @endforeach            
				</select>
		  
			@if($admins_role != '3')
					<select class="custom-select custom-select mb-3" name="state" id="youth_state" style="width:130px" >
						<option value="">Select State</option>       
					   @foreach($states as $state)
             <?php
                   if(!empty($_REQUEST['state'])&& $_REQUEST['state']==$state->name)
                   {
                     $stselect='selected';
                   }
                   else{
                     $stselect='';
                   }
                  ?> 

							<option data-name="{{ $state->id }}" <?=$stselect?> value="{{ $state->name }}">{{ $state->name }}</option> 
					   @endforeach					  
					</select>
					@endif
					
					<select class="custom-select custom-select mb-3" name="district" id="youth_district" style="width:140px" >
						<option value="">Select District</option>
						@foreach($districts as $district)
            <?php
                   if(!empty($_REQUEST['district'])&& $_REQUEST['district']==$district->name)
                   {
                     $distselect='selected';
                   }
                   else{
                     $distselect='';
                   }
                  ?> 
							<option data-disname="{{ $district->id }}" <?=$distselect?>  value="{{ $district->name }}">{{ $district->name }}</option> 
					   @endforeach					  
					</select>
					
					<select class="custom-select custom-select mb-3" name="block" id="youth_block" style="width:130px" >
						<option value="">Select Block</option>
						@foreach($blocks as $block)
            <?php
                   if(!empty($_REQUEST['block'])&& $_REQUEST['block']==$block->name){
                     $blkselect='selected';
                   }else{
                     $blkselect='';
                   }
                  ?> 
							<option data-disname="{{ $block->id }}" <?=$blkselect?>  value="{{ $block->name }}">{{ $block->name }}</option> 
					   @endforeach					  
					</select>            
					   
					<input type="month" id="month" name="month" class="form-control mb-3" style="width:130px !important; margin-right:1px;" placeholder="MM/YYYY" >
					
					<button type="submit" name="searchdata" value="searchdata" class="btn btn-primary btn-sm"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
                </div>
              </form>  
            </div>
			</div> 
			<div class="row mt-2">  
			<div class="col-md-6">
			<?php	              			
			  $curcount=(!empty($count)&& empty($curcount)&& empty($flag)) ? $curcount=$count : $curcount; 
			?>	
			 Total Count <strong>{{ $curcount }} / {{ $count }}</strong>			
			</div>
			<div class="col-md-6 rtside">
			  <form class="form-inline my-2 my-lg-0 rtside " type="get" action="{{ route('admin.starratings.index') }}">
                <div class="form-group rtside">
					<input type="search" name="name" class="form-control"  placeholder="School Name/Email/Phone" width="150px">
				
					<button type="submit" class="btn btn-primary btn-sm" name="search" value="search"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
              </form>  
            </div>
			     </div> 
              </div>
              <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
			  
          <table class="table table-striped projects">
              <thead >
                  <tr class="thead-dark">
					<th scope="col">#</th>
					<th scope="col">User Information</th>
					<th scope="col">State</th>
					<th scope="col">District/Block</th>
					<th scope="col">Category</th>
					<th scope="col">Status</th>
					<th scope="col">Details</th>
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
                 @foreach($starratingstatus as $starrating)
                  <tr>
                    <th>{{++$i}}</th>
                    <td>
						@if(!empty($starrating->userid)) 	{{ $starrating->userid }} 	<br> @endif
						@if(!empty($starrating->name)) 	{{$starrating->name}}	 <br> @endif
						@if(!empty($starrating->rolelabel))	{{$starrating->rolelabel}}	<br> @endif
						@if(!empty($starrating->email)) {{$starrating->email}} <br> @endif
						{{$starrating->phone}}
					</td>
					
					<td>
						@if(!empty($starrating->state)) {{ ucwords(strtolower($starrating->state))}} @endif 
					</td>
					<td>
						@if(!empty($starrating->district)) <br> {{ ucwords(strtolower($starrating->district)) }} @endif
						@if(!empty($starrating->block)) <br> {{ ucwords(strtolower($starrating->block))}} @endif
					</td>
					
					
					<td>
                      @if($starrating->cat_id==1621)
                      School Flag
                      @elseif($starrating->cat_id==1622)
                      3 Star
                      @else($starrating->cat_id==1623)
                      5 Star
                      @endif
                    </td>
                    <td>
                       {{ ucfirst($starrating->status) }}<br>
					   
					   {{ date('j-m-y', strtotime($starrating->created)) }}
                    </td>
                    <td>
					   <a style="display: inline !important;" class="fa fa-eye" href="{{url('admin/schoolflag',['cat_id'=> $starrating->cat_id, 'user_id' => $starrating->user_id])}}" alt="view">  <i class="bi bi-eye"></i> </a>
                    </td>
                  </tr>
                  @endforeach
 
              </tbody>
          </table>
         </div>
      </div>
        </div>
      </div>
	  </div>

	<div class="d-flex justify-content-center">{{ $starratingstatus->appends(request()->input())->links() }}</div>
    </section>
     
    <!-- /.content -->
  </div>


@endsection