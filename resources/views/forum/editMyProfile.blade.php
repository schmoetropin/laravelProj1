@extends('layouts.back')
@section('content')
<div style="width: 70%; margin: 95px 0 0 15%; border-radius: 6px; background-color: #fff; padding: 10px;">
    <h1 class="h1" style="text-align: center; background-color: #42A5F5; border-top-right-radius: 5px; border-top-left-radius: 5px; color: #fff; text-transform: capitalize;">
        Edit profile    
    </h1><br />
    <form action="/myProfile/edit/do" method="POST" style="width: 100%;">
        @csrf
        <label for="inputName" class="col-sm-2 col-form-label" style="float: left;"><h6 class="h5">
            Name: 
        </h5></label>
        <div class="col-sm-10">
            <input name="name" value="{{$user->name}}" type="text" style="width: 72%;" class="form-control" id="inputName" />
        </div><br />
        <label for="inputPassword" class="col-sm-2 col-form-label" style="float: left;"><h6 class="h5">
            Password: 
        </h5></label>
        <div class="col-sm-10">
            <input name="password" type="password" style="width: 72%;" class="form-control" id="inputPassword" placeholder="New password..." />
        </div><br />
        <label for="inputPasswordC" class="col-sm-2 col-form-label" style="float: left;"><h6 class="h5">
            Confirm password: 
        </h5></label>
        <div class="col-sm-10">
            <input name="password_confirmation" type="password" style="width: 72%;" class="form-control" id="inputPasswordC" placeholder="Confirm new password..." />
        </div><br />
        <button class="btn btn-primary btn-lg">Update</button>
    </form><br />
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $e)    
            <li>{{$e}}</li>
        @endforeach
        </div>
    @endif
</div>
@endsection

