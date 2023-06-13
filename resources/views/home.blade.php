@extends('layouts.app')
@section('title', 'Fit India - Be fit')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp

<style type="text/css">

 .flex-container a:hover,
.flex-slider a:hover {
  outline: none;
}
.slides,
.slides > li,
.flex-control-nav,
.flex-direction-nav {
  margin: 0;
  padding: 0;

  list-style: none;
}
.flex-pauseplay span {
  text-transform: capitalize;
}
/* ====================================================================================================================
 * BASE STYLES
 * ====================================================================================================================*/
.flexslider_first {
  margin: 0;
  padding: 0;
  padding:0 20px;
  width: 85%;
 
}
.flexslider_sec {
  margin: 0;
  padding: 0;
  padding:0 0;
  width: 100%;

}
.flexslider .slides > li {
  display: none;
  -webkit-backface-visibility: hidden;
}
.flexslider .slides img {
  width: 100%;
  display: block;
}
.flexslider .slides:after {
  content: "\0020";
  display: block;
  clear: both;
  visibility: hidden;
  line-height: 0;
  height: 0;
}
html[xmlns] .flexslider .slides {
  display: block;
}
* html .flexslider .slides {
  height: 1%;
}
.no-js .flexslider .slides > li:first-child {
  display: block;
}
/* ====================================================================================================================
 * DEFAULT THEME
 * ====================================================================================================================*/
.flexslider {

   
    margin: 0 0 100px;
    margin: 0 auto;
    background: #fff;
    border: 4px solid #fff;
    position: relative;
    zoom: 1;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    -webkit-box-shadow: '' 0 1px 4px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: '' 0 1px 4px rgba(0, 0, 0, 0.2);
    -o-box-shadow: '' 0 1px 4px rgba(0, 0, 0, 0.2);
    box-shadow: '' 0 1px 4px rgba(0, 0, 0, 0.2);
}
.flexslider .slides {
  zoom: 1;
}
.flexslider .slides img {
  height: auto;
  -moz-user-select: none;
}
.flex-viewport {
  max-height: 2000px;
  -webkit-transition: all 1s ease;
  -moz-transition: all 1s ease;
  -ms-transition: all 1s ease;
  -o-transition: all 1s ease;
  transition: all 1s ease;
}
.loading .flex-viewport {
  max-height: 300px;
}
@-moz-document url-prefix() {
  .loading .flex-viewport {
    max-height: none;
  }
}
.carousel li {
  margin-right: 5px;
}
.flex-direction-nav {
  *height: 0;
}
.flex-direction-nav a {
  text-decoration: none;
  display: block;
  /* width: 40px;
  height: 40px; */
  margin: -20px 0 0;
  position: absolute;
  top: 48%;
  z-index: 10;
  overflow: hidden;
  opacity: 0;
  cursor: pointer;
  color: rgba(0, 0, 0, 0.8);
  text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.3);
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}
.flex-direction-nav a:before {
  font-family: FontAwesome;
  font-size: 38px;
  display: inline-block;
  content: '\f053 ';
  color: rgba(0, 0, 0, 0.8);
  text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.3);
}
.flex-direction-nav a.flex-next:before {
  content: '\f054 ';
}
.flex-direction-nav .flex-prev {
  left: -50px;
}
.flex-direction-nav .flex-next {
  right: -50px;
  text-align: right;
}
.flexslider:hover .flex-direction-nav .flex-prev {
  opacity: 0.7;
  left: 10px;
}
.flexslider:hover .flex-direction-nav .flex-prev:hover {
  opacity: 1;
}
.flexslider:hover .flex-direction-nav .flex-next {
  opacity: 0.7;
  right: 10px;
}
.flexslider:hover .flex-direction-nav .flex-next:hover {
  opacity: 1;
}
.flex-direction-nav .flex-disabled {
  opacity: 0!important;
  filter: alpha(opacity=0);
  cursor: default;
  z-index: -1;
}
.flex-pauseplay{text-align: center;width: 100%;margin:0 auto;}
.flex-pauseplay a {
  display: block;
  /* width: 20px;
  height: 20px; */
  position: absolute;
  bottom: 5px;
  left: 10px;
  opacity: 0.8;
  z-index: 10;
  overflow: hidden;
  cursor: pointer;
  color: #000;text-align: center;
  width:100%;
}
.flex-pauseplay a:before {
  font-family: FontAwesome;
  font-size: 20px;
  display: inline-block;
  content: '\f04b';
}
.flex-pauseplay a:hover {
  opacity: 1;
}
.flex-pauseplay a.flex-play:before {
  content: '\f04c';
}
.flex-control-nav {
  width: 100%;
  position: absolute;
  bottom: -40px;
  text-align: center;
}
.flex-control-nav li {
  margin: 0 6px;
  display: inline-block;
  zoom: 1;
  *display: inline;
}
.flex-control-paging li a {
  width: 11px;
  height: 11px;
  display: block;
  background: #666;
  background: rgba(0, 0, 0, 0.5);
  cursor: pointer;
  text-indent: -9999px;
  -webkit-box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.3);
  -moz-box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.3);
  -o-box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.3);
  box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.3);
  -webkit-border-radius: 20px;
  -moz-border-radius: 20px;
  border-radius: 20px;
}
.flex-control-paging li a:hover {
  background: #333;
  background: rgba(0, 0, 0, 0.7);
}
.flex-control-paging li a.flex-active {
  background: #000;
  background: rgba(0, 0, 0, 0.9);
  cursor: default;
}
.flex-control-thumbs {
  margin: 5px 0 0;
  position: static;
  overflow: hidden;
}
.flex-control-thumbs li {
  width: 25%;
  float: left;
  margin: 0;
}
.flex-control-thumbs img {
  width: 100%;
  height: auto;
  display: block;
  opacity: .7;
  cursor: pointer;
  -moz-user-select: none;
  -webkit-transition: all 1s ease;
  -moz-transition: all 1s ease;
  -ms-transition: all 1s ease;
  -o-transition: all 1s ease;
  transition: all 1s ease;
}
.flex-control-thumbs img:hover {
  opacity: 1;
}
.flex-control-thumbs .flex-active {
  opacity: 1;
  cursor: default;
}

