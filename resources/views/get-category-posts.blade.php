
@foreach($post as $pt)
  <div class="col-sm-12 col-lg-3 col-md-4 portfolio-item filter-{{ strtolower($cat_name)}}">
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