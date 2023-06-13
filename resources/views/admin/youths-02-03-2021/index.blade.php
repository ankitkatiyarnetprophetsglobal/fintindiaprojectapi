@extends('admin.layouts.app')
@section('title', 'Create Youths - Fit India')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<style>
	  .table{width:80% !important;}
	  .table th,tr,td{
		  padding:10px !important;
		  margin:10px !important;
	  }
	  
	  .table-bordered{width:98% !important;}
	  
	  .table-bordered th,tr,td{
		  padding:10px !important;
		  margin: 10px!important;
	  }	
	</style>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$title}}</h1>
          </div>
          
          <div class="col-sm-6"> 		    	  
			<ol class="breadcrumb float-sm-right">               
			   <div class="pull-right">

<button class="btn btn btn-success btn btn-sm" name="download" value="download" onclick="window.location.href='youths_export?s={{ request()->input('youth_name')}}&st={{ request()->input('state')}}&dst={{ request()->input('district')}}&search=search';">Download Excel</button>
          
        </li>			
       </div>              
            </ol>
          </div>
		</div>  
		
		<div class="row mb-2">
		 <div class="col-sm-12"> 
		    <ol class="breadcrumb float-sm-left"> 
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Youths</li>			 		  
            </ol>		 
		 </div>
		 
		  <div class="col-sm-4">
		   <form class="form-inline my-2 my-lg-0" type="get" action="{{ route('admin.youths.index') }}">
            <table style="border:0px;padding:0px;margin:0px !important;">
			  <tr>
         <td>	

         <?php
             if(!empty($_REQUEST['youth_name'])&& $_REQUEST['youth_name']!=''){
              
               $txt=$_REQUEST['youth_name'];

             }else{

               $txt='';
             }
            ?>        


			      <input type="search" name="youth_name" id="youth_data" value="<?=$txt?>" class="form-control mr-sm-2"  placeholder="search Club Name " width="150px">
				</td>				
                <td>
			      <button type="submit" class="btn btn-info btn-sm" name="search" value="search"><i class="fa fa-search" aria-hidden="true"></i> Search </button>&nbsp;
			    </td>
			  </tr>	
			 </table>	
		   </form>					
          </div>          		  
		  <div class="col-sm-8" style="padding-right:0px !important;">
		    <form class="form-inline my-2 my-lg-0 pull-right" type="get" action="{{ route('admin.youths.index') }}">
			<table style="border:0px;padding:0px;margin:0px !important;">
			  <tr>
                <td>
				 <select class="form-control" name="state" id="youth_state" style="width:190px !important;" placeholder="Enter State Name">
				   <option value="">Select State</option>       

				   @foreach($states as $state)
            <?php
             if(!empty($_REQUEST['state'])&& $_REQUEST['state']==$state->name){
               $stselect='selected';
             }else{
               $stselect='';
             }
            ?>                                 
				    <option data-name="{{ $state->id }}"  <?=$stselect?> value="{{ $state->name }}">{{ $state->name }}</option> 
				   @endforeach					  
			    </select>
        </td>	

        <td>
			    <select class="form-control" name="district" id="youth_district" style="width:180px !important;" placeholder="Enter District Name">
				 <option value="">Select District</option>
          @foreach($district as $dist) 
            <?php
             if(!empty($_REQUEST['district'])&& $_REQUEST['district']==$dist->name){
               $dstselect='selected';
             }else{
               $dstselect='';
             }
            ?> 
            <option data-disname="{{ $dist->id }}" <?=$dstselect?> value="{{ $dist->name }}">{{ $dist->name }}</option> 
           @endforeach  
				</select>				 
             </td>	
			 <td>
			    <select class="form-control" name="block" id="youth_block" style="width:180px !important;" placeholder="Enter Block Name">
				 <option value="">Select Block</option>
          @foreach($block as $bist) 
            <?php
             if(!empty($_REQUEST['block'])&& $_REQUEST['block']==$bist->name){
               $bstselect='selected';
             }else{
               $bstselect='';
             }
            ?> 
				    <option <?=$bstselect?> value="{{ $bist->name }}">{{ $bist->name }}</option> 
           @endforeach  
        </select>	

<input type="month" id="bdaymonth" name="bdaymonth">		
        </td>              
			 <td>
			  <button type="submit" name="searchdata" value="searchdata" class="btn btn-primary btn-sm"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
			</td>
			</tr> 
		  </table> 
        </form>		  
	  </div>
     </div>		
    </div><!-- /.container-fluid -->	  
    </section>
	
    @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif	
   <!-- Main content --> 
    
	<table class="table table-bordered" style="padding:0px;margin:0px !important;">
        <tr>
            <th>#</th>            
            <th>Club Name</th>
            <th>User Email </th>
            <th>State</th>
            <th>District</th>
            <th>Block</th>
            <th>Status</th>
            <th>Action</th>
        </tr>		
		@if(count($youth)>0)
         @foreach($youth as $ydata) 
      	 
         <tr>
            <td>{{($youth->currentPage() - 1) * $youth->perPage() + $loop->iteration}}</td>           
            <td>{{ $ydata->nameofclub }}   </td>
            <td>{{ $ydata->email }}</td>
            <td>{{ $ydata->state }}</td>          
            <td>{{ $ydata->district }}</td>          
            <td>{{ $ydata->block }}</td>          
            <td>{{ ucfirst(strtolower($ydata->status)) }}</td>
            <td>
             <a href="{{route('admin.youths.show',['uid'=>$ydata->user_id,'catid'=>$ydata->cat_id])}}"><i class="fa fa-eye" title="View" aria-hidden="true"></i></a>			
			</td>
         </tr>		
       @endforeach		
       @endif		
     </table>    
     <div class="d-flex justify-content-center">
       {{ $youth->links() }}
     </div>	
  </div>  
@endsection