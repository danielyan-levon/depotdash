<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sign Up Confirmation</title>
    </head>
    <body>
        <h1>Hello {{$user->name}}</h1>
        <p>Thanks for registrating in DepotDash.</p>
        <p>The last step is just to confirm that this is your email address</p>
        <p>Please click on link below.</p>   
        <p>
            <a href='{{ url("register/confirm/{$user->verification_token}") }}'>Confirm your email address</a>
        </p>
    </body>
</html>