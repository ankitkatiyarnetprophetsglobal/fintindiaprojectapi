 <div class="contr-bx">
    <div class="header">
        <div class="head-rw">
          <div class="row">
            <div class="col-4">
              <a href="home" class="fit-logo">
                <img src="{{asset('resources/imgs/fit-india_logo.png') }}" alt="Fit India">	
              </a>
            </div>
            <div class="col-4">
              <span class="gov-logo">
                <img src="{{asset('resources/imgs/gov_logo.png') }}" alt="Government of India">
              </span>
            </div>
            <div class="col-4 text-right">
              <a href="https://sportsauthorityofindia.nic.in/" target="_blank" class="sai-logo">
               <img src="{{asset('resources/imgs/sai_trans_logo_new.jpg') }}" alt="SAI">
             </a>
           </div> 
          </div>
        </div>
    </div>
	<div class="menu-bar">
	  <div class="row">
		<div class="col-12">
		  <nav class="navbar navbar-expand-md navbar-dark">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
			</button>
			  <div class="collapse navbar-collapse navbar-toggleable-md" id="collapsibleNavbar">
			  <ul class="navbar-nav">
				<li class="nav-item {{ (request()->is('home')) ? 'active' : 'active' }}">
				    <a class="nav-link {{ (request()->is('home')) ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
				</li>

				<li class="nav-item {{ (request()->is('about')) ? 'active' : '' }}">
				   <a class="nav-link {{ (request()->is('about')) ? 'active' : '' }}" href="{{ route('about') }}">About us</a>
				</li>

				<li class="nav-item {{ (request()->is('fit-india-school-week-2020') || request()->is('fit-india-cyclothon-2020')) ? 'active' : '' }}">
				 <a class="nav-link {{ (request()->is('fit-india-school-week-2020') || request()->is('fit-india-cyclothon-2020')) ? 'active' : '' }}" href="fit-india-school-week-2020">Events<span class="m-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="12"
					height="12" viewBox="0 0 24 24"><path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" /></svg></span></a>

				    <ul class="sub-menu">
	                   <li class="nav-item {{ (request()->is('fit-india-school-week-2020')) ? 'active' : 'active' }}">
	                   	<a class="nav-link {{ (request()->is('fit-india-school-week-2020')) ? 'active' : '' }}" 
	                   		href="{{ url('fit-india-school-week') }}">Fit India School Week 2020</a>
	                   </li>

	                   <li class="nav-item {{ (request()->is('fit-india-cyclothon-2020')) ? 'active' : 'active' }}"><a class="nav-link {{ (request()->is('fit-india-cyclothon-2020')) ? 'active' : '' }}" href="{{ url('fit-india-cyclothon-2020') }}">Fit India Cyclothon 2020</a></li>
	                </ul>				  
				</li>

				<li class="nav-item {{ (request()->is('fit-india-school') || request()->is('fit-india-youth-club-certification')) ? 'active' : '' }}">				
				 <a class="nav-link {{ (request()->is('fit-india-school') || request()->is('fit-india-youth-club-certification')) ? 'active' : '' }}" href="fit-india-school">Fit India Certification<span class="m-arrow"><svg
					xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
					<path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" /></svg></span></a>
					  <ul class="sub-menu">
		               <li class="nav-item {{ (request()->is('fit-india-school')) ? 'active' : 'active' }}"><a class="nav-link {{ (request()->is('fit-india-school')) ? 'active' : '' }}" href="{{ url('fit-india-school') }}">Fit India School</a></li>
		              <li class="nav-item {{ (request()->is('fit-india-youth-club-certification')) ? 'active' : 'active' }}"><a class="nav-link {{ (request()->is('fit-india-youth-club-certification')) ? 'active' : '' }}" href="{{ url('fit-india-youth-club-certification') }}">Fit India Youth Club</a></li>
		              </ul>
				</li>

				<li class="nav-item {{ (request()->is('fit-india-dialogue') || request()->is('dialogue-session-2')) ? 'active' : '' }}">
				<a class="nav-link {{ (request()->is('fit-india-dialogue') || request()->is('dialogue-session-2')) ? 'active' : '' }}"
				 href="fit-india-dialogue">Fit India Dialogue<span class="m-arrow"><svg
					xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
					<path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" /></svg></span></a>
					<ul class="sub-menu">
		             <li class="nav-item">
					  <a class="nav-link {{ (request()->is('fit-india-dialogue')  ? 'active' : '' )}}" href="{{ route('fit-india-dialogue') }}">Dialogue Session 1</a>
					 </li>
		             <li class="nav-item {{ (request()->is('dialogue-session-2')  ? 'active' : '' )}}"><a class="nav-link {{ (request()->is('dialogue-session-2')  ? 'active' : '' )}}" href="{{ url('dialogue-session-2') }}">Dialogue Session 2</a></li>
		            </ul>
				</li>

				<li class="nav-item {{ (request()->is('fit-india-ambassador')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('fit-india-ambassador')) ? 'active' : '' }}" href="{{ url('fit-india-ambassador') }}">Fit India Ambassador</a></li>

				<li class="nav-item {{ (request()->is('fit-india-champions')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('fit-india-champions')) ? 'active' : '' }}" href="{{ url('fit-india-champions') }}">Fit India Champions</a></li>

				<li class="nav-item {{ (request()->is('fit-india-icons')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('fit-india-icons')) ? 'active' : '' }}" href="{{ url('fit-india-icons') }}">Fit India Icons</a></li>
				
				<li class="nav-item {{ (request()->is('fitnessprotocols')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('fitnessprotocols')) ? 'active' : '' }}" href="{{ url('fitnessprotocols') }}">Fitness Protocols</a></li>
				<li class="nav-item {{ (request()->is('contact-us')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('indigenoussports')) ? 'active' : '' }}" href="{{ url('indigenoussports') }}">Fit India Indigenous Games</a></li>
				<li class="nav-item {{ (request()->is('media')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('media')) ? 'active' : '' }}" href="{{ url('media') }}">Media</a></li>
				<!-- <li class="nav-item">
				<a class="nav-link" href="get-active">Get Active</a>
				</li> -->
				<!-- <li class="nav-item {{ (request()->is('contact-us')) ? 'active' : '' }}"><a class="nav-link {{ (request()->is('contact-us')) ? 'active' : '' }}" href="{{ url('contact-us') }}">Contact Us</a></li> -->
			  </ul>
			</div>
		  </nav>
		</div>
	  </div>
	</div>