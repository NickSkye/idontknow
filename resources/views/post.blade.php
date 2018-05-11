{{--THIS PAGE WILL BE AN INDIVIDUAL CLICKED ON POST WITH COMMENT SECTION AND VOTES--}}

@extends('layouts.app')
<?php $page = 'post'; ?>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 no-padding">
                <div class="card">
                    <div class="card-header">
                        {{--@include('partials.friendsearch')--}}
                        <div class="pull-right">

                        </div>


                            @if($post->username === Auth::user()->username)
                                <form action="/delete-post/{{$post->id}}" enctype="multipart/form-data" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="delete-post-button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Delete Your Post? There's No Going Back!"><i
                                                        class="fa fa-trash fa-2x"></i></button>
                                        </div>
                                    </div>
                                </form>
                            @endif


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
                            <div class="row frend-area post-area">

                                    {{--POST MODAL--}}
                                    <div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{$post->description}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{$post->imagepath}}" class="img-fluid" alt="">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">

                                        <div class="frend-post-box">
                                            <button type="button" class="btn " data-toggle="modal" data-target="#postModal">
                                            <img src="{{$post->imagepath}}" class="img-fluid" alt="" style="max-height: 500px;">
                                            </button>
                                            <p class="post-data">views: {{$post->views}}</p>
                                            <p>{{$post->description}}</p>
                                            {{--{{ $friend }}--}}
                                        </div>

                                    </div>

                                    {{--THIS PAGE WILL BE AN INDIVIDUAL CLICKED ON POST WITH COMMENT SECTION AND VOTES--}}

                            </div>

                        </div>
                        <div class="comment-section infinite-scroll">
                            @foreach($thecomments as $comment)
                                <div >

                                    <div class="row">


                                        <div class="col-1" style="min-width: 85px;">
                                            <a href="/users/{{$comment->username}}">
                                            <img src="{{$comment->profileimage}}" alt="" style="width: 75px;">
                                            </a>
                                        </div>
                                        <div class="col-5">
                                            <a href="/users/{{$comment->username}}">
                                            <p class="comment-username">{{$comment->username}}</p>
                                            </a>
                                        </div>

                                        <div class="col-4" style="max-width: 175px;">
                                            <p class="pull-right">{{$comment->created_at}}</p>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="offset-1 col-8">
                                            <p class="comment">{{$comment->comment}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">

                                            <a href=""><p class="comment">reply</p></a>
                                        </div>
                                    </div>


                                </div>
                                <hr>
                            @endforeach
                            {{ $thecomments->links() }}
                        </div>


                    </div>
                    <div class="card-footer">
                        @foreach($thepost as $post)
                            <div> @include('partials.commentfield')</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--THIS PAGE WILL BE AN INDIVIDUAL CLICKED ON POST WITH COMMENT SECTION AND VOTES--}}
