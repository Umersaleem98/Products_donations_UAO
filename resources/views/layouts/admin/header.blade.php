<!-- ═══════════════════ TOPBAR ═══════════════════ -->
<header id="topbar">
  <button class="topbar-toggle" id="sidebarToggle"><i class="bi bi-list"></i></button>

  <!-- Search -->
  <div class="topbar-search">
    <i class="bi bi-search"></i>
    <input type="text" placeholder="Search anything…" id="searchInput"/>
    <span class="search-kbd d-none d-md-flex">⌘K</span>
  </div>

  <div class="topbar-actions">

    <!-- Notifications -->
    <div style="position:relative;">
      <div class="icon-btn" id="notifBtn" title="Notifications">
        <i class="bi bi-bell-fill"></i>
        <span class="notif-count">4</span>
      </div>
      <!-- Notification Panel -->
      <div class="topbar-panel" id="notifPanel">
        <div class="panel-header">
          <span class="ph-title">Notifications</span>
          <a class="ph-clear">Mark all read</a>
        </div>
        <div class="notif-list">
          <div class="notif-item unread">
            <div class="notif-icon-wrap icon-purple"><i class="bi bi-person-plus-fill"></i></div>
            <div class="notif-body">
              <div class="notif-text"><strong>Sara Ahmed</strong> just registered a new account.</div>
              <div class="notif-time">2 minutes ago</div>
            </div>
            <div class="unread-dot"></div>
          </div>
          <div class="notif-item unread">
            <div class="notif-icon-wrap icon-cyan"><i class="bi bi-bag-check-fill"></i></div>
            <div class="notif-body">
              <div class="notif-text">New order <strong>#ORD-4821</strong> received — $1,299</div>
              <div class="notif-time">14 minutes ago</div>
            </div>
            <div class="unread-dot"></div>
          </div>
          <div class="notif-item unread">
            <div class="notif-icon-wrap icon-amber"><i class="bi bi-exclamation-triangle-fill"></i></div>
            <div class="notif-body">
              <div class="notif-text">Server CPU load reached <strong>87%</strong> — check resources.</div>
              <div class="notif-time">1 hour ago</div>
            </div>
            <div class="unread-dot"></div>
          </div>
          <div class="notif-item unread">
            <div class="notif-icon-wrap icon-green"><i class="bi bi-star-fill"></i></div>
            <div class="notif-body">
              <div class="notif-text">You received a <strong>5-star</strong> review from Bilal R.</div>
              <div class="notif-time">3 hours ago</div>
            </div>
            <div class="unread-dot"></div>
          </div>
          <div class="notif-item">
            <div class="notif-icon-wrap" style="background:#F1F5F9;color:#64748B;"><i class="bi bi-x-circle-fill"></i></div>
            <div class="notif-body">
              <div class="notif-text">Order <strong>#ORD-4799</strong> was cancelled by the customer.</div>
              <div class="notif-time">5 hours ago</div>
            </div>
          </div>
        </div>
        <div class="panel-footer"><a href="#">View all notifications →</a></div>
      </div>
    </div>

    <!-- Messages -->
    <div class="icon-btn" id="fullscreenBtn" title="Full Screen">
      <i class="bi bi-fullscreen"></i>
    </div>

    <div class="topbar-divider"></div>

    <!-- Profile Dropdown -->
    <div style="position:relative;">
      <div class="profile-trigger" id="profileBtn">
        <div class="profile-avatar">AK</div>
        <div class="profile-info d-none d-md-block">
          <div class="p-name">{{ auth()->user()->name ?? 'Guest' }}</div>
          <div class="p-role">{{ auth()->user()->role ?? 'N/A' }}</div>
        </div>
        <i class="bi bi-chevron-down profile-chevron d-none d-md-flex"></i>
      </div>
      <!-- Profile Panel -->
      <div class="profile-panel" id="profilePanel">
        <div class="profile-panel-head">
          <div class="pp-avatar">AK</div>
          <div>
            <div class="pp-name">{{ auth()->user()->name ?? 'Guest' }}</div>
            <div class="pp-email">{{ auth()->user()->email ?? 'N/A' }}</div>
            <span class="pp-badge">{{ auth()->user()->role ?? 'N/A' }}</span>
          </div>
        </div>
        <div class="profile-menu">
          <a class="pm-item"><i class="bi bi-person-fill"></i> My Profile</a>
          <a class="pm-item"><i class="bi bi-shield-lock-fill"></i> Security</a>
          <a class="pm-item"><i class="bi bi-bell-fill"></i> Notification Prefs</a>
          <a class="pm-item"><i class="bi bi-palette-fill"></i> Appearance</a>
          <div class="pm-divider"></div>
          <a class="pm-item"><i class="bi bi-question-circle-fill"></i> Help &amp; Support</a>
          <a class="pm-item"><i class="bi bi-box-arrow-up-right"></i> What's New</a>
          <div class="pm-divider"></div>
          <a class="pm-item logout"><i class="bi bi-box-arrow-right"></i> Sign Out</a>
        </div>
      </div>
    </div>

  </div>
</header>
