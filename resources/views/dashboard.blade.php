@include('layouts.admin.head')

<style>
    .dashboard-heading {
        color: #172033;
        font-size: clamp(1.35rem, 2vw, 1.8rem);
        font-weight: 700;
        margin-bottom: 4px;
    }

    .dashboard-subtitle {
        color: #667085;
        font-size: 0.88rem;
        margin-bottom: 0;
    }

    .dashboard-card {
        height: 100%;
        overflow: hidden;
        background: #ffffff;
        border: 1px solid #e9edf3;
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(15, 23, 42, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.09);
    }

    .stat-card {
        position: relative;
        min-height: 145px;
        padding: 22px;
    }

    .stat-card::after {
        position: absolute;
        right: -25px;
        bottom: -35px;
        width: 110px;
        height: 110px;
        content: "";
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.11);
    }

    .stat-primary {
        color: #ffffff;
        background: linear-gradient(135deg, #00608c, #0088bc);
    }

    .stat-success {
        color: #ffffff;
        background: linear-gradient(135deg, #16835b, #23ad79);
    }

    .stat-info {
        color: #ffffff;
        background: linear-gradient(135deg, #1769aa, #3597d3);
    }

    .stat-warning {
        color: #ffffff;
        background: linear-gradient(135deg, #e58a00, #faaf19);
    }

    .stat-danger {
        color: #ffffff;
        background: linear-gradient(135deg, #c74444, #e76161);
    }

    .stat-icon {
        display: inline-flex;
        width: 42px;
        height: 42px;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.18);
        font-size: 1.15rem;
    }

    .stat-label {
        margin-bottom: 6px;
        color: rgba(255, 255, 255, 0.86);
        font-size: 0.79rem;
        font-weight: 600;
        letter-spacing: 0.03em;
        text-transform: uppercase;
    }

    .stat-value {
        margin: 0;
        color: #ffffff;
        font-size: 2rem;
        font-weight: 700;
        line-height: 1;
    }

    .stat-description {
        display: block;
        margin-top: 10px;
        color: rgba(255, 255, 255, 0.84);
        font-size: 0.76rem;
    }

    .section-card {
        padding: 22px;
    }

    .section-title {
        margin: 0;
        color: #172033;
        font-size: 1rem;
        font-weight: 700;
    }

    .section-description {
        margin: 4px 0 0;
        color: #8490a3;
        font-size: 0.77rem;
    }

    .chart-container {
        position: relative;
        width: 100%;
        min-height: 290px;
        margin-top: 20px;
    }

    .chart-container canvas {
        width: 100% !important;
        max-height: 290px;
    }

    .dashboard-table {
        margin-bottom: 0;
        vertical-align: middle;
    }

    .dashboard-table thead th {
        padding: 13px 15px;
        color: #667085;
        background: #f8fafc;
        border-bottom: 1px solid #e9edf3;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.03em;
        white-space: nowrap;
        text-transform: uppercase;
    }

    .dashboard-table tbody td {
        padding: 14px 15px;
        color: #344054;
        border-color: #f0f2f5;
        font-size: 0.82rem;
    }

    .dashboard-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .dashboard-table tbody tr:hover {
        background: #fbfcfe;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 9px;
        border-radius: 50rem;
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: capitalize;
    }

    .status-pending {
        color: #9a6700;
        background: #fff3cd;
    }

    .status-approved,
    .status-accepted {
        color: #157347;
        background: #d1e7dd;
    }

    .status-rejected {
        color: #b02a37;
        background: #f8d7da;
    }

    .status-default {
        color: #495057;
        background: #e9ecef;
    }

    .role-badge {
        display: inline-block;
        padding: 5px 9px;
        color: #00608c;
        background: rgba(0, 96, 140, 0.1);
        border-radius: 50rem;
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: capitalize;
    }

    .profile-progress-card {
        padding: 20px 22px;
        background: linear-gradient(135deg, #ffffff, #f8fbfd);
        border: 1px solid #e2ebf0;
        border-radius: 16px;
    }

    .profile-progress {
        height: 8px;
        overflow: hidden;
        background: #e9edf2;
        border-radius: 20px;
    }

    .profile-progress .progress-bar {
        border-radius: 20px;
        background: linear-gradient(90deg, #00608c, #faaf19);
    }

    .empty-state {
        padding: 32px 15px !important;
        color: #98a2b3 !important;
        text-align: center;
    }

    @media (max-width: 767.98px) {
        .nsn-content {
            padding: 18px 14px;
        }

        .stat-card,
        .section-card {
            padding: 18px;
        }

        .chart-container {
            min-height: 240px;
        }
    }
</style>

<body>

    @include('layouts.admin.sidebar')

    <div class="nsn-main">

        @include('layouts.admin.header')

        <main class="nsn-content">

            {{-- Dashboard heading --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                <div>
                    <h1 class="dashboard-heading">
                        Welcome, {{ Auth::user()->name }}
                    </h1>

                    <p class="dashboard-subtitle">
                        Here is an overview of your
                        {{ ucfirst(Auth::user()->role) }} account.
                    </p>
                </div>

                <div class="d-none d-sm-flex align-items-center gap-2">
                    <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                        <i class="bi bi-shield-check me-1"></i>
                        Secure account
                    </span>

                    <span class="badge rounded-pill bg-light text-secondary px-3 py-2">
                        <i class="bi bi-calendar3 me-1"></i>
                        {{ now()->format('d M Y') }}
                    </span>
                </div>
            </div>


            {{-- ================================================= --}}
            {{-- ADMIN DASHBOARD --}}
            {{-- ================================================= --}}
            @if (Auth::user()->role === 'admin')

                {{-- Admin statistics --}}
                <div class="row g-3 mb-4">

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="dashboard-card stat-card stat-primary">
                            <span class="stat-icon">
                                <i class="bi bi-people"></i>
                            </span>

                            <div class="stat-label">Total Users</div>
                            <h2 class="stat-value">{{ number_format($totalUsers) }}</h2>

                            <span class="stat-description">
                                {{ $totalDonors }} donors ·
                                {{ $totalBeneficiaries }} beneficiaries
                            </span>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="dashboard-card stat-card stat-success">
                            <span class="stat-icon">
                                <i class="bi bi-box-seam"></i>
                            </span>

                            <div class="stat-label">Total Products</div>
                            <h2 class="stat-value">{{ number_format($totalProducts) }}</h2>

                            <span class="stat-description">
                                {{ $totalCategories }} available categories
                            </span>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="dashboard-card stat-card stat-info">
                            <span class="stat-icon">
                                <i class="bi bi-clipboard-data"></i>
                            </span>

                            <div class="stat-label">Total Requests</div>
                            <h2 class="stat-value">{{ number_format($totalRequests) }}</h2>

                            <span class="stat-description">
                                {{ $pendingAdmin }} awaiting admin review
                            </span>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="dashboard-card stat-card stat-warning">
                            <span class="stat-icon">
                                <i class="bi bi-person-check"></i>
                            </span>

                            <div class="stat-label">Donor Decisions</div>
                            <h2 class="stat-value">{{ number_format($acceptedByDonor) }}</h2>

                            <span class="stat-description">
                                {{ $pendingDonor }} pending ·
                                {{ $rejectedByDonor }} rejected
                            </span>
                        </div>
                    </div>

                </div>


                {{-- First chart row --}}
                <div class="row g-3 mb-4">

                    <div class="col-12 col-xl-5">
                        <div class="dashboard-card section-card">
                            <div>
                                <h2 class="section-title">User Distribution</h2>
                                <p class="section-description">
                                    Donor and beneficiary account distribution
                                </p>
                            </div>

                            <div class="chart-container">
                                <canvas id="userChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-7">
                        <div class="dashboard-card section-card">
                            <div>
                                <h2 class="section-title">Admin Request Status</h2>
                                <p class="section-description">
                                    Current administrative decisions
                                </p>
                            </div>

                            <div class="chart-container">
                                <canvas id="requestChart"></canvas>
                            </div>
                        </div>
                    </div>

                </div>


                {{-- Second chart row --}}
                <div class="row g-3 mb-4">

                    <div class="col-12 col-xl-8">
                        <div class="dashboard-card section-card">
                            <div>
                                <h2 class="section-title">Monthly Requests</h2>
                                <p class="section-description">
                                    Product requests received during {{ now()->year }}
                                </p>
                            </div>

                            <div class="chart-container">
                                <canvas id="monthlyChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-4">
                        <div class="dashboard-card section-card">
                            <div>
                                <h2 class="section-title">Donor Decisions</h2>
                                <p class="section-description">
                                    Accepted, rejected and pending requests
                                </p>
                            </div>

                            <div class="chart-container">
                                <canvas id="donorChart"></canvas>
                            </div>
                        </div>
                    </div>

                </div>


                {{-- Recent users --}}
                <div class="dashboard-card mb-4">
                    <div class="section-card pb-2">
                        <h2 class="section-title">Recent Users</h2>
                        <p class="section-description">
                            The latest registered accounts
                        </p>
                    </div>

                    <div class="table-responsive">
                        <table class="table dashboard-table">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Joined</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($recentUsers as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="d-inline-flex align-items-center justify-content-center
                                                    rounded-circle bg-primary-subtle text-primary fw-semibold"
                                                    style="width: 34px; height: 34px; flex: 0 0 34px;">
                                                    {{ strtoupper(substr($item->name, 0, 1)) }}
                                                </span>

                                                <span class="fw-semibold">
                                                    {{ $item->name }}
                                                </span>
                                            </div>
                                        </td>

                                        <td>{{ $item->email }}</td>

                                        <td>
                                            <span class="role-badge">
                                                {{ $item->role }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ optional($item->created_at)->format('d M Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="empty-state">
                                            No users are available.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>


                {{-- Products and requests --}}
                <div class="row g-3">

                    <div class="col-12 col-xl-5">
                        <div class="dashboard-card">
                            <div class="section-card pb-2">
                                <h2 class="section-title">Recent Products</h2>
                                <p class="section-description">
                                    Recently submitted products
                                </p>
                            </div>

                            <div class="table-responsive">
                                <table class="table dashboard-table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Donor</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($recentProducts as $product)
                                            <tr>
                                                <td class="fw-semibold">
                                                    {{ $product->name }}
                                                </td>

                                                <td>
                                                    {{ optional($product->user)->name ?? 'Not available' }}
                                                </td>

                                                <td>
                                                    {{ optional($product->created_at)->format('d M Y') }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="empty-state">
                                                    No products are available.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 col-xl-7">
                        <div class="dashboard-card">
                            <div class="section-card pb-2">
                                <h2 class="section-title">Recent Requests</h2>
                                <p class="section-description">
                                    Latest product request activity
                                </p>
                            </div>

                            <div class="table-responsive">
                                <table class="table dashboard-table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Beneficiary</th>
                                            <th>Donor</th>
                                            <th>Admin</th>
                                            <th>Donor Decision</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($recentRequests as $productRequest)
                                            @php
                                                $adminStatus = strtolower(
                                                    $productRequest->admin_status ?? 'pending'
                                                );

                                                $donorStatus = strtolower(
                                                    $productRequest->donor_status ?? 'pending'
                                                );
                                            @endphp

                                            <tr>
                                                <td class="fw-semibold">
                                                    {{ optional($productRequest->product)->name ?? 'Not available' }}
                                                </td>

                                                <td>
                                                    {{ optional($productRequest->beneficiary)->name ?? 'Not available' }}
                                                </td>

                                                <td>
                                                    {{ optional($productRequest->donor)->name ?? 'Not available' }}
                                                </td>

                                                <td>
                                                    <span class="status-badge status-{{ $adminStatus }}">
                                                        {{ $adminStatus }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="status-badge status-{{ $donorStatus }}">
                                                        {{ $donorStatus }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="empty-state">
                                                    No requests are available.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            @endif


            {{-- ================================================= --}}
            {{-- DONOR DASHBOARD --}}
            {{-- ================================================= --}}
            @if (Auth::user()->role === 'donor')

                <div class="profile-progress-card mb-4">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                        <div>
                            <h2 class="section-title">Profile Completion</h2>

                            <p class="section-description">
                                Complete at least 85% of your profile to unlock all features.
                            </p>
                        </div>

                        <span class="fw-bold {{ $profileCompletion >= 85 ? 'text-success' : 'text-warning' }}">
                            {{ $profileCompletion }}%
                        </span>
                    </div>

                    <div
                        class="progress profile-progress"
                        role="progressbar"
                        aria-label="Profile completion"
                        aria-valuenow="{{ $profileCompletion }}"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    >
                        <div
                            class="progress-bar"
                            style="width: {{ $profileCompletion }}%;"
                        ></div>
                    </div>

                    @if ($profileCompletion < 85)
                        <small class="d-block text-danger mt-2">
                            <i class="bi bi-exclamation-circle me-1"></i>
                            Your products and requests will unlock at 85%.
                        </small>
                    @else
                        <small class="d-block text-success mt-2">
                            <i class="bi bi-check-circle me-1"></i>
                            All donor features are unlocked.
                        </small>
                    @endif
                </div>


                <div class="row g-3 mb-4">

                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="dashboard-card stat-card stat-primary">
                            <span class="stat-icon">
                                <i class="bi bi-box-seam"></i>
                            </span>

                            <div class="stat-label">My Products</div>
                            <h2 class="stat-value">{{ number_format($myProducts) }}</h2>

                            <span class="stat-description">
                                Products shared by your account
                            </span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="dashboard-card stat-card stat-info">
                            <span class="stat-icon">
                                <i class="bi bi-inbox"></i>
                            </span>

                            <div class="stat-label">Incoming Requests</div>
                            <h2 class="stat-value">{{ number_format($incomingRequests) }}</h2>

                            <span class="stat-description">
                                {{ $pendingRequests }} pending your decision
                            </span>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="dashboard-card stat-card stat-success">
                            <span class="stat-icon">
                                <i class="bi bi-check-circle"></i>
                            </span>

                            <div class="stat-label">Accepted Requests</div>
                            <h2 class="stat-value">{{ number_format($acceptedRequests) }}</h2>

                            <span class="stat-description">
                                Requests you have accepted
                            </span>
                        </div>
                    </div>

                </div>


                @if (!Auth::user()->termAcceptance)
                    @include('layouts.admin.term&condition')
                @endif

            @endif


            {{-- ================================================= --}}
            {{-- BENEFICIARY DASHBOARD --}}
            {{-- ================================================= --}}
            @if (Auth::user()->role === 'beneficiary')

                <div class="profile-progress-card mb-4">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                        <div>
                            <h2 class="section-title">Profile Completion</h2>

                            <p class="section-description">
                                Complete at least 85% of your profile to access products and requests.
                            </p>
                        </div>

                        <span class="fw-bold {{ $profileCompletion >= 85 ? 'text-success' : 'text-warning' }}">
                            {{ $profileCompletion }}%
                        </span>
                    </div>

                    <div
                        class="progress profile-progress"
                        role="progressbar"
                        aria-label="Profile completion"
                        aria-valuenow="{{ $profileCompletion }}"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    >
                        <div
                            class="progress-bar"
                            style="width: {{ $profileCompletion }}%;"
                        ></div>
                    </div>

                    @if ($profileCompletion < 85)
                        <small class="d-block text-danger mt-2">
                            <i class="bi bi-exclamation-circle me-1"></i>
                            Complete your profile to unlock beneficiary features.
                        </small>
                    @else
                        <small class="d-block text-success mt-2">
                            <i class="bi bi-check-circle me-1"></i>
                            All beneficiary features are unlocked.
                        </small>
                    @endif
                </div>


                <div class="row g-3">

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="dashboard-card stat-card stat-primary">
                            <span class="stat-icon">
                                <i class="bi bi-clipboard-data"></i>
                            </span>

                            <div class="stat-label">My Requests</div>
                            <h2 class="stat-value">{{ number_format($myRequests) }}</h2>

                            <span class="stat-description">
                                Total submitted requests
                            </span>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="dashboard-card stat-card stat-warning">
                            <span class="stat-icon">
                                <i class="bi bi-hourglass-split"></i>
                            </span>

                            <div class="stat-label">Pending</div>
                            <h2 class="stat-value">{{ number_format($pending) }}</h2>

                            <span class="stat-description">
                                Awaiting administrative review
                            </span>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="dashboard-card stat-card stat-info">
                            <span class="stat-icon">
                                <i class="bi bi-shield-check"></i>
                            </span>

                            <div class="stat-label">Approved</div>
                            <h2 class="stat-value">{{ number_format($approved) }}</h2>

                            <span class="stat-description">
                                Approved by administration
                            </span>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="dashboard-card stat-card stat-success">
                            <span class="stat-icon">
                                <i class="bi bi-check2-circle"></i>
                            </span>

                            <div class="stat-label">Accepted</div>
                            <h2 class="stat-value">{{ number_format($accepted) }}</h2>

                            <span class="stat-description">
                                Accepted by product donors
                            </span>
                        </div>
                    </div>

                </div>

            @endif

        </main>
    </div>


    @include('layouts.admin.script')


    @if (Auth::user()->role === 'admin')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Chart.defaults.font.family =
                    "'Inter', 'Segoe UI', Arial, sans-serif";

                Chart.defaults.color = '#667085';

                const commonLegend = {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                        padding: 18,
                        boxWidth: 8,
                        boxHeight: 8
                    }
                };

                const userChartElement = document.getElementById('userChart');

                if (userChartElement) {
                    new Chart(userChartElement, {
                        type: 'doughnut',
                        data: {
                            labels: ['Donors', 'Beneficiaries'],
                            datasets: [{
                                data: @json($usersChart),
                                backgroundColor: ['#00608c', '#23ad79'],
                                borderColor: '#ffffff',
                                borderWidth: 4,
                                hoverOffset: 6
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '68%',
                            plugins: {
                                legend: commonLegend,
                                tooltip: {
                                    padding: 12
                                }
                            }
                        }
                    });
                }


                const requestChartElement =
                    document.getElementById('requestChart');

                if (requestChartElement) {
                    new Chart(requestChartElement, {
                        type: 'bar',
                        data: {
                            labels: ['Pending', 'Approved', 'Rejected'],
                            datasets: [{
                                label: 'Requests',
                                data: @json($requestChart),
                                backgroundColor: [
                                    '#faaf19',
                                    '#23ad79',
                                    '#e76161'
                                ],
                                borderRadius: 8,
                                maxBarThickness: 55
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    border: {
                                        display: false
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        precision: 0
                                    },
                                    grid: {
                                        color: '#eef1f5'
                                    },
                                    border: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });
                }


                const monthlyChartElement =
                    document.getElementById('monthlyChart');

                if (monthlyChartElement) {
                    new Chart(monthlyChartElement, {
                        type: 'line',
                        data: {
                            labels: @json($requestMonths),
                            datasets: [{
                                label: 'Requests',
                                data: @json($requestCounts),
                                borderColor: '#00608c',
                                backgroundColor: 'rgba(0, 96, 140, 0.10)',
                                pointBackgroundColor: '#00608c',
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 2,
                                pointRadius: 4,
                                tension: 0.4,
                                fill: true
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            interaction: {
                                intersect: false,
                                mode: 'index'
                            },
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    border: {
                                        display: false
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        precision: 0
                                    },
                                    grid: {
                                        color: '#eef1f5'
                                    },
                                    border: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });
                }


                const donorChartElement =
                    document.getElementById('donorChart');

                if (donorChartElement) {
                    new Chart(donorChartElement, {
                        type: 'pie',
                        data: {
                            labels: ['Accepted', 'Rejected', 'Pending'],
                            datasets: [{
                                data: @json($donorDecisionChart),
                                backgroundColor: [
                                    '#23ad79',
                                    '#e76161',
                                    '#faaf19'
                                ],
                                borderColor: '#ffffff',
                                borderWidth: 4,
                                hoverOffset: 6
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: commonLegend
                            }
                        }
                    });
                }
            });
        </script>
    @endif

</body>
