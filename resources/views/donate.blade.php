@extends('layouts.donate')
<?php $page = 'donate'; ?>
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
                        Watch Ad Video = Donate to Charity
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
                                <h2>About</h2>
                                <p>At FrendGrid we believe giving back is the best way to show who we are. That's why we give 40% of every dollar earned from watching ads on this page to charity and plant a tree or pick up a piece of trash off the beach for every user you recommend that signs up. For each video you watch and each second you are on this page you are generating ad revenue which will be used to help different charities whether it be feeding the homeless or helping out an animal shelter.</p>
                                <p>The money you generate will show as awards under your profile. Finally feel good for being on social media because you are making the world a better place.</p>
                            </div>

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

