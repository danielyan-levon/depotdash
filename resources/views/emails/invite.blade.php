<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Invitation</title>
    </head>
    <body>
        <h1>Hello {{$user->name}}</h1>
        <p>You're invited to DepotDash</p>
        <p>The last step is just to set up your passowrd</p>
        <p>Please click on link below.</p>   
        <p>
            <a href='{{ url("register/invite/{$user->verification_token}") }}'>Finish Registration</a>
        </p>
    </body>
</html>