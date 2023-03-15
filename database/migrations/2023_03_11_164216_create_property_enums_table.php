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
        Schema::create('property_enums', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->uuid()->unique();
            $table->integer('property_id');
            $table->integer('sort')->default(100);
            $table->string('name');
            $table->string('slug');
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_enums');
    }
};
