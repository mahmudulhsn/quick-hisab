<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Expense;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::latest()->get();
        return view('backend.expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('backend.expenses.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseRequest $request)
    {
        if ($request->expense_type == 'other') {
            $expense = Expense::create([
                'amount' => $request->amount,
                'expense_type' => $request->expense_type,
                'purpose' => $request->purpose,
                'expense_by' => $request->expense_by,
                'date_time' => Carbon::parse($request->date_time)->format('Y-m-d H:i:s')
            ]);
        }
        if ($request->expense_type == 'boost') {
            $expense = Expense::create([
                'amount' => $request->amount,
                'expense_type' => $request->expense_type,
                'product_id' => $request->get('product_id'),
                'expense_by' => $request->expense_by,
                'date_time' => Carbon::parse($request->date_time)->format('Y-m-d H:i:s')
            ]);
        }
       
        session()->flash('type', 'success');
        session()->flash('message', 'Expense has been added successfully.');
        return redirect()->route('expenses.index');
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
        $products = Product::all();
        $expense = Expense::findOrFail($id);
        return view('backend.expenses.edit', compact('expense', 'products'));
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
        $expense = Expense::findOrFail($id);
        $expense->update([
            'amount' => $request->amount,
            // 'expense_type' => $request->expense_type,
            'purpose' => $request->purpose,
            'product_id' => $request->get('product_id'),
            'expense_by' => $request->expense_by,
            'date_time' => Carbon::parse($request->date_time)->format('Y-m-d H:i:s')
        ]);
        session()->flash('type', 'success');
        session()->flash('message', 'Expense has been updated successfully.');
        return redirect()->route('expenses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::find($id);
        $expense->delete();

        session()->flash('type', 'success');
        session()->flash('message', 'Expense has been deleted successfully.');
        return redirect()->route('expenses.index');
    }
}
