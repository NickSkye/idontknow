<div class="permafooter">

    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#uploadImage"><i class="fa fa-plus" aria-hidden="true"></i></button>


    <div class="modal fade" id="uploadImage" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    @include('partials.uploadimage')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

</div>