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
                                <div class="col-4">
                                    <a href="/users/{{$friend->followsusername}}">
                                        <div class="frend-box">
                                @foreach($allfriendsinfo as $infos)
                                    @foreach($infos as $info)


                                            @if($info->username == $friend->followsusername)
                                                {{--<img src="{{$info->profileimage}}" class="img-fluid img-there" alt="">--}}
                                                {{--TEST HERE USING BACKGROUND IMAGE --}}
                                                <div style="background-image: url('{{$info->profileimage}}'); width: 30vw; height: 30vw;"></div>
                                            @endif

                                    @endforeach

                                @endforeach

                                    <p>{{$friend->followsusername}}</p>
                                    {{--{{ $friend }}--}}
                                        </div>
                                    </a>
                                </div>
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
