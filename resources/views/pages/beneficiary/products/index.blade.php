@include('layouts.admin.head')

<title>All Products</title>

<style>
    /* PRODUCT CARD */
    .product-card {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        transition: .25s ease-in-out;
        background: #fff;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 22px rgba(0,0,0,0.12);
    }

    .product-image {
        width: 100%;
        height: 210px;
        object-fit: cover;
    }

    .category-badge {
        background: #eef2f7;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        display: inline-block;
        color: #555;
    }

    /* PAGE HEADER FIX */
    .page-title-icon {
        border-radius: 10px;
    }

    /* FILTER CARD (CLEAN + SMALL HEIGHT) */
    .filter-card {
        border: none;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    }

    .filter-label {
        font-size: 13px;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 6px;
    }

    .form-control,
    .form-select {
        border-radius: 10px !important;
        height: 42px;
        font-size: 14px;
    }

    /* BUTTONS */
    .btn {
        border-radius: 10px;
        font-weight: 600;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* SEARCH ICON FIX */
    .input-group-text {
        border-radius: 10px 0 0 10px !important;
        background: #fff;
    }

    .input-group .form-control {
        border-left: 0;
    }

    /* PRODUCT GRID SPACING FIX */
    .product-grid {
        margin-top: 10px;
    }
</style>

<body>

<div class="container-scroller">

    @include('layouts.admin.header')

    <div class="container-fluid page-body-wrapper">

        @include('layouts.admin.sidebar')

        <div class="main-panel">

            <div class="content-wrapper">

                {{-- PAGE HEADER --}}
                <div class="page-header mb-3">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="mdi mdi-package-variant"></i>
                        </span>
                        Products
                    </h3>
                </div>

                @include('layouts.admin.alert')

                {{-- FILTER SECTION (COMPACT & CLEAN) --}}
                <div class="card filter-card mb-3">
                    <div class="card-body py-3">

                        <form method="GET" action="{{ route('beneficiary.products.index') }}">

                            <div class="row g-3 align-items-end">

                                {{-- CATEGORY --}}
                                <div class="col-md-4">
                                    <label class="filter-label">Category</label>

                                    <select name="category_id" class="form-select">

                                        <option value="">All Categories</option>

                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                {{-- SEARCH --}}
                                <div class="col-md-5">
                                    <label class="filter-label">Search Product</label>

                                    <div class="input-group">

                                        <span class="input-group-text">🔎</span>

                                        <input type="text"
                                               name="search"
                                               class="form-control"
                                               placeholder="Search products..."
                                               value="{{ request('search') }}">

                                    </div>
                                </div>

                                {{-- BUTTONS --}}
                                <div class="col-md-3 d-grid gap-2">

                                    <button type="submit" class="btn btn-primary">
                                        Search
                                    </button>

                                    <a href="{{ route('beneficiary.products.index') }}"
                                       class="btn btn-light">
                                        Reset
                                    </a>

                                </div>

                            </div>

                        </form>

                    </div>
                </div>

                {{-- PRODUCTS --}}
                <div class="row product-grid">

                    @forelse($products as $product)

                        @php
                            $images = json_decode($product->images, true);
                            $image = $images[0] ?? $product->images;
                        @endphp

                        <div class="col-lg-4 col-md-6 mb-4">

                            <div class="card product-card h-100">

                                <img src="{{ asset('admin/products/' . $image) }}"
                                     class="product-image">

                                <div class="card-body">

                                    <h5 class="mb-2">
                                        {{ $product->name }}
                                    </h5>

                                    <span class="category-badge">
                                        {{ $product->category->name ?? 'N/A' }}
                                    </span>

                                    <p class="mt-2 text-muted small">
                                        {{ \Illuminate\Support\Str::limit($product->description, 90) }}
                                    </p>

                                </div>

                                <div class="card-footer bg-white border-0 text-center">

                                    <a href="{{ route('beneficiary.products.detail.show', $product->id) }}"
                                       class="btn btn-primary btn-sm w-100">
                                        View Details
                                    </a>

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="col-12">
                            <div class="alert alert-warning text-center">
                                No products found
                            </div>
                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</div>

@include('layouts.admin.script')

</body>
