<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row"
    style="background-color: #0880E0;">

    <div class="navbar-brand-wrapper d-flex align-items-center justify-content-center">

        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start " ">

            <a class="navbar-brand brand-logo text-center" href="{{ route('dashboard') }}">
                <img src="{{ asset('admins/assets/images/logos/logo1.png') }}" style="width: 150px; height: auto;" alt="NUST Sharing Network" class="navbar-brand-img">
            </a>

            <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}">
                <img src="{{ asset('admins/assets/images/logos/logo1.png') }}" style="width: 120px; height: auto;" alt="NUST Gift Store" class="navbar-brand-img">
            </a>

        </div>

</div>
    <!-- RIGHT SIDE -->
    <div class="navbar-menu-wrapper d-flex align-items-stretch">

        <!-- TOGGLE -->
        <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu text-light"></span>
        </button>

        <!-- SEARCH -->
        <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100">
                <div class="input-group">
                    <div class="input-group-prepend text-light">
                        <i class="input-group-text border-0 mdi mdi-magnify text-light"></i>
                    </div>
                    <input type="text" class="form-control bg-transparent border-0 text-light" placeholder="Search">
                </div>
            </form>
        </div>

        <ul class="navbar-nav navbar-nav-right">

            <!-- FULL SCREEN -->
            <li class="nav-item d-none d-lg-block">
                <a class="nav-link">
                    <i class="mdi mdi-fullscreen text-light" id="fullscreen-button"></i>
                </a>
            </li>

            <!-- ===================== -->
            <!-- 🔔 NOTIFICATIONS (ADMIN ONLY) -->
            <!-- ===================== -->

                @if (auth()->check() && auth()->user()->role === 'admin')

            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" href="#" data-bs-toggle="dropdown">

                    <i class="mdi mdi-bell-outline text-light"></i>

                    @if (auth()->user()->unreadNotifications->count() > 0)
                        <span class="count-symbol bg-danger"></span>
                    @endif
                </a>

                <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list">

                    <h6 class="p-3 mb-0">
                        Notifications ({{ auth()->user()->unreadNotifications->count() }})
                    </h6>

                    <div class="dropdown-divider"></div>

                    @forelse(auth()->user()->unreadNotifications as $notification)
                        <a href="{{ route('notification.read', $notification->id) }}"
                            class="dropdown-item preview-item">

                            <div class="preview-thumbnail">
                                <div class="preview-icon">
                                    <i class="mdi mdi-package-variant text-light"></i>
                                </div>
                            </div>

                            <div class="preview-item-content d-flex flex-column">

                                <h6 class="preview-subject mb-1">
                                    {{ $notification->data['title'] ?? 'Notification' }}
                                </h6>

                                <p class="text-gray mb-0">
                                    <strong>{{ $notification->data['user_name'] ?? '' }}</strong>
                                    {{ $notification->data['message'] ?? '' }}
                                </p>

                            </div>

                        </a>

                        <div class="dropdown-divider"></div>

                    @empty

                        <p class="p-3 text-center">No notifications</p>
                    @endforelse

                </div>
            </li>

            @endif

            <!-- ===================== -->
            <!-- PROFILE -->
            <!-- ===================== -->

            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">

                    <div class="nav-profile-img">

                        @if (auth()->user()->image)
                            <img src="{{ asset('admin/asset/profilephoto/' . auth()->user()->image) }}">
                        @else
                            <img src="{{ asset('admin/asset/dummy/dummy.jpg') }}">
                        @endif

                        <span class="availability-status online"></span>
                    </div>

                    <div class="nav-profile-text">
                        <p class="mb-1 text-light">{{ auth()->user()->name }}</p>
                    </div>
                </a>

                <div class="dropdown-menu navbar-dropdown">

                    <a class="dropdown-item">
                        <i class="mdi mdi-cached me-2 text-success"></i> Activity Log
                    </a>

                    <div class="dropdown-divider"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="mdi mdi-logout me-2 text-danger"></i> Logout
                        </button>
                    </form>

                </div>
            </li>

            </ul>
        </div>
</nav>
