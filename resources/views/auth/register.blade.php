@extends('layouts.back')
@section('content')
<div style="width: 60%; margin: 95px 0 0 20%; text-align: center;">
    <p class="h3">Register</p>
    <form action="{{route('register')}}" method="POST">
        @csrf
        <input name="name" type="text" class="form-control form-control-lg" placeholder="Name..." aria-label=".form-control-lg example" /><br />
        <input name="email" type="email" class="form-control" placeholder="Email..." aria-label="default input example" /><br />
        <input name="password" type="password" class="form-control form-control-sm" placeholder="Password..." aria-label=".form-control-sm example" /><br />
        <input name="password_confirmation" type="password" class="form-control form-control-sm" placeholder="Password..." aria-label=".form-control-sm example"/><br />
        <button class="btn btn-primary btn-lg">{{ __('Register') }}</button>
    </form>
    <a href="{{ route('login') }}">
        {{ __('Already registered?') }}
    </a>
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $e)    
            <li>{{$e}}</li>
        @endforeach
        </div>
    @endif
</div>
@endsection
