@extends('layouts.back')
@section('content')
<div style="width: 70%; margin: 95px 0 0 15%; text-align: center; border-radius: 6px; background-color: #fff; padding: 10px; position: relative;">
   @auth
      @if(auth()->user()->id === $topic->created_by)
      <div style="position: absolute; top: 70px; left: 10px;;">
         <a href="/show/{{$topic->id}}/edit" class="btn btn-info btn-lg" style="width: 90px;">
            Edit
         </a><br /><br />
         <form action="/show/{{$topic->id}}/delete" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger btn-lg" style="width: 90px;">
               Delete
            </button>
         </form>
      </div>
      @endif
   @endauth
   <h1 class="h1" style="text-transform: capitalize; background-color: #42A5F5; border-top-right-radius: 5px; border-top-left-radius: 5px; color: #fff;">
      {{$topic->name}}
   </h1>
   @if($topic->media_type === 'image')
      <img src="{{asset('media/'.$topic->media)}}" class="figure-img img-fluid rounded" alt="..." style=" max-height: 300px;" />
   @else
      <video src="{{asset('media/'.$topic->media)}}" width="720" height="340" controls></video>
   @endif
   <p>{{$topic->content}}</p>
   <small>Created by: <a href="/profile/{{$user->id}}">{{$user->name}}</a></small>
   <div style="position: absolute; bottom: 17px; left: 15px;">
      @if($topic->likes === 0)
         <h3 class="h3" style="float: left; margin: 10px 0 0 5px; color: #343a40;">
            {{$topic->likes}}
         </h3>
      @elseif($topic->likes > 0)
         <h3 class="h3" style="float: left; margin: 10px 0 0 5px; color: #4CAF50;">
            {{$topic->likes}}
         </h3>
      @elseif($topic->likes > 999)    
         <h3 class="h3" style="float: left; margin: 10px 0 0 5px; color: #4CAF50;">
            {{$topic->likes/1000}}K
         </h3>
      @elseif($topic->likes < -999)
         <h3 class="h3" style="float: left; margin: 10px 0 0 5px; color: #F44336;">
            {{$topic->likes/1000}}K
         </h3>
      @else
         <h3 class="h3" style="float: left; margin: 10px 0 0 5px; color: #F44336;">
            {{$topic->likes}}
         </h3>
      @endif
      <div style="float: right;">
         <form action="/show/{{$topic->id}}/like" method="POST">
            @csrf
            <button type="submit" style="border: none; background-color: transparent; margin: 0; width: 20px;">
                  <img src="{{asset('siteImages/arrow-128-16.png')}}" alt="up" />
            </button>
         </form>
         <form action="/show/{{$topic->id}}/dislike" method="POST">
            @csrf
            <button type="submit" style="border: none; background-color: transparent; margin: 0; width: 20px;">
                  <img src="{{asset('siteImages/arrow-190-16.png')}}" alt="down" />
            </button>
         </form>
      </div>
   </div> 
</div>
@endsection