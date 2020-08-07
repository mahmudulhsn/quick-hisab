<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Order;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $thisMonthStart = Carbon::now()->startOfMonth()->toDateString();
        $today = Carbon::now()->addDay(1)->toDateString();
        $investByProduct = Stock::where('type', 'in')->whereBetween('date_time', [$thisMonthStart, $today])->sum('total_amount');
        $totalSale = Order::whereBetween('date_time', [$thisMonthStart, $today])->sum('total_amount');
        $expense = Expense::whereBetween('date_time', [$thisMonthStart, $today])->sum('amount');
        return view('backend.index', compact('investByProduct', 'totalSale', 'expense'));
    }
}
