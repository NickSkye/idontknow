<div class="online-frends" style="position: fixed;">
    <div class="toggleon-online-frends">
        <i class="fa fa-arrows-h" aria-hidden="true"></i>
    </div>
    <div class="card" style="width: 100%;">
        <div class="card-header">
            <span class="toggle-online-frends"><i class="fa fa-arrows-h" aria-hidden="true"></i></span>Online Frends
        </div>
        <ul class="list-group list-group-flush">

            @foreach($online_frends as $frend)
                {{--now {{Carbon\Carbon::parse($now->format('Y-m-d H:i:s'))}}--}}
                {{--carbon {{$frend->username}} {{Carbon\Carbon::parse($frend->updated_at)->addMinutes(5)->format('Y-m-d H:i:s')}}--}}



                <li class="list-group-item">
                    @if(Carbon\Carbon::parse($now->format('Y-m-d H:i:s'))->format('Y-m-d H:i:s') < Carbon\Carbon::parse($frend->updated_at)->addMinutes(2)->format('Y-m-d H:i:s') )
                        <i class="fa fa-circle" style="color: lime;" aria-hidden="true"></i>
                    @elseif(Carbon\Carbon::parse($now->format('Y-m-d H:i:s'))->format('Y-m-d H:i:s') < Carbon\Carbon::parse($frend->updated_at)->addMinutes(5)->format('Y-m-d H:i:s') )
                        <i class="fa fa-circle" style="color: orange;" aria-hidden="true"></i>
                    @else
                        <i class="fa fa-circle" style="color: red;" aria-hidden="true"></i>
                    @endif
                    {{$frend->username}}
                    @if($frend->username ===  Auth::user()->username )
                        (you)
                    @endif
                </li>

            @endforeach
        </ul>
    </div>
</div>