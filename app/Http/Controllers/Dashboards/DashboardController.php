<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Transaction;

use App\Models\Quotation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::where('user_id', auth()->id());

        // Apply date filters if present
        if ($request->has('startDate') && $request->startDate) {
            $query->whereDate('transaction_date', '>=', $request->startDate);
        }
        if ($request->has('endDate') && $request->endDate) {
            $query->whereDate('transaction_date', '<=', $request->endDate);
        }

        $transactions = $query->get();

        // Calculate statistics
        $totalSales = $transactions->where('type', 'Sales')->sum('amount');
        $totalExpenses = $transactions->where('type', 'Expense')->sum('amount');
        $totalDebit = $transactions->where('type', 'Debit')->sum('amount');
        $totalCredit = $transactions->where('type', 'Credit')->sum('amount');
        $totalProfit = $transactions->where('type','Sales')->sum('profit');
        $totalPurchase = $transactions->where('type', 'Purchase')->where('sold',0)->sum('amount');
        $cashInHand= $totalSales + $totalCredit - $totalDebit - $totalPurchase - $totalExpenses;
        // $transactionCount = $transactions->count();

        return view('dashboard', compact('transactions', 'totalSales', 'totalExpenses', 'totalDebit', 'totalCredit', 'totalPurchase','cashInHand', 'totalProfit'));
    }
    // public function index()
    // {
       
    //     $orders = Order::where("user_id", auth()->id())->count();
    //     $products = Product::where("user_id", auth()->id())->count();

    //     $purchases = Purchase::where("user_id", auth()->id())->count();
    //     $todayPurchases = Purchase::whereDate('date', today()->format('Y-m-d'))->count();
    //     $todayProducts = Product::whereDate('created_at', today()->format('Y-m-d'))->count();
    //     $todayQuotations = Quotation::whereDate('created_at', today()->format('Y-m-d'))->count();
    //     $todayOrders = Order::whereDate('created_at', today()->format('Y-m-d'))->count();

    //     $categories = Category::where("user_id", auth()->id())->count();
    //     $quotations = Quotation::where("user_id", auth()->id())->count();

    //     return view('dashboard', [
    //         'products' => $products,
    //         'orders' => $orders,
    //         'purchases' => $purchases,
    //         'todayPurchases' => $todayPurchases,
    //         'todayProducts' => $todayProducts,
    //         'todayQuotations' => $todayQuotations,
    //         'todayOrders' => $todayOrders,
    //         'categories' => $categories,
    //         'quotations' => $quotations
    //     ]);
    // }
}
