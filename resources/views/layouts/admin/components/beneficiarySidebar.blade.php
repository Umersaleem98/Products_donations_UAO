{{-- ===================================================== --}}
{{-- BENEFICIARY SIDEBAR --}}
{{-- ===================================================== --}}

@php
    $beneficiaryUser = Auth::user();
    $beneficiaryProfile = $beneficiaryUser->beneficiaryProfile;

    /*
    |--------------------------------------------------------------------------
    | Calculate Beneficiary Profile Completion
    |--------------------------------------------------------------------------
    */

    $beneficiaryProfileFields = [
        $beneficiaryUser->name,
        $beneficiaryUser->email,
        $beneficiaryUser->image,
        $beneficiaryProfile?->institution,
        $beneficiaryProfile?->father_status,
        $beneficiaryProfile?->province,
        $beneficiaryProfile?->home_address,
    ];

    $totalProfileFields = count($beneficiaryProfileFields);

    $completedProfileFields = collect($beneficiaryProfileFields)
        ->filter(function ($field) {
            return !is_null($field) &&
                trim((string) $field) !== '';
        })
        ->count();

    $profileCompletion = $totalProfileFields > 0
        ? (int) round(
            ($completedProfileFields / $totalProfileFields) * 100
        )
        : 0;

    /*
    |--------------------------------------------------------------------------
    | Lock Features Below 85%
    |--------------------------------------------------------------------------
    */

    $profileLocked = $profileCompletion < 85;

    /*
    |--------------------------------------------------------------------------
    | Active Menu Conditions
    |--------------------------------------------------------------------------
    */

    $productsMenuActive = request()->routeIs(
        'beneficiary.products.index',
        'beneficiary.products.show',
        'beneficiary.products.*'
    );

    $requestsMenuActive = request()->routeIs(
        'beneficiary.my.requests',
        'beneficiary.my.requests.*'
    );

    $profileMenuActive = request()->routeIs(
        'Beneficiary.profile.index',
        'Beneficiary.profile.*'
    );
@endphp


{{-- ===================================================== --}}
{{-- PROFILE COMPLETION --}}
{{-- ===================================================== --}}

<div class="px-3 py-3 mb-2">

    <div class="d-flex align-items-center justify-content-between gap-2 mb-2">

        <span class="nsn-label small">
            Profile Completion
        </span>

        <span
            class="badge rounded-pill {{
                $profileLocked
                    ? 'bg-warning-subtle text-warning-emphasis'
                    : 'bg-success-subtle text-success'
            }}"
        >
            {{ $profileCompletion }}%
        </span>

    </div>


    <div
        class="progress"
        role="progressbar"
        aria-label="Beneficiary profile completion"
        aria-valuenow="{{ $profileCompletion }}"
        aria-valuemin="0"
        aria-valuemax="100"
        style="height: 6px;"
    >
        <div
            class="progress-bar {{
                $profileLocked
                    ? 'bg-warning'
                    : 'bg-success'
            }}"
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
{{-- ALL PRODUCTS --}}
{{-- ===================================================== --}}

@if ($profileLocked)

    {{-- Locked Products Menu --}}
    <div
        class="nsn-nav-link nsn-nav-link-disabled opacity-50"
        role="button"
        aria-disabled="true"
        title="Complete your profile to at least 85% to access products"
    >
        <i class="mdi mdi-cube-outline"></i>

        <div class="nsn-label flex-grow-1">

            <div class="d-flex align-items-center justify-content-between gap-2">
                <span>All Products</span>
                <i class="bi bi-lock-fill small"></i>
            </div>

            <small class="d-block text-danger mt-1">
                Complete profile to 85%
            </small>

        </div>
    </div>

@else

    {{-- Unlocked Products Menu --}}
    <a
        href="{{ route('beneficiary.products.index') }}"
        class="nsn-nav-link {{
            $productsMenuActive ? 'active' : ''
        }}"
    >
        <i class="mdi mdi-cube-outline"></i>

        <span class="nsn-label">
            All Products
        </span>

        <i class="bi bi-chevron-right ms-auto nsn-label small"></i>
    </a>

@endif


{{-- ===================================================== --}}
{{-- MY REQUESTS --}}
{{-- ===================================================== --}}

@if ($profileLocked)

    {{-- Locked Requests Menu --}}
    <div
        class="nsn-nav-link nsn-nav-link-disabled opacity-50"
        role="button"
        aria-disabled="true"
        title="Complete your profile to at least 85% to access requests"
    >
        <i class="mdi mdi-clipboard-text"></i>

        <div class="nsn-label flex-grow-1">

            <div class="d-flex align-items-center justify-content-between gap-2">
                <span>My Requests</span>
                <i class="bi bi-lock-fill small"></i>
            </div>

            <small class="d-block text-danger mt-1">
                Complete profile to 85%
            </small>

        </div>
    </div>

@else

    {{-- Unlocked Requests Menu --}}
    <a
        href="{{ route('beneficiary.my.requests') }}"
        class="nsn-nav-link {{
            $requestsMenuActive ? 'active' : ''
        }}"
    >
        <i class="mdi mdi-clipboard-text"></i>

        <span class="nsn-label">
            My Requests
        </span>

        <i class="bi bi-chevron-right ms-auto nsn-label small"></i>
    </a>

@endif


{{-- ===================================================== --}}
{{-- BENEFICIARY PROFILE --}}
{{-- Always accessible so the user can complete the profile --}}
{{-- ===================================================== --}}

<a
    href="{{ route('Beneficiary.profile.index') }}"
    class="nsn-nav-link {{
        $profileMenuActive ? 'active' : ''
    }}"
>
    <i class="mdi mdi-account-circle"></i>

    <span class="nsn-label">
        My Profile
    </span>

    @if ($profileLocked)

        <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis ms-auto nsn-label">
            {{ $profileCompletion }}%
        </span>

    @else

        <i class="bi bi-check-circle-fill text-success ms-auto nsn-label"></i>

    @endif
</a>
