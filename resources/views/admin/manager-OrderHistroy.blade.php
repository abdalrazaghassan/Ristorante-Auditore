<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Ristorante Auditore - Orders History</title>
    <style>
        body {
            background: white;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        section {
            border: solid black 1px;
            margin: 5%;
            border-radius: 20px;
            padding: 2%;
            border-style: double;
            background-color: #d7e8f7;
        }

        .ingrediantSection {
            margin: 5%;
            padding: 2%;
            border-style: double;
            border-radius: 20px;
            background-color: #d7e8f7;
            width: 90%;
            height: 80%;
        }

        .ingrediantSection h5 {
            color: rgb(82, 238, 82);
            margin: 5px;
        }
    </style>
</head>

<body>
    <nav id="manager-navbar" class="navbar navbar-dark bg-dark" style="background-color: #183b8c !important;">
        <a class="navbar-brand mx-auto" href="manager.html">Ristorante Auditore - Orders History</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav align-items-center">
                <a class="nav-item nav-link" href="manager.html">Main page Manager</a>
                <a class="nav-item nav-link" href="manager-modsup.html">Modifiy Suppliers</a>
                <a class="nav-item nav-link" href="manager-ing.html">Wanted Ingrediant</a>
            </div>
        </div>
    </nav>
    <hr>
    <div class="container">
        <form method="post" action="manager-oh.html">
            <div class="form-group">
                <label for="dateOne">First Date</label>
                <input id="dateOne" class="form-control" type="date" name="dateOne">
            </div>
            <div class="form-group">
                <label for="dateTwo">Second Date</label>
                <input id="dateTwo" class="form-control" type="date" name="dateTwo">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit" name="filter">Filter by date</button>
            </div>
        </form>
    </div>
    <hr>
    <hr class="m-0">

    <section class="ingrediantSection overflow-auto" id="OrdersHistory">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <h1 class="navbar-brand mx-auto">Orders History!</h1>
            <h5>Total Profit: {{$InetialData['total_profit']}}$</h5>
        </nav>

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>Table Number</th>
                <th>Name order</th>
                <th>Size Order</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($InetialData['OrderHistory'] as $Orders)
                <tr>
                    <th>{{$Orders->table_number}}</th>
                    <th>{{$Orders->name}}</th>
                    <th>{{$Orders->size}}</th>
                    <th>{{$Orders->quantity}}</th>
                    <th>{{$Orders->price}}</th>
                    <th>{{$Orders->created_at}}</th>
                <tr>
                    @endforeach
                </tr>
            </tbody>

        </table>

    </section>

    <script type="text/javascript" src="js/jquery-3.4.1.slim.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>

</html>
