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

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <div id="mobile-app-button" class="d-none mobile-app-div" >

                    Download our Mobile App

            </div>


            @include('partials.navbar')

            <div class="collapse visible-on-small frend-search-down" id="collapseExample" >
                <div class="card card-body">
                    @include('partials.friendsearch')
                </div>
            </div>

            <main class="py-4">
                @yield('content')
                @include('partials.modals')
            </main>
            @auth
                @include('partials.onlinefrends')
                {{--@include('partials.groupsmanager')--}}
                @include('partials.permafooter')
            @endauth
        </div>


    </body>
</html>
