@extends('layouts.app')
<?php $page = 'notifications'; ?>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 no-padding">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    {{--<img src="{{ Session::get('path') }}">--}}
                @endif


                <div class="card">
                    <div class="card-header">

                        <h2>Notifications</h2>
                        <a class="" href="/clear-notifications" style="float: right; color: red;">
                            Clear all notifications
                        </a>
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
                                @foreach($notifs as $notif)
                                    <div class="col-12" style="display: flex; align-items: center;">
                                        <div class=" profile-image-shout-page "
                                             style="background-image: url('{{$notif->profileimage}}');"></div>
                                        <div>
                                        @if($notif->type == "shout")
                                            <a href="/shouts">You got a new shout from {{$notif->from_username}} {{ Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}</a>
                                            @elseif($notif->type == "comment")
                                            <a href="/post/{{$notif->route}}">{{$notif->from_username}} commented " {{$notif->notification}} " on your post {{ Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}</a>
                                        @elseif($notif->type == "postmention")
                                            <a href="/post/{{$notif->route}}">{{$notif->from_username}} mentioned you in their post: " {{$notif->notification}} " {{ Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}</a>
                                        @elseif($notif->type == "commentmention")
                                            <a href="/post/{{$notif->route}}">{{$notif->from_username}} mentioned you in their comment: " {{$notif->notification}} " {{ Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}</a>

                                        @else
                                            {!! $notif->notification !!} {{ Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}
                                            @endif
                                        </div>


                                        <hr>
                                    </div>
                                @endforeach
                            </div>

                        </div>


                    </div>
                    {{--<div class="card-footer">--}}
                        {{--<div>Activity Page will show a list of all friends recent activity</div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection

