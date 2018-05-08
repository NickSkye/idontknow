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
                    <div class="col-md-12">
                        <p>Change your profile picture here (Squarer images work best)</p>
                        <label for="file-input" style="float: right; margin-bottom: 0;">
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        </label>
                        <input id="file-input" type="file" name="image" />
                        <img src="" id="profile-img-tag" width="200px" />
                    </div>
                    <div class="col-md-12">
                        <textarea rows="5" cols="40" placeholder="This is your bio and will be seen by everybody..." type="text" name="aboutme" value="{{ old('aboutme') }}"></textarea>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>

{{--end trial upload--}}