@include('layouts.admin.head')

<body>

    <div id="overlay"></div>

    @include('layouts.admin.sidebar')
    @include('layouts.admin.header')

    <main id="main">
        <div class="content-area">

            <!-- HEADER -->
            <div class="page-header d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0">Product Detail</h1>
            </div>

            <!-- MAIN CARD -->
            <div class="card shadow-sm border-0 p-3">
                <div class="row g-4 align-items-stretch">

                    <!-- LEFT SIDE (IMAGE) -->
                    <div class="col-md-5">

                        <div class="image-box">
                            <img src="{{ asset('admins/assets/img/dummy.png') }}" alt="Product" width="100%">
                        </div>

                    </div>

                    <!-- RIGHT SIDE (DETAILS) -->
                    <div class="col-md-7 d-flex flex-column justify-content-between">

                        <div>

                            <!-- TITLE -->
                            <h2 class="fw-bold mb-2">{{ $product->title }}</h2>

                            <!-- CATEGORY -->
                            <span class="badge bg-light text-dark mb-3">
                                {{ $product->category->name ?? 'N/A' }}
                            </span>

                            <!-- DESCRIPTION -->
                            <p class="text-muted mb-4">
                                {{ $product->description }}
                            </p>

                            <!-- INFO GRID -->
                            <div class="row small mb-4">

                                <div class="col-6 mb-2">
                                    <strong>Type:</strong><br>
                                    {{ $product->type }}
                                </div>

                                <div class="col-6 mb-2">
                                    <strong>Condition:</strong><br>
                                    {{ $product->condition }}
                                </div>

                                <div class="col-6">
                                    <strong>Price:</strong><br>
                                    {{ $product->price ?? 'N/A' }}
                                </div>

                            </div>

                            <hr>

                            <!-- DONOR -->
                            <h5 class="mb-3">Donor Information</h5>

                            <div class="donor-box">

                                <p><strong>Name:</strong> {{ $product->user->name ?? 'N/A' }}</p>
                                <p><strong>Email:</strong> {{ $product->user->email ?? 'N/A' }}</p>
                                <p><strong>Phone:</strong> {{ $product->user->phone ?? 'N/A' }}</p>
                                <p><strong>Address:</strong> {{ $product->user->address ?? 'N/A' }}</p>

                            </div>

                        </div>

                        <!-- BUTTON -->
                        <a  class="btn btn-primary w-100 mt-3">
                            Send Connection Request
                        </a>

                    </div>

                </div>
            </div>

        </div>
    </main>

    @include('layouts.admin.script')

</body>
