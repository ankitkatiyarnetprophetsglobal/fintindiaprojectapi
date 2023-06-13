@extends('layouts.app')
@section('title', 'fit-india-icons')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<section id="{{ $active_section_id }}">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            
        </div>
    </div>
<h1 class="heading">LIST OF FIT INDIA ICONS</h1>


<div class="row">
    <div class="col-sm-12 col-md-12">
    <div class="amb-dv">
   <div class="amb-rw">
     <div class="amb-colm">
			<div class="amb-pic"><img src="https://fitindia.gov.in/wp-content/uploads/2021/02/shahid-kapoor.jpeg" alt="Shahid Kapoor
" title="Shahid Kapoor"></div>
				<div class="amb-details">
          <p class="amb-name"><b>Shahid Kapoor</b></p> 
					<p class="amb-desig">Actor</p> 
					<p class="amb-state">Delhi</p> 
					<p class="amb-social-dv"><a class="fb-i" href="https://www.facebook.com/shahidkapoor" target="_blank" rel="noopener noreferrer"></a><a class="twt-i" href="https://twitter.com/shahidkapoor" target="_blank"></a><a class="insta-i" href="https://www.instagram.com/shahidkapoor/" target="_blank" rel="noopener noreferrer"></a></p> 
				</div>
		</div>
     <div class="amb-colm">
			<div class="amb-pic"><img src="https://fitindia.gov.in/wp-content/uploads/2021/02/Chetan.jpeg" alt="Chetan Bhagat" title="Chetan Bhagat"></div>
				<div class="amb-details">
          <p class="amb-name"><b>Chetan Bhagat</b></p> 
					<p class="amb-desig">Writer</p> 
					<p class="amb-state">Delhi</p> 
					<p class="amb-social-dv"><a class="fb-i" href="https://www.facebook.com/chetan.bhagat.1000" target="_blank" rel="noopener noreferrer"></a><a class="twt-i" href="https://twitter.com/chetan_bhagat" target="_blank"></a><a class="insta-i" href="https://www.instagram.com/chetanbhagat/" target="_blank" rel="noopener noreferrer"></a></p> 
				</div>
		</div>
     
     <div class="amb-colm">
			<div class="amb-pic"><img src="https://fitindia.gov.in/wp-content/uploads/2021/02/vidyut.jpeg" alt="Vidyut Jammwal" title="Vidyut Jammwal"></div>
				<div class="amb-details">
          <p class="amb-name"><b>Vidyut Jammwal</b></p> 
					<p class="amb-desig">Actor</p> 
					<p class="amb-state">Jammu</p> 
					<p class="amb-social-dv"><a class="fb-i" href="https://www.facebook.com/OfficialVidyutJammwal/" target="_blank" rel="noopener noreferrer"></a><a class="twt-i" href="https://twitter.com/vidyutjammwal" target="_blank" rel="noopener noreferrer"></a><a class="insta-i" href="https://www.instagram.com/mevidyutjammwal/" target="_blank" rel="noopener noreferrer"></a></p> 
				</div>
		</div>
     </div>
      <div class="amb-rw">

          <div class="amb-colm">
			<div class="amb-pic"><img src="https://fitindia.gov.in/wp-content/uploads/2021/02/shilpa.jpeg" alt="Shilpa Shetty" title="Shilpa Shetty"></div>
				<div class="amb-details">
          <p class="amb-name"><b>Shilpa Shetty</b></p> 
					<p class="amb-desig">Actor</p> 
					<p class="amb-state">Karnataka</p> 
					<p class="amb-social-dv"><a class="fb-i" href="https://www.facebook.com/TheShilpaShetty" target="_blank" rel="noopener noreferrer"></a><a class="twt-i" href="https://twitter.com/TheShilpaShetty" target="_blank" rel="noopener noreferrer"></a><a class="insta-i" href="https://www.instagram.com/theshilpashetty" target="_blank" rel="noopener noreferrer"></a></p> 
				</div>
		</div>
     
          <div class="amb-colm">
			<div class="amb-pic"><img src="https://fitindia.gov.in/wp-content/uploads/2021/02/Rannvijay.jpg" alt="Rannvijay Singh" title="Rannvijay Singh"></div>
				<div class="amb-details">
          <p class="amb-name"><b>Rannvijay Singh</b></p> 
					<p class="amb-desig">Actor</p> 
					<p class="amb-state">Punjab</p> 
					<p class="amb-social-dv"><a class="fb-i" href="https://www.facebook.com/Rannvijay/" target="_blank" rel="noopener noreferrer"></a><a class="twt-i" href="https://twitter.com/rannvijaysingha" target="_blank" rel="noopener noreferrer"></a><a class="insta-i" href="https://www.instagram.com/rannvijaysingha/" target="_blank" rel="noopener noreferrer"></a></p> 
				</div>
		</div>


          <div class="amb-colm">
			<div class="amb-pic"><img src="https://fitindia.gov.in/wp-content/uploads/2021/02/Kajal.jpeg" alt="Kajal Aggarwal" title="Kajal Aggarwal"></div>
				<div class="amb-details">
          <p class="amb-name"><b>Kajal Aggarwal</b></p> 
					<p class="amb-desig">Actor</p> 
					<p class="amb-state">Maharastra</p> 
					<p class="amb-social-dv"><a class="fb-i" href="https://www.facebook.com/ImKajalAggarwal" target="_blank" rel="noopener noreferrer"></a><a class="twt-i" href="https://twitter.com/MsKajalAggarwal" target="_blank" rel="noopener noreferrer"></a><a class="insta-i" href="https://www.instagram.com/kajalaggarwalofficial" target="_blank" rel="noopener noreferrer"></a></p> 
				</div>
		</div>
