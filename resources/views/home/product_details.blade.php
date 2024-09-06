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
</head>

<body>
    <div class="hero_area">
        <!-- header section start -->
        @include('home.header')
        <!-- end header section -->

        <div class="box" style="display: flex; justify-content: center; align-items: center; width: 100%;">
            <div class="col-sm-6 col-md-4 col-lg-4" style="margin-top: 30px;">
                <div class="img-box" style="max-width: 250px; margin: auto;">
                    <img src="/product/{{$product->image}}" alt="" style="max-width: 100%; height: auto;">
                </div>
                <div class="detail-box" style="margin-top: 10px; text-align: center;">
                    <h5>{{$product->title}}</h5>
                    @if($product->discount_price != null)
                    <h6><del style="color: red;">${{$product->price}}</del></h6>
                    <h6 style="color: red;">${{$product->discount_price}}</h6>
                    @else
                    <h6 style="color: red;">${{$product->price}}</h6>
                    @endif
                    <h6>Product Category: {{$product->category}}</h6>
                    <h6>Product Details: {{$product->description}}</h6>
                    <h6>Available Quantity: {{$product->quantity}}</h6>
                    @if($product->quantity > 0)
                    <form action="{{ url('add_cart', $product->id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <input type="number" name="quantity" value="1" min="1" style="width: 100px;">
                            </div>
                            <div class="col-md-4">
                                <input type="submit" value="Add to Cart">
                            </div>
                        </div>
                    </form>
                    @else
                    <span class="text-danger font-weight-bold">Out of stock</span>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->

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