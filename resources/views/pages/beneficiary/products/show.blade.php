@include('layouts.admin.head')

<title>My Product Request</title>

<style>

    .product-image {
        width: 100%;
        height: 420px;
        object-fit: cover;
        border-radius: 12px;
    }

    .product-card {
        border: none;
        border-radius: 14px;
        overflow: hidden;
    }

    .product-details-card {
        border: none;
        border-radius: 14px;
    }

    .product-title {
        font-size: 30px;
        font-weight: 700;
        color: #222;
    }

    .product-info {
        font-size: 15px;
        margin-bottom: 12px;
    }

    .product-description {
        white-space: pre-line;
        line-height: 1.9;
        font-size: 15px;
        color: #555;
    }

    .product-badge {
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 600;
    }

    .badge-active {
        background: #d4edda;
        color: #155724;
    }

    .badge-inactive {
        background: #f8d7da;
        color: #721c24;
    }

    .related-title {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .related-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: .3s;
    }

    .related-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    .related-image {
        width: 100%;
        height: 160px;
        object-fit: cover;
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
                <div class="page-header">

                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="mdi mdi-package-variant"></i>
                        </span>
                        Product Details
                    </h3>

                </div>

                @include('layouts.admin.alert')

                <div class="container mt-4">

                    <div class="row g-4">

                        {{-- IMAGE --}}
                        <div class="col-md-5">

                            @php
                                $images = json_decode($product->images, true);
                                $mainImage = $images[0] ?? $product->images;
                            @endphp

                            <div class="card shadow-sm product-card">

                                <img src="{{ asset('admin/products/' . $mainImage) }}"
                                     class="product-image">

                            </div>

                        </div>

                        {{-- DETAILS --}}
                        <div class="col-md-7">

                            <div class="card shadow-sm product-details-card">

                                <div class="card-body p-4">

                                    <h2 class="product-title mb-3">
                                        {{ $product->name }}
                                    </h2>

                                    <div class="product-info">
                                        <strong>Category:</strong>
                                        {{ $product->category->name ?? 'N/A' }}
                                    </div>

                                    <div class="product-info">
                                        <strong>Status:</strong>

                                        @if($product->status == 'active')
                                            <span class="product-badge badge-active">Active</span>
                                        @else
                                            <span class="product-badge badge-inactive">Inactive</span>
                                        @endif

                                    </div>

                                    <hr>

                                    <h5>Product Description</h5>

                                    <div class="product-description">
                                        {{ $product->description }}
                                    </div>

                                    <div class="mt-4">

                                        @if ($requestExists)

                                            <button class="btn btn-secondary" disabled>
                                                Request Sent
                                            </button>

                                        @else

                                            <form method="POST"
                                                  action="{{ route('product.request.send', $product->id) }}"
                                                  style="display:inline-block;">

                                                @csrf

                                                <button type="submit"
                                                        class="btn btn-gradient-primary">
                                                    Send Request
                                                </button>

                                            </form>

                                        @endif

                                        <a href="{{ url()->previous() }}"
                                           class="btn btn-secondary ms-2">
                                            Back
                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- RELATED PRODUCTS SECTION --}}
                    @if($relatedProducts->count() > 0)

                        <div class="mt-5">

                            <h4 class="related-title">
                                🔗 Related Products
                            </h4>

                            <div class="row">

                                @foreach($relatedProducts as $rProduct)

                                    @php
                                        $images = json_decode($rProduct->images, true);
                                        $image = $images[0] ?? $rProduct->images;
                                    @endphp

                                    <div class="col-md-4 mb-4">

                                        <div class="card related-card">

                                            <img src="{{ asset('admin/products/' . $image) }}"
                                                 class="related-image">

                                            <div class="card-body">

                                                <h6 class="mb-2">
                                                    {{ $rProduct->name }}
                                                </h6>

                                                <small class="text-muted">
                                                    {{ $rProduct->category->name ?? 'N/A' }}
                                                </small>

                                                <div class="mt-3">

                                                    <a href="{{ route('beneficiary.products.detail.show', $rProduct->id) }}"
                                                       class="btn btn-sm btn-primary w-100">

                                                        View Details

                                                    </a>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@include('layouts.admin.script')

</body>
