<h1>Search results</h1>


    <h3>Users:</h3>

    <ul>

        @foreach($searchedusers as $user)

            <li>{{ $user->name }}</li>
            {{-- | {{ $user->username }}--}}

        @endforeach

    </ul>

