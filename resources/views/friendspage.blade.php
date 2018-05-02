@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 no-padding">
                <div class="card">
                    <div class="card-header">
                        <form action="/search" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="query" name="query" value="{{ old('query') }}" required>
                                            </div>
                                        </div>


                                        <div class="col-sm-6">
                                            <input type="submit" value="Submit" class="send"/>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </form>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            @foreach($info as $item)
                                {{$item->username}}
                                <form method="post" action="/addfrend">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="{{$item->username}}" value="$item->username"/>
                                    <button class="btn btn-lg btn-success" type="submit">
                                        Add Friend
                                    </button>
                                </form>
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
