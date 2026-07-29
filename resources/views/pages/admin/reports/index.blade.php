@include('layouts.admin.head')

<title>Traffic Analytics</title>

<body>

    {{-- New Sidebar --}}
    @include('layouts.admin.sidebar')


    {{-- Main Content --}}
    <div class="nsn-main">

        {{-- New Topbar --}}
        @include('layouts.admin.header')


        <main class="nsn-content">

            {{-- Page Header --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

                <div>
                    <h3 class="fw-bold text-dark mb-1">
                        Traffic Analytics
                    </h3>

                    <p class="text-secondary small mb-0">
                        Monitor website traffic, visitor trends and growth comparisons.
                    </p>
                </div>

                <div class="d-flex flex-wrap align-items-center gap-2">

                    <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                        <i class="bi bi-circle-fill me-1"></i>
                        Live Analytics
                    </span>

                    <span class="badge rounded-pill bg-light text-secondary border px-3 py-2">
                        <i class="bi bi-calendar3 me-1"></i>
                        {{ now()->format('d M Y') }}
                    </span>

                </div>

            </div>


            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-4">

                <ol class="breadcrumb small mb-0">

                    <li class="breadcrumb-item">
                        <a
                            href="{{ route('dashboard') }}"
                            class="text-decoration-none"
                        >
                            <i class="bi bi-house-door me-1"></i>
                            Dashboard
                        </a>
                    </li>

                    <li
                        class="breadcrumb-item active"
                        aria-current="page"
                    >
                        Traffic Analytics
                    </li>

                </ol>

            </nav>


            {{-- Alerts --}}
            @include('layouts.admin.alert')


            {{-- ================================================= --}}
            {{-- KPI CARDS --}}
            {{-- ================================================= --}}
            <div class="row g-3 mb-4">

                {{-- Today --}}
                <div class="col-12 col-sm-6 col-xl-3">

                    <div class="card border-0 shadow-sm rounded-4 h-100">

                        <div class="card-body p-4">

                            <div class="d-flex align-items-start justify-content-between gap-3 mb-4">

                                <div>
                                    <p class="text-secondary small fw-semibold text-uppercase mb-1">
                                        Today
                                    </p>

                                    <h2 class="fw-bold text-dark mb-0">
                                        {{ number_format($today) }}
                                    </h2>
                                </div>

                                <span
                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary flex-shrink-0"
                                    style="width: 46px; height: 46px;"
                                >
                                    <i class="bi bi-calendar-day fs-5"></i>
                                </span>

                            </div>


                            @if ($todayGrowth >= 0)

                                <div class="d-flex align-items-center gap-2">

                                    <span class="badge rounded-pill bg-success-subtle text-success">
                                        <i class="bi bi-arrow-up-short"></i>
                                        {{ number_format(abs($todayGrowth), 1) }}%
                                    </span>

                                    <small class="text-secondary">
                                        vs previous day
                                    </small>

                                </div>

                            @else

                                <div class="d-flex align-items-center gap-2">

                                    <span class="badge rounded-pill bg-danger-subtle text-danger">
                                        <i class="bi bi-arrow-down-short"></i>
                                        {{ number_format(abs($todayGrowth), 1) }}%
                                    </span>

                                    <small class="text-secondary">
                                        vs previous day
                                    </small>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- This Week --}}
                <div class="col-12 col-sm-6 col-xl-3">

                    <div class="card border-0 shadow-sm rounded-4 h-100">

                        <div class="card-body p-4">

                            <div class="d-flex align-items-start justify-content-between gap-3 mb-4">

                                <div>
                                    <p class="text-secondary small fw-semibold text-uppercase mb-1">
                                        This Week
                                    </p>

                                    <h2 class="fw-bold text-dark mb-0">
                                        {{ number_format($week) }}
                                    </h2>
                                </div>

                                <span
                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success-subtle text-success flex-shrink-0"
                                    style="width: 46px; height: 46px;"
                                >
                                    <i class="bi bi-calendar-week fs-5"></i>
                                </span>

                            </div>


                            @if ($weekGrowth >= 0)

                                <div class="d-flex align-items-center gap-2">

                                    <span class="badge rounded-pill bg-success-subtle text-success">
                                        <i class="bi bi-arrow-up-short"></i>
                                        {{ number_format(abs($weekGrowth), 1) }}%
                                    </span>

                                    <small class="text-secondary">
                                        vs previous week
                                    </small>

                                </div>

                            @else

                                <div class="d-flex align-items-center gap-2">

                                    <span class="badge rounded-pill bg-danger-subtle text-danger">
                                        <i class="bi bi-arrow-down-short"></i>
                                        {{ number_format(abs($weekGrowth), 1) }}%
                                    </span>

                                    <small class="text-secondary">
                                        vs previous week
                                    </small>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- This Month --}}
                <div class="col-12 col-sm-6 col-xl-3">

                    <div class="card border-0 shadow-sm rounded-4 h-100">

                        <div class="card-body p-4">

                            <div class="d-flex align-items-start justify-content-between gap-3 mb-4">

                                <div>
                                    <p class="text-secondary small fw-semibold text-uppercase mb-1">
                                        This Month
                                    </p>

                                    <h2 class="fw-bold text-dark mb-0">
                                        {{ number_format($month) }}
                                    </h2>
                                </div>

                                <span
                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-info-subtle text-info-emphasis flex-shrink-0"
                                    style="width: 46px; height: 46px;"
                                >
                                    <i class="bi bi-calendar-month fs-5"></i>
                                </span>

                            </div>


                            @if ($monthGrowth >= 0)

                                <div class="d-flex align-items-center gap-2">

                                    <span class="badge rounded-pill bg-success-subtle text-success">
                                        <i class="bi bi-arrow-up-short"></i>
                                        {{ number_format(abs($monthGrowth), 1) }}%
                                    </span>

                                    <small class="text-secondary">
                                        vs previous month
                                    </small>

                                </div>

                            @else

                                <div class="d-flex align-items-center gap-2">

                                    <span class="badge rounded-pill bg-danger-subtle text-danger">
                                        <i class="bi bi-arrow-down-short"></i>
                                        {{ number_format(abs($monthGrowth), 1) }}%
                                    </span>

                                    <small class="text-secondary">
                                        vs previous month
                                    </small>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- This Year --}}
                <div class="col-12 col-sm-6 col-xl-3">

                    <div class="card border-0 shadow-sm rounded-4 h-100">

                        <div class="card-body p-4">

                            <div class="d-flex align-items-start justify-content-between gap-3 mb-4">

                                <div>
                                    <p class="text-secondary small fw-semibold text-uppercase mb-1">
                                        This Year
                                    </p>

                                    <h2 class="fw-bold text-dark mb-0">
                                        {{ number_format($year) }}
                                    </h2>
                                </div>

                                <span
                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning-subtle text-warning-emphasis flex-shrink-0"
                                    style="width: 46px; height: 46px;"
                                >
                                    <i class="bi bi-calendar3 fs-5"></i>
                                </span>

                            </div>


                            @if ($yearGrowth >= 0)

                                <div class="d-flex align-items-center gap-2">

                                    <span class="badge rounded-pill bg-success-subtle text-success">
                                        <i class="bi bi-arrow-up-short"></i>
                                        {{ number_format(abs($yearGrowth), 1) }}%
                                    </span>

                                    <small class="text-secondary">
                                        vs previous year
                                    </small>

                                </div>

                            @else

                                <div class="d-flex align-items-center gap-2">

                                    <span class="badge rounded-pill bg-danger-subtle text-danger">
                                        <i class="bi bi-arrow-down-short"></i>
                                        {{ number_format(abs($yearGrowth), 1) }}%
                                    </span>

                                    <small class="text-secondary">
                                        vs previous year
                                    </small>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- TOTAL VISITORS --}}
            {{-- ================================================= --}}
            <div class="card border-0 bg-dark text-white shadow-sm rounded-4 mb-4">

                <div class="card-body p-4">

                    <div class="row align-items-center g-3">

                        <div class="col">

                            <p class="text-white-50 small fw-semibold text-uppercase mb-2">
                                Total Website Visitors
                            </p>

                            <h2 class="fw-bold text-white mb-2">
                                {{ number_format($total) }}
                            </h2>

                            <p class="text-white-50 small mb-0">
                                Total visitor records collected since tracking began.
                            </p>

                        </div>

                        <div class="col-auto">

                            <span
                                class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white bg-opacity-10"
                                style="width: 64px; height: 64px;"
                            >
                                <i class="bi bi-people fs-3"></i>
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- DAILY AND WEEKLY CHARTS --}}
            {{-- ================================================= --}}
            <div class="row g-4 mb-4">

                {{-- Daily Trend --}}
                <div class="col-12 col-xl-6">

                    <div class="card border-0 shadow-sm rounded-4 h-100">

                        <div class="card-header bg-white border-bottom px-4 py-3">

                            <div class="d-flex align-items-center justify-content-between gap-3">

                                <div>
                                    <h5 class="fw-semibold text-dark mb-1">
                                        Daily Visitor Trend
                                    </h5>

                                    <p class="text-secondary small mb-0">
                                        Visitor activity by day
                                    </p>
                                </div>

                                <span class="badge rounded-pill bg-primary-subtle text-primary">
                                    Daily
                                </span>

                            </div>

                        </div>

                        <div class="card-body p-4">
                            <canvas
                                id="dailyChart"
                                height="220"
                                aria-label="Daily visitor trend"
                            ></canvas>
                        </div>

                    </div>

                </div>


                {{-- Weekly Trend --}}
                <div class="col-12 col-xl-6">

                    <div class="card border-0 shadow-sm rounded-4 h-100">

                        <div class="card-header bg-white border-bottom px-4 py-3">

                            <div class="d-flex align-items-center justify-content-between gap-3">

                                <div>
                                    <h5 class="fw-semibold text-dark mb-1">
                                        Weekly Visitor Trend
                                    </h5>

                                    <p class="text-secondary small mb-0">
                                        Visitor activity by week
                                    </p>
                                </div>

                                <span class="badge rounded-pill bg-success-subtle text-success">
                                    Weekly
                                </span>

                            </div>

                        </div>

                        <div class="card-body p-4">
                            <canvas
                                id="weeklyChart"
                                height="220"
                                aria-label="Weekly visitor trend"
                            ></canvas>
                        </div>

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- MONTHLY AND YEARLY CHARTS --}}
            {{-- ================================================= --}}
            <div class="row g-4 mb-4">

                {{-- Monthly Trend --}}
                <div class="col-12 col-xl-6">

                    <div class="card border-0 shadow-sm rounded-4 h-100">

                        <div class="card-header bg-white border-bottom px-4 py-3">

                            <div class="d-flex align-items-center justify-content-between gap-3">

                                <div>
                                    <h5 class="fw-semibold text-dark mb-1">
                                        Monthly Visitor Trend
                                    </h5>

                                    <p class="text-secondary small mb-0">
                                        Visitor activity by month
                                    </p>
                                </div>

                                <span class="badge rounded-pill bg-info-subtle text-info-emphasis">
                                    Monthly
                                </span>

                            </div>

                        </div>

                        <div class="card-body p-4">
                            <canvas
                                id="monthlyChart"
                                height="220"
                                aria-label="Monthly visitor trend"
                            ></canvas>
                        </div>

                    </div>

                </div>


                {{-- Yearly Trend --}}
                <div class="col-12 col-xl-6">

                    <div class="card border-0 shadow-sm rounded-4 h-100">

                        <div class="card-header bg-white border-bottom px-4 py-3">

                            <div class="d-flex align-items-center justify-content-between gap-3">

                                <div>
                                    <h5 class="fw-semibold text-dark mb-1">
                                        Yearly Visitor Trend
                                    </h5>

                                    <p class="text-secondary small mb-0">
                                        Long-term visitor growth
                                    </p>
                                </div>

                                <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis">
                                    Yearly
                                </span>

                            </div>

                        </div>

                        <div class="card-body p-4">
                            <canvas
                                id="yearlyChart"
                                height="220"
                                aria-label="Yearly visitor trend"
                            ></canvas>
                        </div>

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- RECENT VISITORS --}}
            {{-- ================================================= --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                <div class="card-header bg-white border-bottom px-4 py-3">

                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

                        <div>
                            <h5 class="fw-semibold text-dark mb-1">
                                Recent Visitors
                            </h5>

                            <p class="text-secondary small mb-0">
                                Latest visitor devices and browser information.
                            </p>
                        </div>

                        <span class="badge rounded-pill bg-light text-secondary border px-3 py-2">
                            <i class="bi bi-clock-history me-1"></i>
                            Recent activity
                        </span>

                    </div>

                </div>


                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3 text-secondary small">
                                        #
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        IP Address
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        Browser
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        Platform
                                    </th>

                                    <th class="px-4 py-3 text-secondary small">
                                        Visit Time
                                    </th>
                                </tr>
                            </thead>


                            <tbody>

                                @forelse ($recent as $key => $visitor)

                                    <tr>

                                        <td class="px-4 text-secondary">
                                            {{ $recent->firstItem() + $key }}
                                        </td>


                                        <td>
                                            <div class="d-flex align-items-center gap-2">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary flex-shrink-0"
                                                    style="width: 34px; height: 34px;"
                                                >
                                                    <i class="bi bi-globe2"></i>
                                                </span>

                                                <span class="fw-semibold text-dark">
                                                    {{ $visitor->ip_address ?? 'Unknown' }}
                                                </span>

                                            </div>
                                        </td>


                                        <td>
                                            <span class="badge bg-light text-dark border fw-normal px-3 py-2">
                                                <i class="bi bi-browser-chrome me-1"></i>
                                                {{ $visitor->browser ?? 'Unknown' }}
                                            </span>
                                        </td>


                                        <td>
                                            <span class="badge bg-light text-dark border fw-normal px-3 py-2">
                                                <i class="bi bi-laptop me-1"></i>
                                                {{ $visitor->platform ?? 'Unknown' }}
                                            </span>
                                        </td>


                                        <td class="px-4">

                                            <div class="small text-dark">
                                                <i class="bi bi-clock text-secondary me-1"></i>

                                                {{ optional($visitor->created_at)->diffForHumans() }}
                                            </div>

                                            <small class="text-secondary">
                                                {{ optional($visitor->created_at)->format('d M Y, h:i A') }}
                                            </small>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="5" class="text-center py-5">

                                            <div class="d-flex flex-column align-items-center">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light text-secondary mb-3"
                                                    style="width: 64px; height: 64px;"
                                                >
                                                    <i class="bi bi-people fs-3"></i>
                                                </span>

                                                <h6 class="fw-semibold text-dark mb-1">
                                                    No visitor records found
                                                </h6>

                                                <p class="text-secondary small mb-0">
                                                    Visitor information will appear here after website activity.
                                                </p>

                                            </div>

                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>


                {{-- Pagination --}}
                @if ($recent->hasPages())

                    <div class="card-footer bg-white border-top px-4 py-3">

                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">

                            <p class="text-secondary small mb-0">
                                Showing
                                <span class="fw-semibold text-dark">
                                    {{ $recent->firstItem() }}
                                </span>
                                to
                                <span class="fw-semibold text-dark">
                                    {{ $recent->lastItem() }}
                                </span>
                                of
                                <span class="fw-semibold text-dark">
                                    {{ $recent->total() }}
                                </span>
                                visitors
                            </p>

                            <div>
                                {{ $recent->withQueryString()->links() }}
                            </div>

                        </div>

                    </div>

                @endif

            </div>

        </main>

    </div>


    @include('layouts.admin.script')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Chart.defaults.font.family =
                "'Inter', 'Segoe UI', Arial, sans-serif";

            Chart.defaults.color = '#667085';


            function createTrafficChart(
                elementId,
                labels,
                values,
                chartType,
                label,
                primaryColor,
                backgroundColor
            ) {
                const chartElement =
                    document.getElementById(elementId);

                if (!chartElement) {
                    return;
                }

                new Chart(chartElement, {
                    type: chartType,

                    data: {
                        labels: labels,

                        datasets: [{
                            label: label,
                            data: values,
                            borderColor: primaryColor,
                            backgroundColor: backgroundColor,
                            borderWidth: 2,
                            borderRadius:
                                chartType === 'bar' ? 7 : 0,
                            maxBarThickness: 45,
                            pointBackgroundColor: primaryColor,
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: chartType === 'line' ? 4 : 0,
                            pointHoverRadius: 6,
                            tension: 0.4,
                            fill: chartType === 'line'
                        }]
                    },

                    options: {
                        responsive: true,
                        maintainAspectRatio: true,

                        interaction: {
                            intersect: false,
                            mode: 'index'
                        },

                        plugins: {
                            legend: {
                                display: false
                            },

                            tooltip: {
                                padding: 12,
                                displayColors: false
                            }
                        },

                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },

                                border: {
                                    display: false
                                },

                                ticks: {
                                    maxRotation: 0,
                                    autoSkip: true
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


            createTrafficChart(
                'dailyChart',
                @json($daily->pluck('label')),
                @json($daily->pluck('total')),
                'line',
                'Daily Visitors',
                '#00608c',
                'rgba(0, 96, 140, 0.10)'
            );


            createTrafficChart(
                'weeklyChart',
                @json($weekly->pluck('label')),
                @json($weekly->pluck('total')),
                'bar',
                'Weekly Visitors',
                '#23ad79',
                'rgba(35, 173, 121, 0.75)'
            );


            createTrafficChart(
                'monthlyChart',
                @json($monthly->pluck('label')),
                @json($monthly->pluck('total')),
                'bar',
                'Monthly Visitors',
                '#3597d3',
                'rgba(53, 151, 211, 0.75)'
            );


            createTrafficChart(
                'yearlyChart',
                @json($yearly->pluck('label')),
                @json($yearly->pluck('total')),
                'line',
                'Yearly Visitors',
                '#faaf19',
                'rgba(250, 175, 25, 0.12)'
            );
        });
    </script>

</body>
