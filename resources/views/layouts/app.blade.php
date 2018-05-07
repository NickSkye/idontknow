<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-50122846-5"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-50122846-5');
        </script>


        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <meta name=“description” content="Your friends at your fingertips"/>
        <meta name=“keywords” content="social, media, social media, college, friends, near me, nearby, facebook, instagram"/>
        <meta name="author" content="Intelliskye, LLC"/>
        <link rel="canonical" href="https://frendgrid.com/"/>
        <meta name="dc.language" content="en">
        <meta http-equiv="Content-Language" content="en">

        <link rel="publisher" href="https://intelliskye.com/"/>
        <meta name="robots" content="all"/>
        <meta name="robots" content="index, follow"/>
        <meta name="revisit-after" content="4 days"/>


        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'FrendGrid') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'idontknow') }}
                    </a>
                    @auth
                    @include('partials.friendsearch')
                    @endauth
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                            @else
                                @if (Request::is('/'))
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach($notifications as $notification)
                                        <a class="dropdown-item" href="/notifications/{{$notification->id}}">
                                            {{$notification->notification}}
                                        </a>
                                        @endforeach

                                    </div>
                                </li>
                                @endif
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/">
                                            {{ __('Home') }}
                                        </a>
                                        <a class="dropdown-item" href="/me">
                                            {{ __('My Profile') }}
                                        </a>
                                        <a class="dropdown-item" href="/settings">
                                            {{ __('Settings') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
                @include('partials.modals')
            </main>
            @auth
                @include('partials.permafooter')
            @endauth
        </div>


    </body>
</html>
