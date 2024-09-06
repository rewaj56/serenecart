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
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .h2_font {
            font-size: 40px;
            padding-bottom: 40px;
        }

        label {
            display: inline-block;
            width: 200px;
            ;
        }

        .div_design {
            padding-bottom: 15px;
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
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    <div class="div_center">
                        <h2 class="h2_font">Add Product</h2>

                        <!-- enctype : because we are also adding a file in product image -->
                        <form action="{{ url('/add_product') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="div_design">
                                <label for="">Product Title :</label>
                                <input type="text" name="title" placeholder="Write a title..." required>
                            </div>
                            <div class="div_design">
                                <label for="">Product Description :</label>
                                <input type="text" name="description" placeholder="Write a description..." required>
                            </div>
                            <div class="div_design">
                                <label for="">Product Price :</label>
                                <input type="number" name="price" placeholder="Write a price..." required>
                            </div>
                            <div class="div_design">
                                <label for="">Discount Price :</label>
                                <input type="number" name="discount_price" placeholder="Write a discount price...">
                            </div>
                            <div class="div_design">
                                <label for="">Product Quantity :</label>
                                <input type="number" min="0" name="quantity" placeholder="Write a quantity..." required>
                            </div>
                            <div class="div_design">
                                <label for="">Product Category :</label>
                                <select name="category" id="" required>
                                    <option value="" selected="">Add a category here...</option>
                                    @foreach($category as $category)
                                    <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="div_design">
                                <label for="">Product Image :</label>
                                <input type="file" name="image" placeholder="Pick an image..." required>
                            </div>
                            <div class="div_design">
                                <input class="btn btn-primary" type="submit" value="Add Product">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    @include('admin.script')

</body>

</html>