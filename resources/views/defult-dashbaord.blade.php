@include('layouts.admin.head')
<body>
    
    <!-- Overlay (mobile) -->
    <div id="overlay"></div>
    
    @include('layouts.admin.sidebar')
    @include('layouts.admin.header')


<!-- ═══════════════════ MAIN ═══════════════════════ -->
<main id="main">
  <div class="content-area">

    <!-- Page Header -->
    <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div>
        <h1>Dashboard</h1>
        <p id="dateLabel"></p>
      </div>
      <button class="btn btn-sm text-white px-3 py-2"
        style="background:var(--primary);border-radius:10px;font-size:.82rem;font-weight:600;">
        <i class="bi bi-plus-lg me-1"></i> New Report
      </button>
    </div>


  </div><!-- /content-area -->
</main>

@include('layouts.admin.script')