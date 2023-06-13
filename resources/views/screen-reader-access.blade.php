@extends('layouts.app')
@section('title', 'screen-reader-access')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<section id="{{ $active_section_id }}">
<div class="container">
<h1 class="heading">Screen Reader Access</h1>
<div class="bread_area">
    <p>Home/Screen Reader Access</p>
    <div >
        <div class="s-social">
        <a href=""><img src="{{asset('resources/imgs/screenreader/facebook.png') }}"></a>
        <a href=""><img src="{{asset('resources/imgs/screenreader/twitter.png') }}"></a>
        <a href=""><img src="{{asset('resources/imgs/screenreader/linkedin.png') }}"></a>
        <a href=""><img src="{{asset('resources/imgs/screenreader/google-plus.png') }}"></a>
        <a href=""><img src="{{asset('resources/imgs/screenreader/whatsapp.png') }}"></a>
        </div>
        <img class="share"  src="{{asset('resources/imgs/screenreader/share-img.png') }} ">
    </div>
   
</div>
<h3>Following table lists the information about different screen readers:</h3>
<p>Information related to the various screen readers</p>



<table class="responsive table table-bordered screen-reader">
    <tbody>
    <tr>
        <th>Screen Reader</th>
        <th>Website</th>
        <th>Free / Commercial</th>  
    </tr>
    <tr>
        <td>Screen Access For All (SAFA)</td>
        <td><a title="External website that opens in a new window" role="link" href="javascript:chkpopup('https://safa-reader.software.informer.com/download/')" rel="noopener noreferrer">http://www.nabdelhi.org/NAB_SAFA.htm</a></td>
        <td>Free</td>
    </tr>
    <tr>
        <td>Non Visual Desktop Access (NVDA)</td>
        <td><a title="External website that opens in a new window" role="link" href="javascript:chkpopup('http://www.nvda-project.org/')" rel="noopener noreferrer">http://www.nvda-project.org/</a></td>
        <td>Free</td>
    </tr>
    <tr>
        <td>System Access To Go</td>
        <td><a title="External website that opens in a new window" role="link" href="javascript:chkpopup('http://www.satogo.com/')" rel="noopener noreferrer">http://www.satogo.com/</a></td>
        <td>Free</td>
    </tr>
    <tr>
        <td>Thunder</td>
        <td><a title="External website that opens in a new window" role="link" href="javascript:chkpopup('http://www.screenreader.net/index.php?pageid=2/')" rel="noopener noreferrer">http://www.screenreader.net/index.php?pageid=2</a></td>
        <td>Free</td>
    </tr>
    <tr>
        <td>WebAnywhere</td>
        <td><a title="External website that opens in a new window" role="link" href="javascript:chkpopup('http://webanywhere.cs.washington.edu/wa.php/')" rel="noopener noreferrer">http://webanywhere.cs.washington.edu/wa.php</a></td>
        <td>Free</td>
    </tr>
    <tr>
        <td>Hal</td>
        <td><a title="External website that opens in a new window" role="link" href="javascript:chkpopup('https://yourdolphin.com/en-gb/products/individuals/screen-reader/')" rel="noopener noreferrer">https://yourdolphin.com/en-gb/products/individuals/screen-reader/</a></td>
        <td>Commercial</td>
    </tr>
    <tr>
        <td>JAWS</td>
        <td><a title="External website that opens in a new window" role="link" href="javascript:chkpopup('https://www.freedomscientific.com/products/software/jaws/')" rel="noopener noreferrer">https://www.freedomscientific.com/products/software/jaws/</a></td>
        <td>Commercial</td>
    </tr>
    <tr>
        <td>Supernova</td>
        <td><a title="External website that opens in a new window" role="link" href="javascript:chkpopup('https://yourdolphin.com/en-gb/products/individuals/screen-reader/')" target="_blank" rel="noopener noreferrer">https://yourdolphin.com/en-gb/products/individuals/screen-reader/</a></td>
        <td>Commercial</td>
    </tr>
    <tr>
        <td>Window-Eyes</td>
        <td><a title="External website that opens in a new window" role="link" href="javascript:chkpopup('http://www.gwmicro.com/Window-Eyes/')" rel="noopener noreferrer">http://www.gwmicro.com/Window-Eyes/</a></td>
        <td>Commercial</td>
    </tr>
</tbody>
</table>

</div>
</section>

<script>

$(document).ready(function(){
    $(".s-social").hide();
    $(".share").click(function(){
  $(".s-social").toggle();
});

})

   

</script>
               
@endsection
