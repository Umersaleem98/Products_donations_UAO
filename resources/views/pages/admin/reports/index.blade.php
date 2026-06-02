@include('layouts.admin.head')

<body>
<div class="container-scroller">

    @include('layouts.admin.header')

    <div class="container-fluid page-body-wrapper">

        @include('layouts.admin.sidebar')

        <div class="main-panel">

            <div class="content-wrapper">

                <!-- HEADER -->
                <div class="page-header mb-4">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="mdi mdi-chart-line"></i>
                        </span>
                        Traffic Analytics Overview
                    </h3>
                </div>

                <!-- STATS CARDS (MODERN UI) -->
                <div class="row">

                    <div class="col-md-3 stretch-card grid-margin">
                        <div class="card bg-gradient-primary text-white shadow-lg">
                            <div class="card-body">
                                <h6>Today Visitors</h6>
                                <h2 class="fw-bold">{{ $todayVisitors }}</h2>
                                <small>Live daily traffic</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 stretch-card grid-margin">
                        <div class="card bg-gradient-success text-white shadow-lg">
                            <div class="card-body">
                                <h6>Last 7 Days</h6>
                                <h2 class="fw-bold">{{ $weekVisitors }}</h2>
                                <small>Weekly engagement</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 stretch-card grid-margin">
                        <div class="card bg-gradient-warning text-white shadow-lg">
                            <div class="card-body">
                                <h6>This Month</h6>
                                <h2 class="fw-bold">{{ $monthVisitors }}</h2>
                                <small>Monthly growth</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 stretch-card grid-margin">
                        <div class="card bg-gradient-danger text-white shadow-lg">
                            <div class="card-body">
                                <h6>This Year</h6>
                                <h2 class="fw-bold">{{ $yearVisitors }}</h2>
                                <small>Annual performance</small>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- SECOND ROW (PREVIOUS YEAR + TOTAL INSIGHT) -->
                <div class="row mt-2">

                    <div class="col-md-6 stretch-card grid-margin">
                        <div class="card bg-dark text-white shadow">
                            <div class="card-body">
                                <h5>Previous Year Visitors</h5>
                                <h2>{{ $previousYearVisitors }}</h2>
                                <small>Year comparison metric</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 stretch-card grid-margin">
                        <div class="card bg-gradient-info text-white shadow">
                            <div class="card-body">
                                <h5>Total System Visitors</h5>
                                <h2>{{ \App\Models\VisitorTracker::count() }}</h2>
                                <small>All-time analytics data</small>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- CHARTS -->
                <div class="row mt-4">

                    <!-- TRAFFIC LINE CHART -->
                    <div class="col-md-8 grid-margin stretch-card">
                        <div class="card shadow">
                            <div class="card-body">
                                <h4 class="card-title">Traffic Trend (Last 30 Days)</h4>
                                <canvas id="trafficChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- BROWSER CHART -->
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card shadow">
                            <div class="card-body">
                                <h4 class="card-title">Browser Usage</h4>
                                <canvas id="browserChart"></canvas>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- RECENT VISITORS -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-body">

                                <h4 class="card-title">Recent Visitors</h4>

                                <div class="table-responsive">
                                    <table class="table table-hover">

                                        <thead class="table-light">
                                        <tr>
                                            <th>IP Address</th>
                                            <th>Browser</th>
                                            <th>Platform</th>
                                            <th>Visited At</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach(\App\Models\VisitorTracker::latest()->take(12)->get() as $v)
                                            <tr>
                                                <td><span class="badge bg-light text-dark">{{ $v->ip_address }}</span></td>
                                                <td>{{ $v->browser }}</td>
                                                <td>{{ $v->platform }}</td>
                                                <td>{{ $v->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            @include('layouts.admin.script')

            <!-- CHART JS -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                // TRAFFIC CHART
                new Chart(document.getElementById('trafficChart'), {
                    type: 'line',
                    data: {
                        labels: [
                            @foreach($dailyTraffic as $d)
                                "{{ $d->day }}",
                            @endforeach
                        ],
                        datasets: [{
                            label: 'Visitors',
                            data: [
                                @foreach($dailyTraffic as $d)
                                    {{ $d->total }},
                                @endforeach
                            ],
                            borderWidth: 3,
                            tension: 0.4
                        }]
                    }
                });

                // BROWSER CHART
                new Chart(document.getElementById('browserChart'), {
                    type: 'doughnut',
                    data: {
                        labels: [
                            @foreach($browserStats as $b)
                                "{{ $b->browser }}",
                            @endforeach
                        ],
                        datasets: [{
                            data: [
                                @foreach($browserStats as $b)
                                    {{ $b->total }},
                                @endforeach
                            ]
                        }]
                    }
                });
            </script>

        </div>
    </div>
</div>
</body>