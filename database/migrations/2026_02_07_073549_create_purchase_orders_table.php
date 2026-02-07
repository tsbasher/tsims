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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('po_number')->unique();
            $table->bigInteger('supplier_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('work_order_id')->unsigned();
            $table->string('refference_number')->nullable();
            $table->text('description')->nullable();
            $table->date('po_date');            
            $table->bigInteger('payments_terms_id')->unsigned()->nullable();

            $table->bigInteger('currency_id')->unsigned();

            
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('restrict');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('restrict');
            $table->foreign('work_order_id')->references('id')->on('work_orders')->onDelete('restrict');
            $table->foreign('payments_terms_id')->references('id')->on('payment_terms')->onDelete('restrict');
                $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
