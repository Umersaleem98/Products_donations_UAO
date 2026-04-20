<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>NexAdmin — Dashboard</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>

  <style>
    :root {
      --primary:    #4F46E5;
      --primary-lt: #EEF2FF;
      --accent:     #06B6D4;
      --success:    #10B981;
      --warning:    #F59E0B;
      --danger:     #EF4444;
      --sidebar-bg: #0F172A;
      --sidebar-w:  240px;
      --topbar-h:   64px;
      --body-bg:    #F1F5F9;
      --card-bg:    #FFFFFF;
      --text:       #1E293B;
      --muted:      #64748B;
      --border:     #E2E8F0;
      --radius:     14px;
      --shadow:     0 2px 16px rgba(15,23,42,.07);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--body-bg);
      color: var(--text);
      min-height: 100vh;
    }

    /* ── SIDEBAR ─────────────────────────────────── */
    #sidebar {
      position: fixed; top: 0; left: 0;
      width: var(--sidebar-w); height: 100vh;
      background: var(--sidebar-bg);
      display: flex; flex-direction: column;
      z-index: 1000;
      transition: transform .3s ease;
    }

    .sidebar-brand {
      display: flex; align-items: center; gap: 10px;
      padding: 22px 22px 18px;
      border-bottom: 1px solid rgba(255,255,255,.07);
    }
    .brand-icon {
      width: 36px; height: 36px; border-radius: 10px;
      background: linear-gradient(135deg, var(--primary), var(--accent));
      display: flex; align-items: center; justify-content: center;
      font-size: 18px; color: #fff;
    }
    .brand-name {
      font-family: 'Syne', sans-serif;
      font-weight: 800; font-size: 1.15rem;
      color: #fff; letter-spacing: -.3px;
    }
    .brand-name span { color: var(--accent); }

    .sidebar-nav {
      flex: 1; padding: 14px 12px;
      overflow-y: auto;
      scroll-behavior: smooth;
    }

    /* ── CUSTOM SCROLLBAR ────────────────────────── */
    .sidebar-nav::-webkit-scrollbar {
      width: 4px;
    }
    .sidebar-nav::-webkit-scrollbar-track {
      background: transparent;
      border-radius: 10px;
      margin: 6px 0;
    }
    .sidebar-nav::-webkit-scrollbar-thumb {
      background: linear-gradient(180deg, var(--primary), var(--accent));
      border-radius: 10px;
      transition: opacity .2s;
    }
    .sidebar-nav::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(180deg, var(--accent), var(--primary));
      width: 6px;
    }
    /* Firefox */
    .sidebar-nav {
      scrollbar-width: thin;
      scrollbar-color: var(--primary) transparent;
    }
    /* Glow pulse animation on the thumb */
    @keyframes scrollGlow {
      0%   { box-shadow: 0 0 4px var(--primary); }
      50%  { box-shadow: 0 0 10px var(--accent); }
      100% { box-shadow: 0 0 4px var(--primary); }
    }
    .sidebar-nav::-webkit-scrollbar-thumb:active {
      animation: scrollGlow 1.2s ease infinite;
    }
    .nav-label {
      font-size: .65rem; font-weight: 600; letter-spacing: 1.5px;
      text-transform: uppercase; color: #475569;
      padding: 10px 10px 6px;
    }

    .nav-link-item {
      display: flex; align-items: center; gap: 10px;
      padding: 10px 12px; border-radius: 10px;
      color: #94A3B8; font-size: .875rem; font-weight: 500;
      text-decoration: none; cursor: pointer;
      transition: background .18s, color .18s;
      margin-bottom: 2px;
    }
    .nav-link-item i { font-size: 1rem; width: 20px; text-align: center; }
    .nav-link-item:hover  { background: rgba(255,255,255,.06); color: #fff; }
    .nav-link-item.active { background: var(--primary); color: #fff; }
    .nav-badge {
      margin-left: auto; background: var(--danger);
      color: #fff; font-size: .65rem; font-weight: 700;
      padding: 1px 7px; border-radius: 20px;
    }

    /* ── DROPDOWN NAV ─────────────────────────────── */
    .nav-dropdown { margin-bottom: 2px; }

    .nav-dropdown-toggle {
      display: flex; align-items: center; gap: 10px;
      padding: 10px 12px; border-radius: 10px;
      color: #94A3B8; font-size: .875rem; font-weight: 500;
      cursor: pointer; user-select: none;
      transition: background .18s, color .18s;
      position: relative;
    }
    .nav-dropdown-toggle i.nav-icon { font-size: 1rem; width: 20px; text-align: center; }
    .nav-dropdown-toggle:hover { background: rgba(255,255,255,.06); color: #fff; }
    .nav-dropdown-toggle.open   { background: rgba(79,70,229,.18); color: #fff; }

    /* animated chevron */
    .nav-chevron {
      margin-left: auto;
      font-size: .75rem; color: #475569;
      transition: transform .28s cubic-bezier(.4,0,.2,1), color .2s;
    }
    .nav-dropdown-toggle.open .nav-chevron {
      transform: rotate(90deg);
      color: var(--accent);
    }

    /* sliding sub-menu */
    .nav-submenu {
      overflow: hidden;
      max-height: 0;
      transition: max-height .35s cubic-bezier(.4,0,.2,1), opacity .25s ease;
      opacity: 0;
    }
    .nav-submenu.open {
      max-height: 400px;
      opacity: 1;
    }

    .nav-sub-item {
      display: flex; align-items: center; gap: 9px;
      padding: 8px 12px 8px 42px;
      border-radius: 8px;
      color: #64748B; font-size: .82rem; font-weight: 500;
      cursor: pointer; text-decoration: none;
      transition: background .15s, color .15s;
      margin-bottom: 1px; position: relative;
    }
    /* left accent line */
    .nav-sub-item::before {
      content: '';
      position: absolute; left: 26px; top: 50%;
      transform: translateY(-50%);
      width: 5px; height: 5px; border-radius: 50%;
      background: #334155;
      transition: background .2s, transform .2s;
    }
    .nav-sub-item:hover { background: rgba(255,255,255,.05); color: #CBD5E1; }
    .nav-sub-item:hover::before { background: var(--accent); transform: translateY(-50%) scale(1.4); }
    .nav-sub-item.active { color: var(--accent); font-weight: 600; }
    .nav-sub-item.active::before { background: var(--accent); }
    .sub-badge {
      margin-left: auto; background: var(--warning);
      color: #fff; font-size: .6rem; font-weight: 700;
      padding: 1px 6px; border-radius: 20px;
    }

    .sidebar-footer {
      padding: 16px 12px;
      border-top: 1px solid rgba(255,255,255,.07);
    }
    .user-chip {
      display: flex; align-items: center; gap: 10px;
      padding: 10px 10px; border-radius: 10px;
      background: rgba(255,255,255,.05); cursor: pointer;
      transition: background .2s;
    }
    .user-chip:hover { background: rgba(255,255,255,.1); }
    .user-avatar {
      width: 34px; height: 34px; border-radius: 50%;
      background: linear-gradient(135deg, var(--primary), var(--accent));
      display: flex; align-items: center; justify-content: center;
      color: #fff; font-weight: 700; font-size: .85rem;
    }
    .user-info .name  { color: #fff; font-size: .82rem; font-weight: 600; }
    .user-info .role  { color: #64748B; font-size: .72rem; }

    /* ── TOPBAR ──────────────────────────────────── */
    #topbar {
      position: fixed; top: 0;
      left: var(--sidebar-w); right: 0;
      height: var(--topbar-h);
      background: var(--card-bg);
      border-bottom: 1px solid var(--border);
      display: flex; align-items: center;
      padding: 0 24px; gap: 12px; z-index: 900;
      box-shadow: 0 1px 12px rgba(15,23,42,.05);
    }
    .topbar-toggle {
      display: none; background: none; border: none;
      font-size: 1.3rem; color: var(--muted); cursor: pointer;
      padding: 4px 6px; border-radius: 8px;
      transition: background .2s, color .2s;
    }
    .topbar-toggle:hover { background: var(--body-bg); color: var(--primary); }

    /* Search */
    .topbar-search {
      flex: 1; max-width: 360px;
      display: flex; align-items: center; gap: 8px;
      background: var(--body-bg); border: 1.5px solid var(--border);
      border-radius: 12px; padding: 8px 14px;
      transition: border-color .2s, box-shadow .2s;
    }
    .topbar-search:focus-within {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(79,70,229,.1);
    }
    .topbar-search input {
      border: none; background: transparent;
      font-size: .875rem; color: var(--text); width: 100%; outline: none;
    }
    .topbar-search i { color: var(--muted); font-size: .95rem; flex-shrink: 0; }
    .search-kbd {
      margin-left: auto; background: var(--border);
      color: var(--muted); font-size: .65rem; font-weight: 600;
      padding: 2px 6px; border-radius: 5px; white-space: nowrap;
    }

    /* Action area */
    .topbar-actions { margin-left: auto; display: flex; align-items: center; gap: 4px; }

    /* Divider */
    .topbar-divider {
      width: 1px; height: 28px;
      background: var(--border); margin: 0 6px;
    }

    /* Icon buttons */
    .icon-btn {
      width: 40px; height: 40px; border-radius: 11px;
      background: transparent; border: none;
      display: flex; align-items: center; justify-content: center;
      cursor: pointer; color: var(--muted); font-size: 1rem;
      position: relative; transition: background .18s, color .18s;
    }
    .icon-btn:hover { background: var(--body-bg); color: var(--primary); }
    .icon-btn.active { background: var(--primary-lt); color: var(--primary); }

    /* Notification badge */
    .notif-count {
      position: absolute; top: 4px; right: 4px;
      min-width: 16px; height: 16px; border-radius: 8px;
      background: var(--danger); border: 2px solid #fff;
      color: #fff; font-size: .55rem; font-weight: 700;
      display: flex; align-items: center; justify-content: center;
      padding: 0 3px;
    }

    /* ── NOTIFICATION PANEL ── */
    .topbar-panel {
      position: absolute; top: calc(var(--topbar-h) + 8px); right: 0;
      width: 340px; background: var(--card-bg);
      border: 1.5px solid var(--border);
      border-radius: 16px; box-shadow: 0 12px 40px rgba(15,23,42,.14);
      z-index: 999; overflow: hidden;
      opacity: 0; transform: translateY(-8px) scale(.97);
      pointer-events: none;
      transition: opacity .22s ease, transform .22s ease;
    }
    .topbar-panel.show {
      opacity: 1; transform: translateY(0) scale(1);
      pointer-events: all;
    }
    .panel-header {
      display: flex; align-items: center; justify-content: space-between;
      padding: 16px 18px 12px;
      border-bottom: 1px solid var(--border);
    }
    .panel-header .ph-title {
      font-family: 'Syne', sans-serif;
      font-size: .92rem; font-weight: 700; color: var(--text);
    }
    .panel-header .ph-clear {
      font-size: .75rem; color: var(--primary); font-weight: 600;
      cursor: pointer; text-decoration: none;
    }
    .panel-header .ph-clear:hover { text-decoration: underline; }

    .notif-list { max-height: 300px; overflow-y: auto; }
    .notif-list::-webkit-scrollbar { width: 3px; }
    .notif-list::-webkit-scrollbar-thumb {
      background: linear-gradient(var(--primary), var(--accent));
      border-radius: 4px;
    }
    .notif-item {
      display: flex; align-items: flex-start; gap: 12px;
      padding: 13px 18px; cursor: pointer;
      transition: background .15s;
      border-bottom: 1px solid var(--border);
    }
    .notif-item:last-child { border-bottom: none; }
    .notif-item:hover { background: var(--body-bg); }
    .notif-item.unread { background: #F5F7FF; }
    .notif-item.unread:hover { background: #ECEFFE; }
    .notif-icon-wrap {
      width: 36px; height: 36px; border-radius: 10px; flex-shrink: 0;
      display: flex; align-items: center; justify-content: center; font-size: .9rem;
    }
    .notif-body .notif-text { font-size: .8rem; color: var(--text); line-height: 1.4; }
    .notif-body .notif-text strong { font-weight: 600; }
    .notif-body .notif-time { font-size: .7rem; color: var(--muted); margin-top: 2px; }
    .unread-dot {
      width: 7px; height: 7px; border-radius: 50%;
      background: var(--primary); flex-shrink: 0; margin-top: 6px; margin-left: auto;
    }
    .panel-footer {
      padding: 11px 18px; text-align: center;
      border-top: 1px solid var(--border);
    }
    .panel-footer a {
      font-size: .8rem; color: var(--primary); font-weight: 600; text-decoration: none;
    }
    .panel-footer a:hover { text-decoration: underline; }

    /* ── PROFILE DROPDOWN ── */
    .profile-trigger {
      display: flex; align-items: center; gap: 9px;
      padding: 5px 10px 5px 5px;
      border-radius: 12px; cursor: pointer;
      border: 1.5px solid transparent;
      transition: background .18s, border-color .18s;
      margin-left: 4px; position: relative;
    }
    .profile-trigger:hover,
    .profile-trigger.active {
      background: var(--body-bg);
      border-color: var(--border);
    }
    .profile-avatar {
      width: 34px; height: 34px; border-radius: 9px;
      background: linear-gradient(135deg, var(--primary), var(--accent));
      display: flex; align-items: center; justify-content: center;
      color: #fff; font-weight: 700; font-size: .85rem; flex-shrink: 0;
    }
    .profile-info { line-height: 1.25; }
    .profile-info .p-name { font-size: .82rem; font-weight: 700; color: var(--text); }
    .profile-info .p-role { font-size: .7rem; color: var(--muted); }
    .profile-chevron {
      font-size: .7rem; color: var(--muted);
      transition: transform .25s ease, color .2s;
    }
    .profile-trigger.active .profile-chevron {
      transform: rotate(180deg); color: var(--primary);
    }

    /* Profile panel */
    .profile-panel {
      position: absolute; top: calc(var(--topbar-h) + 8px); right: 0;
      width: 250px; background: var(--card-bg);
      border: 1.5px solid var(--border);
      border-radius: 16px; box-shadow: 0 12px 40px rgba(15,23,42,.14);
      z-index: 999; overflow: hidden;
      opacity: 0; transform: translateY(-8px) scale(.97);
      pointer-events: none;
      transition: opacity .22s ease, transform .22s ease;
    }
    .profile-panel.show {
      opacity: 1; transform: translateY(0) scale(1);
      pointer-events: all;
    }
    .profile-panel-head {
      display: flex; align-items: center; gap: 12px;
      padding: 18px 16px 14px;
      border-bottom: 1px solid var(--border);
      background: linear-gradient(135deg, var(--primary-lt), #ECFEFF);
    }
    .pp-avatar {
      width: 44px; height: 44px; border-radius: 12px;
      background: linear-gradient(135deg, var(--primary), var(--accent));
      display: flex; align-items: center; justify-content: center;
      color: #fff; font-weight: 800; font-size: 1rem; flex-shrink: 0;
    }
    .pp-name  { font-family: 'Syne', sans-serif; font-size: .9rem; font-weight: 700; color: var(--text); }
    .pp-email { font-size: .72rem; color: var(--muted); }
    .pp-badge {
      display: inline-block; margin-top: 3px;
      background: var(--primary); color: #fff;
      font-size: .6rem; font-weight: 700; padding: 1px 7px; border-radius: 20px;
    }

    .profile-menu { padding: 8px; }
    .pm-item {
      display: flex; align-items: center; gap: 10px;
      padding: 9px 10px; border-radius: 9px; cursor: pointer;
      color: var(--text); font-size: .82rem; font-weight: 500;
      transition: background .15s, color .15s; text-decoration: none;
    }
    .pm-item i { font-size: .9rem; width: 18px; text-align: center; color: var(--muted); }
    .pm-item:hover { background: var(--body-bg); color: var(--primary); }
    .pm-item:hover i { color: var(--primary); }
    .pm-divider { height: 1px; background: var(--border); margin: 6px 0; }
    .pm-item.logout { color: var(--danger); }
    .pm-item.logout i { color: var(--danger); }
    .pm-item.logout:hover { background: #FEF2F2; color: var(--danger); }

    /* ── MAIN CONTENT ────────────────────────────── */
    #main {
      margin-left: var(--sidebar-w);
      padding-top: var(--topbar-h);
      min-height: 100vh;
    }
    .content-area { padding: 28px; }

    .page-header { margin-bottom: 24px; }
    .page-header h1 {
      font-family: 'Syne', sans-serif;
      font-size: 1.6rem; font-weight: 800; color: var(--text);
    }
    .page-header p { color: var(--muted); font-size: .875rem; margin-top: 2px; }

    /* ── STAT CARDS ──────────────────────────────── */
    .stat-card {
      background: var(--card-bg);
      border: 1.5px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 22px;
      display: flex; flex-direction: column; gap: 14px;
      transition: transform .2s, box-shadow .2s;
    }
    .stat-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 28px rgba(15,23,42,.11);
    }
    .stat-icon {
      width: 46px; height: 46px; border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      font-size: 1.2rem;
    }
    .icon-purple { background: #EEF2FF; color: var(--primary); }
    .icon-cyan   { background: #ECFEFF; color: var(--accent); }
    .icon-green  { background: #ECFDF5; color: var(--success); }
    .icon-amber  { background: #FFFBEB; color: var(--warning); }

    .stat-value {
      font-family: 'Syne', sans-serif;
      font-size: 1.75rem; font-weight: 800; line-height: 1;
    }
    .stat-label { font-size: .8rem; color: var(--muted); font-weight: 500; }
    .stat-change { font-size: .78rem; font-weight: 600; }
    .stat-change.up   { color: var(--success); }
    .stat-change.down { color: var(--danger); }

    /* ── CHART CARD ──────────────────────────────── */
    .card-box {
      background: var(--card-bg);
      border: 1.5px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 22px;
    }
    .card-title {
      font-family: 'Syne', sans-serif;
      font-weight: 700; font-size: 1rem; margin-bottom: 4px;
    }
    .card-subtitle { font-size: .8rem; color: var(--muted); margin-bottom: 18px; }

    /* bar chart */
    .bar-chart { display: flex; align-items: flex-end; gap: 8px; height: 160px; }
    .bar-wrap  { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 5px; }
    .bar {
      width: 100%; border-radius: 6px 6px 0 0;
      background: var(--primary); opacity: .2;
      transition: opacity .2s, height .6s ease;
      cursor: pointer;
    }
    .bar:hover { opacity: 1; }
    .bar.active { opacity: 1; }
    .bar-label { font-size: .68rem; color: var(--muted); }

    /* donut */
    .donut-wrap { position: relative; width: 120px; height: 120px; margin: 0 auto 16px; }
    .donut-wrap svg { transform: rotate(-90deg); }
    .donut-center {
      position: absolute; top: 50%; left: 50%;
      transform: translate(-50%,-50%);
      text-align: center;
    }
    .donut-center .val {
      font-family: 'Syne', sans-serif;
      font-size: 1.3rem; font-weight: 800;
    }
    .donut-center .lbl { font-size: .65rem; color: var(--muted); }

    .legend-item { display: flex; align-items: center; gap: 8px; font-size: .8rem; margin-bottom: 8px; }
    .legend-dot  { width: 10px; height: 10px; border-radius: 3px; flex-shrink: 0; }

    /* ── TABLE ───────────────────────────────────── */
    .table-card { overflow: hidden; }
    .table thead th {
      background: var(--body-bg); font-size: .75rem;
      font-weight: 600; text-transform: uppercase;
      letter-spacing: .6px; color: var(--muted);
      border: none; padding: 10px 16px;
    }
    .table tbody td {
      padding: 13px 16px; font-size: .875rem;
      vertical-align: middle; border-color: var(--border);
    }
    .table tbody tr:hover { background: #F8FAFC; }
    .avatar-sm {
      width: 32px; height: 32px; border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: .75rem; font-weight: 700; color: #fff;
    }
    .status-pill {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 3px 10px; border-radius: 20px;
      font-size: .72rem; font-weight: 600;
    }
    .pill-success { background: #ECFDF5; color: var(--success); }
    .pill-warning { background: #FFFBEB; color: var(--warning); }
    .pill-danger  { background: #FEF2F2; color: var(--danger); }
    .pill-info    { background: #ECFEFF; color: var(--accent); }

    /* ── ACTIVITY ────────────────────────────────── */
    .activity-item { display: flex; gap: 12px; margin-bottom: 18px; }
    .act-icon {
      width: 36px; height: 36px; border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      font-size: .9rem; flex-shrink: 0;
    }
    .act-text { font-size: .8rem; color: var(--text); }
    .act-text strong { font-weight: 600; }
    .act-time { font-size: .72rem; color: var(--muted); margin-top: 2px; }

    /* ── RESPONSIVE ──────────────────────────────── */
    @media (max-width: 768px) {
      #sidebar { transform: translateX(-100%); }
      #sidebar.open { transform: translateX(0); }
      #main { margin-left: 0; }
      #topbar { left: 0; }
      .topbar-toggle { display: flex; }
      .content-area { padding: 18px; }
    }

    /* ── SIDEBAR OVERLAY ─────────────────────────── */
    #overlay {
      display: none; position: fixed; inset: 0;
      background: rgba(0,0,0,.45); z-index: 999;
    }
    #overlay.show { display: block; }
  </style>
</head>