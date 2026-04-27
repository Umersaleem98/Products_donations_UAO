<!-- Main Navbar -->
<nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">

    <!-- SEARCH -->
    <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
        <div class="input-group input-group-seamless ml-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <input class="navbar-search form-control"
                   type="text"
                   placeholder="Search for something..."
                   aria-label="Search">
        </div>
    </form>

    <ul class="navbar-nav border-left flex-row">

        {{-- 🔔 NOTIFICATIONS (ADMIN ONLY) --}}
        @if(auth()->user()->role === 'admin')

        <li class="nav-item border-right dropdown notifications">

            <a class="nav-link nav-link-icon text-center"
               href="#"
               role="button"
               data-bs-toggle="dropdown"
               aria-expanded="false">

                <div class="nav-link-icon__wrapper">
                    <i class="material-icons">&#xE7F4;</i>

                    <span class="badge badge-pill badge-danger">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                </div>
            </a>

            <div class="dropdown-menu dropdown-menu-small">

                {{-- NOTIFICATIONS LIST --}}
                @forelse(auth()->user()->notifications->take(5) as $notification)

                    <a class="dropdown-item" href="#">

                        <div class="notification__icon-wrapper">
                            <div class="notification__icon">
                                <i class="material-icons">&#xE6E1;</i>
                            </div>
                        </div>

                        <div class="notification__content">
                            <span class="notification__category">
                                New Product
                            </span>

                            <p>
                                {{ $notification->data['message'] ?? 'New Notification' }}
                                <br>
                                <small class="text-muted">
                                    {{ $notification->created_at->diffForHumans() }}
                                </small>
                            </p>
                        </div>

                    </a>

                @empty

                    <a class="dropdown-item text-center">
                        No notifications
                    </a>

                @endforelse

                {{-- MARK AS READ --}}
                <a class="dropdown-item text-center"
                   href="{{ url('/notifications/read') }}">
                    Mark all as read
                </a>

            </div>
        </li>

        @endif


        {{-- 👤 USER DROPDOWN --}}
        <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle text-nowrap px-3"
               data-bs-toggle="dropdown"
               href="#"
               role="button">

                <img class="user-avatar rounded-circle mr-2"
                     src="{{ asset('admins/images/avatars/0.jpg') }}"
                     alt="User Avatar">

                <span class="d-none d-md-inline-block">
                    {{ Auth::user()->name }}
                </span>
            </a>

            <div class="dropdown-menu dropdown-menu-small">

                <a class="dropdown-item" href="#">
                    <i class="material-icons">&#xE7FD;</i> Profile
                </a>

                <div class="dropdown-divider"></div>

                {{-- LOGOUT --}}
                <form method="POST" action="{{ route('logout') }}" class="text-center">
                    @csrf
                    <button class="dropdown-item text-danger">
                        Logout
                    </button>
                </form>

            </div>
        </li>

    </ul>

    {{-- MOBILE --}}
    <nav class="nav">
        <a href="#"
           class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left"
           data-bs-toggle="collapse"
           data-bs-target=".header-navbar">

            <i class="material-icons">&#xE5D2;</i>
        </a>
    </nav>

</nav>