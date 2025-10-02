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
        Schema::create('cretifications', function (Blueprint $table) {
            $table->id();            
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('company_name')->nullable();
            $table->string('id_number')->nullable();
            $table->text('comments')->nullable();
            $table->string("featured_image")->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cretifications');
    }
};
