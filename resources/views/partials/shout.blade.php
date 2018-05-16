{{--start trial upload--}}

<div class="container">
    <div class="panel panel-primary">



        <div class="panel-body">




            <form action="{{ url('shouts/send') }}"  method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <input type="hidden" name="latitude" value=""/>
                    <input  type="hidden" name="longitude" value=""/>
                    <div class="col-12">

                        <select name="sendtousername">
                            @foreach($friends as $friend)
                            <option value="{{$friend->followsusername}}">{{$friend->followsusername}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <textarea rows="4" cols="40" placeholder="Shout at your frend..." type="text" name="shout" style="width: 100%;"></textarea>
                    </div>
                    <div class="col-12" style="align-self: flex-end;">
                        <button type="submit" class="btn shout-button" style="float: right;" data-dismiss="modal">Shout!</button>
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>
