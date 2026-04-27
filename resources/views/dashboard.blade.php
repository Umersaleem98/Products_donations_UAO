@include('layouts.admin.head')
<title>Dashboard</title>
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

          <!-- TOTAL USERS -->
          <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
              <div class="card-body p-0 d-flex">
                <div class="d-flex flex-column m-auto">
                  <div class="stats-small__data text-center">
                    <span class="stats-small__label text-uppercase">Users</span>
                    <h6 class="stats-small__value count my-3">
                      {{ number_format($totalUsers) }}
                    </h6>
                  </div>
                  <div class="stats-small__data">
                    <span class="stats-small__percentage stats-small__percentage--increase">
                      Live Data
                    </span>
                  </div>
                </div>
                <canvas height="120"></canvas>
              </div>
            </div>
          </div>

          <!-- DONORS -->
          <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
              <div class="card-body p-0 d-flex">
                <div class="d-flex flex-column m-auto">
                  <div class="stats-small__data text-center">
                    <span class="stats-small__label text-uppercase">Donors</span>
                    <h6 class="stats-small__value count my-3">
                      {{ number_format($totalDonors) }}
                    </h6>
                  </div>
                  <div class="stats-small__data">
                    <span class="stats-small__percentage stats-small__percentage--increase">
                      Active
                    </span>
                  </div>
                </div>
                <canvas height="120"></canvas>
              </div>
            </div>
          </div>

          <!-- BENEFICIARIES -->
          <div class="col-lg col-md-4 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
              <div class="card-body p-0 d-flex">
                <div class="d-flex flex-column m-auto">
                  <div class="stats-small__data text-center">
                    <span class="stats-small__label text-uppercase">Beneficiaries</span>
                    <h6 class="stats-small__value count my-3">
                      {{ number_format($totalBeneficiaries) }}
                    </h6>
                  </div>
                  <div class="stats-small__data">
                    <span class="stats-small__percentage stats-small__percentage--increase">
                      Registered
                    </span>
                  </div>
                </div>
                <canvas height="120"></canvas>
              </div>
            </div>
          </div>

          <!-- LOGGED USER -->
          <div class="col-lg col-md-4 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
              <div class="card-body p-0 d-flex">
                <div class="d-flex flex-column m-auto text-center">

                  <div class="stats-small__data">
                    <span class="stats-small__label text-uppercase">Logged User</span>

                    @auth
                      <h6 class="stats-small__value my-2">
                        {{ auth()->user()->name }}
                      </h6>

                      <small class="text-muted d-block">
                        {{ auth()->user()->email }}
                      </small>

                      <small class="text-info d-block">
                        Role: {{ auth()->user()->role }}
                      </small>
                    @endauth
                  </div>

                  <!-- Logout -->
                  <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button class="btn btn-sm btn-danger">
                      Logout
                    </button>
                  </form>

                </div>

                <canvas height="120"></canvas>
              </div>
            </div>
          </div>

        </div>
      </div>

    </main>
  </div>
</div>

@include('layouts.admin.script')