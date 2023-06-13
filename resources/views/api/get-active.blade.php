@extends('api.layouts.app')
<link rel="stylesheet" href="{{ URL::asset('/resources/css/aos.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('resources/css/getactive.css') }}">

<div class="container-fluid">  
    <div class="video_sec">   
        <video autoplay muted loop id="VideoId">
          <source src="https://fitindia.gov.in/wp-content/uploads/2019/08/share_story_video.mp4" type="video/mp4">         
        </video>
        <div class="ove_text">
          <h2>Ways to get Active</h2>
          <p>
            Browse through our collection of activities to find out more about each one.</p>
        </div>
    </div>

    <section id="portfolio" class="portfolio">
      
      <div class="container" data-aos="fade-up">   
        <div class="row">
          <div class="col-12">
            <div class="see_area " style="margin-top:0;">
              <a class="seemore shadow_O sys" href="javascript:void(0);" data-toggle="modal" data-target="#actforyou">Activities for You</a>
            </div>
            <br> 
            <br> 
          </div>
        </div>
         

        <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
          <li data-filter="*" class="filter-active" style="border-right: 0px;">All</li>
          <li data-filter=".filter-child" style="border-right: 0px;">Children</li>
          <li data-filter=".filter-families" style="border-right: 0px;">Families</li>       
          <li data-filter=".filter-sen" style="border-right: 0px;">Seniors</li>
          <li data-filter=".filter-youth">Youth</li>
        </ul>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href="http://103.65.20.170/fitindia/project/yoga-at-home" data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
              <img src="http://103.65.20.170/fitindia/wp-content/uploads/2020/02/yoga-thumb-400x284.jpg" class="img-fluid" alt="Yoga Protocols"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
            </div>
            </a>
            <h3>Yoga Protocols</h3>
          </div>



      <!-- ----------------------Children------------------------ -->

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href="http://103.65.20.170/fitindia/project/goli-gundu/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
              <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Goli-Gundu-400x284.jpg" class="img-fluid" alt="Goli Gundu"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              
            </div>
             </a>
            <h3>Goli Gundu</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href="http://103.65.20.170/fitindia/project/vish-amrit/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
              <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Vish-Amrit-400x284.jpg" class="img-fluid" alt="Vish Amrit"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
            </div>
            </a>
            <h3>Vish Amrit</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href="http://103.65.20.170/fitindia/project/langdi/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
              <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Langdi-400x284.jpg" class="img-fluid" alt="Langdi"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
            </div>
            </a>
            <h3>Langdi</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href="http://103.65.20.170/fitindia/project/maram-pitthi-game/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
              <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Maram-Pitthi-400x284.jpg" class="img-fluid" alt="Maram Pitthi Game"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
            </div>
            </a>
            <h3>Maram Pitthi Game</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href="http://103.65.20.170/fitindia/project/aankh-micholi-hide-and-seek/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
              <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/09/Aankh-Micholi-400x284.jpg" class="img-fluid" alt="Aankh Micholi (Hide and Seek)"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
            </div>
            </a>
            <h3>Aankh Micholi (Hide and Seek)</h3>
          </div>          

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href="http://103.65.20.170/fitindia/project/gilli-danda/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Gilli-Danda-400x284.jpg" class="img-fluid" alt="Gilli Danda"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
            </div>
             </a>
            <h3>Gilli Danda</h3>
          </div>



          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href="http://103.65.20.170/fitindia/project/pittho/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Pittho-400x284.jpg" class="img-fluid" alt="Pittho"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
            </div>
            </a>
            <h3>Pittho</h3> 
          </div>
          
          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href="http://103.65.20.170/fitindia/project/gilli-danda/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Gilli-Danda-400x284.jpg" class="img-fluid" alt="Kabaddi"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
            </div>
            </a>
            <h3>Kabaddi</h3>
          </div>
         
          
          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href="http://103.65.20.170/fitindia/project/kith-kith/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Kith-Kith-400x284.jpg" class="img-fluid" alt="Kith Kith"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
            </div>
             </a>
            <h3>Kith Kith</h3>
          </div>




          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href="http://103.65.20.170/fitindia/project/gilli-danda/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Gilli-Danda-400x284.jpg" class="img-fluid" alt="GROUP EXERCISE"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
            </div>
            </a>
            <h3>GROUP EXERCISE</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href="http://103.65.20.170/fitindia/project/table-tennis" data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/TABLE-TENNIS-1920-400x284.jpg" class="img-fluid" alt="TABLE TENNIS"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
            </div>
            </a>
            <h3>TABLE TENNIS</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href="http://103.65.20.170/fitindia/project/yoga-and-pilates/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Yoga-1920-400x284.jpg" class="img-fluid" alt="YOGA AND PILATES"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
            </div>
            </a>
            <h3>YOGA AND PILATES</h3>
          </div>


          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href="http://103.65.20.170/fitindia/project/basketball/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Yoga-1920-400x284.jpg" class="img-fluid" alt="BASKETBALL"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
            </div>
            </a>
            <h3>BASKETBALL</h3>
          </div>


          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
               <a href="http://103.65.20.170/fitindia/project/archery/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Archery-400x284.jpg" class="img-fluid" alt="ARCHERY"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              
            </div>
            </a>
            <h3>ARCHERY</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href="http://103.65.20.170/fitindia/project/taekwondo/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/TAEKWONDO-400x284.jpg" class="img-fluid" alt="TAEKWONDO"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
               
            </div>
            </a>
            <h3>TAEKWONDO</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href=" http://103.65.20.170/fitindia/project/ice-skating/  " data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/ICE-SKATING-1-400x284.jpg" class="img-fluid" alt="ICE SKATING"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
               
            </div>
            </a>
            <h3>ICE SKATING</h3>
          </div>


          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href=" http://103.65.20.170/fitindia/project/dance-fitness/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/DANCE-FITNESS-400x284.jpg" class="img-fluid" alt="DANCE FITNESS"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              
            </div>
             </a>
            <h3>DANCE FITNESS</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href="http://103.65.20.170/fitindia/project/ultimate-frisbee/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/ULTIMATE-FRISBEE-400x284.jpg" class="img-fluid" alt="ULTIMATE FRISBEE"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
               
            </div>
            </a>
            <h3>ULTIMATE FRISBEE</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href="http://103.65.20.170/fitindia/project/target-shooting/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/TARGET-SHOOTING-400x284.jpg" class="img-fluid" alt="Shooting"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
               
            </div>
          </a>
            <h3>Shooting</h3>
          </div>


          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href=" http://103.65.20.170/fitindia/project/softball/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/SOFTBALL-400x284.jpg" class="img-fluid" alt="SOFTBALL"></div>
            <div class="portfolio-info">
              <i class="fas fa-angle-right" style="font-size:24px"></i>
               
            </div>
          </a>
            <h3>SOFTBALL</h3>
          </div>

          

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href=" http://103.65.20.170/fitindia/project/handball/  " data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/handball-400x284.jpg" class="img-fluid" alt="HANDBALL"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              
            </div>
          </a>
            <h3>HANDBALL</h3>
          </div>


          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href=" http://103.65.20.170/fitindia/project/volleyball/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/VOLLEYBALL-400x284.jpg" class="img-fluid" alt="VOLLEYBALL"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i> </a>
            </div>
          </a>
            <h3>VOLLEYBALL</h3>
          </div>


          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
               <a href="http://103.65.20.170/fitindia/project/cricket/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/cricket-400x284.jpg" class="img-fluid" alt="CRICKET"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              
            </div>
            </a>
            <h3>CRICKET</h3>
          </div>

          

          
          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href="http://103.65.20.170/fitindia/project/badminton/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/BADMINTON-400x284.jpg" class="img-fluid" alt="BADMINTON"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              
            </div>
             </a>
            <h3>BADMINTON</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href="http://103.65.20.170/fitindia/project/gymnastics/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/fitindia_gymnastic-400x284.jpg" class="img-fluid" alt="GYMNASTICS"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
               
            </div>
            </a>
            <h3>GYMNASTICS</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href=" http://103.65.20.170/fitindia/project/kickboxing/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/KICKBOXING-400x284.jpg" class="img-fluid" alt="KICKBOXING"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
               
            </div>
            </a>
            <h3>KICKBOXING</h3>
          </div>

          
          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href=" http://103.65.20.170/fitindia/project/hockey/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/hokey-400x284.jpg" class="img-fluid" alt="HOCKEY"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
               
            </div>
            </a>
            <h3>HOCKEY</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href="http://103.65.20.170/fitindia/project/triathlon/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/TRIATHLON-400x284.jpg" class="img-fluid" alt="TRIATHLON"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
               
            </div>
            </a>
            <h3>TRIATHLON</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
               <a href="http://103.65.20.170/fitindia/project/tennis/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
              <img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/TENNIS-1-400x284.jpg" class="img-fluid" alt="Tennis"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              
            </div>
            </a>
            <h3>Tennis</h3>
          </div>


          
          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href=" http://103.65.20.170/fitindia/project/hula-hooping/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/HULA-HOOPING-400x284.jpg" class="img-fluid" alt="HULA HOOPING"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
               
            </div>
            </a>
            <h3>HULA HOOPING</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img">
              <a href=" http://103.65.20.170/fitindia/project/home-exercise/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/HOME-EXERCISE-1-400x284.jpg" class="img-fluid" alt="HOME EXERCISE"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              
            </div>
             </a>
            <h3>HOME EXERCISE</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/boxing-400x284.jpg" class="img-fluid" alt="Boxing"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href=" http://103.65.20.170/fitindia/project/boxing/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>Boxing</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-child">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/AEROBICS-400x284.jpg" class="img-fluid" alt="AEROBICS"></div>
            <div class="portfolio-info">
              <i class="fas fa-angle-right" style="font-size:24px"></i>
              <a href=" http://103.65.20.170/fitindia/project/aerobics/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>AEROBICS</h3>
          </div>


    <!-- ----------------------Close Children------------------------ -->


          <!-- ----------------------Families------------------------ -->

          
          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/09/Aankh-Micholi-400x284.jpg" class="img-fluid" alt="Aankh Micholi (Hide and Seek)"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/aankh-micholi-hide-and-seek/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>Aankh Micholi (Hide and Seek)</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Kith-Kith-400x284.jpg" class="img-fluid" alt="Kith Kith"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/kith-kith/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>Kith Kith</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/group_exercise-1920-400x284.jpg" class="img-fluid" alt="GROUP EXERCISE"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/group-exercise/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>GROUP EXERCISE</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/TABLE-TENNIS-1920-400x284.jpg" class="img-fluid" alt="TABLE TENNIS"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/table-tennis/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>TABLE TENNIS</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Personal-Training2-1024x682-400x284.jpg" class="img-fluid" alt="PERSONAL TRAINING"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/table-tennis/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>PERSONAL TRAINING</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Yoga-1920-400x284.jpg" class="img-fluid" alt="YOGA AND PILATES"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/yoga-and-pilates/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>YOGA AND PILATES</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/DANCE-FITNESS-400x284.jpg" class="img-fluid" alt="DANCE FITNESS"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/yoga-and-pilates/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>DANCE FITNESS</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/golf-400x284.jpg" class="img-fluid" alt="GOLF"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/yoga-and-pilates/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>GOLF</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/VOLLEYBALL-400x284.jpg" class="img-fluid" alt="VOLLEYBALL"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/volleyball/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>VOLLEYBALL</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/cricket-400x284.jpg" class="img-fluid" alt="CRICKET"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/cricket/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>CRICKET</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/BADMINTON-400x284.jpg" class="img-fluid" alt="BADMINTON"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/badminton/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>BADMINTON</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/TENNIS-1-400x284.jpg" class="img-fluid" alt="TENNIS"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/tennis/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>TENNIS</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/HOME-EXERCISE-1-400x284.jpg" class="img-fluid" alt="HOME EXERCISE"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/tennis/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>HOME EXERCISE</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/exercise_with_child-400x284.jpg" class="img-fluid" alt="EXERCISING WITH YOUR CHILD"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/tennis/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>EXERCISING WITH YOUR CHILD</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/AEROBICS-400x284.jpg" class="img-fluid" alt="AEROBICS"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/aerobics/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>AEROBICS</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/football-400x284.jpg" class="img-fluid" alt="FOOTBALL"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/football" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>FOOTBALL</h3>
          </div>
         

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/zumba-400x284.jpg" class="img-fluid" alt="ZUMBA"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/aerobics/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>ZUMBA</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Capture-400x284.png" class="img-fluid" alt="ZUMBA"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/aerobics/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>RUNNING & JOGGING</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/SWIMMING-400x284.jpg" class="img-fluid" alt="ZUMBA"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/swimming/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>SWIMMING</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/cycling-1-400x284.jpg" class="img-fluid" alt="CYCLING"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/cycling/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>CYCLING</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Trampoline-400x284.jpg" class="img-fluid" alt="TRAMPOLINING"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/trampolining/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>TRAMPOLINING</h3>
          </div>

          <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-families">
            <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/park-activities-400x284.png" class="img-fluid" alt="PARK WORKOUTS"></div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>
              <a href="http://103.65.20.170/fitindia/project/park-workouts/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
            </div>
            <h3>PARK WORKOUTS</h3>
          </div>
  <!-- ----------------------close Families------------------------ -->


  <!-- ----------------------Start Senior ------------------------ -->

          
  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-sen">
    <div class="portfolio-img">
      <a href="http://103.65.20.170/fitindia/project/yoga-at-home/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
      <img src=" http://103.65.20.170/fitindia/wp-content/uploads/2020/02/yoga-thumb-400x284.jpg " alt="YOGA PROTOCOLS" class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
    </div>
     </a>
    <h3>Yoga Protocols</h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-sen">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Kabaddi-400x284.jpg" alt="Kabaddi" class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="http://103.65.20.170/fitindia/project/kabaddi/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>Kabaddi </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-sen">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Kith-Kith-400x284.jpg" alt="Kith Kith"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/kith-kith/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
        <h3>Kith Kith
        </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-sen">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/group_exercise-1920-400x284.jpg" alt="GROUP EXERCISE"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/group-exercise/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>GROUP EXERCISE
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-sen">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/TABLE-TENNIS-1920-400x284.jpg" alt="TABLE TENNIS"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/table-tennis/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>TABLE TENNIS
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-sen">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Personal-Training2-1024x682-400x284.jpg" alt="PERSONAL TRAINING"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/personal-training/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>PERSONAL TRAINING
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-sen">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Yoga-1920-400x284.jpg" alt="YOGA AND PILATES"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/yoga-and-pilates/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>YOGA AND PILATES
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-sen">
    <div class="portfolio-img"><img src= "http://103.65.20.170/fitindia/wp-content/uploads/2019/08/golf-400x284.jpg" alt="GOLF"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/golf/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>GOLF
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-sen">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/VOLLEYBALL-400x284.jpg" alt="VOLLEYBALL"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/volleyball/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>VOLLEYBALL
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-sen">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/cricket-400x284.jpg" alt="CRICKET"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/cricket/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>CRICKET
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-sen">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/BADMINTON-400x284.jpg" alt="BADMINTON"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/badminton/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>BADMINTON
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-sen">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/TENNIS-1-400x284.jpg" alt="TENNIS"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/tennis/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>Tennis
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-sen">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/HOME-EXERCISE-1-400x284.jpg" alt="HOME EXERCISE"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/home-exercise/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>HOME EXERCISE
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-sen">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/AEROBICS-400x284.jpg" alt="AEROBICS"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/aerobics/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>AEROBICS
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-sen">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/football-400x284.jpg" alt="FOOTBALL"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/football/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>FOOTBALL
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-sen">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Capture-400x284.png" alt="RUNNING & JOGGING"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/running-jogging/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>RUNNING & JOGGING
    </h3>
  </div>



  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-sen">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/SWIMMING-400x284.jpg" alt="SWIMMING"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/swimming/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>SWIMMING
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-sen">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/cycling-1-400x284.jpg" alt="CYCLING"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/cycling/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>Cycling
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-sen">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/park-activities-400x284.png" alt="PARK WORKOUTS"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/park-workouts/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>PARK WORKOUTS</h3>
  </div>
  

      <!-- End Senior -->


      <!-- Start Youth -->

    
      <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
        <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2020/02/yoga-thumb-400x284.jpg " alt="YOGA PROTOCOLS" class="img-fluid"></div>
        <div class="portfolio-info">
          <i class="fas fa-angle-right' style='font-size:24px"></i>
          <a href="http://103.65.20.170/fitindia/project/yoga-at-home/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
        </div>
        <h3>Yoga Protocols</h3>
      </div>


      <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
        <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Mallakhamb-1920-400x284.jpg" alt="Mallakhamb" 
           class="img-fluid"></div>
        <div class="portfolio-info">
          <i class="fas fa-angle-right' style='font-size:24px"></i>
          <a href=" http://103.65.20.170/fitindia/project/mallakhamb/ 
          " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
        </div>
        <h3>Mallakhamb
        </h3>
      </div>


      <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
        <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Kalaripayattu-400x284.jpg" alt="Kalaripayattu" 
           class="img-fluid"></div>
        <div class="portfolio-info">
          <i class="fas fa-angle-right' style='font-size:24px"></i>
          <a href=" http://103.65.20.170/fitindia/project/kalaripayattu/  
          " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
        </div>
        <h3>Kalaripayattu
        </h3>
      </div>


      <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
        <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Dhopkhel-400x284.jpg" alt="Dhopkhel"  
           class="img-fluid"></div>
        <div class="portfolio-info">
          <i class="fas fa-angle-right' style='font-size:24px"></i>
          <a href=" http://103.65.20.170/fitindia/project/dhopkhel/  
          " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
        </div>
        <h3>Dhopkhel  
        </h3>
      </div>


      <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
        <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Gilli-Danda-400x284.jpg" class="img-fluid" alt="Gilli Danda"></div>
        <div class="portfolio-info">
          <i class="fas fa-angle-right" style="font-size:24px"></i>
          <a href="http://103.65.20.170/fitindia/project/gilli-danda/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
        </div>
        <h3>Gilli Danda</h3>
      </div>


      
  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Kabaddi-400x284.jpg" alt="Kabaddi" class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="http://103.65.20.170/fitindia/project/kabaddi/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>Kabaddi </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Kith-Kith-400x284.jpg" alt="Kith Kith"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/kith-kith/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
        <h3>Kith Kith
        </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/group_exercise-1920-400x284.jpg" alt="GROUP EXERCISE"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/group-exercise/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>GROUP EXERCISE
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/TABLE-TENNIS-1920-400x284.jpg" alt="TABLE TENNIS"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/table-tennis/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>TABLE TENNIS
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src="  http://103.65.20.170/fitindia/wp-content/uploads/2019/08/MOUNTAINEERING-400x284.jpg" alt="MOUNTAINEERING" 
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/mountaineering/  
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>MOUNTAINEERING
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Yoga-1920-400x284.jpg" alt="YOGA AND PILATES"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/yoga-and-pilates/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>YOGA AND PILATES
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Fencing-1920-400x284.jpg" alt="FENCING"   
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href=" http://103.65.20.170/fitindia/project/fencing/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>FENCING
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/CHEERLEADING-400x284.jpg" alt="CHEERLEADING"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/cheerleading/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>CHEERLEADING
    </h3>
  </div>

  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Yoga-1920-400x284.jpg" class="img-fluid" alt="BASKETBALL"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
      <a href="http://103.65.20.170/fitindia/project/basketball/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>BASKETBALL</h3>
  </div>


  

  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Archery-400x284.jpg" class="img-fluid" alt="ARCHERY"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
      <a href="http://103.65.20.170/fitindia/project/archery/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>ARCHERY</h3>
  </div>



  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/TAEKWONDO-400x284.jpg" class="img-fluid" alt="TAEKWONDO"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
      <a href="http://103.65.20.170/fitindia/project/taekwondo/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>TAEKWONDO</h3>
  </div>



  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/ICE-SKATING-1-400x284.jpg" class="img-fluid" alt="ICE SKATING"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
      <a href=" http://103.65.20.170/fitindia/project/ice-skating/  " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>ICE SKATING</h3>
  </div>



  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/DANCE-FITNESS-400x284.jpg" class="img-fluid" alt="DANCE FITNESS"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
      <a href=" http://103.65.20.170/fitindia/project/dance-fitness/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>DANCE FITNESS</h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/ULTIMATE-FRISBEE-400x284.jpg" class="img-fluid" alt="ULTIMATE FRISBEE"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
      <a href="http://103.65.20.170/fitindia/project/ultimate-frisbee/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>ULTIMATE FRISBEE</h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/TARGET-SHOOTING-400x284.jpg" class="img-fluid" alt="Shooting"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
      <a href="http://103.65.20.170/fitindia/project/target-shooting/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>Shooting</h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"> <img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/SAILING-400x284.jpg" alt="SAILING" 
      class="img-fluid"> </div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
      <a href=" http://103.65.20.170/fitindia/project/sailing/    " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>SAILING
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src= "http://103.65.20.170/fitindia/wp-content/uploads/2019/08/golf-400x284.jpg" alt="GOLF"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/golf/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>GOLF
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src= " http://103.65.20.170/fitindia/wp-content/uploads/2019/08/DIVING-1-400x284.jpg" alt="DIVING" 
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href=" http://103.65.20.170/fitindia/project/diving/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>DIVING
    </h3>
  </div>  
  

  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/SOFTBALL-400x284.jpg" class="img-fluid" alt="SOFTBALL"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
      <a href=" http://103.65.20.170/fitindia/project/softball/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>SOFTBALL</h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/handball-400x284.jpg" class="img-fluid" alt="HANDBALL"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
      <a href=" http://103.65.20.170/fitindia/project/handball/  " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>HANDBALL</h3>
  </div>



  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/VOLLEYBALL-400x284.jpg" alt="VOLLEYBALL"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/volleyball/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>VOLLEYBALL
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/SKIING-400x284.jpg" alt="SKIING"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/skiing/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>Skinng
    </h3>
  </div>


  
  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/cricket-400x284.jpg" alt="CRICKET"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/cricket/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>CRICKET
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/BADMINTON-400x284.jpg" alt="BADMINTON"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/badminton/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>BADMINTON
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/fitindia_gymnastic-400x284.jpg" class="img-fluid" alt="GYMNASTICS"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
      <a href="http://103.65.20.170/fitindia/project/gymnastics/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>GYMNASTICS</h3>
  </div>



  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/KICKBOXING-400x284.jpg" class="img-fluid" alt="KICKBOXING"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
      <a href=" http://103.65.20.170/fitindia/project/kickboxing/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>KICKBOXING</h3>
  </div>

  
  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/hokey-400x284.jpg" class="img-fluid" alt="HOCKEY"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
      <a href=" http://103.65.20.170/fitindia/project/hockey/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>HOCKEY</h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/weightlifting-400x284.jpg" alt="WEIGHTLIFTING"   class="img-fluid"    ></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
      <a href=" http://103.65.20.170/fitindia/project/weightlifting/       " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>WEIGHTLIFTING    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/TENNIS-1-400x284.jpg" alt="TENNIS"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/tennis/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>Tennis
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/HULA-HOOPING-400x284.jpg" class="img-fluid" alt="HULA HOOPING"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
      <a href=" http://103.65.20.170/fitindia/project/hula-hooping/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>HULA HOOPING</h3>
  </div>

  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/HOME-EXERCISE-1-400x284.jpg" class="img-fluid" alt="HOME EXERCISE"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
      <a href=" http://103.65.20.170/fitindia/project/home-exercise/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>HOME EXERCISE</h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"> <img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/DODGEBALL-400x284.jpg" alt="DODGEBALL" 
       class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/dodgeball/       " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>DODGEBALL    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img">
      <a href=" http://103.65.20.170/fitindia/project/boxing/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
        <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/boxing-400x284.jpg" class="img-fluid" alt="Boxing"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
    </div>
    </a>
    <h3>Boxing</h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img">
      <a href=" http://103.65.20.170/fitindia/project/aerobics/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
        <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/AEROBICS-400x284.jpg" class="img-fluid" alt="AEROBICS"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
    </div>
    </a>
    <h3>AEROBICS</h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img">
       <a href=" http://103.65.20.170/fitindia/project/wrestling/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
        <img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/wrestling-400x284.jpg" alt="WRESTLING" 
       class="img-fluid" ></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
    </div>
    </a>
    <h3>WRESTLING</h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img">
      <a href="  http://103.65.20.170/fitindia/project/rowing/ " data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
        <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/rowing-400x284.jpg" alt="ROWING"  
       class="img-fluid" ></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
    </div>
    </a>
    <h3>ROWING</h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img">
      <a href="  http://103.65.20.170/fitindia/project/football/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
      <img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/football-400x284.jpg" alt="FOOTBALL"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
    </div>
     </a>
    <h3>FOOTBALL
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img">
      <a href="http://103.65.20.170/fitindia/project/aerobics/" data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
        <img src="http://103.65.20.170/fitindia/wp-content/uploads/2019/08/zumba-400x284.jpg" class="img-fluid" alt="ZUMBA"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right" style="font-size:24px"></i>
    </div>
    </a>
    <h3>ZUMBA</h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img">
      <a href="  http://103.65.20.170/fitindia/project/running-jogging/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
      <img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Capture-400x284.png" alt="RUNNING & JOGGING"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
    </div>
    </a>
    <h3>RUNNING & JOGGING
    </h3>
  </div>


  
  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/SWIMMING-400x284.jpg" alt="SWIMMING"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/swimming/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>SWIMMING
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/cycling-1-400x284.jpg" alt="CYCLING"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/cycling/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>Cycling
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src="  http://103.65.20.170/fitindia/wp-content/uploads/2019/08/netball-400x284.jpg" alt="NETBALL"   
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/netball/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>NETBALL
    </h3>
  </div>


  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src="  http://103.65.20.170/fitindia/wp-content/uploads/2019/08/Trampoline-400x284.jpg" alt="TRAMPOLINING" 
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/trampolining/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>TRAMPOLINING
    </h3>
  </div>

  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-youth">
    <div class="portfolio-img"><img src=" http://103.65.20.170/fitindia/wp-content/uploads/2019/08/park-activities-400x284.png" alt="PARK WORKOUTS"  
      class="img-fluid"></div>
    <div class="portfolio-info">
      <i class="fas fa-angle-right' style='font-size:24px"></i>
      <a href="  http://103.65.20.170/fitindia/project/park-workouts/ 
      " data-gall="portfolioGallery" class="venobox preview-link" title="App 1"> </a>
    </div>
    <h3>PARK WORKOUTS</h3>
  </div>
      <!-- End Youth -->
  </div>
  <div class="row">
    <div class="col-12">
      <div class="see_area " >
        <a class="seemore shadow_O sys" href="javascript:void(0);" data-toggle="modal" data-target="#actforyou">Activities for You</a>
      </div>
      <br> 
      <br> 
    </div>
  </div>
      </div>
    </section><!-- End Portfolio Section -->


    
