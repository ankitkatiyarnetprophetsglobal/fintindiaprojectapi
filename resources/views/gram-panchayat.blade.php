@extends('layouts.app')
@section('title', 'Fit India Gram Panchayat Ambassador')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp

<style>
  .gm_table{
    border: 1px solid rgba(33,150,243,0.5)!important; }

    #tab-12977 {
    border: 2px solid rgba(33,150,243,0.4);
    background-color: rgba(33,150,243,0.04);
    padding: 20px 30px 30px 30px;
    border-radius: 10px;
    position: relative;
}

.gm_table tr td {
    padding: 6px 24px;
}
.gm_table , .gm_table th, .gm_table td {
    border: 1px solid rgba(33,150,243,0.5)!important;
}
.gm_table tr:nth-child(odd) {
    background: #e4f3ff;
}

.gm_table thead th, .gm_table tr th {
    padding: 9px 24px;
    color: #555;
    font-weight: 700;
}

.gm_table {
    margin: 10px 0;
}
.rating-heading h3{font-size:24px;}
.star-ques-sr{height:30px;}
.cert-questions{display: flex;
justify-content: flex-start;
}
.star-ques-sr{padding-right: 5px;}
.btn_gram{
  background-color: #000!important;
    color: #fff!important;
    font-weight: 500!important;
    border: 0!important;
    padding: 10px 18px!important;
    border-radius: 5px!important;
    cursor: pointer!important;
    box-shadow: 0 5px 10px rgb(233 30 99 / 0%)!important;;

}
.note_gm{
  background: #fff27c;
    padding: 8px 15px;
    margin-top:20px;
}

/* input[type=submit] {
    background-color: #000!important;
    color: #fff;
    font-weight: 500;
    border: 0;
    padding: 10px 18px;
    border-radius: 5px;
    cursor: pointer;
} */
</style>

<section >
  <div class="container">
     @if(session('success'))
      <div class="alert alert-success"><center><i class="fa fa-check-circle" aria-hidden="true"></i> {{session('success')}}</center></div>
      @endif    
      @if(session('failed'))
      <div class="alert alert-danger"><center><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{session('failed')}}</center></div>
      @endif 
      <div class="row">
          <div class="col-sm-12">
              
          </div>
      </div>
      <h1 class="heading">Be a Fit India Gram Panchayat Ambassador</h1>

    <div class="row">
        <div class="col-sm-12 col-md-12">

