@if(auth()->user()->role === 'admin')

<!-- ── STAT CARDS ── -->
<div class="row g-3 mb-4">

    <!-- USERS -->
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon icon-purple">
                <i class="bi bi-people-fill"></i>
            </div>
            <div>
                <div class="stat-value">{{ $stats['total_users'] ?? 0 }}</div>
                <div class="stat-label">Total Users</div>
            </div>
        </div>
    </div>

    <!-- PRODUCTS -->
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon icon-cyan">
                <i class="bi bi-box-seam"></i>
            </div>
            <div>
                <div class="stat-value">{{ $stats['total_products'] ?? 0 }}</div>
                <div class="stat-label">Total Products</div>
            </div>
        </div>
    </div>

    <!-- CATEGORIES -->
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon icon-green">
                <i class="bi bi-tags-fill"></i>
            </div>
            <div>
                <div class="stat-value">{{ $stats['total_categories'] ?? 0 }}</div>
                <div class="stat-label">Categories</div>
            </div>
        </div>
    </div>

</div>

@endif