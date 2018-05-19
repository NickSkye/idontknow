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



                        @if($post->username === Auth::user()->username)
                            <form action="/delete-post/{{$post->id}}" enctype="multipart/form-data" method="POST">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="delete-post-button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Delete Your Post? There's No Going Back!">
                                            <i
                                                    class="fa fa-trash fa-2x"></i></button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <div class="pull-right">
                                <form method="post" action="/report-post/{{$post->id}}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="{{$post->id}}" value="{{$post->id}}"/>
                                    <button class="btn report-post-button" type="submit">
                                        Report
                                    </button>
                                </form>
                            </div>
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
                                            <div class="modal-body text-center" >
                                                <img src="{{$post->imagepath}}" class="img-fluid" alt="" style="max-height: 50vh; ">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 ">
                                    {{--HERE--}}

                                    <div class="frend-post-box post-post">
                                        <div class="post-post-header">
                                            <a href="/users/{{$post->username}}">
                                                <div style=" background-image: url('{{$post->profileimage}}');  width: 50px; height: 50px; background-size: cover; background-repeat: no-repeat; margin-right: 20px; background-position: center;">
                                                </div>
                                            </a>
                                            <a href="/users/{{$post->username}}">
                                                <p>{{$post->username}}</p>
                                                <p style="font-size: 10pt;">shared: {{Carbon\Carbon::parse($post->created_at)->format('d M Y g:i A')}}</p>
                                            </a>
                                        </div>


                                        @if (is_null($post->imagepath))
                                            <p>{{$post->description}}</p>
                                            <p class="post-data">views: {{$post->views}}</p>
                                        @else
                                            <div class="col-lg-6">
                                                <p>{{$post->description}}</p>
                                                <button type="button" class="btn " data-toggle="modal" data-target="#postModal">
                                                    <img src="{{$post->imagepath}}" class="img-fluid" alt="" style="max-height: 500px;">
                                                </button>


                                            </div>

                                        @endif




                                        {{--{{ $friend }}--}}

                                        <div class="post-meta">
                                            <p class="post-data">views: {{$post->views}}</p>
                                            <form action="/like" method="post" id="like_form" class="post-data">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="postid" value="{{$post->id}}"/>
                                                {{--<label for="submit"><i class="fa fa-heart fa-2x" aria-hidden="true"></i></label>--}}
                                                <button class="post-data like" type="submit" name="submit" value="" style="background: none; "/>
                                                <i class="fa fa-heart-o fa-2x" aria-hidden="true"></i>
                                                </button>
                                                <div id="server-results"><!-- For server results --></div>
                                            </form>
                                            <p class="post-data"><a href="#"><i class="fa fa-thumbs-o-down fa-2x" aria-hidden="true"></i></a></p>
                                            <p class="post-data"><a href="#"><i class="fa fa-share-alt fa-2x" aria-hidden="true"></i></a></p>

                                        </div>

                                    </div>

                                </div>

                                {{--THIS PAGE WILL BE AN INDIVIDUAL CLICKED ON POST WITH COMMENT SECTION AND VOTES --}}

                            </div>

                        </div>
                        <div class="comment-section infinite-scroll">
                            @foreach($thecomments as $comment)
                                <div>


                                    <div class="post-comment-header">
                                        <a href="/users/{{$comment->username}}">
                                            <div style=" background-image: url('{{$comment->profileimage}}');  width: 50px; height: 50px; background-size: cover; background-repeat: no-repeat; margin-right: 20px; background-position: center;">
                                            </div>
                                        </a>

                                        <div class="post-col">
                                            <a href="/users/{{$comment->username}}">
                                                <p class="comment-username">{{$comment->username}} - {{Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</p>
                                            </a>

                                            <p class="comment">{{$comment->comment}}</p>

                                        </div>


                                        <div class="report-form" style="max-width: 100px; position: absolute; right: 10px;">
                                            <div class="pull-right">
                                                <form method="post" action="/report-comment/{{$comment->id}}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="postid" value="{{$post->id}}"/>
                                                    <button class="btn report-button" type="submit">
                                                        Report
                                                    </button>
                                                </form>
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">

                                            <a href=""><p class="comment pull-right">reply</p></a>
                                        </div>
                                    </div>


                                </div>
                                <hr>
                            @endforeach
                            {{ $thecomments->links() }}
                        </div>


                    </div>
                    <div class="card-footer">

                        <div> @include('partials.commentfield')</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--THIS PAGE WILL BE AN INDIVIDUAL CLICKED ON POST WITH COMMENT SECTION AND VOTES--}}
