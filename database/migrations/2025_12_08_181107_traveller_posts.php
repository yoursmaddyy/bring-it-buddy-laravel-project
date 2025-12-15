<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('traveller_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('from_location');
            $table->string('to_location');
            $table->date('travel_date');
            $table->decimal('available_space', 8, 2); // In kg
            $table->enum('preference', ['lightweight', 'heavy', 'both']);
            $table->decimal('fee', 10, 2);
            $table->boolean('status')->default(true); // true = active
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('traveller_posts');
    }
};