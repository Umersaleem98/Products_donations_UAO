
    <!-- ── STAT CARDS ── -->
    <div class="row g-3 mb-4">
      <div class="col-6 col-xl-3">
        <div class="stat-card">
          <div class="stat-icon icon-purple"><i class="bi bi-people-fill"></i></div>
          <div>
            <div class="stat-value" id="statUsers">0</div>
            <div class="stat-label">Total Users</div>
          </div>
          <div class="stat-change up"><i class="bi bi-arrow-up-short"></i>+12.4% vs last month</div>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="stat-card">
          <div class="stat-icon icon-cyan"><i class="bi bi-bag-check-fill"></i></div>
          <div>
            <div class="stat-value" id="statOrders">0</div>
            <div class="stat-label">Total Orders</div>
          </div>
          <div class="stat-change up"><i class="bi bi-arrow-up-short"></i>+8.1% vs last month</div>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="stat-card">
          <div class="stat-icon icon-green"><i class="bi bi-currency-dollar"></i></div>
          <div>
            <div class="stat-value" id="statRevenue">$0</div>
            <div class="stat-label">Revenue</div>
          </div>
          <div class="stat-change up"><i class="bi bi-arrow-up-short"></i>+19.2% vs last month</div>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="stat-card">
          <div class="stat-icon icon-amber"><i class="bi bi-star-fill"></i></div>
          <div>
            <div class="stat-value" id="statReviews">0</div>
            <div class="stat-label">Reviews</div>
          </div>
          <div class="stat-change down"><i class="bi bi-arrow-down-short"></i>-2.3% vs last month</div>
        </div>
      </div>
    </div>

    <!-- ── CHART ROW ── -->
    <div class="row g-3 mb-4">
      <!-- Revenue Bar Chart -->
      <div class="col-lg-8">
        <div class="card-box">
          <div class="card-title">Revenue Overview</div>
          <div class="card-subtitle">Monthly revenue for 2024</div>
          <div class="bar-chart" id="barChart"></div>
          <div class="d-flex gap-3 mt-3 flex-wrap">
            <small class="text-muted"><span style="color:var(--primary);font-weight:700;">■</span> 2024 Revenue</small>
            <small class="text-muted"><span style="color:var(--accent);font-weight:700;">■</span> 2023 Revenue</small>
          </div>
        </div>
      </div>

      <!-- Donut -->
      <div class="col-lg-4">
        <div class="card-box h-100">
          <div class="card-title">Traffic Sources</div>
          <div class="card-subtitle">Where visitors come from</div>
          <div class="donut-wrap">
            <svg viewBox="0 0 120 120" width="120" height="120">
              <circle cx="60" cy="60" r="50" fill="none" stroke="#E2E8F0" stroke-width="18"/>
              <circle cx="60" cy="60" r="50" fill="none" stroke="var(--primary)" stroke-width="18"
                stroke-dasharray="188 314" stroke-linecap="round" class="donut-seg" id="seg1"/>
              <circle cx="60" cy="60" r="50" fill="none" stroke="var(--accent)" stroke-width="18"
                stroke-dasharray="94 314" stroke-dashoffset="-188" stroke-linecap="round" class="donut-seg" id="seg2"/>
              <circle cx="60" cy="60" r="50" fill="none" stroke="var(--success)" stroke-width="18"
                stroke-dasharray="32 314" stroke-dashoffset="-282" stroke-linecap="round" class="donut-seg" id="seg3"/>
            </svg>
            <div class="donut-center">
              <div class="val">68%</div>
              <div class="lbl">Organic</div>
            </div>
          </div>
          <div>
            <div class="legend-item"><div class="legend-dot" style="background:var(--primary)"></div><span>Organic Search — 60%</span></div>
            <div class="legend-item"><div class="legend-dot" style="background:var(--accent)"></div><span>Social Media — 30%</span></div>
            <div class="legend-item"><div class="legend-dot" style="background:var(--success)"></div><span>Direct — 10%</span></div>
          </div>
        </div>
      </div>
    </div>

    <!-- ── TABLE + ACTIVITY ── -->
    <div class="row g-3">
      <!-- Recent Orders Table -->
      <div class="col-lg-8">
        <div class="card-box table-card">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <div class="card-title mb-0">Recent Orders</div>
              <div style="font-size:.78rem;color:var(--muted);">Latest 6 transactions</div>
            </div>
            <a href="#" style="font-size:.8rem;color:var(--primary);font-weight:600;text-decoration:none;">View All →</a>
          </div>
          <div class="table-responsive">
            <table class="table table-borderless mb-0" id="ordersTable">
              <thead>
                <tr>
                  <th>Customer</th>
                  <th>Product</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Activity Feed -->
      <div class="col-lg-4">
        <div class="card-box">
          <div class="card-title">Recent Activity</div>
          <div class="card-subtitle">System events log</div>
          <div id="activityFeed"></div>
        </div>
      </div>
    </div>