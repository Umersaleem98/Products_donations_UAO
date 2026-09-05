@include('layouts.admin.head')

<title>Incoming Requests</title>

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
                        Incoming Requests
                    </h3>

                    <p class="text-secondary small mb-0">
                        Review beneficiary requests and accept or reject them.
                    </p>

                </div>


                <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2">

                    <i class="bi bi-inbox me-1"></i>

                    {{ $requests->total() }} total requests

                </span>

            </div>


            {{-- =====================================================
                BREADCRUMB
            ====================================================== --}}
            <nav
                aria-label="breadcrumb"
                class="mb-4"
            >

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
                        Incoming Requests
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
                                Beneficiary Requests
                            </h5>

                            <p class="text-secondary small mb-0">
                                Review the beneficiary's complete profile before making a decision.
                            </p>

                        </div>


                        <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis px-3 py-2">

                            <i class="bi bi-hourglass-split me-1"></i>

                            {{ $requests->where('donor_status', 'pending')->count() }}

                            pending on this page

                        </span>

                    </div>

                </div>



                {{-- =================================================
                    REQUESTS TABLE
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
                                        Beneficiary
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        Status
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        Date
                                    </th>

                                    <th class="px-4 py-3 text-secondary small text-end">
                                        Actions
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse ($requests as $key => $productRequest)

                                    @php

                                        $product =
                                            $productRequest->product;

                                        $beneficiary =
                                            $productRequest->beneficiary;


                                        /*
                                        |--------------------------------------------------------------------------
                                        | Product Images
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
                                            $productRequest->donor_status ===
                                            'approved';


                                        $isRejected =
                                            $productRequest->donor_status ===
                                            'rejected';


                                        $statusBadge =
                                            match (
                                                $productRequest->donor_status
                                            ) {

                                                'approved' =>
                                                    'bg-success-subtle text-success',

                                                'rejected' =>
                                                    'bg-danger-subtle text-danger',

                                                default =>
                                                    'bg-warning-subtle text-warning-emphasis',
                                            };


                                        $statusLabel =
                                            match (
                                                $productRequest->donor_status
                                            ) {

                                                'approved' =>
                                                    'Accepted',

                                                'rejected' =>
                                                    'Rejected',

                                                default =>
                                                    'Pending',
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



                                        {{-- =====================================
                                            BENEFICIARY
                                        ====================================== --}}
                                        <td>

                                            @if ($beneficiary)

                                                <div class="d-flex align-items-center gap-3">


                                                    @if ($beneficiary->image)

                                                        <img
                                                            src="{{ asset('admins/asset/profilephoto/' . $beneficiary->image) }}"
                                                            alt="{{ $beneficiary->name }}"
                                                            width="42"
                                                            height="42"
                                                            class="rounded-circle border object-fit-cover flex-shrink-0"
                                                        >

                                                    @else

                                                        <span
                                                            class="d-inline-flex align-items-center justify-content-center rounded-circle bg-info-subtle text-info-emphasis fw-semibold flex-shrink-0"
                                                            style="width:42px;height:42px;"
                                                        >

                                                            {{ strtoupper(substr($beneficiary->name, 0, 1)) }}

                                                        </span>

                                                    @endif


                                                    <div>

                                                        <div class="fw-semibold text-dark small">

                                                            {{ $beneficiary->name }}

                                                        </div>


                                                        <small class="d-block text-secondary">

                                                            {{ $beneficiary->email }}

                                                        </small>


                                                        <button
                                                            type="button"
                                                            class="btn btn-link btn-sm text-decoration-none p-0 mt-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#beneficiaryModal{{ $productRequest->id }}"
                                                        >

                                                            <i class="bi bi-person-vcard me-1"></i>

                                                            View complete profile

                                                        </button>

                                                    </div>

                                                </div>

                                            @else

                                                <span class="text-secondary small">

                                                    Beneficiary unavailable

                                                </span>

                                            @endif

                                        </td>



                                        {{-- =====================================
                                            STATUS
                                        ====================================== --}}
                                        <td>

                                            <span class="badge rounded-pill {{ $statusBadge }} px-3 py-2">

                                                @if ($isApproved)

                                                    <i class="bi bi-check-circle me-1"></i>

                                                @elseif ($isRejected)

                                                    <i class="bi bi-x-circle me-1"></i>

                                                @else

                                                    <i class="bi bi-hourglass-split me-1"></i>

                                                @endif


                                                {{ $statusLabel }}

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

                                            <div class="d-inline-flex flex-wrap justify-content-end gap-2">


                                                {{-- ACCEPT --}}
                                                <form
                                                    method="POST"
                                                    action="{{ route('donor.request.update', $productRequest->id) }}"
                                                >

                                                    @csrf


                                                    <input
                                                        type="hidden"
                                                        name="donor_status"
                                                        value="approved"
                                                    >


                                                    <button
                                                        type="submit"
                                                        class="btn btn-sm {{ $isApproved ? 'btn-secondary' : 'btn-success' }}"
                                                        @disabled($isApproved)
                                                        onclick="return confirm('Are you sure you want to accept this request?');"
                                                    >

                                                        <i class="bi bi-check-lg me-1"></i>


                                                        {{
                                                            $isApproved
                                                                ? 'Accepted'
                                                                : 'Accept'
                                                        }}

                                                    </button>

                                                </form>



                                                {{-- REJECT --}}
                                                <form
                                                    method="POST"
                                                    action="{{ route('donor.request.update', $productRequest->id) }}"
                                                >

                                                    @csrf


                                                    <input
                                                        type="hidden"
                                                        name="donor_status"
                                                        value="rejected"
                                                    >


                                                    <button
                                                        type="submit"
                                                        class="btn btn-sm {{ $isRejected ? 'btn-secondary' : 'btn-danger' }}"
                                                        @disabled($isRejected)
                                                        onclick="return confirm('Are you sure you want to reject this request?');"
                                                    >

                                                        <i class="bi bi-x-lg me-1"></i>


                                                        {{
                                                            $isRejected
                                                                ? 'Rejected'
                                                                : 'Reject'
                                                        }}

                                                    </button>

                                                </form>



                                                {{-- MESSAGE --}}
                                                <button
                                                    type="button"
                                                    class="btn btn-outline-primary btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#messageModal{{ $productRequest->id }}"
                                                >

                                                    <i class="bi bi-chat-dots me-1"></i>


                                                    {{
                                                        $productRequest->message
                                                            ? 'Edit Message'
                                                            : 'Message'
                                                    }}

                                                </button>

                                            </div>

                                        </td>

                                    </tr>


                                @empty


                                    <tr>

                                        <td
                                            colspan="6"
                                            class="text-center py-5"
                                        >

                                            <div class="d-flex flex-column align-items-center">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light text-secondary mb-3"
                                                    style="width:64px;height:64px;"
                                                >

                                                    <i class="bi bi-inbox fs-3"></i>

                                                </span>


                                                <h6 class="fw-semibold text-dark mb-1">

                                                    No incoming requests

                                                </h6>


                                                <p class="text-secondary small mb-0">

                                                    Beneficiary requests will appear here after admin approval.

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



    {{-- ============================================================
        BENEFICIARY + MESSAGE MODALS
    ============================================================= --}}
    @foreach ($requests as $productRequest)

        @php

            $beneficiary =
                $productRequest->beneficiary;


            $beneficiaryProfile =
                $beneficiary?->beneficiaryProfile;


            $beneficiaryImage =
                $beneficiary && $beneficiary->image
                    ? asset(
                        'admins/asset/profilephoto/' .
                        $beneficiary->image
                    )
                    : asset(
                        'admins/asset/dummy/dummy.jpg'
                    );


            /*
            |--------------------------------------------------------------------------
            | Account Status
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


            /*
            |--------------------------------------------------------------------------
            | Completion Calculation
            |--------------------------------------------------------------------------
            */

            $profileFields = [

                $beneficiary?->name,
                $beneficiary?->email,
                $beneficiary?->phone,
                $beneficiary?->qalam_id,

                $beneficiaryProfile?->gender,

                $beneficiaryProfile?->institution,
                $beneficiaryProfile?->degree_level,
                $beneficiaryProfile?->degree_program,
                $beneficiaryProfile?->department,
                $beneficiaryProfile?->semester,
                $beneficiaryProfile?->cgpa,
                $beneficiaryProfile?->enrollment_year,
                $beneficiaryProfile?->graduation_year,

                $beneficiaryProfile?->father_status,
                $beneficiaryProfile?->guardian_profession,
                $beneficiaryProfile?->monthly_income,

                $beneficiaryProfile?->province,
                $beneficiaryProfile?->domicile,
                $beneficiaryProfile?->home_address,
            ];


            $completedProfileFields =
                collect($profileFields)
                    ->filter(
                        fn ($field) =>
                            !is_null($field)
                            && trim((string) $field) !== ''
                    )
                    ->count();


            $profileCompletion =
                count($profileFields) > 0
                    ? (int) round(
                        (
                            $completedProfileFields /
                            count($profileFields)
                        ) * 100
                    )
                    : 0;

        @endphp



        {{-- ========================================================
            BENEFICIARY PROFILE MODAL
        ========================================================= --}}
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
                            MODAL HEADER
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

                                    Complete beneficiary information for
                                    Request #{{ $productRequest->id }}

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
                            MODAL BODY
                        ================================================== --}}
                        <div class="modal-body bg-light p-4">


                            {{-- =============================================
                                PROFILE OVERVIEW
                            ============================================== --}}
                            <div class="card border-0 shadow-sm rounded-4 mb-4">

                                <div class="card-body p-4">

                                    <div class="row align-items-center g-4">


                                        {{-- Image --}}
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



                                        {{-- Profile Heading --}}
                                        <div class="col-12 col-lg">

                                            <div class="d-flex flex-column flex-lg-row justify-content-between gap-4">

                                                <div>

                                                    <div class="d-flex flex-wrap align-items-center gap-2 mb-2">

                                                        <h4 class="fw-bold text-dark mb-0">

                                                            {{ $beneficiary->name }}

                                                        </h4>


                                                        <span class="badge rounded-pill bg-info-subtle text-info-emphasis px-3 py-2">

                                                            <i class="bi bi-mortarboard me-1"></i>

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

                                                        {{
                                                            $beneficiary->phone
                                                            ?? 'Phone number not available'
                                                        }}

                                                    </p>

                                                </div>



                                                {{-- Request Summary --}}
                                                <div class="text-lg-end">

                                                    <small class="d-block text-secondary mb-1">

                                                        Request ID

                                                    </small>


                                                    <span class="fw-bold text-dark d-block mb-2">

                                                        #{{ $productRequest->id }}

                                                    </span>


                                                    <span class="badge rounded-pill bg-primary-subtle text-primary">

                                                        {{
                                                            $productRequest->product?->name
                                                            ?? 'Product unavailable'
                                                        }}

                                                    </span>

                                                </div>

                                            </div>

                                        </div>

                                    </div>



                                    {{-- Profile Completion --}}
                                    <div class="border-top mt-4 pt-4">

                                        <div class="d-flex justify-content-between align-items-center mb-2">

                                            <span class="small text-secondary">

                                                Profile Information Completion

                                            </span>


                                            <strong class="small">

                                                {{ $profileCompletion }}%

                                            </strong>

                                        </div>


                                        <div
                                            class="progress"
                                            style="height:8px;"
                                        >

                                            <div
                                                class="progress-bar"
                                                role="progressbar"
                                                style="width: {{ $profileCompletion }}%;"
                                                aria-valuenow="{{ $profileCompletion }}"
                                                aria-valuemin="0"
                                                aria-valuemax="100"
                                            ></div>

                                        </div>

                                    </div>

                                </div>

                            </div>



                            <div class="row g-4">


                                {{-- =========================================
                                    PERSONAL / ACCOUNT INFORMATION
                                ========================================== --}}
                                <div class="col-12 col-lg-6">

                                    <div class="card border-0 shadow-sm rounded-4 h-100">

                                        <div class="card-header bg-white border-bottom px-4 py-3">

                                            <div class="d-flex align-items-center gap-3">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary flex-shrink-0"
                                                    style="width:42px;height:42px;"
                                                >

                                                    <i class="bi bi-person-vcard"></i>

                                                </span>


                                                <div>

                                                    <h6 class="fw-bold text-dark mb-1">

                                                        Personal Information

                                                    </h6>


                                                    <p class="text-secondary small mb-0">

                                                        Account and personal details.

                                                    </p>

                                                </div>

                                            </div>

                                        </div>


                                        <div class="card-body p-0">


                                            <div class="beneficiary-info-row">

                                                <span>
                                                    Full Name
                                                </span>

                                                <strong>
                                                    {{ $beneficiary->name }}
                                                </strong>

                                            </div>



                                            <div class="beneficiary-info-row">

                                                <span>
                                                    Email Address
                                                </span>

                                                <strong class="text-break">

                                                    {{ $beneficiary->email }}

                                                </strong>

                                            </div>



                                            <div class="beneficiary-info-row">

                                                <span>
                                                    Phone Number
                                                </span>

                                                <strong>

                                                    {{
                                                        $beneficiary->phone
                                                        ?? 'Not available'
                                                    }}

                                                </strong>

                                            </div>



                                            <div class="beneficiary-info-row">

                                                <span>
                                                    Qalam ID
                                                </span>

                                                <strong>

                                                    {{
                                                        $beneficiary->qalam_id
                                                        ?? 'Not available'
                                                    }}

                                                </strong>

                                            </div>



                                            <div class="beneficiary-info-row">

                                                <span>
                                                    Gender
                                                </span>

                                                <strong class="text-capitalize">

                                                    {{
                                                        $beneficiaryProfile?->gender
                                                        ?? 'Not available'
                                                    }}

                                                </strong>

                                            </div>



                                            <div class="beneficiary-info-row">

                                                <span>
                                                    Account Status
                                                </span>

                                                <strong class="text-capitalize">

                                                    {{
                                                        $beneficiary->account_status
                                                        ?? 'Not available'
                                                    }}

                                                </strong>

                                            </div>



                                            <div class="beneficiary-info-row border-bottom-0">

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



                                {{-- =========================================
                                    ACADEMIC INFORMATION
                                ========================================== --}}
                                <div class="col-12 col-lg-6">

                                    <div class="card border-0 shadow-sm rounded-4 h-100">

                                        <div class="card-header bg-white border-bottom px-4 py-3">

                                            <div class="d-flex align-items-center gap-3">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success-subtle text-success flex-shrink-0"
                                                    style="width:42px;height:42px;"
                                                >

                                                    <i class="bi bi-mortarboard"></i>

                                                </span>


                                                <div>

                                                    <h6 class="fw-bold text-dark mb-1">

                                                        Academic Information

                                                    </h6>


                                                    <p class="text-secondary small mb-0">

                                                        Student degree and academic progress.

                                                    </p>

                                                </div>

                                            </div>

                                        </div>


                                        <div class="card-body p-0">


                                            <div class="beneficiary-info-row">

                                                <span>
                                                    Institution
                                                </span>

                                                <strong>

                                                    {{
                                                        $beneficiaryProfile?->institution
                                                        ?? 'Not available'
                                                    }}

                                                </strong>

                                            </div>



                                            <div class="beneficiary-info-row">

                                                <span>
                                                    Degree Level
                                                </span>

                                                <strong>

                                                    {{
                                                        $beneficiaryProfile?->degree_level
                                                        ?? 'Not available'
                                                    }}

                                                </strong>

                                            </div>



                                            <div class="beneficiary-info-row">

                                                <span>
                                                    Degree Program
                                                </span>

                                                <strong>

                                                    {{
                                                        $beneficiaryProfile?->degree_program
                                                        ?? 'Not available'
                                                    }}

                                                </strong>

                                            </div>



                                            <div class="beneficiary-info-row">

                                                <span>
                                                    Department
                                                </span>

                                                <strong>

                                                    {{
                                                        $beneficiaryProfile?->department
                                                        ?? 'Not available'
                                                    }}

                                                </strong>

                                            </div>



                                            <div class="beneficiary-info-row">

                                                <span>
                                                    Current Semester
                                                </span>

                                                <strong>

                                                    {{
                                                        $beneficiaryProfile?->semester
                                                        ?? 'Not available'
                                                    }}

                                                </strong>

                                            </div>



                                            <div class="beneficiary-info-row">

                                                <span>
                                                    CGPA
                                                </span>

                                                <strong>

                                                    @if (
                                                        !is_null(
                                                            $beneficiaryProfile?->cgpa
                                                        )
                                                    )

                                                        {{
                                                            number_format(
                                                                (float) $beneficiaryProfile->cgpa,
                                                                2
                                                            )
                                                        }}

                                                        / 4.00

                                                    @else

                                                        Not available

                                                    @endif

                                                </strong>

                                            </div>



                                            <div class="beneficiary-info-row">

                                                <span>
                                                    Enrollment Year
                                                </span>

                                                <strong>

                                                    {{
                                                        $beneficiaryProfile?->enrollment_year
                                                        ?? 'Not available'
                                                    }}

                                                </strong>

                                            </div>



                                            <div class="beneficiary-info-row border-bottom-0">

                                                <span>
                                                    Expected Graduation
                                                </span>

                                                <strong>

                                                    {{
                                                        $beneficiaryProfile?->graduation_year
                                                        ?? 'Not available'
                                                    }}

                                                </strong>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                                {{-- =========================================
                                    FAMILY / FINANCIAL
                                ========================================== --}}
                                <div class="col-12 col-lg-6">

                                    <div class="card border-0 shadow-sm rounded-4 h-100">

                                        <div class="card-header bg-white border-bottom px-4 py-3">

                                            <div class="d-flex align-items-center gap-3">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-info-subtle text-info-emphasis flex-shrink-0"
                                                    style="width:42px;height:42px;"
                                                >

                                                    <i class="bi bi-people"></i>

                                                </span>


                                                <div>

                                                    <h6 class="fw-bold text-dark mb-1">

                                                        Family & Financial Information

                                                    </h6>


                                                    <p class="text-secondary small mb-0">

                                                        Household and guardian details.

                                                    </p>

                                                </div>

                                            </div>

                                        </div>


                                        <div class="card-body p-0">


                                            <div class="beneficiary-info-row">

                                                <span>
                                                    Father Status
                                                </span>

                                                <strong>

                                                    {{
                                                        $beneficiaryProfile?->father_status
                                                        ?? 'Not available'
                                                    }}

                                                </strong>

                                            </div>



                                            <div class="beneficiary-info-row">

                                                <span>
                                                    Guardian Profession
                                                </span>

                                                <strong>

                                                    {{
                                                        $beneficiaryProfile?->guardian_profession
                                                        ?? 'Not available'
                                                    }}

                                                </strong>

                                            </div>



                                            <div class="beneficiary-info-row border-bottom-0">

                                                <span>
                                                    Monthly Household Income
                                                </span>

                                                <strong>

                                                    @if (
                                                        !is_null(
                                                            $beneficiaryProfile?->monthly_income
                                                        )
                                                    )

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



                                {{-- =========================================
                                    LOCATION
                                ========================================== --}}
                                <div class="col-12 col-lg-6">

                                    <div class="card border-0 shadow-sm rounded-4 h-100">

                                        <div class="card-header bg-white border-bottom px-4 py-3">

                                            <div class="d-flex align-items-center gap-3">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning-subtle text-warning-emphasis flex-shrink-0"
                                                    style="width:42px;height:42px;"
                                                >

                                                    <i class="bi bi-geo-alt"></i>

                                                </span>


                                                <div>

                                                    <h6 class="fw-bold text-dark mb-1">

                                                        Location Information

                                                    </h6>


                                                    <p class="text-secondary small mb-0">

                                                        Province, domicile and address.

                                                    </p>

                                                </div>

                                            </div>

                                        </div>


                                        <div class="card-body p-0">


                                            <div class="beneficiary-info-row">

                                                <span>
                                                    Province / Territory
                                                </span>

                                                <strong>

                                                    {{
                                                        $beneficiaryProfile?->province
                                                        ?? 'Not available'
                                                    }}

                                                </strong>

                                            </div>



                                            <div class="beneficiary-info-row">

                                                <span>
                                                    Domicile
                                                </span>

                                                <strong>

                                                    {{
                                                        $beneficiaryProfile?->domicile
                                                        ?? 'Not available'
                                                    }}

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



                                {{-- =========================================
                                    REQUEST DETAILS
                                ========================================== --}}
                                <div class="col-12">

                                    <div class="card border-0 shadow-sm rounded-4">

                                        <div class="card-header bg-white border-bottom px-4 py-3">

                                            <div class="d-flex align-items-center gap-3">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-secondary-subtle text-secondary flex-shrink-0"
                                                    style="width:42px;height:42px;"
                                                >

                                                    <i class="bi bi-box-seam"></i>

                                                </span>


                                                <div>

                                                    <h6 class="fw-bold text-dark mb-1">

                                                        Request Information

                                                    </h6>


                                                    <p class="text-secondary small mb-0">

                                                        Information related to this product request.

                                                    </p>

                                                </div>

                                            </div>

                                        </div>


                                        <div class="card-body">

                                            <div class="row g-4">


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

                                                        Product Requested

                                                    </small>


                                                    <strong>

                                                        {{
                                                            $productRequest->product?->name
                                                            ?? 'Not available'
                                                        }}

                                                    </strong>

                                                </div>



                                                <div class="col-12 col-md-3">

                                                    <small class="d-block text-secondary mb-1">

                                                        Admin Approval

                                                    </small>


                                                    <strong class="text-capitalize">

                                                        {{
                                                            $productRequest->admin_status
                                                            ?? 'Not available'
                                                        }}

                                                    </strong>

                                                </div>



                                                <div class="col-12 col-md-3">

                                                    <small class="d-block text-secondary mb-1">

                                                        Your Decision

                                                    </small>


                                                    <strong>

                                                        {{
                                                            $productRequest->donor_status === 'approved'
                                                                ? 'Accepted'
                                                                : (
                                                                    $productRequest->donor_status === 'rejected'
                                                                        ? 'Rejected'
                                                                        : 'Pending'
                                                                )
                                                        }}

                                                    </strong>

                                                </div>



                                                <div class="col-12 col-md-6">

                                                    <small class="d-block text-secondary mb-1">

                                                        Requested On

                                                    </small>


                                                    <strong>

                                                        {{
                                                            optional(
                                                                $productRequest->created_at
                                                            )->format(
                                                                'd M Y, h:i A'
                                                            )
                                                            ?? 'Not available'
                                                        }}

                                                    </strong>

                                                </div>



                                                <div class="col-12 col-md-6">

                                                    <small class="d-block text-secondary mb-1">

                                                        Product Owner / Donor

                                                    </small>


                                                    <strong>

                                                        {{
                                                            $productRequest->donor?->name
                                                            ?? 'Not available'
                                                        }}

                                                    </strong>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                                {{-- =========================================
                                    REQUEST / DONOR MESSAGE
                                ========================================== --}}
                                @if ($productRequest->message)

                                    <div class="col-12">

                                        <div class="card border-0 shadow-sm rounded-4">

                                            <div class="card-header bg-white border-bottom px-4 py-3">

                                                <div class="d-flex align-items-center gap-3">

                                                    <span
                                                        class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary"
                                                        style="width:42px;height:42px;"
                                                    >

                                                        <i class="bi bi-chat-left-text"></i>

                                                    </span>


                                                    <div>

                                                        <h6 class="fw-bold text-dark mb-1">

                                                            Request Message

                                                        </h6>


                                                        <p class="text-secondary small mb-0">

                                                            Message currently attached to this request.

                                                        </p>

                                                    </div>

                                                </div>

                                            </div>


                                            <div class="card-body">

                                                <div class="p-3 rounded-3 bg-light border">

                                                    <p class="mb-0 text-dark">

                                                        {{ $productRequest->message }}

                                                    </p>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                @endif


                            </div>

                        </div>



                        {{-- =================================================
                            FOOTER
                        ================================================== --}}
                        <div class="modal-footer bg-white border-top px-4 py-3">

                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 w-100">


                                <small class="text-secondary">

                                    <i class="bi bi-shield-check me-1"></i>

                                    Review the beneficiary details before making a decision.

                                </small>


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

            </div>

        @endif



        {{-- ========================================================
            MESSAGE MODAL
        ========================================================= --}}
        <div
            class="modal fade"
            id="messageModal{{ $productRequest->id }}"
            tabindex="-1"
            aria-labelledby="messageModalLabel{{ $productRequest->id }}"
            aria-hidden="true"
        >

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content border-0 shadow rounded-4 overflow-hidden">


                    <form
                        method="POST"
                        action="{{ route('donor.request.update', $productRequest->id) }}"
                    >

                        @csrf


                        {{-- Header --}}
                        <div class="modal-header border-bottom px-4 py-3">

                            <div>

                                <h5
                                    class="modal-title fw-bold"
                                    id="messageModalLabel{{ $productRequest->id }}"
                                >

                                    Message for Beneficiary

                                </h5>


                                <p class="text-secondary small mb-0 mt-1">

                                    @if ($beneficiary)

                                        Send or update a message for
                                        {{ $beneficiary->name }}.

                                    @else

                                        Add a message to this request.

                                    @endif

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
                        <div class="modal-body p-4">

                            <label
                                for="message{{ $productRequest->id }}"
                                class="form-label fw-semibold"
                            >

                                Message

                            </label>


                            <textarea
                                name="message"
                                id="message{{ $productRequest->id }}"
                                rows="6"
                                class="form-control"
                                placeholder="Write your message for the beneficiary..."
                            >{{ old('message', $productRequest->message) }}</textarea>


                            <div class="form-text">

                                You can include collection instructions,
                                availability details, or other important information.

                            </div>

                        </div>



                        {{-- Footer --}}
                        <div class="modal-footer border-top px-4 py-3">

                            <button
                                type="button"
                                class="btn btn-light border"
                                data-bs-dismiss="modal"
                            >

                                Cancel

                            </button>


                            <button
                                type="submit"
                                class="btn btn-primary"
                            >

                                <i class="bi bi-send me-1"></i>

                                Save Message

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    @endforeach



    {{-- =========================================================
        PAGE STYLES
    ========================================================== --}}
    <style>

        /*
        |--------------------------------------------------------------------------
        | Large Beneficiary Modal
        |--------------------------------------------------------------------------
        */

        .modal-xl {
            --bs-modal-width: 1140px;
        }


        .modal-dialog-scrollable .modal-content {
            max-height: calc(100vh - 40px);
        }


        /*
        |--------------------------------------------------------------------------
        | Beneficiary Information Row
        |--------------------------------------------------------------------------
        */

        .beneficiary-info-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 24px;

            padding: 14px 18px;

            border-bottom: 1px solid #e9ecef;
        }


        .beneficiary-info-row > span {
            flex: 0 0 42%;

            color: #6c757d;

            font-size: 0.875rem;
        }


        .beneficiary-info-row > strong {
            flex: 1;

            color: #212529;

            font-size: 0.875rem;

            font-weight: 600;

            text-align: right;

            overflow-wrap: anywhere;
        }


        /*
        |--------------------------------------------------------------------------
        | Profile Image
        |--------------------------------------------------------------------------
        */

        .object-fit-cover {
            object-fit: cover;
        }


        /*
        |--------------------------------------------------------------------------
        | Modal Cards
        |--------------------------------------------------------------------------
        */

        #beneficiaryModal{{ $productRequest->id ?? '' }} .card {
            background: #ffffff;
        }


        /*
        |--------------------------------------------------------------------------
        | Responsive
        |--------------------------------------------------------------------------
        */

        @media (max-width: 767.98px) {

            .beneficiary-info-row {
                flex-direction: column;

                gap: 5px;
            }


            .beneficiary-info-row > span,
            .beneficiary-info-row > strong {
                flex: 0 0 auto;

                width: 100%;
            }


            .beneficiary-info-row > strong {
                text-align: left;
            }


            .modal-body {
                padding: 16px !important;
            }


            .modal-xl {
                margin: 10px;
            }

        }

    </style>



    @include('layouts.admin.script')

</body>