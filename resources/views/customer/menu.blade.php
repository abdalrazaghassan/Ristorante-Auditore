<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ristorante Auditore - Menu</title>
    <link rel="stylesheet" href="{{asset('css/swiper.min.css')}}">
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

        .swiper-container {
            width: 100%;
            height: 100%;
            padding-bottom: 2%;
            margin-bottom: -20%;
        }

        .swiper-slide {
            background-position: center;
            background-size: cover;
            width: auto;
            height: 300px;
            border-radius: 12px;
        }

        .card-body h4,
        p {
            color: black;
            text-align: center;
        }

        .card {
            background-color: white;
        }

        .Dishes {
            margin: 3%;
            border-style: double;
            border-radius: 20px;
            background-color: #d7e8f7;
            height: 110%;
        }

        .Dishes h1 {
            margin: 2%;
            color: black;
            font-weight: bold;
            text-align: center;
        }

        #tp {
            font-weight: bold;
        }

        .allSections {
            margin-top: 10%;
        }

        .offers {
            margin: 2%;
            padding: 2%;
        }

        #header-Offer{
            font-size: 22px;
            color: #FFF;
            text-align: center;
        }

        .content-offer {
            background-color: #0b2e13;
            width: 100%;
            height: 50%;
        }

        #img-offer{
            float: left;
        }

        #bioAndPrice-offer{
            background-color: #0f6674;
        }

        .name-order {
            text-align: center;
            background-color: #fff;
            border-width: 0px;
            font-size: 20px;
        }

    </style>
</head>

<body>
<!-- nav header -->
<nav class="navbar navbar-dark fixed-top" style="background-color: #183b8c;">
    <a class="navbar-brand mx-auto" href="menu.html">Ristorante Auditore - Menu</a>
    <!-- Button trigger modal -->
    <button type="button" class="btn  btn-info" data-toggle="modal" data-target="#exampleModalCenter">Details & Confirm</button>
</nav>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content align-items-center">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Order Details</h5>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item">item with price</li>
                    <li class="list-group-item">item with price</li>
                    <li class="list-group-item">item with price</li>
                    <li class="list-group-item">item with price</li>
                    <li class="list-group-item active" id="tp"></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Confirm your Order!</button>
            </div>
        </div>
    </div>
</div>

