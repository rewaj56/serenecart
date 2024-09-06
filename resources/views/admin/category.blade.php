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
            margin-bottom: 40px;
        }

        .h2_font {
            font-size: 40px;
            padding-bottom: 40px;
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

            <!-- main-panel starts -->
            <div class="main-panel">
                <div class="content-wrapper">

                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    <div class="div_center">
                        <h2 class="h2_font">Add Category</h2>
                        <form action="{{ url('/add_category') }}" method="post">
                            @csrf
                            <input type="text" name="category" placeholder="Write a category name...">
                            <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                        </form>
                    </div>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Category Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $data)
                                <tr>
                                    <td>{{ $data->category_name }}</td>
                                    <!-- <td><a onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger" href="{{ url('delete_category', $data->id) }}">Delete</a></td> -->
                                    <td>
                                        <a href="#" class="btn btn-danger" data-toggle="modal"
                                            data-target="#confirmDeleteCategory{{ $data->id }}">
                                            Delete
                                        </a>
                                    </td>

                                    <!-- Modal -->
                                    <div class="modal fade" id="confirmDeleteCategory{{ $data->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="confirmDeleteCategoryLabel{{ $data->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="confirmDeleteCategoryLabel{{ $data->id }}">Confirm
                                                        Delete</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this category?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancel</button>
                                                    <a href="{{ url('delete_category', $data->id) }}"
                                                        class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    @include('admin.script')

</body>

</html>
