@extends('layouts.app')
@section('title', 'Fit India Get Active | Fit India')
@section('content')

 <section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">   
      <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200" id="cat_data" style="position: relative; height: 500px !import">
      <!-- ----------------------Children------------------------ -->
          <div class="col-sm-12 col-lg-12 col-md-12 portfolio-item filter-children">
            <div class="portfolio-img">
              <h3>{{ $post->title }}</h3>
              <a href="{{ route('getactivedetail', $post->id) }}">
                <img src="{{ $post->image }}" class="img-fluid"  width="800" height="7000"></a>
            </div>
              <div class="portfolio-info">
                <i class='fas fa-angle-right' style='font-size:24px'></i>          
              </div>
              <p>{{$post->description}}</p>
          </div>
      </div>
    </div>
  </section>

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