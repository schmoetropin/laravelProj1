@extends('layouts.back')
@section('content')
<div style="width: 70%; margin: 95px 0 0 15%; text-align: center; border-radius: 6px; background-color: #fff; padding: 10px;">
    <h1 class="h1" style="background-color: #42A5F5; border-top-right-radius: 5px; border-top-left-radius: 5px; color: #fff; text-transform: capitalize;">
        {{$user->name}}
    </h1><br />
    <div>
        <h6 class="h6">Likes received: {{$user->likes_received}}</h6>
    </div>
    <div>
        <h6 class="h6">Topics created: </h6><br />
        @foreach($topics as $t)
            <input type="hidden" class="topId" value="{{$t->id}}" />
            <figure class="figure" id="topic{{$t->id}}" style="border: 1px solid #78909C; border-radius: 6px; padding: 6px; width: 75%; text-align: center; position: relative; :hover: border-color:#90A4AE; background-color: #fff;">
                <a href="/show/{{$t->id}}" style="color: #E3F2FD; text-decoration: none;">
                    <p class="h3" style="text-transform: capitalize; background-color: #1976D2; border-top-left-radius: 5px; border-top-right-radius: 5px;">
                        {{$t->name}}
                    </p>
                </a>
                @if($t->media_type === 'image')
                    <img src="{{asset('media/'.$t->media)}}" class="figure-img img-fluid rounded" alt="..." style=" max-height: 300px;" />
                @else
                    <video src="{{asset('media/'.$t->media)}}" id="topicVideo{{$t->id}}" width="720" height="340" autoplay></video>
                @endif
                <figcaption class="figure-caption">{{$t->content}}</figcaption>
                <div style="position: absolute; top: 10px; left: 5px;">
                    &nbsp;&nbsp;<small style="margin-right: -5px; color: #fff;">{{$t->likes}}</small>
                </div>
            </figure>
        @endforeach
    </div>
</div>
<script src="{{asset('js/previewTopic.js')}}"></script>
@endsection