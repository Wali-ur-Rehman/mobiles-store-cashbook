<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name')->nullable();
            $table->decimal('amount', 10, 2)->default(0)->nullable();
            $table->decimal('total_amount', 10, 2)->default(0)->nullable();
            // $table->decimal('buying_amount', 10, 2)->nullable(); // Added buying_amount field
            $table->decimal('pending_amount', 10, 2)->default(0)->nullable();
            $table->string('description')->nullable();
            $table->date('transaction_date')->nullable;
            $table->integer('quantity')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            // $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('seller_name')->nullable();
            $table->string('seller_cnic')->nullable();
            $table->string('photo')->nullable();
            $table->string('imei_number_1')->nullable();
            $table->string('imei_number_2')->nullable();
            $table->enum('expense_type', ['Personal', 'Shop', 'House'])->nullable();
            $table->timestamps();

            // $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('set null');
            // $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
