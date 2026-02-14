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
        Schema::create('purchase_order_receive_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('purchase_order_receive_id')->unsigned();
            $table->bigInteger('purchase_order_detail_id')->unsigned();
            $table->integer('quantity_received');
            $table->bigInteger('work_order_detail_id')->unsigned();
            $table->foreign('purchase_order_receive_id')->references('id')->on('purchase_order_receives')->onDelete('restrict');
            $table->foreign('purchase_order_detail_id')->references('id')->on('purchase_order_details')->onDelete('restrict');
            $table->foreign('work_order_detail_id')->references('id')->on('work_order_details')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_receive_details');
    }
};
