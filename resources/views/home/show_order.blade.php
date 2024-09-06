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
                    <th>Payment Status</th>
                    <th>Delivery Status</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                @foreach ($order as $order)
                <tr>
                    <td>{{$order->product_title}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>${{$order->price}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->delivery_status}}</td>
                    <td>
                        <img src="/product/{{$order->image}}" alt="Product Image" style="max-width: 100px; max-height: 100px;">
                    </td>

                    <td>
                        @if($order->delivery_status == 'Processing') 
                        <a href="{{url('cancel_order', $order->id)}}" class="btn btn-danger">Cancel</a>
                        @else
                        <p style="color: blue;">Not allowed</p>
                        @endif
                    </td>                   
                </tr>
                @endforeach
            </table>
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