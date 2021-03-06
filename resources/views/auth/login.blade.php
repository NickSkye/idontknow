@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="opacity: 0.8;">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h2>{{ __('Login') }}</h2>
                            </div>
                            <div class="col-6 " >
                                <a href="/register" class="pull-right">{{ __('Register') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Username or email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('username') ?: old('email') }}" autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @if (session('warning'))
                                        <div class="alert alert-warning">
                                            {{ session('warning') }}
                                        </div>
                                    @endif

                                </div>
                            </div>
                            {{--WILL CHANGE THIS LATER TO ALLOW USERNAME OR EMAIL TO BE USED TO LOGIN--}}
                            {{--<div class="form-group row">--}}
                            {{--<label for="username" class="col-sm-4 col-form-label text-md-right">{{ __('Username') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                            {{--<input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" autofocus>--}}

                            {{--@if ($errors->has('username'))--}}
                            {{--<span class="invalid-feedback">--}}
                            {{--<strong>{{ $errors->first('username') }}</strong>--}}
                            {{--</span>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            {{--</div>--}}


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
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary loader-button">
                                        {{ __('Login') }}
                                    </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            </div>

                        </form>
                        {{--FACEBOOK LOGIN STUFF FOR LATER--}}
                        {{--<div class="col-md-8 offset-md-4" style="margin-top: 30px;">--}}
                            {{--<div class="fb-login-button" data-max-rows="1" data-size="medium" data-button-type="continue_with" data-show-faces="true" data-auto-logout-link="false" data-use-continue-as="true"></div>--}}
                        {{--</div>--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
