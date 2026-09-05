@include('layouts.admin.head')

<title>Admin Request Approval</title>

<body>

    {{-- =========================================================
        SIDEBAR
    ========================================================== --}}
    @include('layouts.admin.sidebar')


    {{-- =========================================================
        MAIN CONTENT
    ========================================================== --}}
    <div class="nsn-main">

        {{-- Topbar --}}
        @include('layouts.admin.header')


        <main class="nsn-content">

            {{-- =====================================================
                PAGE HEADER
            ====================================================== --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

                <div>

                    <h3 class="fw-bold text-dark mb-1">
                        Request Approvals
                    </h3>

                    <p class="text-secondary small mb-0">
                        Review beneficiary, donor and product information before approving or rejecting requests.
                    </p>

                </div>


                <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">

                    <i class="bi bi-clipboard-check me-1"></i>

                    {{ $requests->total() }} total requests

                </span>

            </div>


            {{-- =====================================================
                BREADCRUMB
            ====================================================== --}}
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


            {{-- =====================================================
                ALERTS
            ====================================================== --}}
            @include('layouts.admin.alert')


            {{-- =====================================================
                REQUESTS CARD
            ====================================================== --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                {{-- Card Header --}}
                <div class="card-header bg-white border-bottom px-4 py-3">

                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

                        <div>

                            <h5 class="fw-semibold text-dark mb-1">
                                Product Requests
                            </h5>

                            <p class="text-secondary small mb-0">
                                Review beneficiary and donor profiles before making a final decision.
                            </p>

                        </div>


                        <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis px-3 py-2">

                            <i class="bi bi-hourglass-split me-1"></i>

                            {{ $requests->where('admin_status', 'pending')->count() }}
                            pending on this page

                        </span>

                    </div>

                </div>


                {{-- =================================================
                    REQUEST TABLE
                ================================================== --}}
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

                                        $beneficiary =
                                            $productRequest->beneficiary;

                                        $donor =
                                            $productRequest->donor;


                                        /*
                                        |--------------------------------------------------------------------------
                                        | Product Image
                                        |--------------------------------------------------------------------------
                                        */

                                        $productImages = [];

                                        if ($product) {

                                            $productImages =
                                                is_array($product->images)
                                                    ? $product->images
                                                    : json_decode(
                                                        $product->images,
                                                        true
                                                    );

                                            $productImages =
                                                is_array($productImages)
                                                    ? $productImages
                                                    : [];
                                        }


                                        $productImage =
                                            !empty($productImages)
                                                ? asset(
                                                    'admins/products/' .
                                                    $productImages[0]
                                                )
                                                : asset(
                                                    'admins/asset/dummy/dummy.jpg'
                                                );


                                        /*
                                        |--------------------------------------------------------------------------
                                        | Status
                                        |--------------------------------------------------------------------------
                                        */

                                        $isApproved =
                                            $productRequest->admin_status ===
                                            'approved';

                                        $isRejected =
                                            $productRequest->admin_status ===
                                            'rejected';


                                        $adminBadge =
                                            match (
                                                $productRequest->admin_status
                                            ) {
                                                'approved' =>
                                                    'bg-success-subtle text-success',

                                                'rejected' =>
                                                    'bg-danger-subtle text-danger',

                                                default =>
                                                    'bg-warning-subtle text-warning-emphasis',
                                            };


                                        $donorBadge =
                                            match (
                                                $productRequest->donor_status
                                            ) {
                                                'accepted' =>
                                                    'bg-success-subtle text-success',

                                                'rejected' =>
                                                    'bg-danger-subtle text-danger',

                                                default =>
                                                    'bg-info-subtle text-info-emphasis',
                                            };

                                    @endphp


                                    <tr>

                                        {{-- =====================================
                                            NUMBER
                                        ====================================== --}}
                                        <td class="px-4">

                                            <span class="text-secondary">
                                                {{ $requests->firstItem() + $key }}
                                            </span>

                                        </td>


                                        {{-- =====================================
                                            PRODUCT
                                        ====================================== --}}
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


                                        {{-- =====================================
                                            BENEFICIARY / DONOR
                                        ====================================== --}}
                                        <td>

                                            <div class="d-flex flex-column align-items-start gap-2">


                                                @if ($beneficiary)

                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-info btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#beneficiaryModal{{ $productRequest->id }}"
                                                    >
                                                        <i class="bi bi-person-vcard me-1"></i>

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


                                        {{-- =====================================
                                            ADMIN STATUS
                                        ====================================== --}}
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


                                        {{-- =====================================
                                            DONOR STATUS
                                        ====================================== --}}
                                        <td>

                                            <span class="badge rounded-pill {{ $donorBadge }} px-3 py-2">

                                                @if ($productRequest->donor_status === 'accepted')

                                                    <i class="bi bi-check-circle me-1"></i>

                                                @elseif ($productRequest->donor_status === 'rejected')

                                                    <i class="bi bi-x-circle me-1"></i>

                                                @else

                                                    <i class="bi bi-clock me-1"></i>

                                                @endif


                                                {{
                                                    $productRequest->donor_status === 'pending'
                                                        ? 'Waiting'
                                                        : ucfirst(
                                                            $productRequest->donor_status
                                                        )
                                                }}

                                            </span>

                                        </td>


                                        {{-- =====================================
                                            DATE
                                        ====================================== --}}
                                        <td>

                                            <div class="small text-dark">

                                                <i class="bi bi-calendar3 text-secondary me-1"></i>

                                                {{
                                                    optional(
                                                        $productRequest->created_at
                                                    )->format('d M Y')
                                                }}

                                            </div>


                                            <small class="text-secondary">

                                                {{
                                                    optional(
                                                        $productRequest->created_at
                                                    )->diffForHumans()
                                                }}

                                            </small>

                                        </td>


                                        {{-- =====================================
                                            ACTIONS
                                        ====================================== --}}
                                        <td class="px-4 text-end">

                                            <div class="d-inline-flex flex-column flex-sm-row gap-2">


                                                {{-- APPROVE --}}
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

                                                        {{
                                                            $isApproved
                                                                ? 'Approved'
                                                                : 'Approve'
                                                        }}

                                                    </button>

                                                </form>


                                                {{-- REJECT --}}
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
                                                        class="btn btn-sm {{ $isRejected ? 'btn-secondary' : 'btn-danger' }}"
                                                        @disabled($isRejected)
                                                        onclick="return confirm('Reject this product request?');"
                                                    >

                                                        <i class="bi bi-x-lg me-1"></i>

                                                        {{
                                                            $isRejected
                                                                ? 'Rejected'
                                                                : 'Reject'
                                                        }}

                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>


                                @empty


                                    <tr>

                                        <td
                                            colspan="7"
                                            class="text-center py-5"
                                        >

                                            <div class="d-flex flex-column align-items-center">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light text-secondary mb-3"
                                                    style="width:64px;height:64px;"
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


                {{-- =================================================
                    PAGINATION
                ================================================== --}}
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



    {{-- =============================================================
        PROFILE MODALS
    ============================================================= --}}
    @foreach ($requests as $productRequest)

        @php

            $beneficiary =
                $productRequest->beneficiary;

            $donor =
                $productRequest->donor;


            $beneficiaryProfile =
                $beneficiary?->beneficiaryProfile;

            $donorProfile =
                $donor?->donorProfile;


            /*
            |--------------------------------------------------------------------------
            | Images
            |--------------------------------------------------------------------------
            */

            $beneficiaryImage =
                $beneficiary && $beneficiary->image
                    ? asset(
                        'admins/asset/profilephoto/' .
                        $beneficiary->image
                    )
                    : asset(
                        'admins/asset/dummy/dummy.jpg'
                    );


            $donorImage =
                $donor && $donor->image
                    ? asset(
                        'admins/asset/profilephoto/' .
                        $donor->image
                    )
                    : asset(
                        'admins/asset/dummy/dummy.jpg'
                    );


            /*
            |--------------------------------------------------------------------------
            | Status Badges
            |--------------------------------------------------------------------------
            */

            $accountStatusBadge =
                match (
                    $beneficiary?->account_status
                ) {
                    'active' =>
                        'bg-success-subtle text-success',

                    'suspended' =>
                        'bg-warning-subtle text-warning-emphasis',

                    'blocked' =>
                        'bg-danger-subtle text-danger',

                    default =>
                        'bg-secondary-subtle text-secondary',
                };


            $donorAccountStatusBadge =
                match (
                    $donor?->account_status
                ) {
                    'active' =>
                        'bg-success-subtle text-success',

                    'suspended' =>
                        'bg-warning-subtle text-warning-emphasis',

                    'blocked' =>
                        'bg-danger-subtle text-danger',

                    default =>
                        'bg-secondary-subtle text-secondary',
                };

        @endphp



        {{-- =========================================================
            BENEFICIARY MODAL
        ========================================================== --}}
        @if ($beneficiary)

            <div
                class="modal fade"
                id="beneficiaryModal{{ $productRequest->id }}"
                tabindex="-1"
                aria-labelledby="beneficiaryModalLabel{{ $productRequest->id }}"
                aria-hidden="true"
            >

                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

                    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">


                        {{-- =================================================
                            HEADER
                        ================================================== --}}
                        <div class="modal-header bg-white border-bottom px-4 py-3">

                            <div>

                                <h5
                                    class="modal-title fw-bold text-dark mb-1"
                                    id="beneficiaryModalLabel{{ $productRequest->id }}"
                                >
                                    Beneficiary Profile
                                </h5>


                                <p class="text-secondary small mb-0">
                                    Complete beneficiary information for request #{{ $productRequest->id }}.
                                </p>

                            </div>


                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>

                        </div>


                        {{-- =================================================
                            BODY
                        ================================================== --}}
                        <div class="modal-body bg-light p-4">


                            {{-- =============================================
                                PROFILE SUMMARY
                            ============================================== --}}
                            <div class="card border-0 shadow-sm rounded-4 mb-4">

                                <div class="card-body p-4">

                                    <div class="row align-items-center g-4">


                                        <div class="col-12 col-lg-auto">

                                            <div class="text-center">

                                                <img
                                                    src="{{ $beneficiaryImage }}"
                                                    alt="{{ $beneficiary->name }}"
                                                    width="125"
                                                    height="125"
                                                    class="rounded-circle border border-4 border-white shadow-sm object-fit-cover"
                                                >

                                            </div>

                                        </div>


                                        <div class="col-12 col-lg">

                                            <div class="d-flex flex-column flex-lg-row justify-content-between gap-3">

                                                <div>

                                                    <div class="d-flex flex-wrap align-items-center gap-2 mb-2">

                                                        <h4 class="fw-bold text-dark mb-0">
                                                            {{ $beneficiary->name }}
                                                        </h4>


                                                        <span class="badge rounded-pill bg-info-subtle text-info-emphasis px-3 py-2">
                                                            Beneficiary
                                                        </span>


                                                        <span class="badge rounded-pill {{ $accountStatusBadge }} px-3 py-2">

                                                            {{
                                                                ucfirst(
                                                                    $beneficiary->account_status
                                                                    ?? 'Unknown'
                                                                )
                                                            }}

                                                        </span>

                                                    </div>


                                                    <p class="text-secondary mb-2">

                                                        <i class="bi bi-envelope me-2"></i>

                                                        {{ $beneficiary->email }}

                                                    </p>


                                                    <p class="text-secondary mb-0">

                                                        <i class="bi bi-telephone me-2"></i>

                                                        {{ $beneficiary->phone ?? 'Phone not available' }}

                                                    </p>

                                                </div>


                                                <div class="text-lg-end">

                                                    <small class="d-block text-secondary mb-1">
                                                        Request ID
                                                    </small>

                                                    <span class="fw-bold text-dark">
                                                        #{{ $productRequest->id }}
                                                    </span>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>



                            <div class="row g-4">


                                {{-- =============================================
                                    ACCOUNT INFORMATION
                                ============================================== --}}
                                <div class="col-12 col-lg-6">

                                    <div class="card border-0 shadow-sm rounded-4 h-100">

                                        <div class="card-header bg-white border-bottom px-4 py-3">

                                            <div class="d-flex align-items-center gap-2">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary"
                                                    style="width:38px;height:38px;"
                                                >
                                                    <i class="bi bi-person-vcard"></i>
                                                </span>


                                                <h6 class="fw-bold text-dark mb-0">
                                                    Account Information
                                                </h6>

                                            </div>

                                        </div>


                                        <div class="card-body p-0">

                                            <div class="profile-info-row">

                                                <span>
                                                    Full Name
                                                </span>

                                                <strong>
                                                    {{ $beneficiary->name }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row">

                                                <span>
                                                    Email
                                                </span>

                                                <strong class="text-break">
                                                    {{ $beneficiary->email }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row">

                                                <span>
                                                    Phone
                                                </span>

                                                <strong>
                                                    {{ $beneficiary->phone ?? 'Not available' }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row">

                                                <span>
                                                    Qalam ID
                                                </span>

                                                <strong>
                                                    {{ $beneficiary->qalam_id ?? 'Not available' }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row">

                                                <span>
                                                    Gender
                                                </span>

                                                <strong class="text-capitalize">

                                                    {{ $beneficiaryProfile?->gender ?? 'Not available' }}

                                                </strong>

                                            </div>


                                            <div class="profile-info-row border-bottom-0">

                                                <span>
                                                    Member Since
                                                </span>

                                                <strong>

                                                    {{
                                                        optional(
                                                            $beneficiary->created_at
                                                        )->format('d M Y')
                                                        ?? 'Not available'
                                                    }}

                                                </strong>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                                {{-- =============================================
                                    ACADEMIC INFORMATION
                                ============================================== --}}
                                <div class="col-12 col-lg-6">

                                    <div class="card border-0 shadow-sm rounded-4 h-100">

                                        <div class="card-header bg-white border-bottom px-4 py-3">

                                            <div class="d-flex align-items-center gap-2">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success-subtle text-success"
                                                    style="width:38px;height:38px;"
                                                >
                                                    <i class="bi bi-mortarboard"></i>
                                                </span>


                                                <h6 class="fw-bold text-dark mb-0">
                                                    Academic Information
                                                </h6>

                                            </div>

                                        </div>


                                        <div class="card-body p-0">

                                            <div class="profile-info-row">

                                                <span>
                                                    Institution
                                                </span>

                                                <strong>
                                                    {{ $beneficiaryProfile?->institution ?? 'Not available' }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row">

                                                <span>
                                                    Degree Level
                                                </span>

                                                <strong>
                                                    {{ $beneficiaryProfile?->degree_level ?? 'Not available' }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row">

                                                <span>
                                                    Degree Program
                                                </span>

                                                <strong class="text-end">
                                                    {{ $beneficiaryProfile?->degree_program ?? 'Not available' }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row">

                                                <span>
                                                    Department
                                                </span>

                                                <strong class="text-end">
                                                    {{ $beneficiaryProfile?->department ?? 'Not available' }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row">

                                                <span>
                                                    Semester
                                                </span>

                                                <strong>
                                                    {{ $beneficiaryProfile?->semester ?? 'Not available' }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row">

                                                <span>
                                                    CGPA
                                                </span>

                                                <strong>

                                                    @if (!is_null($beneficiaryProfile?->cgpa))

                                                        {{ number_format((float) $beneficiaryProfile->cgpa, 2) }} / 4.00

                                                    @else

                                                        Not available

                                                    @endif

                                                </strong>

                                            </div>


                                            <div class="profile-info-row">

                                                <span>
                                                    Enrollment Year
                                                </span>

                                                <strong>
                                                    {{ $beneficiaryProfile?->enrollment_year ?? 'Not available' }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row border-bottom-0">

                                                <span>
                                                    Graduation Year
                                                </span>

                                                <strong>
                                                    {{ $beneficiaryProfile?->graduation_year ?? 'Not available' }}
                                                </strong>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                                {{-- =============================================
                                    FAMILY AND FINANCIAL
                                ============================================== --}}
                                <div class="col-12 col-lg-6">

                                    <div class="card border-0 shadow-sm rounded-4 h-100">

                                        <div class="card-header bg-white border-bottom px-4 py-3">

                                            <div class="d-flex align-items-center gap-2">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-info-subtle text-info-emphasis"
                                                    style="width:38px;height:38px;"
                                                >
                                                    <i class="bi bi-people"></i>
                                                </span>


                                                <h6 class="fw-bold text-dark mb-0">
                                                    Family & Financial Information
                                                </h6>

                                            </div>

                                        </div>


                                        <div class="card-body p-0">

                                            <div class="profile-info-row">

                                                <span>
                                                    Father Status
                                                </span>

                                                <strong>
                                                    {{ $beneficiaryProfile?->father_status ?? 'Not available' }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row">

                                                <span>
                                                    Guardian Profession
                                                </span>

                                                <strong class="text-end">
                                                    {{ $beneficiaryProfile?->guardian_profession ?? 'Not available' }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row border-bottom-0">

                                                <span>
                                                    Monthly Household Income
                                                </span>

                                                <strong>

                                                    @if (!is_null($beneficiaryProfile?->monthly_income))

                                                        PKR
                                                        {{
                                                            number_format(
                                                                (float) $beneficiaryProfile->monthly_income,
                                                                2
                                                            )
                                                        }}

                                                    @else

                                                        Not available

                                                    @endif

                                                </strong>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                                {{-- =============================================
                                    LOCATION
                                ============================================== --}}
                                <div class="col-12 col-lg-6">

                                    <div class="card border-0 shadow-sm rounded-4 h-100">

                                        <div class="card-header bg-white border-bottom px-4 py-3">

                                            <div class="d-flex align-items-center gap-2">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning-subtle text-warning-emphasis"
                                                    style="width:38px;height:38px;"
                                                >
                                                    <i class="bi bi-geo-alt"></i>
                                                </span>


                                                <h6 class="fw-bold text-dark mb-0">
                                                    Location Information
                                                </h6>

                                            </div>

                                        </div>


                                        <div class="card-body p-0">

                                            <div class="profile-info-row">

                                                <span>
                                                    Province / Territory
                                                </span>

                                                <strong class="text-end">
                                                    {{ $beneficiaryProfile?->province ?? 'Not available' }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row">

                                                <span>
                                                    Domicile
                                                </span>

                                                <strong>
                                                    {{ $beneficiaryProfile?->domicile ?? 'Not available' }}
                                                </strong>

                                            </div>


                                            <div class="p-3">

                                                <span class="d-block text-secondary small mb-2">
                                                    Permanent Home Address
                                                </span>


                                                <div class="fw-semibold text-dark small lh-lg">

                                                    {{
                                                        $beneficiaryProfile?->home_address
                                                        ?? 'Not available'
                                                    }}

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                                {{-- =============================================
                                    REQUEST INFORMATION
                                ============================================== --}}
                                <div class="col-12">

                                    <div class="card border-0 shadow-sm rounded-4">

                                        <div class="card-header bg-white border-bottom px-4 py-3">

                                            <div class="d-flex align-items-center gap-2">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-secondary-subtle text-secondary"
                                                    style="width:38px;height:38px;"
                                                >
                                                    <i class="bi bi-clipboard-data"></i>
                                                </span>


                                                <h6 class="fw-bold text-dark mb-0">
                                                    Current Request Information
                                                </h6>

                                            </div>

                                        </div>


                                        <div class="card-body">

                                            <div class="row g-3">


                                                <div class="col-12 col-md-3">

                                                    <small class="d-block text-secondary mb-1">
                                                        Request ID
                                                    </small>

                                                    <strong>
                                                        #{{ $productRequest->id }}
                                                    </strong>

                                                </div>


                                                <div class="col-12 col-md-3">

                                                    <small class="d-block text-secondary mb-1">
                                                        Product
                                                    </small>

                                                    <strong>
                                                        {{ $productRequest->product?->name ?? 'Unavailable' }}
                                                    </strong>

                                                </div>


                                                <div class="col-12 col-md-3">

                                                    <small class="d-block text-secondary mb-1">
                                                        Admin Status
                                                    </small>

                                                    <strong class="text-capitalize">
                                                        {{ $productRequest->admin_status }}
                                                    </strong>

                                                </div>


                                                <div class="col-12 col-md-3">

                                                    <small class="d-block text-secondary mb-1">
                                                        Donor Status
                                                    </small>

                                                    <strong class="text-capitalize">
                                                        {{ $productRequest->donor_status }}
                                                    </strong>

                                                </div>


                                            </div>

                                        </div>

                                    </div>

                                </div>


                            </div>

                        </div>


                        {{-- =================================================
                            FOOTER
                        ================================================== --}}
                        <div class="modal-footer bg-white border-top px-4 py-3">

                            <button
                                type="button"
                                class="btn btn-light border"
                                data-bs-dismiss="modal"
                            >
                                <i class="bi bi-x-circle me-1"></i>

                                Close
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        @endif



        {{-- =========================================================
            DONOR MODAL
        ========================================================== --}}
        @if ($donor)

            <div
                class="modal fade"
                id="donorModal{{ $productRequest->id }}"
                tabindex="-1"
                aria-labelledby="donorModalLabel{{ $productRequest->id }}"
                aria-hidden="true"
            >

                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

                    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">


                        {{-- Header --}}
                        <div class="modal-header bg-white border-bottom px-4 py-3">

                            <div>

                                <h5
                                    class="modal-title fw-bold text-dark mb-1"
                                    id="donorModalLabel{{ $productRequest->id }}"
                                >
                                    Donor Profile
                                </h5>


                                <p class="text-secondary small mb-0">
                                    Review donor account, organization and contact details.
                                </p>

                            </div>


                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>

                        </div>


                        {{-- Body --}}
                        <div class="modal-body bg-light p-4">


                            {{-- =============================================
                                PROFILE SUMMARY
                            ============================================== --}}
                            <div class="card border-0 shadow-sm rounded-4 mb-4">

                                <div class="card-body p-4">

                                    <div class="row align-items-center g-4">


                                        <div class="col-12 col-lg-auto">

                                            <div class="text-center">

                                                <img
                                                    src="{{ $donorImage }}"
                                                    alt="{{ $donor->name }}"
                                                    width="125"
                                                    height="125"
                                                    class="rounded-circle border border-4 border-white shadow-sm object-fit-cover"
                                                >

                                            </div>

                                        </div>


                                        <div class="col-12 col-lg">

                                            <div class="d-flex flex-column flex-lg-row justify-content-between gap-3">

                                                <div>

                                                    <div class="d-flex flex-wrap align-items-center gap-2 mb-2">

                                                        <h4 class="fw-bold text-dark mb-0">
                                                            {{ $donor->name }}
                                                        </h4>


                                                        <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">
                                                            Donor
                                                        </span>


                                                        <span class="badge rounded-pill {{ $donorAccountStatusBadge }} px-3 py-2">

                                                            {{
                                                                ucfirst(
                                                                    $donor->account_status
                                                                    ?? 'Unknown'
                                                                )
                                                            }}

                                                        </span>

                                                    </div>


                                                    <p class="text-secondary mb-2">

                                                        <i class="bi bi-envelope me-2"></i>

                                                        {{ $donor->email }}

                                                    </p>


                                                    <p class="text-secondary mb-0">

                                                        <i class="bi bi-telephone me-2"></i>

                                                        {{ $donor->phone ?? 'Phone not available' }}

                                                    </p>

                                                </div>


                                                <div class="text-lg-end">

                                                    <small class="d-block text-secondary mb-1">
                                                        Donor ID
                                                    </small>

                                                    <span class="fw-bold">
                                                        #{{ $donor->id }}
                                                    </span>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>



                            <div class="row g-4">


                                {{-- =============================================
                                    ACCOUNT
                                ============================================== --}}
                                <div class="col-12 col-lg-6">

                                    <div class="card border-0 shadow-sm rounded-4 h-100">

                                        <div class="card-header bg-white border-bottom px-4 py-3">

                                            <div class="d-flex align-items-center gap-2">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary"
                                                    style="width:38px;height:38px;"
                                                >
                                                    <i class="bi bi-person"></i>
                                                </span>


                                                <h6 class="fw-bold text-dark mb-0">
                                                    Account Information
                                                </h6>

                                            </div>

                                        </div>


                                        <div class="card-body p-0">

                                            <div class="profile-info-row">

                                                <span>
                                                    Full Name
                                                </span>

                                                <strong>
                                                    {{ $donor->name }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row">

                                                <span>
                                                    Email
                                                </span>

                                                <strong class="text-break">
                                                    {{ $donor->email }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row">

                                                <span>
                                                    Phone
                                                </span>

                                                <strong>
                                                    {{ $donor->phone ?? 'Not available' }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row">

                                                <span>
                                                    Account Status
                                                </span>

                                                <strong class="text-capitalize">
                                                    {{ $donor->account_status ?? 'Not available' }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row border-bottom-0">

                                                <span>
                                                    Member Since
                                                </span>

                                                <strong>

                                                    {{
                                                        optional(
                                                            $donor->created_at
                                                        )->format('d M Y')
                                                        ?? 'Not available'
                                                    }}

                                                </strong>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                                {{-- =============================================
                                    ORGANIZATION
                                ============================================== --}}
                                <div class="col-12 col-lg-6">

                                    <div class="card border-0 shadow-sm rounded-4 h-100">

                                        <div class="card-header bg-white border-bottom px-4 py-3">

                                            <div class="d-flex align-items-center gap-2">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success-subtle text-success"
                                                    style="width:38px;height:38px;"
                                                >
                                                    <i class="bi bi-building"></i>
                                                </span>


                                                <h6 class="fw-bold text-dark mb-0">
                                                    Organization Information
                                                </h6>

                                            </div>

                                        </div>


                                        <div class="card-body p-0">

                                            <div class="profile-info-row">

                                                <span>
                                                    Organization
                                                </span>

                                                <strong class="text-end">
                                                    {{ $donorProfile?->organization ?? 'Not available' }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row">

                                                <span>
                                                    Designation
                                                </span>

                                                <strong class="text-end">
                                                    {{ $donorProfile?->designation ?? 'Not available' }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row border-bottom-0">

                                                <span>
                                                    Country
                                                </span>

                                                <strong>
                                                    {{ $donorProfile?->country ?? 'Not available' }}
                                                </strong>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                                {{-- =============================================
                                    CONTACT
                                ============================================== --}}
                                <div class="col-12 col-lg-6">

                                    <div class="card border-0 shadow-sm rounded-4 h-100">

                                        <div class="card-header bg-white border-bottom px-4 py-3">

                                            <div class="d-flex align-items-center gap-2">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-info-subtle text-info-emphasis"
                                                    style="width:38px;height:38px;"
                                                >
                                                    <i class="bi bi-envelope"></i>
                                                </span>


                                                <h6 class="fw-bold text-dark mb-0">
                                                    Contact Information
                                                </h6>

                                            </div>

                                        </div>


                                        <div class="card-body p-0">

                                            <div class="profile-info-row">

                                                <span>
                                                    Email Address
                                                </span>

                                                <strong class="text-break">
                                                    {{ $donor->email }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row">

                                                <span>
                                                    Phone Number
                                                </span>

                                                <strong>
                                                    {{ $donor->phone ?? 'Not available' }}
                                                </strong>

                                            </div>


                                            <div class="p-3">

                                                <span class="d-block text-secondary small mb-2">
                                                    Address
                                                </span>


                                                <div class="fw-semibold small text-dark lh-lg">

                                                    {{ $donorProfile?->address ?? 'Not available' }}

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                                {{-- =============================================
                                    REQUEST DETAILS
                                ============================================== --}}
                                <div class="col-12 col-lg-6">

                                    <div class="card border-0 shadow-sm rounded-4 h-100">

                                        <div class="card-header bg-white border-bottom px-4 py-3">

                                            <div class="d-flex align-items-center gap-2">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning-subtle text-warning-emphasis"
                                                    style="width:38px;height:38px;"
                                                >
                                                    <i class="bi bi-clipboard-check"></i>
                                                </span>


                                                <h6 class="fw-bold text-dark mb-0">
                                                    Request Information
                                                </h6>

                                            </div>

                                        </div>


                                        <div class="card-body p-0">

                                            <div class="profile-info-row">

                                                <span>
                                                    Request ID
                                                </span>

                                                <strong>
                                                    #{{ $productRequest->id }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row">

                                                <span>
                                                    Product
                                                </span>

                                                <strong class="text-end">
                                                    {{ $productRequest->product?->name ?? 'Not available' }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row">

                                                <span>
                                                    Admin Decision
                                                </span>

                                                <strong class="text-capitalize">
                                                    {{ $productRequest->admin_status }}
                                                </strong>

                                            </div>


                                            <div class="profile-info-row">

                                                <span>
                                                    Donor Decision
                                                </span>

                                                <strong>

                                                    {{
                                                        $productRequest->donor_status === 'pending'
                                                            ? 'Waiting'
                                                            : ucfirst(
                                                                $productRequest->donor_status
                                                            )
                                                    }}

                                                </strong>

                                            </div>


                                            <div class="profile-info-row border-bottom-0">

                                                <span>
                                                    Request Date
                                                </span>

                                                <strong>

                                                    {{
                                                        optional(
                                                            $productRequest->created_at
                                                        )->format('d M Y')
                                                        ?? 'Not available'
                                                    }}

                                                </strong>

                                            </div>

                                        </div>

                                    </div>

                                </div>


                            </div>

                        </div>


                        {{-- Footer --}}
                        <div class="modal-footer bg-white border-top px-4 py-3">

                            <button
                                type="button"
                                class="btn btn-light border"
                                data-bs-dismiss="modal"
                            >
                                <i class="bi bi-x-circle me-1"></i>

                                Close
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        @endif

    @endforeach



    {{-- =========================================================
        MODAL STYLES
    ========================================================== --}}
    <style>

        /*
        |--------------------------------------------------------------------------
        | Profile Modal
        |--------------------------------------------------------------------------
        */

        .modal-xl {
            --bs-modal-width: 1140px;
        }


        .profile-info-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 24px;

            padding: 14px 16px;

            border-bottom: 1px solid #e9ecef;
        }


        .profile-info-row > span {
            flex: 0 0 42%;

            color: #6c757d;

            font-size: 0.875rem;
        }


        .profile-info-row > strong {
            flex: 1;

            color: #212529;

            font-size: 0.875rem;

            font-weight: 600;

            text-align: right;

            word-break: break-word;
        }


        /*
        |--------------------------------------------------------------------------
        | Modal Scroll
        |--------------------------------------------------------------------------
        */

        .modal-dialog-scrollable .modal-content {
            max-height: calc(100vh - 40px);
        }


        .modal-dialog-scrollable .modal-body {
            overflow-y: auto;
        }


        /*
        |--------------------------------------------------------------------------
        | Cards
        |--------------------------------------------------------------------------
        */

        .modal-body .card {
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }


        /*
        |--------------------------------------------------------------------------
        | Responsive
        |--------------------------------------------------------------------------
        */

        @media (max-width: 767.98px) {

            .profile-info-row {
                flex-direction: column;

                gap: 4px;
            }


            .profile-info-row > span,
            .profile-info-row > strong {
                flex: 0 0 auto;

                width: 100%;
            }


            .profile-info-row > strong {
                text-align: left;
            }


            .modal-body {
                padding: 16px !important;
            }

        }

    </style>


    @include('layouts.admin.script')

</body>