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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->uuid()->unique();
            $table->boolean('active')->default(true);
            $table->integer('sort')->default(100);
            $table->string('name');
            $table->string('slug');
            $table->boolean('filterable')->default(false);
            $table->string('type');
            $table->boolean('multiple')->default(false);
            $table->string('view_format')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
