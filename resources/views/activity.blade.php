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
                                @foreach($allfriendsposts as $friendspost)
                                    @foreach($friendspost as $post)
                                    <div class="col-12">

                                        <div class="frend-post-box">
                                            <img src="{{$post->imagepath}}" class="img-fluid" alt="">
                                            <p>{{$post->description}}</p>
                                            {{--{{ $friend }}--}}
                                        </div>

                                    </div>


                                @endforeach
                                @endforeach
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
