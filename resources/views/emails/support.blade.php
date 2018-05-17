<!DOCTYPE html>
<html>
    <head>
        <title>Reported Content</title>
    </head>

    <body>
        <h2>Support message from <a href="https://frendgrid.com/users/{{ Auth::user()->name }}">{{ Auth::user()->name }}</a></h2>
        <br/>
        <p>
            {{$data['mess']}}
        </p>

        <br/>

    </body>

</html>