@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 no-padding">
                <div class="card">
                    <div class="card-header">
                        {{--@include('partials.friendsearch')--}}
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

                            {{--friends posts--}}
                            <div class="row frend-area">
                                @foreach($myposts as $post)
                                    <div class="col-4">

                                        <div class="frend-post-box">
                                            <img src="{{$post->imagepath}}" class="img-fluid" alt="">
                                            <p>{{$post->description}}</p>
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
