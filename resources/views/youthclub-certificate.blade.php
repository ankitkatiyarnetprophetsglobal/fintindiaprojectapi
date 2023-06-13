
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<style>
body{ font-family:arial; }

html { margin: 20px 10px 0px 10px; }

.valid-date{  margin:15px 0 0 30px; font-family: Khand, sans-serif; font-size:12px; color:#666;  }

.container{width:750px; height:1065px; margin:0px auto; position:relative;
background: url("{{ asset('wp-content/uploads/doc/youth.png') }}"); background-repeat:no-repeat; background-size: cover;
background-position:left;
}
.certificate-content
{padding:0px; box-sizing: border-box; position:absolute; top:42%;}
.cert-heading 
{position:absolute; top:8% }
.certificate-content p
{ font-family: Khand, sans-serif; color:#2f2e2e; font-size:22px; margin:0px; padding:0px; line-height:24px; font-weight:800; font-style:normal; text-align:center;}
.certificate-content .city {}
.bottom_txt 
{ font-family: Khand, sans-serif; text-align:center; color:#2f2e2e; font-size:20px; margin-bottom:0px;
padding:40px; line-height:24px; font-weight:light;
font-style:normal; }
</style>
</head>
<body>
<div class="container">
<div class="valid-date">Valid till : 31st March 2021</div>
<div class="certificate-content"> <p><?php print_r(strtoupper($name)); ?></p> <div class="cert-heading">
<h6 class="bottom_txt"><strong><?php print_r($name); ?></strong> can now use the FIT INDIA Flag and Logo. The club is expected to honour the declaration given during the registration process.</h6>
</div>
</div>
</div>
</body>
</html>







































