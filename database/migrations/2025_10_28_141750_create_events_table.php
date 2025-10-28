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
    Schema::create('events', function (Blueprint $table) {
        $table->id(); // Ini untuk event_id (Primary Key)
        $table->string('title');
        $table->longText('description');
        $table->date('date');
        $table->string('location');
        $table->foreignId('user_id')->constrained(); // Ini untuk user_id (Foreign Key)
        $table->timestamps(); // Ini untuk created_at & updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
