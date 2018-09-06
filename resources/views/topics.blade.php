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




                            <table class="topic-table">
                                <tr>
                                    <th>Favorite</th>
                                    <th>Topic</th>
                                    <th>Created</th>
                                </tr>
                                <tr>
                                    <td>Alfreds Futterkiste</td>
                                    <td>Maria Anders</td>
                                    <td>Germany</td>
                                </tr>

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

