<!-- CATEGORY -->
<li class="nav-item">
  <a class="nav-link" data-bs-toggle="collapse" href="#admin-categories">
    <span class="menu-title">Category</span>
    <i class="menu-arrow"></i>
    <i class="mdi mdi-view-list menu-icon"></i>
  </a>

  <div class="collapse" id="admin-categories">
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
  <a class="nav-link" data-bs-toggle="collapse" href="#admin-products">
    <span class="menu-title">Product</span>
    <i class="menu-arrow"></i>
    <i class="mdi mdi-cube-outline menu-icon"></i>
  </a>

  <div class="collapse" id="admin-products">
    <ul class="nav flex-column sub-menu">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.products.index') }}">All Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.products.create') }}">Add Product</a>
      </li>
    </ul>
  </div>
</li>

<!-- USERS -->
<li class="nav-item">
  <a class="nav-link" data-bs-toggle="collapse" href="#admin-user">
    <span class="menu-title">Users</span>
    <i class="menu-arrow"></i>
    <i class="mdi mdi-account-group menu-icon"></i>
  </a>

  <div class="collapse" id="admin-user">
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

