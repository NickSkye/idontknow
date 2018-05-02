@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 no-padding">
                <div class="card">
                    <div class="card-header">
                        @include('partials.friendsearch')
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            {{--info about friend--}}
                            @foreach($info as $item)
                                {{$item->username}}
                            {{--an array of users that you follow--}}
                            @if($arefriends)
                                    {{$item->username}}
                                <form method="post" action="/removefrend/{{$item->username}}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="{{$item->username}}" value="{{$item->username}}"/>
                                    <button class="btn btn-lg btn-warning" type="submit">
                                        Remove Friend
                                    </button>
                                </form>
                                @else
                                    <form method="post" action="/addfrend/{{$item->username}}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="{{$item->username}}" value="{{$item->username}}"/>
                                        <button class="btn btn-lg btn-success" type="submit">
                                            Add Friend
                                        </button>
                                    </form>
@endif


                            @endforeach

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
