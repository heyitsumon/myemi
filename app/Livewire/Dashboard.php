<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\InstallmentPayment;
use App\Models\Location;
use App\Models\Purchase;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $locationIds = auth()->user()->accessibleLocationIds();
        $purchaseQuery = Purchase::whereHas('customer', fn ($query) => $query->whereIn('location_id', $locationIds));

        // Counts
        $totalCustomers = Customer::whereIn('location_id', $locationIds)->count();
        $totalPurchases = (clone $purchaseQuery)->count();
        $totalLocations = count($locationIds);

        // Financials
        // sales_price = original sale value
        // net_price = actual amount receivable after discount / final settlement
        $totalSales = (clone $purchaseQuery)->sum('sales_price');
        $totalNet   = (clone $purchaseQuery)->sum('net_price');
        $totalPaid  = InstallmentPayment::whereHas('installment.purchase.customer', fn ($query) => $query->whereIn('location_id', $locationIds))->sum('amount');

        $totalDue = max($totalNet - $totalPaid, 0);
        $totalProfit = $totalSales - $totalNet;

        // Chart Data (Last 6 months)
        $chartLabels = [];
        $customerChartData = [];
        $purchaseChartData = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $chartLabels[] = $month->format('M Y');

            $customerChartData[] = Customer::whereIn('location_id', $locationIds)
                ->whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->count();

            $purchaseChartData[] = (clone $purchaseQuery)->whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->count();
        }

        return view('livewire.dashboard', compact(
            'totalCustomers',
            'totalPurchases',
            'totalLocations',
            'totalSales',
            'totalPaid',
            'totalDue',
            'totalProfit',
            'chartLabels',
            'customerChartData',
            'purchaseChartData'
        ));
    }
}
