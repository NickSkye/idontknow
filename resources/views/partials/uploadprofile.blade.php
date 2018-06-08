{{--start trial upload--}}
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading"><h2>Settings</h2></div>


        <div class="panel-body">


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
                <img src="{{ Session::get('path') }}">
            @endif


            <form action="{{ url('s3-image-upload-profilepic') }}" enctype="multipart/form-data" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    {{--@foreach($profileinfo as $prof)--}}
                    <input type="hidden" name="latitude" value=""/>
                    <input type="hidden" name="longitude" value=""/>
                    <div class="col-xs-12 col-sm-4">
                        <p>Profile Picture</p>

                        <img src="{{ $profileinfo->profileimage }}" id="profile-img-tag" width="200px"/>
                        <input id="file-input" type="file" name="image"/>
                    </div>
                    <div class="col-xs-12 offset-sm-1 col-sm-7">


                        <div class="form-group">
                            <label for="aboutme">Bio</label>
                            <textarea rows="5" cols="40" placeholder="{{ $profileinfo->aboutme }}" type="text" class="form-control" name="aboutme" value="{{ $profileinfo->aboutme }}">{{ $profileinfo->aboutme }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control book-form" id="name" name="name" value="{{ $profileinfo->name }}">

                        </div>

                        {{--<div class="form-group">--}}
                        {{--<label for="email">*Email</label>--}}
                        {{--<input type="email" class="form-control book-form" id="email" name="email" value="{{ old('email') }}" required>--}}
                        {{--</div>--}}

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control book-form" id="phone" name="phone" value="{{ $profileinfo->phonenumber }}">
                        </div>

                        <label for="datepicker">Birthday</label>
                        <div class="input-group date">
                            <input type="date" class="form-control book-form" id="datepicker" name="birthday" value="{{ $profileinfo->birthday }}"/>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 1rem;">
                            <label for="email_notifications">Receive E-mail Notifications?</label>
                            <select name="email_notifications">
                                <option value="1">Yes</option>
                                <option value="0">No</option>

                            </select>
                        </div>
                        <div class="form-group" style="margin-top: 1rem;">
                            <label for="use_loc">Allow us to use your location?</label>
                            <select name="use_loc">
                                <option value="1">Yes</option>
                                <option value="0">No</option>

                            </select>
                        </div>

                    </div>
                    {{--@endforeach--}}
                    <div class="col-md-12" style="margin-top: 50px;">
                        <button type="submit" class="btn upload-button">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>

{{--end trial upload--}}