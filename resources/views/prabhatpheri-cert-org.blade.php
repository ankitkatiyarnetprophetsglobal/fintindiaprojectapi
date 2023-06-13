

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
            width: 1056px;
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
            margin-top: 370px
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
            font-family: Arial Rounded MT Bold;
        }

        .success {
            font-size: 15px;
            color: #434343;
            font-family: Docktrin
        }


    </style>
</head>
<body>
    <div class="page">
        <img src="{{ asset('wp-content/uploads/doc/Prabhatpheri.jpg') }}" width="1056" height="815">
    </div>
    <div class="certificate-content">
    <p style="margin: 20px 0; font-size: 15px; font-weight: 600">PRESENTED TO</p>
    
<p style="font-size: 30px; font-weight: 600; border-bottom: 1px solid #FF9946; padding-bottom:10px; width: 70%; margin: 0 auto 20px;"><?php print_r(strtoupper($organiser_name)); ?> </p>
<p style="font-size: 22px; font-family: Times Roman">FOR  SUCESSFULLY ORGANISING</p>
<p style="font-size: 26px; font-family: Times Roman"><?php print_r(str_replace("-2020"," ",strtoupper($cat))); ?></p> 
<p style="font-size: 18px; font-family: Times Roman">FIT INDIA DECEMBER CAMPAIGN 2020-2021 | <?php print_r($startdate); ?> - <?php print_r($enddate); ?></p>
    </div>
</body>
</html>




















































