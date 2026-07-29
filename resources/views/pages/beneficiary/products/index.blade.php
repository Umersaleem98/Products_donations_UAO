@include('layouts.admin.head')

<title>All Products</title>

<body>

    @php
        $fallbackImage = asset('admin/asset/dummy/dummy.jpg');
    @endphp


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
                        Available Products
                    </h3>

                    <p class="text-secondary small mb-0">
                        Browse products shared by donors in the NUST community.
                    </p>
                </div>

                <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                    <i class="bi bi-box-seam me-1"></i>
                    {{ $products->total() }} products
                </span>

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
                        Available Products
                    </li>

                </ol>

            </nav>


            {{-- Alert Messages --}}
            @include('layouts.admin.alert')


            {{-- ================================================= --}}
            {{-- FILTER SECTION --}}
            {{-- ================================================= --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-body p-4">

                    <form
                        method="GET"
                        action="{{ route('beneficiary.products.index') }}"
                    >
                        <div class="row g-3 align-items-end">

                            {{-- Category --}}
                            <div class="col-12 col-md-5 col-xl-4">

                                <label
                                    for="categoryFilter"
                                    class="form-label fw-semibold small"
                                >
                                    Category
                                </label>

                                <select
                                    name="category_id"
                                    id="categoryFilter"
                                    class="form-select"
                                >
                                    <option value="">
                                        All Categories
                                    </option>

                                    @foreach ($categories as $category)

                                        <option
                                            value="{{ $category->id }}"
                                            @selected(
                                                request('category_id') == $category->id
                                            )
                                        >
                                            {{ $category->name }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- Search --}}
                            <div class="col-12 col-md-7 col-xl-5">

                                <label
                                    for="productSearch"
                                    class="form-label fw-semibold small"
                                >
                                    Search Product
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-search"></i>
                                    </span>

                                    <input
                                        type="search"
                                        id="productSearch"
                                        name="search"
                                        value="{{ request('search') }}"
                                        class="form-control"
                                        placeholder="Search by product name..."
                                    >

                                </div>

                            </div>


                            {{-- Filter Button --}}
                            <div class="col-12 col-sm-6 col-xl">

                                <button
                                    type="submit"
                                    class="btn btn-primary w-100"
                                >
                                    <i class="bi bi-funnel me-1"></i>
                                    Apply Filter
                                </button>

                            </div>


                            {{-- Reset Button --}}
                            <div class="col-12 col-sm-6 col-xl-auto">

                                <a
                                    href="{{ route('beneficiary.products.index') }}"
                                    class="btn btn-light border w-100"
                                >
                                    <i class="bi bi-arrow-counterclockwise me-1"></i>
                                    Reset
                                </a>

                            </div>

                        </div>
                    </form>

                </div>

            </div>


            {{-- Active Filters --}}
            @if (request()->filled('search') || request()->filled('category_id'))

                <div class="d-flex flex-wrap align-items-center gap-2 mb-4">

                    <span class="text-secondary small">
                        Active filters:
                    </span>

                    @if (request()->filled('search'))

                        <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                            <i class="bi bi-search me-1"></i>
                            “{{ request('search') }}”
                        </span>

                    @endif


                    @if (request()->filled('category_id'))

                        @php
                            $selectedCategory = $categories->firstWhere(
                                'id',
                                request('category_id')
                            );
                        @endphp

                        @if ($selectedCategory)
                            <span class="badge rounded-pill bg-info-subtle text-info-emphasis px-3 py-2">
                                <i class="bi bi-tag me-1"></i>
                                {{ $selectedCategory->name }}
                            </span>
                        @endif

                    @endif


                    <a
                        href="{{ route('beneficiary.products.index') }}"
                        class="small text-danger text-decoration-none"
                    >
                        Clear all
                    </a>

                </div>

            @endif


            {{-- ================================================= --}}
            {{-- PRODUCTS GRID --}}
            {{-- ================================================= --}}
            <div class="row g-4">

                @forelse ($products as $product)

                    @php
                        $productImages = is_array($product->images)
                            ? $product->images
                            : json_decode($product->images, true);

                        $productImages = is_array($productImages)
                            ? $productImages
                            : [];

                        $productImage = !empty($productImages)
                            ? asset('admin/products/' . $productImages[0])
                            : $fallbackImage;
                    @endphp


                    <div class="col-12 col-sm-6 col-xl-4">

                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">

                            {{-- Product Image --}}
                            <div class="position-relative">

                                <img
                                    src="{{ $productImage }}"
                                    alt="{{ $product->name }}"
                                    width="600"
                                    height="240"
                                    class="card-img-top object-fit-cover"
                                >


                                {{-- Status --}}
                                <span class="position-absolute top-0 end-0 badge rounded-pill bg-success m-3 px-3 py-2">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Available
                                </span>

                            </div>


                            {{-- Product Body --}}
                            <div class="card-body p-4">

                                <div class="d-flex flex-wrap align-items-center gap-2 mb-3">

                                    <span class="badge rounded-pill bg-primary-subtle text-primary">
                                        <i class="bi bi-tag me-1"></i>
                                        {{ optional($product->category)->name ?? 'Uncategorized' }}
                                    </span>

                                    @if (count($productImages) > 1)

                                        <span class="badge rounded-pill bg-light text-secondary border">
                                            <i class="bi bi-images me-1"></i>
                                            {{ count($productImages) }} images
                                        </span>

                                    @endif

                                </div>


                                <h5 class="fw-bold text-dark mb-2">
                                    {{ $product->name }}
                                </h5>


                                @if ($product->description)

                                    <p class="text-secondary small lh-base mb-0">
                                        {{ \Illuminate\Support\Str::limit(
                                            $product->description,
                                            105
                                        ) }}
                                    </p>

                                @else

                                    <p class="text-secondary small mb-0">
                                        No product description is available.
                                    </p>

                                @endif

                            </div>


                            {{-- Product Footer --}}
                            <div class="card-footer bg-white border-top p-4">

                                <a
                                    href="{{ route('beneficiary.products.detail.show', $product->id) }}"
                                    class="btn btn-primary w-100"
                                >
                                    View Product Details
                                    <i class="bi bi-arrow-right ms-1"></i>
                                </a>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="card border-0 shadow-sm rounded-4">

                            <div class="card-body text-center py-5">

                                <span
                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light text-secondary mb-3"
                                    style="width: 72px; height: 72px;"
                                >
                                    <i class="bi bi-search fs-2"></i>
                                </span>

                                <h5 class="fw-semibold text-dark mb-2">
                                    No products found
                                </h5>

                                <p class="text-secondary small mb-3">

                                    @if (
                                        request()->filled('search') ||
                                        request()->filled('category_id')
                                    )
                                        No products match your selected filters.
                                    @else
                                        There are currently no products available.
                                    @endif

                                </p>


                                @if (
                                    request()->filled('search') ||
                                    request()->filled('category_id')
                                )

                                    <a
                                        href="{{ route('beneficiary.products.index') }}"
                                        class="btn btn-primary btn-sm"
                                    >
                                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                                        Clear Filters
                                    </a>

                                @endif

                            </div>

                        </div>

                    </div>

                @endforelse

            </div>


            {{-- ================================================= --}}
            {{-- PAGINATION --}}
            {{-- ================================================= --}}
            @if ($products->hasPages())

                <div class="card border-0 shadow-sm rounded-4 mt-4">

                    <div class="card-body px-4 py-3">

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

                </div>

            @endif

        </main>

    </div>


    @include('layouts.admin.script')

</body>
