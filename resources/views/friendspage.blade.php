@extends('layouts.app')
<?php $page = 'friends'; ?>
@section('content')
    <div class="container">





        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Remove Frend</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to remove {{$info->username}} from your frends?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form method="post" id="remove_frend_form" action="/removefrend/{{$info->username}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="{{$info->username}}" value="{{$info->username}}"/>
                            <button class="btn btn-warning" type="submit">
                                <i class="fa fa-user-times fa-2x" aria-hidden="true"></i>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>



        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 no-padding">
                <div class="card">
                    <div class="card-header" style="padding: 0; background-color: white;">
                        {{--@include('partials.friendsearch')--}}


                        <div class="header-controls">
                            <div class="pull-left left">
                                <a href="{{ URL::previous() }}"><i class="fa fa-angle-left fa-2x" aria-hidden="true"></i></a>
                            </div>
                            <div style="text-align: center;" class="center">
                                @include('partials.useronline')
                            </div>
                            <div class="pull-right right">
                                <li class="nav-item dropdown pull-right" style="list-style-type: none;">
                                    <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown"  aria-expanded="false" >

                                        <i class="fa fa-ellipsis-v fa-2x" aria-hidden="true"></i>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="text-align: center;">
                                        @if($info->username != Auth::user()->username)
                                            <a  style="color: red; width: 100%;" data-toggle="modal" href="#deleteModal">
                                                Remove Frend
                                            </a>

                                        @endif


                                    </div>
                                </li>
                            </div>

                        </div>


                        <div class="row under-control" >
                            <div class="col-6">


                                {{--<img src="{{$info->profileimage}}" class="img-fluid img-there friend-page-image" alt="">--}}
                                <div  class=" profile-image-frends-page " style="background-image: url('{{$info->profileimage}}');"></div>

                                {{--info about friend--}}


                                {{--an array of users that you follow--}}
                                @if($info->username != Auth::user()->username)
                                @if($arefriends)
                                    <div class="are-frends">

                                            {{--<p>{{$info->username}} is your friend</p>--}}
                                            {{--@include('partials.useronline')--}}
                                            <p style="font-size: 10px; margin-bottom: 0;">last active: {{Carbon\Carbon::parse($info->updated_at)->diffForHumans()}}</p>
                                            <p style="font-size: 10px;">and {{round($frendsloc->distance, 2)}} miles from you </p>


                                    </div>
                                    <div class="arent-frends d-none">
                                        <p>{{$info->username}} is not your friend yet</p>
                                        <form method="post"  id="add_frend_form" action="/addfrend/{{$info->username}}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="{{$info->username}}" value="{{$info->username}}"/>
                                            <button class="btn btn-success add_frend_button" type="submit">
                                                <i class="fa fa-user-plus fa-2x" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="are-frends d-none">

                                                {{--<p>{{$info->username}} is your friend</p>--}}
                                                {{--@include('partials.useronline')--}}
                                                <p style="font-size: 10px;">last active: {{Carbon\Carbon::parse($info->updated_at)->diffForHumans()}}</p>

                                        {{--<div class="row">--}}
                                            {{--<div class="col-xs-12 col-sm-8">--}}
                                                {{--<form method="post"  id="remove_frend_form" action="/removefrend/{{$info->username}}">--}}
                                                    {{--{{ csrf_field() }}--}}
                                                    {{--<input type="hidden" name="{{$info->username}}" value="{{$info->username}}"/>--}}
                                                    {{--<button class="btn btn-warning" type="submit">--}}
                                                        {{--<i class="fa fa-user-times fa-2x" aria-hidden="true"></i>--}}
                                                    {{--</button>--}}
                                                {{--</form>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-xs-12 col-sm-4">--}}
                                                {{--<button type="button" class="add-button" data-toggle="modal" data-target="#sendShout">--}}
                                                    {{--Shout!--}}
                                                {{--</button>--}}
                                                {{--SHOUT MODAL--}}
                                                {{--<div class="modal fade" id="sendShout" tabindex="-1" role="dialog" aria-labelledby="sendshoutModalLabel" aria-hidden="true">--}}
                                                    {{--<div class="modal-dialog" role="document">--}}
                                                        {{--<div class="modal-content">--}}
                                                            {{--<div class="modal-header">--}}
                                                                {{--<h5 class="modal-title" id="sendshoutModalLabel">Shout!</h5>--}}
                                                                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                                                                    {{--<span aria-hidden="true">&times;</span>--}}
                                                                {{--</button>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="modal-body">--}}
                                                                {{--@include('partials.shoutonfriendspage')--}}
                                                            {{--</div>--}}
                                                            {{--<div class="modal-footer">--}}
                                                            {{--<button type="button" class="btn btn-primary">Shout Back!</button>--}}
                                                            {{--<button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Close</button>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--END SHOUT MODAL--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    </div>
                                    <div class="arent-frends">
                                    <p>{{$info->username}} is not your friend yet</p>
                                    <form method="post"  id="add_frend_form" action="/addfrend/{{$info->username}}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="{{$info->username}}" value="{{$info->username}}"/>
                                        <button class="btn btn-lg btn-success add_frend_button" type="submit">
                                            <i class="fa fa-user-plus fa-2x" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                    </div>
                                @endif
                                    @endif


                            </div>
                            <div class="col-6">



                                <h3>{{$info->name}}</h3>
                                {{--@foreach($online_frends as $frend)--}}
                                    {{--now {{Carbon\Carbon::parse($now->format('Y-m-d H:i:s'))}}--}}
                                    {{--carbon {{$frend->username}} {{Carbon\Carbon::parse($frend->updated_at)->addMinutes(5)->format('Y-m-d H:i:s')}}--}}

                                    {{--@if($frend->username === $info->username)--}}
                                        {{--@if(Carbon\Carbon::parse($now->format('Y-m-d H:i:s'))->format('Y-m-d H:i:s') < Carbon\Carbon::parse($frend->updated_at)->addMinutes(2)->format('Y-m-d H:i:s') )--}}
                                            {{--<i class="fa fa-circle" style="color: lime;" aria-hidden="true"></i>--}}
                                        {{--@elseif(Carbon\Carbon::parse($now->format('Y-m-d H:i:s'))->format('Y-m-d H:i:s') < Carbon\Carbon::parse($frend->updated_at)->addMinutes(5)->format('Y-m-d H:i:s') )--}}
                                            {{--<i class="fa fa-circle" style="color: orange;" aria-hidden="true"></i>--}}
                                        {{--@else--}}
                                            {{--<i class="fa fa-circle" style="color: red;" aria-hidden="true"></i>--}}
                                        {{--@endif--}}
                                        {{--{{$info->username}}--}}
                                        {{--@if($info->username ===  Auth::user()->username )--}}
                                            {{--(you)--}}
                                        {{--@endif--}}
                                    {{--@endif--}}

                                {{--@endforeach--}}

                                <div class="profile-stats" style="display: flex; margin-bottom: 30px;">
                                    <div style="text-align: center; width: 75px;">
                                        <div>
                                            <p class="numbers">{{$numposts}}</p>
                                        </div>
                                        <div>
                                            <p class="words">Posts</p>
                                        </div>
                                    </div>
                                    <div style="text-align: center; width: 75px;">
                                        <a class="frendcollapse followerCollapser" data-toggle="collapse" href="#followerCollapse" role="button" aria-expanded="false" aria-controls="followerCollapse">
                                            <div>
                                                <p class="numbers">{{$numfollowers}}</p>
                                            </div>
                                            <div>
                                                <p class="words">Followers</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div style="text-align: center; width: 75px;">
                                        <a class=".frendcollapse followingCollapser" data-toggle="collapse" href="#followingCollapse" role="button" aria-expanded="false" aria-controls="followingCollapse">
                                            <div>
                                                <p class="numbers">{{$numfollowing}}</p>
                                            </div>
                                            <div>
                                                <p class="words">Following</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="achievements-box">


                                </div>


                                <p>{{$info->aboutme}}</p>
                                @if($arefriends)
                                <div class="row">

                                    <div class="col-xs-12 col-sm-4">
                                        <button type="button" class="add-button" data-toggle="modal" data-target="#sendShout">
                                            Shout!
                                        </button>
                                        {{--SHOUT MODAL--}}
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
                                                        @include('partials.shoutonfriendspage')
                                                    </div>
                                                    {{--<div class="modal-footer">--}}
                                                    {{--<button type="button" class="btn btn-primary">Shout Back!</button>--}}
                                                    {{--<button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Close</button>--}}
                                                    {{--</div>--}}
                                                </div>
                                            </div>
                                        </div>
                                        {{--END SHOUT MODAL--}}
                                    </div>
                                </div>
                                    @endif

                            </div>
                        </div>
                        {{--Friends followers--}}
                        <div class="collapse" id="followerCollapse">
                            <div class="card card-body">
                                followers
                                <div class="row frend-area frends-frends-row multiple-items">
                                    @foreach($allfollowersinfo as $followerinfos)
                                        <a href="/users/{{$followerinfos->username}}" class="col-4 frends-frends-images " style="background-image: url('{{$followerinfos->profileimage}}');">
                                            <div class="frend-box">
                                                <p>{{$followerinfos->username}}</p>
                                            </div>
                                        </a>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                        {{--Friends following--}}
                        <div class="collapse" id="followingCollapse">
                            <div class="card card-body">
                                following
                                <div class="row frend-area frends-frends-row multiple-items">
                                    @foreach($allfriendsinfo as $infos)
                                        <a href="/users/{{$infos->followsusername}}" class="col-4 frends-frends-images " style="background-image: url('{{$infos->profileimage}}');">
                                            <div class="frend-box">
                                                <p>{{$infos->followsusername}}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                    </div>
                    {{--OLD WAY OF DOING IT--}}
                    {{--<div class="card-body">--}}
                        {{--@if (session('status'))--}}
                            {{--<div class="alert alert-success">--}}
                                {{--{{ session('status') }}--}}
                            {{--</div>--}}
                        {{--@endif--}}
                        {{--<div>--}}

                            {{--friends posts--}}
                            {{--<div class="row frend-area">--}}
                                {{--@foreach($friendsposts as $post)--}}
                                    {{--<div class="col-12">--}}

                                        {{--<div class="frend-post-box frend-post">--}}


                                            {{--<div class="card">--}}
                                                {{--<div class="card-header">--}}
                                                {{--</div>--}}
                                                {{--<div class="card-body">--}}
                                                    {{--<div class="frend-post-header">--}}
                                                        {{--<a href="/users/{{$info->username}}">--}}
                                                            {{--<div style=" background-image: url('{{$info->profileimage}}');  width: 50px; height: 50px; background-size: cover; background-repeat: no-repeat; margin-right: 20px; background-position: center;">--}}
                                                            {{--</div>--}}
                                                        {{--</a>--}}
                                                        {{--<a href="/users/{{$info->username}}">--}}
                                                            {{--<p>{{$info->username}}</p>--}}
                                                            {{--<p style="font-size: 10pt;">shared: {{Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</p>--}}
                                                        {{--</a>--}}
                                                    {{--</div>--}}
                                                    {{--PUT LIKE POST AND DISLIKE POST FORMS HERE. ONE FORM FOR EACH--}}


                                                    {{--<p>{{$post->description}}</p>--}}
                                                    {{--<a href="/post/{{$post->id}}">--}}
                                                        {{--<img src="{{$post->imagepath}}" class="img-fluid activity-image" alt="">--}}

                                                        {{--<p style="font-size: 10pt;">view comments&nbsp;&gt;</p>--}}
                                                    {{--</a>--}}

                                                {{--</div>--}}
                                                {{--@include('partials.commentfield')--}}
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
                                                {{--<hr>--}}
                                            {{--</div>--}}




                                            {{--{{ $friend }}--}}

                                        {{--</div>--}}

                                    {{--</div>--}}


                                {{--@endforeach--}}
                            {{--</div>--}}

                        {{--</div>--}}


                    {{--</div>--}}
                    <div class="card-body" style="padding: 0 1rem 0 1rem;">

                        <div>

                            {{--my posts--}}
                            <div class="row frend-area ">
                                {{--@foreach($myposts as $post)--}}
                                @foreach($friendsposts as $post)
                                    {{--<a href="/post/{{$post->id}}">--}}
                                    {{--<div class="frend-post-box">--}}
                                    {{--<p>{{$post->description}}</p>--}}
                                    {{--<p class="post-data">views: {{$post->views}}</p>--}}
                                    {{--</div>--}}
                                    {{--</a>--}}
                                    @if (is_null($post->imagepath))

                                        <a href="/post/{{$post->id}}" class='square-box'>
                                            <div class='square-content'>
                                                <div>
                                                    <span>{{$post->description}}</span>
                                                </div>
                                            </div>

                                        </a>
                                    @else
                                        <a href="/post/{{$post->id}}" class="col-4 my-images" style="background-image: url('{{$post->imagepath}}'); "></a>

                                    @endif




                                @endforeach
                                {{--{{ $myposts->links() }}--}}
                            </div>

                        </div>


                    </div>
                    <div class="card-footer">
                        <div>The beginning of a beautiful FrendGrid</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
