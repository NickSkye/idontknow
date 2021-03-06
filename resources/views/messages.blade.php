@extends('layouts.app')
<?php $page = 'messages'; ?>
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

                {{--MODAL FOR SHOUTS--}}


                <div class="modal fade" id="sendShout" tabindex="-1" role="dialog" aria-labelledby="sendshoutModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="sendshoutModalLabel">Shout!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @include('partials.shout')



                            </div>
                            {{--<div class="modal-footer">--}}
                            {{--<button type="button" class="btn btn-primary">Shout Back!</button>--}}
                            {{--<button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Close</button>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>


                    {{--SHOUT BACK --}}

                    <div class="modal fade" id="sendShoutBack" tabindex="-1" role="dialog" aria-labelledby="sendshoutModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="sendshoutModalLabel">Shout back!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    {{--start trial upload--}}

                                    <div class="container">
                                        <div class="panel panel-primary">



                                            <div class="panel-body">




                                                <form action="{{ url('shouts/send') }}"  method="POST">
                                                    {{ csrf_field() }}
                                                    <div class="row">
                                                        <input type="hidden" name="latitude" value=""/>
                                                        <input  type="hidden" name="longitude" value=""/>
                                                        <div class="col-12">
                                                            <input  type="hidden" id="sendbacktousername" name="sendtousername" value=""/>

                                                        </div>
                                                        <div class="col-12">
                                                            <input class="shout-text" placeholder="Shout at your frend..." type="text" name="shout" style="width: 100%; margin-bottom: 20px;" required>
                                                        </div>
                                                        <div class="col-12" style="align-self: flex-end;">
                                                            <button type="submit" class="btn shout-button modal-button" style="float: right;"><i aria-hidden="true" class="fa fa-bullhorn fa-2x"></i></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>


                                        </div>
                                    </div>


                                </div>
                                {{--<div class="modal-footer">--}}
                                {{--<button type="button" class="btn btn-primary">Shout Back!</button>--}}
                                {{--<button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Close</button>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>


                    {{--END MODALS FOR SHOUTS--}}

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h2>Shouts</h2>
                            </div>
                            <div class="col-6">
                                @if($hasfriends)
                                    <button type="button" class="shout-button" data-toggle="modal" data-target="#sendShout">
                                        <i class="fa fa-bullhorn fa-2x" aria-hidden="true"></i>
                                    </button>

                                @else

                                    <p>You have to add frends before you can shout at them</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if($hasfriends)


                            <button type="button" class="shout-fixed-button" data-toggle="modal" data-target="#sendShout">
                                <i class="fa fa-bullhorn fa-2x" aria-hidden="true"></i>
                            </button>

                        @endif


                        <div>

                            {{--friends posts--}}
                            <div class="row frend-area">
                                @foreach($messages as $mess)
                                    {{--MODAL START--}}

                                    <div class="modal fade" id="viewShout-{{$mess->id}}" tabindex="-1" role="dialog" aria-labelledby="viewshoutModalLabel-{{$mess->id}}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">

                                                    <div class="modal-header" style="border-bottom: none;">

                                                        <form action="/shouts/shoutseen" method="post">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="shoutid" value="{{$mess->id}}"/>
                                                            <input type="hidden" name="from_user" value="{{$mess->from_username}}"/>
                                                            <input type="hidden" name="latitude" value=""/>
                                                            <input  type="hidden" name="longitude" value=""/>
                                                            <button type="submit" class="close" style="position: absolute; right: 20px;" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </form>

                                                    </div>
                                                    <div class="modal-body" style="display: flex; align-items: center;">
                                                        <div>
                                                        <div class=" profile-image-shout-page "
                                                             style="background-image: url('{{$mess->profileimage}}');"></div>
                                                        <h5 class="modal-title" id="viewshoutModalLabel-{{$mess->id}}">{{$mess->from_username}} </h5>
                                                        <p style="font-size: 10px;"> {{Carbon\Carbon::parse($mess->created_at)->diffForHumans()}}</p>
                                                        </div>
                                                        {{--@include('partials.viewshout')--}}

                                                        <div style="margin-left: 30px;">
                                                            <p>{!! preg_replace('/@([\w\-]+)/', '<a href="/users/$1">$0</a>', preg_replace('/(http|https|ftp|ftps|www)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', '<a href="$0" >$0</a>', $mess->message))!!}</p>
                                                        </div>


                                                    </div>
                                                <div class="modal-footer" style="padding: 5px; border-top: none;">
                                                <form action="/shouts/shoutseen" method="post" style="width: 50%;">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="shoutid" value="{{$mess->id}}"/>
                                                    <input type="hidden" name="from_user" value="{{$mess->from_username}}"/>
                                                    <input type="hidden" name="latitude" value=""/>
                                                    <input  type="hidden" name="longitude" value=""/>
                                                        <button type="submit" class="btn btn-secondary pull-left modal-button" style="width: 100%;">Close</button>
                                                </form>
                                                <form class="shoutbackform" action="/shouts/shoutback" method="post" style="width: 50%;">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="shoutid" value="{{$mess->id}}"/>
                                                    <input type="hidden" name="from_user" value="{{$mess->from_username}}"/>
                                                    <input type="hidden" name="latitude" value=""/>
                                                    <input  type="hidden" name="longitude" value=""/>
                                                        <button type="submit" id="shout-back-{{$mess->id}}" class="btn btn-primary" style="width: 100%;">Shout Back!</button>
                                                </form>
                                                </div>



                                            </div>
                                        </div>
                                    </div>

                                    {{--MODAL END--}}
                                    <div class="col-12" style="padding-left: 0; padding-right: 0;">

                                        <button type="button" class="btn shout-from-frend" data-toggle="modal" data-target="#viewShout-{{$mess->id}}" style="">


                                            <div class=" profile-image-shout-page "
                                                 style="background-image: url('{{$mess->profileimage}}');"></div>

                                            <p style="margin-left: 1rem; text-align: left;">Shout from {{$mess->from_username}} <br>received {{Carbon\Carbon::parse($mess->created_at)->diffForHumans()}}</p>
                                            <span style="right: 40px; position: absolute; color: #F62E55;"><i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i></span>
                                        </button>


                                        {{--<hr>--}}
                                    </div>

                                @endforeach
                                {{--<hr>--}}
                                @foreach($sentmessages as $sentmess)

                                    <div class="col-12" style="padding-left: 0; padding-right: 0;">

                                        <div   style="display: flex; align-items: center; background-color: #F5F5F5; border-bottom: 1px solid lightgrey;">


                                            <div class=" profile-image-shout-page old"
                                                 style="background-image: url('{{$sentmess->profileimage}}');"></div>
                                            <p style="margin-left: 1rem;">Shout to {{$sentmess->username}} <br>sent {{Carbon\Carbon::parse($sentmess->updated_at)->diffForHumans()}}</p>
<span style="right: 40px; position: absolute; color: #0b7dda;"><i class="fa fa-paper-plane-o fa-2x" aria-hidden="true"></i></span>



                                            {{--<p>{{$oldmess->message}}</p>--}}
                                        </div>


                                        {{--<hr>--}}
                                    </div>

                                @endforeach
                                {{--<hr>--}}
                                @foreach($oldmessages as $oldmess)

                                    <div class="col-12" style="padding-left: 0; padding-right: 0;">

                                        <div   style="display: flex; align-items: center; background-color: #F5F5F5; border-bottom: 1px solid lightgrey;">

                                            @if(Auth::user()->username === $oldmess->from_username)
                                                <div class=" profile-image-shout-page old"
                                                     style="background-image: url('{{$oldmess->profileimage}}');"></div>
                                                <p style="margin-left: 1rem;">Shout to {{$oldmess->username}} <br>seen {{Carbon\Carbon::parse($oldmess->updated_at)->diffForHumans()}}</p>
                                                <span style="right: 40px; position: absolute; color: #70F3FF;"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></span>
                                            @elseif(Auth::user()->username === $oldmess->username)
                                                <div class=" profile-image-shout-page old" style="background-image: url('{{$oldmess->profileimage}}');"></div>
                                                <p style="margin-left: 1rem;">Shout from {{$oldmess->from_username}} <br>opened {{Carbon\Carbon::parse($oldmess->updated_at)->diffForHumans()}}</p>
                                                <span style="right: 40px; position: absolute; color: #70F3FF;"><i class="fa fa-envelope-open-o fa-2x" aria-hidden="true"></i></span>
                                            @endif



                                            {{--<p>{{$oldmess->message}}</p>--}}
                                        </div>


                                        {{--<hr>--}}
                                    </div>

                                @endforeach
                            </div>

                        </div>


                    </div>
                    <div class="card-footer">
                        <div>Shouts get deleted once viewed</div>
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection

