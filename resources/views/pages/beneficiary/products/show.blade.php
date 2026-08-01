@include('layouts.admin.head')

<title>{{ $product->name }} | Product Details</title>

<style>
    :root {
        --pd-primary: #0d6efd;
        --pd-primary-dark: #084298;
        --pd-text: #182230;
        --pd-muted: #667085;
        --pd-border: #e6eaf0;
        --pd-surface: #fff;
    }

    .product-detail-header {
        padding: 1.25rem 1.4rem;
        background: linear-gradient(135deg, #fff 0%, #f3f7ff 100%);
        border: 1px solid var(--pd-border);
        border-radius: 1rem;
    }

    .detail-card {
        border: 1px solid var(--pd-border) !important;
        border-radius: 1rem;
        box-shadow: 0 10px 32px rgba(16, 24, 40, .07) !important;
    }

    .product-gallery {
        position: sticky;
        top: 1.25rem;
    }

    .gallery-main {
        aspect-ratio: 4 / 3;
        background: #f2f4f7;
        overflow: hidden;
    }

    .gallery-main .carousel-inner,
    .gallery-main .carousel-item { height: 100%; }

    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
        background: #f8fafc;
    }

    .gallery-counter {
        position: absolute;
        z-index: 3;
        right: .85rem;
        bottom: .85rem;
        padding: .4rem .65rem;
        color: #fff;
        background: rgba(16, 24, 40, .75);
        border-radius: 999px;
        font-size: .75rem;
        backdrop-filter: blur(6px);
    }

    .carousel-control-prev,
    .carousel-control-next { width: 14%; }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 2.25rem;
        height: 2.25rem;
        padding: .55rem;
        background-color: rgba(16, 24, 40, .72);
        background-size: 55%;
        border-radius: 50%;
    }

    .thumbnail-strip {
        display: flex;
        gap: .65rem;
        overflow-x: auto;
        padding: .85rem;
        scrollbar-width: thin;
    }

    .gallery-thumbnail {
        flex: 0 0 auto;
        width: 72px;
        height: 62px;
        padding: 3px;
        overflow: hidden;
        background: #fff;
        border: 2px solid transparent !important;
        border-radius: .65rem;
        transition: border-color .2s ease, transform .2s ease;
    }

    .gallery-thumbnail:hover,
    .gallery-thumbnail.active {
        border-color: var(--pd-primary) !important;
        transform: translateY(-2px);
    }

    .gallery-thumbnail img { width: 100%; height: 100%; object-fit: cover; }

    .product-name {
        color: var(--pd-text);
        font-size: clamp(1.65rem, 3vw, 2.35rem);
        line-height: 1.2;
    }

    .product-id {
        display: inline-flex;
        align-items: center;
        padding: .35rem .65rem;
        color: var(--pd-muted);
        background: #f8f9fb;
        border: 1px solid var(--pd-border);
        border-radius: .55rem;
        font-size: .76rem;
    }

    .product-facts {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: .75rem;
        margin-bottom: 1.5rem;
    }

    .product-fact {
        min-width: 0;
        padding: 1rem;
        background: #f8fafc;
        border: 1px solid var(--pd-border);
        border-radius: .85rem;
    }

    .fact-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        margin-bottom: .65rem;
        color: var(--pd-primary);
        background: #eaf2ff;
        border-radius: .65rem;
    }

    .fact-label { color: var(--pd-muted); font-size: .72rem; }
    .fact-value { color: var(--pd-text); font-size: .84rem; overflow-wrap: anywhere; }

    .description-box {
        padding: 1.15rem;
        color: #475467;
        background: #fbfcfe;
        border: 1px solid var(--pd-border);
        border-radius: .85rem;
        line-height: 1.75;
    }

    .request-notice { border: 0; border-left: 4px solid currentColor; border-radius: .75rem; }

    .product-actions {
        padding-top: 1.25rem;
        border-top: 1px solid var(--pd-border);
    }

    .product-actions .btn {
        min-height: 46px;
        padding-inline: 1.15rem;
        border-radius: .7rem;
        font-weight: 600;
    }

    .related-products-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 1rem;
    }

    .related-product-card {
        min-width: 0;
        overflow: hidden;
        border: 1px solid var(--pd-border) !important;
        border-radius: 1rem;
        box-shadow: 0 6px 20px rgba(16, 24, 40, .055);
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .related-product-card:hover { transform: translateY(-5px); box-shadow: 0 14px 30px rgba(16, 24, 40, .11); }
    .related-image-wrap { aspect-ratio: 4 / 3; overflow: hidden; background: #f2f4f7; }
    .related-image { width: 100%; height: 100%; object-fit: cover; transition: transform .4s ease; }
    .related-product-card:hover .related-image { transform: scale(1.05); }

    .related-title {
        display: -webkit-box;
        min-height: 2.7rem;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        font-size: 1rem;
        line-height: 1.35;
    }

    .related-description {
        display: -webkit-box;
        min-height: 3.75rem;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        color: var(--pd-muted);
        font-size: .8rem;
        line-height: 1.55;
    }

    @media (max-width: 1199.98px) {
        .product-gallery { position: static; }
        .related-products-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    }

    @media (max-width: 767.98px) {
        .product-detail-header { padding: 1rem; }
        .product-facts { grid-template-columns: 1fr; gap: .6rem; }
        .product-fact { display: flex; align-items: center; gap: .75rem; padding: .8rem; }
        .fact-icon { flex: 0 0 auto; margin: 0; }
        .related-products-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }

    @media (max-width: 479.98px) {
        .related-products-grid { grid-template-columns: 1fr; }
        .product-actions .btn,
        .product-actions form { width: 100%; }
        .product-actions form .btn { width: 100%; }
    }
</style>

<body>

    @php
        $productImages = is_array($product->images)
            ? $product->images
            : json_decode($product->images, true);

        $productImages = is_array($productImages)
            ? array_values(array_filter($productImages))
            : [];

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
            <div class="product-detail-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

                <div>
                    <h3 class="fw-bold text-dark mb-1">
                        Product Details
                    </h3>

                    <p class="text-secondary small mb-0">
                        Review product information before submitting your request.
                    </p>
                </div>

                <a
                    href="{{ url()->previous() }}"
                    class="btn btn-light border d-flex align-items-center gap-2"
                >
                    <i class="bi bi-arrow-left"></i>
                    <span>Go Back</span>
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

                    <li class="breadcrumb-item">
                        <a
                            href="{{ route('beneficiary.products.index') }}"
                            class="text-decoration-none"
                        >
                            Products
                        </a>
                    </li>

                    <li
                        class="breadcrumb-item active"
                        aria-current="page"
                    >
                        {{ $product->name }}
                    </li>

                </ol>

            </nav>


            {{-- Alert Messages --}}
            @include('layouts.admin.alert')


            {{-- Product Details --}}
            <div class="row g-4">

                {{-- Product Images --}}
                <div class="col-12 col-xl-5 product-gallery">

                    <div class="detail-card card overflow-hidden">

                        @if (!empty($productImages))

                            <div
                                id="productImageCarousel"
                                class="gallery-main carousel slide"
                                data-bs-ride="false"
                            >
                                <div class="carousel-inner">

                                    @foreach ($productImages as $index => $image)

                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">

                                            <img
                                                src="{{ asset('admins/products/' . $image) }}"
                                                alt="{{ $product->name }} image {{ $index + 1 }}"
                                                width="800"
                                                height="500"
                                                class="gallery-image d-block"
                                                loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                                decoding="async"
                                                onerror="this.onerror=null;this.src='{{ $fallbackImage }}';"
                                            >

                                        </div>

                                    @endforeach

                                </div>


                                @if (count($productImages) > 1)

                                    <span class="gallery-counter">
                                        <i class="bi bi-images me-1"></i>
                                        {{ count($productImages) }} images
                                    </span>

                                    <button
                                        class="carousel-control-prev"
                                        type="button"
                                        data-bs-target="#productImageCarousel"
                                        data-bs-slide="prev"
                                    >
                                        <span
                                            class="carousel-control-prev-icon"
                                            aria-hidden="true"
                                        ></span>

                                        <span class="visually-hidden">
                                            Previous
                                        </span>
                                    </button>

                                    <button
                                        class="carousel-control-next"
                                        type="button"
                                        data-bs-target="#productImageCarousel"
                                        data-bs-slide="next"
                                    >
                                        <span
                                            class="carousel-control-next-icon"
                                            aria-hidden="true"
                                        ></span>

                                        <span class="visually-hidden">
                                            Next
                                        </span>
                                    </button>

                                @endif

                            </div>


                            {{-- Image Thumbnails --}}
                            @if (count($productImages) > 1)

                                <div class="border-top">

                                    <div class="thumbnail-strip">

                                        @foreach ($productImages as $index => $image)

                                            <button
                                                type="button"
                                                class="gallery-thumbnail btn {{ $index === 0 ? 'active' : '' }}"
                                                data-bs-target="#productImageCarousel"
                                                data-bs-slide-to="{{ $index }}"
                                                aria-label="View image {{ $index + 1 }}"
                                            >
                                                <img
                                                    src="{{ asset('admins/products/' . $image) }}"
                                                    alt="Product thumbnail {{ $index + 1 }}"
                                                    width="72"
                                                    height="62"
                                                    loading="lazy"
                                                    onerror="this.onerror=null;this.src='{{ $fallbackImage }}';"
                                                >
                                            </button>

                                        @endforeach

                                    </div>

                                </div>

                            @endif

                        @else

                            <div class="bg-light text-center p-5">

                                <img
                                    src="{{ $fallbackImage }}"
                                    alt="No product image available"
                                    width="240"
                                    height="240"
                                    class="img-fluid rounded-3 object-fit-cover"
                                >

                                <p class="text-secondary small mb-0 mt-3">
                                    No product images are available.
                                </p>

                            </div>

                        @endif

                    </div>


                </div>


                {{-- Product Information --}}
                <div class="col-12 col-xl-7">

                    <div class="detail-card card overflow-hidden h-100">

                        <div class="card-body p-4 p-lg-5">

                            {{-- Status and Category --}}
                            <div class="d-flex flex-wrap align-items-center gap-2 mb-3">

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


                                <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                                    <i class="bi bi-tag me-1"></i>
                                    {{ optional($product->category)->name ?? 'Uncategorized' }}
                                </span>

                            </div>


                            {{-- Product Title --}}
                            <h1 class="product-name fw-bold mb-3">
                                {{ $product->name }}
                            </h1>

                            <p class="product-id mb-4">
                                <i class="bi bi-upc-scan me-2"></i>
                                Product ID: #{{ $product->id }}
                            </p>


                            {{-- Product Information --}}
                            <div class="product-facts">
                                <div class="product-fact">
                                    <span class="fact-icon"><i class="bi bi-tag"></i></span>
                                    <div>
                                        <div class="fact-label">Category</div>
                                        <div class="fact-value fw-semibold">{{ optional($product->category)->name ?? 'Not available' }}</div>
                                    </div>
                                </div>
                                <div class="product-fact">
                                    <span class="fact-icon"><i class="bi bi-activity"></i></span>
                                    <div>
                                        <div class="fact-label">Availability</div>
                                        <div class="fact-value fw-semibold {{ $product->status === 'active' ? 'text-success' : 'text-danger' }}">{{ ucfirst($product->status) }}</div>
                                    </div>
                                </div>
                                <div class="product-fact">
                                    <span class="fact-icon"><i class="bi bi-calendar3"></i></span>
                                    <div>
                                        <div class="fact-label">Date Added</div>
                                        <div class="fact-value fw-semibold">{{ optional($product->created_at)->format('d M Y') ?? 'Not available' }}</div>
                                    </div>
                                </div>
                            </div>


                            {{-- Description --}}
                            <div class="mb-4">

                                <h5 class="fw-semibold text-dark mb-3">
                                    Product Description
                                </h5>

                                @if ($product->description)

                                    <div class="description-box mb-0">
                                        {!! nl2br(e($product->description)) !!}
                                    </div>

                                @else

                                    <div class="alert alert-light border mb-0">
                                        <i class="bi bi-info-circle me-1"></i>
                                        No description is available for this product.
                                    </div>

                                @endif

                            </div>


                            {{-- Request Status --}}
                            @if ($requestExists)

                                <div class="request-notice alert alert-success d-flex align-items-start gap-3">

                                    <i class="bi bi-check-circle-fill fs-5"></i>

                                    <div>
                                        <h6 class="alert-heading fw-semibold mb-1">
                                            Request Already Submitted
                                        </h6>

                                        <p class="small mb-0">
                                            You have already submitted a request for this product.
                                            You can check its progress from My Requests.
                                        </p>
                                    </div>

                                </div>

                            @elseif ($product->status !== 'active')

                                <div class="request-notice alert alert-warning d-flex align-items-start gap-3">

                                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>

                                    <div>
                                        <h6 class="alert-heading fw-semibold mb-1">
                                            Product Unavailable
                                        </h6>

                                        <p class="small mb-0">
                                            This product is currently inactive and cannot be requested.
                                        </p>
                                    </div>

                                </div>

                            @endif


                            {{-- Actions --}}
                            <div class="product-actions d-flex flex-column flex-sm-row gap-2 mt-4">

                                @if ($requestExists)

                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        disabled
                                    >
                                        <i class="bi bi-check2-circle me-1"></i>
                                        Request Sent
                                    </button>

                                    <a
                                        href="{{ route('beneficiary.my.requests') }}"
                                        class="btn btn-outline-primary"
                                    >
                                        <i class="bi bi-clipboard-text me-1"></i>
                                        View My Requests
                                    </a>

                                @elseif ($product->status === 'active')

                                    <form
                                        method="POST"
                                        action="{{ route('product.request.send', $product->id) }}"
                                        id="productRequestForm"
                                    >
                                        @csrf

                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#requestConfirmationModal"
                                        >
                                            <i class="bi bi-send me-1"></i>
                                            Send Request
                                        </button>
                                    </form>

                                @else

                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        disabled
                                    >
                                        <i class="bi bi-lock me-1"></i>
                                        Product Unavailable
                                    </button>

                                @endif


                                <a
                                    href="{{ url()->previous() }}"
                                    class="btn btn-light border"
                                >
                                    <i class="bi bi-arrow-left me-1"></i>
                                    Back
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Related Products --}}
            @if ($relatedProducts->isNotEmpty())

                <section class="mt-5">

                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

                        <div>
                            <h4 class="fw-bold text-dark mb-1">
                                Related Products
                            </h4>

                            <p class="text-secondary small mb-0">
                                Other available products from the same category.
                            </p>
                        </div>

                        <a
                            href="{{ route('beneficiary.products.index') }}"
                            class="btn btn-outline-primary btn-sm"
                        >
                            View All Products
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>

                    </div>


                    <div class="related-products-grid">

                        @foreach ($relatedProducts as $relatedProduct)

                            @php
                                $relatedImages = is_array($relatedProduct->images)
                                    ? $relatedProduct->images
                                    : json_decode($relatedProduct->images, true);

                                $relatedImages = is_array($relatedImages)
                                    ? $relatedImages
                                    : [];

                                $relatedImage = !empty($relatedImages)
                                    ? asset('admins/products/' . $relatedImages[0])
                                    : $fallbackImage;
                            @endphp

                            <article class="related-product-card card h-100">

                                <div class="related-image-wrap">
                                    <img
                                        src="{{ $relatedImage }}"
                                        alt="{{ $relatedProduct->name }}"
                                        width="500"
                                        height="220"
                                        class="related-image"
                                        loading="lazy"
                                        decoding="async"
                                        onerror="this.onerror=null;this.src='{{ $fallbackImage }}';"
                                    >
                                </div>


                                    <div class="card-body p-4">

                                        <div class="d-flex align-items-center justify-content-between gap-2 mb-3">

                                            <span class="badge rounded-pill bg-primary-subtle text-primary">
                                                {{ optional($relatedProduct->category)->name ?? 'Uncategorized' }}
                                            </span>

                                            @if ($relatedProduct->status === 'active')
                                                <span class="badge rounded-pill bg-success-subtle text-success">
                                                    Active
                                                </span>
                                            @endif

                                        </div>


                                        <h3 class="related-title fw-semibold text-dark mb-2">
                                            {{ $relatedProduct->name }}
                                        </h3>

                                        @if ($relatedProduct->description)

                                            <p class="related-description mb-4">
                                                {{ \Illuminate\Support\Str::limit(
                                                    $relatedProduct->description,
                                                    90
                                                ) }}
                                            </p>

                                        @else

                                            <p class="related-description mb-4">
                                                View the product to see more information.
                                            </p>

                                        @endif


                                        <a
                                            href="{{ route('beneficiary.products.detail.show', $relatedProduct->id) }}"
                                            class="btn btn-outline-primary w-100"
                                        >
                                            View Details
                                            <i class="bi bi-arrow-right ms-1"></i>
                                        </a>

                                    </div>

                            </article>

                        @endforeach

                    </div>

                </section>

            @endif

        </main>

    </div>

    @if (!$requestExists && $product->status === 'active')
        <div class="modal fade" id="requestConfirmationModal" tabindex="-1" aria-labelledby="requestConfirmationLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow">
                    <div class="modal-body text-center p-4 p-md-5">
                        <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary mb-3" style="width: 64px; height: 64px;">
                            <i class="bi bi-send-check fs-3"></i>
                        </span>
                        <h5 class="fw-bold text-dark mb-2" id="requestConfirmationLabel">Submit Product Request?</h5>
                        <p class="text-secondary small mb-4">You are requesting <strong>{{ $product->name }}</strong>. Please confirm to continue.</p>
                        <div class="d-flex flex-column flex-sm-row justify-content-center gap-2">
                            <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" form="productRequestForm" class="btn btn-primary">
                                <i class="bi bi-send me-1"></i> Confirm Request
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    @include('layouts.admin.script')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const carousel = document.getElementById('productImageCarousel');
            const thumbnails = document.querySelectorAll('.gallery-thumbnail');

            if (carousel && thumbnails.length) {
                carousel.addEventListener('slid.bs.carousel', function (event) {
                    thumbnails.forEach(function (thumbnail, index) {
                        thumbnail.classList.toggle('active', index === event.to);
                    });
                });
            }

            const requestForm = document.getElementById('productRequestForm');
            if (requestForm) {
                requestForm.addEventListener('submit', function () {
                    const submitButton = document.querySelector('[form="productRequestForm"]');
                    if (submitButton) {
                        submitButton.disabled = true;
                        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" aria-hidden="true"></span>Submitting...';
                    }
                });
            }
        });
    </script>

</body>
