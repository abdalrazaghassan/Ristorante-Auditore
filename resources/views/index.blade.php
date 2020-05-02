<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Ristorante Auditore - Login</title>
    <!-- ***************************************************************************************** -->
    <style>
        .login-container {
            margin-top: 12%;
            margin-left: 30%;
            margin-right: 30%;
            padding: 5px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #183b8c !important;">
        <a class="navbar-brand mx-auto" href="index.html">Ristorante Auditore - Login</a>
    </nav>
    <div class="login-container">
        <form action="{{route('login')}}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <button type="submit" name="login" class="btn btn-primary btn-lg btn-block">Login</button>
            </div>
        </form>
    </div>
</body>

</html>