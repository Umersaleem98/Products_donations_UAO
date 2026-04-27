<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">

    <!-- Top Navbar -->
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
            <a class="navbar-brand w-100 mr-0" href="{{ route('dashboard') }}" style="line-height: 25px;">
                <div class="d-table m-auto">
                    <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="{{ asset('admins/images/shards-dashboards-logo.svg') }}" alt="Shards Dashboard">
                    <span class="d-none d-md-inline ml-1">Admin Panel</span>
                </div>
            </a>

            <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                <i class="material-icons">&#xE5C4;</i>
            </a>
        </nav>
    </div>

    <!-- Mobile Search -->
    <form class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
        <div class="input-group input-group-seamless ml-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <input class="navbar-search form-control" type="text" placeholder="Search..." />
        </div>
    </form>

    <!-- Sidebar Menu -->
    <div class="nav-wrapper">
        <ul class="nav flex-column">

            @if(auth()->check() && auth()->user()->role === 'admin')

            <!-- USERS DROPDOWN -->
            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" href="#" id="usersDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="material-icons">people</i>
                    <span>Users</span>
                </a>

                <ul class="dropdown-menu w-100 border-0 shadow-sm">

                    <!-- TOTAL USERS -->
                    <li class="px-3 py-2">
                        <small class="text-muted">Total Users</small>
                        <h6 class="mb-0">{{ $totalUsers ?? 0 }}</h6>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <!-- ALL USERS -->
                    <li>
                        <a class="dropdown-item" href="{{ url('admin.users.index') }}">
                            <i class="material-icons">list</i> All Users
                        </a>
                    </li>

                    <!-- ADD USER -->
                    <li>
                        <a class="dropdown-item" href="{{ url('admin.users.create') }}">
                            <i class="material-icons">person_add</i> Add User
                        </a>
                    </li>

                </ul>
            </li>


            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" href="#" id="usersDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="material-icons">people</i>
                    <span>Category</span>
                </a>

                <ul class="dropdown-menu w-100 border-0 shadow-sm">

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('admin.category.index') }}">
                            <i class="material-icons">list</i> All Category
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" href="#" id="usersDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="material-icons">people</i>
                    <span>Products</span>
                </a>

                <ul class="dropdown-menu w-100 border-0 shadow-sm">

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('admin.products.index') }}">
                            <i class="material-icons">list</i> All products
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if(auth()->check() && auth()->user()->role === 'donor')

            <!-- USERS DROPDOWN -->
            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" href="#" id="usersDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="material-icons">people</i>
                    <span>Products</span>
                </a>

                <ul class="dropdown-menu w-100 border-0 shadow-sm">

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <!-- ALL USERS -->
                    <li>
                        <a class="dropdown-item" href="{{ route('donor.products.index') }}">
                            <i class="material-icons">list</i> All Products
                        </a>
                    </li>

                    <!-- ADD USER -->
                    <li>
                        <a class="dropdown-item" href="{{ route('donor.products.index') }}">
                            <i class="material-icons">person_add</i> Add Product
                        </a>
                    </li>

                </ul>
            </li>

            @endif

        </ul>
    </div>

</aside>
