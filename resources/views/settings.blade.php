@extends('layouts.app')
<?php $page = 'settings'; ?>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 no-padding">
                <div class="card">
                    <div class="card-header">
{{$use_location}}
                        {{--@foreach($profileinfo as $item)--}}
                            <h2>{{$profileinfo->username}}</h2>




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
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
