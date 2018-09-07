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
                                <table style="width:100%">
                                    <tr>
                                        <th>App</th>
                                        <th>description</th>

                                    </tr>
                                    <tr>
                                        <td><a href="/localchat" class="">LocalChat</a></td>
                                        <td>Chat with everyone within up to 5km of you</td>

                                    </tr>
                                    <tr>
                                        <td><a href="/aroundme" class="">AroundMe</a></td>
                                        <td>View the most popular places to hangout around you</td>

                                    </tr>
                                    <tr>
                                        <td><a href="/topics" class="">TopicChat</a></td>
                                        <td>Chat with people with similar interests sorted by topics</td>

                                    </tr>
                                    <tr>
                                        <td><a href="#" class="">Charity</a></td>
                                        <td>In the works</td>

                                    </tr>
                                    <tr>
                                        <td><a href="/browser" class="">Browser</a></td>
                                        <td>For when you need to access a site but cannot access it directly</td>

                                    </tr>
                                </table>





                                        <a href="/browser" class="">Browser</a>





                    </div>
                    <div class="card-footer">
                        @include('partials.footerlinks')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

