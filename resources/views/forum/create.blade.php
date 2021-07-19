@extends('layouts.back')
@section('content')
<div style="width: 60%; margin: 95px 0 0 20%; text-align: center;">
    <p class="h3">Create Topic</p>
    <form action="/create/do" method="POST" enctype="multipart/form-data">
        @csrf
        <input name="name" type="text" class="form-control form-control-lg" placeholder="Title..." aria-label=".form-control-lg example" />
        Images: jpeg, jpg, png.<br />
        Videos: mp4.
        <div id="createTopicMedia" style="height: 250px; width: 80%; margin-left: 10%; border: 1px solid #CFD8DC; border-radius: 4px; background-color: #fff;"></div><br />
        <div class="input-group">
            <input name="media" type="file" id="createTopicFile" class="form-control" aria-describedby="inputGroupFileAddon04" aria-label="Upload" />
        </div><br />
        <input name="content" type="text" class="form-control form-control-sm" placeholder="Content..." aria-label="default input example" /><br />
        <button type="submit" class="btn btn-primary btn-lg">Post</button>
    </form>
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $e)    
            <li>{{$e}}</li>
        @endforeach
        </div>
    @endif
</div>
<script src="{{asset('js/previewFile.js')}}"></script>
@endsection