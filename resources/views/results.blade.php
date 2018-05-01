<h1>Search results</h1>



    <h3>Pages:</h3>





@if (count($users))

    <h3>Users:</h3>

    <ul>

        @foreach($users as $user)

            <li>{!! link_to_route('posts.show', $user->name, $post->username) !!}</li>

        @endforeach

    </ul>

@endif