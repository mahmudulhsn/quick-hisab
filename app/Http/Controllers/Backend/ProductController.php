<?php

namespace App\Http\Controllers\Backend;

use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['stocks' => function($query) {
                                    $query->latest()->first();
                                }])
                                ->latest()->get();
        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        DB::transaction(function () use($request) {
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            $product->stocks()->create([
                'product_id' => $request->product_id,
                'type' => 'in',
                'quantity' => $request->quantity,
                'current_stock' => $request->quantity,
                'total_amount' => $request->total_amount,
                'unit_price' => $request->total_amount / $request->quantity,
                'date_time' => Carbon::parse($request->date_time)->format('Y-m-d H:i:s')

            ]);
        });
        session()->flash('type', 'success');
        session()->flash('message', 'Products has been added successfully.');
        return redirect()->route('products.index');
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
        $product = Product::findOrFail($id);
        return view('backend.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        session()->flash('type', 'success');
        session()->flash('message', 'Products has been updated successfully.');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        session()->flash('type', 'success');
        session()->flash('message', 'Products has been deleted successfully.');
        return redirect()->route('products.index');
    }
}
