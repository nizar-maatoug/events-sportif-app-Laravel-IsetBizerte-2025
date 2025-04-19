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
        Schema::create('event_sportifs', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->unique()->index();
            $table->string('slug')->unique()->index();
            $table->enum('sport', ['TaeKwondo', 'Judo', 'Karate', 'Boxe', 'KungFu', 'Aikido']);
            $table->string('description', 255);
            $table->string('location', 100);
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['open', 'closed', 'cancelled']);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_sportifs');
    }
};
