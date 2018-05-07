@extends('layouts.app')

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

                        @foreach($mybio as $bio)
                            <a href="/settings">
                                <img src="{{$bio->profileimage}}" class="img-fluid img-there friend-page-image" alt="">
                            </a>
                        @endforeach
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
                            <div class="row frend-area">
                                @foreach($myposts as $post)
                                    <div class="col-12">

                                        <div class="frend-post-box">
                                            <a href="/post/{{$post->id}}">
                                                <img src="{{$post->imagepath}}" class="img-fluid" alt="">

                                                <p class="post-data">views: {{$post->views}}</p>
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
