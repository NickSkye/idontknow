<div class="container">
    <div class="panel panel-primary">



        <div class="panel-body">





            <form action="{{ url('shouts/sendonpage') }}"  method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-12">

                        <input type="hidden" name="sendtousername" value="{{$item->username}}"/>
                    </div>
                    <div class="col-12">
                        <textarea rows="4" cols="50" placeholder="Shout at your frend..." type="text" name="shout" ></textarea>
                    </div>
                    <div class="col-12" style="align-self: flex-end;">
                        <button type="submit" class="btn shout-button" style="float: right;">Shout!</button>
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>