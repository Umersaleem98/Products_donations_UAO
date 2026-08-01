@include('layouts.admin.head')

<title>All Products</title>

<style>
    :root {
        --product-primary: #0d6efd;
        --product-primary-dark: #084298;
        --product-text: #182230;
        --product-muted: #667085;
        --product-border: #e7ebf0;
        --product-surface: #ffffff;
    }

    .product-page-header {
        padding: 1.25rem 1.35rem;
        background: linear-gradient(135deg, #ffffff 0%, #f4f8ff 100%);
        border: 1px solid var(--product-border);
        border-radius: 1rem;
    }

    .product-filter-card {
        border: 1px solid var(--product-border) !important;
        box-shadow: 0 8px 28px rgba(16, 24, 40, .06) !important;
    }

    .product-filter-card .form-control,
    .product-filter-card .form-select,
    .product-filter-card .input-group-text {
        min-height: 46px;
        border-color: #dfe4ea;
    }

    .product-filter-card .form-control:focus,
    .product-filter-card .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .12);
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 1.1rem;
    }

    .product-card {
        min-width: 0;
        background: var(--product-surface);
        border: 1px solid var(--product-border) !important;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(16, 24, 40, .055);
        transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
    }

    .product-card:hover {
        transform: translateY(-6px);
        border-color: #c9dcff !important;
        box-shadow: 0 16px 35px rgba(16, 24, 40, .12);
    }

    .product-image-wrap {
        position: relative;
        aspect-ratio: 4 / 3;
        overflow: hidden;
        background: #f2f4f7;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .45s ease;
    }

    .product-card:hover .product-image { transform: scale(1.055); }

    .available-badge {
        position: absolute;
        top: .7rem;
        right: .7rem;
        padding: .42rem .65rem;
        background: rgba(25, 135, 84, .94);
        color: #fff;
        border: 1px solid rgba(255,255,255,.35);
        border-radius: 999px;
        font-size: .7rem;
        font-weight: 700;
        backdrop-filter: blur(6px);
    }

    .image-count-badge {
        position: absolute;
        left: .7rem;
        bottom: .7rem;
        padding: .38rem .55rem;
        background: rgba(16, 24, 40, .78);
        color: #fff;
        border-radius: .55rem;
        font-size: .7rem;
        backdrop-filter: blur(6px);
    }

    .product-card-body {
        display: flex;
        flex: 1 1 auto;
        flex-direction: column;
        padding: 1rem;
    }

    .product-category {
        display: inline-flex;
        align-items: center;
        align-self: flex-start;
        max-width: 100%;
        padding: .35rem .6rem;
        margin-bottom: .75rem;
        color: var(--product-primary-dark);
        background: #eaf2ff;
        border-radius: 999px;
        font-size: .7rem;
        font-weight: 700;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .product-title {
        color: var(--product-text);
        font-size: .98rem;
        font-weight: 700;
        line-height: 1.35;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
        min-height: 2.65rem;
    }

    .product-description {
        color: var(--product-muted);
        font-size: .78rem;
        line-height: 1.55;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        overflow: hidden;
        min-height: 3.65rem;
    }

    .product-card-footer {
        padding: 0 1rem 1rem;
        background: #fff;
        border: 0;
    }

    .product-detail-btn {
        min-height: 40px;
        border-radius: .7rem;
        font-size: .78rem;
        font-weight: 700;
        transition: all .2s ease;
    }

    .empty-products { grid-column: 1 / -1; }

    @media (max-width: 1399.98px) {
        .products-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); }
    }

    @media (max-width: 1199.98px) {
        .products-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    }

    @media (max-width: 767.98px) {
        .products-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: .85rem; }
        .product-page-header { padding: 1rem; }
    }

    @media (max-width: 479.98px) {
        .products-grid { grid-template-columns: 1fr; }
    }
</style>

<body>

    @php
        $fallbackImage = asset('admins/asset/dummy/dummy.jpg');
    @endphp


    {{-- New Sidebar --}}
    @include('layouts.admin.sidebar')


    {{-- Main Content --}}
    <div class="nsn-main">

        {{-- New Topbar --}}
        @include('layouts.admin.header')


        <main class="nsn-content">

            {{-- Page Header --}}
            <div class="product-page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

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
            <div class="card product-filter-card border-0 shadow-sm rounded-4 mb-4">

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
                                    {{-- <i class="bi bi-funnel me-1"></i> --}}
                                    Apply Filter
                                </button>

                            </div>


                            {{-- Reset Button --}}
                            <div class="col-12 col-sm-6 col-xl-auto">

                                <a
                                    href="{{ route('beneficiary.products.index') }}"
                                    class="btn btn-light border w-100"
                                >
                                    {{-- <i class="bi bi-arrow-counterclockwise me-1"></i> --}}
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
            <div class="products-grid">

                @forelse ($products as $product)

                    @php
                        $productImages = is_array($product->images)
                            ? $product->images
                            : json_decode($product->images, true);

                        $productImages = is_array($productImages)
                            ? $productImages
                            : [];

                        $productImage = !empty($productImages)
                            ? asset('admins/products/' . $productImages[0])
                            : $fallbackImage;
                    @endphp


                    <article class="product-card card h-100">

                            {{-- Product Image --}}
                            <div class="product-image-wrap">

                                <img
                                    src="{{ $productImage }}"
                                    alt="{{ $product->name }}"
                                    width="420"
                                    height="315"
                                    class="product-image"
                                    loading="lazy"
                                    decoding="async"
                                    onerror="this.onerror=null;this.src='{{ $fallbackImage }}';"
                                >


                                {{-- Status --}}
                                <span class="available-badge">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Available
                                </span>

                                @if (count($productImages) > 1)
                                    <span class="image-count-badge">
                                        <i class="bi bi-images me-1"></i>
                                        {{ count($productImages) }} photos
                                    </span>
                                @endif

                            </div>


                            {{-- Product Body --}}
                            <div class="product-card-body card-body">

                                    <span class="product-category" title="{{ optional($product->category)->name ?? 'Uncategorized' }}">
                                        <i class="bi bi-tag me-1"></i>
                                        {{ optional($product->category)->name ?? 'Uncategorized' }}
                                    </span>

                                <h2 class="product-title mb-2">
                                    {{ $product->name }}
                                </h2>


                                @if ($product->description)

                                    <p class="product-description mb-0">
                                        {{ \Illuminate\Support\Str::limit(
                                            $product->description,
                                            105
                                        ) }}
                                    </p>

                                @else

                                    <p class="product-description mb-0">
                                        No product description is available.
                                    </p>

                                @endif

                            </div>


                            {{-- Product Footer --}}
                            <div class="product-card-footer card-footer">

                                <a
                                    href="{{ route('beneficiary.products.detail.show', $product->id) }}"
                                    class="product-detail-btn btn btn-primary d-flex align-items-center justify-content-center w-100"
                                    aria-label="View details for {{ $product->name }}"
                                >
                                    View Details
                                    <i class="bi bi-arrow-right ms-1"></i>
                                </a>

                            </div>

                    </article>

                @empty

                    <div class="empty-products">

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
