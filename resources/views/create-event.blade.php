@extends('layouts.app')
@section('title', 'Fit India Freedom Run| Fit India')
@section('content')
 <div class="banner_area">
  <img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />
   <div class="banner_area_txt"> 
        <h4>Registered as : Others</h4>
        <h5> Welcome Priyanshi Singh</h5> 
    </div>
        <div class="container">
            <div class="et_pb_row">
            <div class="row ">
                <div class="col-sm-12 col-md-3 ">
                    <div class="events-sidebar">									
                        <a href="create-event" class="create_events active"><span class="dashicons dashicons-edit"></span>Organise an Event</a>
                        <a href="my-events" class="my-events "><span class="dashicons dashicons-list-view"></span>My Events</a>
                    
                   </div>
                </div>
                <div class="col-sm-12 col-md-9 ">
                  <div class="wrap event-form">	
                    <!-- onsubmit="return create_event_validation()" -->
                    <form name="createeventform" method="post" action="" enctype="multipart/form-data"> 
                    
                        <div class="um-field">
                            <h2 for="event_name">Organise an Event</h2>
                        </div>
                        
                      <!-- // Fixed Event start date	
                        <input type="hidden" name="eventstartdate" id="eventstartdate" value="2019-10-02" />
                        -->
                                 
                
                        <div class="um-field">
                            <div class="um-field-label">
                              <label for="event_name">Event Category*</label>
                              <div class="um-clear"></div>
                            </div>
                            <div class="um-field-area">
                              <select name="category" id="category">
                              <!--	<option value="">Select Category</option> -->
                                </select>	
                            </div>
                        </div>
                
                        
                         <div class="um-field">
                            <div class="um-field-label">
                              <label for="event_name">Upload a poster image for Event*</label>
                              <div class="um-clear"></div>
                            </div>
                            <div class="um-field-area">
                              <input type="file" id="image" name="eventimage">
                            </div>
                        </div> 
                        
                        <div class="um-field">
                                    </div>
                        <div class="um-field">
                          <div class="um-field-label">
                            <label for="eventstartdate">Event Date*</label>
                            <div class="um-clear"></div>
                          </div>
                          <div class="um-field-area">
                            <div class="event-row-lt">
                              <span id="eventdatelbl">From Date</span>
                              <input type="date" name="eventstartdate" class="eventdate" id="eventstartdate" value="">  
                            </div>
                            <div class="event-row-lt" id="eventenddatediv">
                              To Date
                              <input type="date" name="eventenddate" class="eventdate" id="eventenddate" value=""> 
                            </div>
                            <div class="clear clearfix"></div>
                          </div>
                        </div>
                    
                        <div class="um-field">
                            <div class="um-field-label">
                              <label for="event_name">Event Name*</label>
                              <div class="um-clear"></div>
                            </div>
                            <div class="um-field-area">
                              <input id="event_name" type="text" name="event_name" value="">
                            </div>
                        </div>
                        
                        
                        <div class="um-field">
                            <div class="um-field-label">
                              <label for="organiser_name">Organisation's Name*</label>
                              <div class="um-clear"></div>
                            </div>
                            <div class="um-field-area">
                              <input id="organiser_name" type="text" name="organiser_name" value="">
                            </div>
                        </div>
                        
                        <div class="um-field">
                            <div class="um-field-label">
                              <label for="event_name">No of Participants</label>
                              <div class="um-clear"></div>
                            </div>
                            <div class="um-field-area">
                              <input id="participantnum" type="text" name="participantnum" value="">
                            </div>
                        </div>
                        
                                
                        
                        
                        
                        <div class="um-field">
                            <div class="um-field-label">
                              <label for="kmrun">Cumulative KM Run/Covered (All Participants)</label>
                              <div class="um-clear"></div>
                            </div>
                            <div class="um-field-area">
                              <input id="kmrun" type="text" name="kmrun" value="">
                            </div>
                        </div>
                        
                        
                                
                        <div class="um-field undertaking">
                            <div class="um-field-label">
                              <label for="undertaking">Undertaking*</label>
                              <div class="um-clear"></div>
                            </div>
                            <div class="um-field-area undertakingtxt">
                              <input type="checkbox" name="undertaking" value="yes">
                               I undertake to submit complete details of the number of participants and the cumulative KM Run/Covered after the event, I also undertake to follow the guidelines of fit india logo if downloaded for the event.
                            
                            </div>
                        </div>
                        
                        
                        
                        <input type="hidden" name="nonce" value="185d8a7012">
                        
                        <div class="um-field" style="width:50%">
                          <div class="um-field-label">
                              <div class="um-field" id="capcha-page-cont">
                        <label for="captcha">Please Enter the Captcha Text</label><br>
                    <div style="float:left; width:auto; margin: 6px 0;" id="pagecaptcha-cont">
                             <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEoAAAAeAQMAAACxARrTAAAABlBMVEX/uTIAAAAGVkhMAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAAVklEQVQYlWNgoBVg/vvHhoexAcxObEiTY4YxDxuzg5iMDxJ3MCf2gpjMBoln2BJngphsEglsPIkbYUyJ+v0HwMzENoPERojahDMJECbjg4SK/xDmIAAABPkb5TSumVoAAAAASUVORK5CYII=" width="100"> <input type="hidden" id="imppagecaptcha" name="imppagecaptcha" value="oT52A4">		</div>
                    <div style="float:left; margin: 6px 20px 6px 10px; cursor: pointer;" onclick="refreshcaptcha('pagecaptcha-cont');"><img src="https://fitindia.gov.in/wp-content/plugins/impsecurity/img/new-recaptcha.png" style="width:26px; height:26px;"></div>
                    
                    <div style="float:right; width:40%">
                      <input type="text" id="pagecaptcha" name="pagecaptcha" class="required">
                    </div>
                    <div style="clear:both;"></div>
                  </div>
                          </div>
                        </div>
                        
                        <div class="um-field">
                            <div class="um-field-area">
                              <input type="submit" name="create-event" value="Submit">
                            </div>
                        </div>                        
                        
                        <div class="um-field">
                          <div class="um-field-area bt_area">
                          <a class="evt_btn" style="font-size: inherit !important; border-radius: 100px; " href="https://fitindia.gov.in/wp-content/uploads/2019/09/Fit-India_logo.zip" data-icon="G">Download Logo</a>
                          &nbsp;
                          <a class="evt_btn" style="font-size: inherit !important; border-radius: 100px; " href="https://fitindia.gov.in/wp-content/uploads/2019/10/FITIndia_Logo_Guidelines.pdf" target="_blank" data-icon="G"> Guidelines </a>
                          
                          </div>
                        </div>                 
                    </form>
                  </div>
                </div>
            </div>
    
        </div> 
        <div class="mr-b-100"></div>
    </div>
</div>
@endsection