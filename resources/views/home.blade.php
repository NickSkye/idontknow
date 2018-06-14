@extends('layouts.app')
<?php $page = 'home'; ?>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 no-padding">
                <div class="card">
                    {{--<div class="card-header">--}}

                       {{--Click on your name in the right corner then settings to upload profile pic--}}
                    {{--</div>--}}

                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                                <a class="close" data-dismiss="alert">×</a>
                            </div>
                            @elseif(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                                <a class="close" data-dismiss="alert">×</a>
                            </div>
                        @endif

                            <ul class="tabs">
                                {{--<li class="tab-link current" data-tab="tab-1">FrendGrid</li>--}}
                                <li class="tab-link current" data-tab="tab-1">FrendGrid</li>
                                <li class="tab-link" data-tab="tab-2">FollowerGrid</li>

                            </ul>

                            {{--<div id="tab-1" class="tab-content current">--}}
                                {{--<div class="row frend-area">--}}
                                    {{--need to include people who follow you that you also follow--}}
                                    {{--@foreach($allfriendsinfo as $infos)--}}
                                        {{--<a href="/users/{{$infos->followsusername}}" class="col-4 home-frends-images" style="background-image: url('{{$infos->profileimage}}');">--}}
                                            {{--<div class="frend-box">--}}
                                                {{--<p>{{$infos->followsusername}}</p>--}}
                                            {{--</div>--}}
                                        {{--</a>--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div id="tab-1" class="tab-content current">
                                <div class="row frend-area">

                                    @foreach($allfriendsinfo as $infos)
                                        @if(!in_array($infos->followsusername, $allwhoblocked))
                                        <a href="/users/{{$infos->followsusername}}" class="col-4 home-frends-images" style="background-image: url('{{$infos->profileimage}}');">
                                           <div class="online-status">


                                                   @foreach($online_frends as $frend)
                                                       {{--now {{Carbon\Carbon::parse($now->format('Y-m-d H:i:s'))}}--}}
                                                       {{--carbon {{$frend->username}} {{Carbon\Carbon::parse($frend->updated_at)->addMinutes(5)->format('Y-m-d H:i:s')}}--}}

                                                       @if($frend->username === $infos->followsusername)
                                                           @if(Carbon\Carbon::parse($now->format('Y-m-d H:i:s'))->format('Y-m-d H:i:s') < Carbon\Carbon::parse($frend->updated_at)->addMinutes(2)->format('Y-m-d H:i:s') )
                                                               <i class="fa fa-circle" style="color: lime;" aria-hidden="true"></i>
                                                           @elseif(Carbon\Carbon::parse($now->format('Y-m-d H:i:s'))->format('Y-m-d H:i:s') < Carbon\Carbon::parse($frend->updated_at)->addMinutes(5)->format('Y-m-d H:i:s') )
                                                               <i class="fa fa-circle" style="color: orange;" aria-hidden="true"></i>
                                                           @else
                                                               <i class="fa fa-circle" style="color: red;" aria-hidden="true"></i>
                                                           @endif

                                                       @endif





                                                   @endforeach
                                           </div>

                                            @foreach($frendsloc as $loc)
                                                @if($loc->followsusername === $infos->followsusername)
                                                    <div class="nearness">
                                                @if(round($loc->distance, 2) < 0.3)
                                                <span style="color: lime;">{{round($loc->distance, 2)}}</span>
                                                        @elseif(round($loc->distance, 2) < 1.0)
                                                            <span style="color: yellow;">{{round($loc->distance, 2)}}</span>
                                                    @elseif(round($loc->distance, 2) < 5.0)
                                                   <span style="color: orange;">{{round($loc->distance, 2)}}</span>
                                                    @else
                                                    <span style="color: red;">{{round($loc->distance, 2)}}</span>
                                                @endif
                                                        @endif
                                                        @endforeach
                                            </div>

                                            <div class="frend-box">
                                                <p>{{$infos->followsusername}}</p>
                                            </div>
                                        </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div id="tab-2" class="tab-content">
                                <div class="row frend-area">

                                    @foreach($allfollowersinfo as $followerinfos)
                                        @if(!in_array($followerinfos->username, $allwhoblocked))


                                        <a href="/users/{{$followerinfos->username}}" class="col-4 home-frends-images" style="background-image: url('{{$followerinfos->profileimage}}');">

                                            <div class="frend-box">
                                                <p style="font-size: 0.8rem;">{{$followerinfos->username}}</p>
                                            </div>
                                        </a>
@endif
                                    @endforeach
                                </div>
                            </div>

                            @if(($suggest->count() > 0))
                            <h5 style="text-align: center; margin-top: 30px;">Suggested Frends</h5>
                            @endif
                            <div class="infinite-scroll" style="overflow-x: scroll; overflow-y: hidden; width: 100%; padding: 15px;">
                                <div class="row frend-area" style="flex-wrap: nowrap;">

                                    @foreach($suggest as $sug)

                                        <a href="/users/{{$sug->username}}" class="col-4 suggest-image" id="suggest-{{$sug->username}}" style="background-image: url('{{$sug->profileimage}}');">
                                            <div class="frend-box-name">
                                                <p style="font-size: 0.8rem;">{{$sug->name}}</p>

                                            </div>
                                            {{--<div class="add-suggested-frend">--}}
                                            {{--<form method="post" id="add_frend_form"--}}
                                            {{--action="/addfrend/{{$sug->username}}">--}}
                                            {{--{{ csrf_field() }}--}}
                                            {{--<input type="hidden" name="{{$sug->username}}"--}}
                                            {{--value="{{$sug->username}}"/>--}}
                                            {{--<button class="btn btn-success add_frend_button" type="submit">--}}
                                            {{--<i class="fa fa-user-plus" aria-hidden="true"></i>--}}
                                            {{--</button>--}}
                                            {{--</form>--}}
                                            {{--</div>--}}
                                            <div class="frend-box" style="height: 25%;">
                                                <p style="font-size: 0.8rem;">{{round($sug->distance, 1)}} miles</p>

                                            </div>
                                        </a>
                                    @endforeach


                                </div>
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
