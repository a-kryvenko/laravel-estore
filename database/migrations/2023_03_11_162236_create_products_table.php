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
            $table->timestamps();
            $table->uuid()->unique();
            $table->integer('status_id');
            $table->boolean('available')->default(false);
            $table->integer('sort')->default(100);
            $table->string('sku')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->integer('canonical_section_id')->nullable();
            $table->float('purchasing_price')->nullable();
            $table->float('base_price');
            $table->float('discount_price')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('length')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('package_id')->nullable();
            $table->text('description')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('views_count')->default(0);
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
