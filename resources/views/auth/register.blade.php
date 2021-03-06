@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="opacity: 0.8;">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h2>{{ __('Register') }}</h2>
                        </div>
                        <div class="col-6 " >
                            <a href="/login" class="pull-right">{{ __('Login') }}</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <h2 style="text-align: center;">Welcome to FrendGrid!</h2>
                    <br>
                    <h5>Home to {{$usernum}} users</h5>
                    <h5>Creating over {{$postnum}} posts</h5>
                    <h5><i class="fa fa-users fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Make new friends based off people around you</h5>
                    <br>
                    <h5><i class="fa fa-newspaper-o fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Share your life and see all the exciting stuff going on around you!</h5>
                    <br>
                    <h5><i class="fa fa-location-arrow fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Your location is NEVER shared. Only a general radius is used in order to see who is close while Protecting your Privacy.</h5>
                    <br>
                    <h5><i class="fa fa-globe fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;For Each new user we plant a tree!</h5>
                    <br>


                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="First & Last" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" placeholder="Choose Wisely. Can't be changed." class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row " style="align-items: center;">
                            <div class="col-2 col-sm-4">
                                <input type="checkbox" class="pull-right " name="terms" value="1" required>
                            </div>
                            <div class="col-10 col-sm-6">
                                <a href="/legal" target="_blank">I agree to the terms and conditions.</a>
                            </div>

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary loader-button">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                    </form>
                    <br>
                    <p>*By default we use use a location within 15 miles of you as your location. To get the fullest experience of FrendGrid please enable location services to use your precise location.</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
