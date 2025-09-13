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
        Schema::create('product_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('code');
            $table->string('internal_code')->nullable();
            $table->string("featured_image")->nullable();
            $table->tinyInteger('show_as_featured')->default(0)->comment('0=No, 1=Yes');
            $table->tinyInteger('is_active')->default(1)->comment('0=Inactive, 1=Active');
            $table->bigInteger('created_by')->nullable()->comment('user id');
            $table->bigInteger('updated_by')->nullable()->comment('user id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_groups');
    }
};
