@php
    $authUser = Auth::user();

    // Generate initials from the authenticated user's name.
    $nameParts = preg_split('/\s+/', trim($authUser->name));

    $userInitials = collect($nameParts)
        ->filter()
        ->take(2)
        ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
        ->implode('');

    // Determine the profile route according to the user's role.
    $profileRoute = route('dashboard');

    if ($authUser->role === 'donor' && Route::has('donor.profile.index')) {
        $profileRoute = route('donor.profile.index');
    } elseif (
        $authUser->role === 'beneficiary' &&
        Route::has('Beneficiary.profile.index')
    ) {
        $profileRoute = route('Beneficiary.profile.index');
    }
@endphp


<!-- ============ TOPBAR ============ -->
<header class="nsn-topbar">

    <!-- Sidebar Toggle -->
    <button
        type="button"
        class="nsn-toggle-btn"
        id="sidebarToggle"
        aria-label="Toggle sidebar"
    >
        <i class="bi bi-list" style="font-size: 1.3rem;"></i>
    </button>


    <!-- Search -->
    <div class="input-group nsn-search d-none d-md-flex">
        <span class="input-group-text bg-white border-end-0">
            <i class="bi bi-search text-secondary-emphasis"></i>
        </span>

        <input
            type="search"
            class="form-control border-start-0"
            placeholder="Search products, requests, users..."
            aria-label="Search"
        >
    </div>


    <!-- Right Side -->
    <div class="ms-auto d-flex align-items-center gap-2">

        <!-- Notification Dropdown -->
        <div class="dropdown">

            <button
                type="button"
                class="nsn-icon-btn position-relative"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                aria-label="Notifications"
            >
                <i class="bi bi-bell"></i>

                {{-- Remove this span when there are no notifications --}}
                <span class="ping"></span>
            </button>

            <div
                class="dropdown-menu dropdown-menu-end p-2"
                style="width: 300px;"
            >
                <div class="d-flex align-items-center justify-content-between px-2 py-1">
                    <span class="fw-semibold small">Notifications</span>

                    <span class="badge rounded-pill text-bg-primary">
                        3
                    </span>
                </div>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item rounded-2 py-2 small" href="#">
                    <i class="bi bi-shield-exclamation text-warning me-2"></i>
                    New sign-in detected
                </a>

                <a class="dropdown-item rounded-2 py-2 small" href="#">
                    <i class="bi bi-box-seam text-primary me-2"></i>
                    Product information updated
                </a>

                <a class="dropdown-item rounded-2 py-2 small" href="#">
                    <i class="bi bi-clipboard-check text-success me-2"></i>
                    Request status updated
                </a>
            </div>

        </div>


        <!-- User Dropdown -->
        <div class="dropdown">

            <button
                type="button"
                class="d-flex align-items-center gap-2 btn p-1 border-0"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                <!-- User Image or Initials -->
                @if ($authUser->image)
                    <img
                        src="{{ asset('admin/asset/profilephoto/' . $authUser->image) }}"
                        alt="{{ $authUser->name }}"
                        class="rounded-circle object-fit-cover"
                        style="
                            width: 40px;
                            height: 40px;
                            border: 2px solid #e9ecef;
                        "
                    >
                @else
                    <div class="nsn-avatar">
                        {{ $userInitials ?: 'U' }}
                    </div>
                @endif

                <!-- Name and Role -->
                <div class="d-none d-lg-block text-start">
                    <div
                        class="fw-semibold text-dark"
                        style="font-size: 0.82rem; line-height: 1.2;"
                    >
                        {{ $authUser->name }}
                    </div>

                    <small
                        class="text-secondary text-capitalize"
                        style="font-size: 0.7rem;"
                    >
                        {{ $authUser->role }}
                    </small>
                </div>

                <i class="bi bi-chevron-down d-none d-sm-inline-block small"></i>
            </button>


            <!-- User Dropdown Menu -->
            <ul class="dropdown-menu dropdown-menu-end shadow-sm">

                <!-- User Information -->
                <li>
                    <div class="dropdown-header">
                        <div class="fw-semibold text-dark">
                            {{ $authUser->name }}
                        </div>

                        <small class="text-secondary text-capitalize">
                            {{ $authUser->role }} Account
                        </small>
                    </div>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <!-- Profile -->
                @if ($authUser->role !== 'admin')
                    <li>
                        <a
                            class="dropdown-item {{ request()->url() === $profileRoute ? 'active' : '' }}"
                            href="{{ $profileRoute }}"
                        >
                            <i class="bi bi-person me-2"></i>
                            My Profile
                        </a>
                    </li>
                @endif

                <!-- Dashboard -->
                <li>
                    <a
                        class="dropdown-item"
                        href="{{ route('dashboard') }}"
                    >
                        <i class="bi bi-grid-1x2 me-2"></i>
                        Dashboard
                    </a>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <!-- Logout -->
                <li>
                    <a
                        href="{{ route('logout') }}"
                        class="dropdown-item text-danger"
                        onclick="
                            event.preventDefault();
                            document.getElementById('topbar-logout-form').submit();
                        "
                    >
                        <i class="bi bi-box-arrow-right me-2"></i>
                        Sign Out
                    </a>
                </li>

            </ul>
        </div>

    </div>


    <!-- Logout Form -->
    <form
        id="topbar-logout-form"
        action="{{ route('logout') }}"
        method="POST"
        class="d-none"
    >
        @csrf
    </form>

</header>
