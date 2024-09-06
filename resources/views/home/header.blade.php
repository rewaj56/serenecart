<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="{{url('/')}}"><img width="250" src="/images/logo.png" alt="#" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('products')}}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/show_cart') }}">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/show_order') }}">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/show_wishlist') }}">Wishlist</a>
                    </li>

                    @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <form method="post" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="btn" style="margin-left: 20px; background-color: #034762; color: white;">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item" style="margin-right: 10px; margin-left: 20px;">
                            <a class="btn" href="{{ route('login') }}" style="background-color: #e24e56; color: white;">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn" href="{{ route('register') }}" style="background-color: #034762; color: white;">Register</a>
                        </li>
                    @endauth
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</header>