@include('layouts.admin.head')

<title>Manage Categories</title>

<body>

    {{-- New Sidebar --}}
    @include('layouts.admin.sidebar')


    {{-- Main Content Area --}}
    <div class="nsn-main">

        {{-- New Topbar --}}
        @include('layouts.admin.header')


        <main class="nsn-content">

            {{-- Page Heading --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

                <div>
                    <h3 class="fw-bold text-dark mb-1">
                        Categories
                    </h3>

                    <p class="text-secondary small mb-0">
                        Create and manage product categories.
                    </p>
                </div>

                {{-- Add Category Button --}}
                <button
                    type="button"
                    class="btn btn-primary d-flex align-items-center gap-2"
                    data-bs-toggle="modal"
                    data-bs-target="#addCategoryModal"
                >
                    <i class="bi bi-plus-lg"></i>
                    <span>Add Category</span>
                </button>

            </div>


            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb small mb-0">

                    <li class="breadcrumb-item">
                        <a
                            href="{{ route('dashboard') }}"
                            class="text-decoration-none"
                        >
                            <i class="bi bi-house-door me-1"></i>
                            Dashboard
                        </a>
                    </li>

                    <li
                        class="breadcrumb-item active"
                        aria-current="page"
                    >
                        Categories
                    </li>

                </ol>
            </nav>


            {{-- Alert Messages --}}
            @include('layouts.admin.alert')


            {{-- Categories Card --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                {{-- Card Header --}}
                <div class="card-header bg-white border-bottom px-4 py-3">

                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

                        <div>
                            <h5 class="fw-semibold text-dark mb-1">
                                All Categories
                            </h5>

                            <p class="text-secondary small mb-0">
                                Total categories:
                                <span class="fw-semibold text-dark">
                                    {{ $categories->total() }}
                                </span>
                            </p>
                        </div>

                        <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                            <i class="bi bi-grid me-1"></i>
                            {{ $categories->count() }} displayed
                        </span>

                    </div>

                </div>


                {{-- Card Body --}}
                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3 text-secondary small">
                                        #
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        Category
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        Slug
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        Created At
                                    </th>

                                    <th class="px-4 py-3 text-secondary small text-end">
                                        Actions
                                    </th>
                                </tr>
                            </thead>


                            <tbody>

                                @forelse ($categories as $key => $category)

                                    <tr>

                                        {{-- Serial Number --}}
                                        <td class="px-4">
                                            <span class="text-secondary">
                                                {{ $categories->firstItem() + $key }}
                                            </span>
                                        </td>


                                        {{-- Category Name --}}
                                        <td>
                                            <div class="d-flex align-items-center gap-3">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary"
                                                    style="width: 38px; height: 38px;"
                                                >
                                                    <i class="bi bi-tag"></i>
                                                </span>

                                                <div>
                                                    <div class="fw-semibold text-dark">
                                                        {{ $category->name }}
                                                    </div>

                                                    <small class="text-secondary">
                                                        Category ID: {{ $category->id }}
                                                    </small>
                                                </div>

                                            </div>
                                        </td>


                                        {{-- Slug --}}
                                        <td>
                                            <span class="badge bg-light text-secondary border fw-normal">
                                                {{ $category->slug }}
                                            </span>
                                        </td>


                                        {{-- Created Date --}}
                                        <td>
                                            <div class="text-dark small">
                                                <i class="bi bi-calendar3 text-secondary me-1"></i>

                                                {{ optional($category->created_at)->format('d M Y') }}
                                            </div>

                                            <small class="text-secondary">
                                                {{ optional($category->created_at)->diffForHumans() }}
                                            </small>
                                        </td>


                                        {{-- Actions --}}
                                        <td class="px-4 text-end">

                                            <div class="d-inline-flex align-items-center gap-2">

                                                {{-- Edit Button --}}
                                                <a
                                                    href="{{ route('admin.category.edit', $category->id) }}"
                                                    class="btn btn-outline-warning btn-sm"
                                                    title="Edit category"
                                                >
                                                    <i class="bi bi-pencil-square me-1"></i>
                                                    Edit
                                                </a>


                                                {{-- Delete Button --}}
                                                <form
                                                    action="{{ route('admin.category.delete', $category->id) }}"
                                                    method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this category?');"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="btn btn-outline-danger btn-sm"
                                                        title="Delete category"
                                                    >
                                                        <i class="bi bi-trash3 me-1"></i>
                                                        Delete
                                                    </button>
                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="5" class="text-center py-5">

                                            <div class="d-flex flex-column align-items-center">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light text-secondary mb-3"
                                                    style="width: 60px; height: 60px;"
                                                >
                                                    <i class="bi bi-folder-x fs-4"></i>
                                                </span>

                                                <h6 class="fw-semibold text-dark mb-1">
                                                    No categories found
                                                </h6>

                                                <p class="text-secondary small mb-3">
                                                    Create your first category to get started.
                                                </p>

                                                <button
                                                    type="button"
                                                    class="btn btn-primary btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#addCategoryModal"
                                                >
                                                    <i class="bi bi-plus-lg me-1"></i>
                                                    Add Category
                                                </button>

                                            </div>

                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>


                {{-- Pagination --}}
                @if ($categories->hasPages())

                    <div class="card-footer bg-white border-top px-4 py-3">

                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">

                            <p class="text-secondary small mb-0">
                                Showing
                                <span class="fw-semibold text-dark">
                                    {{ $categories->firstItem() }}
                                </span>
                                to
                                <span class="fw-semibold text-dark">
                                    {{ $categories->lastItem() }}
                                </span>
                                of
                                <span class="fw-semibold text-dark">
                                    {{ $categories->total() }}
                                </span>
                                categories
                            </p>

                            <div>
                                {{ $categories->withQueryString()->links() }}
                            </div>

                        </div>

                    </div>

                @endif

            </div>

        </main>

    </div>


    {{-- Add Category Modal --}}
    <div
        class="modal fade"
        id="addCategoryModal"
        tabindex="-1"
        aria-labelledby="addCategoryModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow rounded-4">

                <form
                    action="{{ route('admin.category.store') }}"
                    method="POST"
                >
                    @csrf

                    {{-- Modal Header --}}
                    <div class="modal-header border-bottom px-4 py-3">

                        <div>
                            <h5
                                class="modal-title fw-bold"
                                id="addCategoryModalLabel"
                            >
                                Add New Category
                            </h5>

                            <p class="text-secondary small mb-0 mt-1">
                                Enter the information for the new category.
                            </p>
                        </div>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>

                    </div>


                    {{-- Modal Body --}}
                    <div class="modal-body px-4 py-4">

                        <div class="mb-3">

                            <label
                                for="categoryName"
                                class="form-label fw-semibold"
                            >
                                Category Name
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group">

                                <span class="input-group-text bg-light">
                                    <i class="bi bi-tag"></i>
                                </span>

                                <input
                                    type="text"
                                    id="categoryName"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="For example: Electronics"
                                    required
                                    autofocus
                                >

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="form-text">
                                The category slug will be generated automatically.
                            </div>

                        </div>

                    </div>


                    {{-- Modal Footer --}}
                    <div class="modal-footer border-top px-4 py-3">

                        <button
                            type="button"
                            class="btn btn-light border"
                            data-bs-dismiss="modal"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            <i class="bi bi-check2-circle me-1"></i>
                            Save Category
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>


    @include('layouts.admin.script')


    {{-- Reopen modal when validation fails --}}
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modalElement = document.getElementById('addCategoryModal');

                if (modalElement) {
                    const categoryModal = new bootstrap.Modal(modalElement);
                    categoryModal.show();
                }
            });
        </script>
    @endif

</body>
