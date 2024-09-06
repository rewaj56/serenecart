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
                    <h2 class="h2_class">All Products</h2>
                    {{-- <table class="center"> --}}
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Discount Price</th>
                                <th>Product Image</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($product as $product)
                                <tr>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->category }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->discount_price }}</td>
                                    <td>
                                        <img src="/product/{{ $product->image }}" alt="Product"
                                            style="max-width: 100px; max-height: 100px;">
                                    </td>
                                    <!-- <td><a onclick="return confirm('Are you sure?')" href="{{ url('delete_product', $product->id) }}" class="btn btn-danger">Delete</a></td> -->
                                    <!-- triggers the modal when clicked -->
                                    <td>
                                        <a href="#" class="btn btn-danger" data-toggle="modal"
                                            data-target="#confirmDelete{{ $product->id }}">
                                            Delete
                                        </a>
                                    </td>

                                    <!-- Modal -->
                                    <div class="modal fade" id="confirmDelete{{ $product->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="confirmDeleteLabel{{ $product->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmDeleteLabel{{ $product->id }}">
                                                        Confirm Delete</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this product?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancel</button>
                                                    <a href="{{ url('delete_product', $product->id) }}"
                                                        class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <td><a href="{{ url('update_product', $product->id) }}"
                                            class="btn btn-success">Edit</a></td>
                                </tr>
                            @endforeach
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
