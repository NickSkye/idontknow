<div class="container">
    <div class="panel panel-primary">



        <div class="panel-body">





            <form action="{{ url('shouts/sendonpage') }}"  method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-12">

                        <input type="hidden" name="sendtousername" value="{{$info->username}}"/>
                    </div>
                    <div class="col-12">
                        <input  class="shout-text" placeholder="Shout at your frend..." type="text" name="shout" style="width: 100%; margin-bottom: 20px;" required>
                    </div>
                    <div class="col-12" style="align-self: flex-end;">
                        <button type="submit" class="btn shout-button modal-button" style="float: right;"><i aria-hidden="true" class="fa fa-bullhorn fa-2x"></i></button>
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>