.footer-bottom-wrapper {

  background: url(resources/imgs/patterns-img.png) repeat;

    background-repeat: repeat;
    /* background-color: #333; */
    padding: 0px 0px;
    color: #b8b8b8;
    position: relative;
    text-align: center;
}
/* ====================================================================================================================
 * RESPONSIVE
 * ====================================================================================================================*/
@media screen and (max-width: 860px) {
  .flex-direction-nav .flex-prev {
    opacity: 1;
    left: 10px;
  }
  .flex-direction-nav .flex-next {
    opacity: 1;
    right: 10px;
  }
}
</style>


<script src="{{ asset('resources/js/ajaxjquery.min.js')}}"></script>
 <link src="resources/css/flexslider.css" type="text/css" media="screen"></link>
<!-- <link src="resources/css/flexslider-rtl.css" type="text/css" media="screen"></link>  -->

<div class="container-fluid" id="{{ $active_section_id }}">
<div class="banner">
	<div class="row">
		<div class="col-12">

		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<a href="champion-and-ambassador" target="_blank"><img src="resources/imgs/home/homepagebanner.jpg" class="d-block w-100" alt="India champions and Ambassadors" title="India champions and Ambassadors
          "></a>
				</div>
				
				<div class="carousel-item">
				  <a href="javascript:void(0);"><img src="resources/imgs/home/fitnesskadoze.png" class="d-block w-100" alt="Fitness Ka Doze" title="Fitness Ka Doze"></a>
				  <!-- <img src="imgs/slider/fitness-protocols.png" class="d-block w-100" alt="Freedom Run NSG"> -->
				</div>
				<div class="carousel-item">
				  <a href="https://schoolfitness.kheloindia.gov.in/tot.aspx" target="_blank"><img src="resources/imgs/home/PE-Teacher-Banner-new.jpg" class="d-block w-100" alt="women's day"></a>
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			  </a>
		</div>
		</div>
	</div>
</div>

<!-- ------------------------New section add--------------------------------- -->



