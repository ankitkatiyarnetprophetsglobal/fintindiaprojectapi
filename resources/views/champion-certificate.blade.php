<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<style>
*{ margin: 0;padding:0; box-sizing:border-box; font-family:Helvetica;}
</style>
</head>
<body>
  <div style="position:relative;margin:17px 17px 0 17px; width:100%; ">
     <img src="{{asset('wp-content/uploads/doc/champ_1070.png')}}" style="width:100%;height:757px;" />
     <h3 style="position:absolute;top:46%; width:50%; left:25%; font-size:42px; text-align:center; color:#353535;"><b><i>{{ $name }}</i></b></h3>
     <p style="position:absolute;top:3%;left:84%; ">Valid Till: {{ $cert_end_date }}</p>
  </div>
</body>
</html>
