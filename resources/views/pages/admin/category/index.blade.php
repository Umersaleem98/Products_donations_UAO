@include('layouts.admin.head')

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
                                    <h5>Categories</h5>

                                    <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-sm">
                                        + Add Category
                                    </a>
                                </div>

                                <div class="card-body">

                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Category Name</th>
                                                <th>Slug</th>
                                                <th>Created At</th>
                                                <th width="180">Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse($categories as $key => $category)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>{{ $category->created_at->format('Y-m-d') }}</td>

                                                <td>

                                                    <!-- EDIT -->
                                                    <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-warning btn-sm">
                                                        Edit
                                                    </a>

                                                    <!-- DELETE -->
                                                    <form action="{{ route('admin.category.delete', $category->id) }}" method="POST" style="display:inline-block">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                            Delete
                                                        </button>

                                                    </form>

                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No categories found</td>
                                            </tr>
                                            @endforelse
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
