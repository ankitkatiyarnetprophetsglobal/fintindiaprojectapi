@extends('layouts.app')
@section('title', 'Prerak | Fit-India ')
@section('content')
<section>

 <div class="container">
   @if(session('success'))
      <div class="alert alert-success"><center><i class="fa fa-check-circle" aria-hidden="true"></i> {{session('success')}}</center></div>
      @endif    
      @if(session('failed'))
      <div class="alert alert-danger"><center><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{session('failed')}}</center></div>
      @endif 
        <div class="row ambass_area">
		    
		  <h2>Be a Fit India Prerak</h2>		   
          <form name="prerakform" method="post" action="ambassador" enctype="multipart/form-data">
            @csrf
            <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="fname">Name:-</label>
                        <input type="text" name="name" id="amb_name" class="form-control" value="{{ old('name') }}">
                        {!!$errors->first("name","<span class='text-danger'>:message</span>")!!}
                      </div>
                  </div>

                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="Email">Email:-</label>
                      <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                      {!!$errors->first("email","<span class='text-danger'>:message</span>")!!}
                  </div>
                  </div>

                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="contact">Contact:-</label>
                      <input type="number" name="contact" class="form-control" id="contact_number" value="{{ old('contact') }}" maxlength="10">
                      {!!$errors->first("contact","<span class='text-danger'>:message</span>")!!}
                      </div>
                  </div>

                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="designaton">Designaton:-</label>
                  <input type="text" name="designation" class="form-control" id="designation" value="{{ old('designation') }}">
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
                  {!!$errors->first("state_name","<span class='text-danger'>:message</span>")!!}
                  </div>
                  </div>
                  
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="District">District:-</label>
                      <select name="district_name" id="district" class="form-control">
                       <option value="">Select District</option>
                     </select>
                     {!!$errors->first("district_name","<span class='text-danger'>:message</span>")!!}
                  </div>
                  </div>

                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="Block">Block:-</label>
                      <select name="block_name" id="block" class="form-control">
                        <option value="">Select Block</option>
                      </select>
                      {!!$errors->first("block_name","<span class='text-danger'>:message</span>")!!}
                  </div>
                  </div>

                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="Pincode">Pincode:-</label>
                      <input type="text" name="pincode" id="pincode" value="{{ old('pincode') }}" class="form-control" maxlength="6">
                      {!!$errors->first("pincode","<span class='text-danger'>:message</span>")!!}
                  </div>
                  </div>



                  <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                      <label for="file">Upload Your Photo <span style="color:red">(Kindly upload a formal photo, This photo will be displayed against your profile on Fit India Website if approved)</span></label>
                      <input type="file" name="image" id="image" class="form-control">
                      {!!$errors->first("image","<span class='text-danger'>:message</span>")!!}
                    </div>
                  </div>
                  &nbsp;&nbsp;
                   <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                      <span ><strong>The individual should be present on at least one of the social media handles ( Facebook, Instagram or Twitter)</strong> 
                       </span>
                    </div>
                  </div> 

                 
                  <div class="col-sm-12 col-md-12 col-lg-12 ">
                    <div class="form-group">
                      <label for="social_media_url">
                      Social Media Url(Facebook/Twitter/Instagram)</label>
                      <input type="text" name="social_media_url" id="social_media_url" value="{{ old('social_media_url') }}" class="form-control">
                      {!!$errors->first("social_media_url","<span class='text-danger'>:message</span>")!!}
                      </div>
                  </div>

                  &nbsp;&nbsp;
                   <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                      <p><strong>Must be following Fit India Movement’s Social media handles (@FitIndiaOff)</strong>
                      <input type="checkbox" name=""></p> 
                    </div>
                  </div>

                  &nbsp;&nbsp;
                  <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                      <span ><strong>The individual must have cumulative followers in the range of 1K – 10K on their social media platforms (Facebook, Twitter, & Instagram).</strong></span>
                    </div>
                  </div>


                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="facebook_profile">Facebook Profile (URL)</label>
                      <input type="text" name="facebook_profile" id="facebook_profile" value="{{ old('facebook_profile') }}" class="form-control">
                      {!!$errors->first("facebook_profile","<span class='text-danger'>:message</span>")!!}
                      </div>
                      <p class="facebook_detail" style="display:block; color:red"># Profile should be unlocked.<br>
                            # Friends, likes and followers should not be hidden.<br>
                            # Posts/ Contents should not be hidden.</p>
                  </div>

                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="facebook_profile_followers">Facebook Profile Followers</label>
                      <input type="text" name="facebook_profile_followers" value="{{ old('facebook_profile_followers') }}" id="facebook_profile_followers"  class="form-control">
                      {!!$errors->first("facebook_profile_followers","<span class='text-danger'>:message</span>")!!}
                      </div>
                  </div>
                  
                 



                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="twitter_profile">Twitter Profile (URL)</label>
                  <input type="text" name="twitter_profile" id="twitter_profile" value="{{ old('twitter_profile') }}" class="form-control">
                  {!!$errors->first("twitter_profile","<span class='text-danger'>:message</span>")!!}
                  </div>
                  </div>
                  
                  <div class="col-sm-12 col-md-6">  
                      <div class="form-group">
                        <label for="twitter_profile_followers">Twitter Profile Followers</label>
                        <input type="text" name="twitter_profile_followers" id="twitter_profile_followers" value="{{ old('twitter_profile_followers') }}" class="form-control">
                         {!!$errors->first("twitter_profile_followers","<span class='text-danger'>:message</span>")!!}
                      </div>
                  </div>

                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="instagram_profile">Instagram Profile (URL)</label>
                      <input type="text" name="instagram_profile" id="instagram_profile" value="{{ old('instagram_profile') }}" class="form-control">
                      {!!$errors->first("instagram_profile","<span class='text-danger'>:message</span>")!!}
                      </div>
                      <p class="insta_detail" style="display:block; color:red"># Profile should not be private</p>
                    </div>

                    <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="instagram_profile">Instagram Profile Followers</label>
                      <input type="text" name="instagram_profile_followers" id="instagram_profile_followers" value="{{ old('instagram_profile_followers') }}" class="form-control">
                      {!!$errors->first("instagram_profile_followers","<span class='text-danger'>:message</span>")!!}
                      </div>
                    </div>


                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="Work Profession">Work Profession</label>
                      <textarea name="work_profession" id="work_profession" class="form-control" rows="4" cols="50">{{ old('work_profession') }}</textarea>
                      {!!$errors->first("work_profession","<span class='text-danger'>:message</span>")!!}
                      </div>
                  </div>

                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                    <label for="description">Why do you want to become a Fit India Prerak</label>
                    <textarea name="description" id="description" class="form-control" rows="4" cols="50">{{ old('description') }}</textarea>
                    {!!$errors->first("description","<span class='text-danger'>:message</span>")!!}
                    </div>
                  </div>
                  &nbsp;
                  <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                  <strong>The individual should be a fitness enthusiast i.e. one who practices some form of physical activity such as running, cycling,  yoga etc for 30 to 60 minutes daily.</strong>
                  <input type="checkbox" name="physical_activity" value="1" id="physical_activity"><br>
                  {!!$errors->first("physical_activity","<span class='text-danger'>:message</span>")!!}
                  </div>
                </div>
                 &nbsp;

                   <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                  <!-- <input type="checkbox" name="age_box" value="1" id="age_box" checked="checked"> -->
                  <strong>The Individual should be at least 18 years of age</strong> 
                </div>
                </div>
                
                <div class="col-sm-12 col-md-12 col-lg-12 age_field" style="display:block">
                    <div class="form-group">
                      <label for="file">Upload Your Id Proof</label>
                      <input type="file" name="age_proof" id="age_proof" class="form-control">
                      {!!$errors->first("age_proof","<span class='text-danger'>:message</span>")!!}
                    </div>
                  </div>


                    <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                  <!-- <input type="checkbox" name="age_box" value="1" id="age_box" checked="checked"> -->
                  <strong>The individual should have taken fitness assessment test on Fit India Mobile App.</strong> 
                </div>
                </div>

                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label>Fit India App Unique ID</label>
                    <input type="text" name="ft_app_id" class="form-control ft_app_id" >
                    <span id="app_test_result"></span>
                    <br>
                    <button type="button" name="check_appid" class="btn btn-primary" id="check_appid">Check Unique ID</button>
                  </div>
                </div>

                
                
                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                 <strong> The individual can organise or participate on-ground/virtual fitness events wherever possible and upload the photos of the same by tagging @FitIndiaOff.</strong>
                 <input type="checkbox" name="declaration" value="1" id="declaration">  <br>
                  {!!$errors->first("declaration","<span class='text-danger'>:message</span>")!!}
                </div>
                </div> 

                 


                <div class="col-sm-12 col-md-12">
                  <br>
                <div class="form-group">
                      <a style="color:black!important" class="champ_btn" href="{{ asset('wp-content/uploads/2021/01/Guidelines-for-Fit-India-Ambassador.pdf') }}" target="_blank">Guidelines of Fit India Prerak</a>
                  </div>
                  </div>

                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                  <br>
                  <input type="checkbox" name="declaration" value="1" id="declaration">
                  I hereby declare that the above mentioned information is authentic to the best of my knowledge.
                  Also, I will abide by all the guidelines and deliverables mentioned in the terms and conditions form. <br>
                  {!!$errors->first("declaration","<span class='text-danger'>:message</span>")!!}
                </div>
                </div>


               

                 

                


                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                  <br>
                  <div class="see_area ">
                    <input type="submit" name="ambassador-create" value="Submit" class="seemore shadow_O sys" href="javascript:void(0);" data-toggle="modal" data-target="#actforyou">
                  </div>
                  </div>
              </div>
        </div>
      </form>
      </div>
      </div>
  </section>
