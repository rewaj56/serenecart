<!DOCTYPE html>
<html>

<head>
   <!-- Basic -->
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <!-- Mobile Metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <!-- Site Metas -->
   <meta name="keywords" content="" />
   <meta name="description" content="" />
   <meta name="author" content="" />
   <link rel="shortcut icon" href="images/favicon.png" type="">
   <title>SereneCart</title>
   <!-- bootstrap core css -->
   <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
   <!-- font awesome style -->
   <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
   <!-- Custom styles for this template -->
   <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
   <!-- responsive style -->
   <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />

    <style>
        .center {
            margin: auto;
            width: auto;
            text-align: center;
            padding: 30px;
            background-color: #ffe5ec;
        }

        .hero_area {
            background-color: #ffe5ec;
        }

        th {
            white-space: nowrap;
            padding: 15px;
            background-color: lightblue;
        }

        th,
        td {
            border: 2px solid grey;
        }

        td {
            white-space: nowrap;
            padding: 10px;
        }
    </style>

</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

        @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get('message') }}
        </div>
        @endif

        <div class="center">
            <table>
                <tr>
                    <th>Product title</th>
                    <th>Product quantity</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>

                <?php $totalprice = 0; ?>
                @foreach ($cart as $cart)
                <tr>
                    <td>{{$cart->product_title}}</td>
                    <td>{{$cart->quantity}}</td>
                    <td>${{$cart->price}}</td>
                    <td>
                        <img src="/product/{{$cart->image}}" alt="Product Image" style="max-width: 100px; max-height: 100px;">
                    </td>
                    <td>
                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete{{$cart->id}}">
                            Delete
                        </a>
                    </td>

                    <div class="modal fade" id="confirmDelete{{$cart->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel{{$cart->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteLabel{{$cart->id}}">Confirm Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this product?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <a href="{{ url('remove_cart', $cart->id) }}" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </tr>
                <?php $totalprice = $totalprice + $cart->price; ?>
                @endforeach
            </table>
            <div style="font-size: 20px; padding: 40px;">
                Total Price: ${{$totalprice}}
            </div>
            @if($cart->count() === 0)
            <div>
                <h4 style="padding-bottom: 15px;">Your cart is empty !</h4>
            </div>
            @else
            <div>
                <h3 style="padding-bottom: 15px;">Proceed to Order</h3>
                <a href="{{ url('cash_order') }}" class="btn btn-danger">Cash on Delivery</a>
                <a href="{{ url('epay_order') }}" class="btn btn-danger">e-Pay</a>
            </div>
            @endif
        </div>
    </div>

    <!-- jQery -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>
</body>

</html>