<div class="allSections">
    <section class="Dishes offers">
        <h1>Offers</h1>
        <div class="auto-swiper-container">
            <div class="swiper-wrapper">
                @foreach($initData['offers'] as $offer)
                     <div class="swiper-slide" style="background-color: #183b8c;">
                         <header id="header-Offer">
                            <h1> {{$offer->name}} </h1>
                            <h2> {{$offer->size}} </h2>
                            <h3>{{$offer->discount}}%</h3>
                         </header>
                         <section class="content-offer">
                             <img src="..." id="img-offer"/>
                             <div id="bioAndPrice-offer">
                                 <p class="bio-offer">{{$offer->bio}}</p>
                                 <div id="price-offer">{{$offer->price}}$</div>
                             </div>
                         </section>

                     </div>
                @endforeach
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <section class="Dishes">
                <h1>Entrees</h1>
                <!--Swiper -->
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($initData['Entrees'] as $item)
                            <div class="swiper-slide">
                                <form method="POST" action="{{route('menu.submit.order')}}" id="orderForm">
                                    @csrf
                                    <div class="card" style="width: 18rem;">
                                        <img src="{{asset('img/testPIC.jpg')}}" class="card-img-top">
                                        <div class="card-body" style="align-items: center;">
                                            <p class="card-text">{{$item->name}}</p>
                                            <input type="text" name="id_order" value="{{$item->id}}" hidden>
                                            <hr class="m-0">
                                            <textarea name="bioOrder" form="orderForm">
                                                {{$item->name}}
                                            </textarea>

                                            <div class="form-group">
                                                <label class="form-text">size</label>
                                                @foreach($initData['SizeItem'] as $sizeItem)
                                                    @if($sizeItem->item_id == $item->id)
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="pizzaSize" id="inlineRadio1" value="{{$sizeItem->price_size_id}}">
                                                            <label class="form-check-label" for="inlineRadio1">{{$sizeItem->size}} {{$sizeItem->price}}$</label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <label>Quantity</label>
                                            <input type="number" style="width:25%;" name="amountInput" min="0" max="20" value="0" step="1">
                                            <hr>
                                            <div class="container">
                                                <!-- Button trigger NotesModal -->
                                                <a href="{{url("menu/addNotes/$item->id")}}" target="_blank" class="btn  btn-danger" >Add Notes</a>
                                                <input type="submit" name="submit" value="Order" class="btn btn-group-sm btn-primary">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

            </section>

    <section class="Dishes">
        <h1>Main Dishes</h1>
        <!--Swiper -->
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($initData['Main Dishes'] as $item)
                    <div class="swiper-slide">
                        <form method="POST" action="{{route('menu.submit.order')}}">
                            @csrf
                            <div class="card" style="width: 18rem;">
                                <img src="{{asset('img/testPIC.jpg')}}" class="card-img-top">
                                <div class="card-body" style="align-items: center;">
                                    <h4>{{$item->name}}</h4>
                                    <hr class="m-0">
                                    <input type="text" value="{{$item->bio}}" name="notesOrder" class="card-text">
                                    <div class="form-group">
                                        <label class="form-text">size</label>
                                        @foreach($initData['SizeItem'] as $sizeItem)
                                            @if($sizeItem->item_id == $item->id)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="pizzaSize" id="inlineRadio1" value="{{$sizeItem->size}}">
                                                    <label class="form-check-label" for="inlineRadio1">{{$sizeItem->size}} {{$sizeItem->price}}$</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <label>Quantity</label>
                                    <input type="number" style="width:25%;" name="amountInput" min="0" max="20" value="0" step="1">
                                    <hr>
                                    <div class="container">
                                        <!-- Button trigger NotesModal -->
                                        <a href="{{url("menu/addNotes/$item->id")}}" target="_blank" class="btn  btn-danger" >Add Notes</a>
                                        <button type="button" class="btn btn-group-sm btn-primary">Order</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

        <section class="Dishes">
        <h1>Side Dishes</h1>
        <!--Swiper -->
            <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($initData['Side Dishes'] as $item)
                    <div class="swiper-slide">
                        <form method="POST" action="{{route('menu.submit.order')}}">
                            @csrf
                            <div class="card" style="width: 18rem;">
                                <img src="{{asset('img/testPIC.jpg')}}" class="card-img-top">
                                <div class="card-body" style="align-items: center;">
                                    <h4>{{$item->name}}</h4>
                                    <hr class="m-0">
                                    <input type="text" value="{{$item->bio}}" name="notes" class="card-text">
                                    <div class="form-group">
                                        <label class="form-text">size</label>
                                        @foreach($initData['SizeItem'] as $sizeItem)
                                            @if($sizeItem->item_id == $item->id)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="pizzaSize" id="inlineRadio1" value="{{$sizeItem->size}}">
                                                    <label class="form-check-label" for="inlineRadio1">{{$sizeItem->size}} {{$sizeItem->price}}$</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <label>Quantity</label>
                                    <input type="number" style="width:25%;" name="amountInput" min="0" max="20" value="0" step="1">
                                    <hr>
                                    <div class="container">
                                        <!-- Button trigger NotesModal -->
                                        <a href="{{url("menu/addNotes/$item->id")}}" target="_blank" class="btn  btn-danger" >Add Notes</a>
                                        <button type="button" class="btn btn-group-sm btn-primary">Order</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="Dishes">
        <h1>Pizza</h1>
        <!--Swiper -->
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="card" style="width: 19rem;">
                        <img src="img/testPIC.jpg" class="card-img-top">
                        <div class="card-body" style="align-items: center;">
                            <h4>Build your Pizza</h4>
                            <hr class="m-0">
                            <p class="card-text">
                            <form method="post" action="menu.html">
                                <div class="form-group">
                                    <label class="form-text">pizza size</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pizzaSize" id="inlineRadio1" value="small">
                                        <label class="form-check-label" for="inlineRadio1">S:14$</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pizzaSize" id="inlineRadio2" value="medium">
                                        <label class="form-check-label" for="inlineRadio2">M:20$</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pizzaSize" id="inlineRadio3" value="large">
                                        <label class="form-check-label" for="inlineRadio3">L:28$</label>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="topping1">Meats</label>
                                    </div>
                                    <select class="custom-select" id="topping1">
                                        <option selected>Choose...</option>
                                        <option value="none">None</option>
                                        <option value="Pepperoni">Pepperoni</option>
                                        <option value="Italian Sausage">Italian Sausage</option>
                                        <option value="Chicken">Chicken</option>
                                        <option value="Meatball">Meatball</option>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="topping2">Veggies</label>
                                    </div>
                                    <select class="custom-select" id="topping2">
                                        <option selected>Choose...</option>
                                        <option value="none">None</option>
                                        <option value="Mushroom">Mushroom</option>
                                        <option value="Onion">Onion</option>
                                        <option value="Bell Pepper">Bell Pepper</option>
                                        <option value="Black Olive">Black Olive</option>
                                    </select>
                                </div>
                                <div class="container">
                                    Quantity
                                    <input type="number" style="width:25%;" name="amountInput" min="0" max="20" value="0" step="1">
                                    <button type="submit" name="buildPizza" class="btn btn-group-sm btn-primary">Order</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="Dishes">
        <h1>Desserts</h1>
        <!--Swiper -->
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($initData['Side Dishes'] as $item)
                    <div class="swiper-slide">
                        <form method="POST" action="{{route('menu.submit.order')}}">
                            @csrf
                            <div class="card" style="width: 18rem;">
                                <img src="{{asset('img/testPIC.jpg')}}" class="card-img-top">
                                <div class="card-body" style="align-items: center;">
                                    <h4>{{$item->name}}</h4>
                                    <hr class="m-0">
                                    <input type="text" value="{{$item->bio}}" name="notes" class="card-text">
                                    <div class="form-group">
                                        <label class="form-text">size</label>
                                        @foreach($initData['SizeItem'] as $sizeItem)
                                            @if($sizeItem->item_id == $item->id)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="pizzaSize" id="inlineRadio1" value="{{$sizeItem->size}}">
                                                    <label class="form-check-label" for="inlineRadio1">{{$sizeItem->size}} {{$sizeItem->price}}$</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <label>Quantity</label>
                                    <input type="number" style="width:25%;" name="amountInput" min="0" max="20" value="0" step="1">
                                    <hr>
                                    <div class="container">
                                        <!-- Button trigger NotesModal -->
                                        <a href="{{url("menu/addNotes/$item->id")}}" type="submit" class="btn  btn-danger" >Add Notes</a>
                                        <button type="submit" class="btn btn-group-sm btn-primary">Order</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="{{asset('js/jquery-3.4.1.slim.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/swiper.min.js')}}"></script>
<!-- Initialize Swiper -->
<script>
    var totalPrice = 20;
    document.getElementById("tp").innerHTML = "Total Price: " + totalPrice;

    var swiper = new Swiper('.swiper-container', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: false,
        },

    });
</script>

<script>
    var swiper = new Swiper('.auto-swiper-container', {
        spaceBetween: 100,
        centeredSlides: true,
        autoplay: {
            delay: 2400,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        }
    });
</script>
    </section>

</div>

</body>

</html>
