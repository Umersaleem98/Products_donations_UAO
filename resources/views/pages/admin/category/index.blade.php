@include('layouts.admin.head')

<title>Index Categories</title>

<body>
    <div class="container-scroller">

        @include('layouts.admin.header')

        <div class="container-fluid page-body-wrapper">

            @include('layouts.admin.sidebar')

            <div class="main-panel">

                <div class="content-wrapper">

                    <div class="page-header">

                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-home"></i>
                            </span>
                            Dashboard
                        </h3>

                        @include('layouts.admin.alert')

                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span></span>
                                    Overview
                                    <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                </li>
                            </ul>
                        </nav>

                    </div>

                    <!-- Categories -->
                    <div class="row">

                        <div class="col-12">

                            <div class="card shadow-sm">

                                <div class="card-header d-flex justify-content-between align-items-center">

                                    <h5 class="mb-0">Categories</h5>

                                    <button type="button"
                                        class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#addCategoryModal">

                                        + Add Category

                                    </button>

                                </div>

                                <div class="card-body">

                                    <div class="table-responsive">

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

                                                            <a href="{{ route('admin.category.edit', $category->id) }}"
                                                                class="btn btn-warning btn-sm">

                                                                Edit

                                                            </a>

                                                            <form action="{{ route('admin.category.delete', $category->id) }}"
                                                                method="POST"
                                                                style="display:inline-block">

                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Are you sure?')">

                                                                    Delete

                                                                </button>

                                                            </form>

                                                        </td>

                                                    </tr>

                                                @empty

                                                    <tr>
                                                        <td colspan="5" class="text-center">
                                                            No categories found
                                                        </td>
                                                    </tr>

                                                @endforelse

                                            </tbody>

                                        </table>

                                    </div>

                                    <div class="d-flex justify-content-end mt-3">
                                        {{ $categories->links() }}
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Add New Category
                    </h5>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <form action="{{ route('admin.category.store') }}" method="POST">

                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">

                            <label class="form-label">
                                Category Name
                            </label>

                            <input type="text"
                                name="name"
                                class="form-control"
                                placeholder="Enter category name"
                                required>

                        </div>



                    </div>

                    <div class="modal-footer">

                        <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                            Close

                        </button>

                        <button type="submit"
                            class="btn btn-primary">

                            Save Category

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    @include('layouts.admin.script')

</body>
