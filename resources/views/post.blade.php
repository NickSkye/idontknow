{{--THIS PAGE WILL BE AN INDIVIDUAL CLICKED ON POST WITH COMMENT SECTION AND VOTES--}}

@extends('layouts.app')
<?php $page = 'post'; ?>
@section('content')
    <div class="container">
        @if (!is_null($post))
        <meta property="og:image" content="{{$post->imagepath}}">
        <meta property="og:image:type" content="image/png/jpeg">
        <meta property="og:image:width" content="1024">
        <meta property="og:image:height" content="1024">



        <div class="modal fade" id="trashModal" tabindex="-1" role="dialog" aria-labelledby="trashModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this post?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        There is no going back. Once deleted this content is gone FOREVER!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form action="/delete-post/{{$post->id}}" enctype="multipart/form-data" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="delete-post-button " style="cursor: pointer;" >
                                        <i
                                                class="fa fa-trash fa-2x"></i></button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>


        {{--EDIT MODAL--}}
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Editing Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @include('partials.editpost')
                        </div>

                    </div>
                </div>
            </div>
        {{--END EDIT MODAL--}}



        {{--COPY MODAL--}}
        <div class="modal fade" id="copyModal" tabindex="-1" role="dialog" aria-labelledby="copyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="copyModalLabel">Share Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" value="https://frendgrid.com/post/{{$post->id}}"  id="copytext" style="width: 100%; text-align: center;">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button onclick="myFunction()" class="btn copybutton btn-primary"><i class="fa fa-files-o fa-2x" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
        {{--END COPY MODAL--}}


        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 no-padding">
                <div class="card">
                    <div class="card-header" style="padding: 0; background-color: white; border-bottom: none;">
                        {{--@include('partials.friendsearch')--}}



                        <div class="header-controls">
                            <div class="pull-left left">
                                <a href="{{ URL::previous() }}"><i class="fa fa-angle-left fa-2x"
                                                                   aria-hidden="true"></i></a>
                            </div>
                            <div style="text-align: center;" class="center">
                                @guest
                                    <a href="https://frendgrid.com/register">Register here to comment and vote on this post</a>
                                    @endguest
                                
                                
                            </div>
                            <div class="nav-item dropdown pull-right" style="list-style-type: none;">
                                <a id="navbarDropdown" class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                    <i class="fa fa-ellipsis-v fa-2x" aria-hidden="true"></i>
                                </a>

                                @auth
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="text-align: center;">
                                    @if($post->username === Auth::user()->username)
                                        <a style="color: red; width: 100%;" data-toggle="modal" href="#trashModal">
                                            Delete
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <a style="color: black; width: 100%;" data-toggle="modal" href="#editModal">
                                                Edit
                                            </a>
                                        </a>
                                    @else
                                        <div class="">
                                            <form method="post" action="/report-post/{{$post->id}}">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="{{$post->id}}" value="{{$post->id}}"/>
                                                <button class="" style="color: red; width: 100%;" type="submit">
                                                    Report
                                                </button>
                                            </form>
                                        </div>
                                    @endif



                                </div>
                                    @endauth
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
                            {{--THIS PAGE WILL BE AN INDIVIDUAL CLICKED ON POST WITH COMMENT SECTION AND VOTES--}}
                            {{--friends posts--}}
                            <div class="row frend-area post-area">

                                {{--POST MODAL--}}
                                <div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <meta name="viewport" content="width=device-width, initial-scale=1"/>
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
                                                @auth
                                                <p style="font-size: 10pt;">shared: {{Carbon\Carbon::parse($post->created_at)->diffForHumans()}} about {{round($post_location->distance, 2)}} miles from you</p>
                                                @if($post->edited)
                                                <p style="font-size: 8pt;">edited: {{Carbon\Carbon::parse($post->updated_at)->diffForHumans()}}</p>
                                                @endif
