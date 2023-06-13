@extends('layouts.app')
@section('title', 'share-your-story | Fit India')
@section('content')
@php
    $active_section = request()->segment(count(request()->segments()));
    $active_section_id = trim($active_section);
@endphp
<body>
    <br><br>
    <div class="container" id="{{ $active_section_id }}">
        <div class="row">
            <div class="col-md-12">
                <h2><strong>Add Participants *</strong></h2>
                <form action="{{ route('sharestory.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="userEmail">Events *</label>
                            <input type="text" class="form-control" name="designation" value="">
                        </div>
                        <h2><strong>Add Participants *</strong></h2>
                        <div class="form-group">
                            <label for="userEmail">No of Participants *</label>
                            <input type="text" class="form-control" name="title" value="">
                        </div>
                       
                        <div class="form-group">
                            <label for="userEmail">Participant Name(s) * <a href="">Multiple names can be added in separate lines</a></label>
                            <textarea name="story" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="center-on-small-only">
                        <button type="submit" class="btn btn-danger">Update Participants</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
@endsection