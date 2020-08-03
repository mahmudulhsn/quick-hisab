<?php

namespace App\Http\Controllers\Backend;

use stdClass;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->get();
        return view('backend.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('backend.orders.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        DB::transaction(function () use($request) {
            $total_amount = 0;
            $orderedProduct = $request->get('product');
            for ($i=0; $i < count($orderedProduct['product_id']); $i++) {
                $product = Product::find($orderedProduct['product_id'][$i]);
                $total_amount = $total_amount + $orderedProduct['total'][$i];
                $stock = Stock::where('product_id', $orderedProduct['product_id'][$i])->latest()->first();
                $product->stocks()->create([
                    'product_id' => $orderedProduct['product_id'][$i],
                    'type' => 'out',
                    'quantity' => $orderedProduct['qty'][$i],
                    'current_stock' => $stock->current_stock - $orderedProduct['qty'][$i],
                    'total_amount' => $orderedProduct['total'][$i],
                    'unit_price' => $stock->unit_price,
                    'date_time' => Carbon::parse($request->date_time)->format('Y-m-d H:i:s')
                ]);
            }

            $order = Order::create([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone_no' => $request->customer_phone_no,
                'product' => $request->get('product'),
                'discount' => $request->discount,
                'total_amount' => $total_amount,
                'date_time' => Carbon::parse($request->date_time)->format('Y-m-d H:i:s')
            ]);


            
        });
        session()->flash('type', 'success');
        session()->flash('message', 'Order has been placed successfully.');
        return redirect()->route('orders.index');

        // return $product = $request->get('product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
