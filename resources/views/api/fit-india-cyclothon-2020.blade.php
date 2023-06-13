@extends('api.layouts.app')

 <div class="banner_area1">
   <img src="{{ URL::asset('resources/imgs/cyclothon2.jpg') }}" alt="about-fitindia" class="img-fluid expand_img"/>         
 <section>
<div class="container">
   <div class="row">
    <a class="freedombtn1" href="create-event">Register as an Organiser</a>
   </div>
    <div class="row">
        <div class="col-sm-12">
        <h1 style="font-size: 24px; font-weight: 700; color: #4f7af1; font-style: italic">Fit India Cyclothon 2020</h1>  
    </div>
    </div>
 <div class="row">              
    <div class="col-md-9">
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
        <div class="panel panel-default lastpanel">
            <div class="panel-heading" role="tab" id="headingThree">
                 <h4 class="panel-title">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Who can organise/participate in the Fit India Cyclothon?
            </a>
          </h4>
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
    </div>
    </div>
    </div>
    </div>
   
   
</div>
</div>
</section>