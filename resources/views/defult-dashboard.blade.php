@include('layouts.admin.head')

<body class="h-100">

<div class="container-fluid">
  <div class="row">

    <!-- Sidebar -->
    @include('layouts.admin.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">

      <!-- Navbar -->
      <div class="main-navbar sticky-top bg-white">
        @include('layouts.admin.header')
      </div>

      <!-- Content -->
      <div class="main-content-container container-fluid px-4">

        <!-- Page Header -->
        <div class="page-header row no-gutters py-4">
          <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Dashboard</span>
            <h3 class="page-title">Admin Overview</h3>
          </div>
        </div>

        <!-- Stats Row -->
        <div class="row">

         

        </div>
      </div>

    </main>
  </div>
</div>

@include('layouts.admin.script')