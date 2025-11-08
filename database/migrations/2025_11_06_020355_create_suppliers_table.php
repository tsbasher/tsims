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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('internal_code')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('country_id');            
            $table->string('mobile')->unique();
            $table->string('email')->nullable();
            $table->decimal('prev_balance',8,2)->default(0.00);
            $table->tinyInteger('is_active')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
