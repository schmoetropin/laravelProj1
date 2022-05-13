@extends('layouts.back')
@section('content')
<div style="margin-left: 13%; width: 60%;">
    <p style="color:#343a40; margin-bottom: 10px;">Search results for "{{$search}}":</p>
    @foreach($topics as $t)
    <input type="hidden" class="topId" value="{{$t->id}}" />
    <figure class="figure" id="topic{{$t->id}}" style="border: 1px solid #CFD8DC; border-radius: 6px; padding: 6px; width: 100%; text-align: center; position: relative; :hover: border-color:#90A4AE; background-color: #fff;">
        <a href="show/{{$t->id}}" style="color: #E3F2FD; text-decoration: none;">
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
        @foreach($users as $u)
            @if($u->id === $t->created_by)
                <small>Created by: <a href="profile/{{$u->id}}">{{$u->name}}</a></small>
            @endif
        @endforeach
    </figure>
    @endforeach
</div>
<div style="width: 200px; position: fixed; top: 70px; right: 20px;">
    <p class="h5">Most likes: </p>
    <ul class="list-group">
        @foreach($t5Users as $u)
            <li class="list-group-item" style="position: relative;">
                <a href="/profile/{{$u->id}}">
                    {{substr($u->name,0,11)}}
                </a>
                <div style="position: absolute; right: 20px; top: 12px;">
                    @if($u->likes_received === 0)
                        <p style="color: #343a40;">{{$u->likes_received}}</p>
                    @elseif($u->likes_received > 0)    
                        <p style="color: #4CAF50;">{{$u->likes_received}}</p>
                    @elseif($u->likes_received > 999)    
                        <p style="color: #4CAF50;">{{$u->likes_received/1000}}K</p>
                    @elseif($u->likes_received < -999)
                        <p style="color: #F44336;">{{$u->likes_received/1000}}K</p>
                    @else
                        <p style="color: #F44336;">{{$u->likes_received}}</p> 
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
</div>
<script src="{{asset('js/previewTopic.js')}}"></script>
@endsection