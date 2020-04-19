<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <title>SSFR - Kitchen</title>
    <style>
        body {
            background: white;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .kitchenSection {
            margin: 5%;
            padding: 2%;
            border-style: double;
            border-radius: 20px;
            background-color: #d7e8f7;
            width: 90%;
            height: 450px;
        }

        table {
            width: 100%;
            border-spacing: 0;
        }

        .kitchenSection h1 {
            margin: 1%;
            color: black;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>


<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #183b8c !important;">
    <a class="navbar-brand mx-auto" href="kitchen.html">SSFR - Kitchen</a>
</nav>


<section class="kitchenSection overflow-auto">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <h1 class="navbar-brand mx-auto">Current Orders</h1>
    </nav>
    <table class="table">
        <thead class="thead-dark ">
        <tr>
            <th scope="col">Table Number</th>
            <th scope="col">Dish Name</th>
            <th scope="col">Category</th>
            <th scope="col">Size</th>
            <th scope="col">Quantity</th>
            <th scope="col">Notes</th>
            <th scope="col">Create at</th>
            <th scope="col">Delivered?</th>
        </tr>
        </thead>
        <tbody>
        @for($i = 0 ; $i < count($initData['Orders']) ; $i++)
            <tr>
                <th scope="row">{{$initData['Orders'][$i]->table_number}}</th>
                <td>{{$initData['Orders'][$i]->name}}</td>
                <th>{{$initData['Orders'][$i]->cat}}</th>
                <th>{{$initData['Orders'][$i]->size}}</th>
                <th>{{$initData['Orders'][$i]->quantity}}</th>
                <td>{{$initData['Orders'][$i]->customize}}</td>
                <td>{{$initData['Orders'][$i]->created_at}}</td>
                <td><a href="{{url("/kitchen/confirmOrder/{$initData['Orders'][$i]->id_order}")}}" class="btn btn-outline-success">Done</a></td>
             </tr>
        @endfor
        </tbody>
    </table>

</section>


<section class="kitchenSection overflow-auto">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <h1 class="navbar-brand mx-auto">Ingrediants</h1>
    </nav>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            <form method="post" action="{{route('kitchen.addIngrediant')}}">
                @csrf
                <tr>
                    <td>
                    <select name="item_name">
                        @foreach($initData['ITEMS'] as $item)
                               <option value="{{$item->name}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    </td>
                    <td>
                        <input type="number" min="5" value="" name="quantity" step="5" />KG
                    </td>
                    <td>
                        <input type="submit" name="submit" value="submit" />
                    </td>
                </tr>
            </form>

            @foreach($initData['Ingrediant'] as $ingrediant)
                <tr>
                    <td>
                       {{$ingrediant->name}}
                    </td>
                    <td>
                        {{$ingrediant->quantity}}
                    </td>
                    <td>
                        {{$ingrediant->created_at}}
                    </td>
                    <td>
                        <a href="{{url("/kitchen/removeIngrediant/{$ingrediant->id}")}}" class="btn btn-danger">Remove</a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</section>

<script type="text/javascript" src="{{asset('js/jquery-3.4.1.slim.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>

</body>

</html>
