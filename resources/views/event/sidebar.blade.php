@php
$route = explode('@', Route::currentRouteAction());
@endphp

<div class="col-sm-12 col-md-3">
    <div class="events-sidebar">
	@if(strtolower($role) == 'youth club')
    	<a href="{{ route('youthcert') }}" class="my-events">
			<span class="dashicons dashicons-star-half"></span>Fit India Youth Club Certification
		</a>
	@endif
	
	@if(strtolower($role) == 'school')
    	<a href="{{ route('schoolcert') }}" class="my-events">
			<span class="dashicons dashicons-star-half"></span>Fit India School Certification
		</a>
	@endif	
        <a href="{{ route('create-event') }}" class="create_events {{ ($route[1] == 'createevent') ? 'active' : '' }}" >
			<span class="dashicons dashicons-edit"></span>Organise an Event
		</a>
        <a href="{{ route('my-events') }}" class="my-events {{ ($route[1] == 'myevents') ? 'active' : '' }}">
			<span class="dashicons dashicons-list-view"></span>My Events
		</a>
		<a href="{{ route('eventspic') }}" class="my-events {{ ($route[1] == 'eventspic') ? 'active' : '' }}">
			<span class="dashicons dashicons-format-gallery"></span>My Event Pics
		</a>
		@if(\App\Models\Ambassador::where('email',Auth::user()->email)->where('status','1')->first() OR \App\Models\Champion::where('email',Auth::user()->email)->where('status','1')->first())
		<a href="{{ route('my-status') }}" class="my-events {{ ($route[1] == 'myApplicationStatus') ? 'active' : '' }}">
			<span class="dashicons dashicons-format-gallery"></span>My Application Status
		</a>
		@endif
    </div>
</div>