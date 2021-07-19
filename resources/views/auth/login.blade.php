@extends('layouts.back')
@section('content')
<div style="width: 60%; margin: 95px 0 0 20%; text-align: center;">
    <p class="h3">Log in</p>
    <form action="{{route('login')}}" method="POST">
        @csrf
        <input name="email" type="email" class="form-control" placeholder="Email..." aria-label="default input example" /><br />
        <input name="password" type="password" class="form-control form-control-sm" placeholder="Password..." aria-label=".form-control-sm example" /><br />
        <div class="form-check">
            <input name="remember" class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked />
            <label class="form-check-label" for="flexCheckChecked">{{ __('Remember me') }}</label>
        </div><br />
        <button class="btn btn-primary btn-lg">{{ __('Log in') }}</button>
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="">
                {{ __('Forgot your password?') }}
            </a>
        @endif
    </form>
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $e)    
            <li>{{$e}}</li>
        @endforeach
        </div>
    @endif
</div>
@endsection