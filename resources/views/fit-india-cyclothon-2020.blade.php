@extends('layouts.app')
@section('title', 'Fit India Cyclothon 2020| Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
 <div class="banner_area1">
   <img src="resources/imgs/cyclothon-pedal.jpg" alt="about-fitindia" class="img-fluid expand_img"/>         
 <section id="{{ $active_section_id }}">
<div class="container">
   <div class="row">
   <a class="freedombtn1" href="register">Register as an Organiser</a>
    <a class="freedombtn2" href="register">Register As An Individual</a>
    <a class="freedombtn3" href="{{ url('wp-content/uploads/2021/01/How-to-Register-Cyclothon-Event.pdf') }}" target="_blank">How To Register</a>
   </div>
    <div class="row">
        <div class="col-sm-12">
        <h1 style="font-size: 24px; font-weight: 700; color: #4f7af1; font-style: italic">Fit India Cyclothon 2020</h1><br> 
    </div>
    </div>
 <div class="row">              
    <div class="col-sm-12 col-md-12">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                 <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Introduction
            </a>
          </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <p>Fit India Mission will be organising the <strong>Fit India Cyclothon</strong> from
                        December 2020.</p>
                    <P>Fit India Cyclothon can be organised by cycling groups, schools, colleges, organisations,
                        councils, panchayats, corporations, societies, RWA’s, NGO’s, special interest groups
                        across India. You can also start a Fit India Cyclothon group by involving your
                        organisation, community, family and friends.</P>
                </div>
            </div>
        </div>

        <!-- second -->
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                 <h4 class="panel-title">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Why organise/participate in a Cyclothon?
            </a>
          </h4>
    
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                   <p>Cycling is one of the best ways to remain fit and healthy. It is the new craze that
                        combines fitness with fun and allows us to maintain social distancing.</p>
                </div>
            </div>
        </div>

        <!-- Thrid -->
        <div class="panel panel-default ">
            <div class="panel-heading" role="tab" id="headingThree">
                 <h4 class="panel-title">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Who can organise/participate in the Fit India Cyclothon?
            </a>
          </h4>

          <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
                <ul class="a">
                    <li>Village, Town or City Council/ Panchayat/ Anganwadi / Block</li>
                    <li> Your Workplace</li>
                    <li> Society or RWA</li>
                    <li> Interest Groups</li>
                    <li> Corporate and Industry bodies</li>
                    <li> Schools/ Colleges and Universities</li>
                    <li>NGOs</li>
                    <li>Communities</li>
                    <li>Individuals</li>
                </ul>
              <p>Organisers must ensure that all “Fit India Cyclothon” events are listed on <a
                      href="www.fitindia.gov.in" style="color:#ff6600;">www.fitindia.gov.in</a> portal and
                  are non-commercial in nature. Further, Individual Participants should also ensure that
                  they register themselves as well.</p>
            </div>
           <!--  <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                  <table border="0" width="100%" class="table-grid">
                    <tbody>
                    <tr>
                        <th colspan="1">Day</th>
                        <th colspan="1">Activity</th>
                    </tr>
                    <tr>
                        <td><strong>01</td>
                        <td>
                            <ul style="list-style-type: upper-roman;padding-left:15px;">
                                <li> Virtual Assembly – Free hand exercises</li>
                                <li>Fun and Fitness- Aerobics, Dance forms, Rope Skipping, Hopscotch, Zig Zag and Shuttle Running etc. Fit India Active Break capsules could be used for demonstration purposes.</li>
                            </ul>
                            <p style="margin:0;">Link below:</p>
                            <p><a href="https://drive.google.com/drive/folders/1t14ZOGyh9biDsw8CxmxhogMwB0A8E2ll?usp=sharing" target="_blank" rel="noopener noreferrer">https://drive.google.com/drive/folders/1t14ZOGyh9biDsw8CxmxhogMwB0A8E2ll?usp=sharing</a></p>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>02</td>
                        <td>
                            <ul style="list-style-type: upper-roman;padding-left:15px;">
                                <li>Virtual Assembly – Common Yoga Protocols <a href="https://yoga.ayush.gov.in/yoga/common-yoga-protocol" target="_blank" rel="noopener noreferrer">https://yoga.ayush.gov.in/yoga/common-yoga-protocol</a></li>
                                <li>Mental Fitness Activities (Ex. Debates, Symposium, Lectures by Sports Psychologists)</li>
                                <li>Debates, Symposium, Lectures on “Re-strengthening of the mind post pandemic”– Mental Fitness Activities for Students, Staff and Parents</li>
                                <li>Open letter to Youth of the Nation on “Power of Fitness”</li>
                                <li>Open mic on topics such as “Exercise is a celebration of what your body can do, not a punishment for what you ate” etc.</li>
                              </ul>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>03</td>
                        <td>
                            <ul style="list-style-type: upper-roman;padding-left:15px;">
                                <li>Brain Games to improve concentration/problem solving capacity – e.g Chess, Rubik’s cube etc.</li>
                                <li>Poster making competition on theme “Hum Fit Toh India Fit” or “New India Fit India”</li>
                                <li>Preparing advertisements on “Hum Fit Toh India Fit”, “Emotional and physical well-being are interconnected” etc.</li>
                             </ul>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>04</td>
                        <td>
                            <ul style="list-style-type: upper-roman;padding-left:15px;">
                                <li>Debates, Symposium, Lectures etc about diet & nutrition during pandemic for Students / Staff & Parents</li>
                                <li>Essay/Poem Writing Competition on theme “Fitness beats pandemic”</li>
                                <li> Podcast/Movie making on suggested themes – “Get fit, don’t quit”; “Mental Health is not a destination but a journey” etc.</li>
                              </ul>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>05</td>
                        <td>
                          <ul style="list-style-type: upper-roman;padding-left:15px;">
                            <li>Online Quiz related to fitness/sports</li>
                            <li>Virtual challenges for students, staff/ teachers e.g.

                              <ul class="" style="list-style-type: bullet; padding-left:15px;margin-top:15px;position: relative;">
                                <li>Squats challenge</li>
                                <li>Step-up challenge</li>
    
                                <li>Spot jogging</li>
                                <li>Rope skipping</li>
                                <li>Ball dribbling etc</li>
                              </ul>
                            </li>   
                            <li>Session(s) by motivational speakers for students, parents and school staff</li>                      
                          </ul>
                              
                          
                        </td>
                    </tr>
                    <tr>
                        <td><strong>06</td>
                        <td>
                            <p>1 day dedicated to Family Fitness:</p>
                            <ul style="list-style-type: upper-roman;padding-left:15px;">
                              <li>Activities for fitness sessions at home involving students and parents – Fit India Active Day capsules could be used for demonstration purposes<br>
                                <a href="https://drive.google.com/drive/folders/18ophVtYf3qBOhpLQpX66y_ywCK_kgTsS?usp=sharing"><em>https://drive.google.com/drive/folders/18ophVtYf3qBOhpLQpX66y_ywCK_kgTsS?usp=sharing</em></a>
                              </li>
                              <li>Creatively using home-based equipment for sports & fitness. E.g.
                                <ul style="padding-left:15px;margin-top:15px;">
                                  <li>Hacky sack at home (juggling with feet & hand – warm up activity)</li>
                                  <li>Aluminium foil inside a sock – ball and any wooden piece – bat to play cricket</li>
      
                                  <li>Mosquito bat and TT ball to play badminton/tennis</li>
                                  <li>Fitness circuit – Draw a ladder on the floor with a chalk piece or crayon</li>
                                 
                                </ul>
                              </li>
                              </ul>
                        </td>
                    </tr>
                    </tbody>
                    </table>
                </div>
            </div> -->

        </div>


         <!-- forth -->
         <div class="panel panel-default ">
            <div class="panel-heading" role="tab" id="headingfour">
                <h4 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  Guidelines for Organisers</a>
                </h4>
                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                  <div class="panel-body">
                      <ul class="a">
                          <li>Fit India Cyclothon can be organised by any government or private organisation, schools, colleges, universities, individuals, groups, RWAs and communities to create awareness on fitness through cycling.</li>
                          <li>Guidelines in relation to COVID-19 issued by the Ministry of Home Affairs and relevant state bodies to be duly complied with.</li>
                          <li> To become an organiser, you must register online on <u>gov.in</u></li>
                          <li> As an organiser, you will be responsible for conceptualizing, executing and ensuring a smooth and successful Fit India Cyclothon event to maximize public participation.</li>
                          <li>You can invite other organisations as well for online participation registration.</li>
                          <li>You can get sponsorship and have partners to organise this event.</li>
                          <li>Fit India Mission office will provide standard FIT INDIA design templates for branding elements on the registration portal for organisers to download and use the same:</li>
                          <li>Organisers will get FIT INDIA Movement partner – certificate from Fit India.</li>
                          <li>Those interested in partnership can also write to Fit India Mission office on:<a href="mailto:partnership.fitindia@gmail.com" style="color:#ff6600;"> partnership.fitindia@gmail.com</a></li>
                      </ul>
                    
                  </div>
                

                  </div>
            </div>
        </div>

        <!-- five -->
        <div class="panel panel-default ">
            <div class="panel-heading" role="tab" id="headingfour">
                <h4 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                  Other Guidelines for organisers</a>
                </h4>
                <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                  <div class="panel-body">
                      <ul class="a">
                          <li>Identify route.</li>
                          <li>Inform communities around you about the Fit India Cyclothon.</li>
                          </li>
                      </ul>                    
                  </div>  
                  </div>
            </div>
        </div>


        <!-- six -->
        <div class="panel panel-default ">
            <div class="panel-heading" role="tab" id="headingfour">
                <h4 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                  Guidelines for Individual Participants    </a>
                </h4>
                <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                  <div class="panel-body">
                      <ul class="a">
                          <li>Any individual can participate in Fit India Cyclothon to create awareness on fitness through cycling.</li>
                          <li>Guidelines in relation to COVID-19 issued by the Ministry of Home Affairs, India and relevant state bodies to be duly complied with.</li>
                          <li>To participate, an individual should register online on gov.in.</li>
                          <li>As an individual, you will be responsible for conceptualizing, executing and ensuring a smooth and successful Fit India Cyclothon event.</li>
                          <li>You can invite other individuals as well for online participation registration.</li>
                          <li>Any fitness enthusiast who is participating should strive to motivate at least one partner to participate.</li>
                          <li>Registered Individuals will get participation certificate after updating their details on the Fit India portal.</li>
                          <li>For any queries, contact on <a href="mailto: contact.fitindia@gmail.com" style="color:#ff6600;">contact.fitindia@gmail.com</a></li>
                        
                      </ul>                    
                  </div>  
                  </div>
            </div>
        </div>

        <!-- seven -->
        <div class="panel panel-default ">
            <div class="panel-heading" role="tab" id="headingseven">
                <h4 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                  Other guidelines for individuals</a>
                </h4>
                <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                  <div class="panel-body">
                      <ul class="a">
                          <li>Identify route.</li>
                          <li>Inform communities around you about the Fit India Cyclothon.</li>
                      </ul>                    
                  </div>  
                  </div>
            </div>
        </div>

        <!-- eight -->
        <div class="panel panel-default lastpanel">
            <div class="panel-heading" role="tab" id="headingeight">
                <h4 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                  How to use the Fit India Cyclothon templates Fit India Logo </a>
                </h4>
                <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                  <div class="panel-body">
                      <ul class="a">
                          <li>Download the Fit India Logo after you register as an organisation or an individual</li>
                          <li>Do not edit the Fit India Logo (colour or dimension)</li>
                          <li>To be used only for events in promotion of Fit India Movement</li>
                      </ul>                    
                  </div>  
                  </div>
            </div>
        </div>
    </div>
    </div>
</div>
</div>
</section>
@endsection