<script src='https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js'></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>

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
<script>
  $(function() {
    jQuery.validator.addMethod("validate_email", function(value, element) {
        if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
            return true;
        } else {
            return false;
        }
    }, "Please enter a valid Email.");

    jQuery.validator.addMethod("lettersonly", function(value, element) 
    {
      //return this.optional(element) || /^[a-z," "]+$/i.test(value);
      return this.optional(element) || /^[a-zA-Z0-9_@./#&+,:\s/-]+$/i.test(value);
    }, "Letters and spaces only please"); 

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0} bytes.');

    
    $("form[name='ambassadorform']").validate({
      rules: {
        name:{
          required:true,
          lettersonly:true
        },
        email: {
            required:true,
            validate_email: true
        },
        contact: {
            required:true,
            minlength:10,
            maxlength:10
        },
        designation: "required",
        state_name: "required",
        district_name: "required",
        block_name: "required",
      pincode: { required:true, digits: true, minlength:6, maxlength:6 },
      image: {
        required: true,
        extension: "gif|png|jpg|jpeg", // work with additional-mothods.js
                filesize: 1048576, 
      },
      facebook_profile: { required:true, url: true },
            facebook_profile_followers: { required:true, digits: true, maxlength:7 },

            twitter_profile: { required:true, url: true },
            twitter_profile_followers: { required:true, digits: true, maxlength:7 },

            instagram_profile: { required:true, url: true },
            instagram_profile_followers: { required:true, digits: true, maxlength:7 },
            
      work_profession: { required:true, lettersonly: true },
            description: { required:true, lettersonly: true },
      "declaration": {
            required: true,
            minlength: 1
          }
        
      },
      messages: {
        amb_name:{
          required:"Please enter your name",
          lettersonly:"Please enter character only"
        },
        email: {
          required: "Please enter your email",
          validate_email: "Please enter valid email id"
        },
        contact_number: {
            required: "Please enter contact number",
          minlength: "Your phone must be 10 number long",
          maxlength: "Your phone must be 10 number long"
        },
        designation: "Please enter your designation",
        state: "Please select your state",
        district: "Please select your state",
        block: "Please select your block",
        pincode: { 
          required:"Please enter pincode",
                digits: "Only digits allow", 
          minlength:"Only 6 digit allowed", 
          maxlength:"Only 6 digit allowed" 
        },
      image: {
         filesize:"File size must be less than 1 mb."
            },

      facebook_profile: {required: "Please enter your facebook profile url", url:"Please enter valid url" },
            facebook_profile_followers: {required: "Please enter your facebook followers count", digits:"Allow digit only", maxlength:"digit length should be less than 7 or equal to 7 digit" },
            twitter_profile: {required: "Please enter your twitter profile url", url:"Please enter valid url" },
            twitter_profile_followers: {required: "Please enter your twitter followers count", digits:"Allow digit only", maxlength:"digit length should be less than 7 or equal to 7 digit" },
            instagram_profile: {required: "Please enter your instagram profile url", url:"Please enter valid url" },
            instagram_profile_followers: {required: "Please enter your instagram followers count", digits:"Allow digit only", maxlength:"digit length should be less than 7 or equal to 7 digit" },
      work_profession: { required:"Please enter your work profession", lettersonly: "Only Alphabetic character allow" }, 
            description: { required:"Please fill the description", lettersonly: "Only Alphabetic character allow" },
      "declaration": "Please select at least one checkbox"
    },

    submitHandler: function(form) {
        var fb_follower = parseInt($('#facebook_profile_followers').val());
        var twit_follwer = parseInt($('#twitter_profile_followers').val());
        var insta_follwer = parseInt($('#instagram_profile_followers').val());
        var follwer_sum = fb_follower + twit_follwer + insta_follwer; 
        if(follwer_sum > 9999){
            form.submit();
        }else{
            alert("Your Social media follower's count should be greater than or equal to 10,000");
        }
    }
  });
}); 

