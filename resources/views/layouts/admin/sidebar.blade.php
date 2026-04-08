<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">

        <!-- Brand -->
        <a href="{{ route('dashboard') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>DarkPan</h3>
        </a>

        <!-- User Info -->
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" 
                     src="admins/img/user.jpg" 
                     alt="" 
                     style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ auth()->user()->name ?? 'Guest' }}</h6>
                <span>{{ auth()->user()->role ?? 'N/A' }}</span>
            </div>
        </div>

        <!-- Navigation Links -->
        <div class="navbar-nav w-100">
            <a href="{{ route('dashboard') }}" class="nav-item nav-link active">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa fa-laptop me-2"></i>Products
                </a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('buyers.products.index') }}" class="dropdown-item">Products List</a>
                </div>
            </div>

            <!-- Add more menu items here if needed -->
        </div>

    </nav>
</div>
<!-- Sidebar End -->