</div>
      <div class="amb-rw">

          <div class="amb-colm">
			<div class="amb-pic"><img src="https://fitindia.gov.in/wp-content/uploads/2021/02/Anil-Kapoor.jpg" alt="Anil Kapoor" title="Anil Kapoor"></div>
				<div class="amb-details">
          <p class="amb-name"><b>Anil Kapoor</b></p> 
					<p class="amb-desig">Actor</p> 
					<p class="amb-state">Maharastra</p> 
					<p class="amb-social-dv"><a class="fb-i" href="https://www.facebook.com/anilskapoor/" target="_blank" rel="noopener noreferrer"></a><a class="twt-i" href="https://twitter.com/anilkapoor" target="_blank" rel="noopener noreferrer"></a><a class="insta-i" href="https://www.instagram.com/anilskapoor/" target="_blank" rel="noopener noreferrer"></a></p> 
				</div>
		</div>


          <div class="amb-colm">
			<div class="amb-pic"><img src="https://fitindia.gov.in/wp-content/uploads/2021/02/Ameesh.jpeg" alt="Amish Tripathi" title="Amish Tripathi"></div>
				<div class="amb-details">
          <p class="amb-name"><b>Amish Tripathi</b></p> 
					<p class="amb-desig">Writer</p> 
					<p class="amb-state">Maharastra</p> 
					<p class="amb-social-dv"><a class="fb-i" href="https://www.facebook.com/authoramish" target="_blank" rel="noopener noreferrer"></a><a class="twt-i" href="https://twitter.com/amisht" target="_blank" rel="noopener noreferrer"></a><a class="insta-i" href="https://www.instagram.com/authoramish/" target="_blank" rel="noopener noreferrer"></a></p> 
				</div>
		</div>


          <div class="amb-colm">
			<div class="amb-pic"><img src="https://fitindia.gov.in/wp-content/uploads/2021/02/Sapna-Vyas.jpg" alt="Sapna Vyas" title="Sapna Vyas"></div>
				<div class="amb-details">
          <p class="amb-name"><b>Sapna Vyas</b></p> 
					<p class="amb-desig">Fitness Coach</p> 
					<p class="amb-state">Gujarat</p> 
					<p class="amb-social-dv"><a class="fb-i" href="https://www.facebook.com/sapnavyasofficial" target="_blank" rel="noopener noreferrer"></a><a class="twt-i" href="https://twitter.com/coachsapna" target="_blank" rel="noopener noreferrer"></a><a class="insta-i" href="https://www.instagram.com/coachsapna/" target="_blank" rel="noopener noreferrer"></a></p> 
				</div>
		</div>