<section >
  <div class="container">
  <div class="row n_top">
    <div class="col-sm-12 col-md-4 col-lg-4 hover_a">
    <a href="" target="_blank">
      <div class="shar_div shadow n_sec">
        <img src="resources/images/default_thumb.jpg" class="img-fluid img_radius_lr"  alt="Sardar Gurbachan Singh, Hockey Olympian" title="Sardar Gurbachan Singh, Hockey Olympian"/>
          <h3>School Certificate</h3>
      </div>
      </a>
    </div>
    

    
    <div class="col-sm-12 col-md-4 col-lg-4 hover_a">
    <a href="{{ url('fit-india-ambassador') }}" target="_blank">
      <div class="shar_div shadow n_sec">
      <img src="resources/images/default_thumb.jpg" class="img-fluid img_radius_lr"  alt="fit-india-ambassador" title="fit-india-ambassador"/>
          <h3>Youth Club Certificate</h3>
      </div>
    </a>
    </div>
    <div class="col-sm-12 col-md-4 col-lg-4 hover_a">
    <a href="{{ url('fit-india-champions') }}" target="_blank">
      <div class="shar_div shadow n_sec">
      <img src="resources/images/default_thumb.jpg" class="img-fluid img_radius_lr"  alt="fit-india-champions" title="fit-india-champions"/>
          <h3>Ambassador/ Champion</h3>
      </div>
      </a>
    </div>    
  </div>
</div>
</section>


<section>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="heading">Fitness Ki Dose Aadha Ghanta Roz</h2>
        <!-- <p class="text-center">Fit India tools for people who want to lead a healthy life and reach their fitness goals</p> -->
      </div>
    </div>    
     <div class="row">
      <div class="col-sm-12 col-md-8 offset-md-2"> 
        <div class="fitter_area_inner">              
            <div class="fitter_area">
              <video controls="">
                <source type="video/mp4" src="https://fitindia.gov.in/wp-content/uploads/2021/02/akkad-bakkad2.mp4">
              </video>
            </div>
        </div>        
      </div>          
    </div>
  </div>
</section>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
          <div class="video_sec">
            <div class="video-overlay"></div>
            <video autoplay muted loop id="VideoId">
              <source src="resources/imgs/home/share_story_video.mp4" type="video/mp4">       
            </video>
            <div class="ove_text">
              <h2>Share Your Story</h2>
              <p>Stories have the power to inspire and empower. We’re collecting stories of your Fitness experiences.</p>
            </div>
        </div>
        </div>
	</div>
  </div>


<section class="sec_top">
  <div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="shar_div shadow">
        <img src="resources/imgs/home/Sardar-Gurbachan-Singh_Hockey-Olympian-400x250.jpg" class="img-fluid img_radius_lr"  alt="Sardar Gurbachan Singh, Hockey Olympian" title="Sardar Gurbachan Singh, Hockey Olympian"/>
          <h3>Sardar Gurbachan Singh, Hockey Olympian (1964,1968) & had been Coach of 1976 Indian Olympics</h3>
      </div>
    </div>
    <div class="col-md-3">
      <div class="shar_div shadow">
        <img src="resources/imgs/home/Surya_Namaskar-400x250.jpg" class="img-fluid img_radius_lr" alt="Daily Routine of Surya Namaskar and Cardio, 85+ years" title="Daily Routine of Surya Namaskar and Cardio, 85+ years"/>
          <h3>Daily Routine of Surya Namaskar and Cardio, 85+ years</h3>
      </div>
    </div>
    <div class="col-md-3">
      <div class="shar_div shadow">
        <img src="resources/imgs/home/T_A_ANGAPPAN-400x250.jpg" class="img-fluid img_radius_lr" alt="T.A ANGAPPAN" title="T.A ANGAPPAN"/>
          <h3>T.A ANGAPPAN , AGE 88</h3>
      </div>
    </div>
    <div class="col-md-3">
      <div class="shar_div shadow">
        <img src="resources/imgs/home/Cycling_Rajpath-400x250.jpg" class="img-fluid img_radius_lr"  alt="Fitness Enthusiasts" title="Fitness Enthusiasts"/>
          <h3>Fitness Enthusiasts – Cycling on Rajpath</h3>
      </div>
    </div>

    <div class="see_area ">   
      <a class="seemore shadow_O" href="your-stories">See More</a>
    </div>
  </div>
</div>
</section>

