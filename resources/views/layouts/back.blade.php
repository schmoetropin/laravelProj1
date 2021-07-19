<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body class="antialiased" style="background-color: #eee;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="position: fixed; left: 0; top: 0; width: 100%; z-index: 100;">
            <div class="container-fluid">
                <a class="navbar-brand" href="/" style="margin-right: 15%;">Forum</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form action="/search" method="POST" class="d-flex" style="width: 70%;" >
                    @csrf
                    <input name="search" class="form-control me-2" type="text" placeholder="Search..." aria-label="Search" />
                    &nbsp;&nbsp;&nbsp;
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                </div>
            </div>
            @if (Route::has('login'))
                @auth
                    <a href="/create" class="btn btn-info btn-sm" style="margin: 5px; width: 150px;">Create a Topic</a>
                    <a href="/myProfile" class="btn btn-secondary btn-sm" style="margin: 5px;">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-danger btn-sm" style="margin: 5px; width: 65px;">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-danger btn-sm" style="margin: 5px; width: 65px;">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-secondary btn-sm" style="margin: 5px; width: 65px;">Register</a>
                    @endif
                @endauth
            @endif
        </nav>
        <div style="margin-top: 60px;">
            @yield('content')
        </div>
        <div style="height: 50px;"></div>
    </body>
</html>
