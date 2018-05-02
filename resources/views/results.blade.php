

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 no-padding">
                <div class="card">
                    <div class="card-header">
                        {{--@include('partials.friendsearch')--}}
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div>
                                <h3>Users:</h3>

                                <ul>

                                    @foreach($searchedusers as $user)

                                        <a href="/users/{{$user->username}}"><li>{{ $user->name }} | {{ $user->username }}</li></a>


                                    @endforeach

                                </ul>


                            </div>


                        </div>
                        <div class="card-footer">
                            <div>UPLOAD IMAGE BUTTON HERE</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
