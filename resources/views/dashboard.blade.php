@include('layouts.admin.head')
<title>Admin Dashboard</title>

<body>
    <div class="container-scroller">

        @include('layouts.admin.header')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            @include('layouts.admin.sidebar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-home"></i>
                            </span> Dashboard
                        </h3>
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span></span>Overview <i
                                        class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    @if (Auth::user()->role === 'admin')
                        <div class="row">

                            {{-- USERS --}}
                            <div class="col-md-3 grid-margin">
                                <div class="card bg-gradient-primary text-white">
                                    <div class="card-body">
                                        <h4>Total Users</h4>
                                        <h2>{{ $totalUsers }}</h2>
                                        <small>Donors: {{ $totalDonors }} | Beneficiaries:
                                            {{ $totalBeneficiaries }}</small>
                                    </div>
                                </div>
                            </div>

                            {{-- PRODUCTS --}}
                            <div class="col-md-3 grid-margin">
                                <div class="card bg-gradient-success text-white">
                                    <div class="card-body">
                                        <h4>Total Products</h4>
                                        <h2>{{ $totalProducts }}</h2>
                                        <small>Categories: {{ $totalCategories }}</small>
                                    </div>
                                </div>
                            </div>

                            {{-- REQUESTS --}}
                            <div class="col-md-3 grid-margin">
                                <div class="card bg-gradient-info text-white">
                                    <div class="card-body">
                                        <h4>Total Requests</h4>
                                        <h2>{{ $totalRequests }}</h2>
                                        <small>Admin Pending: {{ $pendingAdmin }}</small>
                                    </div>
                                </div>
                            </div>

                            {{-- DONOR STATUS --}}
                            <div class="col-md-3 grid-margin">
                                <div class="card bg-gradient-warning text-white">
                                    <div class="card-body">
                                        <h4>Donor Decisions</h4>
                                        <p>Pending: {{ $pendingDonor }}</p>
                                        <p>Accepted: {{ $acceptedByDonor }}</p>
                                        <p>Rejected: {{ $rejectedByDonor }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endif

                    @if (Auth::user()->role === 'donor')
                        <div class="row">

                            <div class="col-md-4 grid-margin">
                                <div class="card bg-gradient-primary text-white">
                                    <div class="card-body">
                                        <h4>My Products</h4>
                                        <h2>{{ $myProducts }}</h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 grid-margin">
                                <div class="card bg-gradient-info text-white">
                                    <div class="card-body">
                                        <h4>Incoming Requests</h4>
                                        <h2>{{ $incomingRequests }}</h2>
                                        <small>Pending: {{ $pendingRequests }}</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 grid-margin">
                                <div class="card bg-gradient-success text-white">
                                    <div class="card-body">
                                        <h4>Accepted Requests</h4>
                                        <h2>{{ $acceptedRequests }}</h2>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endif
                    @if (Auth::user()->role === 'beneficiary')
                        <div class="row">

                            <div class="col-md-3 grid-margin">
                                <div class="card bg-gradient-primary text-white">
                                    <div class="card-body">
                                        <h4>My Requests</h4>
                                        <h2>{{ $myRequests }}</h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 grid-margin">
                                <div class="card bg-gradient-warning text-white">
                                    <div class="card-body">
                                        <h4>Pending</h4>
                                        <h2>{{ $pending }}</h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 grid-margin">
                                <div class="card bg-gradient-info text-white">
                                    <div class="card-body">
                                        <h4>Approved</h4>
                                        <h2>{{ $approved }}</h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 grid-margin">
                                <div class="card bg-gradient-success text-white">
                                    <div class="card-body">
                                        <h4>Accepted</h4>
                                        <h2>{{ $accepted }}</h2>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endif

                </div>

            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('layouts.admin.script')
