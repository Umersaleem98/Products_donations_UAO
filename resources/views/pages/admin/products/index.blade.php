@include('layouts.admin.head')

<body>
    <div class="container-scroller">

        @include('layouts.admin.header')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            @include('layouts.admin.sidebar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-home"></i>
                            </span> Dashboard
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span></span>Overview <i
                                        class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                </li>
                            </ul>
                        </nav>
                    </div>
                  

 <!-- TABLE -->
                <div class="row">
                    <div class="col-12">

                        <div class="card shadow-sm">

                            <!-- HEADER -->
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5>Products</h5>

                                <a href="{{ route('admin.products.create') }}"
                                   class="btn btn-primary btn-sm">
                                    + Add Product
                                </a>
                            </div>

                            <!-- BODY -->
                            <div class="card-body">

                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <table class="table table-bordered table-hover align-middle">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Added By</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    @forelse($products as $key => $product)

                                        <tr>
                                            <td>{{ $key + 1 }}</td>

                                            <!-- IMAGE -->
                                            <td>
                                                @php
                                                    $images = json_decode($product->images, true);
                                                @endphp

                                                @if(!empty($images))
                                                    <img src="{{ asset('admin/products/'.$images[0]) }}"
                                                         width="60"
                                                         height="60"
                                                         style="object-fit:cover;border-radius:6px;">
                                                @else
                                                    N/A
                                                @endif
                                            </td>

                                            <!-- NAME -->
                                            <td>{{ $product->name }}</td>

                                            <!-- CATEGORY -->
                                            <td>{{ $product->category->name ?? 'N/A' }}</td>

                                            <!-- USER -->
                                            <td>{{ $product->user->name ?? 'N/A' }}</td>

                                            <!-- PRICE -->
                                            <td>{{ $product->price }}</td>

                                            <!-- STATUS -->
                                            <td>
                                                @if($product->status == 'active')
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <!-- ACTION -->
                                            <td>

                                                <a href="{{ route('admin.product.edit', $product->id) }}"
                                                   class="btn btn-warning btn-sm">
                                                    Edit
                                                </a>

                                                <form action="{{ url('admin.product.delete', $product->id) }}"
                                                      method="POST"
                                                      style="display:inline-block">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure?')">
                                                        Delete
                                                    </button>

                                                </form>

                                            </td>
                                        </tr>

                                    @empty

                                        <tr>
                                            <td colspan="8" class="text-center">
                                                No products found
                                            </td>
                                        </tr>

                                    @endforelse

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>
                </div>

                </div>

            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('layouts.admin.script')
