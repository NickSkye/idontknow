<!DOCTYPE html>
<html>
    <head>
        <title>Reported Content</title>
    </head>

    <body>
        <h2><a href="https://frendgrid.com/post/{{$data['id']}}">post id {{$data['id']}}</a> was reported by
            <a href="https://frendgrid.com/users/{{ Auth::user()->username }}">{{ Auth::user()->name }}</a></h2>
        <br/>

        <br/>

    </body>

</html>