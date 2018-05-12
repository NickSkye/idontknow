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
        <meta name="author" content="Nicholas Skye Hoyt"/>
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="/js/jquery.jscroll.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript">
        $('ul.pagination').hide();
        $(function() {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<img class="center-block" src="/images/loading.gif" alt="Loading..." />',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function() {
                    $('ul.pagination').remove();
                }
            });
        });
        </script>
        <script>

        $( function() {
            $( "#datepicker" ).datepicker();
        } );
        </script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <div class="visible-xs hidden-sm hidden-md hidden-lg" style="width: 100%; height: 50px; background-color: black; color: white">
                <a href="#download app" style="width: 100%; height: 50px; background-color: black; color: white">
                    Download our Mobile App
                </a>
            </div>


            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{--{{ config('app.name', 'idontknow') }}--}}
                        <img src="/images/frendgridlogo.png" alt="FrendGrid" style="max-width: 100px;">
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
                                @if(Request::is('activity') or Request::is('/') or Request::is('me') or Request::is('shouts') or Request::is('home'))

                                <li class="nav-item dropdown">
                                    @if (!$notifs->isEmpty())
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <i class="fa fa-exclamation-circle" aria-hidden="true" style="color: #F62E55;"></i> <span class="caret"></span>
                                    </a>
                                    @else
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <span class="caret"></span>
                                        </a>
                                    @endif

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="overflow-y: scroll; max-height: 400px;">
                                        @foreach($notifs as $notif)
                                        {{--<a class="dropdown-item" href="/notifications/{{$notif->id}}">--}}
                                            {!! $notif->notification !!}
                                        {{--</a>--}}
                                        @endforeach
                                            <a class="dropdown-item" href="/clear-notifications" style="background-color: #F62E55;">
                                                Clear all notifications
                                            </a>
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
