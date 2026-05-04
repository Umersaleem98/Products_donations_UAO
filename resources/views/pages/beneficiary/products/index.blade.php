@include('layouts.admin.head')

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
                                <i class="mdi mdi-home"></i>
                            </span>
                            Products
                        </h3>
                    </div>

                    <div class="container mt-3">

                        {{-- TABS --}}
                        <ul class="nav nav-tabs" role="tablist">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#all-products"
                                    type="button">
                                    All Products
                                </button>
                            </li>

                            @foreach ($categories as $category)
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#cat-{{ $category->id }}" type="button">
                                        {{ $category->name }}
                                    </button>
                                </li>
                            @endforeach

                        </ul>

                        {{-- TAB CONTENT --}}
                        <div class="tab-content mt-4">

                            {{-- ALL PRODUCTS --}}
                            <div class="tab-pane fade show active" id="all-products">

                                <div class="row">

                                    @foreach ($products as $product)
                                        @php
                                            $image = json_decode($product->images, true);
                                            $image = $image[0] ?? $product->images;
                                        @endphp

                                        <div class="col-md-4 mb-4">

                                            <div class="card h-100 shadow-sm">

                                                <img src="{{ asset('admin/products/' . $image) }}" class="card-img-top"
                                                    style="height:200px; object-fit:cover;">

                                                <div class="card-body">

                                                    <h5 class="card-title">
                                                        {{ $product->name }}
                                                    </h5>

                                                    <p class="mb-1">
                                                        <strong>Category:</strong>
                                                        {{ $product->category->name ?? 'N/A' }}
                                                    </p>

                                                    <p class="text-muted small">
                                                        {{ \Illuminate\Support\Str::limit($product->description, 80) }}
                                                    </p>

                                                </div>

                                                {{-- FOOTER BUTTON --}}
                                                <div class="card-footer text-center bg-white">

                                                   <a href="{{ route('beneficiary.products.detail.show', $product->id) }}"
                                                            class="btn btn-gradient-primary btn-sm">
                                                            View Details
                                                        </a>
                                                </div>

                                            </div>

                                        </div>
                                    @endforeach

                                </div>

                            </div>

                            {{-- CATEGORY WISE PRODUCTS --}}
                            @foreach ($categories as $category)
                                <div class="tab-pane fade" id="cat-{{ $category->id }}">

                                    <div class="row">

                                        @foreach ($products->where('category_id', $category->id) as $product)
                                            @php
                                                $image = json_decode($product->images, true);
                                                $image = $image[0] ?? $product->images;
                                            @endphp

                                            <div class="col-md-4 mb-4">

                                                <div class="card h-100 shadow-sm">

                                                    <img src="{{ asset('admin/products/' . $image) }}"
                                                        class="card-img-top" style="height:200px; object-fit:cover;">

                                                    <div class="card-body">

                                                        <h5 class="card-title">
                                                            {{ $product->name }}
                                                        </h5>

                                                        <p class="mb-1">
                                                            <strong>Category:</strong>
                                                            {{ $category->name }}
                                                        </p>
                                                        <p class="mb-1">
                                                            <strong>Status:</strong>
                                                            {{ $category->status }}
                                                        </p>
                                                    </div>

                                                    {{-- FOOTER BUTTON --}}
                                                    <div class="card-footer text-center bg-white">

                                                        <a href="{{ route('beneficiary.products.detail.show', $product->id) }}"
                                                            class="btn btn-gradient-primary btn-sm">
                                                            View Details
                                                        </a>

                                                    </div>

                                                </div>

                                            </div>
                                        @endforeach

                                    </div>

                                </div>
                            @endforeach

                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

    @include('layouts.admin.script')
</body>
