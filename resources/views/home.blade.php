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
                        @endif

                            <ul class="tabs">
                                <li class="tab-link current" data-tab="tab-1">FrendGrid</li>
                                <li class="tab-link" data-tab="tab-2">FollowerGrid</li>
                                <li class="tab-link" data-tab="tab-3">FollowGrid</li>

                            </ul>

                            <div id="tab-1" class="tab-content current">
                                <div class="row frend-area">
                                    @foreach($allfriendsinfo as $infos)
                                        <a href="/users/{{$infos->followsusername}}" class="col-4 home-frends-images" style="background-image: url('{{$infos->profileimage}}');">
                                            <div class="frend-box">
                                                <p>{{$infos->followsusername}}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div id="tab-2" class="tab-content">
                                <div class="row frend-area">
                                    @foreach($allfriendsinfo as $infos)
                                        <a href="/users/{{$infos->followsusername}}" class="col-4 home-frends-images" style="background-image: url('{{$infos->profileimage}}');">
                                            <div class="frend-box">
                                                <p>{{$infos->followsusername}}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div id="tab-3" class="tab-content">
                                <div class="row frend-area">
                                    @foreach($allfriendsinfo as $infos)
                                        <a href="/users/{{$infos->followsusername}}" class="col-4 home-frends-images" style="background-image: url('{{$infos->profileimage}}');">
                                            <div class="frend-box">
                                                <p>{{$infos->followsusername}}</p>
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
