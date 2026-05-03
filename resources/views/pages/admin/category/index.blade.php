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

            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('layouts.admin.script')
