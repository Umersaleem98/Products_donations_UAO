@include('layouts.admin.head')

<title>Admin Request Approval</title>

<body>

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
                        Request Approvals
                    </h3>

                    <p class="text-secondary small mb-0">
                        Review product requests and approve or reject them.
                    </p>
                </div>

                <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                    <i class="bi bi-clipboard-check me-1"></i>
                    {{ $requests->total() }} total requests
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
                        Request Approvals
                    </li>

                </ol>

            </nav>


            {{-- Alerts --}}
            @include('layouts.admin.alert')


            {{-- Requests Card --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                {{-- Card Header --}}
                <div class="card-header bg-white border-bottom px-4 py-3">

                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

                        <div>
                            <h5 class="fw-semibold text-dark mb-1">
                                Product Requests
                            </h5>

                            <p class="text-secondary small mb-0">
                                Review beneficiary and donor information before making a decision.
                            </p>
                        </div>

                        <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis px-3 py-2">
                            <i class="bi bi-hourglass-split me-1"></i>

                            {{ $requests->where('admin_status', 'pending')->count() }}
                            pending on this page
                        </span>

                    </div>

                </div>


                {{-- Requests Table --}}
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
                                        People
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        Admin Status
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        Donor Status
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        Date
                                    </th>

                                    <th class="px-4 py-3 text-secondary small text-end">
                                        Decision
                                    </th>
                                </tr>
                            </thead>


                            <tbody>

                                @forelse ($requests as $key => $productRequest)

                                    @php
                                        $product = $productRequest->product;
                                        $beneficiary = $productRequest->beneficiary;
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
                                            ? asset('admins/products/' . $productImages[0])
                                            : asset('admins/asset/dummy/dummy.jpg');

                                        $isApproved =
                                            $productRequest->admin_status === 'approved';

                                        $isRejected =
                                            $productRequest->admin_status === 'rejected';

                                        $adminBadge = match ($productRequest->admin_status) {
                                            'approved' => 'bg-success-subtle text-success',
                                            'rejected' => 'bg-danger-subtle text-danger',
                                            default => 'bg-warning-subtle text-warning-emphasis',
                                        };

                                        $donorBadge = match ($productRequest->donor_status) {
                                            'accepted' => 'bg-success-subtle text-success',
                                            'rejected' => 'bg-danger-subtle text-danger',
                                            default => 'bg-info-subtle text-info-emphasis',
                                        };
                                    @endphp

                                    <tr>

                                        {{-- Number --}}
                                        <td class="px-4">
                                            <span class="text-secondary">
                                                {{ $requests->firstItem() + $key }}
                                            </span>
                                        </td>


                                        {{-- Product --}}
                                        <td>
                                            <div class="d-flex align-items-center gap-3">

                                                <img
                                                    src="{{ $productImage }}"
                                                    alt="{{ $product->name ?? 'Product' }}"
                                                    width="58"
                                                    height="58"
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


                                        {{-- Beneficiary and Donor --}}
                                        <td>
                                            <div class="d-flex flex-column align-items-start gap-2">

                                                @if ($beneficiary)
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-info btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#beneficiaryModal{{ $productRequest->id }}"
                                                    >
                                                        <i class="bi bi-person me-1"></i>
                                                        Beneficiary
                                                    </button>
                                                @else
                                                    <span class="text-secondary small">
                                                        Beneficiary unavailable
                                                    </span>
                                                @endif

                                                @if ($donor)
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-primary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#donorModal{{ $productRequest->id }}"
                                                    >
                                                        <i class="bi bi-person-heart me-1"></i>
                                                        Donor
                                                    </button>
                                                @else
                                                    <span class="text-secondary small">
                                                        Donor unavailable
                                                    </span>
                                                @endif

                                            </div>
                                        </td>


                                        {{-- Admin Status --}}
                                        <td>
                                            <span class="badge rounded-pill {{ $adminBadge }} px-3 py-2">
                                                @if ($productRequest->admin_status === 'approved')
                                                    <i class="bi bi-check-circle me-1"></i>
                                                @elseif ($productRequest->admin_status === 'rejected')
                                                    <i class="bi bi-x-circle me-1"></i>
                                                @else
                                                    <i class="bi bi-hourglass-split me-1"></i>
                                                @endif

                                                {{ ucfirst($productRequest->admin_status) }}
                                            </span>
                                        </td>


                                        {{-- Donor Status --}}
                                        <td>
                                            <span class="badge rounded-pill {{ $donorBadge }} px-3 py-2">
                                                @if ($productRequest->donor_status === 'accepted')
                                                    <i class="bi bi-check-circle me-1"></i>
                                                @elseif ($productRequest->donor_status === 'rejected')
                                                    <i class="bi bi-x-circle me-1"></i>
                                                @else
                                                    <i class="bi bi-clock me-1"></i>
                                                @endif

                                                {{ $productRequest->donor_status === 'pending'
                                                    ? 'Waiting'
                                                    : ucfirst($productRequest->donor_status) }}
                                            </span>
                                        </td>


                                        {{-- Date --}}
                                        <td>
                                            <div class="small text-dark">
                                                <i class="bi bi-calendar3 text-secondary me-1"></i>

                                                {{ optional($productRequest->created_at)->format('d M Y') }}
                                            </div>

                                            <small class="text-secondary">
                                                {{ optional($productRequest->created_at)->diffForHumans() }}
                                            </small>
                                        </td>


                                        {{-- Admin Actions --}}
                                        <td class="px-4 text-end">

                                            <div class="d-inline-flex flex-column flex-sm-row gap-2">

                                                {{-- Approve --}}
                                                <form
                                                    method="POST"
                                                    action="{{ route('admin.request.update', $productRequest->id) }}"
                                                >
                                                    @csrf

                                                    <input
                                                        type="hidden"
                                                        name="admin_status"
                                                        value="approved"
                                                    >

                                                    <button
                                                        type="submit"
                                                        class="btn btn-sm {{ $isApproved ? 'btn-secondary' : 'btn-success' }}"
                                                        @disabled($isApproved)
                                                        onclick="return confirm('Approve this product request?');"
                                                    >
                                                        <i class="bi bi-check-lg me-1"></i>

                                                        {{ $isApproved ? 'Approved' : 'Approve' }}
                                                    </button>
                                                </form>


                                                {{-- Reject --}}
                                                <form
                                                    method="POST"
                                                    action="{{ route('admin.request.update', $productRequest->id) }}"
                                                >
                                                    @csrf

                                                    <input
                                                        type="hidden"
                                                        name="admin_status"
                                                        value="rejected"
                                                    >

                                                    <button
                                                        type="submit"
                                                        class="btn btn-sm {{ $isRejected ? 'btn-secondary                                                    <button
                                                        type="submit"
' : 'btn-danger' }}"
                                                        @disabled($isRejected)
                                                        onclick="return confirm('Reject this product request?');"
                                                    >
                                                        <i class="bi bi-x-lg me-1"></i>

                                                        {{ $isRejected ? 'Rejected' : 'Reject' }}
                                                    </button>
                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="7" class="text-center py-5">

                                            <div class="d-flex flex-column align-items-center">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light text-secondary mb-3"
                                                    style="width: 64px; height: 64px;"
                                                >
                                                    <i class="bi bi-clipboard-x fs-3"></i>
                                                </span>

                                                <h6 class="fw-semibold text-dark mb-1">
                                                    No requests found
                                                </h6>

                                                <p class="text-secondary small mb-0">
                                                    Product requests will appear here when submitted.
                                                </p>

                                            </div>

                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>


                {{-- Pagination --}}
                @if ($requests->hasPages())

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
    {{-- PROFILE MODALS --}}
    {{-- ===================================================== --}}
    @foreach ($requests as $productRequest)

        @php
            $beneficiary = $productRequest->beneficiary;
            $donor = $productRequest->donor;

            $beneficiaryProfile =
                $beneficiary?->beneficiaryProfile;

            $donorProfile =
                $donor?->donorProfile;

            $beneficiaryImage =
                $beneficiary && $beneficiary->image
                    ? asset(
                        'admins/asset/profilephoto/' .
                        $beneficiary->image
                    )
                    : asset('admins/asset/dummy/dummy.jpg');

            $donorImage =
                $donor && $donor->image
                    ? asset(
                        'admins/asset/profilephoto/' .
                        $donor->image
                    )
                    : asset('admins/asset/dummy/dummy.jpg');
        @endphp


        {{-- Beneficiary Modal --}}
        @if ($beneficiary)

            <div
                class="modal fade"
                id="beneficiaryModal{{ $productRequest->id }}"
                tabindex="-1"
                aria-labelledby="beneficiaryModalLabel{{ $productRequest->id }}"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content border-0 shadow rounded-4">

                        <div class="modal-header border-bottom px-4 py-3">

                            <h5
                                class="modal-title fw-bold"
                                id="beneficiaryModalLabel{{ $productRequest->id }}"
                            >
                                Beneficiary Profile
                            </h5>

                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>

                        </div>


                        <div class="modal-body p-4">

                            {{-- Profile --}}
                            <div class="text-center mb-4">

                                <img
                                    src="{{ $beneficiaryImage }}"
                                    alt="{{ $beneficiary->name }}"
                                    width="110"
                                    height="110"
                                    class="rounded-circle border border-3 object-fit-cover mb-3"
                                >

                                <h5 class="fw-bold text-dark mb-1">
                                    {{ $beneficiary->name }}
                                </h5>

                                <p class="text-secondary small mb-2">
                                    {{ $beneficiary->email }}
                                </p>

                                <span class="badge rounded-pill bg-info-subtle text-info-emphasis px-3 py-2">
                                    Beneficiary
                                </span>

                            </div>


                            {{-- Academic Information --}}
                            <h6 class="fw-bold text-dark mb-3">
                                <i class="bi bi-mortarboard text-primary me-2"></i>
                                Academic Information
                            </h6>

                            <div class="border rounded-3 overflow-hidden mb-4">

                                <div class="d-flex justify-content-between gap-3 p-3 border-bottom">
                                    <span class="text-secondary small">
                                        Institution
                                    </span>

                                    <span class="fw-semibold small text-end">
                                        {{ $beneficiaryProfile?->institution ?? 'Not available' }}
                                    </span>
                                </div>

                                <div class="d-flex justify-content-between gap-3 p-3 border-bottom">
                                    <span class="text-secondary small">
                                        Father Status
                                    </span>

                                    <span class="fw-semibold small text-end">
                                        {{ $beneficiaryProfile?->father_status ?? 'Not available' }}
                                    </span>
                                </div>

                                <div class="d-flex justify-content-between gap-3 p-3">
                                    <span class="text-secondary small">
                                        Guardian Profession
                                    </span>

                                    <span class="fw-semibold small text-end">
                                        {{ $beneficiaryProfile?->guardian_profession ?? 'Not available' }}
                                    </span>
                                </div>

                            </div>


                            {{-- Location --}}
                            <h6 class="fw-bold text-dark mb-3">
                                <i class="bi bi-geo-alt text-primary me-2"></i>
                                Location
                            </h6>

                            <div class="border rounded-3 overflow-hidden">

                                <div class="d-flex justify-content-between gap-3 p-3 border-bottom">
                                    <span class="text-secondary small">
                                        Province
                                    </span>

                                    <span class="fw-semibold small text-end">
                                        {{ $beneficiaryProfile?->province ?? 'Not available' }}
                                    </span>
                                </div>

                                <div class="d-flex justify-content-between gap-3 p-3 border-bottom">
                                    <span class="text-secondary small">
                                        Domicile
                                    </span>

                                    <span class="fw-semibold small text-end">
                                        {{ $beneficiaryProfile?->domicile ?? 'Not available' }}
                                    </span>
                                </div>

                                <div class="p-3">
                                    <span class="d-block text-secondary small mb-1">
                                        Home Address
                                    </span>

                                    <span class="fw-semibold small">
                                        {{ $beneficiaryProfile?->home_address ?? 'Not available' }}
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

        @endif


        {{-- Donor Modal --}}
        @if ($donor)

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

                            {{-- Profile --}}
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


                            {{-- Contact --}}
                            <h6 class="fw-bold text-dark mb-3">
                                <i class="bi bi-envelope text-primary me-2"></i>
                                Contact Information
                            </h6>

                            <div class="border rounded-3 overflow-hidden">

                                <div class="p-3 border-bottom">
                                    <span class="d-block text-secondary small mb-1">
                                        Email Address
                                    </span>

                                    <span class="fw-semibold small">
                                        {{ $donor->email }}
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

        @endif

    @endforeach


    @include('layouts.admin.script')

</body>
