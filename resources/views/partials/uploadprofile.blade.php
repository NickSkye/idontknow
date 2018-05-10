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
                    @foreach($profileinfo as $prof)
                    <div class="col-12">
                        <p>Change your profile picture here (Squarer images work best)</p>
                        <label for="file-input" style="float: left; margin-bottom: 0; cursor: pointer;">
                            <i class="fa fa-user-circle-o fa-2x" aria-hidden="true"></i>
                        </label>
                        <input id="file-input" type="file" name="image" />
                        <img src="{{ $prof->profileimage }}" id="profile-img-tag" width="200px" />
                    </div>
                    <div class="col-xs-12 col-sm-8  offset-sm-4">

                            <label for="aboutme">
                                Bio
                            </label>
                        <textarea rows="5" cols="40" placeholder="{{ $prof->aboutme }}" type="text" name="aboutme" value="{{ $prof->aboutme }}">{{ $prof->aboutme }}</textarea>


                            <div class="form-group">
                                <label for="name">*Name</label>
                                <input type="text" class="form-control book-form" id="name" name="name" value="{{ old('name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">*Email</label>
                                <input type="email" class="form-control book-form" id="email" name="email" value="{{ old('email') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">*Phone Number</label>
                                <input type="text" class="form-control book-form" id="phone" name="phone" value="{{ old('phone') }}" required>
                            </div>

                            <label for="datepicker">Select Date</label>
                            <div class="input-group date">
                                <input type="date" class="form-control book-form" id="datepicker" name="datepicker" value="{{ old('datepicker') }}" />
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>

                    </div>
                    @endforeach
                    <div class="col-md-12">
                        <button type="submit" class="btn upload-button">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>

{{--end trial upload--}}