{{--start trial upload--}}
<div class="container">
    <div class="panel panel-primary">



        <div class="panel-body">





            <form action="{{ url('shout') }}" enctype="multipart/form-data" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-12">
                        <select>
                            @foreach($friends as $friend)
                            <option value="{{$friend->username}}">{{$friend->followsusername}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <textarea rows="4" cols="50" placeholder="Tell your frends about your post..." type="text" name="description" ></textarea>
                    </div>
                    <div class="col-md-4" style="align-self: flex-end;">
                        <button type="submit" class="btn btn-success" style="float: right;">Upload</button>
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>
