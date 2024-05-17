<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
        $table->bigInteger("supplier_id")->nullable();
            $table->string('imei_number1')->after('quantity')->nullable();
            $table->string('imei_number2')->after('quantity')->nullable();
            $table->string('seller_cnic')->after('name')->nullable();
            $table->timestamp('purchase_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->dropColumn(['supplier_id','imei_number1', 'imei_number2', 'seller_cnic', 'purchase_date' ]);

        });
    }
};
