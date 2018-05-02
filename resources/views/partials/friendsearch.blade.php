<form action="/search" method="post">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xs-8 col-sm-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search for frends..." id="query" name="query" value="{{ old('query') }}">
                    </div>
                </div>


                <div class="col-xs-4 col-sm-6">
                    <input type="submit" value="Submit" class="send"/>
                </div>
            </div>
        </div>
    </div>


</form>