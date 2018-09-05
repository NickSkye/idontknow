@extends('layouts.dashboard')
<?php $page = 'dashboard'; ?>
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



                {{--END MODALS FOR SHOUTS--}}

                <div class="card">
                    <div class="card-header">

                        @if(isset($_COOKIE['FG_User']))
                            <h2>{{$_COOKIE['FG_User']}}'s Dashboard</h2>
                            @else
                            <h2>Dashboard</h2>
                        @endif
                        <div id="datetime"></div>


                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                            <div class="row frend-area">


                                        <a href="/localchat" class="col-4 dashboard-app-images">LocalChat</a>
                                        <a href="/aroundme" class="col-4 dashboard-app-images">AroundMe</a>
                                        <a href="/topics" class="col-4 dashboard-app-images">TopicChat</a>
                                        <a href="/donate" class="col-4 dashboard-app-images">Charity</a>





                    </div>
                    <div class="card-footer">
                        @include('partials.footerlinks')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

