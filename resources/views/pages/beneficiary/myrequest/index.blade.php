@include('layouts.admin.head')

<title>My Requests</title>

<body>

    @php
        /*
        |--------------------------------------------------------------------------
        | Support Collection and Paginator
        |--------------------------------------------------------------------------
        */

        $requestsArePaginated = method_exists($requests, 'total');

        $totalRequests = $requestsArePaginated
            ? $requests->total()
            : $requests->count();

        $startingNumber = $requestsArePaginated
            ? ($requests->firstItem() ?? 1)
            : 1;

        $pendingRequests = $requests
            ->where('donor_status', 'pending')
            ->count();

        $acceptedRequests = $requests
            ->where('donor_status', 'accepted')
            ->count();

        $rejectedRequests = $requests
            ->where('donor_status', 'rejected')
            ->count();

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
                        My Requests
                    </h3>

                    <p class="text-secondary small mb-0">
                        Track your product requests and view donor decisions.
                    </p>
                </div>

                <a
                    href="{{ route('beneficiary.products.index') }}"
                    class="btn btn-primary d-flex align-items-center gap-2"
                >
                    <i class="bi bi-box-seam"></i>
                    <span>Browse Products</span>
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
                        My Requests
                    </li>

                </ol>

            </nav>


            {{-- Alert Messages --}}
            @include('layouts.admin.alert')


            {{-- ================================================= --}}
            {{-- REQUEST STATISTICS --}}
            {{-- ================================================= --}}
            <div class="row g-3 mb-4">

                {{-- Total --}}
                <div class="col-12 col-sm-6 col-xl-3">

                    <div class="card border-0 shadow-sm rounded-4 h-100">

                        <div class="card-body p-4">

                            <div class="d-flex align-items-center justify-content-between gap-3">

                                <div>
                                    <p class="text-secondary small fw-semibold mb-1">
                                        Total Requests
                                    </p>

                                    <h3 class="fw-bold text-dark mb-0">
                                        {{ number_format($totalRequests) }}
                                    </h3>
                                </div>

                                <span
                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary flex-shrink-0"
                                    style="width: 48px; height: 48px;"
                                >
                                    <i class="bi bi-clipboard-data fs-5"></i>
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Pending --}}
                <div class="col-12 col-sm-6 col-xl-3">

                    <div class="card border-0 shadow-sm rounded-4 h-100">

                        <div class="card-body p-4">

                            <div class="d-flex align-items-center justify-content-between gap-3">

                                <div>
                                    <p class="text-secondary small fw-semibold mb-1">
                                        Pending
                                    </p>

                                    <h3 class="fw-bold text-warning mb-0">
                                        {{ number_format($pendingRequests) }}
                                    </h3>
                                </div>

                                <span
                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning-subtle text-warning-emphasis flex-shrink-0"
                                    style="width: 48px; height: 48px;"
                                >
                                    <i class="bi bi-hourglass-split fs-5"></i>
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Accepted --}}
                <div class="col-12 col-sm-6 col-xl-3">

                    <div class="card border-0 shadow-sm rounded-4 h-100">

                        <div class="card-body p-4">

                            <div class="d-flex align-items-center justify-content-between gap-3">

                                <div>
                                    <p class="text-secondary small fw-semibold mb-1">
                                        Accepted
                                    </p>

                                    <h3 class="fw-bold text-success mb-0">
                                        {{ number_format($acceptedRequests) }}
                                    </h3>
                                </div>

                                <span
                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success-subtle text-success flex-shrink-0"
                                    style="width: 48px 48; height: 48px;"
                                >
                                    <i class="bi bi-check-circle fs-5"></i>
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Rejected --}}
                <div class="col-12 col-sm-6 col-xl-3">

                    <div class="card border-0 shadow-sm rounded-4 h-100">

                        <div class="card-body p-4">

                            <div class="d-flex align-items-center justify-content-between gap-3">

                                <div>
                                    <p class="text-secondary small fw-semibold mb-1">
                                        Rejected
                                    </p>

                                    <h3 class="fw-bold text-danger mb-0">
                                        {{ number_format($rejectedRequests) }}
                                    </h3>
                                </div>

                                <span
                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-danger-subtle text-danger flex-shrink-0"
                                    style="width: 48px; height: 48px;"
                                >
                                    <i class="bi bi-x-circle fs-5"></i>
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- REQUESTS TABLE --}}
            {{-- ================================================= --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                {{-- Card Header --}}
                <div class="card-header bg-white border-bottom px-4 py-3">

                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

                        <div>
                            <h5 class="fw-semibold text-dark mb-1">
                                Product Request History
                            </h5>

                            <p class="text-secondary small mb-0">
                                Donor details become available after request acceptance.
                            </p>
                        </div>

                        <span class="badge rounded-pill bg-light text-secondary border px-3 py-2">
                            <i class="bi bi-list-ul me-1"></i>
                            {{ $totalRequests }} requests
                        </span>

                    </div>

                </div>


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
                                        Admin Status
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        Donor Status
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        Donor Information
                                    </th>

                                    <th class="px-4 py-3 text-secondary small">
                                        Request Date
                                    </th>
                                </tr>
                            </thead>


                            <tbody>

                                @forelse ($requests as $key => $productRequest)

                                    @php
                                        $product = $productRequest->product;
                                        $donor = $productRequest->donor;

                                        $productImages = [];

                                        if ($product) {
                                            $productImages = is_array($product->images)
                                                ? $product->images
                                                : json_decode($product->images, true);

                                            $productImages = is_array($productImages)
                                                ? $productImages
                                                : [];
                                        }

                                        $productImage = !empty($productImages)
                                            ? asset('admin/products/' . $productImages[0])
                                            : $fallbackImage;

                                        $donorAccepted =
                                            $productRequest->donor_status === 'accepted';

                                        $adminBadge = match ($productRequest->admin_status) {
                                            'approved' => 'bg-success-subtle text-success',
                                            'rejected' => 'bg-danger-subtle text-danger',
                                            default => 'bg-warning-subtle text-warning-emphasis',
                                        };

                                        $donorBadge = match ($productRequest->donor_status) {
                                            'accepted' => 'bg-success-subtle text-success',
                                            'rejected' => 'bg-danger-subtle text-danger',
                                            default => 'bg-warning-subtle text-warning-emphasis',
                                        };
                                    @endphp

                                    <tr>

                                        {{-- Number --}}
                                        <td class="px-4">
                                            <span class="text-secondary">
                                                {{ $startingNumber + $key }}
                                            </span>
                                        </td>


                                        {{-- Product --}}
                                        <td>

                                            <div class="d-flex align-items-center gap-3">

                                                <img
                                                    src="{{ $productImage }}"
                                                    alt="{{ $product->name ?? 'Product' }}"
                                                    width="60"
                                                    height="60"
                                                    class="rounded-3 border object-fit-cover flex-shrink-0"
                                                >

                                                <div>
                                                    <div class="fw-semibold text-dark">
                                                        {{ $product->name ?? 'Product unavailable' }}
                                                    </div>

                                                    <small class="text-secondary">
                                                        Request #{{ $productRequest->id }}
                                                    </small>
                                                </div>

                                            </div>

                                        </td>


                                        {{-- Admin Status --}}
                                        <td>

                                            <span class="badge rounded-pill {{ $adminBadge }} px-3 py-2">

                                                @if ($productRequest->admin_status === 'approved')
                                                    <i class="bi bi-shield-check me-1"></i>
                                                @elseif ($productRequest->admin_status === 'rejected')
                                                    <i class="bi bi-shield-x me-1"></i>
                                                @else
                                                    <i class="bi bi-hourglass-split me-1"></i>
                                                @endif

                                                {{ ucfirst($productRequest->admin_status ?? 'pending') }}

                                            </span>

                                        </td>


                                        {{-- Donor Status --}}
                                        <td>

                                            <span class="badge rounded-pill {{ $donorBadge }} px-3 py-2">

                                                @if ($donorAccepted)
                                                    <i class="bi bi-check-circle me-1"></i>
                                                @elseif ($productRequest->donor_status === 'rejected')
                                                    <i class="bi bi-x-circle me-1"></i>
                                                @else
                                                    <i class="bi bi-clock me-1"></i>
                                                @endif

                                                {{ ucfirst($productRequest->donor_status ?? 'pending') }}

                                            </span>

                                        </td>


                                        {{-- Donor Information --}}
                                        <td>

                                            @if ($donorAccepted && $donor)

                                                <div class="d-flex flex-wrap gap-2">

                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-primary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#donorModal{{ $productRequest->id }}"
                                                    >
                                                        <i class="bi bi-person me-1"></i>
                                                        View Donor
                                                    </button>

                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-info btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#messageModal{{ $productRequest->id }}"
                                                    >
                                                        <i class="bi bi-chat-left-text me-1"></i>
                                                        Message
                                                    </button>

                                                </div>

                                            @elseif ($productRequest->donor_status === 'rejected')

                                                <span class="text-danger small">
                                                    <i class="bi bi-x-circle me-1"></i>
                                                    Request rejected
                                                </span>

                                            @else

                                                <span class="text-secondary small">
                                                    <i class="bi bi-lock me-1"></i>
                                                    Available after acceptance
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Date --}}
                                        <td class="px-4">

                                            <div class="small text-dark">
                                                <i class="bi bi-calendar3 text-secondary me-1"></i>

                                                {{ optional($productRequest->created_at)->format('d M Y') }}
                                            </div>

                                            <small class="text-secondary">
                                                {{ optional($productRequest->created_at)->diffForHumans() }}
                                            </small>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="6" class="text-center py-5">

                                            <div class="d-flex flex-column align-items-center">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light text-secondary mb-3"
                                                    style="width: 68px; height: 68px;"
                                                >
                                                    <i class="bi bi-clipboard-x fs-3"></i>
                                                </span>

                                                <h6 class="fw-semibold text-dark mb-1">
                                                    No requests found
                                                </h6>

                                                <p class="text-secondary small mb-3">
                                                    You have not submitted any product requests.
                                                </p>

                                                <a
                                                    href="{{ route('beneficiary.products.index') }}"
                                                    class="btn btn-primary btn-sm"
                                                >
                                                    <i class="bi bi-box-seam me-1"></i>
                                                    Browse Products
                                                </a>

                                            </div>

                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>


                {{-- Pagination: only shown when $requests is paginated --}}
                @if (
                    $requestsArePaginated &&
                    $requests->hasPages()
                )

                    <div class="card-footer bg-white border-top px-4 py-3">

                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">

                            <p class="text-secondary small mb-0">
                                Showing
                                <span class="fw-semibold text-dark">
                                    {{ $requests->firstItem() }}
                                </span>
                                to
                                <span class="fw-semibold text-dark">
                                    {{ $requests->lastItem() }}
                                </span>
                                of
                                <span class="fw-semibold text-dark">
                                    {{ $requests->total() }}
                                </span>
                                requests
                            </p>

                            <div>
                                {{ $requests->withQueryString()->links() }}
                            </div>

                        </div>

                    </div>

                @endif

            </div>

        </main>

    </div>


    {{-- ===================================================== --}}
    {{-- DONOR AND MESSAGE MODALS --}}
    {{-- ===================================================== --}}

    @foreach ($requests as $productRequest)

        @php
            $donor = $productRequest->donor;
            $donorProfile = $donor?->donorProfile;

            $donorImage = $donor && $donor->image
                ? asset(
                    'admin/asset/profilephoto/' .
                    $donor->image
                )
                : $fallbackImage;
        @endphp


        @if (
            $productRequest->donor_status === 'accepted' &&
            $donor
        )

            {{-- Donor Profile Modal --}}
            <div
                class="modal fade"
                id="donorModal{{ $productRequest->id }}"
                tabindex="-1"
                aria-labelledby="donorModalLabel{{ $productRequest->id }}"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content border-0 shadow rounded-4">

                        <div class="modal-header border-bottom px-4 py-3">

                            <h5
                                class="modal-title fw-bold"
                                id="donorModalLabel{{ $productRequest->id }}"
                            >
                                Donor Profile
                            </h5>

                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>

                        </div>


                        <div class="modal-body p-4">

                            {{-- Donor Profile --}}
                            <div class="text-center mb-4">

                                <img
                                    src="{{ $donorImage }}"
                                    alt="{{ $donor->name }}"
                                    width="110"
                                    height="110"
                                    class="rounded-circle border border-3 object-fit-cover mb-3"
                                >

                                <h5 class="fw-bold text-dark mb-1">
                                    {{ $donor->name }}
                                </h5>

                                <p class="text-secondary small mb-2">
                                    {{ $donor->email }}
                                </p>

                                <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                                    Donor
                                </span>

                            </div>


                            {{-- Organization --}}
                            <h6 class="fw-bold text-dark mb-3">
                                <i class="bi bi-building text-primary me-2"></i>
                                Organization Information
                            </h6>

                            <div class="border rounded-3 overflow-hidden mb-4">

                                <div class="d-flex justify-content-between gap-3 p-3 border-bottom">
                                    <span class="text-secondary small">
                                        Organization
                                    </span>

                                    <span class="fw-semibold small text-end">
                                        {{ $donorProfile?->organization ?? 'Not available' }}
                                    </span>
                                </div>

                                <div class="d-flex justify-content-between gap-3 p-3 border-bottom">
                                    <span class="text-secondary small">
                                        Designation
                                    </span>

                                    <span class="fw-semibold small text-end">
                                        {{ $donorProfile?->designation ?? 'Not available' }}
                                    </span>
                                </div>

                                <div class="d-flex justify-content-between gap-3 p-3">
                                    <span class="text-secondary small">
                                        Country
                                    </span>

                                    <span class="fw-semibold small text-end">
                                        {{ $donorProfile?->country ?? 'Not available' }}
                                    </span>
                                </div>

                            </div>


                            {{-- Contact Details --}}
                            <h6 class="fw-bold text-dark mb-3">
                                <i class="bi bi-telephone text-primary me-2"></i>
                                Contact Information
                            </h6>

                            <div class="border rounded-3 overflow-hidden">

                                <div class="d-flex justify-content-between gap-3 p-3 border-bottom">
                                    <span class="text-secondary small">
                                        Phone
                                    </span>

                                    <span class="fw-semibold small text-end">
                                        {{ $donor->phone ?? 'Not available' }}
                                    </span>
                                </div>

                                <div class="p-3">
                                    <span class="d-block text-secondary small mb-1">
                                        Address
                                    </span>

                                    <span class="fw-semibold small">
                                        {{ $donorProfile?->address ?? 'Not available' }}
                                    </span>
                                </div>

                            </div>

                        </div>


                        <div class="modal-footer border-top px-4 py-3">

                            <button
                                type="button"
                                class="btn btn-light border"
                                data-bs-dismiss="modal"
                            >
                                Close
                            </button>

                        </div>

                    </div>

                </div>
            </div>


            {{-- Donor Message Modal --}}
            <div
                class="modal fade"
                id="messageModal{{ $productRequest->id }}"
                tabindex="-1"
                aria-labelledby="messageModalLabel{{ $productRequest->id }}"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content border-0 shadow rounded-4">

                        <div class="modal-header border-bottom px-4 py-3">

                            <h5
                                class="modal-title fw-bold"
                                id="messageModalLabel{{ $productRequest->id }}"
                            >
                                Message from Donor
                            </h5>

                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>

                        </div>


                        <div class="modal-body p-4">

                            @if ($productRequest->message)

                                <div class="d-flex align-items-start gap-3">

                                    <span
                                        class="d-inline-flex align-items-center justify-content-center rounded-circle bg-info-subtle text-info-emphasis flex-shrink-0"
                                        style="width: 44px; height: 44px;"
                                    >
                                        <i class="bi bi-chat-quote"></i>
                                    </span>

                                    <div>
                                        <h6 class="fw-semibold text-dark mb-2">
                                            {{ $donor->name }}
                                        </h6>

                                        <p class="text-secondary lh-lg mb-0">
                                            {!! nl2br(e($productRequest->message)) !!}
                                        </p>
                                    </div>

                                </div>

                            @else

                                <div class="alert alert-warning mb-0">
                                    <i class="bi bi-info-circle me-1"></i>
                                    The donor has not added a message yet.
                                </div>

                            @endif

                        </div>


                        <div class="modal-footer border-top px-4 py-3">

                            <button
                                type="button"
                                class="btn btn-light border"
                                data-bs-dismiss="modal"
                            >
                                Close
                            </button>

                        </div>

                    </div>

                </div>
            </div>

        @endif

    @endforeach


    @include('layouts.admin.script')

</body>
