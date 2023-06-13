@extends('api.layouts.app')

 <div class="banner_area">
   <img src="{{ URL::asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img"/>
   <div class="banner_area_txt"> 
        <h4>Registered as : Others</h4>
        <h5> Welcome Priyanshi Singh</h5> 
    </div>


        <div class="container">
            <div class="et_pb_row">
            <div class="row ">
                <div class="col-sm-12 col-md-3 ">
                    <div class="events-sidebar">									
                        <a href="create-event" class="create_events"><span class="dashicons dashicons-edit"></span>Organise an Event</a>
                        <a href="my-events" class="my-events  "><span class="dashicons dashicons-list-view"></span>My Events</a>
                    
                   </div>
                </div>
                <div class="col-sm-12 col-md-9 ">
                    <div class="event-form my-event">                    
                        <div class="all-events">
                            <div class="no-events">You aren't registered as school, you cannot apply for School Certification</div>
                         </div>
                </div>
            </div>
          
        </div> 
        <div class="mr-b-100"></div>
    </div>
</div>
