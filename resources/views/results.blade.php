@extends('layouts.app')
<?php $page = 'results'; ?>
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
                                    <a class="close" data-dismiss="alert">×</a>
                                </div>
                            @elseif(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                    <a class="close" data-dismiss="alert">×</a>
                                </div>
                            @endif
                            <div>


                                @if(($suggest->count() > 0))
                                    <h5>Suggested Frends</h5>
                                @endif
                                <div id="sugbox" class="infinite-scroll" style="overflow-x: scroll; overflow-y: hidden; width: 100%; padding: 15px;">
                                <div class="row frend-area" style="flex-wrap: nowrap;">

                                @foreach($suggest as $sug)
                                        @if(!in_array($sug->username, $allwhoblocked))

                                        <a href="/users/{{$sug->username}}" class="col-4 suggest-image" id="suggest-{{$sug->username}}" style="background-image: url('{{$sug->profileimage}}');">
                                            <div class="frend-box-name">
                                                <p style="font-size: 0.8rem;">{{$sug->name}}</p>

                                            </div>
                                            {{--<div class="add-suggested-frend">--}}
                                                {{--<form method="post" id="add_frend_form"--}}
                                                      {{--action="/addfrend/{{$sug->username}}">--}}
                                                    {{--{{ csrf_field() }}--}}
                                                    {{--<input type="hidden" name="{{$sug->username}}"--}}
                                                           {{--value="{{$sug->username}}"/>--}}
                                                    {{--<button class="btn btn-success add_frend_button" type="submit">--}}
                                                        {{--<i class="fa fa-user-plus" aria-hidden="true"></i>--}}
                                                    {{--</button>--}}
                                                {{--</form>--}}
                                            {{--</div>--}}
                                            <div class="frend-box" style="height: 25%;">
                                                <p style="font-size: 0.8rem;">{{round($sug->distance, 1)}} miles</p>

                                            </div>
                                        </a>
                                        @endif
                                    @endforeach


                                </div>
                                </div>

                                <h3>User Search Results:</h3>
                                <hr>
                                <br>


                                <div class="">
                                    <div class="row frend-area">
                                    @foreach($searchedusers as $user)
                                        @if($user->username != Auth::user()->username)
                                                @if(!in_array($user->username, $allwhoblocked))
                                        <a href="/users/{{$user->username}}" class="col-12 col-sm-4 search-image" style="background-image: url('{{$user->profileimage}}');">
                                            <div class="frend-box-name">
                                                <p>{{$user->name}}</p>
                                            </div>
                                            <div class="frend-box">
                                                <p>{{$user->username}}</p>
                                            </div>
                                        </a>

                                        @endif
                                            @endif
                                    @endforeach
                                    </div>
                                    {{ $searchedusers->appends(Request::only('q'))->links() }}
                                </div>

                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="text-center">
                                <button type="button" class="btn invite-button" data-toggle="modal" data-target="#mailModal">
                                    <p>Can't find your frends here?<br>Send them an E-mail to sign up</p>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
