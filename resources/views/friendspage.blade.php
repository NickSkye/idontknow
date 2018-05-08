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
                        @foreach($friendsinfo as $frinfo)

                            <img src="{{$frinfo->profileimage}}" class="img-fluid img-there friend-page-image" alt="">
                        @endforeach
                        {{--info about friend--}}
                        @foreach($info as $item)

                            {{--an array of users that you follow--}}
                            @if($arefriends)
                                <p>{{$item->username}} is your friend</p>
                                <form method="post" action="/removefrend/{{$item->username}}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="{{$item->username}}" value="{{$item->username}}"/>
                                    <button class="btn btn-lg btn-warning" type="submit">
                                        Remove Friend
                                    </button>
                                </form>
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


                        @endforeach
                            </div>
                            <div class="col-6">
                                @foreach($info as $item)


                                        <h2>{{$item->name}}</h2>
                                        <h4>{{$item->username}}</h4>

                                        <div class="achievements-box">


                                        </div>


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
                                    <div class="col-4">

                                        <div class="frend-post-box">
                                            <a href="/post/{{$post->id}}">
                                                <img src="{{$post->imagepath}}" class="img-fluid" alt="">
                                                <p>{{$post->description}}</p>
                                            </a>
                                            {{--{{ $friend }}--}}
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
