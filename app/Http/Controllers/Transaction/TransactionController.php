<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;

use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Http\Requests\Transaction\UpdateTransactionRequest;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where("user_id", auth()->id())->get();
        $suppliers = Supplier::where("user_id", auth()->id())->get(['id', 'name']);
        return view('transactions.index', [
            'transactions' => $transactions,
            'suppliers' => $suppliers
        ]);
    }

    public function create(Request $request)
    {
        $categories = Category::where("user_id", auth()->id())->get(['id', 'name']);
        $units = Unit::where("user_id", auth()->id())->get(['id', 'name']);
        $suppliers = Supplier::where("user_id", auth()->id())->get(['id', 'name']);

        return view('transactions.create', [
            'categories' => $categories,
            'units' => $units,
            'suppliers' => $suppliers
        ]);
    }

    public function store(Request $request)
    {
        // Handle upload image or other relevant fields for the transaction

        // dd($request->all());    
        Transaction::create([
            'type' => $request->input('type') ?? null,
            'name' => $request->input('name') ?? null,
            'amount' => $request->input('amount') ?? null,
            'total_amount' => $request->input('quantity') * $request->input('amount') ?? null,
            'pending_amount' => $request->input('pending_amount') ?? null,
            'description' => $request->input('description') ?? null,
            'transaction_date' => $request->input('transaction_date') ?? null,
            'supplier_id' => $request->input('supplier_id') ?? null,
            'user_id' => auth()->user()->id,
            'quantity' => $request->input('quantity') ?? null,
            'seller_cnic' => $request->input('seller_cnic') ?? null,
            'seller_name' => $request->input('seller_name') ?? null,
            'photo' => $request->input('photo') ?? null,
            'imei_number_1' => $request->input('imei_number_1') ?? null,
            'imei_number_2' => $request->input('imei_number_2') ?? null,
            'expense_type' => $request->input('expense_type') ?? null,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction has been created!');
    }

    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('transactions.show', [
            'transaction' => $transaction,
        ]);
    }

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $suppliers = Supplier::where("user_id", auth()->id())->get(['id', 'name']);

        return view('transactions.edit', [
            'categories' => Category::where("user_id", auth()->id())->get(),
            'transaction' => $transaction,
            'suppliers' => $suppliers
        ]);
    }

    public function update(UpdateTransactionRequest $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        // Handle update logic for the transaction

        $transaction->save();

        return redirect()->route('transactions.index')->with('success', 'Transaction has been updated!');
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        // Handle deletion of the transaction

        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction has been deleted!');
    }
}
