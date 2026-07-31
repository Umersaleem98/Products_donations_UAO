<!-- ============ NEW SIDEBAR ============ -->
<aside class="nsn-sidebar" id="sidebar">

    <!-- Brand / User Profile -->
    <div class="nsn-brand">
        <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-decoration-none w-100">

            <div class="nsn-brand-mark me-0 me-2">
                @if (Auth::user()->image)
                    <img
                        src="{{ asset('admin/asset/profilephoto/' . Auth::user()->image) }}"
                        alt="{{ Auth::user()->name }}"
                        class="w-100 h-100 rounded-circle object-fit-cover"
                    >
                @else
                    <img
                        src="{{ asset('admins/asset/dummy/dummy.jpg') }}"
                        alt="{{ Auth::user()->name }}"
                        class="w-100 h-100 rounded-circle object-fit-cover"
                    >
                @endif
            </div>

            <div class="nsn-brand-text nsn-label">
                <div class="fw-semibold font-display" style="font-size: .95rem;">
                    {{ Auth::user()->name }}
                </div>

                <small class="text-capitalize">
                    {{ Auth::user()->role }} Portal
                </small>
            </div>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="nsn-nav">

        <!-- Overview -->
        <div class="nsn-nav-section">
            <div class="nsn-sec-title">Overview</div>

            <a
                href="{{ route('dashboard') }}"
                class="nsn-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
            >
                <i class="bi bi-grid-1x2-fill"></i>
                <span class="nsn-label">Dashboard</span>
            </a>
        </div>

        <!-- Admin Sidebar -->
        @if (Auth::user()->role === 'admin')
            <div class="nsn-nav-section">
                <div class="nsn-sec-title">Administration</div>

                @include('layouts.admin.components.adminSidebar')
            </div>
        @endif

        <!-- Donor Sidebar -->
        @if (Auth::user()->role === 'donor')
            <div class="nsn-nav-section">
                <div class="nsn-sec-title">Donor Management</div>

                @include('layouts.admin.components.donorSidebar')
            </div>
        @endif

        <!-- Beneficiary Sidebar -->
        @if (Auth::user()->role === 'beneficiary')
            <div class="nsn-nav-section">
                <div class="nsn-sec-title">Beneficiary Portal</div>

                @include('layouts.admin.components.beneficiarySidebar')
            </div>
        @endif

        <!-- Account -->
        <div class="nsn-nav-section">
            <div class="nsn-sec-title">Account</div>

            {{-- Replace profile route name if your project uses another name --}}
            @if (Route::has('profile.edit'))
                <a
                    href="{{ route('profile.edit') }}"
                    class="nsn-nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}"
                >
                    <i class="bi bi-person-circle"></i>
                    <span class="nsn-label">My Profile</span>
                </a>
            @endif

            {{-- Replace settings route name if needed --}}
            @if (Route::has('settings'))
                <a
                    href="{{ route('settings') }}"
                    class="nsn-nav-link {{ request()->routeIs('settings*') ? 'active' : '' }}"
                >
                    <i class="bi bi-gear"></i>
                    <span class="nsn-label">Settings</span>
                </a>
            @endif

            <a
                href="{{ route('logout') }}"
                class="nsn-nav-link"
                onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();"
            >
                <i class="bi bi-box-arrow-right"></i>
                <span class="nsn-label">Logout</span>
            </a>

            <form
                id="sidebar-logout-form"
                action="{{ route('logout') }}"
                method="POST"
                class="d-none"
            >
                @csrf
            </form>
        </div>

    </nav>

    <!-- Sidebar Footer -->
    <div class="nsn-sidebar-foot">
        <div class="nsn-mini-status">
            <span class="nsn-dot-live"></span>

            <span class="nsn-label">
                Secure connection
            </span>
        </div>
    </div>

</aside>
