@extends('layouts.dashboard')
<?php $page = 'localchat'; ?>
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
                            <form action="{{ url('localchatdistance') }}"  method="POST" id="distancepicker">
                                {{ csrf_field() }}
                                <div class="row">
                                    <input type="hidden" name="latitude" value=""/>
                                    <input  type="hidden" name="longitude" value=""/>
                                    <div class="col-12">
                                        @if(!isset($_COOKIE["FG_LocalChat_Distance"]) || $_COOKIE["FG_LocalChat_Distance"] == 100)
                                            <input type="radio" name="distance" value="100" checked> 100 Meters
                                            <input type="radio" name="distance" value="1000"> 1 Kilometer
                                            <input type="radio" name="distance" value="5000"> 5 Kilometers
                                        @elseif($_COOKIE["FG_LocalChat_Distance"] == 1000)
                                            <input type="radio" name="distance" value="100" > 100 Meters
                                            <input type="radio" name="distance" value="1000" checked> 1 Kilometer
                                            <input type="radio" name="distance" value="5000"> 5 Kilometers
                                        @elseif($_COOKIE["FG_LocalChat_Distance"] == 5000)
                                            <input type="radio" name="distance" value="100" > 100 Meters
                                            <input type="radio" name="distance" value="1000"> 1 Kilometer
                                            <input type="radio" name="distance" value="5000" checked> 5 Kilometers
                                            @else
                                            <input type="radio" name="distance" value="100" checked> 100 Meters
                                            <input type="radio" name="distance" value="1000"> 1 Kilometer
                                            <input type="radio" name="distance" value="5000"> 5 Kilometers
                                            @endif

                                    </div>

                                    <div class="col-12" style="align-self: flex-end;">
                                        <button type="submit" class="btn" style="float: right;">update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body long-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif




                        <div class="chat-box">

                            @foreach($messages as $mess)
                                <p>{{$mess->username}} - {{$mess->message}}</p>
                                @endforeach
                        </div>

                            <form action="{{ url('sendlocalchat') }}" method="post" id="sendlocalchat">
                                {{ csrf_field() }}
                                <div class="local-area">
                                    <div class="text-area">

                                        <input type="hidden" name="latitude" value=""/>
                                        <input  type="hidden" name="longitude" value=""/>
                                        <textarea  placeholder="Chat with people around you..." class="chat-field" type="text" name="localchat" style="width: 100%;" required></textarea>

                                    </div>
                                    <div class="button-area " style="display: flex;">
                                        <button type="submit" class="btn send-chat-butt" style="height: 41px; align-self: flex-end;"><i class="fa fa-2x fa-paper-plane" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </form>


                    </div>
                    <div class="card-footer">
                        <div>Shouts get deleted once viewed</div>
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection

