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
        Schema::create('inquery_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('inquery_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('inquery_id')->references('id')->on('inqueries')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquery_details');
    }
};
