<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Serene Cart</title>
    <!-- plugins:css -->
    @include('admin.css')
    <style>
        .h2_class {
            text-align: center;
            font-size: 40px;
            padding-top: 20px;
        }

        .center-div {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding-top: 20px;
        }
    </style>

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.header')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <h2 class="h2_class">All Orders</h2>
                    <div class="center-div">
                        <form action="{{ url('search') }}" method="get">
                            @csrf
                            <input type="text" name="search" placeholder="Search for something">
                            <input type="submit" value="Search" class="btn btn-outline-primary">
                        </form>
                    </div>

                    <table class="table" style="margin-top: 30px;">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Product Title</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Payment Status</th>
                                <th>Delivery Status</th>
                                <th>Image</th>
                                <th>Delivered ?</th>
                                <th>Print PDF</th>
                            </tr>
                        </thead>


                        <tbody>
                            @forelse($order as $order)
                                <tr>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->product_title }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>{{ $order->price }}</td>
                                    <td>{{ $order->payment_status }}</td>
                                    <td>{{ $order->delivery_status }}</td>
                                    <td>
                                        <img src="/product/{{ $order->image }}" alt="Product"
                                            style="max-width: 100px; max-height: 100px;">
                                    </td>
                                    <td>
                                        @if ($order->delivery_status == 'Processing')
                                            <a href="#" class="btn btn-primary" data-toggle="modal"
                                                data-target="#confirmDeliveredModal">Delivered</a>

                                            <div class="modal fade" id="confirmDeliveredModal" tabindex="-1"
                                                role="dialog" aria-labelledby="confirmDeliveredModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmDeliveredModalLabel">
                                                                Confirm Delivered</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure the product is delivered?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                            <a href="{{ url('delivered', $order->id) }}"
                                                                class="btn btn-primary">Yes</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($order->delivery_status == 'Cancelled')
                                            <p style="color: #fc424a;">Cancelled</p>
                                        @else
                                            <p style="color: #00d25b;">Delivered</p>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('print_pdf', $order->id) }}" class="btn btn-secondary">Print
                                            PDF</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="16">
                                        No data found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    @include('admin.script')

</body>

</html>
