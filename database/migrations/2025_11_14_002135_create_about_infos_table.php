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
        Schema::create('about_infos', function (Blueprint $table) {
            $table->id();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->text('objectives')->nullable();
            $table->json('images')->nullable(); // Store multiple image paths
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_infos');
    }
};
