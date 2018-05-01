<h1>Search results</h1>


    <h3>Users:</h3>

    <ul>

        @foreach($searchedusers as $user)

            <a href="/users/{{$user->username}}"><li>{{ $user->name }} | {{ $user->username }}</li></a>


        @endforeach

    </ul>

