<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
		
      </div>
		
	  
	  @php $admins_role = Auth::user()->role_id; @endphp
      
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">          
		  
		  <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Web Portal
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
			
            <ul class="nav nav-treeview">
				<li class="nav-item">
					<a href="{{ route('admin.users.index') }}" class="nav-link">
					<i class="nav-icon fas fa-users"></i>
					<p>Users</p>
					</a>
				</li>
				 
				<li class="nav-item">
					<a href="{{ route('admin.starratings.index') }}" class="nav-link">
					  <i class="nav-icon fa fa-star" aria-hidden="true"></i>
					  <p>School Certificates</p>
					</a>
				</li>
				  
				<li class="nav-item">
					<a href="{{ route('admin.youths.index') }}" class="nav-link">
					  <i class="nav-icon fas fa-user-friends"></i>
					  <p>Youth Club Certificates  </p>
					</a>
				</li>
				@if(!in_array($admins_role, array(2,3)))
				<li class="nav-item">
				
					<a href="#" class="nav-link">
					  <i class="nav-icon fas fa-calendar"></i>
					  <p> Events <i class="fas fa-angle-left right"></i> </p>
					</a>
					@endif
					
					<ul class="nav nav-treeview">
					
						<li class="nav-item">
						
							<a href="{{ route('admin.events.index') }}" class="nav-link">
								<i class="nav-icon fas fa-calendar-check"></i>
								<p>Events</p>
							</a>
							
						</li>
						
						@if(!in_array($admins_role, array(2,3)))
					   <li class="nav-item">
						<a href="{{ route('admin.eventcats.index') }}" class="nav-link">
						 <i class="nav-icon fas fa fa-cogs"></i>
						  <p> Event Category </p>
						</a>
					  </li>
					  @endif
					</ul>
				</li>
				@if(!in_array($admins_role, array(2,3)))
				<li class="nav-item">
					<a href="#" class="nav-link">
					 <i class="nav-icon fas fa fa-clone"></i>
					  <p>
						General
						<i class="fas fa-angle-left right"></i>
					  </p>
					</a>
					<ul class="nav nav-treeview">
					  <li class="nav-item">
						<a href="{{ route('admin.states.index') }}" class="nav-link">
						  <i class="nav-icon fas fa fa-flag"></i>
						  <p>State</p>
						</a>
					  </li>

					  <li class="nav-item">
						<a href="{{ route('admin.districts.index') }}" class="nav-link">
						   <i class="nav-icon fas fa fa-sitemap"></i>
						  <p>District</p>
						</a>
					  </li>			  
					  <li class="nav-item">
						<a href="{{ route('admin.blocks.index') }}" class="nav-link">
						   <i class="far fa-circle nav-icon"></i>
						  <p>Block</p>
						</a>
					  </li>              
					</ul>
				</li>
				@endif
				@if($admins_role != '3')
				<li class="nav-item">
					  <a href="{{ route('admin.ambassadors.index') }}" class="nav-link">
					   <i class="nav-icon fas fa-star"></i>
						<p> Ambassadors </p>
					  </a>
				</li>
				<li class="nav-item">
					<a href="{{ route('admin.champions.index') }}" class="nav-link">
					   <i class="nav-icon fas fa-trophy"></i>
					  <p> Champions</p>
					</a>
				</li>
				<li class="nav-item">
				  <a href="{{ url('admin/panchayatlist') }}" class="nav-link">
				   <i class="nav-icon fas fa-star"></i>
					<p>Gram Panchayat Ambassadors </p>
				  </a>
				</li>
				@endif
			 @if(!in_array($admins_role, array(2,3)))
				<li class="nav-item">
					<a href="#" class="nav-link">
					 <i class="nav-icon fas fa-sticky-note"></i>
					  <p> Posts
						<i class="fas fa-angle-left right"></i>
					  </p>
					</a>
					<ul class="nav nav-treeview">

					<li class="nav-item">
					  <a href="{{ route('admin.posts.index') }}" class="nav-link">
						<i class="nav-icon fas fa-tasks" aria-hidden="true"></i>
						  <p>Posts</p>
					  </a>
					</li>

					   <li class="nav-item">
						  <a href="{{ route('admin.category.index') }}" class="nav-link">
						   <i class="nav-icon fa fa-list-alt" aria-hidden="true"></i>
							<p>Post Category</p>
						  </a>
						</li>
					</ul>
				</li>
				@endif
				@if(!in_array($admins_role, array(2,3)))
			
				<li class="nav-item">
					<a href="{{ route('admin.announcement.index') }}" class="nav-link">
					  <i class="fa fa-bullhorn" aria-hidden="true"></i>
					  <p> Announcements</p>
					</a>
				 </li> 
				 @endif
            </ul>
          </li>
		  @if(!in_array($admins_role, array(2,3)))
				<li class="nav-item  has-treeview">
					<a href="#" class="nav-link ">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
						Mobile App
						<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<!-- 	<ul class="nav nav-treeview">
					<li class="nav-item">
					<a href="#" class="nav-link">
					<i class="nav-icon fas fa-cloud-meatball"></i>
					<p>
					Food Manage
					<i class="fas fa-angle-left right"></i>
					</p>
					</a> -->
					<ul class="nav nav-treeview">
						<li class="nav-item ">
							<a href="{{ route('admin.foodcharts.index') }}" class="nav-link">
							<i class="nav-icon fas fa-cookie"></i>
							<p>Food Charts</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="{{ route('admin.foodnames.index') }}" class="nav-link ">
							<i class="far fa fa-stroopwafel nav-icon"></i>
							<p>Food Name</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="{{ route('admin.servingquantities.index') }}" class="nav-link">
							<i class="nav-icon fa fa-check" aria-hidden="true"></i>
							<p>Serving Quantities</p>
							</a>
						</li> 

						<li class="nav-item">
							<a href="{{ route('admin.sleepcharts.index') }}" class="nav-link">
							<i class="nav-icon  fas fa-chart-pie"></i>
							<p>Sleep Charts</p>
							</a>
						</li>             
					</ul>
				</li>
				@endif
			<!-- </ul> -->
		</li>		
		</ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- <style>
.nav-sidebar .nav-treeview .nav-item{
  padding-left:30px !important; 
}
</style> -->