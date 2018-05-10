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
                                            <div class="col-xs-12 col-sm-6">
                                            <p>{{$item->username}} is your friend</p>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <p>last activity: {{$item->users->updated_at}}</p>
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
                                                <button type="button" class="btn upload-button" data-toggle="modal" data-target="#sendShout">
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
                                <h4>{{$item->username}}</h4>

                                <div class="achievements-box">


                                </div>


                                <p>{{$item->aboutme}}</p>
                                @endforeach
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
                                            <a href="/post/{{$post->id}}">
                                                <img src="{{$post->imagepath}}" class="img-fluid tiny-img" alt="">
                                                <p>{{$post->description}}</p>
                                            </a>
                                            {{--{{ $friend }}--}}
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
