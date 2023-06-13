@extends('layouts.app')
@section('title', 'Fit India Youth Club Registration | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<div>
    <img src="{{ asset('resources/imgs/youthclub_b.jpeg') }}" alt="youthclub" class="img-fluid expand_img"/>
</div>      
 <section id="{{ $active_section_id }}">
<div class="container">
    <div class="row">
        <div class="col-sm-12">
        <h1 class="et_pb_text_0">FIT INDIA YOUTH CLUB REGISTRATION</h1>  
    </div>
    </div>
 <div class="row">              
    <div class="col-md-8">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                 <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Background
            </a>
          </h4>
    
            </div>
            <div id="collapseOne" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                   <p>Hon’ble Prime Minister of India has launched the Fit India Movement on 29 Aug 2019 with a view to make Physical Fitness a way of life. Fit India Movement aims at behavioural changes – from sedentary lifestyle to physically active way of day-to-day living. Fit India would be a success only when it becomes a people’s movement. We have to play the role of a catalyst.</p>
                   <p>In the above background, the Fit India Mission has prepared a system of <strong>FIT INDIA YOUTH CLUB</strong> with simple and easy parameters as below:</p>
                   
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                 <h4 class="panel-title">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Fit India Youth Club
            </a>
          </h4>
    
            </div>
            <div id="collapseTwo" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <p>The following parameters would apply: </p>
                    <ol style=" padding-left: 15px;">
                      <li>Youth Club should be affiliated with the concerned District Unit.</li><br>
                      <li>Each member of the Youth club should be aware about the importance of physical fitness and spend 30-60 minutes daily for at least 5 days every week for group physical activities.</li><br>
                      <li>Each member of the Youth Club should commit to motivate one additional person every month for incorporating physical activity of 30-60 mins in his/her daily routine.</li><br>
                      <li>The Youth club should organise or persuade the local body and school for organising one community fitness event every quarter.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="col-md-4">
      <div class="row">
        <div class="org-event">
        <input type="checkbox" id="agreed" name="agreed" value="yes" onclick="enablecls()">
        <span class="wpcf7-list-item-label">I have read and understood the concept of Fit India Youth Club Certification guidelines. I agree to follow the guidelines of Fit India Youth Club Certification</span>
        <input type="button" id="organise-event-btn" class="organise-event-btn disable" onclick="chkorganise()" value="Apply for Fit India Youth Club Certification">
      </div>
      <script type="text/javascript">
        function enablecls(){
          var agree = document.getElementById('agreed');
            if (agree.checked == false){
              jQuery('#organise-event-btn').addClass('disable');
                        return false;
                    }else{
             jQuery('#organise-event-btn').removeClass('disable');
            }
        }
    
        function chkorganise(){
          var agree = document.getElementById('agreed');
            if (agree.checked == false){
                       alert("Please Check Terms & Conditions");
              return false;
                    }else{
            window.location="{{ route('youthcert') }}"; 
            }
        }

        function form_organise() {
        var agree = document.getElementById('agreed');
        if (agree.checked == false){
                     alert("Please Check Terms & Conditions");
                     return false;
                }else{
             window.location.href = 'https://fitindia.gov.in/login?rurl=fit-india-youth-club-certification';
        }
        }
      </script>
    </div>
    <!-- <div class="row">
      <div class="et_pb_button_btn_area">
      <a class="et_pb_button_btn" href="Fit-India-Movement-2019.pdf" target="_blank" data-icon="5">Fit India School Certification Circular</a>
    </div>
    </div> -->
    </div>
    </div>
    </div>
</section>
@endsection