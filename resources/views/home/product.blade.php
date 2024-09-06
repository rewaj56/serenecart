<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
            <div class="mt-5">
                <form action="{{ url('product_search') }}" method="get">
                    @csrf
                    <input type="text" name="search" placeholder="Search for something..." style="width: 500px;">
                    <input type="submit" value="Search">
                </form>
            </div>
        </div>
        @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="row">
            <!-- $products used in place of $product, as we can't write $product as $products, when pagination is needed-->
            @foreach($product as $products)
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="box">
                    <div class="option_container">
                        <div class="options">
                            <a href="{{ url('product_details', $products->id) }}">
                                <i class="fa fa-info-circle fa-2x" aria-hidden="true"></i>
                            </a>
                            <form action="{{ url('add_wishlist', $products->id) }}" method="post">
                                @csrf
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fa fa-heart-o fa-lg"></i>
                                    </button>
                            </form>                                                       
                            
                            @if($products->quantity > 0)
                            <form action="{{ url('add_cart', $products->id) }}" method="post">
                                @csrf
                                <div class="row" style="padding-top: 5px;">
                                    <div class="col-md-4">
                                        <input type="number" name="quantity" value="1" min="1" max="{{$products->quantity}}" style="width: 100px;">
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
                    <div class="img-box">
                        <img src="product/{{$products->image}}" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            {{$products->title}}
                        </h5>

                        @if($products->discount_price != null)
                        <h6>
                            <del>${{$products->price}}</del>
                        </h6>
                        <h6 style="color: red;">
                            ${{$products->discount_price}}
                        </h6>
                        @else
                        <h6 style="color: red;">
                            ${{$products->price}}
                        </h6>
                        @endif

                    </div>
                </div>
            </div>
            @endforeach
            <div style="margin-top: 20px; width:100%;" class="flex-center">{!!$product->withQueryString()->links('pagination::bootstrap-4')!!}</div>
        </div>
    </div>
</section>