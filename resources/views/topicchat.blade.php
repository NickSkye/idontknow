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
                        <div>
                            <div>
                                <a href="/topics"><h5><i class="fa fa-chevron-left" aria-hidden="true"></i> more topics</h5>
                                </a>
                                <h3 class="text-center">{{$topicname->topic}} Chat</h3>
                            </div>

                            <div class="topicdescription text-center">
                                <p>Topic Created: {{Carbon\Carbon::parse($topicname->created_at)->diffForHumans()}}</p>
                            </div>
                            <div class="topicdescription text-center">
                                <p>{{$topicname->description}}</p>
                            </div>


                        </div>
                    </div>
                    <div class="card-body long-body no-padding-complete">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif


                        <div class="chat-box">
                            {{--@if(Auth::check())--}}
                                @foreach($topicchats as $mess)

                                    {{--@if($mess->username === Auth::user()->username)--}}
                                        {{--<div class="user-topicchat">--}}
                                            {{--<p>{!! preg_replace('/@([\w\-]+)/', '<a href="/users/$1">$0</a>', preg_replace('/(http|https|ftp|ftps|www)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', '<a href="$0" target="_blank">$0</a>', $mess->message) )!!}</p>--}}
                                        {{--</div>--}}
                                    {{--@else--}}
                                        <div class="other-topicchat"><p>
                                                <a href="/users/{{$mess->username}}" style="font-size: 12pt;">{{$mess->username}}</a><br> {!! preg_replace('/@([\w\-]+)/', '<a href="/users/$1">$0</a>', preg_replace('/(http|https|ftp|ftps|www)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', '<a href="$0" target="_blank">$0</a>', $mess->message) )!!}
                                            </p></div>
                                    {{--@endif--}}

                                @endforeach

                            {{--@else--}}
                                {{--@foreach($topicchats as $mess)--}}
                                    {{--<div class="other-topicchat"><p>--}}
                                            {{--<a href="/users/{{$mess->username}}">{{$mess->username}}</a> - {!! preg_replace('/@([\w\-]+)/', '<a href="/users/$1">$0</a>', preg_replace('/(http|https|ftp|ftps|www)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', '<a href="$0" target="_blank">$0</a>', $mess->message) )!!}--}}
                                        {{--</p></div>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
                                <div id="chatupdate-results"></div>


                        </div>

                        <form action="{{ url('sendTopicChat') }}" method="post" id="sendtopicchat">
                            {{ csrf_field() }}
                            <div class="local-area">
                                <div class="text-area">
                                    <input type="hidden" name="id" value="{{$id}}"/>
                                    <input type="hidden" name="topicname" value="{{$topicname->topic}}"/>
                                    <textarea placeholder="Chat..." class="chat-field" type="text" name="topicchat" style="width: 100%;" required></textarea>

                                </div>
                                <div class="button-area " style="display: flex;">
                                    <button type="submit" class="btn send-chat-butt" style="height: 41px; align-self: flex-end;">
                                        <i class="fa fa-2x fa-paper-plane" aria-hidden="true"></i></button>
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

