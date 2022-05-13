@extends('layouts.back')
@section('content')
<div style="width: 60%; margin: 95px 0 0 20%;">
    <p style="color: #3490dc;">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </p>
    <form action="{{route('password.email')}}" method="POST">
        @csrf
        <input name="email" type="email" class="form-control" placeholder="Email..." aria-label="default input example" /><br />
        <button class="btn btn-primary btn-lg">{{ __('Email Password Reset Link') }}</button>
    </form>
</div>
@endsection
