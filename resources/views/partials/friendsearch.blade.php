<form action="/search" method="post">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" class="form-control" id="query" name="query" value="{{ old('query') }}" required>
                    </div>
                </div>


                <div class="col-sm-6">
                    <input type="submit" value="Submit" class="send"/>
                </div>
            </div>
        </div>
    </div>


</form>