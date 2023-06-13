

<html lang="en"><head>
<meta charset="UTF-8">
<title>Document</title>
 <style>
         @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap");

    body {
        margin: 0;
         font-family: Roboto, sans-serif;
    }

    @page {
        margin: 0;
    }

    @media print {
        @page {
            size: letter landscape;
            margin: 0;
        }
    }
  
  
    p{ font-family: Roboto, sans-serif; margin: 0 0 10px 0 }
    .page {
        
        height: 860px;
        width: 1156px;
        background-repeat: no-repeat;
        background-size: cover;
        position: absolute;
        left: 0;
        top: 0;
        z-index: -1;
    }
    .certificate-content{
        text-align: center;
        width: 100%;
        margin-top: 270px
    }
    .orange {
        color: #FF9C2A;
        font-size: 28px;
        font-weight: 700;
    }

  .congratulations{
      color: #2F2F2F !important;
      font-size: 24px !important;
      
  }

    .name {
        font-size: 18px !important;
    }

    .success {
        font-size: 15px;
        color: #434343;
    }


  .bottomweb {
        position:absolute;
    bottom:3px;
    left:15px;
    }

</style>
</head>
<body>
    
<div class="page">
    <img src="{{ asset('wp-content/uploads/doc/cyclothon-certificate.jpg') }}" width="1120" height="815">
</div>
<div class="certificate-content">
<p style="font-family: Roboto, sans-serif;margin: 0px 0; font-size: 45px;letter-spacing:1px;">Congratulations to</p>
<p style="font-size: 32px; font-weight: 600; padding-bottom:10px; width: 70%; margin: 10px auto 10px; color:#E46A42;"><?php print_r(strtoupper($participant)); ?></p>
<p style="font-size: 26px; font-family: Roboto, sans-serif;letter-spacing:1px; margin-bottom:10px; color:#1F1E1E;">for Successfully participating in</p>
<p style="font-size: 32px; font-family: Roboto, sans-serif; color:#84843C; font-weight:700; margin-bottom:15px; ">{{ $cat }}</p>  
<p style="font-size: 22px; font-family: Roboto, sans-serif;">FIT INDIA DECEMBER CAMPAIGN 2020-2021 | <?php print_r($startdate); ?>  - <?php print_r($enddate); ?></p>
</div>
<p class="bottomweb">www.fitindia.gov.in</p>
</body>
</html>



