<div class="slider">
  <div class="flexslider  flexslider_first carousel" id="f2" >
  <ul class="slides">
          <li class="">  
             <a href="javascript:onClick=doModal('https://fitindia.gov.in/')"><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/fit_india_logo-b.png" width="139" height="124" alt="Fit India" title="Fit India - External link that open in a new window" /></a> 
         </li>
          <li class="">  
          <a href="javascript:onClick=doModal('http://sportsauthorityofindia.nic.in/')"><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/sai_trans_logo_new.png" width="196" height="138" alt="Sports Authority of India" title="Sports Authority of India - External link that open in a new window" /></a> 
         </li>
          <li class=""> 
          <a href="javascript:onClick=doModal('http://nsu.ac.in/')"><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/logo.png" width="111" height="104" alt="National Sports University" title="National Sports University - External link that open in new window" /></a> 
        </li>
          <li class="">
          <a href="javascript:onClick=doModal('https://yas.nic.in/sports/khelo-india-national-programme-development-sports-0')"><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/Final%20Logo%20without%20tagline-02.jpg" width="163" height="98" alt="Khelo India" title="KHELO INDIA, External link that open in a new window" /></a>  
        </li>
          <li class="">  
          <a href="javascript:onClick=doModal('https://www.nadaindia.org/')"><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/partner05.png" width="143" height="114" alt="National Anti Doping Agency" title="National Anti Doping Agency - External link that open in a new window" /></a> 
         </li>
          <li class="">  
          <a href="javascript:onClick=doModal('http://www.ndtlindia.com/')"><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/NDTL_Logo2015_0.png" width="143" height="114" alt="National Dope Testing Laboratory" title="National Dope Testing Laboratory - External link that open in new window" /></a> 
         </li>
          <li class=""> 
          <a href="javascript:onClick=doModal('http://nyks.nic.in/')"><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/partner08.png" width="143" height="114" alt="Nehru Yuva Kendra Sangathan" title="Nehru Yuva Kendra Sangathan, External Link that open in new window" /></a> 
         </li>
          <li class=""> 
          <a href="javascript:onClick=doModal('http://www.rgniyd.gov.in')"><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/partner04.png" width="143" height="114" alt="Rajiv Gandhi National Institute of Youth Development" title="Rajiv Gandhi National Institute of Youth Development - External link that open in a new window" /></a> 
         </li>
          <li class="">  
          <a href="javascript:onClick=doModal('http://www.lnipe.edu.in/default.html')" target="_blank"><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/partner06.png" width="143" height="114" alt="Lakshmibai National Institute Of Physical Education" title="Lakshmibai National Institute Of Physical Education - External link that open in a new window" /></a> </li>
          <li class="">  
          <a href="javascript:onClick=doModal('http://nss.gov.in/')"><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/partner01.png" width="143" height="114" alt="National service Scheme" title="National service Scheme - External link that open in a new window" /></a>  
        </li>
  </ul>
