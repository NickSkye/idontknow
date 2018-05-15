<!DOCTYPE html>
<html>
    <head>
        <title>You Have A New Frend</title>
    </head>

    <body>
        <h2>{{ Auth::user()->name }} just added you as a Frend!</h2>
        <br/>
        <a href="https://frendgrid.com/users/{{Auth::user()->username}}">Click here to add {{ Auth::user()->name }} back</a>
        <br/>

    </body>

</html>