@extends('layouts.app')
@section('title', 'champions | Fit India')
@section('content')

<section>
<div class="container">
        <div class="row ambass_area">                
              <h2>Be a Fit India Champion</h2>
               @if (session('success'))
                <div class="alert alert-success">
                </div>
                @endif
          <form name="ambassadorform" method="post" action="champ-store" enctype="multipart/form-data">
            @csrf
            <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="fname">Name:-</label>
                  <input type="text" name="name" id="amb_name" class="form-control" value="">
                  {!!$errors->first("name","<span class='text-danger'>:message</span>")!!}
                  </div>
                  </div>

                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="Email">Email:-</label>
                      <input type="email" name="email" id="email" class="form-control" value="">
                      {!!$errors->first("email","<span class='text-danger'>:message</span>")!!}
                  </div>
                  </div>

                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="contact">Contact:-</label>
                      <input type="number" name="contact" class="form-control" id="contact_number" value="">
                      {!!$errors->first("contact","<span class='text-danger'>:message</span>")!!}
                      </div>
                  </div>

                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="designaton">Designaton:-</label>
                  <input type="text" name="designation" class="form-control" id="designation" value="">
                  {!!$errors->first("designation","<span class='text-danger'>:message</span>")!!}
                  </div>
                  </div>


                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="Select State">State:-</label>
                      <select name="state_name" id="state" class="form-control">
                      <option value="">Select State</option>
                      @foreach($states as $state)
                        <option value="{{$state->id}}">{{$state->name}}</option> 
                      @endforeach
                  </select>
                  </div>
                  </div>
                  
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="District">District:-</label>
                      <select name="district_name" id="district" class="form-control">
                      <option value="">Select District</option>
                  </select>
                  </div>
                  </div>


                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="Block">Block:-</label>
                      <select name="block_name" id="block" class="form-control">
                        <option value="">Select Block</option>
                      </select>
                  </div>
                  </div>


                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="Pincode">Pincode:-</label>
                      <input type="text" name="pincode" id="pincode" value="" class="form-control">
                      {!!$errors->first("pincode","<span class='text-danger'>:message</span>")!!}
                  </div>
                  </div>


                  <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                      <label for="file">Upload Your Photo (This photo will be displayed against your profile on Fit India Website if approved)</label>
                      <input type="file" name="image" id="image" class="form-control">
                      {!!$errors->first("image","<span class='text-danger'>:message</span>")!!}
                      </div>
                  </div>


                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="facebook_profile">Facebook Profile (URL)</label>
                      <input type="text" name="facebook_profile" id="facebook_profile" value="" class="form-control">
                      {!!$errors->first("facebook_profile","<span class='text-danger'>:message</span>")!!}
                      </div>
                  </div>

                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="facebook_profile">Facebook Profile Followers</label>
                      <input type="text" name="facebook_profile" id="facebook_profile" value="" class="form-control">
                      </div>
                  </div>


                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="twitter_profile">Twitter Profile (URL)</label>
                  <input type="text" name="twitter_profile" id="twitter_profile" value="" class="form-control">
                  {!!$errors->first("twitter_profile","<span class='text-danger'>:message</span>")!!}
                  </div>
                  </div>
                  
                  <div class="col-sm-12 col-md-6">  
                      <div class="form-group">
                        <label for="twitter_profile">Twitter Profile Followers</label>
                        <input type="text" name="twitter_profile" id="twitter_profile" value="" class="form-control">
                      </div>
                  </div>

                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="instagram_profile">Instagram Profile (URL)</label>
                      <input type="text" name="instagram_profile" id="instagram_profile" value="" class="form-control">
                      {!!$errors->first("instagram_profile","<span class='text-danger'>:message</span>")!!}
                      </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="instagram_profile">Instagram Profile Followers</label>
                     <input type="text" name="instagram_profile" id="instagram_profile" value="" class="form-control">
                      </div>
                    </div>

                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="Work Profession">Work Profession:-</label>
                      <textarea name="work_profession" id="work_profession" class="form-control" rows="4" cols="50"></textarea>
                      {!!$errors->first("work_profession","<span class='text-danger'>:message</span>")!!}
                      </div>
                  </div>

                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                    <label for="description">Why do you want to become a Fit India Ambassador:-</label>
                    <textarea name="description" id="description" class="form-control" rows="4" cols="50"></textarea>
                    {!!$errors->first("description","<span class='text-danger'>:message</span>")!!}
                    </div>
                  </div>
                <div class="col-sm-12 col-md-12">
                  <br>
                <div class="form-group">
                      <a style="color:black!important" class="champ_btn" href="http://103.65.20.170/fitind/wp-content/uploads/2021/01/Guidelines-for-Fit-India-Champion.pdf" target="_blank">Guidelines of Fit India Champion</a>
                  </div>
                  </div>

                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                  <br>
                  <input type="checkbox" name="declaration" value="1" id="declaration">
                  I hereby declare that the above mentioned information is authentic to the best of my knowledge.
                  Also, I will abide by all the guidelines and deliverables mentioned in the terms and conditions form. 
                </div>
                </div>

                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                  <br>
                  <div class="see_area ">
                    <input type="submit" name="champion-create" value="Submit" class="seemore shadow_O sys" href="javascript:void(0);" data-toggle="modal" data-target="#actforyou">
                  </div>
                  </div>
              </div>
        </div>
      </form>
      </div>
      </div>
  </section>

  <script type="text/javascript">
    $('#state').change(function(){
    state_id = $('#state').val();
    $.ajax({
        url: "{{ route('champdistrict') }}",
        type: "post",
        data: { "id":state_id,"_token": "{{ csrf_token() }}"} ,
        success: function (response) {
          // console.log(response);
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
           //console.log(response);
           $('#block').html(response);
        },
    });
  });
  </script>                 
@endsection