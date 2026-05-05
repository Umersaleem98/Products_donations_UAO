@include('layouts.admin.head')
<title>Dashboard</title>

<style>
    .equal-card {
        height: 100%;
    }
    .equal-card .card-body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-height: 150px;
        text-align: center;
    }
</style>

<body>
<div class="container-scroller">

    @include('layouts.admin.header')

    <div class="container-fluid page-body-wrapper">

        @include('layouts.admin.sidebar')

        <div class="main-panel">
            <div class="content-wrapper">

                {{-- HEADER --}}
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="mdi mdi-home"></i>
                        </span> Dashboard
                    </h3>
                </div>

                {{-- ================= ADMIN ================= --}}
                @if (Auth::user()->role === 'admin')
                <div class="row">

                    <div class="col-md-3 grid-margin d-flex">
                        <div class="card bg-gradient-primary text-white equal-card w-100">
                            <div class="card-body">
                                <h5>Total Users</h5>
                                <h2>{{ $totalUsers }}</h2>
                                <small>Donors: {{ $totalDonors }} | Beneficiaries: {{ $totalBeneficiaries }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 grid-margin d-flex">
                        <div class="card bg-gradient-success text-white equal-card w-100">
                            <div class="card-body">
                                <h5>Total Products</h5>
                                <h2>{{ $totalProducts }}</h2>
                                <small>Categories: {{ $totalCategories }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 grid-margin d-flex">
                        <div class="card bg-gradient-info text-white equal-card w-100">
                            <div class="card-body">
                                <h5>Total Requests</h5>
                                <h2>{{ $totalRequests }}</h2>
                                <small>Admin Pending: {{ $pendingAdmin }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 grid-margin d-flex">
                        <div class="card bg-gradient-warning text-white equal-card w-100">
                            <div class="card-body">
                                <h5>Donor Decisions</h5>
                                <p>Pending: {{ $pendingDonor }}</p>
                                <p>Accepted: {{ $acceptedByDonor }}</p>
                                <p>Rejected: {{ $rejectedByDonor }}</p>
                            </div>
                        </div>
                    </div>

                </div>
                @endif

                {{-- ================= DONOR ================= --}}
                @if (Auth::user()->role === 'donor')
                <div class="row">

                    <div class="col-md-4 grid-margin d-flex">
                        <div class="card bg-gradient-primary text-white equal-card w-100">
                            <div class="card-body">
                                <h5>My Products</h5>
                                <h2>{{ $myProducts }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 grid-margin d-flex">
                        <div class="card bg-gradient-info text-white equal-card w-100">
                            <div class="card-body">
                                <h5>Incoming Requests</h5>
                                <h2>{{ $incomingRequests }}</h2>
                                <small>Pending: {{ $pendingRequests }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 grid-margin d-flex">
                        <div class="card bg-gradient-success text-white equal-card w-100">
                            <div class="card-body">
                                <h5>Accepted Requests</h5>
                                <h2>{{ $acceptedRequests }}</h2>
                            </div>
                        </div>
                    </div>

                </div>
                @endif

                {{-- ================= BENEFICIARY ================= --}}
                @if (Auth::user()->role === 'beneficiary')
                <div class="row">

                    <div class="col-md-3 grid-margin d-flex">
                        <div class="card bg-gradient-primary text-white equal-card w-100">
                            <div class="card-body">
                                <h5>My Requests</h5>
                                <h2>{{ $myRequests }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 grid-margin d-flex">
                        <div class="card bg-gradient-warning text-white equal-card w-100">
                            <div class="card-body">
                                <h5>Pending</h5>
                                <h2>{{ $pending }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 grid-margin d-flex">
                        <div class="card bg-gradient-info text-white equal-card w-100">
                            <div class="card-body">
                                <h5>Approved</h5>
                                <h2>{{ $approved }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 grid-margin d-flex">
                        <div class="card bg-gradient-success text-white equal-card w-100">
                            <div class="card-body">
                                <h5>Accepted</h5>
                                <h2>{{ $accepted }}</h2>
                            </div>
                        </div>
                    </div>

                </div>
                @endif

            </div>
        </div>

    </div>

</div>

@include('layouts.admin.script')
</body>