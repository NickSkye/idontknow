@extends('layouts.app')
<?php $page = 'me'; ?>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 no-padding">
                <div class="card">
                    <div class="card-header">

                        {{--@include('partials.friendsearch')--}}
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

                        <div class="row">

                            <div class="col-6">
                                <a href="/settings">
                                    <img src="{{$generalinfo->profileimage}}" class="img-fluid img-there friend-page-image" alt="">
                                </a>
                            </div>


                            <div class="col-6">

                                <h2>{{$generalinfo->name}}</h2>
                                <h4>{{$generalinfo->username}}</h4>
                                <p>last active: {{Carbon\Carbon::parse($generalinfo->updated_at)->format('d M Y g:i A')}}</p>
                                <div class="achievements-box row">
                                    <div class="col-2 col-sm-1">
                                        @if($generalinfo->birthday->isToday())
                                            <img src="/images/birthday_gif.gif" alt="" style="width: 50px; height: 50px;">
                                            @endif
                                    </div>

                                </div>


                                <p>{{$generalinfo->aboutme}}</p>
                            </div>


                        </div>
                        {{--info about friend--}}

                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>

                            {{--my posts--}}
                            <div class="row frend-area ">
                                @foreach($myposts as $post)
                                    {{--<a href="/post/{{$post->id}}">--}}
                                    {{--<div class="frend-post-box">--}}
                                    {{--<p>{{$post->description}}</p>--}}
                                    {{--<p class="post-data">views: {{$post->views}}</p>--}}
                                    {{--</div>--}}
                                    {{--</a>--}}
                                    @if (is_null($post->imagepath))

                                        <a href="/post/{{$post->id}}" class='square-box'>
                                            <div class='square-content'>
                                                <div>
                                                    <span>{{$post->description}}</span>
                                                </div>
                                            </div>

                                        </a>
                                    @else
                                        <a href="/post/{{$post->id}}" class="col-4 my-images" style="background-image: url('{{$post->imagepath}}'); "></a>

                                    @endif




                                @endforeach
                                {{--{{ $myposts->links() }}--}}
                            </div>

                        </div>


                    </div>
                    <div class="card-footer">
                        @foreach($real as $r)
                            <div>{{$r->username}} - {{$r->followsusername}}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
