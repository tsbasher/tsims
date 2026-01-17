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
        Schema::create('proforma_invoice_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('proforma_invoice_id')->unsigned();
            $table->bigInteger('work_order_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('color_id')->unsigned();
            $table->bigInteger('style_id')->unsigned();
            $table->string('measurement')->nullable();
            $table->double('weight')->nullable();
            $table->bigInteger('weight_unit_id')->unsigned()->nullable();
            $table->integer('quantity');
            $table->bigInteger('quantity_unit_id')->unsigned();
            $table->text('description')->nullable();
            $table->decimal('unit_price', 18, 2);
            $table->decimal('total_price', 18, 2);
            $table->foreign('proforma_invoice_id')->references('id')->on('proforma_invoices')->onDelete('restrict');
            $table->foreign('work_order_id')->references('id')->on('work_orders')->onDelete('restrict');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('restrict');
            $table->foreign('style_id')->references('id')->on('styles')->onDelete('restrict');
            $table->foreign('weight_unit_id')->references('id')->on('units')->onDelete('restrict');
            $table->foreign('quantity_unit_id')->references('id')->on('units')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proforma_invoice_details');
    }
};
