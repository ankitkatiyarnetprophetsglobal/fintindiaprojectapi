@extends('api.layouts.app')

 <div class="banner_area1">
   <img src="{{ URL::asset('resources/imgs/school-week.jpg') }}" alt="about-fitindia" class="img-fluid expand_img"/> 
     
            
 <section>
<div class="container">
   <div class="row">
    <a class="freedombtn1" href="create-event">Register as an Organiser</a>
   </div>
    <div class="row">
        <div class="col-sm-12">
        <h1 style="font-size: 24px; font-weight: 700; color: #4f7af1; font-style: italic">Fit India School Week 2020</h1>  
    </div>
    </div>
 <div class="row">              
    <div class="col-md-9">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                 <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Background
            </a>
          </h4>
    
            </div>
            <div id="collapseOne" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                   <p>On 29 Aug 2019, the Hon’ble Prime Minister launched nation-wide “Fit India Movement” aimed to encourage people to inculcate physical activity and sports in their everyday lives and daily routine.</p>
                   <p>School is the first place where habits are formed. School children should be encouraged to indulge in active field time during school hours involving fitness and sports activities. This will instil in students the understanding for regular physical activity and higher levels of fitness, thus enhancing self-esteem and confidence in them. Keeping these objectives in mind, Fit India School Week program was launched in 2019.</p>
                   <p>This year “Fit India School Week” will be celebrated virtually by schools in December.</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                 <h4 class="panel-title">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Guidelines
            </a>
          </h4>
    
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <ol>
                      <li>Schools to ensure that all Students, Parents, Staff and Management shall actively participate in the Fit India School Week 2020 programme</li>
                      <li>Schools may create a new page on their website titled “Fit India School Week 2020” and a brief about the activities undertaken and related pictures/videos can be uploaded on it.</li>
                      <li>Schools should register themselves on https://fitindia.gov.in/fit-india-school-weekand upload photos and video link related to the event</li>
                      <li>All registered schools may download a Digital Certificate (<strong>INSERT LINK</strong>) which can be downloaded from Fit India Portal after successful conduct of the Fit India School Week.</li>
                      <li>Schools are also encouraged to share/post activities conducted on their social media channels with <strong>#NewIndiaFitIndia</strong> and tag <strong>@FitIndiaOff</strong></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="panel panel-default lastpanel">
            <div class="panel-heading" role="tab" id="headingThree">
                 <h4 class="panel-title">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Activities
            </a>
          </h4>
          <h4 style="margin-bottom:15px;">Virtual Activities for Fit India School Week Celebrations 2020</h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
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
            </div>
        </div>
        
    </div>
    </div>
    </div>
    </div>
</div>
</div>
</section>