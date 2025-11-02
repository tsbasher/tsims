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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->string('code');
            $table->string('internal_code')->nullable();
            $table->string('featured_image')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('show_as_featured')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('group_id')->references('id')->on('product_groups')->onDelete('restrict');
            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('restrict');
            $table->foreign('sub_category_id')->references('id')->on('product_sub_categories')->onDelete('restrict');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
