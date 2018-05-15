<!DOCTYPE html>
<html>
    <head>
        <title>Sign-up For FrendGrid</title>
    </head>

    <body>
        <h2>Your friend {{ Auth::user()->name }} wants to connect with you on FrendGrid!</h2>
        <br/>
        <a href="{{url('https://frendgrid.com/register')}}">Click Here to sign up Now!</a>
        <br/>

    </body>

</html>