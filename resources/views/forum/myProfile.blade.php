@extends('layouts.back')
@section('content')
<a href="/myProfile/edit" class="btn btn-danger btn-lg" style="position: absolute; top: 75px; left: 10px;">
    Edit
</a>
<div style="width: 70%; margin: 95px 0 0 15%; text-align: center; border-radius: 6px; background-color: #fff; padding: 10px;">
    <h1 class="h1" style="background-color: #42A5F5; border-top-right-radius: 5px; border-top-left-radius: 5px; color: #fff; text-transform: capitalize;">
        {{$user->name}}
    </h1><br />
    <ul>
        <li>Email: {{$user->email}}</li>
        <li>Topics created: {{$user->topics_created}}</li>
        @if($user->user_type === 1)
            <li>User type: User</li>
        @elseif($user->user_type === 2)
            <li>User type: Moderator</li>
        @else
            <li>User type: Admin</li>
        @endif
        <li>Likes received: {{$user->likes_received}}</li>
    </ul>
    <div>
        <h5 class="h5">Topics created: </h6><br />
        @foreach($topics as $t)
            <figure class="figure" style="border: 1px solid #78909C; border-radius: 6px; padding: 6px; width: 75%; text-align: center; position: relative; :hover: border-color:#90A4AE; background-color: #fff;">
                <a href="/show/{{$t->id}}" style="color: #E3F2FD; text-decoration: none;">
                    <p class="h3" style="text-transform: capitalize; background-color: #1976D2; border-top-left-radius: 5px; border-top-right-radius: 5px;">
                        {{$t->name}}
                    </p>
                </a>
                @if($t->media_type === 'image')
                    <img src="{{asset('media/'.$t->media)}}" class="figure-img img-fluid rounded" alt="..." style=" max-height: 300px;" />
                @else
                    <video src="{{asset('media/'.$t->media)}}" width="720" height="340" autoplay></video>
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