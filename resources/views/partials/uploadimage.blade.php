{{--start trial upload--}}
<div class="container">
    <div class="panel panel-primary">



        <div class="panel-body">





            <form action="{{ url('s3-image-upload') }}" enctype="multipart/form-data" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12 image-upload">
                        <label for="file-input">
                            <img src="http://goo.gl/pB9rpQ"/>
                        </label>
                        <input id="file-input" type="file" name="image" />
                        <img src="" id="profile-img-tag" width="200px" />
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