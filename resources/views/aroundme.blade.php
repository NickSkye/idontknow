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




                        </div>
                    </div>
                    <div class="card-body long-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{$responses['businesses']}}
                        @foreach($responses[0] as $resp)
                            {{$resp[0]['name']}}
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

