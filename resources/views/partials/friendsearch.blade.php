<div class="center-top-search">
    <form action="/search" method="post">
        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search for frends..." id="query" name="query" value="{{ old('query') }}">
                        </div>
                        <button type="submit" value="Submit" class="send"><i class="fa fa-search"></i></button>



    </form>
</div>