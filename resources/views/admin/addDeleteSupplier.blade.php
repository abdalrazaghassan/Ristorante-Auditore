<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <title>Ristorante Auditore - Manager</title>
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
    </style>
</head>

<body>
<nav id="manager-navbar" class="navbar navbar-dark bg-dark" style="background-color: #183b8c !important;">
    <a class="navbar-brand mx-auto" href="manager-modsup.html">Ristorante Auditore - Modifiy Suppliers</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav align-items-center">
            <a class="nav-item nav-link" href="{{url('/manager')}}">Main page Manager</a>
        </div>
    </div>
</nav>

<div>

    <section class=" align-items-center" id="AddSupplier">
        <div class="w-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=".col-md-3 .offset-md-3" align="center">
                        <h2>Add Supplier</h2>

                        <form action="{{route('addSupplier')}}" method="post">
                            @csrf
                            <input type="text" placeholder="Name" name="name" class="form-control" required><br>

                            <input type="text" placeholder="Address" name="address" class="form-control" required><br>

                            <input type="text" placeholder="number phone" name="phoneNumber" class="form-control" required><br>

                            <input type="password" placeholder="Password" name="password" class="form-control" required><br>

                            <input type="submit" name="add_supplier" value="Submit" class="btn btn-primary"><br>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <hr class="m-0">

    <section class="p-3 p-lg-5 d-flex align-items-center" id="DeleteSupplier">
        <div class="w-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=".col-md-3 .offset-md-3" align="center">
                        <form action="{{route('deleteSupplier')}}" method="post">
                            @csrf
                            <h2>Delete Supplier</h2>
                            <div class="form-group">
                                <select class="form-control" name="supplier">
                                    @for($i = 0 ; $i < count($supplier) ; $i++)
                                        <option value="{{$supplier[$i]->id}}">{{$supplier[$i]->name}}</option>
                                    @endfor
                                </select>
                            </div>
                            <input type="submit" name="delete_supplier" value="Delete" class="btn btn-danger"><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



</div>

<script type="text/javascript" src="{{asset('js/jquery-3.4.1.slim.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>

</body>

</html>