</div>
</div>



  
<div  id="flexslider-1" class="flexslider flexslider_sec footer-bottom-wrapper">
  <ul class="slides">
    <li>  
      <a href="javascript:onClick=doModal('https://www.ncs.gov.in/Pages/default.aspx')"  title="External site that opens in a new window "><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/styles/200_150/public/NCS_Logo_0.png?itok=JkS9RMmK" width="200" height="150" alt="National Career Service" title="National Career Service" /></a>
    </li>

    <li>  
     <a href="javascript:onClick=doModal('https://indiacode.nic.in/')"    title="External site that opens in a new window "><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/styles/200_150/public/india%20logo.png?itok=_S0SHuGG" width="200" height="150" alt="India Code" title="India Code" /></a> 
    </li>

    <li>  
      <a href="javascript:onClick=doModal('http://www.pib.gov.in/newsite/mainpage.aspx')"   title="External site that opens in a new window "><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/styles/200_150/public/pib_gov.png?itok=LM_Xl77s" width="200" height="150" alt="Press Information Bureau" title="PIB - External link that open in a new window" /></a> 
    </li>

    <li>  
    
          <a href="javascript:onClick=doModal('https://gem.gov.in/')"    title="External site that opens in a new window "><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/styles/200_150/public/GeM.png?itok=Be6LeylE" width="200" height="150" alt="GeM" title="GeM - External link that open in a new window" /></a>  
    </li>


    <li>  
      <a href="javascript:onClick=doModal('https://mygov.in/')"  title="External site that opens in a new window "><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/styles/200_150/public/mygov.png?itok=9tAneEW2" width="200" height="150" alt="my gov" title="my gov - External link that open in a new window" /></a>  
    </li>

    <li>  

          <a href="javascript:onClick=doModal('https://pmnrf.gov.in/')"  title="External site that opens in a new window "><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/styles/200_150/public/moca_crasoul5.png?itok=T7YGgUql" width="200" height="150" alt="PMNRF" title="PMNRF - External link that open in a new window" /></a> 
    </li>


    <li> 

      <a href="javascript:onClick=doModal('http://www.makeinindia.com/home')"  title="External site that opens in a new window "><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/styles/200_150/public/moca_crasoul3_0.png?itok=IlJGzwVb" width="200" height="150" alt="Make in India" title="Make in India - External link that open in a new window" /></a> 
    </li>

    <li>  

      <a href="javascript:onClick=doModal('https://india.gov.in/')"  title="External site that opens in a new window "><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/styles/200_150/public/india-gov.png?itok=1EjOTnP1" width="200" height="150" alt="India Gov" title="India Gov - External link that open in a new window" /></a>  
    </li>

    <li>  

          <a href="javascript:onClick=doModal('http://incredibleindia.org/')"  title="External site that opens in a new window "><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/styles/200_150/public/incredible-india.png?itok=zKeEa89K" width="200" height="150" alt="Incredible India" title="Incredible India - External link that open in a new window" /></a> 
    </li>

    <li>  

          <a href="javascript:onClick=doModal('http://goidirectory.nic.in/index.php')"  title="External site that opens in a new window "><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/styles/200_150/public/imageedit_1_2626406453.jpg?itok=J6t0OjE7" width="200" height="150" alt="GOI" title="GOI - External link that open in a new window" /></a>  
    </li>


    <li>  

          <a href="javascript:onClick=doModal('http://www.digitalindia.gov.in/')"  title="External site that opens in a new window "><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/styles/200_150/public/imageedit_3_5213179193.jpg?itok=_fWtNxS_" width="200" height="150" alt="Digital India" title="Digital India - External link that open in a new window" /></a>  
    </li>

    <li>  

          <a href="javascript:onClick=doModal('https://data.gov.in/')" title="External site that opens in a new window "><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/styles/200_150/public/data-gov.png?itok=QZEj6uzr" width="200" height="150" alt="Data Gov" title="Data Gov - External link that open in a new window" /></a> 
    </li>

    <li>  
      
          <a href="javascript:onClick=doModal('http://pgportal.gov.in/cpgoffice/')"  title="External site that opens in a new window "><img typeof="foaf:Image" src="https://yas.nic.in/sites/default/files/styles/200_150/public/alphaimage.png?itok=KQHJnmFp" width="200" height="150" alt="CPGRAMS" title="CPGRAMS - External link that open in a new window" /></a>  
    </li>
</ul>
</div>

</div>




  

<script src="{{ asset('resources/js/jquery.flexslider.js')}}"></script>

<script  type="text/javascript">

    // $('footer').append("footer_bottom_id")

    $(window).load(function(){
 
    $('#f2').flexslider({
        animation: "slide",
        animationLoop: false,
        itemWidth: 140,
        itemMargin:50,
        pausePlay: true,
        mousewheel: true,
        controlNav: false,
        pauseText: '',
        playText: '', 
        prevText: "", //String: Set the text for the "previous" directionNav item
        nextText: ""
        
      });


      $('#flexslider-1').flexslider({
        animation: "slide",
        animationLoop: false,
        itemWidth: 140,
        itemMargin:50,
        pausePlay: true,
        mousewheel: true,
        controlNav: false,
        pauseText: '',
        playText: '', 
        prevText: "", //String: Set the text for the "previous" directionNav item
  nextText: "", 
     
       
        
      });
    });

 
  </script>

  <script type="text/javascript">

$(function(){
  var toggles = $('.toggle a'),
      codes = $('.code');
  
  toggles.on("click", function(event){
    event.preventDefault();
    var $this = $(this);
    
    if (!$this.hasClass("active")) {
      toggles.removeClass("active");
      $this.addClass("active");
      codes.hide().filter(this.hash).show();
    }
  });
  toggles.first().click();
});
  </script>


@endsection
