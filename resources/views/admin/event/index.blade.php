@extends('admin.layouts.app')
@section('title', 'Fit India Admin - All Events')
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
            <h1>Events</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Events</li>
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
			  <button class="btn btn-success btn-sm dwl" name="download" value="download" onclick="window.location.href='event_export?ename={{ request()->input('event_name')}}&st={{ request()->input('state')}}&dst={{ request()->input('district')}}&dbk={{ request()->input('block')}}&cat={{ request()->input('category')}}&dat={{ request()->input('month')}}&search=search';"><i class="fa fa-download"></i> Download</button>
			  </div>
			  <div class="col-md-10">
			  <form class="form-inline my-2 my-lg-0 rtside " type="get" action="{{ route('admin.events.index') }}">
                <div class="form-group rtside">
				
					<select class="custom-select custom-select mb-3" name="category" id="category" style="width:130px" >
						<option value="">Category</option>
						@foreach($categories as $cat)
						<?php
						 // dd($cat);
			             if(!empty($_REQUEST['category'])&& $_REQUEST['category']==$cat->id){
			               $cstselect='selected';
			             }else{
			               $cstselect='';
			             }
			            ?> 
						<option  <?=$cstselect?>  value="{{ $cat->id }}">{{ $cat->name }}</option> 
					   @endforeach					  
					</select> 
					
				@if($admins_role != '3')
					<select class="custom-select custom-select mb-3" name="state" id="youth_state" style="width:130px" >
						<option value="">Select State</option>       
					   @foreach($states as $state)
                         <?php
				             if(!empty($_REQUEST['state'])&& $_REQUEST['state']==$state->name){
				               $stselect='selected';
				             }else{
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
				             if(!empty($_REQUEST['district'])&& $_REQUEST['district']==$district->name){
				               $dstselect='selected';
				             }else{
				               $dstselect='';
				             }
				            ?> 
							<option data-disname="{{ $district->id }}"  <?=$dstselect?> value="{{ $district->name }}">{{ $district->name }}</option> 
					   @endforeach					  
					</select>
					
					<select class="custom-select custom-select mb-3" name="block" id="youth_block" style="width:125px" >
						<option value="">Select Block</option>
						@foreach($blocks as $block)
						<?php
			             if(!empty($_REQUEST['block'])&& $_REQUEST['block']==$block->name){
			               $bstselect='selected';
			             }else{
			               $bstselect='';
			             }

			              $block_name=ucwords(strtolower($block->name));
			            ?> 
							<option data-disname="{{ $block->id }}" <?=$bstselect?>  value="{{ $block->name }}"><?=$block_name ?></option> 
					   @endforeach					  
					</select> 

					

					 <?php
			             if(!empty($_REQUEST['month'])&& $_REQUEST['month']!=''){
			              
			               $month=$_REQUEST['month'];

			             }else{

			               $month='';
			             }
                       ?>      
					   
					<input type="month" id="month" name="month" value="<?=$month?>" class="form-control" style="width:130px !important;margin-right:3px;">					
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
			 Total Youths : <strong>{{ $curcount }} / {{ $count }}</strong>			 
			</div>		
			<div class="col-md-6 rtside">
			  <form class="form-inline my-2 my-lg-0 rtside " type="get" action="{{ route('admin.events.index') }}">
                <div class="form-group rtside">
                	 <?php
			             if(!empty($_REQUEST['event_name'])&& $_REQUEST['event_name']!=''){
			              
			               $tname=$_REQUEST['event_name'];

			             }else{

			               $tname='';
			             }
                       ?>      
					<input type="search" name="event_name" value="<?=$tname?>" id="event_name" class="form-control" placeholder="Event/Mobile ...">
					<button type="submit" class="btn btn-primary btn-sm" name="search" value="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
					
					
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
                    <th scope="col">Event Information</th>					
					<th scope="col">Participant No</th>
					<th scope="col">Run(K/M)</th>
                    <th scope="col">Category</th>
                    <!--<th scope="col">Event Image</th>-->
					@if(!in_array($admins_role, array(2,3)))                    
                    <th scope="col">Action</th> 
					@endif
                  </tr>
              </thead>

              <tbody>
              <?php $i=0; ?>
                  @foreach($events as $event)
                  <tr>
                      <td>
                          {{++$i}}
                      </td>
                      <td>
					  @if(!empty($event->email)) {{ $event->email }} @endif
                      @if(!empty($event->mobile)) <br>{{ $event->mobile }}  @endif
                      @if(!empty($event->state))	<br>{{ ucwords(strtolower($event->state)) }}   @endif
                      @if(!empty($event->district)) <br>{{ ucwords(strtolower($event->district)) }}   @endif
                      @if(!empty($event->block)) <br>{{ ucwords(strtolower($event->block)) }}       @endif                  
                      @if(!empty($event->organiser_name)) <br>{{ ucwords(strtolower($event->organiser_name)) }}   @endif		   
					  </td>	
					  
					  <td>
					     @if(!empty($event->name)) {{ ucwords(strtolower($event->name)) }}  @endif
                         @if(!empty($event->eventstartdate)) <br>{{ $event->eventstartdate }}	@endif
                         @if(!empty($event->eventenddate)) <br>{{ $event->eventenddate }} @endif                         
					  </td>
					  <td>
					     {{ $event->participantnum }}
					  </td>				  
					   <td>
					     {{ $event->kmrun }} km
					  </td>					  
					  <td>
						  @foreach($categories as $category)
						  @if($category->id == $event->category)
							{{ $category->name }}
						  @endif
						  @endforeach
					  </td>
						@if(!in_array($admins_role, array(2,3)))
					   <!--<td><img src="{{ $event->eventimage1 }}" width="70px"><br><img src="{{ $event->eventimage2 }}" width="70px"></td>-->
                       <td style="width:140px;display:inline-block !important;">&nbsp;&nbsp;<a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ url('admin/edit-event', $event->id) }}">
                       	<i class="fas fa-pencil-alt"></i>&nbsp;</a>&nbsp;
                       	<button  style="display: inline !important;"class="btn btn-danger btn-xs" type="submit" onclick="return confirm('Do you want to delete ?')">
                       	<a style="display: inline !important;" class="btn btn-danger btn-xs"  href="{{ url('admin/event-destroy', $event->id) }}" >
                       		<i class="fa fa-trash" aria-hidden="true"></i>&nbsp;</a></button>&nbsp;<a style="display: inline !important;" class="fa fa-eye" href="{{ url('admin/events-show', $event->id) }}"><i class="bi bi-eye"></i>&nbsp;</a>
                       </td>
					   @endif
                  </tr>
                  @endforeach                  
              </tbody> 
          </table>
         </div>
      </div>
        </div>
      </div>
	  </div>
      <div class="d-flex justify-content-center">{{ $events->appends(request()->input())->links() }}</div>	
    </section>
    <!-- /.content -->
  </div>
@endsection





    
  