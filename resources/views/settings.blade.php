@extends('layouts.app')
<?php $page = 'settings'; ?>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 no-padding">
                <div class="card">
                    <div class="card-header">

                        {{--@foreach($profileinfo as $item)--}}
                            {{$profileinfo->username}}
                            



                        {{--@endforeach--}}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            @include('partials.uploadprofile')
                        </div>

                        <div class="row frend-area">



                        </div>


                    </div>
                    <div class="card-footer">
                     FOOTER STUFF
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
