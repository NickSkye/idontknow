{{--start trial upload--}}
<div class="container">
    <div class="panel panel-primary">



        <div class="panel-body">





            <form action="{{ url('shouts') }}"  method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-12">
                        <select name="sendtousername">
                            @foreach($friends as $friend)
                            <option value="{{$friend->followsusername}}">{{$friend->followsusername}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <textarea rows="4" cols="50" placeholder="Shout at your frend..." type="text" name="shout" ></textarea>
                    </div>
                    <div class="col-md-4" style="align-self: flex-end;">
                        <button type="submit" class="btn btn-success" style="float: right;">Shout!</button>
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>
