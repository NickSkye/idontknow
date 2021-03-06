<div class="modal fade" id="mailModal" tabindex="-1" role="dialog" aria-labelledby="mailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mailModalLabel">Invite a frend to sign up!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('sendinvite') }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                {!! Form::label('email', 'Enter your Friends Phone Number (in the format 1xxxxxxxxxx for US numbers) or E-mail Address') !!}
                                {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            </div>

                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn comment-button">Send Invite</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>