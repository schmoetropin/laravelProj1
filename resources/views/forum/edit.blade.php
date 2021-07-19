@extends('layouts.back')
@section('content')
<div style="width: 70%; margin: 95px 0 0 15%; text-align: center; border-radius: 6px; background-color: #fff; padding: 10px;">
    <h1 class="h1" style="background-color: #42A5F5; border-top-right-radius: 5px; border-top-left-radius: 5px; color: #fff;">Edit Topic</h1><br />
    <form action="/show/{{$topic->id}}/edit/do" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 row">
            <label for="inputName" class="col-sm-2 col-form-label"><h6 class="h5">Topic title: </h5></label>
            <div class="col-sm-10">
                <input name="name" value="{{$topic->name}}" type="text" class="form-control" id="inputName" />
            </div>
        </div>
        <h6 class="h5">Topic file: </h5>
        Images: jpeg, jpg, png.<br />
        Videos: mp4.
        <div style="width: 100%; margin-bottom: 10px; height: 225px;">
            <div style="width: 45%;">
                Old media:
                @if($topic->media_type === 'image')
                    <img src="{{asset('media/'.$topic->media)}}" class="figure-img img-fluid rounded" alt="..." style=" max-height: 200px; float: left;" />
                @else
                    <video src="{{asset('media/'.$topic->media)}}" width="440" height="200" controls autoplay style=" float: left;"></video>
                @endif
            </div>
            <div style="float: right; width: 45%; margin-top: -23px;">
            New media:
                <div id="createTopicMedia" style="height: 200px; margin: 0 2% 0 2%; border: 1px solid #CFD8DC; border-radius: 4px;"></div>
            </div>
        </div>
        <input type="hidden" id="editTopicHiddenInput" />
        <div class="input-group">
            <input name="media" type="file" id="createTopicFile" class="form-control" aria-describedby="inputGroupFileAddon04" aria-label="Upload" />
        </div><br />
        <h6 class="h5">Topic description: </h5>
        <input name="content" value="{{$topic->content}}" class="form-control form-control-sm" type="text" placeholder=".form-control-sm" aria-label=".form-control-sm example"><br />
        <button type="submit" class="btn btn-primary btn-lg">Update</button>
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