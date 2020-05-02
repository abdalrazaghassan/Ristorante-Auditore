<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

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
            height: 450px;
        }

        .ingrediantSection h5 {
            color: rgb(82, 238, 82);
            margin: 5px;
        }
    </style>
</head>

<body>
<nav id="manager-navbar" class=Orders History !"navbar navbar-dark bg-dark" style="background-color: #183b8c !important;">
    <a class="navbar-brand mx-auto" href="manager.html">Ristorante Auditore - Manager</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav align-items-center">

            <a class="nav-item nav-link" href="{{url('manager/addDeleteSupplier')}}">Modifiy Suppliers</a>
            <a class="nav-item nav-link" href="manager-ing.html">Wanted Ingrediant</a>
            <a class="nav-item nav-link" href="manager-oh.html">Orders History</a>
        </div>
    </div>
</nav>

<div>

    <section class=" align-items-center" id="AddTable">
        <div class="w-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=".col-md-3 .offset-md-3" align="center">
                        <h2>Add Table</h2>

                        <form  method="post" action="{{route('submit.addTable')}}">
                           @csrf

                            <input type="text" placeholder="Table Name..." name="nameTable" class="form-control" required><br>

                            <input type="text" placeholder="Table Name..." name="table_name" class="form-control" required><br>

                            <input type="password" placeholder="Table Password..." name="table_pass" class="form-control" required><br>

                            <input type="submit" name="add_table" value="Submit" class="btn btn-primary"><br>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <hr class="m-0">

    <section class="p-3 p-lg-5 d-flex align-items-center" id="DeleteTable">
        <div class="w-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=".col-md-3 .offset-md-3" align="center">
                        <form  method="post" action="">
                            <h2>Delete Table</h2>
                                <div class="form-group">
                                    <form method="POST" action="{{route('manager.deleteTable')}}">
                                        @csrf
                                        <select class="form-control" name="table">
                                            @foreach($InetialData['users'] as $table)
                                                <option value="{{$table->user_id}}">{{$table->name}}</option>
                                            @endforeach
                                        </select>
                                        <input type="submit" name="submit" value="delete" />
                                    </form>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="m-0">

    <section class="p-3 p-lg-5 d-flex align-items-center" id="add Category">
        <div class="w-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=".col-md-3 .offset-md-3" align="center">
                            <h2>add Category</h2>
                            <div class="form-group">
                                <form method="POST" action="{{route('manager.addCategry')}}">
                                    @csrf
                                    <input type="text" placeholder="Categoty ..." name="category_name" class="form-control" required><br>
                                    <input type="submit" name="addCategory" value="Submit" class="btn btn-primary"><br>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="m-0">

    <section class="p-3 p-lg-5 d-flex align-items-center" id="InsertDish">
        <div class="w-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=".col-md-3 .offset-md-3" align="center">
                        <h2>Insert Dish</h2>

                        <form action="{{route('manager.addItem')}}" method="post">
                            @csrf
                            <input type="text" placeholder="Dish name..." name="item_name" class="form-control" required><br>
                            <div class="form-group">

                                <select class="form-control" name="cats">
                                    @for($i = 0 ; $i < count($InetialData['category']) ; $i++)
                                       <option value="{{$InetialData['category'][$i]->category}}">{{$InetialData['category'][$i]->category}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="my-textarea"></label><textarea placeholder="Dish bio..." id="my-textarea" class="form-control" name="item_bio" rows="2"></textarea>
                            </div><br>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Dish pic...</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="item_pic">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose pic</label>
                                </div>
                            </div>


                            <input type="submit" name="insert_dish" value="Submit" class="btn btn-primary"><br>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <hr class="m-0">

    <section class="p-3 p-lg-5 d-flex align-items-center">
        <div class="w-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=".col-md-3 .offset-md-3" align="center">
                        <h2>Insert Size & Price</h2>
                        <form action="{{route('dish.submit.sizeAndPrice')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <select class="form-control" name="itemId">
                                    @foreach($InetialData['dish'] as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>

                            <div class="form-group">
                                <select class="form-control" name="size">
                                    <option value="small">small</option>
                                    <option value="meduim">meduim</option>
                                    <option value="large">large</option>
                                </select>
                            </div>
                            <br>

                            <input type="text" placeholder="Dish price..." name="item_price" class="form-control" required><br>

                            <input type="submit" name="insert_size_price" value="Submit" class="btn btn-primary"><br>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <hr class="m-0">

    <section class="p-3 p-lg-5 d-flex align-items-center" id="DeleteDish">
        <div class="w-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=".col-md-3 .offset-md-3" align="center">
                        <h2>Delete Dish</h2>

                        <form method="post" action="{{route('manager.deleteItem')}}" >
                            @csrf
                            <div class="form-group">
                                <select class="form-control" name="dish">
                                    @for($i = 0 ; $i < count($InetialData['dish']) ; $i++))
                                       <option value="{{$InetialData['dish'][$i]->id}}"> {{$InetialData['dish'][$i]->name}} </option>
                                    @endfor
                                </select>
                            </div>
                            <input type="submit" name="delete_dish" value="Delete" class="btn btn-danger"><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <hr class="m-0">

    <section class=" align-items-center" id="AddIngrediant">
        <div class="w-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=".col-md-3 .offset-md-3" align="center">
                        <h2>Add Offers</h2>

                        <form action="{{route('submit.offer')}}" method="post">
                            @csrf
                            <div>
                                <select name="offerItem">
                                    @foreach($InetialData['dish'] as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div> <br />
                            <label>small
                                <input type="radio" name="sizeDish" value="small">
                            </label>
                            <br />
                            <label>meduim
                                <input type="radio" name="sizeDish" value="meduim">
                            </label>
                            <br />
                            <label>large
                                <input type="radio" name="sizeDish" value="large">
                            </label>
                            <br />
                            <label>discount
                               <input type="number" min="0.0" step="0.1" value="" name="amountDiscount" />
                            </label> <br />
                            <input type="submit" value="submit" name="submit" />
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <hr class="m-0">

    <section class="p-3 p-lg-5 d-flex align-items-center" id="DeleteIngrediant">
        <div class="w-100">
            <div class="container">
                        <h2>Delete Offers</h2>
                        <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>Name Dish</th>
                            <th>size</th>
                            <th>base price</th>
                            <th>discount</th>
                            <th>total price</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($InetialData['getAllOffers'] as $offer)
                                <tr>
                                    <td>
                                        {{$offer->name}}
                                    </td>
                                    <td>
                                        {{$offer->size}}
                                    </td>
                                    <td>
                                        {{number_format($offer->price,2)}}/$
                                    </td>
                                    <td>
                                        {{$offer->discount}}%
                                    </td>
                                    <td>
                                        {{number_format(((100 - $offer->discount)/100) * $offer->price,2)}}/$
                                    </td>
                                    <td>
                                        {{$offer->created_at}}
                                    </td>
                                    <td>
                                       <a href="{{url("manager/removeOffer/{$offer->id_offer}")}}" class="btn btn-danger">Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>

    </section>

    <hr class="m-0">

    <section class="ingrediantSection overflow-auto" id="WantedIngrediant">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <h1 class="navbar-brand mx-auto">Wanted Ingrediants!</h1>
        </nav>

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Supplier</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <form method="POST" action="{{route('manager.submit.ingrediant')}}">
                @csrf
                @for($i = 0 ; $i < count($InetialData['Ingrediant']) ; $i++)
                    <tr>
                        <td><input type="text" name="ingrediant_name" value="{{$InetialData['Ingrediant'][$i]->name}}"></td>
                        <td>
                            <input type="number" name="amountIngrediant" min="0" max="100" value="{{$InetialData['Ingrediant'][$i]->quantity}}" step="5"> KG
                        </td>
                        <td>
                            <select class="form-control">
                                @for($j = 0 ; $j < 10; $j++)
                                    <option>{{$j}}</option>
                                @endfor
                            </select>
                        </td>
                        <td>
                            <input type="submit" name="submit" class="btn btn-primary" value="Approve">

                            <input type="submit" name="submit" class="btn btn-danger" value="Deny">
                        </td>
                    </tr>
                @endfor
            </form>
            </tbody>
        </table>

    </section>

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
                         <th>{{$Orders->quantity}}</th>
                         <th>{{$Orders->created_at}}</th>
                    <tr>
                @endforeach
            </tr>
            </tbody>

        </table>

    </section>
</div>

<script type="text/javascript" src="{{asset('js/jquery-3.4.1.slim.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>

</body>

</html>
