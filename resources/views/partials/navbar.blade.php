@auth
<nav class="navbar navbar-expand-md navbar-light navbar-laravel hidden-on-small">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/dashboard') }}">
            {{--{{ config('app.name', 'idontknow') }}--}}
            <img src="/images/frendgriddark.png" alt="FrendGrid" style="max-width: 45px;">

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
                <li><a class="nav-link" href="/nearby">{{ __('Activity') }}</a></li>
                @else
                    @if(Request::is('activity') or Request::is('me') or Request::is('shouts') or Request::is('home') or Request::is('settings'))

                        <li class="nav-item dropdown">
                            @if (!$notifs->isEmpty())
                                    <a class="nav-link" href="/notification" >
                                    <i class="fa fa-exclamation-circle" aria-hidden="true" style="color: #F62E55;"></i>
                                        @if(isset($_COOKIE['FG_Notifications']))
                                        @if($_COOKIE['FG_Notifications'] > 0)
                                            {{$_COOKIE['FG_Notifications']}}
                                        @endif
                                            @endif

                                </a>
                            @else
                                <a class="nav-link" href="/notification" >
                                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>

                                </a>
                            @endif

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="overflow-y: scroll; max-height: 400px;">

                                    <a class="dropdown-item" href="/notification">
                                        All Notifications
                                    </a>

                            </div>
                        </li>
@else
                        <a class="nav-link" href="/notification" >
                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>

                        </a>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/home">
                                {{ __('Home') }}
                            </a>
                            <a class="dropdown-item" href="/me">
                                {{ __('My Profile') }}
                            </a>
                            <a class="dropdown-item" href="/settings">
                                {{ __('Settings') }}
                            </a>
                            <a class="dropdown-item" href="/dashboard">
                                {{ __('Dashboard') }}
                            </a>
                            {{--<a class="dropdown-item" href="/apps">--}}
                                {{--{{ __('Apps') }}--}}
                            {{--</a>--}}
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
@endauth
{{--MOBILE NAV--}}
@auth
<nav class="navbar mobile-navbar navbar-light navbar-laravel visible-on-small">


        <div class="header-button">
            <a class=" logo-button" href="{{ url('/dashboard') }}">
                {{--{{ config('app.name', 'idontknow') }}--}}
                <img src="/images/frendgriddark.png" alt="FrendGrid" style="max-width: 45px;">

            </a>
        </div>

        {{--@include('partials.friendsearch')--}}
        <div class="header-button">
            <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" class="header-search-button " >
                <i class="fa fa-search fa-2x" aria-hidden="true"></i>
            </a>
        </div>
        @if(Request::is('activity') or Request::is('me') or Request::is('shouts') or Request::is('home') or Request::is('settings'))


                {{--{{ config('app.name', 'idontknow') }}--}}
                @if(!$notifs->isEmpty())
                <div class="header-button">

                    <a class="header-notification-button" href="/notification">
                        <i class="fa fa-exclamation-circle fa-2x" aria-hidden="true" style="color: #F62E55;"></i>
                        @if(isset($_COOKIE['FG_Notifications']))
                        @if($_COOKIE['FG_Notifications'] > 0)
                            {{$_COOKIE['FG_Notifications']}}
                        @endif
                            @endif

                </a>
                </div>
                @else
                <div class="header-button">
                <a class="header-notification-button " href="/notification">

                        <i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i>

                    </a>
            </a>
                </div>
                @endif

                @else
            <div class="header-button">
                <a class="header-notification-button" href="/notification">

                            <i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i>

                </a>
            </div>
                @endif




        <div class="header-button">
            <a class="header-settings-button" href="#">
                {{--{{ config('app.name', 'idontknow') }}--}}
                <i class="fa fa-bars fa-2x" aria-hidden="true"></i>

            </a>
        </div>





</nav>

@endauth
@guest
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel ">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/home') }}">
                {{--{{ config('app.name', 'idontknow') }}--}}
                <img src="/images/frendgriddark.png" alt="FrendGrid" style="max-width: 45px;">

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
                        <li><a class="nav-link" href="/dashboard">{{ __('Dashboard') }}</a></li>
                    <li><a class="nav-link" href="/nearby">{{ __('Activity') }}</a></li>
                    @else
                        @if(Request::is('activity') or Request::is('me') or Request::is('shouts') or Request::is('home'))

                            <li class="nav-item dropdown">
                                @if(!$notifs->isEmpty())
                                    <a class="nav-link" href="/notification">
                                        <i class="fa fa-exclamation-circle" aria-hidden="true" style="color: #F62E55;"></i>

                                    </a>
                                @else
                                    <a class="nav-link" href="/notification">
                                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>

                                    </a>
                                @endif



                            </li>
@else
                            <a class="nav-link" href="/notification" >
                                <i class="fa fa-exclamation-circle" aria-hidden="true"></i>

                            </a>
                        @endif
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/dashboard">
                                    {{ __('Home') }}
                                </a>
                                <a class="dropdown-item" href="/me">
                                    {{ __('My Profile') }}
                                </a>
                                <a class="dropdown-item" href="/settings">
                                    {{ __('Settings') }}
                                </a>
                                <a class="dropdown-item" href="/dashboard">
                                    {{ __('Dashboard') }}
                                </a>
                                {{--<a class="dropdown-item" href="/apps">--}}
                                    {{--{{ __('Apps') }}--}}
                                {{--</a>--}}
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
    @endguest