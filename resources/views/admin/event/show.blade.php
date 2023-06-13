@extends('admin.layouts.app')
@section('title', 'Event Details - Fit India')
@section('content')
<style type="text/css">
  /* ------------------DashboardEvent--------------------- */

.e_head{padding:10px;background:#007bff ;border-top-left-radius: 7px;border-top-right-radius: 7px;;}

.e_head h2{font-size:18px;color:#fff;margin:0;font-weight: 400;;}

.e_head h2 span{padding:0 15px;}

.e_des{padding-top:15px;}

.e_img {margin:0 auto;text-align:center;margin-top:30px;}

.e_des ul{padding:0;margin:0;list-style: none;}

.e_des ul li{padding:5px 15px;
/*  border:1px solid #e1e1e1;width:48%;*/
  border-radius: 5px;;margin:5px 0;}

.e_sty_area{display:flex;justify-content: space-around;}

.e_sty{    width: 48%;

  margin: 5px 0;

  padding: 10px;

  border-left: 4px solid #FF9933;}

.ev_parent{

  border: 1px solid #e1e1e1;

  border-radius: 8px;

  padding-bottom: 20px;
}

.e_img img{

  object-fit: cover; 

  width: 150px;

  height: 120px;

  border: 1px solid #e2e2e2;

  padding: 5px;

  border-radius: 5px;

}

.e_des {padding-left:15px;padding-right: 15px;;}

.e_des p{text-align: center;}

.shadow_ev{

  box-shadow: 0 1px 8px rgb(0 0 0 / 10%);

  /* border: 1px solid #f5f5f5; */

}

.e_sty p{margin:0;text-align: left;}

.li_Flex{
  display: flex;
justify-content: flex-start;

}
.li_Flex div:first-child{width:40%;}
.li_Flex div:last-child{width:60%;}

.show_flex_area{ display: flex;
justify-content: space-around;}

.mb-3{
  margin-bottom: 0 !important;
  margin-right: 10px;
}
.btn-sm{
  padding: .375rem .75rem;
}
.rtside{
  float:right;
}
.ques{ background: #c5d6e9;
    padding: 10px;
}
.sub_ques_title{ float:left; margin-right:15px; }
</style>
<div class="content-wrapper">
  <section>
    <div class="container-fluid">
		<div class="row mb-2">
          <div class="col-sm-12">
		    <a class="" href="{{ route('admin.events.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
          	 
          </div>
		</div> 
		
		
      <div class="container">
       <div class="row align-items-center">
          <div class=" col-sm-12 col-lg-12">
              <div class="e_head">
                  <h2>Event Details<span></span></h2>
              </div>
			  
              <div class="row">
                <div class="col-sm-7">
                  <div class="e_des ">
                    <ul>
					
					 @if(!empty($events->eventimage1))
                       <li class="li_Flex">
                          <div><strong>Event Image 1:</strong></div>
                          <div><img src="{{$events->eventimage1}}" width="70px"
                       alt="Event  picture"></div>
                       </li>
					  @endif 
					  
					   @if(!empty($events->eventimage2))

						   <li class="li_Flex">
							  <div><strong>Event Image 2:</strong></div>
							  <div><img src="{{ $events->eventimage2}} " width="70px"
						   alt="Event  picture"></div>
						   </li>
					   
					   @endif
					   
					   

                       <li class="li_Flex">
                          <div><strong>Event Name:</strong></div>
                          <div>@if(!empty($events->eventname)) {{ $events->eventname }} @endif</div>
                       </li>
						
					
                      
                        <li class="li_Flex">
                          <div><strong>Event Category:</strong></div>
                          <div>@if(!empty($events->catname)) {{$events->catname}} @endif</div>
                       </li>
                       

                         
                         
                           <li class="li_Flex">
                            <div><strong>User Email:</strong></div>
                            <div>{{$events->email}}</div>
                          </li>
                         


                           
                            <li class="li_Flex">
                            <div><strong>User Mobile:</strong></div>
                            <div>{{$events->mobile}}</div>
                           </li>
                            

                        <li class="li_Flex">
                          <div><strong>Kilometer Run:</strong></div>
                          <div> {{$events->kmrun}}</div>
                       </li>

                        <li class="li_Flex">
                          <div><strong>Event Start Date:</strong></div>
                          <div> {{$events->eventstartdate}} </div>
                       </li>
                        <li class="li_Flex">
                          <div><strong>Event End Date:</strong></div>
                          <div> {{$events->eventenddate}} </div>
                       </li>
                        <li class="li_Flex">
                          <div><strong>No of Participant:</strong></div>
                          <div> {{$events->participantnum}} </div>
                       </li>
                        <li class="li_Flex">
                          <div><strong>Event Organiser Name:</strong></div>
                          <div> {{$events->organiser_name}} </div>
                       </li>
					   
					   @if(!empty($events->participant_names))
					   <li class="li_Flex">
                          <div><strong>Participant Names:</strong></div>
                          <div> @foreach(unserialize($events->participant_names) as $name)
						  {{ trim(ucfirst(str_replace("PHP_EOL","<br>",$name)))}}<br>
						  
						  @endforeach </div>
                       </li>
					   @endif
					  
                    </ul>
                   </div>
             </div>
            </div>
       </div>
      </div>
      </div>
    </div>
  </section>
</div>
@endsection