</div>
      <div class="amb-rw">
          <div class="amb-colm">
			<div class="amb-pic"><img src="https://fitindia.gov.in/wp-content/uploads/2021/02/sunil-chhetri.jpg" alt="Sunil Chhetri" title="Sunil Chhetri"></div>
				<div class="amb-details">
          <p class="amb-name"><b>Sunil Chhetri</b></p> 
					<p class="amb-desig">Footballer</p> 
					<p class="amb-state">Telengana</p> 
					<p class="amb-social-dv"><a class="fb-i" href="https://www.facebook.com/SunilChhetriOfficial" target="_blank" rel="noopener noreferrer"></a><a class="twt-i" href="https://twitter.com/chetrisunil11" target="_blank" rel="noopener noreferrer"></a><a class="insta-i" href="https://www.instagram.com/chetri_sunil11/" target="_blank" rel="noopener noreferrer"></a></p> 
				</div>
		</div>


          <div class="amb-colm">
			<div class="amb-pic"><img src="https://fitindia.gov.in/wp-content/uploads/2021/02/pv-sindhu.jpg" alt="PV Sindhu" title="PV Sindhu"></div>
				<div class="amb-details">
          <p class="amb-name"><b>PV Sindhu</b></p> 
					<p class="amb-desig">Badminton Player</p> 
					<p class="amb-state">Andhra Pradesh</p> 
					<p class="amb-social-dv"><a class="fb-i" href="https://www.facebook.com/PVSindhu.OGQ" target="_blank" rel="noopener noreferrer"></a><a class="twt-i" href="https://twitter.com/pvsindhu1" target="_blank" rel="noopener noreferrer"></a><a class="insta-i" href="https://www.instagram.com/pvsindhu1" target="_blank" rel="noopener noreferrer"></a></p> 
				</div>
		</div>


          <div class="amb-colm">
			<div class="amb-pic"><img src="https://fitindia.gov.in/wp-content/uploads/2021/02/mary-kom.jpg" alt="MC Mary Kom" title="MC Mary Kom"></div>
				<div class="amb-details">
          <p class="amb-name"><b>MC Mary Kom</b></p> 
					<p class="amb-desig">Boxer</p> 
					<p class="amb-state">Manipur</p> 
					<p class="amb-social-dv"><a class="fb-i" href="https://www.facebook.com/MCMaryKomofficial" target="_blank" rel="noopener noreferrer"></a><a class="twt-i" href="https://twitter.com/MangteC" target="_blank" rel="noopener noreferrer"></a><a class="insta-i" href="https://www.instagram.com/mcmary.kom" targmt="_blank" rel="noopener noreferrer"></a></p> 
				</div>
		</div>

</div>
      <div class="amb-rw">
          <div class="amb-colm">
			<div class="amb-pic"><img src="https://fitindia.gov.in/wp-content/uploads/2021/02/bhutiya.jpeg" alt="Bhaichung Bhutia" title="Bhaichung Bhutia"></div>
				<div class="amb-details">
          <p class="amb-name"><b>Bhaichung Bhutia</b></p> 
					<p class="amb-desig">Footballer</p> 
					<p class="amb-state">Sikkim</p> 
					<p class="amb-social-dv"><a class="fb-i" href="https://www.facebook.com/BhaichungBhutiaOfficial" target="_blank" rel="noopener noreferrer"></a><a class="twt-i" href="https://twitter.com/bhaichung15" target="_blank" rel="noopener noreferrer"></a><a class="insta-i" href="https://www.instagram.com/bhaichung15" target="_blank" rel="noopener noreferrer"></a></p> 
				</div>
		</div>


          <div class="amb-colm">
			<div class="amb-pic"><img src="https://fitindia.gov.in/wp-content/uploads/2021/02/Hima-Das.jpeg" alt="Hima Das" title="Hima Das"></div>
				<div class="amb-details">
          <p class="amb-name"><b>Hima Das</b></p> 
					<p class="amb-desig">Athlete</p> 
					<p class="amb-state">Assam</p> 
					<p class="amb-social-dv"><a class="fb-i" href="https://www.facebook.com/hema.das.1804" target="_blank" rel="noopener noreferrer"></a><a class="twt-i" href="https://twitter.com/himadas8" target="_blank" rel="noopener noreferrer"></a><a class="insta-i" href="https://www.instagram.com/hima_mon_jai/" target="_blank" rel="noopener noreferrer"></a></p> 
				</div>
		</div>



          <div class="amb-colm">
			<div class="amb-pic"><img src="https://fitindia.gov.in/wp-content/uploads/2021/02/sangram.jpeg" alt="Sangram Singh" title="Sangram Singh"></div>
				<div class="amb-details">
          <p class="amb-name"><b>Sangram Singh</b></p> 
					<p class="amb-desig">Wrestler</p> 
					<p class="amb-state">Haryana</p> 
					<p class="amb-social-dv"><a class="fb-i" href="https://www.facebook.com/sangramsinghofficial/" target="_blank" rel="noopener noreferrer"></a><a class="twt-i" href="https://twitter.com/sangram_sanjeet" target="_blank" rel="noopener noreferrer"></a><a class="insta-i" href="https://www.instagram.com/sangramsingh_wrestler/" target="_blank" rel="noopener noreferrer"></a></p> 
				</div>
		</div>

</div>


</div>

    </div>
</div>


</div>
</section>

<script>



   

</script>
               
@endsection
