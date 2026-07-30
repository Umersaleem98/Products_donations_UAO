@include('layouts.admin.head')

<title>My Products</title>

<body>

    {{-- New Sidebar --}}
    @include('layouts.admin.sidebar')


    {{-- Main Content --}}
    <div class="nsn-main">

        {{-- New Topbar --}}
        @include('layouts.admin.header')


        <main class="nsn-content">

            {{-- Page Header --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

                <div>
                    <h3 class="fw-bold text-dark mb-1">
                        My Products
                    </h3>

                    <p class="text-secondary small mb-0">
                        View and manage the products you have shared.
                    </p>
                </div>

                <a
                    href="{{ route('donor.product.create') }}"
                    class="btn btn-primary d-flex align-items-center gap-2"
                >
                    <i class="bi bi-plus-lg"></i>
                    <span>Add Product</span>
                </a>

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
                        My Products
                    </li>

                </ol>

            </nav>


            {{-- Alerts --}}
            @include('layouts.admin.alert')


            {{-- Products Card --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                {{-- Card Header --}}
                <div class="card-header bg-white border-bottom px-4 py-3">

                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

                        <div>
                            <h5 class="fw-semibold text-dark mb-1">
                                Products List
                            </h5>

                            <p class="text-secondary small mb-0">
                                Total products:
                                <span class="fw-semibold text-dark">
                                    {{ $products->total() }}
                                </span>
                            </p>
                        </div>

                        <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                            <i class="bi bi-box-seam me-1"></i>
                            {{ $products->count() }} displayed
                        </span>

                    </div>

                </div>


                {{-- Products Table --}}
                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3 text-secondary small">
                                        #
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        Product
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        Category
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        Status
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        Created
                                    </th>

                                    <th class="px-4 py-3 text-secondary small text-end">
                                        Actions
                                    </th>
                                </tr>
                            </thead>


                            <tbody>

                                @forelse ($products as $key => $product)

                                    @php
                                        $images = is_array($product->images)
                                            ? $product->images
                                            : json_decode($product->images, true);

                                        $images = is_array($images)
                                            ? $images
                                            : [];
                                    @endphp

                                    <tr>

                                        {{-- Number --}}
                                        <td class="px-4">
                                            <span class="text-secondary">
                                                {{ $products->firstItem() + $key }}
                                            </span>
                                        </td>


                                        {{-- Product --}}
                                        <td>

                                            <div class="d-flex align-items-center gap-3">

                                                @if (!empty($images))

                                                    <img
                                                        src="{{ asset('admins/products/' . $images[0]) }}"
                                                        alt="{{ $product->name }}"
                                                        width="60"
                                                        height="60"
                                                        class="rounded-3 border object-fit-cover flex-shrink-0"
                                                    >

                                                @else

                                                    <span
                                                        class="d-inline-flex align-items-center justify-content-center rounded-3 border bg-light text-secondary flex-shrink-0"
                                                        style="width: 60px; height: 60px;"
                                                    >
                                                        <i class="bi bi-image fs-5"></i>
                                                    </span>

                                                @endif


                                                <div>
                                                    <div class="fw-semibold text-dark">
                                                        {{ $product->name }}
                                                    </div>

                                                    <small class="text-secondary">
                                                        Product ID: #{{ $product->id }}
                                                    </small>
                                                </div>

                                            </div>

                                        </td>


                                        {{-- Category --}}
                                        <td>

                                            @if ($product->category)

                                                <span class="badge bg-light text-dark border fw-normal px-3 py-2">
                                                    <i class="bi bi-tag me-1"></i>
                                                    {{ $product->category->name }}
                                                </span>

                                            @else

                                                <span class="text-secondary small">
                                                    Not assigned
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Status --}}
                                        <td>

                                            @if ($product->status === 'active')

                                                <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                                                    <i class="bi bi-check-circle me-1"></i>
                                                    Active
                                                </span>

                                            @else

                                                <span class="badge rounded-pill bg-danger-subtle text-danger px-3 py-2">
                                                    <i class="bi bi-x-circle me-1"></i>
                                                    Inactive
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Created Date --}}
                                        <td>

                                            <div class="small text-dark">
                                                <i class="bi bi-calendar3 text-secondary me-1"></i>

                                                {{ optional($product->created_at)->format('d M Y') }}
                                            </div>

                                            <small class="text-secondary">
                                                {{ optional($product->created_at)->diffForHumans() }}
                                            </small>

                                        </td>


                                        {{-- Actions --}}
                                        <td class="px-4 text-end">

                                            <div class="d-inline-flex align-items-center gap-2">

                                                {{-- Edit --}}
                                                <a
                                                    href="{{ route('donor.product.edit', $product->id) }}"
                                                    class="btn btn-outline-warning btn-sm"
                                                    title="Edit product"
                                                >
                                                    <i class="bi bi-pencil-square me-1"></i>
                                                    Edit
                                                </a>


                                                {{-- Delete --}}
                                                <form
                                                    action="{{ route('donor.products.delete', $product->id) }}"
                                                    method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this product?');"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="btn btn-outline-danger btn-sm"
                                                        title="Delete product"
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
                                        <td colspan="6" class="text-center py-5">

                                            <div class="d-flex flex-column align-items-center">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light text-secondary mb-3"
                                                    style="width: 64px; height: 64px;"
                                                >
                                                    <i class="bi bi-box-seam fs-3"></i>
                                                </span>

                                                <h6 class="fw-semibold text-dark mb-1">
                                                    No products found
                                                </h6>

                                                <p class="text-secondary small mb-3">
                                                    You have not added any products yet.
                                                </p>

                                                <a
                                                    href="{{ route('donor.product.create') }}"
                                                    class="btn btn-primary btn-sm"
                                                >
                                                    <i class="bi bi-plus-lg me-1"></i>
                                                    Add Your First Product
                                                </a>

                                            </div>

                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>


                {{-- Pagination --}}
                @if ($products->hasPages())

                    <div class="card-footer bg-white border-top px-4 py-3">

                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">

                            <p class="text-secondary small mb-0">
                                Showing
                                <span class="fw-semibold text-dark">
                                    {{ $products->firstItem() }}
                                </span>
                                to
                                <span class="fw-semibold text-dark">
                                    {{ $products->lastItem() }}
                                </span>
                                of
                                <span class="fw-semibold text-dark">
                                    {{ $products->total() }}
                                </span>
                                products
                            </p>

                            <div>
                                {{ $products->withQueryString()->links() }}
                            </div>

                        </div>

                    </div>

                @endif

            </div>

        </main>

    </div>


    @include('layouts.admin.script')

</body>
