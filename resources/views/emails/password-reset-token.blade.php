<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Password reset</title>
    </head>

    <body>
     <h1> Password Reset Token</h1>
    <a href="{{ route('resetPasswordPage', ['token' => $token])}}">Follow this link</>
    </body>

</html>