/*$(document).ready(function(){
    $('#facebook_profile').focus(function(){
        $('.facebook_detail').show();
    }).blur(function(){
     $('.facebook_detail').hide();
    }); 
    $('#instagram_profile').focus(function(){
        $('.insta_detail').show();
    }).blur(function(){
     $('.insta_detail').hide();
    });
});
*/
$(document).ready(function(){
  $('#fitness_test').change(function(){
    if($(this).is(":checked"))   
            $(".ft_app_id").show();
        else
            $(".ft_app_id").hide();
  });
  $('#age_box').change(function(){ 
       if($(this).is(":checked"))   
            $(".age_field").show();
        else
            $(".age_field").hide();
  });
  $('#check_appid').click(function(){
   /* var ft_app_id = $('.ft_app_id').val();
    var datas = {
            'fitindiaid': ft_app_id,
        }
    if(ft_app_id==""){
      alert("Please enter Fit India App Unique ID");
    }else{*/
      var datas = {
            'fitindiaid': '121212',
        }
      $.ajax({
        /*headers: {
            'Access-Control-Allow-Origin': 'http://103.65.20.140:83/fitindiaservice.svc'
        },
        type:'POST',
        url:'http://103.65.20.140:83/fitindiaservice.svc/dashboard',
        data: {'apitoken':'A2P0R1','data':data,"_token": "{{ csrf_token() }}"},
        contentType: "application/json;",
        success:function(data){
          console.log(data);
        }*/
         type: 'POST',  
//url: 'https://103.65.20.140:83/fitindiaservice.svc/dashboard',  
url:'/beta/prerak_ft_test',
//headers: {  'Access-Control-Allow-Origin': 'http://103.65.20.140:83/fitindiaservice.svc' },
                   //    dataType: 'jsonp',  
                    
                  //  contentType:'application/json',
                     data: {'data':datas,'apitoken':'A2P0R1',"_token": "{{ csrf_token() }}"}, 
                     /* cors: false ,*/
                     //crossDomain:true,
         
          /*secure: true,
                    headers: {
                      "accept": "application/json",
                        'Access-Control-Allow-Origin': '*',
                    },*/
                     success: function (data, textStatus, xhr) {  
                         console.log(data);  
                     },  
                     error: function (xhr, textStatus, errorThrown) {  
                         console.log('Error in Operation '+textStatus);  
                     }  
                     /* error: function(ts) { alert(ts.responseText) } */



      })
    });
  });

</script>
<style>
  .error{color:red;}
</style>                  
@endsection