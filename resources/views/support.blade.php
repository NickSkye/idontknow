@extends('layouts.app')
<?php $page = 'support'; ?>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-sm-12 no-padding">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    {{--<img src="{{ Session::get('path') }}">--}}
                @endif

                {{--MODAL FOR SHOUTS--}}




                {{--END MODALS FOR SHOUTS--}}

                <div class="card">
                    <div class="card-header">
                        Support
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>

                            <form action="/support-request" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-12">


                                        <div class="form-group">
                                            <label for="mess">Message us with any Questions or Concerns you may have and we will get back to you ASAP :)</label>
                                            <textarea class="form-control book-form" id="mess" name="mess" cols="30" rows="10">{{ old('mess') }}</textarea>
                                        </div>


                                        <button type="submit" class="btn upload-button modal-button" style="float: right;"><i aria-hidden="true" class="fa fa-share fa-2x"></i></button>

                                    </div>

                                </div>
                            </form>

                        </div>


                    </div>
                    <div class="card-footer">
                        @include('partials.footerlinks')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

