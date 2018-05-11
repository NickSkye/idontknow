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
                        <div id="latitude"></div>
                        <div id="longitude"></div>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif


                        <div class="row frend-area">
                                @foreach($allfriendsinfo as $infos)
                                            <a href="/users/{{$infos->followsusername}}" class="col-4" style="max-width: 31.333333%; background-image: url('{{$infos->profileimage}}'); padding-bottom: 31.33333333%; width: 100%; height: 100%; background-size: cover; background-repeat: no-repeat; margin: 1%;">
                                                    <div class="frend-box">
                                                        <p>{{$infos->followsusername}}</p>
                                                    </div>
                                            </a>
                                @endforeach
                        </div>


                    </div>
                    <div class="card-footer">
                        Footer
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
