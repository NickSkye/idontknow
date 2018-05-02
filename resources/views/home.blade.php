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
                            <div>UPLOAD IMAGE BUTTON HERE</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
