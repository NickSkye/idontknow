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
                    <div class="modal fade" id="viewShout" tabindex="-1" role="dialog" aria-labelledby="viewshoutModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewshoutModalLabel">Shout!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @include('partials.viewshout')
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sendShout">Shout Back!</button>
                                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

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

                        <h2>Shouts</h2>
                        <button type="button" class="btn upload-button" data-toggle="modal" data-target="#sendShout">
                            <i class="fa fa-plus fa-2x" aria-hidden="true"></i>
                        </button>
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
                                    <div class="col-12">
                                        <p>Your friend {{$mess->from_username}} shouted:</p>
                                        <p>{{$mess->message}}</p>
                                        <p>at: {{$mess->created_at}}</p>

                                    </div>
                                    <hr>
                                @endforeach
                            </div>

                        </div>


                    </div>
                    <div class="card-footer">
                        <div>Shouts page on its way</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

