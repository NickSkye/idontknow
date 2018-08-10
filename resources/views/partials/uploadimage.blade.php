{{--start trial upload--}}
<div class="container">
    <div class="panel panel-primary">



        <div class="panel-body">





            <form action="{{ url('s3-image-upload') }}" enctype="multipart/form-data" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-12 text-center">
                        <input type="hidden" name="latitude" value=""/>
                        <input  type="hidden" name="longitude" value=""/>
                        <img src="" id="upload-img-tag" style="width: auto; max-height: 200px;" />
                        <textarea rows="4" cols="40" style="width: 100%;" placeholder="Whatcha thinkin about..." type="text" name="description" ></textarea>
                    </div>
                    <div class="col-12 image-upload image-butt" >
                        <label for="file-input" style="float: right; margin-bottom: 0; cursor: pointer;">
                            <i class="fa fa-camera fa-3x" aria-hidden="true"></i>
                        </label>
                        <input id="file-input" type="file" name="image" />

                    </div>

                    <div class="col-md-4" style="align-self: flex-end;">
                        <button type="submit" class="btn upload-button modal-button post-button" style="float: right;" >Post</button>
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>

{{--end trial upload--}}