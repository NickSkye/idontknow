<form action="{{ url('comment') }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-12">
            {{ Form::hidden('post_id', $post->id) }}
            <textarea rows="3" cols="40" placeholder="Comment on this post..." type="text" name="comment" style="width: 100%;"></textarea>

        </div>
        <div class="col-12">
            <button type="submit" class="btn comment-button">Comment</button>
        </div>
    </div>
</form>