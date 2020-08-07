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
    public function index(Request $request)
    {
        $data = explode(" - ",$request->date);

        $from = ($request->has('date')) ? Carbon::parse($data[0]) : Carbon::now()->startOfMonth()->toDateString();
        $to =($request->has('date')) ? Carbon::parse($data[1]) :  Carbon::now()->addDay(1)->toDateString();
        $investByProduct = Stock::where('type', 'in')->whereBetween('date_time', [$from, $to])->sum('total_amount');
        $totalSale = Order::whereBetween('date_time', [$from, $to])->sum('total_amount');
        $expense = Expense::whereBetween('date_time', [$from, $to])->sum('amount');
        return view('backend.index', compact('investByProduct', 'totalSale', 'expense'));
    }
}
