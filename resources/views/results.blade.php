<h1>Search results</h1>



    <h3>Pages:</h3>





@if (count($searchedusers))

    <h3>Users:</h3>

    <ul>

        @foreach($searchedusers as $user)

            <li>{{ $user->name }} | {{ $user->username }}</li>

        @endforeach

    </ul>

@endif