@extends('layouts.app')
@section('title', 'Contact Us | Fit India')
@section('pageid','contact')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<section id="{{ $active_section_id }}">
        <div class="container">
            <div class="row et_pb_row_2">
                <div class="col-sm-12 col-md-5 " style="background:#e6f2fb;position: relative;">
                    <div class="cont_area">
                        <h3>Contact Us</h3>
                        <div >
                            <ul >
                                <li><span><i class="fa fa-phone" aria-hidden="true"></i></span> Phone No: <span> 1800-208-5155</span></li>
                                <li><span><i class="fa fa-envelope-o" aria-hidden="true"></i></span> Email ID: <span> <a href="contact.fitindia@gmail.com">contact.fitindia@gmail.com</a></span></li>
                            </ul>
                        </div>
                    </div>
                    <p class="social-icons">
                        <a class="fb-i" href="https://www.facebook.com/FitIndiaOff/" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a class="twt-i" href="https://twitter.com/FitIndiaOff" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a class="yt-i" href="https://www.youtube.com/channel/UCQtxCmXhApXDBfV59_JNagA" target="_blank" rel="noopener noreferrer"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        <a class="insta-i" href="https://www.instagram.com/fitindiaoff/ " target="_blank" rel="noopener noreferrer"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </p>
                </div>
                <div class="col-sm-12 col-md-2 " ></div>
                <div class="col-sm-12 col-md-5 " style="background:#f9e4ec;position: relative;">
                    <div class="cont_area">
                        <h3>For Partnership</h3>
                        <div >
                            <ul>
                                <li><span><i class="fa fa-envelope-o" aria-hidden="true"></i></span> Email ID: <span> <a href="contact.fitindia@gmail.com">contact.fitindia@gmail.com</a></span></li>
                                <li class="btn_cont"> <a href="become-a-partner">Click here</a><span style="padding-left:10px;"> to submit the details</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
              </div>  
              <br> <br>
              <div class="row et_pb_row_2">
                <iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56077.617141573246!2d77.22926076849038!3d28.544195815511394!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce2f931835ac1%3A0xe53de68507f26b47!2sSPORTS%20AUTHORITY%20OF%20INDIA!5e0!3m2!1sen!2sin!4v1566654916999!5m2!1sen!2sin" width="100%" height="450" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
              </div>                
              
            </div>
    </section>
@endsection

