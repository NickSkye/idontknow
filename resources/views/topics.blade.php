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


                <div class="modal fade" id="addTopic" tabindex="-1" role="dialog" aria-labelledby="addTopicModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addTopicModalLabel">Add New Topic</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{--start trial upload--}}

                                <div class="container">
                                    <div class="panel panel-primary">


                                        <div class="panel-body">


                                            <form action="{{ url('addTopic') }}" method="POST">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="col-12">


                                                    </div>
                                                    <div class="col-12">
                                                        <input class="shout-text" placeholder="New Topic..." type="text" name="topicname" style="width: 100%; margin-bottom: 20px;" required>
                                                        <input class="shout-text" placeholder="Quick Description of Topic..." type="text" name="description" style="width: 100%; margin-bottom: 20px;" required>
                                                    </div>
                                                    <div class="col-12" style="align-self: flex-end;">
                                                        <button type="submit" class="btn shout-button modal-button loader-button" style="float: right;">
                                                            <i aria-hidden="true" class="fa fa-plus fa-2x"></i></button>
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


                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6"><h3>Topic Chat</h3></div>
                            <div class="col-6">
                                <a href="#" data-toggle="modal" data-target="#addTopic" style="float: right;"><i aria-hidden="true" class="fa fa-plus fa-2x"></i></a>

                            </div>





                        </div>
                    </div>
                    <div class="card-body long-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif


                        <table class="topic-table">
                            <tr>
                                <th>Favorite</th>
                                <th>Topic</th>
                                <th>Created</th>
                            </tr>
                            @foreach($topics as $topic)
                                <tr>
                                    <td>star</td>
                                    <td>{{$topic->topic}}</td>
                                    <td>{{Carbon\Carbon::parse($topic->created_at)->diffForHumans()}}</td>
                                </tr>
                            @endforeach


                        </table>


                    </div>
                    <div class="card-footer">
                        <div>Chat with people around you!</div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

