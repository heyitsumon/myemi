<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\Installment;
use App\Models\InstallmentPayment;
use App\Models\Location;
use App\Models\Purchase;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $totalCustomers = Customer::count();
        $totalPurchases = Purchase::count();
        $totalLocations = Location::count();
        $totalSales = (float) Purchase::sum('sales_price');
        $totalNet = (float) Purchase::sum('net_price');
        $totalPaid = (float) InstallmentPayment::sum('amount');
        $totalDue = (float) Installment::query()
            ->leftJoin('installment_payments', 'installments.id', '=', 'installment_payments.installment_id')
            ->selectRaw('COALESCE(SUM(installments.amount), 0) - COALESCE(SUM(installment_payments.amount), 0) as total')
            ->value('total');
        $totalProfit = $totalSales - $totalNet;

        return view('livewire.dashboard', compact(
            'totalCustomers',
            'totalPurchases',
            'totalLocations',
            'totalSales',
            'totalNet',
            'totalPaid',
            'totalDue',
            'totalProfit'
        ));
    }
}
