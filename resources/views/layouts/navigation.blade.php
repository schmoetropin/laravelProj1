{{ Auth::user()->name }}<br />
{{ Auth::user()->email }}<br />
<a href="{{route('dashboard')}}" :active="request()->routeIs('dashboard')">
    {{ __('Dashboard') }}
</a>
       
