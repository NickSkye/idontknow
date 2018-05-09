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
                        <button type="button" class="btn upload-button" data-toggle="modal" data-target="#sendShout">
                            <i class="fa fa-plus fa-2x" aria-hidden="true"></i>
                        </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>

                            {{--friends posts--}}
                            <div class="row frend-area">
                                @foreach($messages as $mess)
                                    {{--MODAL START--}}

                                        <div class="modal fade" id="viewShout-{{$mess->id}}" tabindex="-1" role="dialog" aria-labelledby="viewshoutModalLabel-{{$mess->id}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="/shouts/shoutseen" method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="shoutid" value="{{$mess->id}}"/>
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="viewshoutModalLabel-{{$mess->id}}">Shout!</h5>
                                                        <button type="submit" class="close" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{--@include('partials.viewshout')--}}
                                                        <p>Your friend {{$mess->from_username}} shouted:</p>
                                                        <p>{{$mess->message}}</p>
                                                        <p>at: {{$mess->created_at}}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#sendShout">Shout Back!</button>
                                                        <button type="submit" class="btn btn-secondary pull-left" >Close</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    {{--MODAL END--}}
                                    <div class="col-12">

                                        <button type="button" class="btn " data-toggle="modal" data-target="#viewShout-{{$mess->id}}">
                                           
                                            @foreach($friends as $friend)
                                                <img src="{{$friend->profileimage}}" alt="">
                                                @endforeach
                                            <p>Shout from {{$mess->from_username}} at: {{$mess->created_at}}</p>
                                        </button>


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

