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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->uuid()->unique();
            $table->boolean('active')->default(true);
            $table->integer('sort')->default(100);
            $table->string('name');
            $table->string('slug');
            $table->integer('parent_section_id')->nullable();
            $table->text('description')->nullable();
            $table->integer('products_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
