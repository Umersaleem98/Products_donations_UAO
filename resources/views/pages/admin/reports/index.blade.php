@include('layouts.admin.head')

<body>
    <div class="container-scroller">

        @include('layouts.admin.header')
        <div class="container-fluid page-body-wrapper">

            @include('layouts.admin.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">

                    <!-- HEADER -->
                    <div class="page-header">
                        <h3 class="page-title">
                            📊 Advanced Analytics Dashboard (With Comparison)
                        </h3>
                    </div>

                    <!-- KPI + COMPARISON -->
                    <div class="row">

                        @php
                            function badge($val)
                            {
                                return $val >= 0
                                    ? '<span class="text-success">▲ ' . $val . '%</span>'
                                    : '<span class="text-danger">▼ ' . $val . '%</span>';
                            }
                        @endphp

                        <div class="col-md-3">
                            <div class="card p-3 shadow">
                                <h6>Today</h6>
                                <h3>{{ $today }}</h3>
                                {!! badge($todayGrowth) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card p-3 shadow">
                                <h6>This Week</h6>
                                <h3>{{ $week }}</h3>
                                {!! badge($weekGrowth) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card p-3 shadow">
                                <h6>This Month</h6>
                                <h3>{{ $month }}</h3>
                                {!! badge($monthGrowth) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card p-3 shadow">
                                <h6>This Year</h6>
                                <h3>{{ $year }}</h3>
                                {!! badge($yearGrowth) !!}
                            </div>
                        </div>

                    </div>

                    <!-- TOTAL -->
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="card bg-dark text-white p-3">
                                <h5>Total Visitors</h5>
                                <h2>{{ $total }}</h2>
                            </div>
                        </div>
                    </div>

                    <!-- CHARTS -->
                    <div class="row mt-4">

                        <div class="col-md-6">
                            <div class="card shadow p-3">
                                <h5>Daily Trend</h5>
                                <canvas id="daily"></canvas>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card shadow p-3">
                                <h5>Weekly Trend</h5>
                                <canvas id="weekly"></canvas>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-4">

                        <div class="col-md-6">
                            <div class="card shadow p-3">
                                <h5>Monthly Trend</h5>
                                <canvas id="monthly"></canvas>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card shadow p-3">
                                <h5>Yearly Trend</h5>
                                <canvas id="yearly"></canvas>
                            </div>
                        </div>

                    </div>

                    <!-- RECENT TABLE -->
                    <div class="card mt-4 p-3 shadow">

                        <h5>Recent Visitors</h5>

                        <div class="table-responsive" style="max-height:400px;overflow:auto;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>IP</th>
                                        <th>Browser</th>
                                        <th>Platform</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($recent as $v)
                                        <tr>
                                            <td>{{ $v->ip_address }}</td>
                                            <td>{{ $v->browser }}</td>
                                            <td>{{ $v->platform }}</td>
                                            <td>{{ $v->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                        {{ $recent->links() }}

                    </div>

                </div>

                @include('layouts.admin.script')
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <script>
                    function chart(id, labels, data, type = 'line') {
                        new Chart(document.getElementById(id), {
                            type: type,
                            data: {
                                labels: labels,
                                datasets: [{
                                    data: data,
                                    borderWidth: 2
                                }]
                            }
                        });
                    }

                    chart('daily',
                        @json($daily->pluck('label')),
                        @json($daily->pluck('total'))
                    );

                    chart('weekly',
                        @json($weekly->pluck('label')),
                        @json($weekly->pluck('total')),
                        'bar'
                    );

                    chart('monthly',
                        @json($monthly->pluck('label')),
                        @json($monthly->pluck('total')),
                        'bar'
                    );

                    chart('yearly',
                        @json($yearly->pluck('label')),
                        @json($yearly->pluck('total')),
                        'line'
                    );
                </script>

            </div>
        </div>
    </div>
</body>
