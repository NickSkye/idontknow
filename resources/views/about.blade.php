@extends('layouts.app')
<?php $page = 'about'; ?>
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



                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>

                           <h2>About FrendGrid</h2>
                            <br>
                            <p>FrendGrid was created for those looking to keep up with their current friends and help you meet new friends around you. The idea is simple; while most social media sites are trying to get you to have virtual friends through their websites, FrendGrid is here to help you keep up with and inspire you to meet up with people in the real world as well as meet new friends based on the people around you in your everyday life. FrendGrid is always expanding and adding new features which can be learned about here as they happen.</p>

                        </div>


                    </div>
                    <div class="card-footer">
                        @include('partials.footerlinks')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

