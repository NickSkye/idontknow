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
                                @foreach($friends as $fr)
                                {{--@foreach($messages as $mess)--}}
                                    {{--MODAL START--}}

                                    <div class="modal fade" id="viewShout-{{$fr->username}}" tabindex="-1" role="dialog" aria-labelledby="viewshoutModalLabel-{{$fr->username}}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="/shouts/shoutseen" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="shoutid" value="{{$fr->username}}"/>
                                                    {{--<input type="hidden" name="from_user" value="{{$mess->from_username}}"/>--}}
                                                    <input type="hidden" name="latitude" value=""/>
                                                    <input type="hidden" name="longitude" value=""/>
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="viewshoutModalLabel-{{$fr->username}}">Shout!</h5>
                                                        <button type="submit" class="close" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{--@include('partials.viewshout')--}}
                                                        <p>Your friend {{$fr->username}} shouted:</p>
                                                        @foreach($messages as $mess)
                                                            @if($mess->from_username == $fr->username)
                                                        <p>{{$mess->message}}</p>
                                                        <p>at: {{Carbon\Carbon::parse($mess->created_at)->format('d M Y g:i A')}}</p>
                                                            @endif
                                                            @endforeach
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#sendShout">Shout Back!</button>
                                                        <button type="submit" class="btn btn-secondary pull-left modal-button">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    {{--MODAL END--}}
                                    <div class="col-12">


                                            @if(in_array($fr->username, (array) $messages))
                                        <button type="button" class="btn " data-toggle="modal" data-target="#viewShout-{{$fr->username}}" style="display: flex; align-items: center; padding: 0; background: yellow; color: black; width: 100%;">


                                            <div class=" profile-image-shout-page "
                                                 style="background-image: url('{{$fr->profileimage}}');"></div>

                                            <p style="margin-left: 1rem;">Shout from {{$fr->username}}
                                                {{--<br>received {{Carbon\Carbon::parse($mess->created_at)->format('d M Y g:i A')}}--}}
                                            </p>
                                        </button>
                                                <hr>

                                            @endif





                                    </div>

                                @endforeach
                                <hr>
                                @foreach($sentmessages as $sentmess)

                                    <div class="col-12">

                                        <div style="display: flex; align-items: center;">


                                            <div class=" profile-image-shout-page old"
                                                 style="background-image: url('{{$sentmess->profileimage}}');"></div>
                                            <p style="margin-left: 1rem;">Shout to {{$sentmess->username}}
                                                <br>sent {{Carbon\Carbon::parse($sentmess->updated_at)->diffForHumans()}}
                                            </p>


                                            {{--<p>{{$oldmess->message}}</p>--}}
                                        </div>


                                        <hr>
                                    </div>

                                @endforeach
                                <hr>
                                @foreach($oldmessages as $oldmess)

                                    <div class="col-12">

                                        <div style="display: flex; align-items: center;">

                                            @if(Auth::user()->username === $oldmess->from_username)
                                                <div class=" profile-image-shout-page old"
                                                     style="background-image: url('{{$oldmess->profileimage}}');"></div>
                                                <p style="margin-left: 1rem;">Shout to {{$oldmess->username}}
                                                    <br>seen {{Carbon\Carbon::parse($oldmess->updated_at)->diffForHumans()}}
                                                </p>
                                            @elseif(Auth::user()->username === $oldmess->username)
                                                <div class=" profile-image-shout-page old" style="background-image: url('{{$oldmess->profileimage}}');"></div>
                                                <p style="margin-left: 1rem;">Shout from {{$oldmess->from_username}}
                                                    <br>opened {{Carbon\Carbon::parse($oldmess->updated_at)->diffForHumans()}}
                                                </p>
                                            @endif



                                            {{--<p>{{$oldmess->message}}</p>--}}
                                        </div>


                                        <hr>
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

