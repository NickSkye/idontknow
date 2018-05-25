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

                        <h4><a href="/activity">Frend Activity</a> | <a href="/nearby">Nearby Activity</a></h4>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>

                            {{--<ul class="tabs">--}}
                                {{--<li class="tab-link current" data-tab="tab-1">Frends</li>--}}
                                {{--<li class="tab-link" data-tab="tab-2">Following</li>--}}
                                {{--<li class="tab-link" data-tab="tab-3">Followers</li>--}}

                            {{--</ul>--}}

                            {{--<div id="tab-1" class="tab-content current">--}}

                            {{--</div>--}}
                            {{--<div id="tab-2" class="tab-content">--}}
                                {{--<div class="row frend-area infinite-scroll">--}}
                                    {{--@foreach($allfriendsinfo as $friendspost)--}}

                                        {{--<div class="col-12 frend-post-col">--}}

                                            {{--<div class="frend-post-box activity-post">--}}
                                                {{--<div class="card">--}}
                                                    {{--<div class="card-header">--}}

                                                    {{----}}


                                                    {{--</div>--}}
                                                    {{--<div class="card-body">--}}
                                                        {{--<div class="activity-post-header">--}}
                                                            {{--<a href="/users/{{$friendspost->username}}"><div style=" background-image: url('{{$friendspost->profileimage}}');  width: 50px; height: 50px; background-size: cover; background-repeat: no-repeat; margin-right: 20px;">--}}
                                                                {{--</div></a>--}}
                                                            {{--<a href="/users/{{$friendspost->username}}">--}}
                                                                {{--<p>{{$friendspost->username}}</p>--}}
                                                                {{--<p style="font-size: 10pt;">shared: {{Carbon\Carbon::parse($friendspost->created_at)->format('d M Y g:i A')}}</p>--}}
                                                            {{--</a>--}}
                                                        {{--</div>--}}
                                                        {{--PUT LIKE POST AND DISLIKE POST FORMS HERE. ONE FORM FOR EACH--}}
                                                        {{--<p>{{$friendspost->description}}</p>--}}
                                                        {{--<a href="/post/{{$friendspost->id}}">--}}
                                                            {{--<img src="{{$friendspost->imagepath}}" class="img-fluid activity-image" alt="">--}}

                                                            {{--<p>view comments&nbsp;&gt;</p>--}}
                                                        {{--</a>--}}

                                                    {{--</div>--}}
                                                    {{--<div class="card-footer">--}}
                                                        {{--<div>--}}
                                                            {{--<form action="{{ url('comment') }}" method="POST">--}}
                                                                {{--{{ csrf_field() }}--}}
                                                                {{--<div class="row">--}}
                                                                    {{--<div class="col-9">--}}
                                                                        {{--{{ Form::hidden('post_id', $friendspost->id) }}--}}
                                                                        {{--<input type="hidden" name="latitude" value=""/>--}}
                                                                        {{--<input  type="hidden" name="longitude" value=""/>--}}
                                                                        {{--<textarea rows="2" cols="40" placeholder="Comment on this post..." type="text" name="comment" style="width: 100%;"></textarea>--}}

                                                                    {{--</div>--}}
                                                                    {{--<div class="col-3 " style="display: flex;">--}}
                                                                        {{--<button type="submit" class="btn comment-button" style="height: 41px; align-self: flex-end;"><i class="fa fa-2x fa-paper-plane" aria-hidden="true"></i></button>--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}
                                                            {{--</form>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}


                                        {{--</div>--}}

                                        {{--<hr>--}}



                                    {{--@endforeach--}}
                                    {{--{{ $allfriendsinfo->links() }}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div id="tab-3" class="tab-content">--}}
                                {{--<div class="row frend-area infinite-scroll-two">--}}
                                    {{--@foreach($allfollowersinfo as $followerspost)--}}

                                        {{--<div class="col-12 frend-post-col">--}}

                                            {{--<div class="frend-post-box activity-post">--}}
                                                {{--<div class="card">--}}
                                                    {{--<div class="card-header">--}}

                                                    {{----}}


                                                    {{--</div>--}}
                                                    {{--<div class="card-body">--}}
                                                        {{--<div class="activity-post-header">--}}
                                                            {{--<a href="/users/{{$followerspost->username}}"><div style=" background-image: url('{{$followerspost->profileimage}}');  width: 50px; height: 50px; background-size: cover; background-repeat: no-repeat; margin-right: 20px;">--}}
                                                                {{--</div></a>--}}
                                                            {{--<a href="/users/{{$followerspost->username}}">--}}
                                                                {{--<p>{{$followerspost->username}}</p>--}}
                                                                {{--<p style="font-size: 10pt;">shared: {{Carbon\Carbon::parse($followerspost->created_at)->format('d M Y g:i A')}}</p>--}}
                                                            {{--</a>--}}
                                                        {{--</div>--}}
                                                        {{--PUT LIKE POST AND DISLIKE POST FORMS HERE. ONE FORM FOR EACH--}}
                                                        {{--<p>{{$followerspost->description}}</p>--}}
                                                        {{--<a href="/post/{{$followerspost->id}}">--}}
                                                            {{--<img src="{{$followerspost->imagepath}}" class="img-fluid activity-image" alt="">--}}

                                                            {{--<p>view comments&nbsp;&gt;</p>--}}
                                                        {{--</a>--}}

                                                    {{--</div>--}}
                                                    {{--<div class="card-footer">--}}
                                                        {{--<div>--}}
                                                            {{--<form action="{{ url('comment') }}" method="POST">--}}
                                                                {{--{{ csrf_field() }}--}}
                                                                {{--<div class="row">--}}
                                                                    {{--<div class="col-9">--}}
                                                                        {{--{{ Form::hidden('post_id', $followerspost->id) }}--}}
                                                                        {{--<input type="hidden" name="latitude" value=""/>--}}
                                                                        {{--<input  type="hidden" name="longitude" value=""/>--}}
                                                                        {{--<textarea rows="2" cols="40" placeholder="Comment on this post..." type="text" name="comment" style="width: 100%;"></textarea>--}}

                                                                    {{--</div>--}}
                                                                    {{--<div class="col-3 " style="display: flex;">--}}
                                                                        {{--<button type="submit" class="btn comment-button" style="height: 41px; align-self: flex-end;"><i class="fa fa-2x fa-paper-plane" aria-hidden="true"></i></button>--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}
                                                            {{--</form>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}


                                        {{--</div>--}}

                                        {{--<hr>--}}



                                    {{--@endforeach--}}
                                    {{--{{ $allfollowersinfo->links() }}--}}
                                {{--</div>--}}
                            {{--</div>--}}


                            {{--friends posts--}}
                            <div class="row frend-area infinite-scroll">
                                @foreach($allfriendsinfo as $friendspost)

                                        <div class="col-12 frend-post-col">

                                            <div class="frend-post-box activity-post">
                                                <div class="card">
                                                    {{--<div class="card-header">--}}
                                                    {{--</div>--}}
                                                    <div class="card-body">
                                                        <div class="activity-post-header">
                                                        <a href="/users/{{$friendspost->username}}"><div style=" background-image: url('{{$friendspost->profileimage}}');  width: 50px; height: 50px; background-size: cover; background-repeat: no-repeat; margin-right: 20px; background-position: center;">
                                                            </div></a>
                                                        <a href="/users/{{$friendspost->username}}">
                                                            <p>{{$friendspost->username}}</p>
                                                            <p style="font-size: 10pt;">shared: {{Carbon\Carbon::parse($friendspost->created_at)->diffForHumans()}}</p>
                                                        </a>
                                                        </div>
                                                        {{--PUT LIKE POST AND DISLIKE POST FORMS HERE. ONE FORM FOR EACH--}}






                                                        <p>{!! preg_replace('/@([\w\-]+)/', '<a href="/users/$1">$0</a>', $friendspost->description) !!}</p>
                                                        <a href="/post/{{$friendspost->id}}">
                                                            <img src="{{$friendspost->imagepath}}" class="img-fluid activity-image" alt="">

                                                            <p style="font-size: 10pt;">view comments&nbsp;&gt;</p>
                                                        </a>

                                                    </div>


                                                    {{--TEST--}}
                                                    <p class="post-views activity-post-views">views: {{$friendspost->views}}</p>
                                                    <div class="post-meta activity-meta">

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

                                                        <p class="post-data"><a data-toggle="collapse" href="#commentCollapse-{{$friendspost->id}}" role="button" aria-expanded="false" aria-controls="commentCollapse-{{$friendspost->id}}"><i class="fa fa-comment-o fa-2x" aria-hidden="true"></i>{{$friendspost->comments}}</a></p>
                                                        <p class="post-data"><a href="#"><i class="fa fa-share-alt fa-2x" aria-hidden="true"></i></a></p>

                                                    </div>



                                                    {{--END TEST--}}



                                                        <div class="collapse"  id="commentCollapse-{{$friendspost->id}}">
                                                            <form action="{{ url('activitycomment') }}" method="POST" class="activity-comment">
                                                                {{ csrf_field() }}
                                                                <div class="row">
                                                                    <div class="col-9">
                                                                        {{ Form::hidden('post_id', $friendspost->id) }}
                                                                        <input type="hidden" name="latitude" value=""/>
                                                                        <input  type="hidden" name="longitude" value=""/>
                                                                        <textarea rows="2" cols="40" placeholder="Comment on this post..." type="text" class="activity-text" name="comment" style="width: 100%;"></textarea>

                                                                    </div>
                                                                    <div class="col-3 " style="display: flex;">
                                                                        <button type="submit" class="btn comment-button" style="height: 41px; align-self: flex-end;"><i class="fa fa-2x fa-paper-plane" aria-hidden="true"></i></button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                </div>
                                            </div>


                                        </div>

                                    <hr>



                                @endforeach
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