</div>
<div class="modal fade" id="actforyou" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog_cus" role="document">
    <div class="modal-content modal-content_cus " style="background-color:#02349a ;">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Filter Activities</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3>How long have you got?</h3>
        <form>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
            <label class="form-check-label" for="exampleRadios1">
              10 mins
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
            <label class="form-check-label" for="exampleRadios2">
              10-15 mins
            </label>
          </div>
          <div class="form-check disabled">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" >
            <label class="form-check-label" for="exampleRadios3">
              30 mins
            </label>
          </div>
          <div class="form-check disabled">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4" value="option3" >
            <label class="form-check-label" for="exampleRadios4">
              Above 30 mins
            </label>
          </div>
          <div class="form-check disabled">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios5" value="option3" >
            <label class="form-check-label" for="exampleRadios5">
              below 30 mins
            </label>
          </div>

          <div class="form-check disabled">
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios6" value="option3" >
            <label class="form-check-label" for="exampleRadios6">
              I have little more time around
            </label>
          </div>
          <br>
          <div class="form-group">
            <label for="exampleFormControlSelect1"><h3>Who do you want to exercise with</h3></label>
            <select class="form-control" id="exampleFormControlSelect1">
              <option>Group</option>
              <option>Just me</option>
              <option>The Kids</option>
              
            </select>
          </div>

          <div class="form-group">
            <label for="exampleFormControlSelect1"><h3>How do you want to feel afterwards?</h3></label>
            <select class="form-control" id="exampleFormControlSelect1">
              <option>Become Stronger</option>
              <option>Fun and Sporty</option>
              <option>Heart Pumping</option>
              <option>Heart Pumping, out of breath</option>
              <option>Refreshed and recharged</option>
              <option>Stronger Than Before</option>
            </select>
          </div>
        </form>
       
      </div>
      <div class="modal-footer" style="justify-content: flex-start;border-top: 0px solid #dee2e6;">       
          <a class="btn_org" href="javascript:void(0)" >Apply Filters</a>
      </div>
    </div>
  </div>
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ URL::asset('resources/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('resources/js/aos.js') }}"></script>

<script>
  var jq = $.noConflict();
   jq(window).on('load', function() {
    var portfolioIsotope = jq('.portfolio-container').isotope({
      itemSelector: '.portfolio-item'
    });

    jq('#portfolio-flters li').on('click', function() {
      jq("#portfolio-flters li").removeClass('filter-active');
      jq(this).addClass('filter-active');

      portfolioIsotope.isotope({
        filter: jq(this).data('filter')
      });
      aos_init();
    });
  });

  function aos_init() {
    AOS.init({
      duration: 1000,
      once: true
    });
  }

  jq(window).on('load', function() {
    aos_init();
  });
 
 </script>
