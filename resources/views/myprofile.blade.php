@extends('layouts.app')
<?php $page = 'me'; ?>
@section('content')
    <div class="container profile-page">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 no-padding">
                <div class="card ">
                    {{--<div class="card-header">--}}

                        {{--@include('partials.friendsearch')--}}
                        {{--@if (session('status'))--}}
                            {{--<div class="alert alert-success">--}}
                                {{--{{ session('status') }}--}}
                                {{--<a class="close" data-dismiss="alert">×</a>--}}
                            {{--</div>--}}
                        {{--@elseif(session('error'))--}}
                            {{--<div class="alert alert-danger">--}}
                                {{--{{ session('error') }}--}}
                                {{--<a class="close" data-dismiss="alert">×</a>--}}
                            {{--</div>--}}
                        {{--@endif--}}


                        {{--@if ($message = Session::get('success'))--}}
                            {{--<div class="alert alert-success alert-block">--}}
                                {{--<button type="button" class="close" data-dismiss="alert">×</button>--}}
                                {{--<strong>{{ $message }}</strong>--}}
                            {{--</div>--}}
                            {{--<img src="{{ Session::get('path') }}">--}}
                        {{--@endif--}}

                        {{--<div class="row">--}}

                            {{--<div class="col-6">--}}
                                {{--<a href="/settings">--}}
                                    {{--<img src="{{$generalinfo->profileimage}}" class="img-fluid img-there friend-page-image" alt="">--}}
                                {{--</a>--}}
                            {{--</div>--}}


                            {{--<div class="col-6">--}}

                                {{--<h2>{{$generalinfo->name}}</h2>--}}
                                {{--<h4>{{$generalinfo->username}}</h4>--}}
                                {{--BIRTHDAY STUFF--}}
                                {{--{{$generalinfo->birthday}}--}}
                                {{--{{Carbon\Carbon::today()}}--}}
                                {{--@if($generalinfo->birthday == Carbon\Carbon::today())--}}
                                {{--<img src="/images/birthday_gif.gif" alt="" style="width: 50px; height: 50px;">--}}
                                {{--@endif--}}
                                {{--END BIRTHDAY STUFF--}}
                                {{--<p>last active: {{Carbon\Carbon::parse($generalinfo->updated_at)->diffForHumans()}}</p>--}}

                                {{--<div class="profile-stats" style="display: flex; margin-bottom: 30px;">--}}
                                    {{--<div style="text-align: center; width: 75px;">--}}
                                        {{--<div>--}}
                                            {{--<p class="numbers">{{$numposts}}</p>--}}
                                        {{--</div>--}}
                                        {{--<div>--}}
                                            {{--<p class="words">Posts</p>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div style="text-align: center; width: 75px;">--}}
                                        {{--<div>--}}
                                            {{--<p class="numbers">{{$numfollowers}}</p>--}}
                                        {{--</div>--}}
                                        {{--<div>--}}
                                            {{--<p class="words">Followers</p>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div style="text-align: center; width: 75px;">--}}
                                        {{--<div>--}}
                                            {{--<p class="numbers">{{$numfollowing}}</p>--}}
                                        {{--</div>--}}
                                        {{--<div>--}}
                                            {{--<p class="words">Following</p>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}



                                {{--<div class="achievements-box row">--}}
                                    {{--<div class="col-2 col-sm-1">--}}

                                    {{--</div>--}}

                                {{--</div>--}}


                                {{--<p>{{$generalinfo->aboutme}}</p>--}}
                            {{--</div>--}}


                        {{--</div>--}}
                        {{--info about friend--}}

                    {{--</div>--}}
                    <div class="card-header" style="padding: 0; background-color: white;">
                        {{--@include('partials.friendsearch')--}}


                        <div class="header-controls">
                            <div class="pull-left left">
                                <a href="{{ URL::previous() }}"><i class="fa fa-angle-left fa-2x"
                                                                   aria-hidden="true"></i></a>
                            </div>
                            <div style="text-align: center;" class="center">
                                {{$generalinfo->username}} (you)
                            </div>
                            <div class="pull-right right">
                                <li class="nav-item dropdown pull-right" style="list-style-type: none;">
                                    <a id="navbarDropdown" class="nav-link" href="#" role="button"
                                       data-toggle="dropdown" aria-expanded="false">

                                        <i class="fa fa-ellipsis-v fa-2x" aria-hidden="true"></i>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown"
                                         style="text-align: center;">



                                    </div>
                                </li>
                            </div>

                        </div>


                        <div class="row under-control">
                            <div class="" style="width: 40%;">


                                {{--<img src="{{$info->profileimage}}" class="img-fluid img-there friend-page-image" alt="">--}}
                                <div class=" profile-image-frends-page "
                                     style="background-image: url('{{$generalinfo->profileimage}}');"></div>
                                <p style="margin-bottom: 0;">{{$generalinfo->name}}</p>






                            </div>
                            <div class="" style="width: 60%;">



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
                                        <a class="frendcollapse followerCollapser" data-toggle="collapse"
                                           href="#followerCollapse" role="button" aria-expanded="false"
                                           aria-controls="followerCollapse">
                                            <div>
                                                <p class="numbers">{{$numfollowers}}</p>
                                            </div>
                                            <div>
                                                <p class="words">Followers</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div style="text-align: center; width: 75px;">
                                        <a class=".frendcollapse followingCollapser" data-toggle="collapse"
                                           href="#followingCollapse" role="button" aria-expanded="false"
                                           aria-controls="followingCollapse">
                                            <div>
                                                <p class="numbers">{{$numfollowing}}</p>
                                            </div>
                                            <div>
                                                <p class="words">Following</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>



                                <p>{{$generalinfo->aboutme}}</p>





                                    <div class="row are-frends">

                                        <div class="col-xs-12 col-sm-10" style="display: flex; justify-content: space-around; align-items: center;">
                                            <a class="achievementcollapse achievementCollapser" data-toggle="collapse"
                                               href="#achievementCollapse" role="button" aria-expanded="false"
                                               aria-controls="followerCollapse" style="font-size: 25pt;">
                                                🏆
                                            </a>
                                            Score: {{$score->score}} points

                                        </div>
                                    </div>


                            </div>
                        </div>

                        {{--<div class="achievements-mobile">--}}
                        {{--@foreach($achievements as $achievement)--}}
                        {{--{{$achievement->achievement}}--}}
                        {{--@endforeach--}}

                        {{--</div>--}}
                        {{--Achievements collapse--}}
                        <div class="collapse" id="achievementCollapse">
                            <div class="card card-body text-center">
                                Achievements
                                <div class="row frend-area frends-frends-row multiple-items" >
                                    <div style="display: flex; overflow-x: scroll; overflow-y: hidden; width: 100%; height: 75px;">
                                        @foreach($achievements as $achievement)
                                            <div style="width: 20%; min-width: 125px;">
                                                <p style="margin-bottom: 0; font-size: 25pt;">{{$achievement->achievement}}</p>
                                                <p>{{$achievement->title}}</p>
                                            </div>




                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{--Friends followers--}}
                        <div class="collapse" id="followerCollapse">
                            <div class="card card-body">
                                followers
                                <div class="row frend-area frends-frends-row multiple-items">
                                    @foreach($allfollowersinfo as $followerinfos)
                                        <a href="/users/{{$followerinfos->username}}"
                                           class="col-4 frends-frends-images "
                                           style="background-image: url('{{$followerinfos->profileimage}}');">
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
                                        <a href="/users/{{$infos->followsusername}}" class="col-4 frends-frends-images "
                                           style="background-image: url('{{$infos->profileimage}}');">
                                            <div class="frend-box">
                                                <p>{{$infos->followsusername}}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                    </div>
                    {{--NEW END HERE--}}
                    <div class="card-body" style="padding: 0 1rem 0 1rem;">

                        <div>

                            {{--my posts--}}
                            <div class="row frend-area ">
                                @foreach($myposts as $post)
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
                        @foreach($real as $r)
                            <div>{{$r->username}} - {{$r->followsusername}}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
