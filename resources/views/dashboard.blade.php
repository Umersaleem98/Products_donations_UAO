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
                                        <small>Donors: {{ $totalDonors }} | Beneficiaries:
                                            {{ $totalBeneficiaries }}</small>
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

                        @if (Auth::user()->role === 'admin')
                            <div class="row">

                                {{-- User Distribution --}}
                                <div class="col-lg-6 grid-margin">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">User Distribution</h4>
                                            <canvas id="userChart" height="180"></canvas>
                                        </div>
                                    </div>
                                </div>

                                {{-- Request Status --}}
                                <div class="col-lg-6 grid-margin">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Request Status</h4>
                                            <canvas id="requestChart" height="180"></canvas>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                {{-- Monthly Requests --}}
                                <div class="col-lg-8 grid-margin">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Monthly Requests</h4>
                                            <canvas id="monthlyChart" height="120"></canvas>
                                        </div>
                                    </div>
                                </div>

                                {{-- Donor Decisions --}}
                                <div class="col-lg-4 grid-margin">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Donor Decisions</h4>
                                            <canvas id="donorChart" height="180"></canvas>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                        @if (Auth::user()->role === 'admin')

                            <div class="row">
                                <div class="col-lg-12 grid-margin">

                                    <div class="card">
                                        <div class="card-body">

                                            <h4 class="card-title">Recent Users</h4>

                                            <div class="table-responsive">

                                                <table class="table table-striped">

                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Role</th>
                                                            <th>Joined</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        @foreach ($recentUsers as $item)
                                                            <tr>
                                                                <td>{{ $item->name }}</td>
                                                                <td>{{ $item->email }}</td>
                                                                <td>
                                                                    <span class="badge badge-primary">
                                                                        {{ ucfirst($item->role) }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    {{ $item->created_at->format('d M Y') }}
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>

                                                </table>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        @endif

                        @if (Auth::user()->role === 'admin')

                            <div class="row">
                                <div class="col-lg-12 grid-margin">

                                    <div class="card">
                                        <div class="card-body">

                                            <h4 class="card-title">Recent Products</h4>

                                            <div class="table-responsive">

                                                <table class="table table-bordered">

                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Donor</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        @foreach ($recentProducts as $product)
                                                            <tr>

                                                                <td>{{ $product->name }}</td>

                                                                <td>
                                                                    {{ $product->user->name ?? '-' }}
                                                                </td>

                                                                <td>
                                                                    {{ $product->created_at->format('d M Y') }}
                                                                </td>

                                                            </tr>
                                                        @endforeach

                                                    </tbody>

                                                </table>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        @endif

                        @if (Auth::user()->role === 'admin')

                            <div class="row">
                                <div class="col-lg-12 grid-margin">

                                    <div class="card">

                                        <div class="card-body">

                                            <h4 class="card-title">Recent Requests</h4>

                                            <div class="table-responsive">

                                                <table class="table table-hover">

                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Beneficiary</th>
                                                            <th>Donor</th>
                                                            <th>Admin Status</th>
                                                            <th>Donor Status</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        @foreach ($recentRequests as $request)
                                                            <tr>

                                                                <td>{{ $request->product->name ?? '-' }}</td>

                                                                <td>{{ $request->beneficiary->name ?? '-' }}</td>

                                                                <td>{{ $request->donor->name ?? '-' }}</td>

                                                                <td>
                                                                    <span class="badge badge-info">
                                                                        {{ ucfirst($request->admin_status) }}
                                                                    </span>
                                                                </td>

                                                                <td>
                                                                    <span class="badge badge-success">
                                                                        {{ ucfirst($request->donor_status) }}
                                                                    </span>
                                                                </td>

                                                            </tr>
                                                        @endforeach

                                                    </tbody>

                                                </table>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>

                        @endif
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

                    @if (Auth::user()->role === 'donor' && !Auth::user()->termAcceptance)
                        @include('layouts.admin.term&condition')
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
    @if (Auth::user()->role === 'admin')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            new Chart(document.getElementById('userChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Donors', 'Beneficiaries'],
                    datasets: [{
                        data: @json($usersChart)
                    }]
                }
            });

            new Chart(document.getElementById('requestChart'), {
                type: 'bar',
                data: {
                    labels: ['Pending', 'Approved', 'Rejected'],
                    datasets: [{
                        label: 'Requests',
                        data: @json($requestChart)
                    }]
                }
            });

            new Chart(document.getElementById('monthlyChart'), {
                type: 'line',
                data: {
                    labels: @json($requestMonths),
                    datasets: [{
                        label: 'Requests',
                        data: @json($requestCounts),
                        borderWidth: 3,
                        tension: 0.4
                    }]
                }
            });

            new Chart(document.getElementById('donorChart'), {
                type: 'pie',
                data: {
                    labels: ['Accepted', 'Rejected', 'Pending'],
                    datasets: [{
                        data: @json($donorDecisionChart)
                    }]
                }
            });
        </script>
    @endif
</body>
