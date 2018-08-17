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
                            <form action="{{ url('localchatdistance') }}"  method="POST">
                                {{ csrf_field() }}
                                <div class="row">
                                    <input type="hidden" name="latitude" value=""/>
                                    <input  type="hidden" name="longitude" value=""/>
                                    <div class="col-12">

                                        <input type="radio" name="distance" value="100" checked> 100 Meters<br>
                                        <input type="radio" name="distance" value="1000"> 1 Kilometer<br>
                                        <input type="radio" name="distance" value="5000"> 5 Kilometers
                                    </div>
                                    <div class="col-12">
                                        <input class="shout-text" placeholder="Shout at your frend..." type="text" name="shout" style="width: 100%; margin-bottom: 20px;" required>
                                    </div>
                                    <div class="col-12" style="align-self: flex-end;">
                                        <button type="submit" class="btn" style="float: right;">update</button>
                                    </div>
                                </div>
                            </form>
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

