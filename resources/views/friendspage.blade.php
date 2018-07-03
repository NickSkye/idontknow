@extends('layouts.app')
<?php $page = 'friends'; ?>
@section('content')
    <div class="container">


        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
             aria-hidden="true">
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

        <div class="modal fade" id="blockModal" tabindex="-1" role="dialog" aria-labelledby="blockModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="blockModalLabel">Remove Frend</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to block {{$info->username}}?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form method="post" id="block_frend_form" action="/blockfrend/{{$info->username}}">
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

        <div class="modal fade" id="unblockModal" tabindex="-1" role="dialog" aria-labelledby="unblockModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="unblockModalLabel">Remove Frend</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to un-block {{$info->username}}?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form method="post" id="unblock_frend_form" action="/unblockfrend/{{$info->username}}">
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
                                <a href="{{ URL::previous() }}"><i class="fa fa-angle-left fa-2x"
                                                                   aria-hidden="true"></i></a>
                            </div>
                            <div style="text-align: center;" class="center">
                                @include('partials.useronline'){{$blocked}}
                            </div>
                            <div class="pull-right right">
                                <li class="nav-item dropdown pull-right" style="list-style-type: none;">
                                    <a id="navbarDropdown" class="nav-link" href="#" role="button"
                                       data-toggle="dropdown" aria-expanded="false">

                                        <i class="fa fa-ellipsis-v fa-2x" aria-hidden="true"></i>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown"
                                         style="text-align: center;">
                                        @if($info->username != Auth::user()->username)
                                            <a style="color: red; width: 100%;" data-toggle="modal" href="#deleteModal">
                                                Remove Frend
                                            </a><br>

                                        @endif

                                        @if($blocked)
                                                <a style="color: lime; width: 100%;" data-toggle="modal" href="#unblockModal">
                                                    Un-Block User
                                                </a><br>
                                            @else
                                                <a style="color: red; width: 100%;" data-toggle="modal" href="#blockModal">
                                                    Block User
                                                </a><br>
                                            @endif



                                    </div>
                                </li>
                            </div>

                        </div>


                        <div class="row under-control">
                            <div class="" style="width: 40%;">


                                {{--<img src="{{$info->profileimage}}" class="img-fluid img-there friend-page-image" alt="">--}}
                                <div class=" profile-image-frends-page "
                                     style="background-image: url('{{$info->profileimage}}');"></div>
                                <p style="margin-bottom: 0;">{{$info->name}}</p>


                                {{--Under Profile pic left side--}}
                                @if($info->username != Auth::user()->username)
                                    @if($arefriends)
                                        <div class="are-frends">

                                            {{--<p>{{$info->username}} is your friend</p>--}}
                                            {{--@include('partials.useronline')--}}
                                            <p style="font-size: 10px; margin-bottom: 0;">last
                                                active: {{Carbon\Carbon::parse($info->updated_at)->diffForHumans()}}</p>
                                            @if(!(($info->latitude == 0) and ($info->longitude == 0)))
                                            @if(round($frendsloc->distance, 2) < 0.3)
                                            <p style="font-size: 10px; color: lime; margin-bottom: 0;">and {{round($frendsloc->distance, 2)}} miles
                                                from you </p>
                                                <button type="button" class="hangout-button" data-toggle="modal"
                                                        data-target="#hangout">
                                                    Hang Out
                                                </button>
                                                @include('partials.hangout')
                                                @else

                                                <p style="font-size: 10px;">and {{round($frendsloc->distance, 2)}} miles
                                                    from you </p>
                                                    @endif
                                            @endif


                                        </div>
                                        <div class="arent-frends d-none">
                                            <p>{{$info->username}} is not your friend yet</p>
                                            <form method="post" id="add_frend_form"
                                                  action="/addfrend/{{$info->username}}">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="{{$info->username}}"
                                                       value="{{$info->username}}"/>
                                                <button class="btn btn-success add_frend_button" type="submit">
                                                    <i class="fa fa-user-plus fa-2x" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </div>

                                        @else
                                        <div class="arent-frends">
                                        <form method="post" id="add_frend_form"
                                              action="/addfrend/{{$info->username}}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="{{$info->username}}"
                                                   value="{{$info->username}}"/>
                                            <button class="btn btn-success add_frend_button" type="submit">
                                                <i class="fa fa-user-plus fa-2x" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </div>

                                    @endif
                                @endif


                            </div>
                            <div class="" style="width: 60%;">


                                {{--<h3>{{$info->name}}</h3>--}}

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



                                <p>{{$info->aboutme}}</p>


                                {{--<div class="achievements-desktop">--}}
                                    {{--@foreach($achievements as $achievement)--}}
                                        {{--{{$achievement->achievement}}--}}
                                    {{--@endforeach--}}

                                {{--</div>--}}


                                @if($arefriends)
                                    <div class="row are-frends">

                                        <div class="col-xs-12 col-sm-10" style="display: flex; justify-content: space-around; align-items: center;">
                                            <a class="achievementcollapse achievementCollapser" data-toggle="collapse"
                                               href="#achievementCollapse" role="button" aria-expanded="false"
                                               aria-controls="followerCollapse" style="font-size: 25pt;">
                                               🏆
                                            </a>
                                            <p>Score: {{$score->score}} points</p>

                                            <button type="button" class="add-button" data-toggle="modal"
                                                    data-target="#sendShout">
                                                Shout!
                                            </button>
                                            {{--SHOUT MODAL--}}
                                            <div class="modal fade" id="sendShout" tabindex="-1" role="dialog"
                                                 aria-labelledby="sendshoutModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="sendshoutModalLabel">Shout!</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
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
                                    {{--<div class="arent-frends d-none">--}}
                                        {{--<p>{{$info->username}} is not your friend yet</p>--}}
                                        {{--<form method="post" id="add_frend_form"--}}
                                              {{--action="/addfrend/{{$info->username}}">--}}
                                            {{--{{ csrf_field() }}--}}
                                            {{--<input type="hidden" name="{{$info->username}}"--}}
                                                   {{--value="{{$info->username}}"/>--}}
                                            {{--<button class="btn btn-success add_frend_button" type="submit">--}}
                                                {{--<i class="fa fa-user-plus fa-2x" aria-hidden="true"></i>--}}
                                            {{--</button>--}}
                                        {{--</form>--}}
                                    {{--</div>--}}
                                    @else



                                @endif

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
                                        <a href="/post/{{$post->id}}" class="col-4 my-images"
                                           style="background-image: url('{{$post->imagepath}}'); "></a>

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
