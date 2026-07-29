{{-- ===================================================== --}}
{{-- DONOR SIDEBAR --}}
{{-- ===================================================== --}}

@php
    $donorUser = Auth::user();
    $donorProfile = $donorUser->donorProfile;

    /*
    |--------------------------------------------------------------------------
    | Calculate Donor Profile Completion
    |--------------------------------------------------------------------------
    */

    $donorProfileFields = [
        $donorUser->name,
        $donorUser->email,
        $donorUser->phone,
        $donorUser->image,
        $donorProfile?->organization,
        $donorProfile?->designation,
        $donorProfile?->country,
        $donorProfile?->address,
    ];

    $totalProfileFields = count($donorProfileFields);

    $completedProfileFields = collect($donorProfileFields)
        ->filter(function ($field) {
            return !is_null($field) && trim((string) $field) !== '';
        })
        ->count();

    $profileCompletion = $totalProfileFields > 0
        ? (int) round(
            ($completedProfileFields / $totalProfileFields) * 100
        )
        : 0;

    /*
    |--------------------------------------------------------------------------
    | Lock Product and Request Features Below 85%
    |--------------------------------------------------------------------------
    */

    $profileLocked = $profileCompletion < 85;

    /*
    |--------------------------------------------------------------------------
    | Active Route Conditions
    |--------------------------------------------------------------------------
    */

    $productMenuActive = request()->routeIs(
        'donor.product.index',
        'donor.product.create',
        'donor.product.edit',
        'donor.product.show'
    );

    $requestMenuActive = request()->routeIs(
        'donor.requests',
        'donor.requests.*'
    );

    $profileMenuActive = request()->routeIs(
        'donor.profile.index',
        'donor.profile.*'
    );
@endphp


{{-- ===================================================== --}}
{{-- PROFILE COMPLETION STATUS --}}
{{-- ===================================================== --}}

<div class="px-3 py-3 mb-2">

    <div class="d-flex align-items-center justify-content-between gap-2 mb-2">

        <span class="nsn-label small">
            Profile Completion
        </span>

        <span
            class="badge rounded-pill {{ $profileLocked ? 'bg-warning-subtle text-warning-emphasis' : 'bg-success-subtle text-success' }}"
        >
            {{ $profileCompletion }}%
        </span>

    </div>

    <div
        class="progress"
        role="progressbar"
        aria-label="Donor profile completion"
        aria-valuenow="{{ $profileCompletion }}"
        aria-valuemin="0"
        aria-valuemax="100"
        style="height: 6px;"
    >
        <div
            class="progress-bar {{ $profileLocked ? 'bg-warning' : 'bg-success' }}"
            style="width: {{ $profileCompletion }}%;"
        ></div>
    </div>

    @if ($profileLocked)
        <small class="d-block text-danger mt-2 nsn-label">
            <i class="bi bi-lock me-1"></i>
            Complete 85% to unlock features
        </small>
    @else
        <small class="d-block text-success mt-2 nsn-label">
            <i class="bi bi-check-circle me-1"></i>
            All features unlocked
        </small>
    @endif

</div>


{{-- ===================================================== --}}
{{-- PRODUCT MENU --}}
{{-- ===================================================== --}}

@if ($profileLocked)

    {{-- Locked Product Link --}}
    <div
        class="nsn-nav-link nsn-nav-link-disabled opacity-50"
        role="button"
        aria-disabled="true"
        title="Complete your profile to at least 85% to unlock products"
    >
        <i class="mdi mdi-cube-outline"></i>

        <div class="nsn-label flex-grow-1">

            <div class="d-flex align-items-center justify-content-between gap-2">
                <span>Product</span>
                <i class="bi bi-lock-fill small"></i>
            </div>

            <small class="d-block text-danger mt-1">
                Complete profile to 85%
            </small>

        </div>
    </div>

@else

    {{-- Unlocked Product Dropdown --}}
    <a
        href="#donor-product"
        class="nsn-nav-link {{ $productMenuActive ? 'active' : '' }}"
        data-bs-toggle="collapse"
        role="button"
        aria-expanded="{{ $productMenuActive ? 'true' : 'false' }}"
        aria-controls="donor-product"
    >
        <i class="mdi mdi-cube-outline"></i>

        <span class="nsn-label">
            Product
        </span>

        <i class="bi bi-chevron-down ms-auto nsn-label small"></i>
    </a>


    <div
        id="donor-product"
        class="collapse {{ $productMenuActive ? 'show' : '' }}"
        data-bs-parent="#sidebar"
    >
        <div class="ps-3">

            {{-- My Products --}}
            <a
                href="{{ route('donor.product.index') }}"
                class="nsn-nav-link {{
                    request()->routeIs(
                        'donor.product.index',
                        'donor.product.edit',
                        'donor.product.show'
                    ) ? 'active' : ''
                }}"
            >
                <i class="bi bi-box-seam"></i>

                <span class="nsn-label">
                    My Products
                </span>
            </a>


            {{-- Add Product --}}
            <a
                href="{{ route('donor.product.create') }}"
                class="nsn-nav-link {{
                    request()->routeIs('donor.product.create')
                        ? 'active'
                        : ''
                }}"
            >
                <i class="bi bi-plus-square"></i>

                <span class="nsn-label">
                    Add Product
                </span>
            </a>

        </div>
    </div>

@endif


{{-- ===================================================== --}}
{{-- REQUESTS MENU --}}
{{-- ===================================================== --}}

@if ($profileLocked)

    {{-- Locked Requests Link --}}
    <div
        class="nsn-nav-link nsn-nav-link-disabled opacity-50"
        role="button"
        aria-disabled="true"
        title="Complete your profile to at least 85% to access requests"
    >
        <i class="mdi mdi-clipboard-text"></i>

        <div class="nsn-label flex-grow-1">

            <div class="d-flex align-items-center justify-content-between gap-2">
                <span>Requests</span>
                <i class="bi bi-lock-fill small"></i>
            </div>

            <small class="d-block text-danger mt-1">
                Complete profile to 85%
            </small>

        </div>
    </div>

@else

    {{-- Unlocked Requests Link --}}
    <a
        href="{{ route('donor.requests') }}"
        class="nsn-nav-link {{ $requestMenuActive ? 'active' : '' }}"
    >
        <i class="mdi mdi-clipboard-text"></i>

        <span class="nsn-label">
            Requests
        </span>
    </a>

@endif


{{-- ===================================================== --}}
{{-- DONOR PROFILE --}}
{{-- Always available so the donor can complete the profile --}}
{{-- ===================================================== --}}

<a
    href="{{ route('donor.profile.index') }}"
    class="nsn-nav-link {{ $profileMenuActive ? 'active' : '' }}"
>
    <i class="mdi mdi-account-circle"></i>

    <span class="nsn-label">
        Profile
    </span>

    @if ($profileLocked)
        <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis ms-auto nsn-label">
            {{ $profileCompletion }}%
        </span>
    @else
        <i class="bi bi-check-circle-fill text-success ms-auto nsn-label"></i>
    @endif
</a>
