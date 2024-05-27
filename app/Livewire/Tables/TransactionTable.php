<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\Supplier;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class TransactionTable extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = '';
    public $startDate = '';
    public $endDate = '';
    public $sortField = 'transaction_date';
    public $type;
    public $sortAsc = false;

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortField = $field;
    }

    public function render()
    {
        if (request()->type) {
            $this->type = request()->type;
        }

        $type = $this->type;
        $startDate = $this->startDate;
        $endDate = $this->endDate;


        // $sums = DB::table('transactions')
        // ->select(DB::raw('SUM(CASE WHEN type="Credit" THEN amount ELSE 0 END) as total_credit'),
        // DB::raw('SUM(CASE WHEN type="Debit" THEN amount ELSE 0 END) as total_debit'),
        // DB::raw('SUM(CASE WHEN type="Expense" THEN amount ELSE 0 END) as total_expense'), 
        // DB::raw('SUM(CASE WHEN type="Purchase" THEN amount ELSE 0 END) as total_purchase'),
        // DB::raw('SUM(CASE WHEN type="Sales" THEN amount ELSE 0 END) as total_sales')
        // )
        // ->where('user_id',auth()->id());

        // if($startDate){
        //     $sums->whereDate('transaction_date', '>=', $startDate);
        // }
        // if($endDate){
        //     return $sums->whereDate('transaction_date', '<=', $endDate);
        // }

        // ->when($startDate, function ($query, $startDate) {
        //     return $query->whereDate('transaction_date', '>=', $startDate);
        // })
        // ->when($endDate, function ($query, $endDate) {
        //     return $query->whereDate('transaction_date', '<=', $endDate);
        // })->first());
        return view('livewire.tables.transaction-table', [
            'suppliers' => Supplier::where("user_id", auth()->id())->get(['id', 'name']),
            'products' => Transaction::select(['id', 'name'])
                ->where(['user_id' => auth()->id(), 'type' => 'Purchase'])
                ->where('sold',0)
                ->get(),
            // 'sums' =>$sums->first(),
            'transactions' => Transaction::where("user_id", auth()->id())
                // ->with(['category'])
                // ->search($this->search)
                ->when($type, function ($query, $type) {
                    return $query->where('type', $type);
                })
                ->when($startDate, function ($query, $startDate) {
                    return $query->whereDate('transaction_date', '>=', $startDate);
                })
                ->when($endDate, function ($query, $endDate) {
                    return $query->whereDate('transaction_date', '<=', $endDate);
                })
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage)
        ]);
    }
}
