@foreach($online_frends as $frend)
    {{--now {{Carbon\Carbon::parse($now->format('Y-m-d H:i:s'))}}--}}
    {{--carbon {{$frend->username}} {{Carbon\Carbon::parse($frend->updated_at)->addMinutes(5)->format('Y-m-d H:i:s')}}--}}

    @if($frend->username === $info->username)
        @if(Carbon\Carbon::parse($now->format('Y-m-d H:i:s'))->format('Y-m-d H:i:s') < Carbon\Carbon::parse($frend->updated_at)->addMinutes(2)->format('Y-m-d H:i:s') )
            <i class="fa fa-circle" style="color: lime;" aria-hidden="true"></i>
        @elseif(Carbon\Carbon::parse($now->format('Y-m-d H:i:s'))->format('Y-m-d H:i:s') < Carbon\Carbon::parse($frend->updated_at)->addMinutes(5)->format('Y-m-d H:i:s') )
            <i class="fa fa-circle" style="color: orange;" aria-hidden="true"></i>
        @else
            <i class="fa fa-circle" style="color: red;" aria-hidden="true"></i>
        @endif
        {{$info->username}}
        @if($info->username ===  Auth::user()->username )
            (you)
        @endif
    @endif

@endforeach