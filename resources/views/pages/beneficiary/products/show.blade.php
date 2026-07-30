@include('layouts.admin.head')

<title>{{ $product->name }} | Product Details</title>

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
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

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
                <div class="col-12 col-xl-5">

                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                        @if (!empty($productImages))

                            <div
                                id="productImageCarousel"
                                class="carousel slide"
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
                                                class="d-block w-100 object-fit-cover"
                                            >

                                        </div>

                                    @endforeach

                                </div>


                                @if (count($productImages) > 1)

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

                                <div class="card-body border-top p-3">

                                    <div class="d-flex flex-wrap gap-2">

                                        @foreach ($productImages as $index => $image)

                                            <button
                                                type="button"
                                                class="btn border p-1"
                                                data-bs-target="#productImageCarousel"
                                                data-bs-slide-to="{{ $index }}"
                                                aria-label="View image {{ $index + 1 }}"
                                            >
                                                <img
                                                    src="{{ asset('admin/products/' . $image) }}"
                                                    alt="Product thumbnail {{ $index + 1 }}"
                                                    width="65"
                                                    height="55"
                                                    class="rounded-2 object-fit-cover"
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


                    {{-- Image Count --}}
                    @if (!empty($productImages))

                        <div class="d-flex align-items-center justify-content-center mt-3">

                            <span class="badge rounded-pill bg-light text-secondary border px-3 py-2">
                                <i class="bi bi-images me-1"></i>

                                {{ count($productImages) }}
                                {{ count($productImages) === 1 ? 'image' : 'images' }}
                            </span>

                        </div>

                    @endif

                </div>


                {{-- Product Information --}}
                <div class="col-12 col-xl-7">

                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">

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
                            <h1 class="fw-bold text-dark mb-3">
                                {{ $product->name }}
                            </h1>

                            <p class="text-secondary small mb-4">
                                Product ID: #{{ $product->id }}
                            </p>


                            {{-- Product Information --}}
                            <div class="border rounded-3 overflow-hidden mb-4">

                                <div class="d-flex justify-content-between align-items-center gap-3 p-3 border-bottom">

                                    <span class="text-secondary small">
                                        <i class="bi bi-tag me-2"></i>
                                        Category
                                    </span>

                                    <span class="fw-semibold text-dark small">
                                        {{ optional($product->category)->name ?? 'Not available' }}
                                    </span>

                                </div>

                                <div class="d-flex justify-content-between align-items-center gap-3 p-3 border-bottom">

                                    <span class="text-secondary small">
                                        <i class="bi bi-activity me-2"></i>
                                        Availability
                                    </span>

                                    <span class="fw-semibold small {{ $product->status === 'active' ? 'text-success' : 'text-danger' }}">
                                        {{ ucfirst($product->status) }}
                                    </span>

                                </div>

                                <div class="d-flex justify-content-between align-items-center gap-3 p-3">

                                    <span class="text-secondary small">
                                        <i class="bi bi-calendar3 me-2"></i>
                                        Added
                                    </span>

                                    <span class="fw-semibold text-dark small">
                                        {{ optional($product->created_at)->format('d M Y') }}
                                    </span>

                                </div>

                            </div>


                            {{-- Description --}}
                            <div class="mb-4">

                                <h5 class="fw-semibold text-dark mb-3">
                                    Product Description
                                </h5>

                                @if ($product->description)

                                    <p class="text-secondary lh-lg mb-0">
                                        {!! nl2br(e($product->description)) !!}
                                    </p>

                                @else

                                    <div class="alert alert-light border mb-0">
                                        <i class="bi bi-info-circle me-1"></i>
                                        No description is available for this product.
                                    </div>

                                @endif

                            </div>


                            {{-- Request Status --}}
                            @if ($requestExists)

                                <div class="alert alert-success d-flex align-items-start gap-3">

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

                                <div class="alert alert-warning d-flex align-items-start gap-3">

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
                            <div class="d-flex flex-column flex-sm-row gap-2 mt-4">

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
                                        onsubmit="return confirm('Do you want to submit a request for this product?');"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="btn btn-primary"
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


                    <div class="row g-4">

                        @foreach ($relatedProducts as $relatedProduct)

                            @php
                                $relatedImages = is_array($relatedProduct->images)
                                    ? $relatedProduct->images
                                    : json_decode($relatedProduct->images, true);

                                $relatedImages = is_array($relatedImages)
                                    ? $relatedImages
                                    : [];

                                $relatedImage = !empty($relatedImages)
                                    ? asset('admin/products/' . $relatedImages[0])
                                    : $fallbackImage;
                            @endphp

                            <div class="col-12 col-sm-6 col-xl-4">

                                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">

                                    <img
                                        src="{{ $relatedImage }}"
                                        alt="{{ $relatedProduct->name }}"
                                        width="500"
                                        height="220"
                                        class="card-img-top object-fit-cover"
                                    >


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


                                        <h5 class="fw-semibold text-dark mb-2">
                                            {{ $relatedProduct->name }}
                                        </h5>

                                        @if ($relatedProduct->description)

                                            <p class="text-secondary small mb-4">
                                                {{ \Illuminate\Support\Str::limit(
                                                    $relatedProduct->description,
                                                    90
                                                ) }}
                                            </p>

                                        @else

                                            <p class="text-secondary small mb-4">
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

                                </div>

                            </div>

                        @endforeach

                    </div>

                </section>

            @endif

        </main>

    </div>


    @include('layouts.admin.script')

</body>
