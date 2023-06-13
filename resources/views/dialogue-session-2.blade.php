@extends('layouts.app')
@section('title', 'Fit India Dialogue | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
    <div class="banner_area1">
        <img src="{{ asset('resources/imgs/dialogue-Session-2.jpg') }}" alt="about-fitindia" class="img-fluid expand_img"/> 
            <section id="{{ $active_section_id }}">
                <div class="container">
                    <div class="row et_pb_row_2">
                        <div class="col-sm-12 ">
                         <h2>Dialogue Session 2</h2>
                          <p>To raise awareness on fitness and to spread Hon’ble PM’s clarion call of <strong>‘Fitness ki dose, Aadha ghanta roz’</strong>, the 2nd edition of Fit India Dialogue was held on 27th December 2020 in association with Zee News. It was the first time ever when a Union Sports Minister became an anchor of a show. Hon’ble MoS (I/C), MYAS, <strong>Sh. Kiren Rijiju</strong> had a very interesting discussion on fitness with the leading fitness icons of the country. The panel consisted of Flying Sikh, <strong>Sh. Milkha</strong> Singh, Bollywood superstar <strong>Sh. Anil Kapoor</strong>, Dronacharya Awardee S<strong>h. Pullela Gopichand</strong>, Captain of Indian Women’s Cricket team, <strong>Ms. Mithali Raj</strong> and Ex-captain of Indian Football team, <strong>Sh. Bhaichung Bhutia</strong>. The panellists shared their mantra of remaining fit and they also did various fun fitness activities. Sh. Kiren Rijiju went shoulder to shoulder with them and did activities with the panellists. Do watch this edition of Fit India Dialogue.</p>
                        </div>
                    </div>
                    <div class="row et_pb_row_2 et_pb_row_3 justify-content-center">
                        <a href="https://www.youtube.com/watch?v=SG5ckflr7ns" target="_blank"><span class="et_pb_image_wrap ">
                            <img src="https://fitindia.gov.in/wp-content/uploads/2021/01/s2-video-thumbs.jpg" alt="dialogue Session 2 video" srcset="https://fitindia.gov.in/wp-content/uploads/2021/01/s2-video-thumbs.jpg 800w, https://fitindia.gov.in/wp-content/uploads/2021/01/s2-video-thumbs-480x252.jpg 480w" sizes="((min-width: 0px) and (max-width: 480px)) 480px, (min-width: 481px) 800px, 100vw"></span></a>
                    </div>
                </div>
            </section>
        </div>
@endsection
