
<div class="modal fade" id="hangout" tabindex="-1" role="dialog" aria-labelledby="hangoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hangoutModalLabel">Post Hang Out!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('s3-image-upload') }}" enctype="multipart/form-data" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" name="latitude" value=""/>
                            <input  type="hidden" name="longitude" value=""/>
                            <textarea rows="4" cols="40" style="width: 100%;"  type="text" name="description" >@@{{Auth::user()->username}} and @@{{$info->username}} are hanging out!</textarea>
                        </div>
                        <div class="col-6 offset-2 image-upload" style="align-self: flex-end;">
                            <label for="file-input" style="float: right; margin-bottom: 0; cursor: pointer;">
                                <i class="fa fa-picture-o fa-2x" aria-hidden="true"></i>
                            </label>
                            <input id="file-input" type="file" name="image" />
                            <img src="" id="profile-img-tag" width="200px" />
                        </div>

                        <div class="col-md-4" style="align-self: flex-end;">
                            <button type="submit" class="btn upload-button modal-button" style="float: right;" ><i aria-hidden="true" class="fa fa-share fa-2x"></i></button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>