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
        Schema::create('transport_agents', function (Blueprint $table) {
            $table->id();
            $table->string('driver_name', 255);
            $table->string('driver_mobile', 50);
            $table->string('vehicle_type', 255)->nullable();
            $table->string('vehicle_number', 100)->nullable();
            $table->string('company_name', 100)->nullable();
            $table->string('company_address', 500)->nullable();
            $table->string('company_mobile', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport_agents');
    }
};
