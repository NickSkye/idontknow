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


<form action="{{ url('comment') }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-9">
            {{ Form::hidden('post_id', $post->id) }}
            <input type="hidden" name="latitude" value=""/>
            <input  type="hidden" name="longitude" value=""/>
            <textarea rows="2" cols="40" placeholder="Comment on this post..." type="text" name="comment" style="width: 100%;" required></textarea>

        </div>
        <div class="col-3 " style="display: flex;">
            <button type="submit" class="btn comment-button" style="height: 41px; align-self: flex-end;"><i class="fa fa-2x fa-paper-plane" aria-hidden="true"></i></button>
        </div>
    </div>
</form>