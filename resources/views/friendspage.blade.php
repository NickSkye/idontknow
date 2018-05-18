@extends('layouts.app')
<?php $page = 'friends'; ?>
@section('content')
    <div class="container">


        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 no-padding">
                <div class="card">
                    <div class="card-header">
                        {{--@include('partials.friendsearch')--}}
                        <div class="row">
                            <div class="col-6">
                                @foreach($info as $item)

                                    <img src="{{$item->profileimage}}" class="img-fluid img-there friend-page-image" alt="">

                                    {{--info about friend--}}


                                    {{--an array of users that you follow--}}
                                    @if($arefriends)
                                        <div class="row">
                                            <div class="col-xs-12">
                                            <p>{{$item->username}} is your friend</p>
                                                <p style="font-size: 10px;">last active: {{Carbon\Carbon::parse($item->updated_at)->diffForHumans()}}</p>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-8">
                                                <form method="post" action="/removefrend/{{$item->username}}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="{{$item->username}}" value="{{$item->username}}"/>
                                                    <button class="btn btn-lg btn-warning" type="submit">
                                                        Remove Friend
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-xs-12 col-sm-4">
                                                <button type="button" class="btn add-button" data-toggle="modal" data-target="#sendShout">
                                                    <i aria-hidden="true" class="fa fa-bullhorn fa-2x"></i>
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
                                    @else
                                        <p>{{$item->username}} is not your friend yet</p>
                                        <form method="post" action="/addfrend/{{$item->username}}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="{{$item->username}}" value="{{$item->username}}"/>
                                            <button class="btn btn-lg btn-success" type="submit">
                                                Add Friend
                                            </button>
                                        </form>
                                    @endif


                            </div>
                            <div class="col-6">





                                <h2>{{$item->name}}</h2>
                                @foreach($online_frends as $frend)
                                    {{--now {{Carbon\Carbon::parse($now->format('Y-m-d H:i:s'))}}--}}
                                    {{--carbon {{$frend->username}} {{Carbon\Carbon::parse($frend->updated_at)->addMinutes(5)->format('Y-m-d H:i:s')}}--}}

                                    @if($frend->username === $item->username)
                                        @if(Carbon\Carbon::parse($now->format('Y-m-d H:i:s'))->format('Y-m-d H:i:s') < Carbon\Carbon::parse($frend->updated_at)->addMinutes(2)->format('Y-m-d H:i:s') )
                                            <i class="fa fa-circle" style="color: lime;" aria-hidden="true"></i>
                                        @elseif(Carbon\Carbon::parse($now->format('Y-m-d H:i:s'))->format('Y-m-d H:i:s') < Carbon\Carbon::parse($frend->updated_at)->addMinutes(5)->format('Y-m-d H:i:s') )
                                            <i class="fa fa-circle" style="color: orange;" aria-hidden="true"></i>
                                        @else
                                            <i class="fa fa-circle" style="color: red;" aria-hidden="true"></i>
                                        @endif
                                        {{$item->username}}
                                        @if($item->username ===  Auth::user()->username )
                                            (you)
                                        @endif
                                    @endif





                                @endforeach

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


                                <p>{{$item->aboutme}}</p>
                                @endforeach
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
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>

                            {{--friends posts--}}
                            <div class="row frend-area">
                                @foreach($friendsposts as $post)
                                    <div class="col-12">

                                        <div class="frend-post-box">
                                            <p>{{Carbon\Carbon::parse($post->created_at)->format('d M Y g:i A')}}</p>
                                            <a href="/post/{{$post->id}}">
                                                <p>{{$post->description}}</p>
                                                <img src="{{$post->imagepath}}" class="img-fluid tiny-img" alt="" style="margin-bottom: 30px;">

                                            </a>
                                            {{--{{ $friend }}--}}
                                            @include('partials.commentfield')
                                            <hr>
                                        </div>

                                    </div>


                                @endforeach
                            </div>

                        </div>


                    </div>
                    <div class="card-footer">
                        <div>UPLOAD IMAGE BUTTON HERE</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
