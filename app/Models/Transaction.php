<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'amount',
        'pending_amount',
        'description',
        'transaction_date',
        'supplier_id',
        'user_id',
        'quantity',
        'total_amount',
        // 'customer_id',
        'seller_cnic',
        'seller_name',
        'photo',
        'imei_number_1',
        'imei_number_2',
        'expense_type',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // public function customer()
    // {
    //     return $this->belongsTo(Customer::class);
    // }
}
