@include('layouts.admin.head')

<title>Incoming Requests</title>

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
                        Incoming Requests
                    </li>

                </ol>

            </nav>


            {{-- Alert Messages --}}
            @include('layouts.admin.alert')


            {{-- Requests Card --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                {{-- Card Header --}}
                <div class="card-header bg-white border-bottom px-4 py-3">

                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

                        <div>
                            <h5 class="fw-semibold text-dark mb-1">
                                Beneficiary Requests
                            </h5>

                            <p class="text-secondary small mb-0">
                                Review the beneficiary’s profile before making a decision.
                            </p>
                        </div>

                        <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis px-3 py-2">
                            <i class="bi bi-hourglass-split me-1"></i>

                            {{ $requests->where('donor_status', 'pending')->count() }}
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
                                        $product = $productRequest->product;
                                        $beneficiary = $productRequest->beneficiary;

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
                                            $productRequest->donor_status === 'approved';

                                        $isRejected =
                                            $productRequest->donor_status === 'rejected';

                                        $statusBadge = match ($productRequest->donor_status) {
                                            'approved' => 'bg-success-subtle text-success',
                                            'rejected' => 'bg-danger-subtle text-danger',
                                            default => 'bg-warning-subtle text-warning-emphasis',
                                        };

                                        $statusLabel = match ($productRequest->donor_status) {
                                            'approved' => 'Accepted',
                                            'rejected' => 'Rejected',
                                            default => 'Pending',
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


                                        {{-- Beneficiary --}}
                                        <td>

                                            @if ($beneficiary)

                                                <div class="d-flex align-items-center gap-3">

                                                    @if ($beneficiary->image)

                                                        <img
                                                            src="{{ asset('admins/asset/profilephoto/' . $beneficiary->image) }}"
                                                            alt="{{ $beneficiary->name }}"
                                                            width="40"
                                                            height="40"
                                                            class="rounded-circle border object-fit-cover flex-shrink-0"
                                                        >

                                                    @else

                                                        <span
                                                            class="d-inline-flex align-items-center justify-content-center rounded-circle bg-info-subtle text-info-emphasis fw-semibold flex-shrink-0"
                                                            style="width: 40px; height: 40px;"
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
                                                            View profile
                                                        </button>
                                                    </div>

                                                </div>

                                            @else

                                                <span class="text-secondary small">
                                                    Beneficiary unavailable
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Status --}}
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


                                        {{-- Actions --}}
                                        <td class="px-4 text-end">

                                            <div class="d-inline-flex flex-wrap justify-content-end gap-2">

                                                {{-- Accept --}}
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

                                                        {{ $isApproved ? 'Accepted' : 'Accept' }}
                                                    </button>
                                                </form>


                                                {{-- Reject --}}
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

                                                        {{ $isRejected ? 'Rejected' : 'Reject' }}
                                                    </button>
                                                </form>


                                                {{-- Message --}}
                                                <button
                                                    type="button"
                                                    class="btn btn-outline-primary btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#messageModal{{ $productRequest->id }}"
                                                >
                                                    <i class="bi bi-chat-dots me-1"></i>

                                                    {{ $productRequest->message ? 'Edit Message' : 'Message' }}
                                                </button>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="6" class="text-center py-5">

                                            <div class="d-flex flex-column align-items-center">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light text-secondary mb-3"
                                                    style="width: 64px; height: 64px;"
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
    {{-- BENEFICIARY AND MESSAGE MODALS --}}
    {{-- ===================================================== --}}

    @foreach ($requests as $productRequest)

        @php
            $beneficiary = $productRequest->beneficiary;
            $beneficiaryProfile = $beneficiary?->beneficiaryProfile;

            $beneficiaryImage = $beneficiary && $beneficiary->image
                ? asset(
                    'admins/asset/profilephoto/' .
                    $beneficiary->image
                )
                : asset('admins/asset/dummy/dummy.jpg');
        @endphp


        {{-- Beneficiary Profile Modal --}}
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

                        {{-- Header --}}
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


                        {{-- Body --}}
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


                            {{-- Basic Information --}}
                            <h6 class="fw-bold text-dark mb-3">
                                <i class="bi bi-person-vcard text-primary me-2"></i>
                                Basic Information
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


                            {{-- Beneficiary Request Message --}}
                            @if ($productRequest->message)

                                <h6 class="fw-bold text-dark mt-4 mb-3">
                                    <i class="bi bi-chat-left-text text-primary me-2"></i>
                                    Request Message
                                </h6>

                                <div class="alert alert-light border mb-0">
                                    <p class="small mb-0">
                                        {{ $productRequest->message }}
                                    </p>
                                </div>

                            @endif

                        </div>


                        {{-- Footer --}}
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


        {{-- Message Modal --}}
        <div
            class="modal fade"
            id="messageModal{{ $productRequest->id }}"
            tabindex="-1"
            aria-labelledby="messageModalLabel{{ $productRequest->id }}"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content border-0 shadow rounded-4">

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
                                        Send a message to {{ $beneficiary->name }}.
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
                                rows="5"
                                class="form-control"
                                placeholder="Write your message for the beneficiary..."
                            >{{ old('message', $productRequest->message) }}</textarea>

                            <div class="form-text">
                                Include any collection instructions or other important information.
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


    @include('layouts.admin.script')

</body>
