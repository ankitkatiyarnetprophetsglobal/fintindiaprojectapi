@extends('admin.layouts.app')
@section('title', 'Fit India Admin - All Users')
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
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Users</li>
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
			  <button class="btn btn-success btn-sm dwl" name="download" value="download" onclick="window.location.href='user_export?uname={{ request()->input('user_name')}}&st={{ request()->input('state')}}&dst={{ request()->input('district')}}&blk={{ request()->input('block')}}&month={{ request()->input('month')}}&role={{ request()->input('role')}}&search=search';"><i class="fa fa-download"></i> Download</button>
			  </div>
			  <div class="col-md-10">
			  <form class="form-inline my-2 my-lg-0 rtside " type="get" action="{{ route('admin.users.index') }}">
                <div class="form-group rtside">
				<select class="custom-select custom-select mb-3" name="role"  style="width:130px" >
						<option value="">Select Role</option>       
					   @foreach($roles as $role)
             <?php
                     if(!empty($_REQUEST['role'])&& $_REQUEST['role']==$role->slug){
                       $stselect='selected';
                     }else{
                       $stselect='';
                     }
                    ?>     
							<option data-name="{{ $role->id }}" <?=$stselect?> value="{{ $role->slug }}">{{ $role->name }}</option> 
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
							<option data-disname="{{ $district->id }}" <?=$dstselect?>  value="{{ $district->name }}">{{ $district->name }}</option> 
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

                $block_name=ucwords(strtolower($block->name));   
              ?> 
							<option data-disname="{{ $block->id }}"  <?=$blkselect?> value="{{ $block->name }}">{{ $block_name }}</option> 
					   @endforeach					  
					</select>
					   
					<input type="month" id="month" name="month" class="form-control mb-3"  style="width:180px !important; margin-right:2px;">
					
					<button type="submit" name="searchdata" value="searchdata" class="btn btn-primary btn-sm"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
                </div>
              </form>				
            </div>
			</div> 
			<div class="row mt-2">  
			<div class="col-md-6">
			  <?php
			    //'count','admins_role','curcount','flag'
			    $curcount=(!empty($count)&& empty($curcount)&& empty($flag)) ? $curcount=$count : $curcount;  
			  ?>
			  Total users <strong>{{ $curcount }}/{{ $count }}</strong>			 
			</div>
        
			<div class="col-md-6 rtside">
			  <form class="form-inline my-2 my-lg-0 rtside " type="get" action="{{ route('admin.users.index') }}">
                <div class="form-group rtside">
                  <?php
             if(!empty($_REQUEST['user_name'])&& $_REQUEST['user_name']!=''){
              
               $uname=$_REQUEST['user_name'];

             }
             else{

               $uname='';
             }
            ?> 
				<input type="search" name="user_name" <?=$uname?> class="form-control" placeholder="user email/name/mobile " value="<?=$uname?>" width="200px">
			
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
					<th scope="col">Name & Role</th>
					<th scope="col">Email & Phone</th>                   
					<th scope="col">State</th>
					<th scope="col">District/Block/City</th>
					
						@if(!in_array($admins_role, array(2,3)))
					<th scope="col">Action</th>
						@endif
                  </tr>
              </thead>
              <tbody>
              <?php $i=0; ?>
              @foreach($user as $users)
			 
                  <tr>
					<th scope="row">{{++$i}}</th>
					<td>{{ $users->id }} <br>{{ $users->name }}<br> {{ $users->role }}</td>
					<td>{{ $users->email }} <br> {{$users->phone}}</td>					
					<td> @if(!empty($users->state)) {{ ucwords(strtolower($users->state)) }} @endif </td>
					<td> @if(!empty($users->district)) {{ ucwords(strtolower($users->district)) }} @endif <br>
					 @if(!empty($users->block)) {{ucwords(strtolower($users->block)) }} @endif <br> 
					{{ucwords(strtolower($users->city)) }}</td> 
						@if(!in_array($admins_role, array(2,3)))
					<td style="width:100px;display:contents !important;">&nbsp;&nbsp;<a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ url('admin/edit-user', $users->id) }}">
					<i class="fas fa-pencil-alt"></i>&nbsp;</a>&nbsp;
					<button  style="display: inline !important;"class="btn btn-danger btn-xs" type="submit" onclick="return confirm('Do you want to delete ?')">
					<a style="display: inline !important;" class="btn btn-danger btn-xs"  href="{{ url('admin/user-destroy',[ 'id' => $users->id,'uid' => $users->id]) }}" >
					<i class="fa fa-trash" aria-hidden="true"></i>&nbsp;</a></button>
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
    <div class="d-flex justify-content-center">
       {{ $user->appends(request()->input())->links() }}
     </div>

    </section>
    <!-- /.content -->
  </div>


@endsection














































