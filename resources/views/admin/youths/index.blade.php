@extends('admin.layouts.app')
@section('title', 'Youth Club')
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
            <h1>{{$title}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
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
			  <button class="btn btn-success btn-sm dwl" name="download" value="download" onclick="window.location.href='youths_export?s={{ request()->input('youth_name')}}&st={{ request()->input('state')}}&dst={{ request()->input('district')}}&dbk={{ request()->input('block')}}&search=search';"><i class="fa fa-download"></i> Download</button>
			  </div>
			  <div class="col-md-10">
			  <form class="form-inline my-2 my-lg-0 rtside " type="get" action="{{ route('admin.youths.index') }}">
                <div class="form-group rtside">
				@if($admins_role != '3')
					<select class="custom-select custom-select mb-3" name="state" id="youth_state" style="width:140px">
					
					  <option value="">Select State</option>       
					    @foreach($states as $state)
                         <?php
				             if(!empty($_REQUEST['state'])&& $_REQUEST['state']==$state->name){
				               $stselect='selected';
				             }else{
				               $stselect='';
				             }//'states','district','block','cyouth'
				            ?>      

							<option data-name="{{ $state->id }}" <?=$stselect?> value="{{ $state->name }}">{{ $state->name }}</option> 
					   @endforeach					  
					</select>
					@endif
					
					<select class="custom-select custom-select mb-3" name="district" id="youth_district" style="width:140px" >
						<option value="">Select District</option>
						@foreach($district as $district)
                           <?php				     
						   
				             if(!empty($_REQUEST['district'])&& $_REQUEST['district']==$district->name){
				               $dstselect='selected';
				             }else{
				               $dstselect='';
				             }
				            ?> 
							<option data-disname="{{ $district->id }}"  <?=$dstselect?> value="{{ $district->name }}">{{ $district->name }}</option> 
					   @endforeach					  
					</select>
					
					<select class="custom-select custom-select mb-3" name="block" id="youth_block" style="width:140px">
						<option value="">Select Block</option>
						@foreach($block as $block)
						<?php
						 //dd($block);
			             if(!empty($_REQUEST['block'])&& $_REQUEST['block']==$block->name){
			               $bstselect='selected';
			             }else{
			               $bstselect='';
			             }

			             $block_name=ucwords(strtolower($block->name));
			            ?> 
							<option data-disname="{{ $block->id }}" <?=$bstselect?>  value="{{ $block->name }}">{{ $block_name }}</option> 
					   @endforeach					  
					</select> 

					 <?php
			             if(!empty($_REQUEST['month'])&& $_REQUEST['month']!=''){
			              
			               $month=$_REQUEST['month'];

			             }else{

			               $month='';
			             }
                     ?> 					   
					<input type="month" id="month" name="month" <?=$month?> class="form-control" style="width:180px !important;margin-right:3px;">					
					<button type="submit" name="searchdata" value="searchdata" class="btn btn-primary btn-sm"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
                </div>
              </form>			
            </div>
			</div> 
			<div class="row mt-2">  
			<div class="col-md-6">
            <?php	              			
			  $cyouth=(!empty($count)&& empty($cyouth)&& empty($flag)) ? $cyouth=$count : $cyouth; 
			?>			
			 Total Youths : <strong>{{ $cyouth }} / {{ $count }}</strong>			 
			</div>			
			<?php
				 if(!empty($_REQUEST['youth_name'])&& $_REQUEST['youth_name']!=''){
				  
				   $tname=$_REQUEST['youth_name'];

				 }else{

				   $tname='';
				 }
			   ?>      
			<div class="col-md-6 rtside">
			  <form class="form-inline my-2 my-lg-0 rtside " type="get" action="{{ route('admin.youths.index') }}">
                <div class="form-group rtside">                	 
					<input type="search" name="youth_name" value="<?=$tname?>" id="youth_name" class="form-control"  placeholder="Youth Club Name..." width="180px">
				
					<button type="submit" class="btn btn-primary btn-sm" name="search" value="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
					
					
                </div>
              </form>  
				
            </div>
			</div>
			  
                  
                 
              </div>
              <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
			  
          <table class="table table-striped projects">
              <thead>
                  <tr class="thead-dark">
					<th scope="col">#</th>                   
					<th scope="col">Club Name</th>
					<th scope="col">User Email</th>
					<th scope="col">State/District/Block</th>
					<!--<th scope="col">District</th>
					<th scope="col">Block</th>-->
					<th scope="col">Status</th> 
                     @if(!in_array($admins_role, array(2,3)))
					<th scope="col">Action</th>
					@endif	
                  </tr>
              </thead>

              <tbody>
             @if(count($youth)>0)
               @foreach($youth as $ydata) 		      
               <tr>
                  <td>{{($youth->currentPage() - 1) * $youth->perPage() + $loop->iteration}}</td>           
                  <td><?=ucwords(strtolower($ydata->user_id));?><br><?=ucwords(strtolower($ydata->nameofclub));?></td>
                  <td>{{ $ydata->email }}</td>
                  <td>
				     <?=ucwords(strtolower($ydata->state));?><br>
					 <?=ucwords(strtolower($ydata->district));?><br>
				     <?=ucwords(strtolower($ydata->block));?>
				  </td>          
                  <!--<td><?=ucwords(strtolower($ydata->district));?></td>          
                  <td><?=ucwords(strtolower($ydata->block));?></td>-->
                  <td><p id="amb-24"><span class="badge badge-pill badge-success">{{ ucfirst(strtolower($ydata->status)) }}</span></p>
                    <br> {{ $ydata->created }} </td>
				@if(!in_array($admins_role, array(2,3)))
                  <td>
                   <a href="{{route('admin.youths.show',['uid'=>$ydata->user_id,'catid'=>$ydata->cat_id])}}"> &nbsp;<i class="fa fa-eye" title="View" aria-hidden="true"></i></a>			
      			</td>
				@endif
         </tr>		
           @endforeach		
            @endif		                
            </tbody>   
          </table>
         </div>
         </div>
        </div>
      </div>
	  </div>
      <div class="d-flex justify-content-center">{{ $youth->appends(request()->input())->links() }}</div>	
    </section>
    <!-- /.content -->
  </div>
@endsection