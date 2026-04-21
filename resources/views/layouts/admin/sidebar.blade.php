<!-- ═══════════════════ SIDEBAR ═══════════════════ -->
<aside id="sidebar">
  <div class="sidebar-brand">
    <div class="brand-icon"><i class="bi bi-lightning-charge-fill"></i></div>
    <div class="brand-name">Nex<span>Admin</span></div>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-label">Main</div>
    <a class="nav-link-item active" data-page="dashboard">
      <i class="bi bi-grid-fill"></i> Dashboard
    </a>

    
@if(auth()->user()->role === 'admin')
    <!-- Users dropdown -->
    <div class="nav-dropdown">
      <div class="nav-dropdown-toggle" data-dropdown="users">
        <i class="bi bi-people-fill nav-icon"></i>
        <span>Users</span>
        <i class="bi bi-chevron-right nav-chevron"></i>
      </div>
      <div class="nav-submenu" id="dd-users">
        <a class="nav-sub-item" href="{{ route('users.index') }}">All Users</a>
        <a class="nav-sub-item" href="{{ route('users.create') }}">Create Users</a>
      </div>
    </div>

   
@endif
@if(auth()->user()->role === 'admin')
    <div class="nav-label mt-2">Content</div>

    <!-- Products dropdown -->
    <div class="nav-dropdown">
      <div class="nav-dropdown-toggle" data-dropdown="products">
        <i class="bi bi-box-seam-fill nav-icon"></i>
        <span>Products</span>
        <i class="bi bi-chevron-right nav-chevron"></i>
      </div>
      <div class="nav-submenu" id="dd-products">
        <a class="nav-sub-item" href="{{ route('products.index') }}">All Products</a>
        <a class="nav-sub-item" href="{{ route('products.create') }}">Add Product</a>
        <a class="nav-sub-item" href="{{ route('category.index') }}">All Categories</a>
        <a class="nav-sub-item" href="{{ route('category.create') }}">Add Categories</a>
      </div>
    </div>
@endif

   

    <!-- Reports dropdown -->
   
@if(auth()->user()->role === 'donor')
    <div class="nav-label mt-2">System</div>

    <!-- Settings dropdown -->
    <div class="nav-dropdown">
      <div class="nav-dropdown-toggle" data-dropdown="settings">
        <i class="bi bi-gear-fill nav-icon"></i>
        <span>Donation Post</span>
        <i class="bi bi-chevron-right nav-chevron"></i>
      </div>
      <div class="nav-submenu" id="dd-settings">
        <a class="nav-sub-item" href="{{ route('donor.post.index') }}">All Post</a>
        <a class="nav-sub-item" href="{{ route('donor.post.create') }}">Create Post</a>
      </div>
    </div>
@endif

  </nav>

  <div class="sidebar-footer">
    <div class="user-chip">
      <div class="user-avatar">AK</div>
      <div class="user-info">
        <div class="name">{{ auth()->user()->name ?? 'Guest' }}</div>
        <div class="role">{{ auth()->user()->role ?? 'N/A' }}</div>
      </div>
      <i class="bi bi-three-dots-vertical ms-auto text-secondary" style="font-size:.85rem;"></i>
    </div>
  </div>
</aside>
