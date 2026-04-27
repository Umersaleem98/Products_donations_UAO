@include('layouts.admin.head')
<title>Admin Product Index</title>
<body class="h-100">

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            @include('layouts.admin.sidebar')

            <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">

                <!-- Navbar -->
                <div class="main-navbar sticky-top bg-white">
                    @include('layouts.admin.header')
                </div>

                <!-- Content -->
                <div class="main-content-container container-fluid px-4">

                    <!-- Page Header -->
                    <div class="page-header row no-gutters py-4">
                        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                            <span class="text-uppercase page-subtitle">Dashboard</span>
                            <h3 class="page-title">Admin Overview</h3>
                        </div>
                    </div>

                    <!-- Stats Row -->
                    <div class="row">

                        <div class="col-12">
                            <div class="card shadow-sm">

                                <div class="card-header d-flex justify-content-between">
                                    <h5>Products</h5>

                                   
<a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">
  + Add Product
</a>
                                </div>

                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Added By</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($products as $key => $product)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>{{ $product->user->name }}</td>
                                                <td>{{ $product->price }}</td>

                                                <td>
                                                    <a href="{{ route('admin.products.edit',$product->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                                    <form action="{{ route('admin.products.delete',$product->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </form>

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </main>
        </div>
    </div>

    @include('layouts.admin.script')
