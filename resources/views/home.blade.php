@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-sm-12 no-padding">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Now let your friends know what you are up to!





                </div>
                <div class="card-footer">
                    <div>UPLOAD IMAGE BUTTON HERE</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
