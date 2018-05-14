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

                            <ul class='tabs'>
                                <li><a href='#tab1'>Tab 1</a></li>
                                <li><a href='#tab2'>Tab 2</a></li>
                                <li><a href='#tab3'>Tab 3</a></li>
                            </ul>
                            <div id='tab1'>
                                <p>Hi, this is the first tab.</p>
                            </div>
                            <div id='tab2'>
                                <p>This is the 2nd tab.</p>
                            </div>
                            <div id='tab3'>
                                <p>And this is the 3rd tab.</p>
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
