
  <!-- CATEGORY -->
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#category">
      <span class="menu-title">Category</span>
      <i class="menu-arrow"></i>
      <i class="mdi mdi-view-list menu-icon"></i>
    </a>
    <div class="collapse" id="category" data-bs-parent="#sidebar-accordion">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.category.index') }}">All Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.category.create') }}">Add Category</a>
        </li>
      </ul>
    </div>
  </li>

  <!-- PRODUCT -->
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#product">
      <span class="menu-title">Product</span>
      <i class="menu-arrow"></i>
      <i class="mdi mdi-cube-outline menu-icon"></i>
    </a>
    <div class="collapse" id="product" data-bs-parent="#sidebar-accordion">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.products.index') }}">All Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.products.index') }}">Add Product</a>
        </li>
      </ul>
    </div>
  </li>

  <!-- USERS -->
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#users">
      <span class="menu-title">Users</span>
      <i class="menu-arrow"></i>
      <i class="mdi mdi-account-group menu-icon"></i>
    </a>
    <div class="collapse" id="users" data-bs-parent="#sidebar-accordion">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.user.index') }}">All Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.user.create') }}">Add User</a>
        </li>
      </ul>
    </div>
  </li>

  <!-- PROFILE (Single Link) -->
  <li class="nav-item">
    <a class="nav-link" href="#">
      <span class="menu-title">Profile</span>
      <i class="mdi mdi-account-circle menu-icon"></i>
    </a>
  </li>

