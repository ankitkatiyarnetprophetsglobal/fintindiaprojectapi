@extends('api.layouts.app')
@section('title', 'Fit India - Share your story')
@section('content')
<br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
					 @if(!empty($errors))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
					
                <form action="{{ route('storeyourstory') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="youare">Who are You?*</label>
                            <select name="youare">
                                <option value="Individual">Individual</option>
                                <option value="Govt Organisation">Govt Organisation</option>
                                <option value="Private Organisation">Private Organisation</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Designation/occupation *</label>
                            <input type="text" class="form-control" name="designation" value="">
							
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Email *</label>
                            <input type="email" class="form-control" name="email" value="">
							
                        </div>
                         <div class="form-group">
                            <label for="userEmail">Your name as you wish it to appear with your story *</label>
                            <input type="text" class="form-control" name="fullname" value="">
							
                          
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Story Video Youtube Link (If you've got a video you'd like to share along with your story, put it up on YouTube and enter the link below)</label>
                            <input type="text" class="form-control" name="videourl" value="">
							
                            
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Story Title *</label>
                            <input type="text" class="form-control" name="title" value="">
							
                            
                        </div>
                        <div class="form-group">
                                <label for="image">Image:</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        <div class="form-group">
                            <label for="userEmail">Your Story *</label>
                            <textarea name="story" cols="30" rows="10" class="form-control"></textarea>
							
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">SEND</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
	
	@endsection