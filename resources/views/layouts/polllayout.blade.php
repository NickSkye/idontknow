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
        {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=0"/>


        <meta name="description" content="Your friends at your fingertips. Connect to frends all around you in real life."/>
        <meta name="keywords" content="social, media, social media, college, friends, near me, nearby, facebook, instagram"/>
        <meta name="author" content="Nicholas Skye Hoyt"/>
        <link rel="canonical" href="https://frendgrid.com/"/>
        <meta name="dc.language" content="en">
        <meta http-equiv="Content-Language" content="en">


        <link rel="publisher" href="https://intelliskye.com/"/>
        <meta name="robots" content="all"/>
        <meta name="robots" content="index, follow"/>
        <meta name="revisit-after" content="4 days"/>
        <link rel="icon" href="{{ asset('images/frendgriddark.png') }}">

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

        $(function() {
            $('.infinite-scroll-two').jscroll({
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
            $( "#datepicker" ).datepicker({
                yearRange: "-100:+0"
            });
        } );
        </script>
        <script src="linkify.min.js"></script>
        <script src="linkify-jquery.min.js"></script>
        <script src="dist/clipboard.min.js"></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    @guest
    <body class="skybg" >
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId            : '265358810920975',
                autoLogAppEvents : true,
                xfbml            : true,
                version          : 'v3.0'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0&appId=265358810920975&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        {{--style="background: linear-gradient(to bottom right, red, yellow);--}}
        {{--background-size: cover;"--}}
        @endguest
        @auth
        <body>
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    appId            : '265358810920975',
                    autoLogAppEvents : true,
                    xfbml            : true,
                    version          : 'v3.0'
                });
            };

            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));



        </script>
        @endauth

        <div id="app">
            {{--<div id="mobile-app-button" class="d-none mobile-app-div" >--}}

                    {{--Download our Mobile App--}}

            {{--</div>--}}


            @include('partials.navbar')

            <div class="collapse visible-on-small frend-search-down" id="collapseExample" >
                <div class="card card-body">
                    @include('partials.friendsearch')
                </div>
            </div>

            <main class="main py-4" >
                @yield('content')
                @include('partials.modals')
            </main>
            @auth
               
                {{--@include('partials.groupsmanager')--}}
                @include('partials.permafooter')
            @endauth
        </div>

        <script>
        function myFunction() {
            var copyText = document.getElementById("copytext");
            copyText.select();
            document.execCommand("copy");
            alert("Copied to clipboard: " + copyText.value);
        }
        </script>
    </body>
</html>
