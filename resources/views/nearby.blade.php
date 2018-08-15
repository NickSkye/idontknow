@extends('layouts.app')
<?php $page = 'activity'; ?>
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


                <div class="card">
                    <div class="card-header">

                        @auth<h4><a href="/activity">Frend Activity</a> |
                            <a href="/nearby" style="color: #f62e55">Nearby Activity</a></h4>@endauth
                        @guest
                        <a href="/login" class="pull-right">{{ __('Login') }}</a>
                        @endguest
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>


                            {{--friends posts--}}
                            <div class="row frend-area infinite-scroll">
                                @auth
                                @foreach($allfriendsinfo as $friendspost)
                                    @if(!in_array($friendspost->username, $allwhoblocked))


                                        {{--COPY MODAL--}}
                                        <div class="modal fade" id="copyModal-{{$friendspost->id}}" tabindex="-1" role="dialog" aria-labelledby="copyModalLabel-{{$friendspost->id}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="copyModalLabel-{{$friendspost->id}}">Share Post</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="text" value="https://frendgrid.com/post/{{$friendspost->id}}" id="copytext" style="width: 100%; text-align: center;">

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button onclick="myFunction()" class="btn copybutton btn-primary">
                                                            <i class="fa fa-files-o fa-2x" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--END COPY MODAL--}}

                                        <div class="col-12 frend-post-col">

                                            <div class="frend-post-box activity-post">
                                                <div class="card">
                                                    {{--<div class="card-header">--}}
                                                    {{--</div>--}}
                                                    <div class="card-body">
                                                        <div class="activity-post-header">
                                                            <a href="/users/{{$friendspost->username}}">
                                                                <div style=" background-image: url('{{$friendspost->profileimage}}');  width: 50px; height: 50px; background-size: cover; background-repeat: no-repeat; margin-right: 20px; background-position: center;">
                                                                </div>
                                                            </a>
                                                            <a href="/users/{{$friendspost->username}}">
                                                                <p>{{$friendspost->username}}</p>
                                                                <p style="font-size: 10pt;">shared: {{Carbon\Carbon::parse($friendspost->created_at)->diffForHumans()}}</p>
                                                            </a>
                                                        </div>
                                                        {{--PUT LIKE POST AND DISLIKE POST FORMS HERE. ONE FORM FOR EACH--}}


                                                        <p>{!! preg_replace('/@([\w\-]+)/', '<a href="/users/$1">$0</a>', preg_replace('/(http|https|ftp|ftps|www)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', '<a href="$0">$0</a>', $friendspost->description) )!!}</p>
                                                        {{--<p>{!! preg_replace('/@([\w\-]+)/', '<a href="/users/$1">$0</a>', $friendspost->description) !!}</p>--}}
                                                        <a href="/post/{{$friendspost->id}}">
                                                            <img src="{{$friendspost->imagepath}}" class="img-fluid activity-image" alt="">

                                                            <p style="font-size: 10pt;">view comments&nbsp;&gt;</p>
                                                        </a>

                                                    </div>

                                                    {{--{{$post_votes}}--}}
                                                    {{--TEST--}}
                                                    <p class="post-views activity-post-views">views: {{$friendspost->views}}</p>
                                                    <div class="post-meta activity-meta">

                                                        {{--@foreach($post_votes as $pv)--}}
                                                        {{--@if($pv->post_id == $friendspost->id)--}}
                                                        <div class="post-data like-dislike-vote">
                                                            <form action="/like" method="post" id="like_form-{{$friendspost->id}}" class="activity-like-form">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="postid" value="{{$friendspost->id}}"/>
                                                                {{--<label for="submit"><i class="fa fa-heart fa-2x" aria-hidden="true"></i></label>--}}
                                                                <button class="post-data like like-{{$friendspost->id}}" type="submit" name="submit" value="" style="background: none; "/>

                                                                @if($friendspost->vote == 1)
                                                                    <i class="fa fa-heart fa-2x " style="color: red;" aria-hidden="true"></i>
                                                                @else
                                                                    <i class="fa fa-heart-o fa-2x " aria-hidden="true"></i>
                                                                    @endif

                                                                    </button>

                                                            </form>
                                                            <div id="server-results-{{$friendspost->id}}" style="text-align: center;" class="">{{$friendspost->votes}}</div>
                                                            <form action="/dislike" method="post" id="dislike_form-{{$friendspost->id}}" class="activity-dislike-form">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="postid" value="{{$friendspost->id}}"/>
                                                                {{--<label for="submit"><i class="fa fa-heart fa-2x" aria-hidden="true"></i></label>--}}
                                                                <button class="post-data dislike dislike-{{$friendspost->id}}" type="submit" name="submit" value="" style="background: none; "/>

                                                                @if($friendspost->vote == -1)
                                                                    <i class="fa fa-thumbs-down fa-2x " style="color: blue;" aria-hidden="true"></i>
                                                                @else
                                                                    <i class="fa fa-thumbs-o-down fa-2x" aria-hidden="true"></i>
                                                                    @endif

                                                                    </button>

                                                            </form>
                                                        </div>
                                                        {{--@endif--}}
                                                        {{--@endforeach--}}

                                                        <p class="post-data">
                                                            <a data-toggle="collapse" href="#commentCollapse-{{$friendspost->id}}" role="button" aria-expanded="false" aria-controls="commentCollapse-{{$friendspost->id}}"><i class="fa fa-comment-o fa-2x" aria-hidden="true"></i>{{$friendspost->comments}}
                                                            </a></p>
                                                        <p class="post-data">
                                                            <a data-toggle="modal" href="#copyModal-{{$friendspost->id}}"><i class="fa fa-share-alt fa-2x" aria-hidden="true"></i></a>
                                                        </p>

                                                    </div>


                                                    {{--END TEST--}}


                                                    <div class="collapse" id="commentCollapse-{{$friendspost->id}}">
                                                        <form action="{{ url('activitycomment') }}" method="POST" class="activity-comment">
                                                            {{ csrf_field() }}
                                                            <div class="row">
                                                                <div class="col-9">
                                                                    {{ Form::hidden('post_id', $friendspost->id) }}
                                                                    <input type="hidden" name="latitude" value=""/>
                                                                    <input type="hidden" name="longitude" value=""/>
                                                                    <textarea rows="2" cols="40" placeholder="Comment on this post..." type="text" class="activity-text" name="comment" style="width: 100%;"></textarea>

                                                                </div>
                                                                <div class="col-3 " style="display: flex;">
                                                                    <button type="submit" class="btn comment-button" style="height: 41px; align-self: flex-end;">
                                                                        <i class="fa fa-2x fa-paper-plane" aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>


                                        </div>

                                        <hr>


                                    @endif
                                @endforeach
                                @endauth


                                @guest
                                <h2 style="text-align: center;">Welcome to FrendGrid!</h2>
                                <br>
                                <h5><i class="fa fa-location-arrow fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Your location is NEVER shared with anyone. Only a general radius is collected in order to see who is close while Protecting your Privacy.</h5>
                                <br>
                                <h5><i class="fa fa-globe fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Connect with the world around you in real life</h5>
                                <br>
                                <h5><i class="fa fa-users fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Make new friends based off people around you</h5>
                                <br>
                                <h5><i class="fa fa-newspaper-o fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Share your life and see all the exciting stuff going on around you!</h5>
                                <br>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" placeholder="First & Last" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                        <div class="col-md-6">
                                            <input id="username" type="text" placeholder="Choose Wisely. Can't be changed." class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                            @if ($errors->has('username'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('username') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>

                                </form>
                                <br>
                                <p>*Make sure to enable location services for the fullest experience</p>


                            <div class="text-center"><h2>Here are some of the latest posts by users!</h2></div>

                            @foreach($allfriendsinfo as $friendspost)
                                <div class="col-12 frend-post-col">

                                    <div class="frend-post-box activity-post">
                                        <div class="card">
                                            {{--<div class="card-header">--}}
                                            {{--</div>--}}
                                            <div class="card-body">
                                                <div class="activity-post-header">
                                                    <a href="/users/{{$friendspost->username}}">
                                                        <div style=" background-image: url('{{$friendspost->profileimage}}');  width: 50px; height: 50px; background-size: cover; background-repeat: no-repeat; margin-right: 20px; background-position: center;">
                                                        </div>
                                                    </a>
                                                    <a href="/users/{{$friendspost->username}}">
                                                        <p>{{$friendspost->username}}</p>
                                                        <p style="font-size: 10pt;">shared: {{Carbon\Carbon::parse($friendspost->created_at)->diffForHumans()}}</p>
                                                    </a>
                                                </div>
                                                {{--PUT LIKE POST AND DISLIKE POST FORMS HERE. ONE FORM FOR EACH--}}


                                                <p>{!! preg_replace('/@([\w\-]+)/', '<a href="/users/$1">$0</a>', preg_replace('/(http|https|ftp|ftps|www)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', '<a href="$0">$0</a>', $friendspost->description) )!!}</p>
                                                {{--<p>{!! preg_replace('/@([\w\-]+)/', '<a href="/users/$1">$0</a>', $friendspost->description) !!}</p>--}}
                                                <a href="/post/{{$friendspost->id}}">
                                                    <img src="{{$friendspost->imagepath}}" class="img-fluid activity-image" alt="">

                                                    <p style="font-size: 10pt;">view comments&nbsp;&gt;</p>
                                                </a>

                                            </div>

                                            {{--{{$post_votes}}--}}
                                            {{--TEST--}}
                                            <p class="post-views activity-post-views">views: {{$friendspost->views}}</p>



                                            {{--END TEST--}}




                                        </div>
                                    </div>


                                </div>
                                    <hr>
                                @endforeach

                                @endguest


                                {{--{{ $allfriendsinfo->links() }}--}}
                            </div>

                        </div>


                    </div>
                    <div class="card-footer">
                        <div>Activity Page will show a list of all friends recent activity</div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