@endauth
                                            </a>
                                        </div>


                                        @if (is_null($post->imagepath))


                                            <p>{!! preg_replace('/@([\w\-]+)/', '<a href="/users/$1">$0</a>', preg_replace('/(http|https|ftp|ftps|www)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', '<a href="$0">$0</a>', $post->description) )!!}</p>
                                            {{--<p class="post-data">views: {{$post->views}}</p>--}}
                                        @else
                                            <div class="col-lg-6">

                                                <p>{!! preg_replace('/@([\w\-]+)/', '<a href="/users/$1">$0</a>', preg_replace('/(http|https|ftp|ftps|www)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', '<a href="$0">$0</a>', $post->description) )!!}</p>
                                                <button type="button" class="btn " data-toggle="modal" data-target="#postModal">
                                                    <img src="{{$post->imagepath}}" class="img-fluid" alt="" style="max-height: 500px;">
                                                </button>


                                            </div>

                                        @endif




                                        {{--{{ $friend }}--}}
                                        <p class="post-views">views: {{$post->views}}</p>
                                        @auth
                                        <div class="post-meta">



                                            <div class="post-data like-dislike-vote">
                                            <form action="/like" method="post" id="like_form" class="">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="postid" value="{{$post->id}}"/>
                                                {{--<label for="submit"><i class="fa fa-heart fa-2x" aria-hidden="true"></i></label>--}}
                                                <button class="post-data like" type="submit" name="submit" value="" style="background: none; "/>
                                                @if($post_vote == 1)
                                                <i class="fa fa-heart fa-2x" style="color: red;" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-heart-o fa-2x" aria-hidden="true"></i>
                                                @endif
                                                </button>

                                            </form>
                                            <div id="server-results" style="text-align: center;" class="">{{$totalvote}}</div>
                                            <form action="/dislike" method="post" id="dislike_form" class="">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="postid" value="{{$post->id}}"/>
                                                {{--<label for="submit"><i class="fa fa-heart fa-2x" aria-hidden="true"></i></label>--}}
                                                <button class="post-data dislike" type="submit" name="submit" value="" style="background: none; "/>
                                                @if($post_vote == -1)
                                                <i class="fa fa-thumbs-down fa-2x" style="color: blue;" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-thumbs-o-down fa-2x" aria-hidden="true"></i>
                                                    @endif
                                                </button>

                                            </form>
                                            </div>

                                            <p class="post-data"><a data-toggle="collapse" href="#commentCollapse" role="button" aria-expanded="false" aria-controls="commentCollapse"><i class="fa fa-comment-o fa-2x" aria-hidden="true"></i>{{$totalcomment}}</a></p>
                                            <p class="post-data"><a data-toggle="modal" href="#copyModal"><i class="fa fa-share-alt fa-2x" aria-hidden="true"></i></a></p>

                                        </div>

                                            @endauth

                                    </div>

                                </div>

                                {{--THIS PAGE WILL BE AN INDIVIDUAL CLICKED ON POST WITH COMMENT SECTION AND VOTES --}}

                            </div>

                        </div>
                            @auth

                                <div class="collapse multi-collapse" id="commentCollapse">
                                    <div style=" background: white; width: 100%; height: 80px; padding: 10px;"> @include('partials.commentfield')</div>
                                </div>


                            @endauth
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

                                            <p class="comment">{!! preg_replace('/@([\w\-]+)/', '<a href="/users/$1">$0</a>', $comment->comment) !!}</p>

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
@auth
                                            <a data-toggle="collapse" href="#commentCollapse" role="button" aria-expanded="false" aria-controls="commentCollapse"><p class="comment pull-right comment-from {{$comment->username}}">reply</p></a>
                                       @endauth
                                        </div>
                                    </div>


                                </div>
                                <hr>
                            @endforeach
                            {{ $thecomments->links() }}
                        </div>


                    </div>

                </div>
            </div>
        </div>

            @else
            <div class="card">
                <div class="card-header">



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
                            <h1>Whoops! Looks like something went wrong.</h1><h4> If you believe something is wrong with FrendGrid please <a href="/support">let us know here.</a></h4>
                        </div>

                    </div>


                </div>
                <div class="card-footer">
                    @include('partials.footerlinks')
                </div>
            </div>
        @endif
    </div>
@endsection
{{--THIS PAGE WILL BE AN INDIVIDUAL CLICKED ON POST WITH COMMENT SECTION AND VOTES--}}
