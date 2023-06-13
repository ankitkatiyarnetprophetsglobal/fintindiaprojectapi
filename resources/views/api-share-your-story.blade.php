<head>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="twitter:card" value="summary">

    <!-- CSRF Token  -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="msapplication-TileImage" content="{{ asset('resources/images/fit-fav.ico') }}" />
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('resources/images/fit-fav.ico') }}" sizes="32x32"  />
    <link rel="icon" href="{{ asset('resources/images/fit-fav.ico') }}" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('resources/images/fit-fav.ico') }}" />

    <!-- <link rel="stylesheet" href="{{ asset('resources/fonts/bootstrap.min.css') }}" media="screen"> -->
    <link rel="stylesheet" href="{{ asset('resources/css/bootstrap.min.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('resources/css/bootstrap.min.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('resources/css/font-awesome.css') }}" media="screen"> 
   
    <link rel="stylesheet" href="{{ asset('resources/css/dashboard.min.css') }}" media="screen">
    <!-- <link href="{{ asset('resources/css/print.min.css') }}" rel="stylesheet" media="all">   -->
    <link href="{{ asset('resources/css/style.css') }}" rel="stylesheet" media="all">   
    <link href="{{ asset('resources/css/responsive.css') }}" rel="stylesheet" media="screen"> 
    <link href="{{ asset('resources/css/print.css') }}" rel="stylesheet" media="print">  
     
    <style>

        /* .nav-item{line-height: 1.9;} */
        
    </style>

<script src="{{ asset('resources/js/jquery.min.js')}}"></script>
<script src="{{ asset('resources/js/popper.min.js')}}"></script>
<script src="{{ asset('resources/js/bootstrap.min.js')}}"></script>


</head>
</head>
<body>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                 @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <form action="api-share-your-story" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="youare">Who are You?*</label>
                            <select name="youare">
                                <option value="Individual">Individual</option>
                                <option value="Govt Organisation">Govt Organisation</option>
                                <option value="Private Organisation">Private Organisation</option>
                                @error('youare')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Designation/occupation *</label>
                            <input type="text" class="form-control" name="designation" value="">
                            @error('designation')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Email *</label>
                            <input type="email" class="form-control" name="email" value="">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                         <div class="form-group">
                            <label for="userEmail">Your name as you wish it to appear with your story *</label>
                            <input type="text" class="form-control" name="fullname" value="">
                            @error('fullname')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Story Video Youtube Link (If you've got a video you'd like to share along with your story, put it up on YouTube and enter the link below)</label>
                            <input type="text" class="form-control" name="videourl" value="">
                            @error('videourl')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Story Title *</label>
                            <input type="text" class="form-control" name="title" value="">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Image:</label>
                                <input type="file" name="image" class="form-control" placeholder="Image">
                            </div>
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        <div class="form-group">
                            <label for="userEmail">Your Story *</label>
                            <textarea name="story" cols="30" rows="10" class="form-control"></textarea>
                            @error('story')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">SEND</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>