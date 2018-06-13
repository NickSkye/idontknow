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
                                    <div class="col-12 notification-row" style="display: flex; align-items: center; border-bottom: 1px solid lightgrey;">
                                        <a href="/users/{{$notif->from_username}}" class=" profile-image-shout-page "
                                             style="background-image: url('{{$notif->profileimage}}');">

                                        </a>

                                        <div class="notification-type">

                                        </div>

                                        <div style="margin-left: 30px; margin-right: 40px; ">
                                        @if($notif->type == "shout")
                                            <a href="/shouts">You got a new shout<br>from {{$notif->from_username}} {{ Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}</a>
                                            @elseif($notif->type == "comment")
                                            <a href="/post/{{$notif->route}}">{{$notif->from_username}} commented " {{$notif->notification}} " on your post {{ Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}</a>
                                        @elseif($notif->type == "postmention")
                                            <a href="/post/{{$notif->route}}">{{$notif->from_username}} mentioned you in their post: " {{$notif->notification}} " {{ Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}</a>
                                        @elseif($notif->type == "commentmention")
                                            <a href="/post/{{$notif->route}}">{{$notif->from_username}} mentioned you in their comment: " {{$notif->notification}} " {{ Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}</a>
                                            @elseif($notif->type == "frendadd")
                                                <a href="/users/{{$notif->route}}">{{$notif->from_username}} {{$notif->notification}} {{ Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}</a>
                                            @elseif($notif->type == "bump")
                                                <a href="/users/{{$notif->route}}">You {{$notif->notification}} {{$notif->from_username}} {{ Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}</a>

                                        @else
                                            {!! $notif->notification !!} {{ Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}
                                            @endif
                                        </div>

                                        <div class="delete-notification">
                                            <form action="/delete-notification/{{$notif->id}}" method="POST">
                                                {{ csrf_field() }}

                                                        <button type="submit" class="delete-notification-button " >
                                                            <i
                                                                    class="fa fa-trash fa-2x"></i></button>

                                            </form>
                                        </div>

                                    </div>
                                @endforeach
                                    @foreach($oldnotifs as $oldnotif)


                                        <div class="col-12 notification-row" style="display: flex; align-items: center; background-color: #F5F5F5; border-bottom: 1px solid lightgrey;">
                                            <a href="/users/{{$oldnotif->from_username}}" class=" profile-image-shout-page old"
                                               style="background-image: url('{{$oldnotif->profileimage}}');">

                                            </a>

                                            <div class="notification-type">

                                            </div>

                                            <div style="margin-left: 30px; margin-right: 40px;">
                                                @if($oldnotif->type == "shout")
                                                    <a href="/shouts">You got a new shout<br>from {{$oldnotif->from_username}} {{ Carbon\Carbon::parse($oldnotif->created_at)->diffForHumans() }}</a>
                                                @elseif($oldnotif->type == "comment")
                                                    <a href="/post/{{$oldnotif->route}}">{{$oldnotif->from_username}} commented " {{$oldnotif->notification}} " on your post {{ Carbon\Carbon::parse($oldnotif->created_at)->diffForHumans() }}</a>
                                                @elseif($oldnotif->type == "postmention")
                                                    <a href="/post/{{$oldnotif->route}}">{{$oldnotif->from_username}} mentioned you in their post: " {{$oldnotif->notification}} " {{ Carbon\Carbon::parse($oldnotif->created_at)->diffForHumans() }}</a>
                                                @elseif($oldnotif->type == "commentmention")
                                                    <a href="/post/{{$oldnotif->route}}">{{$oldnotif->from_username}} mentioned you in their comment: " {{$oldnotif->notification}} " {{ Carbon\Carbon::parse($oldnotif->created_at)->diffForHumans() }}</a>
                                                @elseif($oldnotif->type == "frendadd")
                                                    <a href="/users/{{$oldnotif->route}}">{{$oldnotif->from_username}} {{$oldnotif->notification}} {{ Carbon\Carbon::parse($oldnotif->created_at)->diffForHumans() }}</a>
                                                @elseif($oldnotif->type == "bump")
                                                    <a href="/users/{{$oldnotif->route}}">You {{$oldnotif->notification}} {{$oldnotif->from_username}} {{ Carbon\Carbon::parse($oldnotif->created_at)->diffForHumans() }}</a>

                                                @else
                                                    {!! $oldnotif->notification !!} {{ Carbon\Carbon::parse($oldnotif->created_at)->diffForHumans() }}
                                                @endif
                                            </div>



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

