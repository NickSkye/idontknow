@extends('layouts.app')
<?php $page = 'activity'; ?>
@section('content')
    <div class="container">

        <!-- Modal -->
        <div class="modal fade" id="mailModal" tabindex="-1" role="dialog" aria-labelledby="mailModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mailModalLabel">Invite a frend to sign up!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('sendinvite') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        {!! Form::label('email', 'E-mail Address') !!}
                                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                                    </div>

                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn comment-button">Send Invite</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>


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
                                <hr>
                                <br>

                                <div class="infinite-scroll">
                                @foreach($searchedusers as $user)
                                    <div>
                                        <a href="/users/{{$user->username}}">
                                            <img src="{{$user->profileimage}}" alt="" style="width: 200px;">
                                            <p>{{ $user->name }}</p>
                                            <p>{{ $user->username }}</p>
                                        </a>

                                        <hr>
                                    </div>
                                @endforeach
                                    {{ $searchedusers->links() }}
                                </div>

                            </div>

                        </div>
                        <div class="card-footer">
                            <div>
                                <button type="button" class="btn invite-button" data-toggle="modal" data-target="#mailModal">
                                    Can't find your frends here? Send them an E-mail to sign up
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
