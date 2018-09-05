@extends('layouts.dashboard')
<?php $page = 'topicchat'; ?>
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
                            <h3>Topic Chat</h3>



                        </div>
                    </div>
                    <div class="card-body long-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif




                        <div class="chat-box">
                            @if(Auth::check())
                            @foreach($messages as $mess)

                                @if($mess->username === Auth::user()->username)
                                <div class="user-localchat"><p>{{$mess->message}}</p></div>
                                @else
                                    <div class="other-localchat"><p>{{$mess->username}} - {{$mess->message}}</p></div>
                                    @endif

                                @endforeach

                            @else
                                @foreach($messages as $mess)
                                <div class="other-localchat"><p>{{$mess->username}} - {{$mess->message}}</p></div>
                                @endforeach
                            @endif
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
                        <div>Chat with people around you!</div>
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection

