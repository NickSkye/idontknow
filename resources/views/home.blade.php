@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 no-padding">
                <div class="card">
                    <div class="card-header">

                        <form action="/search" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="query" name="query" value="{{ old('query') }}" required>
                                            </div>
                                        </div>


                                        <div class="col-sm-6">
                                            <input type="submit" value="Submit" class="send"/>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </form>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div>
                                Now let your friends know what you are up to!
                            </div>

                            <div class="row frend-area">

                                @foreach($friends as $friend)

                                    <div class="col-4">
                                        <a href="/users/{{$friend->followsusername}}">
                                            <div class="frend-box">
                                                <img src="/images/recflag.jpg" class="img-fluid" alt="">
                                                <p>{{$friend->followsusername}}</p>
                                                {{--{{ $friend }}--}}
                                            </div>
                                        </a>
                                    </div>
                                @endforeach

                            </div>


                        </div>
                        <div class="card-footer">
                            {{--start trial upload--}}
                            <div class="container">
                                <div class="panel panel-primary">
                                    <div class="panel-heading"><h2>Laravel 5.3 Amazon S3 Image Upload with Validation example</h2></div>


                                    <div class="panel-body">


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
                                            <img src="{{ Session::get('path') }}">
                                        @endif


                                        <form action="{{ url('s3-image-upload') }}" enctype="multipart/form-data" method="POST">
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="file" name="image" />
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-success">Upload</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>


                                </div>
                            </div>

                            {{--end trial upload--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
