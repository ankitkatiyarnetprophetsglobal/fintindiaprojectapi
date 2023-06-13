<div class="banner_area_txt">
	<h4> Registered as : <?php echo ucwords(Auth::user()->role);?></h4>
	<h5> Welcome <?php echo ucwords(Auth::user()->name);?></h5>
	@if(\App\Models\Ambassador::where('email',Auth::user()->email)->where('status','1')->first())
	<h5> I am a Fit India Ambassador</h5>
	@endif 
	@if(\App\Models\Champion::where('email',Auth::user()->email)->where('status','1')->first())
	<h5> I am a Fit India Champion</h5>
	@endif 
</div>