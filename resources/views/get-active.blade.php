@extends('layouts.app')
@section('title', 'Fit India Get Active | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<head>
  <title>Fit India getactive</title>
  <link href="resources/css/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="resources/css/getactive.css">
</head>

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
            <div class="see_area " style="margin-top:0;" id="{{ $active_section_id }}">
              <a class="seemore shadow_O sys" href="javascript:void(0);" data-toggle="modal" data-target="#actforyou">Activities for You</a>
            </div>
            <br> 
            <br> 
          </div>
        </div>
        <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
          <li data-filter="*" class="filter-active" data-id="0" style="border-right: 0px;">All</li>
          @foreach($post_category as $cat)
            <li data-filter=".filter-{{ strtolower($cat->name)}}" data-id="{{ $cat->id }}" style="position: relative; height: 500px !import">{{ $cat->name }}</li>
          @endforeach

          <!-- <li data-filter=".filter-child" style="border-right: 0px;">Children</li>
          <li data-filter=".filter-families" style="border-right: 0px;">Families</li>       
          <li data-filter=".filter-sen" style="border-right: 0px;">Seniors</li>
          <li data-filter=".filter-youth">Youth</li> -->
        </ul>
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200" id="cat_data" style="position: relative; height: 500px !import">
        <!-- ----------------------Children------------------------ -->
          @foreach($post as $pt)
            <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-children">
            <div class="portfolio-img">
              <a href="{{ route('getactivedetail', $pt->id) }}" data-gall="portfolioGallery" class="venobox preview-link" title="App 1">
                <img src="{{ $pt->image }}" class="img-fluid" alt="Goli Gundu">
            </div>
            <div class="portfolio-info">
              <i class='fas fa-angle-right' style='font-size:24px'></i>              
            </div>
            </a>
            <h3>{{ $pt->title }}</h3>
          </div>
          @endforeach    
        </div>
      </div>
    </section><!-- End Portfolio Section -->
</div>
<div class="modal fade" id="actforyou" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog_cus" role="document">
    <div class="modal-content modal-content_cus ">
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

<script src="resources/js/isotope.pkgd.min.js"></script>
<script src="resources/js/aos.js"></script>

<script>
   $(window).on('load', function() {
    var portfolioIsotope = $('.portfolio-container').isotope({
      itemSelector: '.portfolio-item'
    });

    $('#portfolio-flters li').on('click', function() {
      $("#portfolio-flters li").removeClass('filter-active');
      $(this).addClass('filter-active');
      //alert($(this).attr("data-id"));
      cat_id = $(this).attr("data-id")
      $.ajax({
        url: "{{ route('getcatposts') }}",
        type: "get",
        data: {category_id:cat_id} ,
        success: function (response) {
          console.log(response);
          if(response==''){
            $('#cat_data').html('');
          }
          $('#cat_data').html(response);
        }        
      });
      portfolioIsotope.isotope({
        filter: $(this).data('filter')
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

  $(window).on('load', function() {
    aos_init();
  });
 
 </script>

@endsection