{{--THIS PAGE WILL BE AN INDIVIDUAL CLICKED ON POST WITH COMMENT SECTION AND VOTES--}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 no-padding">
                <div class="card">
                    <div class="card-header">
                        {{--@include('partials.friendsearch')--}}

                        @foreach($thepost as $post)
                            @if($post->username === Auth::user()->username)
                        <form action="/delete-post/{{$post->id}}" enctype="multipart/form-data" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit"><i class="fa fa-trash" ></i></button>
                                </div>
                            </div>
                        </form>
                            @endif
                            @endforeach

                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            {{--THIS PAGE WILL BE AN INDIVIDUAL CLICKED ON POST WITH COMMENT SECTION AND VOTES--}}
                            {{--friends posts--}}
                            <div class="row frend-area">
                                @foreach($thepost as $post)
                                    <div class="col-4">

                                        <div class="frend-post-box">
                                            <img src="{{$post->imagepath}}" class="img-fluid" alt="">
                                            <p class="post-data">views: {{$post->views}}</p>
                                            <p>{{$post->description}}</p>
                                            {{--{{ $friend }}--}}
                                        </div>

                                    </div>

                                    {{--THIS PAGE WILL BE AN INDIVIDUAL CLICKED ON POST WITH COMMENT SECTION AND VOTES--}}
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
{{--THIS PAGE WILL BE AN INDIVIDUAL CLICKED ON POST WITH COMMENT SECTION AND VOTES--}}
