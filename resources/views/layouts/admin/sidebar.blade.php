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

    <!-- Analytics dropdown -->
    <div class="nav-dropdown">
      <div class="nav-dropdown-toggle" data-dropdown="analytics">
        <i class="bi bi-bar-chart-line-fill nav-icon"></i>
        <span>Analytics</span>
        <i class="bi bi-chevron-right nav-chevron"></i>
      </div>
      <div class="nav-submenu" id="dd-analytics">
        <a class="nav-sub-item active">Overview</a>
        <a class="nav-sub-item" href="">Traffic Sources</a>
        <a class="nav-sub-item" href="">Conversion Rates</a>
        <a class="nav-sub-item" href="">Heatmaps</a>
      </div>
    </div>

    <!-- Users dropdown -->
    <div class="nav-dropdown">
      <div class="nav-dropdown-toggle" data-dropdown="users">
        <i class="bi bi-people-fill nav-icon"></i>
        <span>Users</span>
        <i class="bi bi-chevron-right nav-chevron"></i>
      </div>
      <div class="nav-submenu" id="dd-users">
        <a class="nav-sub-item" href="">All Users</a>
        <a class="nav-sub-item" href="">Roles &amp; Permissions</a>
        <a class="nav-sub-item" href="">Activity Logs</a>
        <a class="nav-sub-item" href="">Banned Users <span class="sub-badge">3</span></a>
      </div>
    </div>

    <!-- Orders dropdown -->
    <div class="nav-dropdown">
      <div class="nav-dropdown-toggle" data-dropdown="orders">
        <i class="bi bi-bag-check-fill nav-icon"></i>
        <span>Orders</span>
        <span class="nav-badge">12</span>
        <i class="bi bi-chevron-right nav-chevron"></i>
      </div>
      <div class="nav-submenu" id="dd-orders">
        <a class="nav-sub-item" href="">All Orders</a>
        <a class="nav-sub-item" href="">Pending <span class="sub-badge">12</span></a>
        <a class="nav-sub-item" href="">Completed</a>
        <a class="nav-sub-item" href="">Refunds</a>
      </div>
    </div>

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
        <a class="nav-sub-item" href="{{ route('products.index') }}">Add Product</a>
        <a class="nav-sub-item" href="{{ route('category.index') }}">Categories</a>
      </div>
    </div>

    <a class="nav-link-item" data-page="messages">
      <i class="bi bi-chat-dots-fill"></i> Messages
      <span class="nav-badge">5</span>
    </a>

    <!-- Reports dropdown -->
    <div class="nav-dropdown">
      <div class="nav-dropdown-toggle" data-dropdown="reports">
        <i class="bi bi-file-earmark-bar-graph-fill nav-icon"></i>
        <span>Reports</span>
        <i class="bi bi-chevron-right nav-chevron"></i>
      </div>
      <div class="nav-submenu" id="dd-reports">
        <a class="nav-sub-item" href="">Sales Report</a>
        <a class="nav-sub-item" href="">Revenue Report</a>
        <a class="nav-sub-item" href="">User Report</a>
        <a class="nav-sub-item" href="">Export Data</a>
      </div>
    </div>

    <div class="nav-label mt-2">System</div>

    <!-- Settings dropdown -->
    <div class="nav-dropdown">
      <div class="nav-dropdown-toggle" data-dropdown="settings">
        <i class="bi bi-gear-fill nav-icon"></i>
        <span>Settings</span>
        <i class="bi bi-chevron-right nav-chevron"></i>
      </div>
      <div class="nav-submenu" id="dd-settings">
        <a class="nav-sub-item" href="">General</a>
        <a class="nav-sub-item" href="">Security</a>
        <a class="nav-sub-item" href="">Notifications</a>
        <a class="nav-sub-item" href="">Integrations</a>
        <a class="nav-sub-item" href="">Billing</a>
      </div>
    </div>

    <a class="nav-link-item" data-page="help">
      <i class="bi bi-question-circle-fill"></i> Help
    </a>
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
