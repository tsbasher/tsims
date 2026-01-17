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
        Schema::create('proforma_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('pi_number')->unique();
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('buyer_id')->unsigned()->nullable();
            $table->string('refference_number')->nullable();
            $table->text('description')->nullable();
            $table->date('pi_date');
            $table->date('pi_expire_date')->nullable();
            $table->bigInteger('payments_terms_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('restrict');
            $table->foreign('buyer_id')->references('id')->on('buyers')->onDelete('restrict');
            // $table->foreign('payments_terms_id')->references('id')->on('payment_terms')->onDelete('restrict');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proforma_invoices');
    }
};
