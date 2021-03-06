@extends('layouts.dashboard')
<?php $page = 'about'; ?>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 no-padding">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    {{--<img src="{{ Session::get('path') }}">--}}
                @endif

                {{--MODAL FOR SHOUTS--}}


                <div class="modal fade" id="sendShout" tabindex="-1" role="dialog" aria-labelledby="sendshoutModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="sendshoutModalLabel">Shout!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                            </div>
                            {{--<div class="modal-footer">--}}
                            {{--<button type="button" class="btn btn-primary">Shout Back!</button>--}}
                            {{--<button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Close</button>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>

                {{--END MODALS FOR SHOUTS--}}

                <div class="card">
                    <div class="card-header">



                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                            <div>
                                <h1 style="text-align: center;">Welcome to FrendGrid!</h1>
                                <br><br>

                                <a href="https://itunes.apple.com/us/app/frendgrid/id1384206860?ls=1&mt=8" target="_blank" class="visible-xs visible-sm"><img src="/images/app-store-logo.png" alt="" style="width: 150px;"></a>
                                <p>*Or search FrendGrid on the App Store</p>
                                <br><br>
                                <h2>How to use FrendGrid</h2>
                                <br>
                                
                                <h3>1. Setting up your profile</h3>
                                <p>Go to your <a href="/settings">settings</a> and write a short bio about yourself, change your profile pic, and fill in whatever other info you want. You can always access the settings from the settings button <i aria-hidden="true" class="fa fa-bars"></i> on mobile or by clicking your name and then selecting settings from the dropdown on desktop.</p>
                                <br>

                                <h3>2. View Nearby Activity</h3>
                                <p><a href="/nearby">Nearby Activity</a> can be a good place to start to see whats going on around you and can help you find frends to follow. This can be viewed from the activity button <i aria-hidden="true" class="fa fa-list"></i> which is the second one from the left on the bottom and then clicking "Nearby Activity."</p>
                                <br>

                                <h3>3. Make Frends</h3>
                                <p>FrendGrid is all about connecting with your friends in real life and making new friends based off people you are near or bump into everyday. Frends can be searched for with the search bar up top with the magnifying glass <i class="fa fa-search"></i> or they will be suggested to you on your
                                    <a href="/">home screen.</a></p>
                                <br>

                                <h3>4. Notifications</h3>
                                <p>The <a href="/notification">Notifications Screen</a> is where you can view all current (colored) and past (greyed out) notifications. You can always access this screen from the exclamation point <i aria-hidden="true" class="fa fa-exclamation-circle" ></i> at the top of the screen. Here you can view if you've been mentioned in a post or comment, who you have bumped into, and if anyone has sent you a
                                    <a href="/shouts">Shout!</a></p>
                                <br>

                                <h3>5. Shouts</h3>
                                <p><a href="/shouts">Shout!</a> is FrendGrids instant messaging that disappears after it is viewed. You can send shouts to anyone you are frends with by clicking the megaphone <i aria-hidden="true" class="fa fa-bullhorn "></i> and then selecting the person you wish to shout and then writing a brief message. You can also shout at a frend directly from their profile page.</p>
                                <br>

                                <h3>6. Posts</h3>
                                <p>Creating a new posts for your frends to see can be done by clicking the bottom middle button <i aria-hidden="true" class="fa fa-plus"></i>. From there you can write whatever you want the world to see and include a picture if you want. You can mention frends with the @ symbol.</p>
                                <br>

                                <h3>7. Achievements</h3>
                                <p>FrendGrid gives you different awards for many different achievements you accomplish. You can see all your achievements on
                                    <a href="/me">your profile</a> by clicking the trophy 🏆. You can also view your frends achievements from their profile pages. New achievements are always being added!</p>
                                <br>

                                <h3>8. Home Page</h3>
                                <p><a href="/">Your Home page</a> is where you can keep track of all your frends. in the top right of each frend's picture is how far away from you they are (in miles). On mobile, in the top left corner of your frends picture will be a colored dot representing how long ago they were online (green = currently online, orange = active within the past 5 minutes, red = not online). This can be viewed on desktop by clicking the blue and red arrow tab in the top right of the screen which will reveal a list of your online frends. Frends are ordered on this page based on when they were last online (top left being most recently online, bottom right being online longest ago). Frend suggestions are below your frend grid.</p>
                                <br>

                            </div>
                        <div>

                           <h2>9. About FrendGrid</h2>
                            <br>
                            <p>FrendGrid was created for those looking to keep up with their current friends and help you meet new friends around you. The idea is simple; while most social media sites are trying to get you to have virtual friends through their websites, FrendGrid is here to help you keep up with and inspire you to meet up with people in the real world as well as meet new friends based on the people around you in your everyday life. FrendGrid is always expanding and adding new features which can be learned about here as they happen.</p>

                        </div>





                    </div>
                    <div class="card-footer">
                        @include('partials.footerlinks')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

