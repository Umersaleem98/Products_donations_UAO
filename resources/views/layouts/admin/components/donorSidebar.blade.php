

  <!-- PRODUCT -->
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#donor-product">
      <span class="menu-title">Product</span>
      <i class="menu-arrow"></i>
      <i class="mdi mdi-cube-outline menu-icon"></i>
    </a>
    <div class="collapse" id="donor-product" data-bs-parent="#sidebar-accordion">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('donor.product.index') }}">My Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('donor.product.create') }}">Add Product</a>
        </li>
      </ul>
    </div>
  </li>

  <!-- PROFILE -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('donor.profile.index') }}">
      <span class="menu-title">Profile</span>
      <i class="mdi mdi-account-circle menu-icon"></i>
    </a>
  </li>

  <!-- REQUESTS -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('donor.requests') }}">
      <span class="menu-title">Requests</span>
      <i class="mdi mdi-clipboard-text menu-icon"></i>
    </a>
  </li>
