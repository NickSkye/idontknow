{{--start trial upload--}}
<div class="container">
    <div class="panel panel-primary">



        <div class="panel-body">





            <form action="{{ url('s3-image-upload') }}" enctype="multipart/form-data" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-12">
                        <textarea rows="4" cols="50" placeholder="Tell your frends about your post..." type="text" name="description" ></textarea>
                    </div>
                    <div class="col-6 offset-2 image-upload" style="align-self: flex-end;">
                        <label for="file-input" style="float: right; margin-bottom: 0; cursor: pointer;">
                            <i class="fa fa-picture-o fa-2x" aria-hidden="true"></i>
                        </label>
                        <input id="file-input" type="file" name="image" />
                        <img src="" id="profile-img-tag" width="200px" />
                    </div>

                    <div class="col-md-4" style="align-self: flex-end;">
                        <button type="submit" class="btn btn-success" style="float: right;">Upload</button>
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>

{{--end trial upload--}}