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
                                <li class="tab-link current" data-tab="tab-1">Tab One</li>
                                <li class="tab-link" data-tab="tab-2">Tab Two</li>
                                <li class="tab-link" data-tab="tab-3">Tab Three</li>
                                <li class="tab-link" data-tab="tab-4">Tab Four</li>
                            </ul>

                            <div id="tab-1" class="tab-content current">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            </div>
                            <div id="tab-2" class="tab-content">
                                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>
                            <div id="tab-3" class="tab-content">
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                            </div>
                            <div id="tab-4" class="tab-content">
                                Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            </div>


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
                    <div class="card-footer">
                       @include('partials.footerlinks')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
