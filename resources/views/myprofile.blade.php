@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 no-padding">
                <div class="card">
                    <div class="card-header">

                        Click on your name in the right corner then settings to upload profile pic
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            Now let your friends know what you are up to!
                        </div>

                        <div class="row frend-area">



                        </div>


                    </div>
                    <div class="card-footer">
                        @include('partials.uploadimage')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
