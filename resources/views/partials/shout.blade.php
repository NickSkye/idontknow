{{--start trial upload--}}

<script type="text/javascript">


$('.itemName').select2({
    placeholder: 'Select an item',
    ajax: {
        url: '/select2-autocomplete-ajax',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results:  $.map(data, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                })
            };
        },
        cache: true
    }
});


</script>
<div class="container">
    <div class="panel panel-primary">



        <div class="panel-body">





            <form action="{{ url('shouts/send') }}"  method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <input type="hidden" name="latitude" value=""/>
                    <input  type="hidden" name="longitude" value=""/>
                    <div class="col-12">
                        <select class="itemName form-control" style="width:500px;" name="sendtousername"></select>
                        {{--<select name="sendtousername">--}}
                            {{--@foreach($friends as $friend)--}}
                            {{--<option value="{{$friend->followsusername}}">{{$friend->followsusername}}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    </div>
                    <div class="col-12">
                        <textarea rows="4" cols="50" placeholder="Shout at your frend..." type="text" name="shout" ></textarea>
                    </div>
                    <div class="col-12" style="align-self: flex-end;">
                        <button type="submit" class="btn shout-button" style="float: right;">Shout!</button>
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>
