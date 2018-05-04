{{--start trial upload--}}
<div class="container">
    <div class="panel panel-primary">



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


            <form action="{{ url('s3-image-upload') }}" enctype="multipart/form-data" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12 image-upload">
                        <label for="file-input">
                            <img src="http://goo.gl/pB9rpQ"/>
                        </label>
                        <input id="file-input" type="file" name="image" />
                    </div>
                    <div class="col-md-12">
                        <textarea rows="3" cols="40" placeholder="Tell your frends about your post..." type="text" name="description" ></textarea>
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