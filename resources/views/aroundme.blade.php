@extends('layouts.dashboard')
<?php $page = 'aroundme'; ?>
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
                        <div class="row">


                        <h3>Local Places to Check Out!</h3>

                        </div>
                    </div>
                    <div class="card-body long-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                            <div class="row frend-area">



                        @foreach($responses->businesses as $resp)
                            @if(!$resp->is_closed)
                                    <a href="{{$resp->url}}" target="_blank" class="col-4 home-frends-images" style="background-image: url('{{$resp->image_url}}');">
                                        <div class="nearness">

                                                @if(round($resp->distance/1000, 2) < 0.3)
                                                    <span style="color: lime;">{{round($resp->distance/1000, 2)}}</span>
                                                @elseif(round($resp->distance/1000, 2) < 1.0)
                                                    <span style="color: yellow;">{{round($resp->distance/1000, 2)}}</span>
                                                @elseif(round($resp->distance/1000, 2) < 5.0)
                                                    <span style="color: orange;">{{round($resp->distance/1000, 2)}}</span>
                                                @else
                                                    <span style="color: red;">{{round($resp->distance/1000, 2)}}</span>
                                                @endif




                                        </div>
                                        <div class="frend-box">
                                            <p>{{$resp->name}}</p>
                                        </div>
                                    </a>
                                    @endif
                            {{--<p><a >{{$resp->name}} - {{round($resp->distance/1000, 2)}} kilometers from you</a></p>--}}
                            @endforeach






                    </div>
                    <div class="card-footer">
                        <div>Chat with people around you!</div>
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection

