@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 no-padding">
                <div class="card">
                    <div class="card-header">
                       
                       Click on your name in the right corner then settings to upload profile pic
                    </div>

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

                                @foreach($allfriendsinfo as $infos)
                                    @foreach($infos as $info)


                                            @if($info->username == $friend->followsusername)
                                                {{--<img src="{{$info->profileimage}}" class="img-fluid img-there" alt="">--}}
                                            <a href="/users/{{$friend->followsusername}}" class="col-4" style="max-width: 31.333333%; background-image: url('{{$info->profileimage}}'); padding-bottom: 31.33333333%; width: 100%; height: 100%; background-size: cover; background-repeat: no-repeat; margin: 1%;">

                                                    <div class="frend-box">
                                                        <p>{{$friend->followsusername}}</p>
                                                    </div>

                                            </a>
                                            @endif

                                    @endforeach

                                @endforeach


                                    {{--{{ $friend }}--}}

                            @endforeach

                        </div>


                    </div>
                    <div class="card-footer">
                        Footer
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
