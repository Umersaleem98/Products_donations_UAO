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
                            Product Details
                        </h3>
                    </div>

                    <div class="container mt-4">

                        <div class="row">

                            {{-- IMAGE --}}
                            <div class="col-md-5">

                                @php
                                    $image = json_decode($product->images, true);
                                    $image = $image[0] ?? $product->images;
                                @endphp

                                <div class="card shadow-sm">
                                    <img src="{{ asset('admin/products/' . $image) }}"
                                        style="width:100%; height:350px; object-fit:cover;">
                                </div>

                            </div>

                            {{-- DETAILS --}}
                            <div class="col-md-7">

                                <div class="card shadow-sm">
                                    <div class="card-body">

                                        <h3>{{ $product->name }}</h3>

                                        <p class="mb-2">
                                            <strong>Category:</strong>
                                            {{ $product->category->name ?? 'N/A' }}
                                        </p>

                                        <p class="mb-2">
                                            <strong>Status:</strong>
                                            {{ $product->status }}
                                        </p>

                                        <hr>

                                        <p>
                                            {{ $product->description }}
                                        </p>

                                        @if ($requestExists)
                                            <button class="btn btn-secondary mt-3" disabled>
                                                Request Sent
                                            </button>
                                        @else
                                            <form method="POST"
                                                action="{{ route('product.request.send', $product->id) }}">
                                                @csrf

                                                <button type="submit" class="btn btn-gradient-primary mt-3">
                                                    Send Request
                                                </button>
                                            </form>
                                        @endif

                                        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">
                                            Back
                                        </a>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

    @include('layouts.admin.script')
</body>
