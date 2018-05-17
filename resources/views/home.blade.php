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
                            </div>
                            @elseif(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
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



                                        <a href="/users/{{$infos->followsusername}}" class="col-4 home-frends-images" style="background-image: url('{{$infos->profileimage}}');">
                                           <div class="online-status">
                                               @foreach($allfriendsinfo as $infos)

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

                                            <div class="frend-box">
                                                <p>{{$infos->followsusername}}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div id="tab-2" class="tab-content">
                                <div class="row frend-area">

                                    @foreach($allfollowersinfo as $followerinfos)
                                        <a href="/users/{{$followerinfos->username}}" class="col-4 home-frends-images" style="background-image: url('{{$followerinfos->profileimage}}');">
                                            <div class="frend-box">
                                                <p>{{$followerinfos->username}}</p>
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
