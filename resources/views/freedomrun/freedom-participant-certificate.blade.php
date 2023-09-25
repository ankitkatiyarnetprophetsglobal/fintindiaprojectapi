<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.centered {
  position: absolute;
  top: 95%;
  left: 50%;
  transform: translate(-50%, -50%);
   margin: :0px auto;
   padding: :0px auto;
   text-transform: uppercase;
}

</style>
</head>

<body style="padding:0;margin:0;">
  <div style="position:relative;margin:-28px; "><img src="{{ asset('resources/imgs/certificate/freedomrun22-part.jpeg') }}"  alt="" style="width:100%;margin:0px auto;height:758px;"></div>
  <div class="centered" style="font-family:Helvetica Nune,Helvetica; font-size:24px; font-weight:bold; position:relative; top:74%;width:100%; text-align:center;">{{$participant_name}} </div>
</body>
</html> 

