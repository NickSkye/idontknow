{{--<form action="{{ url('comment') }}" method="POST">--}}
    {{--{{ csrf_field() }}--}}
    {{--<div class="row">--}}
        {{--<div class="col-12">--}}
            {{--{{ Form::hidden('post_id', $post->id) }}--}}
            {{--<input type="hidden" name="latitude" value=""/>--}}
            {{--<input  type="hidden" name="longitude" value=""/>--}}
            {{--<textarea rows="3" cols="40" placeholder="Comment on this post..." type="text" name="comment" style="width: 100%;"></textarea>--}}

        {{--</div>--}}
        {{--<div class="col-12">--}}
            {{--<button type="submit" class="btn comment-button">Comment</button>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</form>--}}

{{--<div class="modal fade" id="mentionModel" tabindex="-1" role="dialog" aria-labelledby="mentionModelLabel" aria-hidden="true">--}}
    {{--<div class="modal-dialog" role="document">--}}
        {{--<div class="modal-content">--}}
            {{--<div class="modal-header">--}}
                {{--<h5 class="modal-title" id="exampleModalLabel">Select a Frend</h5>--}}
                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                    {{--<span aria-hidden="true">&times;</span>--}}
                {{--</button>--}}
            {{--</div>--}}
            {{--<div class="modal-body">--}}
                {{--@foreach($friends as $friend)--}}
                    {{--<button id="frend-{{$friend->id}}" onclick="addToText({{$friend->followsusername}})"type="button" class="btn"> {{$friend->followsusername}}</button>--}}
                    {{--@endforeach--}}
            {{--</div>--}}
            {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                {{--<button type="button" class="btn btn-primary">Select</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

<script>
function input(username){


    $('.comment-field').append(username);
}
</script>

<div class="suggestionMentions d-none" style="position: absolute; top: -205px;">
    @foreach($friends as $friend)
    <button id="frend-{{$friend->id}}" onclick="input('{{$friend->followsusername}}')"type="button" class="btn"> {{$friend->followsusername}}</button><br>
    @endforeach
</div>


<form action="{{ url('comment') }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-9">
            {{ Form::hidden('post_id', $post->id) }}
            <input type="hidden" name="latitude" value=""/>
            <input  type="hidden" name="longitude" value=""/>
            <textarea rows="2" cols="40" placeholder="Comment on this post..." class="comment-field" type="text" name="comment" style="width: 100%;" required></textarea>
            {{--<a href="#mentionModel" data-toggle="modal" style="position: absolute; top: 10px; right: 25px;"><i class="fa fa-at" aria-hidden="true"></i></a>--}}
        </div>
        <div class="col-3 " style="display: flex;">
            <button type="submit" class="btn comment-button" style="height: 41px; align-self: flex-end;"><i class="fa fa-2x fa-paper-plane" aria-hidden="true"></i></button>
        </div>
    </div>
</form>