<!-- <div class="col-sm-12 col-md-9 "> -->
  <div class="description_box wrap event-form accordion yc-questions">
      <div id="tab-12977" class="star-rating-content current">
        <form name="createeventform" method="post" action="gram_panchayat_store" enctype="multipart/form-data">
          @csrf
          
            <div class="rating-heading">
              <h3>
                Request for Fit India Gram Panchayat Ambassador 
              </h3>
            </div>
            <div class="inner">
                <div class="um-field">
                    <div class="um-field-label ques ques_row_cont">
                        <label class="cert-questions"><span class="star-ques-sr">1.</span> <span>He/she should be nominated by Sarpanch/Mukhiya/Pradhan of Gram Panchayat as Fit India coordinator for organising community fitness events. He/ She should preferably be an elected representative.</span></label>
                        <div class="sub_ques_row_cont">
                          <table class="gm_table">
                            <tbody><tr>
                            <th>State</th>
                            <td>
                              <select name="state" id="state" class="form-control">
                                <option value="">Select State</option>
                                @foreach($states as $state)
                                  <option value="{{$state->id}}">{{$state->name}}</option> 
                                @endforeach
                              </select>
                              {!!$errors->first("state","<span class='text-danger'>:message</span>")!!}
                            </td>
                            </tr>
                            
                            <tr>
                            <th>District</th>
                            <td>
                              <select name="district" id="district" class="form-control">
                                <option value="">Select District</option>
                              </select>
                              {!!$errors->first("district","<span class='text-danger'>:message</span>")!!}                      
                            </td>
                            </tr>
                            
                            <tr>
                            <th>Block</th>
                            <td>
                              <select name="block" id="block" class="form-control">
                                <option value="">Select Block</option>
                              </select>
                              {!!$errors->first("block","<span class='text-danger'>:message</span>")!!}
                            </td>
                            </tr>

                            <tr>
                            <th>Pincode</th>
                            <td>
                              <input type="text" name="pincode" class="form-control" value="{{ old('pincode') }}">
                              {!!$errors->first("pincode","<span class='text-danger'>:message</span>")!!}
                            </td>
                            </tr>
                            
                            <tr>
                            <th>Gram Panchayat Name</th>
                            <td>
                                <input type="text" name="panchayat_name" class="form-control" value="{{old('panchayat_name')}}">
                                {!!$errors->first("panchayat_name","<span class='text-danger'>:message</span>")!!}
                            </td>
                            </tr>
                            <tr>
                            <th>Gram Panchayat Name</th>
                            <td>
                                <input type="file" name="document" class="form-control">
                                {!!$errors->first("document","<span class='text-danger'>:message</span>")!!}
                            </td>
                            </tr>
                          </tbody></table>
                        </div>
                        <!-- <div class="note"> Disclaimer : Kindly verify the details for Q1, once  submitted cannot be edited.
                        </div> -->
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="um-field">
                    <div class="um-field-label ques ques_row_cont">
                        <label class="cert-questions"><span class="star-ques-sr">2.</span> He/she should be preferably in the age group 18-50 years..</label>
                        <div class="sub_ques_row_cont">
                            <table class="gm_table">
                              <tbody>
                                  <tr>
                                    <th>Daily group Physical Activities by youth Club</th>
                                    <th>Please specify</th>
                                  </tr>
                                  <tr>
                                    <td>Name </td>
                                    <td>
                                        <input type="text" name="name" class="form-control " value="{{old('name')}}">
                                        {!!$errors->first("name","<span class='text-danger'>:message</span>")!!}

                                    </td>
                                  </tr>
                                  <tr>
                                    <td>Age</td>
                                    <td>
                                      <input type="text" name="age" class="form-control " value="{{old('age')}}">
                                      {!!$errors->first("age","<span class='text-danger'>:message</span>")!!}
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>Gender</td>
                                    <td class="minelem">
                                        <select name="gender" class="form-control">
                                          <option value="">Select Gender</option>
                                          <option value="male" @if (old('gender') == 'male') selected="selected" @endif >Male</option>
                                          <option value="female" @if (old('gender') == 'female') selected="selected" @endif >Female</option>
                                        </select>
                                        {!!$errors->first("gender","<span class='text-danger'>:message</span>")!!}
                                    </td>
                                  </tr>
                                  
                                </tbody></table>
                          </div>
                        <!-- <div class="note"> Note: Mandatory to fill minimum of 30 minutes to qualify</div> -->
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="um-field">
                    <div class="um-field-label ques ques_row_cont">
                        <label class="cert-questions"><span class="star-ques-sr">3.</span> He/she should be aware about the importance of physical fitness and spend 30-60 minutes daily for at least 5 days every week for physical activities. Physical activities could be playing any sport, traditional game, walking, cycling, dancing, running, or any other physical activity</label>
                        <div class="sub_ques_row_cont">
                            <table class="gm_table">
                              <tbody>
                                  <!-- <tr><th>YES</th><th>NO</th></tr> -->
                                  <tr>
                                    <!--  <td>
                                      <input type="radio" name="physical_activity" class="form-control" value="yes"> 
                                    </td>
                                    <td>
                                      <input type="radio" name="physical_activity" class="form-control " value="no">
                                    </td> -->
                                     <td><select name="physical_activity" class="form-control">
                                          <option value="">Select</option>
                                          <option value="yes" @if (old('physical_activity') == 'yes') selected="selected" @endif >YES</option>
                                          <option value="no" @if (old('physical_activity') == 'no') selected="selected" @endif>NO</option>
                                        </select>
                                        {!!$errors->first("physical_activity","<span class='text-danger'>:message</span>")!!}
                                    </td> 
                                  </tr>
                                </tbody></table>
                          </div>
                        <!-- <div class="note"> Note: Mandatory to fill minimum of 30 minutes to qualify</div> -->
                        <div class="clear"></div>
                    </div>
                </div>



                <!--<div class="um-field">
                    <div class="um-field-label ques ques_row_cont">
                        <label class="cert-questions"><span class="star-ques-sr">4.</span> He/she should motivate one additional person every month (minimum 10 persons in a year) for incorporating physical activity of 30-60 minutes in their daily routine.</label>
                        <div class="sub_ques_row_cont">
                          <table class="gm_table">
                            <tbody>
                              <tr>
                                <td>Undertaking- each member commits to motivate one person every month</td>
                                <td>
                                <input name="motivatecommits" type="checkbox" value="yes" class=" ">
                                </td>
                              </tr>
                              <tr>
                                <td>Undertaking- Youth Club commits to add at least 10 names/ numbers of motivated persons by 31st March 2021 in the given format</td>
                                <td>
                                <input name="youthclubcommits" type="checkbox" value="yes" class=" " onclick="showmotivatetbl(this)">
                                                              <br>
                                If yes (names and phone numbers to be filled by 31st March 2021) Format given below
                                </td>
                              </tr>
                            </tbody>
                          </table>  
                          <table class="motivate-tbl gm_table" id="motivatetbl" style="display: block;">
                            <tbody><tr>
                              <th>S. No.</th>
                              <th>Name of motivated person</th>
                              <th>Contact number</th>
                              <th>Email Id</th>
                            </tr>
                            <tr>
                              <td> 1</td>
                              <td>
                                <input type="text" name="mpname[]" class="form-control " value="">
                              </td>
                              <td>
                                <input type="text" name="mpcontact[]" class="form-control " value="">
                              </td>
                              <td>
                                <input type="text" name="mpemail[]" class="form-control " value="">
                              </td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>
                                <input type="text" name="mpname[]" class="form-control " value="">
                              </td>
                              <td>
                                <input type="text" name="mpcontact[]" class="form-control " value="">
                              </td>
                              <td>
                                <input type="text" name="mpemail[]" class="form-control " value="">
                              </td>
                            </tr>
                                                        
                             <tr>
                              <td>3</td>
                              <td>
                                <input type="text" name="mpname[]" class="form-control " value="">
                              </td>
                              <td>
                                <input type="text" name="mpcontact[]" class="form-control " value="">
                              </td>
                              <td>
                                <input type="text" name="mpemail[]" class="form-control " value="">
                              </td>
                            </tr>
                            <tr>
                              <td>4</td>
                              <td>
                                <input type="text" name="mpname[]" class="form-control " value="">
                              </td>
                              <td>
                                <input type="text" name="mpcontact[]" class="form-control " value="">
                              </td>
                              <td>
                                <input type="text" name="mpemail[]" class="form-control " value="">
                             </td>
                            </tr>
                            <tr>
                              <td>5</td>
                              <td>
                                <input type="text" name="mpname[]" class="form-control " value="">
                              </td>
                              <td>
                                <input type="text" name="mpcontact[]" class="form-control " value="">
                              </td>
                              <td>
                                <input type="text" name="mpemail[]" class="form-control " value="">
                              </td>
                            </tr>
                           <tr>
                              <td>6</td>
                              <td>
                                <input type="text" name="mpname[]" class="form-control " value="">
                              </td>
                              <td>
                                <input type="text" name="mpcontact[]" class="form-control " value="">
                              </td>
                              <td>
                                <input type="text" name="mpemail[]" class="form-control " value="">
                              </td>
                            </tr>
                            <tr>
                              <td>7</td>
                              <td>
                                <input type="text" name="mpname[]" class="form-control " value="">
                              </td>
                              <td>
                                <input type="text" name="mpcontact[]" class="form-control " value="">
                              </td>
                              <td>
                                <input type="text" name="mpemail[]" class="form-control " value="">
                              </td>
                            </tr>
                            <tr>
                              <td>8</td>
                              <td>
                                <input type="text" name="mpname[]" class="form-control " value="">
                              </td>
                              <td>
                                <input type="text" name="mpcontact[]" class="form-control " value="">
                              </td>
                              <td>
                                <input type="text" name="mpemail[]" class="form-control " value="">
                              </td>
                            </tr>
                            <tr>
                              <td>9</td>
                              <td>
                                <input type="text" name="mpname[]" class="form-control " value="">
                              </td>
                              <td>
                                <input type="text" name="mpcontact[]" class="form-control " value="">
                              </td>
                              <td>
                                <input type="text" name="mpemail[]" class="form-control " value="">
                              </td>
                            </tr>
                            <tr>
                              <td>10</td>
                              <td>
                                <input type="text" name="mpname[]" class="form-control " value="">
                              </td>
                              <td>
                                <input type="text" name="mpcontact[]" class="form-control " value="">
                              </td>
                              <td>
                                <input type="text" name="mpemail[]" class="form-control " value="">
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="clear"></div>
                  </div>
                </div> -->
                <div class="um-field">
                  <div class="um-field-label ques ques_row_cont">4. He/she should organise one community physical fitness event every quarter with minimum 100 participants. Such event could be any sport, running, dancing, cycling or yogasan sessions.</label>
                    <div class="sub_ques_row_cont">
                        <table class="gm_table">
                          <tbody>
                            <tr>
                              {!!$errors->first("eventname","<span class='text-danger'>:message</span>")!!}
                              {!!$errors->first("noofparticipant","<span class='text-danger'>:message</span>")!!}
                              {!!$errors->first("eventphoto","<span class='text-danger'>:message</span>")!!}
                              <td>Undertaking: He/she commits to organise at least one event every quarter</td>
                              <td width="90px">
                                <input name="yclubeventcommits" type="checkbox" value="yes" class="" onclick="eventcommit(this)">
                              </td>
                            </tr>
                          </tbody>
                        </table>  
                        <table id="eventcommit" style="" class="gm_table"> 
                          <tbody>
                            <tr>
                              <th colspan="2">Fit India event- 1: </th>
                            </tr>
                            <tr>
                              <td>Name of the event</td>
                              <td> 
                                <input type="text" name="eventname[]" class="form-control " value="">
                              </td>
                            </tr>
                            <tr>
                              <td>Number of participants</td>
                              <td> 
                                <input type="text" name="noofparticipant[]" class="form-control " value="">
                              </td>
                            </tr>
                            <tr>
                              <td>Attach photo</td>
                              <td> 
                                <input type="file" name="eventphoto[]" class="form-control ">
                              </td>
                            </tr>
                            <tr>
                              <th colspan="2">Fit India event- 2: </th>
                            </tr>
                            
                            <tr>
                              <td>Name of the event</td>
                              <td> 
                                <input type="text" name="eventname[]" class="form-control " value="">
                              </td>
                            </tr>
                            <tr>
                              <td>Number of participants</td>
                              <td> 
                                <input type="text" name="noofparticipant[]" class="form-control " value="">
                              </td>
                            </tr>
                            <tr>
                              <td>Attach photo</td>
                              <td> 
                                <input type="file" name="eventphoto[]" class="form-control ">
                              </td>
                            </tr>
                            <tr>
                              <th colspan="2">Fit India event- 3: </th>
                            </tr>
                            <tr>
                              <td>Name of the event</td>
                              <td> 
                                <input type="text" name="eventname[]" class="form-control " value="">
                              </td>
                            </tr>
                            <tr>
                              <td>Number of participants</td>
                              <td> 
                                <input type="text" name="noofparticipant[]" class="form-control " value="">
                              </td>
                            </tr>
                            <tr>
                              <td>Attach photo</td>
                              <td> 
                                <input type="file" name="eventphoto[]" class="form-control ">
                              </td>
                            </tr>
                            <tr>
                              <th colspan="2">Fit India event- 4: </th>
                            </tr>
                            <tr>
                              <td>Name of the event</td>
                              <td> 
                                <input type="text" name="eventname[]" class="form-control " value="">
                              </td>
                            </tr>
                            <tr>
                              <td>Number of participants</td>
                              <td> 
                                <input type="text" name="noofparticipant[]" class="form-control " value="">
                              </td>
                            </tr>
                            <tr>
                              <td>Attach photo</td>
                              <td> <input type="file" name="eventphoto[]" class="form-control ">
                            </td>
                            </tr>
                          </tbody>
                        </table>  
                    </div>
                    <div class="note_gm"><u><strong>NOTE :</strong></u><strong> Please submit the complete details of the motivated person every month and event organized quarterly before 31st March 2021 , else your issued certificate will be disqualified.</strong></div>
                    <div style="clear:both"></div>
                  </div>
                </div>
                <div class="um-field">
                  <div class="um-field-area">
                    <input type="submit" name="youth_club_subbtn" value="Submit" class="btn_gram">
                  </div>
                </div>
            </div>
        </form>        
      </div>
  </div>
</div>
</div>
  </div>
</section>
<!-- <script src='https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js'></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script> -->

  <script type="text/javascript">
    $('#state').change(function(){
    state_id = $('#state').val();
    $.ajax({
        url: "{{ route('champdistrict') }}",
        type: "post",
        data: { "id":state_id,"_token": "{{ csrf_token() }}"} ,
        success: function (response) {
           console.log(response);
           $('#district').html(response);
        },
    });
  });

  $('#district').change(function(){
    dist_id = $('#district').val();
    $.ajax({
        url: "{{ route('champblock') }}",
        type: "post",
        data: { "id":dist_id,"_token": "{{ csrf_token() }}"} ,
        success: function (response) {
           console.log(response);
           $('#block').html(response);
        },
        
    });
  });
  </script> 
@endsection