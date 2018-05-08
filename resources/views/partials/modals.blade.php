<div class="modal fade" id="uploadImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create a new post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('partials.uploadimage')
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="viewShout" tabindex="-1" role="dialog" aria-labelledby="viewshoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewshoutModalLabel">Shout!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('partials.viewshout')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Shout Back!</button>
                <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sendShout" tabindex="-1" role="dialog" aria-labelledby="sendshoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendshoutModalLabel">Shout!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('partials.shout')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Shout Back!</button>
                <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>