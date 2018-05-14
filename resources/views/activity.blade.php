@extends('layouts.app')
<?php $page = 'activity'; ?>
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

                        <h2>Frend Activity</h2>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>

                            {{--friends posts--}}
                            <div class="row frend-area infinite-scroll">
                                @foreach($allfriendsinfo as $friendspost)

                                        <div class="col-12 frend-post-col">

                                            <div class="frend-post-box">
                                                <div class="card">
                                                    {{--<div class="card-header">--}}

                                                                    {{----}}


                                                    {{--</div>--}}
                                                    <div class="card-body">
                                                        <a href="/users/{{$friendspost->username}}"  style=" background-image: url('{{$friendspost->profileimage}}'); padding-bottom: 50px; width: 50px; height: 50px; background-size: cover; background-repeat: no-repeat; margin: 1%;">
                                                        </a>
                                                        <a href="/users/{{$friendspost->username}}">
                                                            <p>{{$friendspost->username}}</p>
                                                        </a>
                                                        {{--PUT LIKE POST AND DISLIKE POST FORMS HERE. ONE FORM FOR EACH--}}
                                                        <a href="/post/{{$friendspost->id}}">
                                                            <img src="{{$friendspost->imagepath}}" class="img-fluid activity-image" alt="">
                                                            <p>{{$friendspost->description}}</p>
                                                            <p>view comments&nbsp;&gt;</p>
                                                        </a>

                                                    </div>
                                                    <div class="card-footer">
                                                        <div>
                                                            <form action="{{ url('comment') }}" method="POST">
                                                                {{ csrf_field() }}
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        {{ Form::hidden('post_id', $friendspost->id) }}
                                                                        <textarea rows="3" cols="40" placeholder="Comment on this post..." type="text" name="comment" style="width: 100%;"></textarea>

                                                                    </div>
                                                                    <div class="col-12">
                                                                        <button type="submit" class="btn comment-button">Comment</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>



                                @endforeach
                                    {{ $allfriendsinfo->links() }}
                            </div>

                        </div>


                    </div>
                    <div class="card-footer">
                        <div>Activity Page will show a list of all friends recent activity</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
