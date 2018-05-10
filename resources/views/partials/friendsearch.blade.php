<div class="center-top-search">
    <form action="/search" method="get">
        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search for frends..." id="query" name="query" value="{{ old('query') }}">
                        </div>
                        <span data-toggle="tooltip" data-placement="bottom" title="Search users"><button type="submit" value="Submit" class="send"><i class="fa fa-search"></i></button></span>



    </form>
</div>