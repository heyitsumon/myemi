<div class="container mx-auto p-4">

@role('admin')
<h2 class="text-2xl font-bold mb-6">{{ __('ui.admin_dashboard') }}</h2>

<!-- ================= STATS ================= -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

    <div class="stat bg-base-100 shadow rounded-box">
        <div class="stat-title">{{ __('ui.total_customers') }}</div>
        <div class="stat-value text-primary">{{ $totalCustomers }}</div>
    </div>

    <div class="stat bg-base-100 shadow rounded-box">
        <div class="stat-title">{{ __('ui.total_purchases') }}</div>
        <div class="stat-value text-info">{{ $totalPurchases }}</div>
    </div>

    <div class="stat bg-base-100 shadow rounded-box">
        <div class="stat-title">{{ __('ui.total_locations') }}</div>
        <div class="stat-value">{{ $totalLocations }}</div>
    </div>

    <div class="stat bg-base-100 shadow rounded-box">
        <div class="stat-title">{{ __('ui.total_sales') }}</div>
        <div class="stat-value text-primary">
            {{ number_format($totalSales) }}
        </div>
        <div class="stat-desc">TK</div>
    </div>

</div>

<!-- ================= FINANCIAL ================= -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">

    <div class="stat bg-base-100 shadow rounded-box">
        <div class="stat-title">{{ __('ui.total_paid') }}</div>
        <div class="stat-value text-success">
            {{ number_format($totalPaid) }}
        </div>
        <div class="stat-desc">TK Received</div>
    </div>

    <div class="stat bg-base-100 shadow rounded-box">
        <div class="stat-title">{{ __('ui.total_due') }}</div>
        <div class="stat-value text-error">
            {{ number_format($totalDue) }}
        </div>
        <div class="stat-desc">TK (Due / Loss)</div>
    </div>

    <div class="stat bg-base-100 shadow rounded-box">
        <div class="stat-title">{{ __('ui.total_profit') }}</div>

        @if($totalProfit >= 0)
            <div class="stat-value text-success">
                {{ number_format($totalProfit) }}
            </div>
            <div class="stat-desc">TK Profit</div>
        @else
            <div class="stat-value text-error">
                {{ number_format(abs($totalProfit)) }}
            </div>
            <div class="stat-desc">TK Loss</div>
        @endif
    </div>

</div>

<!-- ================= CHART ================= -->
<div wire:ignore class="card bg-base-100 shadow">
    <div class="card-body">
        <h3 class="card-title">{{ __('ui.monthly_customers_purchases') }}</h3>
        <canvas id="dashboardChart" height="120"></canvas>
    </div>
</div>

@endrole
</div>


@assets
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets


