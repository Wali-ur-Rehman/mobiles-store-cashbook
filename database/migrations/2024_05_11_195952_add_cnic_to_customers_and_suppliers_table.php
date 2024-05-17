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
        Schema::table('customers', function (Blueprint $table) {
            $table->text('cnic')->after('phone')->nullable();
        });
        Schema::table('suppliers', function (Blueprint $table) {
            $table->text('cnic')->after('phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('cnic');
        });
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropColumn('cnic');
        });
    }
};
